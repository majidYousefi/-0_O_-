
<table class="table table-hover table-striped table-condensed" id="listx"  title="users" > 
    <thead>
        <tr>
            @section('listHead')
            @show
        </tr>
    </thead>
    <tbody></tbody>
</table>

<div id="searchBox">
    <span class="glyphicon glyphicon-step-forward navx"></span>
    <span class="glyphicon glyphicon-chevron-right navx" ></span>
    <center style="  padding-top: 5px;">
          <span class="safhe">صفحه</span> 
          <input type="number" min="1" id="listPage" value="1" >
          <span style="float: right;margin-right:8px;margin-top:1px">  از <label for="listPage" id="resultCount"></label></span>
    </center>
    <span class="glyphicon glyphicon-chevron-left navx"></span>
    <span class="glyphicon glyphicon-step-backward navx"></span>
    <select id="toOffset" onchange="do_actn('l')">
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
          </select>
    <br><br>
    @section('search') @show
    <br>
    <button class="btn btn-success" onclick="do_actn('l')">جستجو<span class="glyphicon glyphicon-search"  ></span></button>
   <br><br><br><br>   <br><br><br><br>
</div>
