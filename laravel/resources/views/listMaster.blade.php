
<table class="table table-hover table-striped table-condensed listx" id="listx"  title="users"  style="margin-bottom: 0px;"> 
    <thead>
        <tr>
            <td></td>
            @section('listHead')
            @show
            <td style="width:10px;color:red;">
                <span class="glyphicon glyphicon-list-alt getListExcel " style="color: rgb(125, 253, 125);"></span>
            </td>
        </tr>
    </thead>
    <tbody></tbody>
    <tfoot> 
        <tr>
            <td colspan="55">              
                    <span class="glyphicon glyphicon-step-forward navx"></span>
                    <span class="glyphicon glyphicon-chevron-right navx" ></span>
                    <center style="  padding-top: 5px;">
                        <span class="safhe">صفحه</span> 
                        <input type="text" min="1" id="listPage" class="listPage" value="1" >
                        <span style="float: right;margin-right:8px;margin-top:1px">  از <label for="listPage" id="resultCount" class="resultCount"></label></span>
                    </center>
                    <span class="glyphicon glyphicon-chevron-left navx"></span>
                    <span class="glyphicon glyphicon-step-backward navx"></span>
                    <span class="glyphicon glyphicon-repeat repeat" style="float:right;padding: 6px;margin-left: 10px;"></span>
                    <select id="toOffset" class="toOffset" onchange="do_actn('l')" style="float:right;width: 150px;border: 0;">
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>           
            </td>
        </tr>
    </tfoot>
</table>



<div class="searchBox">
    <table class="table table-hover table-striped table-condensed" style="width:100%;margin-bottom: 10px;">
        <tbody> @section('search') @show </tbody>
    </table>
</div>



<button class="btn btn-success" onclick="do_actn('l')" style="  width: 150px;margin-bottom: 100px;">جستجو<span class="glyphicon glyphicon-search"  ></span></button>


