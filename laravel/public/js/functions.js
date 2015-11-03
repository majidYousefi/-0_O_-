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
                window.scrollBy(0, -1000);
            }
        });
    });
}
function sendFormAjax(func, ajForm)
{
    $(document).ready(function (e) {
        var data = {};
        data['_token'] = csrf();
        var rules = 0;
        $("#" + ajForm + " [name]").each(function () {
            if (this.required && this.value == '')
                rules = -1;
            data[this.name] = this.value;
        });
        if (rules == -1) {
            $.growl.error({message: " فیلد های اجباری را پر کنید !!!"});
            return;
            //    showMsg(JSON.stringify({"kind":"d","title":"هشدار","msg":"فیلد های اجباری را پر کنید"}));
            //   return;
        }
        var body = $(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
        if (body)
            data['body'] = body;
        $.ajax({
            url: func,
            type: "post",
            data: data,
            success: function (data) {
                if (!data)
                {
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

           