 @extends('listMaster')
@section('listHead')
<td>   -            
</td>
<td>
    شناسه
</td>
<td>
   عنوان
</td>
<td>
     گروه کاربری
</td>

@stop











@extends('formMaster')
@section('form')
<table class="table table-hover table-striped table-condensed" style="width:50%;">
    <tbody>
        <tr>
            <td><label  for="username" class="required"> نام گروه:</label></td>
             <td><input type="text"   class="form-control" required></td>
                     <td><label  for="username" class="required">گروه دسته :</label></td>
             <td><input type="text"   class="form-control" required></td>
        </tr>
        <tr>
            <td><label for="password" class="required">سرویس ها :</label></td>
             <td><?PHP echo $multiSelect; ?></td>        
        </tr>
        <tr>

    </tbody>
</table>

@stop
