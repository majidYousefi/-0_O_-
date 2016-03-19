 @extends('listMaster')
    @section('listHead')
    <td></td>
    <td>id</td>
    <td>title</td>
    <td>body</td>
         @stop
         @section('search')
<input type="text" >title <br>
<input type="text" >id
@stop

@extends('formMaster')
@section('form')
<!--  <input type="text" class="datePicker form-control" placeholder="تاریخ ..."  required="required"/> -->


<table class="table table-hover table-striped table-condensed" >
    <tbody>
        <tr>
            <td><labe class="required">عنوان</labe></td>
             <td><input type="text" name="title" required="required"  class="elem form-control" id="f1"></td>

        </tr>
        <tr>
            <td>متن</td>
            <td><div class="elem editor" id='f2'>{!!  $editor2 !!}</div></td>        
        
        </tr>
    
       

    </tbody>
</table>
  @stop
  
  

  
  
