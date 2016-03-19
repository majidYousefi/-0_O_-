var last_serv_id = '';
var last_serv_actn = '';
var index = 0;

var queue1 = [];
var queue2 = [];
var tryAgain = true;


function do_actn(serv_actn, serv_id, name)
{
    switch (serv_actn)
    {
        case 's': //show page
            window.last_serv_id = serv_id;
            fill(name);
            break;
        case 'a': // send datat to controller to add
            sendFormAjax();
            break;
        case 'e': // send datat to controller to add
            //uploadVisual(serv_id);
            editFormData(serv_id);
            break;
        case 'l': // get data from controller adn create list
            fillList();
            break;
        case 'g': // get data from controller adn create list
            get(serv_id);
            break;
        case 'd': // get data from controller adn create list
            deleteRecord(serv_id);
            break;

    }
}

$(document).ready(function () {
    
    $(".fill").click(function () {
        $("#ajaxLoader").css("visibility", "hidden");
        do_actn("s", this.name, $(this).text());
    });
    $.ajaxSetup({timeout: 10000});

    $('#TabIndex').delegate('li', 'click', function () {
        (($(this).children().first().attr('href')));
    });
    $('#TabIndex').delegate('span', 'click', function () {
        var t = (($(this).parent().attr('href')));
        $(this).parent().remove();
        $(t).remove();
    });


    $('body').on('click', '.repeat', function () {
        tab = $("#TabIndex .active >a").attr('href').replace('#', '');
        $("#" + tab + " .searchBox *").each(function () {
            if (($(this).is("input")))
                $(this).val('');
            if (($(this).is("select")))
                $(this).val($(this).find("option:first").val());

        });
        $("#" + tab + " .listPage").val("1");
        $("#" + tab + " .toOffset").val(10);
        fillList();
    });


    $('body').on('click', '.uploadButton', function () {
        $(this).parent().find('input').click();
        $(this).parent().find('input').change(function () {
            uploadVisual(this);
            this.attr("value", "");
        });
    });
    $('body').on('click', '.deleteFile', function () {
        deleteFile(this);
    });

    $('body').on('click', '.datePicker', function () {
        $(this).persianDatepicker({
            theme: 'latoja',
            cellWidth: 42,
            cellHeight: 25});
    });
});



function get(id)
{

    $(document).ready(function (e) {
        var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
        var serv = tab.split('_')[0];
        var zurl = "services/" + serv + "/g";
        $.ajax({
            url: zurl,
            data: {"_token": csrf(), "id": id},
            type: "POST",
            error: function (data) {
                //  location.reload();
            },
            success: function (data) {
                   clearForm();
                $("#" + tab + " .addButton").fadeOut();
                $("#" + tab + " .editButton").fadeIn().unbind().bind({
                    click: function () {
                        do_actn("e", id);

                    }
                });
                $("#" + tab + " .cancelButton").fadeIn().unbind().bind({
                    click: function () {
                        $("#" + tab + " .editButton").fadeOut().unbind();
                        $(this).fadeOut().unbind();
                        $("#" + tab + " .addButton").fadeIn();
                         clearForm();

                    }
                });


                for (var j in data[0])
                {
                    if ($("#" + tab + " .formx .elm#" + j).length > 0) {
                        $("#" + tab + " .formx .elm#" + j).each(function () {
                            if ($(this).is("input") && !($(this).parent().hasClass("multiSelect"))) {
                                if ($(this).is("input[type='checkbox']") || $(this).is("input[type='radio']") && data[0][j] == 1) {
                                    this.checked = true;
                                    this.value = '1';
                                }
                                else
                                    $(this).val(data[0][j]);
                            }
                            else if ($(this).is("textarea")) {
                                $(this).text(data[0][j]);
                            }
                            else if ($(this).is("select")) {
                                $(this).children().each(function () {
                                    if (this.value == data[0][j])
                                        $(this).attr('selected', 'selected');
                                });
                            }
                            else if ($(this).is("div .multiSelect"))
                            {
                                var ch = '';
                                try {
                                    ch = data[0][j].split(',');
                                }
                                catch (e) {
                                }
                                $(this).children().each(function () {
                                    for (var k = 0; k < ch.length; k++)
                                    {
                                        if (this.value == ch[k])
                                            this.checked = true;
                                    }
                                });
                            }
                            else if ($(this).is("div .fileUploader")) {
                                if (data[0][j].split('.')[1] == 'jpeg')
                                    myCanvas(data[0][j], $(this).find(".uploadButton")[0]);
                                $(this).find(".imgUploadLink").html($("<a href='" + data[0][j] + "' target='_blank'>" + '<span class="glyphicon glyphicon glyphicon-link"  ></span>' + data[0][j].split('.')[1] + "</a>"));
                                $(this).find(".imgUploadLink").append($('<span class="glyphicon glyphicon-remove-sign deleteFile"  ></span>'));
                            }
                            else if ($(this).hasClass("grid-container")) {
                                $("#" + tab + " .cke_wysiwyg_frame").contents().find(".cke_editable").html(data[0][j]);
                            }


                        });
                    }
                }

                window.scrollBy(0, -10000);
            }
        });


    });
}

function fill(name)
{
    $("#mainPanel").html('');

    $(document).ready(function (e) {
        window.index += 1;
        var menu = window.last_serv_id + "_menu" + window.index;
        $("#TabIndex").append('<li><a data-toggle="tab"  href="#' + menu + '" ><span class="glyphicon glyphicon-remove"></span>' + name + '</a></li>');
        $("#TabIndex li").removeClass('active');
        $("#TabIndex li:last-child").addClass('active');
        $("#TabPlace ").append('<div id="' + menu + '" class="tab-pane fade  "><div id="mainPanel' + (window.index) + '"></div></div>');
        $("#TabPlace>div").removeClass('active in');
        $("#TabPlace>div:last-child").addClass('active in');
        window.queue1.push(menu);
        window.queue2.push(menu);

        var zurl = "services/" + window.last_serv_id + "/s";
        $.ajax({
            url: zurl,
            data: {"_token": csrf()},
            type: "POST",
            aysnc: true,
            statusCode: {
                401: function () {
                    location.reload();
                },
                500: function () {
                    window.queue1.shift();
                    window.queue2.shift();
                    $.growl.error({message: "خطا در سمت سرور"});
                }
            },
            error: function (data) {
                //  location.reload();
            },
            success: function (data) {
                try
                {
                    var body = data.split('__@__');
                    var listx = body[1];
                    body = body[0];

                    $("#" + window.queue1.shift()).html(body);

                    if ($(data).filter('#listx').text() && listx)
                        firstListFill(listx);

                    window.scrollBy(0, -1000);
                    navigation();
                }
                catch (e)
                {
                    window.queue2.shift();
                }

            }
        });


    });
}

function navigation()
{
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    var serv = tab.split('_')[0];
    $("#" + tab + " .listPage").change(function () {
        fillList();
    });

    $(".getListExcel ").click(function () {
        var from = $("#" + tab + " .listPage").val() * $("#" + tab + " .toOffset").val();
        var to = $("#" + tab + " .toOffset").val();
        var zurl = "getListExcel/" + serv + "/" + from + "/" + to;
        alert(zurl);
        window.open("getListExcel");
    });
    var dont_change = '0';

    $(".navx").click(function () {
        var b = $("#" + tab + " .listPage").val();
        var c = $("#" + tab + " .resultCount").text();
        if ($(this).hasClass('glyphicon-step-forward')) {
            if (b == 1)
                dont_change = '1';
            $("#" + tab + " .listPage").val('1');
        }
        else if ($(this).hasClass('glyphicon-step-backward')) {
            if (c == b)
                dont_change = '1';
            $("#" + tab + " .listPage").val($("#" + tab + " .resultCount").text());
        }
        else if ($(this).hasClass('glyphicon-chevron-left')) {
            var a = $("#" + tab + " .listPage").val();
            if ((a + 1) < $("#" + tab + " .resultCount").text())
                ++a;
            $("#" + tab + " .listPage").val(a);
            if (c == b)
                dont_change = '1';
        }
        else if ($(this).hasClass('glyphicon-chevron-right')) {
            var a = $("#" + tab + " .listPage").val();
            if ((a - 1) >= 1)
                --a;
            $("#" + tab + " .listPage").val(a);
            if (b == 1)
                dont_change = '1';
        }
        if (dont_change != 1)
            $("#" + tab + " .listPage").change();
        dont_change = 0;
    });
}
function firstListFill(data)
{
    if (!data)
        return;
    var tab = window.queue2.shift();
    $("#" + tab + " .listx tbody").html('');
    data = $.parseJSON(data);

    var pageCount = Math.ceil(data['count'] / 10);
    if (pageCount == 0)
        pageCount = 1;

    $("#" + tab + " .listPage").attr("max", pageCount);

    if (pageCount < parseInt($("#" + tab + " .resultCount").text()))
    {
        $("#" + tab + " .listPage").val("1");
        //    fillList(0);
        $("#" + tab + " .resultCount").html(pageCount);
        $("#" + tab + " .listPage").change();
        return;

    }
    $("#" + tab + " .resultCount").html(pageCount);
    if (!data[0])
    {
        $("#" + tab + " .listx tbody").html("<tr><td colspan='55'><h4>" + "هیچ رکوردی یافت نشد !!!!" + "</h4></td></tr>");
        return;
    }
    delete data['count'];
    var tr = "";
    for (var k in data) {
        var id = data[k]['f1'];
        tr += "<tr>";
        tr += "<td  style='text-align: -webkit-center;'><span class='glyphicon glyphicon-remove-circle'  onclick=do_actn('d','" + id + "')></span>" + "<span class='glyphicon glyphicon-edit' onclick=do_actn('g','" + id + "')></span></td>";
        for (var j in data[k])
        {
            tr += "<td>" + data[k][j] + "</td>";
        }
        tr += "</tr>";
    }
    if (tr != '')
        $("#" + tab + " .listx tbody").append(tr);
}
function fillList()
{
    var tab;
    // if (window.queue2.length > 0)
    //   tab = window.queue2.shift();
    //else if ($("#TabIndex"))
    tab = $("#TabIndex .active >a").attr('href').replace('#', '');

    // var tab=$(".listx").parent().attr('id');
    var serv = tab.split('_')[0];
    // $("#"+tab+" .listx tbody").html("xxx");
    var to = 10;
    $(document).ready(function () {

        //console.log($("#"+t+" #listPage"));
        if ($("#" + tab + " .toOffset").val())
            to = $("#" + tab + " .toOffset").val();
        if ($("#" + tab + " .listPage").val())
            from = ($("#" + tab + " .listPage").val() - 1) * to;

        /*   var sData = {};
         sData['data'] = {};
         sData['op'] = {};
         *
         */
        if ($("#" + tab + " .searchBox "))
            var sdata = {};
        var s = 1;
        $("#" + tab + " .searchBox *").each(function () {
            if ($(this).is("input")) {
                sdata["s" + s] = this.value;
                s++;
            }
        });

        var zurl = "services/" + serv + "/l";
        $.ajax({
            url: zurl,
            type: "POST",
            aysnc: true,
            data: {"_token": csrf(), "from": from, "to": to, "data": sdata},
            success: function (data) {
                $("#" + tab + " .listx tbody").html('');
                data = $.parseJSON(data);
                var pageCount = Math.ceil(data['count'] / to);
                if (pageCount == 0)
                    pageCount = 1;

                $("#" + tab + " .listPage").attr("max", pageCount);

                if (pageCount < parseInt($("#" + tab + " .resultCount").text()))
                {
                    $("#" + tab + " .listPage").val("1");
                    //    fillList(0);
                    $("#" + tab + " .resultCount").html(pageCount);
                    $("#" + tab + " .listPage").change();
                    return;

                }
                $("#" + tab + " .resultCount").html(pageCount);
                if (!data[0])
                    $("#" + tab + " .listx tbody").html("<tr><td colspan='55'><h4>" + "هیچ رکوردی یافت نشد !!!!" + "</h4></td></tr>");
                delete data['count'];
                var tr = "";
                for (var k in data) {
                    var id = data[k]['f1'];
                    tr += "<tr>";
                    tr += "<td  style='text-align: -webkit-center;'><span class='glyphicon glyphicon-remove-circle'  onclick=do_actn('d','" + id + "')></span>" + "<span class='glyphicon glyphicon-edit' onclick=do_actn('g','" + id + "')></span></td>";
                    for (var j in data[k])
                    {
                        tr += "<td>" + data[k][j] + "</td>";
                    }
                    tr += "</tr>";
                }
                if (tr != '')
                    $("#" + tab + " .listx tbody").html(tr);
            }
        });

    });

}

function deleteRecord(id)
{
    var data = {};
    data['kind'] = 'pd';
    data['title'] = "danger";
    data['msg'] = "hoyyy";
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    var serv = tab.split('_')[0];
    //showMsg(JSON.stringify(data));
    BootstrapDialog.confirm({
        title: 'هشدار !',
        message: 'آیا از حذف این رکورد مطمئنید ؟',
        type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
        closable: true, // <-- Default value is false
        draggable: true, // <-- Default value is false
        btnCancelLabel: 'انصراف', // <-- Default value is 'Cancel',
        btnOKLabel: 'حذف', // <-- Default value is 'OK',
        btnOKClass: 'btn-danger', // <-- If you didn't specify it, dialog type will be used,
        callback: function (result) {
            if (result) {
                var zurl = "services/" + serv + "/d";
                $.ajax({
                    url: zurl,
                    type: "POST",
                    data: {"_token": csrf(), "id": id},
                    success: function (data) {
                        do_actn("l");
                    }
                });
            }
        }
    });


}

function sendFormAjax(d)
{
    $(document).ready(function (e) {
        var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
        var serv = tab.split('_')[0];
        var ajForm = "formx";
        var data = checkFixData();
        if (data == '-1')
            return;
        var zurl = "services/" + serv + "/a";
        $.ajax({
            url: zurl,
            type: "post",
            data: data,
            aysnc: true,
            success: function (data) {
                if (!data)
                {
                    $.growl.notice({message: "عملیات با موفقیت انجام شد ."});
                    $.when(do_actn('l')).then(clearForm());


                }
                else
                {
                    showMsg(data);
                }
            }
        });
    });

}

function editFormData(id, d)
{
    $(document).ready(function (e) {
        var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
        var serv = tab.split('_')[0];
        var ajForm = "formx";
        var data = checkFixData();
        data['id'] = id;

        if (data == '-1')
            return;
        var zurl = "services/" + serv + "/e";
        $.ajax({
            url: zurl,
            type: "post",
            data: data,
            aysnc: true,
            success: function (data) {
                if (!data)
                {
                    $.growl.notice({message: "عملیات با موفقیت انجام شد ."});
                    $("#" + tab + " .editButton").fadeOut().unbind();
                    $("#" + tab + " .cancelButton").fadeOut().unbind();
                    $("#" + tab + " .addButton").fadeIn();
                    clearForm();
                    do_actn('l');
                }
                else
                {
                    showMsg(data);
                }
            }
        });
    });

}


function clearForm()
{
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    $("#" + tab + " .formx *").each(function () {
        if ($(this).is("input"))
        {
            if ($(this).is("input[type='checkbox']") || $(this).is("input[type='radio']"))
                this.checked = false;
            else
                this.value = '';
        }
        if ($(this).is("div .fileUploader"))
        {
            deleteFile(($(this).find('.imgUploadLink>.deleteFile'))[0]);
            $(this).find(".imageHolder").html('');
            $(this).find(".imgUploadLink").html('');
            $(this).find("input").val('');

        }
        if ($(this).is("textarea"))
            this.value = '';
        if ($(this).is("select"))
            this.value = 0;

    });
    //*********************IF FORM CONTAIN EDITOR
    var body = $("#" + tab + " .cke_wysiwyg_frame").contents().find(".cke_editable").html();
    if (body)
    {
        $("#" + tab + " .cke_wysiwyg_frame").contents().find(".cke_editable").html('');
    }
}


function  checkFixData()
{
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    var data = {};
    var rules = 0;
    //*****************FILL DATA IF ELEMENT'S HAVE 'NAME'
    var i = 1;
    $("#" + tab + " .formx .elm").each(function () {
        if ($(this).attr('id')) {
            if ($(this).is("input"))
            {
                data[$(this).attr('id')] = this.value;

                if (this.required && $.trim(this.value) == '')
                {
                    rules = -1;
                    $(this).css({"border-color": "red"});
                }
                else
                {
                    $(this).css({"border-color": "#ccc"});
                }
            }

            if ($(this).is("textarea") && !($(this).hasClass("editor_my")))
            {
                data[$(this).attr('id')] = this.value;

            }

            if ($(this).is("select"))
            {
                data[$(this).attr('id')] = this.value;


                if (this.required && $.trim(this.value) == '0')
                {

                    rules = -1;
                    $(this).css({"border-color": "red"});
                }
                else
                {
                    $(this).css({"border-color": "#ccc"});
                }

            }
            if ($(this).hasClass("multiSelect"))
            {
                $("#" + tab + " .multiSelect").each(function () {
                    var x = [];
                    $(this).children().each(function () {
                        if (this.checked)
                            x.push($(this).val());
                    });
                    if (x.length > 0)
                    {
                        data[$(this).attr('id')] = "," + x.join() + ",";

                    }
                    else
                    {
                        data[$(this).attr('id')] = x.join();

                    }

                    if (this.title === 'required' && x == '')
                    {
                        rules = -1;
                        $(this).css({"border-color": "red"});
                    }
                    else
                        $(this).css({"border-color": "#ccc"});
                });
            }
            if ($(this).hasClass("autoComplete"))
            {
                if ($(this).find("input").attr('required') && ($(this).find("input").attr('id') == '')) {
                    data[$(this).attr('id')] = '';
                    rules = -1;
                    $(this).find("input").css({"border-color": "red"});
                }
                else {
                    data[$(this).attr('id')] = $(this).find("input").attr('id') + "^" + $(this).find("input").val();
                    $(this).find("input").css({"border-color": "#ccc"});
                }



            }
            if ($(this).hasClass("fileUploader"))
            {

                if ($(this).find(".imgUploadLink > a").attr('href'))
                    data[$(this).attr('id')] = $(this).find(".imgUploadLink > a").attr('href');
                else
                    data[$(this).attr('id')] = '';
            }
            if ($(this).hasClass("editor"))
            {
                var body = $(this).find(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
                data[$(this).attr('id')] = body;
            }
        }
    });

    //************CHECK IF DONT FILL REQUIRED ELEMENTS
    if (rules == -1) {
        $.growl.warning({message: " فیلد های اجباری را پر کنید !!!"});
        return -1;
    }
    //*********************IF FORM CONTAIN EDITOR
    // var body = $("#" + tab + " .cke_wysiwyg_frame").contents().find(".cke_editable").html();
    // if (body)
    // {

    // }
    //-------------------------------------------


    return data;
}
function showMsg(data)
{
    data = $.parseJSON(data);

    var MessageType = '';
    switch (data['kind'])
    {
        case 'pi':
            MessageType = BootstrapDialog.TYPE_INFO;
            break;
        case 'pp':
            MessageType = BootstrapDialog.TYPE_PRIMARY;
            break;
        case 'ps':
            MessageType = BootstrapDialog.TYPE_SUCCESS;
            break;
        case 'pw':
            MessageType = BootstrapDialog.TYPE_WARNING;
            break;
        case 'pd':
            MessageType = BootstrapDialog.TYPE_DANGER;
            break;
        case 'ls':
            $.growl.notice({message: data['msg']});
            return;
            break;
        case 'lw':
            $.growl.warning({message: data['msg']});
            return;
            break;
        case 'le':
            $.growl.error({message: data['msg']});
            return;
            break;
        default:
            MessageType = BootstrapDialog.TYPE_DEFAULT;
            break;
    }
    BootstrapDialog.show({
        type: MessageType,
        title: data['title'],
        message: data['msg'],
        buttons: [{
                label: 'بستن',
                action: function (dialogRef) {
                    dialogRef.close();
                }
            }]
    });
}

$(document).ajaxStart(function () {
    $("#ajaxLoader").css("visibility", "visible");
    $(".fill").unbind('click');

});
$(document).ajaxStop(function () {
    $("#ajaxLoader").css("visibility", "hidden");
    $(".fill").bind('click', function () {
        do_actn("s", this.name, $(this).text());
    });
});

function  uploadVisual(_this)
{
    if ($(_this).parent().find(".imgUploadLink>.deleteFile")[0])
        deleteFile($(_this).parent().find(".imgUploadLink>.deleteFile")[0]);

    var d = _this.files[0];
    var fd = new FormData();
    fd.append("userfile", d);
    $.ajax({
        url: "upload/" + window.last_serv_id,
        data: fd,
        type: "POST",
        enctype: 'multipart/form-data',
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        beforeSend: function () {
            $(_this).parent().find(".uploadButton>span").remove();
            $(_this).parent().find(".uploadButton").append("<marquee scrollamount='1'  direction='up' style='width:15px;  float: left;' ><span class='glyphicon glyphicon-open' ></marquee>");
        },
        statusCode: {
            500: function () {
                $(_this).parent().find(".uploadButton>marquee").remove();
                $(_this).parent().find(".uploadButton").append("<span class='glyphicon glyphicon-open' >");
                if (window.tryAgain) {
                    uploadVisual(_this);
                    window.tryAgain = false;
                    return;
                }
                $.growl.error({message: "مشکل در آپلود فایل !"});
            }
        },
        success: function (data) {
            if (d['type'].split("/")[0] == 'image')
                myCanvas(data, _this);
            $(_this).parent().find(".imgUploadLink").html($("<a href='" + data + "' target='_blank'>" + '<span class="glyphicon glyphicon glyphicon-link"  ></span>' + d['type'].split("/")[1] + "</a>"));
            $(_this).parent().find(".imgUploadLink").append($('<span class="glyphicon glyphicon-remove-sign deleteFile"  ></span>'));
            $(_this).parent().find(".uploadButton>marquee").remove();
            $(_this).parent().find(".uploadButton").append("<span class='glyphicon glyphicon-open' >");
            //   console.log(data);
            // alert(data);
            /*if (!id)
             sendFormAjax(data);
             else
             editFormData(id, data);*/

        }
    });



}

window.onerror = function () {
    $("#ajaxLoader").css("visibility", "hidden");
    $(".fill").bind('click', function () {
        do_actn("s", this.name, $(this).text());
    });
    return true;
}

//    showMsg(JSON.stringify({"kind":"d","title":"هشدار","msg":"فیلد های اجباری را پر کنید"}));
//   return;
/*
 * ,
 xhr: function () {
 var xhr = $.ajaxSettings.xhr(); // call the original function
 xhr.addEventListener('progress', function (e) {
 if (e.lengthComputable) {
 var percentComplete = e.loaded / e.total;
 //   alert(Math.round(percentComplete * 100) + "%");
 }
 }, false);
 return xhr;
 }
 */
function myCanvas(data, _this) {
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    var x = $('<canvas width="100" height="100"></canvas>');
    $(_this).parent().find('.imageHolder').append(x);
    var c = x[0].getContext('2d');
    var img = $('<img width="100" height="150">')[0];
    img.src = data;
    img.onload = function () {
        c.drawImage(img, 1, 1, 100, 100);
    }


}

function deleteFile(_this) {
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');

    if ($("#" + tab + " .editButton").css('display') == 'none') {
        var file_path = $(_this).parent().find('a').attr('href');
        $.ajax({
            url: 'removeUpload',
            data: {'file_path': file_path},
            type: "POST",
            async: false,
            statusCode: {
                401: function () {
                    location.reload();
                },
                500: function () {
                    $(_this).parents('.fileUploader').find('canvas').remove();
                    $(_this).parent().html('');
                    $.growl.warning({message: "خطا در  پیدا کردن فایل در سرور !"});
                }
            },
            success: function (data) {
                $(_this).parents('.fileUploader').find('canvas').remove();
                $(_this).parent().html('');
            }
        });
    }
    else {
        $(_this).parents('.fileUploader').find('canvas').remove();
        $(_this).parent().html('');
    }

}


function related(_this, serv_id, gc_id) {
    $(_this).attr('id', '');
    if (($(_this).val()).length > 1) {
        $.ajax({
            url: "services/" + serv_id + "/gc/" + gc_id,
            data: {'title': $(_this).val()},
            type: "POST",
            async: false,
            statusCode: {
                401: function () {
                    location.reload();
                },
                500: function () {
                    $.growl.warning({message: "خطا در  پیدا کردن فایل در سرور !"});
                }
            },
            success: function (data) {
                $(_this).parent().find('ul').remove();
                data = $.parseJSON(data);
                $(_this).parent().append("<ul></ul>");
                if (data.length == 0)
                    $(_this).parent().find('ul').append("هیچ موردی یافت نشد!");
                else {
                    for (var k = 0; k < data.length; k++) {

                        if (data[k]['f1'])
                            $(_this).parent().find('ul').append("<li id='" + data[k]['f1'] + "'>" + data[k]['f2'] + "</li>");
                    }

                }
                $(_this).parent().on('mousedown', 'ul>li', function () {
                    $(this).parent().parent().find('input').val($(this).text());
                    $(this).parent().parent().find('input').attr('id', $(this).attr('id'));
                    $(this).parent().remove();
                    $(_this).css({'background-color': 'rgb(231, 231, 231)'});
                });
                $(_this).blur(function () {
                    $(this).parent().find('ul').remove();
                });


            }
        });

    }
    if ($(_this).attr('id') == '') {
        $(_this).css({'background-color': 'white'});
    }


}
