var lastFunc = '';
var lastExtraData = '';
function fill(func, extra_data)
{
    var zurl = func + ((extra_data != '') ? "/" + extra_data : '');
    $("#mainPanel").html('');
    $(document).ready(function (e) {
        $.ajax({
            url: zurl,
            beforeSend: function () {
                //   ajaxtStart();
            },
            success: function (data) {
                window.lastFunc = func;
                window.lastExtraData = extra_data;
                $("#mainPanel").html(data);
                window.scrollBy(0, -1000);
                //ajaxComplete();
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
            data,
                    success: function (data) {
                        fill(window.lastFunc, window.lastExtraData);
                    }
        });
    });

}
           