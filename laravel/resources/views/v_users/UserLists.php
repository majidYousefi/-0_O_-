<table class="table table-hover table-striped table-condensed" id="listx"  title="1" > 
    <thead>
        <tr>
             <td title="p.id">
                شناسه
            </td>
            <td title="p.title">
                عنوان
            </td>
             <td title="p.body">
                متن
            </td>
             <td title="p.created_at">
                ایجاد شده در تاریخه
            </td>
             <td title="p.visted_number">
                تعداد بازدید
            </td>
                <td title="p.updated_at">
             تاریخ بروز رسانی
            </td>
                 <td title="p.sets_id">
             تاریخ بروز رسانی
            </td>
               <td title="u.email">
            username
            </td>
            
        </tr>
    </thead>

    <tbody>
        
   

   </table>
<div id="searchBox">
     <input type="number" min="1" id="listPage" value="1"><label for="listPage" id="resultCount"></label> 
              
     <br>
    
     <span>شناسه</span>  <input type="text"  name="id^>">
      <span>عنوان</span>  <input type="text"  name="title^LIKE">
     


<br>
<button class="btn btn-success" onclick="fillList()">جستجو<span class="glyphicon glyphicon-search"  ></span></button>
    
</div>
   