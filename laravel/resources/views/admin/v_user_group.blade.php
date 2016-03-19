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
@section('search')
<tr>
<td><label > شناسه</label></td>
<td><input type="text" class="form-control"></td>
</tr>

@stop









@extends('formMaster')
@section('form')
<table class="table table-hover table-striped table-condensed" style="width:50%;">
    <tbody>
        <tr>
            <td><label  for="username" class="required"> نام گروه:</label></td>
             <td><input type="text"   class="form-control elm" id="f1" required></td>
        </tr>
        <tr>
            <td><label for="password" class="required">سرویس ها :</label></td>
            <td><div class="elm multiSelect" id="f2"><?PHP echo $multiSelect; ?></div></td>        
        </tr>
        <tr>

    </tbody>
</table>

@stop
