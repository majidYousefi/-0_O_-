 @extends('listMaster')
@section('listHead')
<td>               
</td>
<td>
    شناسه
</td>
<td>
    نام سرویس
</td>

@stop


@section('search')
<input type="text" class="form-control">شناسه <br>
<input type="text" class="form-control" >نام سرویس 
@stop



@extends('formMaster')
@section('form')
<table class="table table-hover table-striped table-condensed" style="width:50%;">
    <tbody>
        <tr >
            <td><label  for="username" class="required"> نام سرویس:</label></td>

            <td><input type="text"   class="form-control" required></td>
        </tr>
    </tbody>
</table>

@stop
