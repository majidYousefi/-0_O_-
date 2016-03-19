@extends('listMaster')
@section('listHead')
<td>شناسه</td>
<td>عنوان</td>
@stop
@section('search')
<input type="text" >title <br>
@stop



@extends('formMaster')
@section('form')
<labe class="required">عنوان</labe>
<input type="text" name="title" required="required"  class="form-control">
@stop





