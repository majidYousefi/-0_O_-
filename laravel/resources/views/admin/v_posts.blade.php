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
<labe class="required">عنوان</labe>
<input type="text" name="title" required="required"  class="form-control">
<labe class="required">متن</labe>
    <?php echo $editor ?>
  @stop
  
  

  
  
