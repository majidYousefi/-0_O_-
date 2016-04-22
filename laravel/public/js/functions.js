var funcParams = '';
var last_serv_id = '';
var last_serv_actn = '';
var index = 0;
var deleteButton = true;
var queue1 = [];
var queue2 = [];
var tryAgain = true;
var y = 1;
$(document).ready(function () {
    $(".fill").click(function () {
        $("#ajaxLoader").css("visibility", "hidden");
        do_actn("s", this.name, $(this).text());
    });

    $(document).ready(function () {
        $(window).resize(function () {
            var bodyheight = $(window).height();
            $(".container").height(bodyheight - 110);
        }).resize();
    });
    $.ajaxSetup({timeout: 10000});

    $('#TabIndex').delegate('li', 'click', function () {
        (($(this).children().first().attr('href')));
    });

    $('#TabIndex').delegate('span', 'click', function () {
        var t = (($(this).parent().attr('href')));
        $(this).parent().remove();
        $(t).remove();
        //$("#TabIndex li").removeClass('active');
        // $("#TabPlace>div:last-child").addClass('active in');
    });

    $('body').on('click', '.glyphicon-repeat', function () {
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
        // tab = $("#TabIndex .active >a").attr('href').replace('#', '');
        $(this).parent().find('input').click();
        $(this).parent().find('input').change(function () {
            uploadVisual(this);
            this.attr("value", "");
        });

    });

    $('body').on('click', '.deleteFile', function () {
        deleteFile(this);


    });

    $('body').on('mouseover', '.datePicker', function () {
        $(this).persianDatepicker({
            theme: 'latoja',
            cellWidth: 42,
            cellHeight: 25});
    });
    $('body').on('click', '.datePicker', function () {
        $(this).persianDatepicker({
            theme: 'latoja',
            cellWidth: 42,
            cellHeight: 25});
    });

    $('body').on('click', '.addDetailRowButton', function () {
        $(this).parents('table').find(".firstRow").css({"display": "none"});
        addRowToDetail($(this).parents('table'));


    });

    $('body').on('click', '.removeRowButton', function () {
        if ($(this).parents('table').find("tbody>tr").not(".firstRow").not("[data-action='delete']").length == 1) {
            $(this).parents('table').find(".firstRow").css({"display": ""});
        }
        removeRowDetail(this);

    });


});


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
        case 'g_ex':
            getExcel();
            break;
        case 'd': // get data from controller adn create list
            deleteRecord(serv_id);
            break;

    }
}

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
                $("#" + tab + " .addButton").hide();
                $("#" + tab + " .editButton").fadeIn().unbind().bind({
                    click: function () {
                        do_actn("e", id);

                    }
                });
                $("#" + tab + " .cancelButton").fadeIn().unbind().bind({
                    click: function () {
                        $("#" + tab + " .editButton").hide().unbind();
                        $(this).hide().unbind();
                        $("#" + tab + " .addButton").fadeIn();
                        clearForm();

                    }
                });

                var d = data.split('__@__');
                data = d[0];
                var details = d[1];
                details = $.parseJSON(details);
                data = $.parseJSON(data);
                for (var j in data[0])
                {
                    if ($("#" + tab + " .mainForm .elm#" + j).length > 0) {
                        $("#" + tab + " .mainForm .elm#" + j).each(function () {
                            setThisElement(this, data[0][j]);
                        });
                    }
                }


                if (details != null)
                    fillDetails(details);
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
        // window.queue1.push(menu);
        // window.queue2.push(menu);
        // var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
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
                    // window.queue1.shift();
                    // window.queue2.shift();
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
                    //window.queue1.shift()
                    $("#" + menu).html(createPage(body));
                    //  if ($(data).filter('#listx').text() && listx)
                    firstListFill(listx);

                    window.scrollBy(0, -1000);
                    navigation();
                    /* $("#" + tab + " .datePicker").persianDatepicker({
                     theme: 'latoja',
                     cellWidth: 42,
                     cellHeight: 25});
                     */
                    $('[data-toggle="tooltip"]').tooltip();
                }
                catch (e)
                {
                    //window.queue2.shift();
                }

            }
        });


    });
}

function getExcel() {

    var zurl = "services/" + window.last_serv_id + "/getListExcel";
    window.open(zurl);

}

function navigation()
{
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    var serv = tab.split('_')[0];
    $("#" + tab + " .listPage").change(function () {
        fillList();
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
    // var tab = window.queue2.shift();
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
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
        var id = data[k]['id'];
        tr += "<tr>";
        tr += "<td  style='text-align: -webkit-center;'>";
        if (window.deleteButton)
            tr += " <span class='glyphicon glyphicon-remove-circle'  onclick=do_actn('d','" + id + "')></span>";
        tr += "<span class='glyphicon glyphicon-edit' onclick=do_actn('g','" + id + "')></span></td>";
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

    // if (window.queue2.length > 0)
    //   tab = window.queue2.shift();
    //else if ($("#TabIndex"))
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');

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
        $("#" + tab + " .searchBox .elm").each(function () {
            if ($(this).attr("id")) {
                var getData = getThisElement(this);
                if (getData)
                    sdata[$(this).attr("id")] = getData;
                else
                    return;
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
                    var id = data[k]['id'];
                    tr += "<tr>";
                    tr += "<td  style='text-align: -webkit-center;'>";
                    if (window.deleteButton)
                        tr += " <span class='glyphicon glyphicon-remove-circle'  onclick=do_actn('d','" + id + "')></span>";
                    tr += "<span class='glyphicon glyphicon-edit' onclick=do_actn('g','" + id + "')></span></td>";
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
        var data = checkFixData();
        if (!data)
            return;
        var zurl = "services/" + serv + "/a";
        $.ajax({
            url: zurl,
            type: "post",
            data: data,
            aysnc: true,
            statusCode: {
                401: function () {
                    location.reload();
                },
                500: function () {
                    //  window.queue1.shift();
                    // window.queue2.shift();
                    $.growl.error({message: "خطا در سمت سرور"});
                }
            },
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
    //alert("fs");
    $(document).ready(function (e) {
        var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
        var serv = tab.split('_')[0];
        var data = checkFixData();
        if (!data)
            return;
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
                    $("#" + tab + " .editButton").hide().unbind();
                    $("#" + tab + " .cancelButton").hide().unbind();
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
    $("#" + tab + " .mainForm *").each(function () {
        if ($(this).is("input"))
        {
            if ($(this).is("input[type='checkbox']") || $(this).is("input[type='radio']"))
                this.checked = false;
            else
                this.value = '';
        }
        if ($(this).is("div .fileUploader"))
        {
            // deleteFile(($(this).find('.imgUploadLink>.deleteFile'))[0]);
            $(this).find(".imageHolder").html('');
            $(this).find(".imgUploadLink").html('');
            $(this).find("input").val('');

        }
        if ($(this).is("textarea"))
            this.value = '';
        if ($(this).is("select"))
            this.value = 0;

    });
    $("#" + tab + " .mainForm .detail").each(function () {
        $(this).find('tbody>.firstRow').css({"display": ""});
        $(this).find('tbody tr:not(:first)').remove();
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
    var rules = false;
    //*****************FILL DATA IF ELEMENT'S HAVE 'NAME'
    var i = 1;
    $("#" + tab + " .mainForm .elm").each(function () {
        if ($(this).attr('id')) {
            var getData = getThisElement(this);
            if (getData)
                data[$(this).attr('id')] = getData;
            else
                rules = true;
        }



        //  alert("id:"+$(this).attr('id')+"   "+data[$(this).attr('id')]);
        /*  if ($(this).attr('id')) {
         if ($(this).is("input"))
         {
         data[$(this).attr('id')] = this.value;
         
         if ($(this).attr('required') && $.trim(this.value) == '')
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
         
         
         if ($(this).attr('required') && $.trim(this.value) == '0')
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
         if ($(this).attr('required') && ($(this).find("input").attr('id') == '')) {
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
         
         if ($(this).hasClass("autoCompo")) {
         data[$(this).attr('id')] = $(this).find('select')[0].value;
         if ($(this).attr('required') && $(this).find('select')[0].value == '0')
         {
         
         rules = -1;
         $(this).find('select').css({"border-color": "red"});
         }
         else
         {
         $(this).find('select').css({"border-color": "#ccc"});
         }
         }
         if ($(this).hasClass("datePick"))
         {
         if ($(this).attr('required') && ($(this).find("input").val() == '')) {
         data[$(this).attr('id')] = '';
         rules = -1;
         $(this).find("input").css({"border-color": "red"});
         }
         else {
         data[$(this).attr('id')] = $(this).find("input").val();
         $(this).find("input").css({"border-color": "#ccc"});
         }
         
         
         }
         if ($(this).hasClass("editor"))
         {
         var body = $(this).find(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
         data[$(this).attr('id')] = body;
         }
         }
         */
    });


    //************CHECK IF DONT FILL REQUIRED ELEMENTS
    if (rules) {
        $.growl.warning({message: " فیلد های اجباری را پر کنید !!!"});
        return false;
    }
    data['details'] = checkFixDetailData();
    //console.log(checkFixDetailData());
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
    try {
        data = $.parseJSON(data);
    }
    catch (e)
    {
        return '';
    }

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
            // $(_this).parent().find(".uploadButton>i").remove();
            //   $(_this).parent().find(".uploadButton").append("<marquee scrollamount='1'  direction='up' style='width:15px;  float: left;' ><i class='glyphicon glyphicon-open' ></i></marquee>");
            $(_this).parent().find("button").addClass('waitGif');//.css({'background':"url('http://localhost/bCodeIgniter/galleries/gif/ajax_loader_3.gif') no-repeat"});

        },
        statusCode: {
            500: function () {
                //   $(_this).parent().find(".uploadButton>marquee").remove();
                //   $(_this).parent().find(".uploadButton").append("<i class='glyphicon glyphicon-open' ></i>");
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
            $(_this).parent().find("button").removeClass('waitGif');
            //    $(_this).parent().find("button").css({'background-image':"url('http://localhost/bCodeIgniter/galleries/gif/ajax_loader_3.gif')"});
            // $(_this).parent().find(".uploadButton>marquee").remove();
            // $(_this).parent().find(".uploadButton").append("<i class='glyphicon glyphicon-open' ></i>");
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
    if ($(_this).parents(".elm").hasClass("autoComplete")) {
        $(_this).attr('id', '');
        if (($(_this).val()).length > 1) {
            $.ajax({
                url: "services/" + serv_id + "/gc/" + gc_id,
                data: {'params': $(_this).val()},
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
    else if ($(_this).parents(".elm").hasClass("autoSelect")) {
        if ($(_this).children().length == 1) {
            $.ajax({
                url: "services/" + serv_id + "/gc/" + gc_id,
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
                    data = $.parseJSON(data);
                    for (var k = 0; k < data.length; k++) {
                        if (data[k]['f1'])
                            $(_this).append("<option value='" + data[k]['f1'] + "'>" + data[k]['f2'] + "</option>");
                    }



                }
            });
        }
        return _this;
    }
}


function addRowToDetail(_this) {
    var elem = $(_this).find(".firstRow");

    $(_this).find('tbody').append(elem.clone().removeClass('firstRow').hide().fadeIn(300));
}

function removeRowDetail(_this) {

    if ($(_this).parents('tr').attr('id')) {
        $(_this).parents('tr').css({'display': 'none'});
        $(_this).parents('tr').attr('data-action', 'delete');
    }
    else
        $(_this).parents('tr').remove();
}

function fillDetails(data) {
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    //  var data = $.parseJSON(data);
    for (var j in data['details']) {
        if ($("#" + tab + " .mainForm #" + j).length > 0) {
            $("#" + tab + " .mainForm #" + j).each(function () {
                for (var k in data['details'][j]) {
                    if (data['details'][j][k][0]) {
                        var elem = $(this).find(".firstRow");
                        $(this).find('tbody').append(elem.clone().removeClass('firstRow'));
                        $(this).find('tbody tr:last').attr('id', data['details'][j][k][0]);
                        $(this).find('tbody tr:last').attr('data-action', 'update');
                        var index = 0;
                        $(this).find('tbody tr:last>td').children().each(function () {
                            if (data['details'][j][k][index])
                                setThisElement(this, data['details'][j][k][index]);
                            index++;
                        });
                    }
                }
            });
        }
        if (data['details'][j].length != 0)
            $("#" + tab + " .mainForm #" + j).find(".firstRow").css({"display": "none"});

    }

}




function checkFixDetailData()
{
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    var data = {};
    var rules = 0;
    //*****************FILL DATA IF ELEMENT'S HAVE 'NAME'
    var i = 0;
    var j = 0;
    $("#" + tab + " .mainForm .detail").each(function () {
        if ($(this).attr('id')) {
            var detId = $(this).attr('id');
            data[detId] = {};
            $(this).find('tbody tr').not(':first').each(function () {
                data[detId][j] = {};
                if (!$(this).attr('id'))
                    data[detId][j]['action'] = 'insert';
                else {
                    data[detId][j]['action'] = $(this).attr('data-action');
                    data[detId][j]['id'] = $(this).attr('id');
                }
                i = 0;

                $(this).find('.elm').each(function () {
                    var getData = getThisElement(this);
                    if (getData)
                        data[detId][j][i] = getData;
                    else
                        return;


                    /*  if ($(this).is("input")) {
                     data[detId][j][i] = this.value;
                     if ($(this).attr('required') && $.trim(this.value) == '') {
                     rules = -1;
                     $(this).css({"border-color": "red"});
                     }
                     else {
                     $(this).css({"border-color": "#ccc"});
                     }
                     i++;
                     }
                     if ($(this).is("textarea") && !($(this).hasClass("editor_my")))
                     {
                     data[detId][j][i] = this.value;
                     i++;
                     
                     }
                     
                     if ($(this).is("select"))
                     {
                     data[detId][j][i] = this.value;
                     
                     
                     if ($(this).attr('required') && $.trim(this.value) == '0')
                     {
                     
                     rules = -1;
                     $(this).css({"border-color": "red"});
                     }
                     else
                     {
                     $(this).css({"border-color": "#ccc"});
                     }
                     i++;
                     
                     }
                     
                     
                     if ($(this).hasClass("autoComplete"))
                     {
                     if ($(this).attr('required') && ($(this).find("input").attr('id') == '')) {
                     data[detId][j][i] = '';
                     rules = -1;
                     $(this).find("input").css({"border-color": "red"});
                     }
                     else {
                     data[detId][j][i] = $(this).find("input").attr('id') + "^" + $(this).find("input").val();
                     $(this).find("input").css({"border-color": "#ccc"});
                     }
                     i++;
                     
                     }
                     if ($(this).hasClass("datePick"))
                     {
                     if ($(this).attr('required') && ($(this).find("input").val() == '')) {
                     data[detId][j][i] = '';
                     rules = -1;
                     $(this).find("input").css({"border-color": "red"});
                     }
                     else {
                     data[detId][j][i] = $(this).find("input").val();
                     $(this).find("input").css({"border-color": "#ccc"});
                     }
                     i++;
                     
                     }
                     if ($(this).hasClass("fileUploader"))
                     {
                     
                     if ($(this).find(".imgUploadLink > a").attr('href'))
                     data[detId][j][i] = $(this).find(".imgUploadLink > a").attr('href');
                     else
                     data[detId][j][i] = '';
                     i++;
                     }
                     
                     if ($(this).hasClass("autoCompo")) {
                     data[detId][j][i] = $(this).find('select')[0].value;
                     if ($(this).attr('required') && $(this).find('select')[0].value == '0')
                     {
                     
                     rules = -1;
                     $(this).find('select').css({"border-color": "red"});
                     }
                     else
                     {
                     $(this).find('select').css({"border-color": "#ccc"});
                     }
                     i++;
                     }
                     
                     if ($(this).hasClass("editor"))
                     {
                     var body = $(this).find(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
                     data[detId][j][i] = body;
                     
                     }
                     */
                    i++;
                });
                j++;
            });
        }
    });
    return data;
}

function rules(_this) {
    $(_this).find("p").addClass("danger");
    return false;
}

function getThisElement(_this) {
    $(_this).find("p").removeClass("danger");
    if ($(_this).hasClass("textBox") || $(_this).hasClass("checkBox") || $(_this).hasClass("datePick")) {
        if (($(_this).hasClass("require") && $.trim($(_this).find("input").val()) == ''))
            return rules(_this);
        return $(_this).find("input").val();
    }

    else if ($(_this).hasClass("selectBox")) {
        if (($(_this).hasClass("require") && $.trim($(_this).find("select").val()) == ''))
            return rules(_this);
        return $(_this).find("select").val();
    }
    else if ($(_this).hasClass("textArea")) {
        if (($(_this).hasClass("require") && $.trim($(_this).find("textArea").text()) == ''))
            return rules(_this);
        return $(_this).find("textArea").text();
    }

    else if ($(_this).hasClass("autoComplete")) {
        if (($(_this).hasClass("require") && $.trim($(_this).find("input").attr('id')) == ''))
            return rules(_this);
        return $(_this).find("input").attr('id') + "^" + $(_this).find("input").val();
    }

    else if ($(_this).hasClass("fileUploader")) {
        if (($(_this).hasClass("require") && $.trim($(_this).find(".imgUploadLink > a").attr('href')) == ''))
            return rules(_this);
        return $(_this).find(".imgUploadLink > a").attr('href');
    }

    else if ($(_this).hasClass("autoSelect")) {
        if (($(_this).hasClass("require") && ($.trim($(_this).find("select").val()) == '' || $.trim($(_this).find("select").val()) == 0)))
            return rules(_this);
        return $(_this).find("select").val();
    }

    else if ($(_this).hasClass("editor")) {
        if (($(_this).hasClass("require") && $.trim($(_this).find(".cke_wysiwyg_frame").contents().find(".cke_editable").html()) == '<p><br></p>'))
            return rules(_this);
        return $(_this).find(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
    }

    else if ($(_this).hasClass("multiSelect")) {
        var x = [];
        $(_this).find(".mus>label").children().each(function () {
            if (this.checked)
                x.push($(this).val());
        });
        if (($(_this).hasClass("require") && $.trim(x.join()) == ''))
            return rules(_this);
        return  (x.length > 0) ? ("," + x.join() + ",") : x.join();
    }




    /* if ($(_this).is("div") && $(_this).hasClass("autoComplete"))
     return $(_this).find("input").attr('id') + "^" + $(_this).find("input").val();
     if ($(_this).is("div") && $(_this).hasClass("autoComplete"))
     return $(_this).find("input").attr('id');//+ "^" + $(_this).find("input").val();
     if ($(_this).is("div") && $(_this).hasClass("datePick"))
     return $(_this).find("input").val();
     */


    return '';
}

function setThisElement(_this, data) {
    var tab = $("#TabIndex .active >a").attr('href').replace('#', '');
    if ($(_this).hasClass("textBox") || $(_this).hasClass("datePick"))
        $(_this).find("input").val(data);
    if ($(_this).hasClass("checkBox") && data == 1) {
        _this.find("input").checked = true;
        _this.find("input").value = '1';
    }



    if ($(_this).hasClass("textArea"))
        $(_this).find("textarea").val(data);

    if ($(_this).hasClass("selectBox") || $(_this).hasClass("autoSelect")) {

        $(_this).find("select").children().each(function () {
            if (this.value == data) {

                $(this).attr('selected', 'selected');

            }
        });
    }
    if ($(_this).hasClass("multiSelect")) {
        var ch = '';
        try {
            ch = data.split(',');
        }
        catch (e) {
        }
        $(_this).find('.mus>label').children().each(function () {
            for (var k = 0; k < ch.length; k++)
            {

                if (this.value == ch[k])
                    this.checked = true;
            }
        });
    }
    if ($(_this).hasClass("fileUploader")) {
        if (data.split('.')[1] == 'jpeg')
            myCanvas(data, $(_this).find(".uploadButton")[0]);
        $(_this).find(".imgUploadLink").html($("<a href='" + data + "' target='_blank'>" + '<span class="glyphicon glyphicon glyphicon-link"  ></span>' + data.split('.')[1] + "</a>"));
        $(_this).find(".imgUploadLink").append($('<span class="glyphicon glyphicon-remove-sign deleteFile"  ></span>'));
    }
    if ($(_this).hasClass("editor")) {
        $(_this).find(".cke_wysiwyg_frame").contents().find(".cke_editable").html(data);
    }
    if ($(_this).hasClass("autoComplete")) {
        var sp = data.split('^');
        var id = sp[0];
        var txt = sp[1];
        $(_this).find("input").val(txt);
        $(_this).find("input").attr('id', id);
    }
    if ($(_this).hasClass("autoCompo")) {
        ($(_this)).find('select').val(data);
    }
}


function createPage(data) {

    var data = $.parseJSON(data);
    var form = '';
    var details = '';
    var list = '';
    var search = '';
    var serv_id = data['serv_id'];
    window.deleteButton = (data['delete'] === false) ? false : true;
    var allow_add = (data['add'] === false) ? false : true;
    var allow_edit = (data['edit'] === false) ? false : true;
    for (var i in data) {
        for (var j in data[i]) {

            switch (i) {
                case 'form_elements':
                    if (data[i][j]['type'])
                        form += exchangeDataStyle(data[i][j]);
                    break;

                case 'details':
                    details += createDetail(data[i][j], j);
                    //details += createDetail(exchangeDataStyle(data[i][j][k]));

                    break;
                case 'list_colums':
                    if (data[i][j]['title'])
                        list += "<td>" + data[i][j]['title'] + "</td>";
                    break;
                case 'search_elements':
                    if (data[i][j]['type']) {
                        var label = (data[i][j]['label']) ? data[i][j]['label'] : '';
                        search += "<li><span class='label'>" + label + "</span>" + exchangeDataStyle(data[i][j]) + "<span></li>";
                    }
                    break;

            }
        }


    }
//onclick=do_actn('e')
    var page = '';
    page += "<div id='cont' style='  display: inline-block;'><div  id='mainForm' class='mainForm' style='  display: block;float: right;' >" + form + details + "</div>";
    page += '<div class="buttonContainer clear">';
    if (allow_add)
        page += "<button  id='addButton' class='btn btn-primary addButton' onclick=do_actn('a')><span class='glyphicon glyphicon-send' aria-hidden='true'></span>ثبت</button>";
    page += "<button  id='cancelButton' class='btn btn-warning cancelButton' style='display: none;'><span class='glyphicon glyphicon-floppy-remove' aria-hidden='true'></span>انصراف</button>";
    if (allow_edit)
        page += "<button  id='editButton' class='btn btn-info editButton'  style='display: none;'><span class='glyphicon glyphicon-floppy-saved' aria-hidden='true'></span>ویرایش</button>";
    page += '</div>';

    page += '</div>';


    /*  page += '<table class="table table-hover table-striped table-condensed listx" id="listx"  title="users"  style="margin-bottom: 0px;"> ';
     page += '<thead><tr><td></td>';
     page += list;
     page += '<td style="width:10px;color:red;"><span class="glyphicon glyphicon-list-alt getListExcel " style="color: rgb(125, 253, 125);"></span></td>';
     
     page += '</tr></thead><tbody></tbody>';
     page += '<tfoot> <tr><td colspan="55"><span class="glyphicon glyphicon-step-forward navx"></span>';
     page += '<span class="glyphicon glyphicon-chevron-right navx" ></span>';
     page += ' <center style="  padding-top: 5px;">';
     page += '<span class="safhe">صفحه</span> ';
     page += ' <input type="text" min="1" id="listPage" class="listPage" value="1" >';
     page += ' <span style="float: right;margin-right:8px;margin-top:1px">  از <label for="listPage" id="resultCount" class="resultCount"></label></span>';
     page += '</center>';
     page += '<span class="glyphicon glyphicon-chevron-left navx"></span><span class="glyphicon glyphicon-step-backward navx"></span>';
     page += ' <span class="glyphicon glyphicon-repeat repeat" style="float:right;padding: 6px;margin-left: 10px;"></span>';
     page += '<select id="toOffset" class="toOffset" onchange=do_actn("l") style="float:right;width: 150px;border: 0;">';
     page += '<option value="10">10</option> <option value="30">30</option><option value="50">50</option>';
     page += '<option value="100">100</option><option value="500">500</option><option value="1000">1000</option></select>    ';
     page += '   </td></tr></tfoot></table>';
     page += '<div class="searchBox">';
     page += '   <table class="table table-hover table-striped table-condensed" style="width:100%;margin-bottom: 10px;">';
     page += ' <tbody></tbody></table></div>';
     page += '<button class="btn btn-success" onclick=do_actn("l") style="  width: 150px;margin-bottom: 100px;">جستجو<span class="glyphicon glyphicon-search"  ></span></button>';
     
     */
    page += "<div style='  border: 1px solid rgba(208, 208, 208, 0.67);margin-bottom: 5px;'>";
    page += '<table class="table table-hover table-striped table-condensed listx" id="listx"  title="users"  style="margin-bottom: 0px;"> ';
    page += '    <thead>';
    page += '        <tr>';
    page += '            <td></td>';
    page += list;
    page += '            <td style="width:10px;color:red;">';
    page += '                <span class="glyphicon glyphicon-list-alt getListExcel " style="color: white;" onclick=do_actn("g_ex")></span>';
    page += '            </td>';
    page += '        </tr>';
    page += '    </thead>';
    page += '    <tbody></tbody>';
    page += '    <tfoot> ';
    page += '        <tr>';
    page += '            <td colspan="55">';
    page += '                    <span class="glyphicon glyphicon-step-forward navx"></span>';
    page += '                    <span class="glyphicon glyphicon-chevron-right navx" ></span>';
    page += '                    <center style="  padding-top: 5px;">';
    page += '                        <span class="safhe">صفحه</span> ';
    page += '                        <input type="text" min="1" id="listPage" class="listPage" value="1" >';
    page += '                        <span style="float: right;margin-right:8px;margin-top:1px">  از <label for="listPage" id="resultCount" class="resultCount"></label></span>';
    page += '                    </center>'
    page += '                    <span class="glyphicon glyphicon-chevron-left navx"></span>';
    page += '                    <span class="glyphicon glyphicon-step-backward navx"></span>';
    page += '                    <span class="glyphicon glyphicon-repeat repeat" style="float:right;padding: 6px;margin-left: 10px;"></span>';
    page += '                    <select id="toOffset" class="toOffset small" onchange=do_actn("l") style="float:right;width: 150px;border: 0;">';
    page += '                        <option value="10">10</option>';
    page += '                        <option value="30">30</option>';
    page += '                       <option value="50">50</option>';
    page += '                        <option value="100">100</option>';
    page += '                        <option value="500">500</option>';
    page += '                        <option value="1000">1000</option>';
    page += '                    </select>';
    page += '            </td>';
    page += '        </tr>';
    page += '    </tfoot>';
    page += '</table>';
    page += '<div class="searchBox">';
    page += '    <ul style="width:100%;margin-bottom:0px;padding:0;">';
    //page += '        <tbody>';
    page += search;
    //page += '</tbody>';
    page += '    </ul>';
    page += '</div>';
    page += "</div>";
    page += '<button class="btn btn-success searchButton" onclick=do_actn("l") style="  width: 150px;margin-bottom: 100px;">جستجو<span class="glyphicon glyphicon-search"  ></span></button>';
    return (page);
}




function createDetail(data, id) {
    var detail = '<div class="blk clear ">';
    detail += "<table class='detail' id='" + id + "' >";
    detail += "    <thead>";
    detail += "<tr>";
    detail += " <td><span class='glyphicon glyphicon-plus addDetailRowButton'></span></td>";
    for (var c in data) {
        if (data[c]['type']) {
            var title = (data[c]['title']) ? data[c]['title'] : '';
            detail += "<td>" + title + "</td>";
        }
    }
    detail += "</tr>";
    detail += "</thead>";
    detail += "     <tbody>";
    detail += "<tr class='firstRow' >";
    detail += "    <td><span class='glyphicon glyphicon-minus removeRowButton'></span></td>  ";
    for (var i in data)
        if (data[i]['type'])
            detail += "<td>" + exchangeDataStyle(data[i], true) + "</td>";
    detail += "</tr>";
    detail += "     </tbody>";
    detail += "</table>";
    detail += "</div>";
    return detail;
}

function exchangeDataStyle(data, detailElelemnt) {
    var element;
    var cClass = "elm ";
    var jsEvent = (data['jsEvent']) ? " " + data['jsEvent'] : '';
    cClass += (data['cssClass']) ? " " + data['cssClass'] : '';
    cClass += (data['require']) ? " " + data['require'] : '';
    var id = (detailElelemnt) ? '' : " id= '" + data['id'] + "'";
    var label = (!(detailElelemnt) && data['title']) ? "<p>" + ((data['info']) ? "<i class='glyphicon glyphicon-info-sign' data-toggle='tooltip' data-placement='top' title='" + data['info'] + "'></i>" : '') + data['title'] + "</p>" : '';
    var label_2 = (!(detailElelemnt) && data['title']) ? "<span style='  margin-right: 5px;'>" + data['title'] + "</span>" : '';
    //var info = '';//(data['info']) ? "<i class='glyphicon glyphicon-info-sign' data-toggle='tooltip' data-placement='top' title='"+data['info']+"'></i>" : '';
    var dependency = (data['dependency']) ? ((data['type']=="autoComplete")?"onchange=":"onchange=")+"dependency(this,'"+data['dependency'][0]+"','"+data['dependency'][1]+"','"+data['dependency'][2]+"')": '';
//*************editor
    var width = (data['width']) ? data['width'] : 900;
    var height = (data['height']) ? data['height'] : 165;
    var rand_id = "rand_id" + Math.floor(Math.random() * (100000 - 1 + 1) + 1);
    //*************************************

    if (data['type'] == 'textbox') {
        element = "<div class='textBox " + cClass + "' " + id + " >";
        //element += info;
        element += label;
        element += "<input  class='form-control' type='text' " + jsEvent + " >";
        element += "</div>";
    }
    else if (data['type'] == 'password') {
        element = "<div class='textBox " + cClass + "' " + id + " >";
        // element += info;
        element += label;
        element += "<input  class='form-control' type='password' " + jsEvent + " >";
        element += "</div>";
    }
    else if (data['type'] == 'textarea') {
        element = "<div class='textArea " + cClass + "' " + id + "  >";
        //element += info;
        element += label;
        element += "<textarea  class='form-control' cols='55' rows='8'  " + jsEvent + " ></textarea>";
        element += "</div>";
    }
    else if (data['type'] == 'select') {
        element = "<div class='selectBox " + cClass + "' " + id + "  >";
        // element += info;
        element += label;
        element += "<select  class='form-control'  " + jsEvent + " >";
        for (var m in data['value']) {
            element += "<option value='" + m + "'>" + data['value'][m] + "</option>";
        }
        element += "</select>";
        element += "</div>";
    }
    else if (data['type'] == 'autoSelect') {
        element = "<div class='autoSelect " + cClass + "' " + id + "  >";
        //element += info;
        element += label;
        element += "<select "+dependency+" class='form-control' " + jsEvent + " >";
        element += "<option>لطفا انتخاب کنید</option>";
        if (data['gdd'] && data['gdd'] != '') {
            $.ajax({
                url: "services/" + data['gdd'][0] + "/gc/" + data['gdd'][1],
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
                    data = $.parseJSON(data);
                    for (var k = 0; k < data.length; k++)
                        if (data[k]['f1'])
                            element += "<option value='" + data[k]['f1'] + "'>" + data[k]['f2'] + "</option>";
                }
            });
        }
        element += "</select>";
        element += "</div>";
    }
    else if (data['type'] == 'checkbox') {
        element = "<div class='checkBox " + cClass + "' " + id + "  >";
        element += "<label style='  font-weight: initial;'>";

        // element += info;
        element += label;
        element += "<input  type='checkbox' " + jsEvent + "  >";
        element += "</label>";
        element += "</div>";
    }
    else if (data['type'] == 'autoComplete') {
        var related = (data['gdd']) ? "onkeypress=related(this,'" + data['gdd'][0] + "','" + data['gdd'][1] + "')" : '';
        element = "<div class='autoComplete " + cClass + "' " + id + " >";
        // element += info;
        element += label;
        element += "  <i class='glyphicon glyphicon-sort-by-attributes-alt'></i>";
        element += "<input  id  " +dependency + " "+ related + " " + jsEvent + "   class='form-control' >";
        element += "</div>";
    }
    else if (data['type'] == 'datePicker') {
        element = "<div class='datePick " + cClass + "' " + id + " >";
        // element += info;
        element += label;
        element += "<i class='glyphicon glyphicon-calendar'></i>";
        element += "<input type='text' class='datePicker form-control'  placeholder='تاریخ ...'   " + jsEvent + "  />";
        element += "</div>";
    }
    else if (data['type'] == 'fileUploader') {
        element = "<div class='fileUploader " + cClass + "' " + id + " >";
        // element += info;
        element += label;
        //  element += "";
        element += " <button class='btn uploadButton'  " + jsEvent + "  >آپلود فایل <i class='glyphicon glyphicon-open'></i></button><br><br>";
        element += "<input type='file'  style='  display: none;'><span class='imageHolder'></span><span class='imgUploadLink'></span>";
        element += "</div>";
    }
    else if (data['type'] == 'multiSelect') {
        element = "<div class='multiSelect  " + cClass + "' " + id + " >";
        // element += info;
        element += label;
        element += "<div class='mus'>";
        if (data['gdd'] && data['gdd'] != '') {
            $.ajax({
                url: "services/" + data['gdd'][0] + "/gc/" + data['gdd'][1],
                type: "POST",
                async: false,
                statusCode: {
                    401: function () {
                        location.reload();
                    },
                    500: function () {
                        $.growl.warning({message: "خطا  در  gdd "});
                    }
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    for (var k = 0; k < data.length; k++)
                        if (data[k]['f1']) {
                            element += "<label style='  font-weight: initial;'>";
                            element += "<input type='checkbox'  value='" + data[k]['f1'] + "'>" + data[k]['f2'] + "";
                            element += "</label><br>";
                        }
                }
            });

        }
        element += "   </div>";
        element += "</div>";
    }
    else if (data['type'] == 'editor') {
        element = "<div class='editor " + cClass + "' " + id + " >";
        // element += info;
        element += label;
        element += "<textarea cols='80' id='" + rand_id + "'  class='editor_my' rows='10'></textarea>";
        element += "<script>CKEDITOR.replace( '" + rand_id + "' );\n\
                   CKEDITOR.config.width =" + width + ";\n\
                   CKEDITOR.config.height=" + height + ";</script>";
        element += "</div>";
    }
    return element;
}

function dependency(_this,elem_id,sev_id,gc_id){
    $("#"+elem_id).find("select").find("option").remove();
    var element='';
        element += "<option>لطفا انتخاب کنید</option>";
            $.ajax({
                url: "services/" + sev_id + "/gc/" + gc_id,
                data:{'params':$(_this).val()},
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
                    data = $.parseJSON(data);
                    for (var k = 0; k < data.length; k++)
                        if (data[k]['f1'])
                            element += "<option value='" + data[k]['f1'] + "'>" + data[k]['f2'] + "</option>";
                }
            });       
         $("#"+elem_id).find("select").append(element);

}