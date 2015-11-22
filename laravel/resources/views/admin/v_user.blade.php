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
    پسوورد
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
            <td><label for="password" class="required"> کلمه عبور :</label></td>
            <td><input type="password"   class="form-control" required></td>
        </tr>
        <tr>
            <td>    <label for="re_password" class="required"> تکرار کلمه عبور:</label></td>
            <td><input  type="password"  class="form-control" required></td>
        </tr>

        <tr>
            <td>    <label for="re_password" class="required"> auto</label></td>
            <td> <?PHP //echo $autoComplete;  ?></td>
        </tr>
    </tbody>
</table>
<select>
    <option value="0">def</option>
    <option value="1">xxx</option>
</select>
<input  class="form-control"  type="file" name="u1"    accept="image/*" > 
<input  class="form-control"  type="file" name="u2"    accept="image/*" > 
<label for="vaziat" class="required">vaziat</label>
<?PHP //echo $multiSelect; ?>
<textarea ></textarea>
<input type="radio">radio
@stop
