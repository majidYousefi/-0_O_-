<?PHP

$config = [
    "serv_id" => '4',
    'add' => true,
    'edit' => true,
    'delete' => true,
    'form_elements' => [
        ['type' => 'textbox', 'id' => 'f1', 'title' => 'نام سرویس', 'require' => 'require'],
        ['type' => 'textbox', 'id' => 'f2', 'title' => 'نام کنترلر', 'require' => 'require'],
        ['type' => 'textbox', 'id' => 'f3', 'title' =>'نام مدل' , 'require' => 'require'],
        ['type' => 'textbox', 'id' => 'f4', 'title' =>'نام مایگرت', 'require' => 'require','cssClass'=>'clear'],
        ['type' => 'textbox', 'id' => 'f5', 'title' => 'نام  ویو', 'require' => 'require'],
        ['type' => 'autoSelect', 'id' => 'f6', 'title' =>'گروه سرویس ', 'require' => 'require','gdd'=>['5','1']],
        ['type' => 'checkbox', 'id' => 'f7', 'title' =>'ایجاد سیستمی','cssClass'=>'clear','info'=>'در صورت انتخاب تمامی فایل ها توسط سیستم ساخته خواهند شد.']
    ],
    'list_colums' => [
        ['title' => 'شناسه'],
        ['title' => 'عنوان']
    ],
    'search_elements' => [
        ['type' => 'textbox', 'id' => 's1', 'label' => 'شناسه', 'cssClass' => 'small'],
        ['type' => 'textbox', 'id' => 's2', 'label' => 'عنوان سرویس'],

    ]
];













/*

@extends('listMaster')
@section('listHead')

<td>
    شناسه
</td>
<td>
    نام سرویس
</td>

@stop
@section('title', 'Page Title')

@section('search')

<td><label > شناسه</label></td>
<td><input type="text" class="form-control"></td>
<td><label  >نام سرویس :</label></td>
<td><input type="text" class="form-control" ></td>

@stop



@extends('formMaster')
@section('form')
<table class="table table-hover table-striped table-condensed" style="width:100%;">
    <tbody>
        <tr >
            <td><label  for="username" class="required"> نام سرویس:</label></td>
            <td><input type="text"   class="elm form-control" id='f1' placeholder="سرویس جدید" required value='xxxx'></td>
            <td><label  for="username" class="required"> نام کنترلر:</label></td>
            <td><input type="text"  id='f2' class="elm form-control"  placeholder="new_service" required></td>
        </tr>
        <tr >
            <td><label  for="username" class="required"> نام مدل:</label></td>
            <td><input type="text"   class="elm form-control" id='f3'  placeholder="NewService" required></td>
            <td><label  for="username" class="required" required> نام مایگرت:</label></td>
            <td><input type="text"   class=" elm form-control" id='f4'   placeholder="new_service" required ></td>
        </tr>
        <tr >
            <td><label  for="username" class="required"> نام  ویو:</label></td>
            <td><input type="text"   class="elm form-control" id='f5'  placeholder="v_new_service" required ></td>
            <td><label  for="username" class="required" >گروه سرویس :</label></td>
            <td><div class="autoCompo elm" id='f6' required>{!! $gd !!}</div></td>
        </tr>

    </tbody>
</table>
{{--
<div class="autoComplete  elm" id='f3'>
    <span><span class="glyphicon glyphicon-sort-by-attributes-alt autoComplete-glyphicon" aria-hidden="true"></span>
    </span><input  id onkeydown="related(this, '3', '1')"  class="form-control" required>
</div>
--}}
{{--
<div class="fileUploader">
    <button class="btn btn-info uploadButton"  >آپلود فایل <span class="glyphicon glyphicon-open" aria-hidden="true" ></span></button>
    <input type="file"  style="  display: none;"><span class="imageHolder"></span><span class="imgUploadLink"></span>
</div>
--}}
{{--

<div class="blk">
    <span><span class="glyphicon glyphicon-calendar stickySpan" aria-hidden="true"></span></span>
    <input type="text" class="datePicker form-control"  placeholder="تاریخ ..."  required="required"/>
</div>
--}}

<!--
<table class="detail" id='d3' >
    <thead style="background-color: silver">
        <tr>
            <td style="width: 30px;"><span class="glyphicon glyphicon-plus addDetailRowButton"></span></td>
            <td>نام</td>
            <td>فامیلی</td>
        </tr>
    </thead>
    <tbody>
        <tr class="firstRow" >
            <td><span class="glyphicon glyphicon-minus removeRowButton"></span></td>
            <td><input type="text" ></td>
            <td><div class="autoComplete"  required>
                    <span><span class="glyphicon glyphicon-sort-by-attributes-alt autoComplete-glyphicon" aria-hidden="true"></span>
                    </span><input  id onkeydown="related(this, '3', '1')"   class="form-control">
                </div>
            </td>
        </tr>

    </tbody>
</table>
-->
@stop

*/