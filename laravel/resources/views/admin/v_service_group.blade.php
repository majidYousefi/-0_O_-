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





