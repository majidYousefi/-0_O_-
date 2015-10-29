@extends('adminMaster')
<script>
    

   function filter(work)
    {  
        //alert(work);
            $.ajax({
                url: 'filter',
                type: 'GET',
                data:{"work":work},
                success: function(data)
                {
                    $("#main").html(data);
                }
            });
     
   }
   
   
   
  
            
</script>
@section('body')

@stop

@section('table')
@stop

@section('rightPanleMenu')
<button onclick="filter('newPost')">new post</button>
<hr>
<button onclick="filter('allPost')">allpost</button>
<hr>
<button onclick="filter('uploadImage')">photo Archive</button>
<hr>
<button onclick="filter('allPhotos')">all photos</button>
@stop


@section('main')
<div id="main">
    
</div>
@stop





