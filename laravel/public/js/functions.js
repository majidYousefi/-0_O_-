var funcParams = '';

$(document).ready(function () {
    $(".fill").click(function () {
        fill(this.name);
    });
});

function fill(funcParams)
{
    $("#mainPanel").html('');
    var data = funcParams.split("^");
    var zurl = data[0];
    for (var i = 1; i < data.length; i++)
        zurl += ((data[i] != '') ? "/" + data[i] : '');
    $(document).ready(function (e) {
        $.ajax({
            url: zurl,
            error: function (data) {
                location.reload();
            },
            success: function (data) {
                window.funcParams = funcParams;
                $("#mainPanel").html(data);

              if($(data).filter('#listx').text())
                      fillList();
                window.scrollBy(0, -1000);
            },
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
        });
     
        
    });
}
function fillList()
{
    $(document).ready(function () {
    $("#listx").append("salam");
    });

}

function sendFormAjax(func, ajForm)
{
    $(document).ready(function (e) {

        var data = checkFixData(ajForm);
        if (data == '-1')
            return;
        $.ajax({
            url: func,
            type: "post",
            data: data,
            success: function (data) {
                if (!data)
                {
                    uploadVisual(ajForm);
                    $.growl.notice({message: "عملیات با موفقیت انجام شد ."});
                    fill(window.funcParams);
                }
                else
                {
                    showMsg(data);
                }
            }
        });
    });

}
function  checkFixData(ajForm)
{
    var data = {};
    data['_token'] = csrf();
    var rules = 0;
    //*****************FILL DATA IF ELEMENT'S HAVE 'NAME'
    $("#" + ajForm + " [name]").each(function () {
        if (this.required && $.trim(this.value) == '')
        {
            rules = -1;
            $("[name='" + this.name + "']").css({"border-color": "red"});
        }
        else
            $("[name='" + this.name + "']").css({"border-color": "#ccc"});
        if (this.name)
            data[this.name] = this.value;
    });
    //*******************AUTO COMPLETE
    $(".multiSelect").each(function () {
        var x = [];
        $("#" + this.id + " input[type='checkbox']").each(function () {
            if (this.checked)
                x.push($(this).val());
        });
        if (x.length > 0)
            data[this.id] = "," + x.join() + ",";
        if (this.title == 'required' && !data[this.id])
        {
            rules = -1;
            $("#" + this.id).css({"border-color": "red"});
        }
        else
            $("[name='" + this.id + "']").css({"border-color": "#ccc"});
    });

    //************CHECK IF DONT FILL REQUIRED ELEMENTS
    if (rules == -1) {
        $.growl.error({message: " فیلد های اجباری را پر کنید !!!"});
        return -1;
    }
    //*********************IF FORM CONTAIN EDITOR
    var body = $(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
    if (body)
        data['body'] = body;
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

function  uploadVisual(form)
{
    var cont = -1;
    if ($("#" + form + " input[type='file']").length > 0)
    {
        $("#" + form + " input[type='file']").each(function () {
            if (this.value)
                cont = 1;
        });
        if (cont == -1)
            return;
        var fd = new FormData($("#" + form)[0]);
        $.ajax({
            url: "upload",
            data: fd,
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function (data) {
            }
        });
    }

}


//    showMsg(JSON.stringify({"kind":"d","title":"هشدار","msg":"فیلد های اجباری را پر کنید"}));
//   return;