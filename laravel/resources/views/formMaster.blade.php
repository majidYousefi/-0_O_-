
<div id="cont">
    <div  id="mainForm" class="mainForm"  >
        @section('form')
        @show
    </div>

    <button  id="addButton" class="btn btn-default addButton" onclick="do_actn('a')"><span class="glyphicon glyphicon-send" aria-hidden="true"></span>ارسال</button>
    <button  id="editButton" class="btn btn-default editButton" onclick="do_actn('e')" style="display: none;"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>ویرایش</button>
    <button  id="cancelButton" class="btn btn-default cancelButton" style="display: none;"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>انصراف</button>
</div>



