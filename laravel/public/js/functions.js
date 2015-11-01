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
        $("#" + ajForm + " [name]").each(function () {
            data[this.name] = this.value;
        });
        var body = $(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
        if (body)
            data['body'] = body;
        $.ajax({
            url: func,
            type: "post",
            data: data,
            success: function (data) {
                if (!data)
                    fill(window.funcParams);
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
        case 'i':
            MessageType = BootstrapDialog.TYPE_INFO;
            break;
        case 'p':
            MessageType = BootstrapDialog.TYPE_PRIMARY;
            break;
        case 's':
            MessageType = BootstrapDialog.TYPE_SUCCESS;
            break;
        case 'w':
            MessageType = BootstrapDialog.TYPE_WARNING;
            break;
        case 'd':
            MessageType = BootstrapDialog.TYPE_DANGER;
            break;
        default:
            MessageType = BootstrapDialog.TYPE_DEFAULT
            break;
    }
    BootstrapDialog.show({
        type: MessageType,
        title: 'خطا  !!!!',
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

           