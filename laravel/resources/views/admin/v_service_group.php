<?PHP
$config = [
    "serv_id" => '5',
    'add' => true,
    'edit' => true,
    'delete' => true,
    'form_elements' => [
        ['type' => 'textbox', 'id' => 'f1', 'title' => 'عنوان', 'require' => 'require'],

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
<!--*****************LIST****************-->
@extends('listMaster')
    @section('listHead')

        <td>id</td>
        <td>عنوان</td>
    @stop
@section('search')
<tr>
    <td>عنوان</td>
    <td>
<input type="text"   class="form-control" > 
    </td>
</tr>
@stop


<!--*****************FROM****************-->
@extends('formMaster')
@section('form')
<table class="table table-hover table-striped table-condensed" style="width:100%;">
    <tbody>
        <tr >
            <td><label class="required" >عنوان</label></td>
            <td><input type="text" name="title" required="required"   class="form-control elm" id="f1"></td>          
        </tr>
    </tbody>
</table>


@stop



*/

