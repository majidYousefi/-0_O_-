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
    ایمیل
</td>
@stop


@section('search')
<input type="text" >title <br>
<input type="text" >id
@stop







@extends('formMaster')
@section('form')
<table class="table table-hover table-striped table-condensed" style="width:50%;">
    <tbody>
        <tr >
            <td><label  for="username" class="required"> نام کاربری:</label></td>
            <td><?PHP echo $autoComplete; ?></td>
        </tr>
        <tr>
            <td><label for="password" class=""> کلمه عبور :</label></td>
            <td><input type="password"   class="form-control" ></td>
        </tr>
        <tr>
            <td>    <label for="re_password" class=""> تکرار کلمه عبور:</label></td>
            <td><input  type="password"  class="form-control" ></td>
        </tr>
                <tr>
            <td>    <label for="re_password" class="required">گروه کاربری :</label></td>
            <td><?PHP echo $multiSelect; ?></td>
        </tr>
    <input type="file" name='u1'>

    </tbody>
</table>

@stop
