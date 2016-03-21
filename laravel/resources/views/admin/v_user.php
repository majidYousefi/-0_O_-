<?PHP
$config = [
    "serv_id" => '1',
    'add' => true,
    'edit' => true,
    'delete' => true,
    'form_elements' => [
        ['type' => 'textbox', 'id' => 'f1', 'title' => 'نام کاربری', 'require' => 'require'],
        ['type' => 'textbox', 'id' => 'f2', 'title' => 'کلمه عبور ', 'require' => 'require'],
        ['type' => 'textbox', 'id' => 'f3', 'title' =>'تکرار کلمه عبور' , 'require' => 'require'],
        ['type' => 'multiSelect', 'id' => 'f4', 'title' =>'گروه کاربری', 'require' => 'require','cssClass'=>'clear','gdd'=>['3','1']],
    ],
    'list_colums' => [
        ['title' => 'شناسه'],
        ['title' => 'عنوان'],
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
</td>
<td>
    شناسه
</td>
<td>
    یوزرنیم
</td>

<td>
    گروه کاربری
</td>
@stop


@section('search')
<tr>
    <td>
<input type="text" >title <br>
    </td>
    <td>
<input type="text" >id
    </td>
<tr>
@stop







@extends('formMaster')
@section('form')

<table class="table table-hover table-striped table-condensed" style="width:50%;">
    <tbody>
        <tr >
            <td><label  for="el1" class="required"> نام کاربری:</label></td>
            <td> <input type="text"  id="f1"  class="form-control elm" required ></td>
        </tr>
        <tr>
            <td><label for="el2" class="required"> کلمه عبور :</label></td>
            <td><input type="password"  id="f2" class="form-control elm" ></td>
        </tr>
        <tr>
            <td>    <label for="el3" class="required"> تکرار کلمه عبور:</label></td>
            <td><input  type="password" id="f3"  class="form-control elm"  ></td>
        </tr>
                <tr>
            <td>    <label for="re_password" class="required">گروه کاربری :</label></td>
            <td><div class="elm multiSelect" id="f4">{!! $multiSelect !!}</div></td>
        </tr>


    </tbody>
</table>

@stop
*/