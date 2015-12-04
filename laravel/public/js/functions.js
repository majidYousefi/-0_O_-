var funcParams = '';
var last_serv_id = '';
var last_serv_actn = '';
$(document).ready(function () {
    $(".fill").click(function () {
        do_actn("s", this.name);
    });

 $.ajaxSetup({timeout:10000});



});

function do_actn(serv_actn, serv_id)
{

    switch (serv_actn)
    {
        case 's': //show page
            window.last_serv_id = serv_id;
            fill();
            break;
        case 'a': // send datat to controller to add
            uploadVisual();
            break;
        case 'e': // send datat to controller to add
            uploadVisual(serv_id);
            break;
        case 'l': // get data from controller adn create list
            fillList(0);
            break;
        case 'g': // get data from controller adn create list
            get(serv_id);
            break;
        case 'd': // get data from controller adn create list
            deleteRecord(serv_id);
            break;

    }
}

function get(id)
{

    $(document).ready(function (e) {
        var zurl = "services/" + window.last_serv_id + "/g";
        $.ajax({
            url: zurl,
            data: {"_token": csrf(), "id": id},
            type: "POST",
            error: function (data) {
                //  location.reload();
            },
            success: function (data) {
                clearForm();
                $("#addButton").fadeOut();
                $("#editButton").fadeIn().unbind().bind({
                    click: function () {
                        do_actn("e", id);

                    }
                });
                $("#cancelButton").fadeIn().unbind().bind({
                    click: function () {
                        $("#editButton").fadeOut().unbind();
                        $(this).fadeOut().unbind();
                        $("#addButton").fadeIn();
                        clearForm();

                    }
                });


                var d = new Array();
                var i = 1;
                for (var j in data[0])
                {
                    d[i] = data[0][j];
                    i++;
                }
                i = 1;

                $("#formx *").each(function () {

                    if ($(this).is("input") && !($(this).parent().hasClass("multiSelect")))
                    {
                        if ($(this).is("input[type='checkbox']") || $(this).is("input[type='radio']") && d[i] == 1)
                        {
                            this.checked = true;
                            this.value = '1';
                        }
                        else
                            $(this).val(d[i]);
                        i++;
                    }

                    else if ($(this).is("textarea"))
                    {
                        $(this).text(d[i]);
                        i++;

                    }
                    else if ($(this).is("select"))
                    {
                        $(this).children().each(function () {
                            if (this.value == d[i])
                                $(this).attr('selected', 'selected');
                        });
                        i++;

                    }
                    else if ($(this).is("div .multiSelect"))
                    {
                        var ch = d[i].split(',');
                        $(this).children().each(function () {
                            for (var k = 0; k < ch.length; k++)
                            {
                                if (this.value == ch[k])
                                    this.checked = true;
                            }
                        });
                        i++;
                    }
                    else if ($(this).hasClass("grid-container"))
                    {
                        $(".cke_wysiwyg_frame").contents().find(".cke_editable").html(d[i]);
                        i++;

                    }

                });
                window.scrollBy(0, -10000);
            }
        });


    });
}

function fill()
{
    $("#mainPanel").html('');

    $(document).ready(function (e) {
        var zurl = "services/" + window.last_serv_id + "/s";
        $.ajax({
            url: zurl,
            data: {"_token": csrf()},
            type: "POST",
            aysnc: false,
            statusCode: {
                401: function () {
                    location.reload();
                }
            },
            error: function (data) {
                //  location.reload();
            },
            success: function (data) {

                if ($(data).filter('#listx').text())
                    $.when(do_actn("l")).then($("#mainPanel").hide().fadeTo(400, 1).html(data));
                else
                    $("#mainPanel").hide().fadeTo(400, 1).html(data);



                window.scrollBy(0, -1000);

                navigation();


            }
        });


    });
}

function navigation()
{

    $("#listPage").change(function () {
        fillList();
    });

    $(".navx").click(function () {
        if ($(this).hasClass('glyphicon-step-forward'))
            $("#listPage").val('1');
        else if ($(this).hasClass('glyphicon-step-backward'))
        {
            $("#listPage").val($("#resultCount").text());
        }
        else if ($(this).hasClass('glyphicon-chevron-left')) {
            var a = $("#listPage").val();
            if ((a + 1) < $("#resultCount").text())
                ++a;
            $("#listPage").val(a);
        }
        else if ($(this).hasClass('glyphicon-chevron-right')) {
            var a = $("#listPage").val();
            if ((a - 1) >= 1)
                --a;
            $("#listPage").val(a);
        }
        $("#listPage").change();
    });
}
function fillList(from)
{
var to=10;
    $(document).ready(function () {
        if ($("#listPage").val())
            from = ($("#listPage").val() - 1) * 10;
        if($("#toOffset").val())
            to=$("#toOffset").val();
        var sData = {};
        sData['data'] = {};
        sData['op'] = {};
        if ($("#searchBox"))
            var sdata = {};
        var s = 1;
        $("#searchBox").children().each(function () {
            if (!($(this).is("#listPage")))
            {
                if ($(this).is("input"))
                {
                    sdata["s" + s] = this.value;
                    s++;
                }
            }
        });

        var zurl = "services/" + window.last_serv_id + "/l";
        $.ajax({
            url: zurl,
            type: "POST",
            aysnc: false,
            data: {"_token": csrf(), "from": from,"to":to,"data": sdata},
            success: function (data) {
                $("#listx tbody").html('');
                data = $.parseJSON(data);

                var pageCount = Math.ceil(data['count'] / to);
                if (pageCount == 0)
                    pageCount = 1;

                $("#listPage").attr("max", pageCount);
                if (pageCount < parseInt($("#resultCount").text()))
                {
                    $("#listPage").val("1");
                    //    fillList(0);
                    $("#resultCount").html(pageCount);
                    $("#listPage").change();
                    return;

                }
                $("#resultCount").html(pageCount);
                if (!data[0])
                    $("#listx tbody").html("<h4>" + "هیچ رکوردی یافت نشد !!!!" + "</h4>");
                delete data['count'];
                for (var k in data) {
                    var id = data[k]['f1'];
                    var tr = "";
                    for (var j in data[k])
                    {
                        tr += "<td>" + data[k][j] + "</td>"
                    }

                    if (tr != '')
                        $("#listx tbody").hide().fadeTo(500, 1).append("<tr>" + "<td  style='text-align: -webkit-center;'><span class='glyphicon glyphicon-remove-circle'  onclick=do_actn('d','" + id + "')></span>" + "<span class='glyphicon glyphicon-edit' onclick=do_actn('g','" + id + "')></span></td>" + tr + "</tr>");
                }

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
                var zurl = "services/" + window.last_serv_id + "/d";
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
        var ajForm = "formx";
        var data = checkFixData();
        if (data == '-1')
            return;
        if (d)
            data['files'] = d;
        var zurl = "services/" + window.last_serv_id + "/a";
        $.ajax({
            url: zurl,
            type: "post",
            data: data,
            aysnc: false,
            success: function (data) {
                if (!data)
                {
                    $.growl.notice({message: "عملیات با موفقیت انجام شد ."});
                    $.when(do_actn('l')).then(clearForm());
                    ;
                    ;
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
        var ajForm = "formx";
        var data = checkFixData(ajForm);
        data['id'] = id;
        if (d)
            data['files'] = d;

        if (data == '-1')
            return;
        var zurl = "services/" + window.last_serv_id + "/e";
        $.ajax({
            url: zurl,
            type: "post",
            data: data,
            aysnc: false,
            success: function (data) {
                if (!data)
                {
                    $.growl.notice({message: "عملیات با موفقیت انجام شد ."});
                    $("#editButton").fadeOut().unbind();
                    $("#cancelButton").fadeOut().unbind();
                    $("#addButton").fadeIn();
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
    $("#formx *").each(function () {
        if ($(this).is("input"))
        {
            if ($(this).is("input[type='checkbox']") || $(this).is("input[type='radio']"))
                this.checked = false;
            else
                this.value = '';
        }
        if ($(this).is("textarea"))
            this.value = '';
        if ($(this).is("select"))
            this.value = 0;

    });
    //*********************IF FORM CONTAIN EDITOR
    var body = $(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
    if (body)
    {
        $(".cke_wysiwyg_frame").contents().find(".cke_editable").html('');
    }
}


function  checkFixData(ajForm)
{
    var data = {};
    data['_token'] = csrf();
    var rules = 0;
    //*****************FILL DATA IF ELEMENT'S HAVE 'NAME'
    var i = 1;
    $("#formx *").each(function () {
        if ($(this).is("input") && !($(this).parent().hasClass("multiSelect")) && $(this).attr("type") !== "file")
        {
            data['f' + i] = this.value;
            i++;
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

        if ($(this).is("textarea"))
        {
            data['f' + i] = this.value;
            i++;
        }

        if ($(this).is("select"))
        {
            data['f' + i] = this.value;
            i++;

        }
        if ($(this).is("div .multiSelect"))
        {
            $(".multiSelect").each(function () {
                var x = [];
                $(this).children().each(function () {
                    if (this.checked)
                        x.push($(this).val());
                });
                if (x.length > 0)
                {
                    data["f" + i] = "," + x.join() + ",";
                    i++;
                }
                else
                {
                    data["f" + i] = x.join();
                    i++;
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
    });

    //************CHECK IF DONT FILL REQUIRED ELEMENTS
    if (rules == -1) {
        $.growl.error({message: " فیلد های اجباری را پر کنید !!!"});
        return -1;
    }
    //*********************IF FORM CONTAIN EDITOR
    var body = $(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
    if (body)
        data['f' + i] = body;
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

});
$(document).ajaxStop(function () {
    $("#ajaxLoader").css("visibility", "hidden");
});

function  uploadVisual(id)
{
    var cont = -1;
    var form = "formx";
    if ($("#" + form + " input[type='file']").length > 0)
    {
        $("#" + form + " input[type='file']").each(function () {
            if (this.value)
                cont = 1;
        });

        if (cont == -1)
        {
            if (!id)
                sendFormAjax();
            else
                editFormData(id);
            return;
        }
        var fd = new FormData($("#" + form)[0]);
        $.ajax({
            url: "upload/" + window.last_serv_id,
            data: fd,
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function (data) {
                if (!id)
                    sendFormAjax(data);
                else
                    editFormData(id, data);

            }
        });
    }
    else
    {
        if (!id)
            sendFormAjax();
        else
            editFormData(id);
    }

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
