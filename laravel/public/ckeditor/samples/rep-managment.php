
<!DOCTYPE html>
<!--
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or http://ckeditor.com/license
-->
<html>
<head>
<style type="text/css">
body
{
background-color:rgb(202,202,202);
}
textarea
{
margin-left:45px;
font-family:monospace;

}
input[type="submit"]
{
margin-left:550px;
width:85px;
font-family:monospace;
font-size:20px;
}
input[name="title"]
{
font-size:16px;

}
</style>
	<title></title>
	<meta charset="utf-8">
	<script src="../ckeditor.js"></script>
	<link rel="stylesheet" href="sample.css">
<script language="javascript">

function sub()
{
var d=document.forms[0];
var t=document.getElementById('tt');
var title=document.getElementById('title');
title.value=t.value;
var s=document.getElementById('setlist');

var setid=document.getElementById('setid');
setid.value=s.value;

d.submit();
}

function a()
{
	
	var setlist=document.getElementById('setlist');
	if( setlist.length<=1)
	{
	<?php 
$server=mysql_connect("localhost","majid","");
mysql_select_db("test",$server);
$s=mysql_query("select count('id') from `set`",$server);
$i=mysql_result($s,0,0);
 echo (" var x=$i;");  ?>

var d=new Array();
var id=new Array();
<?php 
$name=mysql_query("select * from `set`",$server);
for($v=0;$v<$i;$v++)
{
$n[$v]=mysql_result($name,$v,1);
$di[$v]=mysql_result($name,$v,0);
echo(" d[$v]='$n[$v]';
id[$v]='$di[$v]';
");	
}
?>
for(var i=0;i<x;i++)
{
	
	var op=document.createElement("option");
op.appendChild(document.createTextNode(d[i]) );
	op.setAttribute("value",id[i]);
	setlist.appendChild(op);
	var si =document.getElementById('setid');
	
	var chek=1;
}
	}
}
</script>

</head>
<body>
<?php
$server=mysql_connect("localhost","majid","");
mysql_select_db("test",$server);	
$id=$_POST['id'];
$r=mysql_query("select `body` from `articles` where `id`='$id' ",$server);	
$body=mysql_result($r,0,0);
$title=$_POST['title'];
$setname=$_POST['setname'];
$setid=$_POST['setid'];
?>	
<table border='1'>
		
	
	<form action="..\..\database.php" method="post">

	<tr><td><b>Title:</b> <input id='tt' type='text' name='tit' required='required' placeholder=<?php echo $title ; ?> autocomplete='none' value=<?php echo $title ; ?> ><select onfocus='a()' id='setlist' name="setlist">
<option value=<?php echo $setid ; ?> ><?php echo $setname ; ?>  </option>

</select></td></td>	
			
			<tr><td><textarea class="ckeditor" cols="80" id="editor1" name="body" rows="10">
				<?php echo $body; ?>
			</textarea></td></tr>
		
<input type='hidden' name='chek' value="edit-article">
<input type='hidden' name='setid' value='' id='setid' >
	
<input type='hidden' name='id' value=<?php echo $id ; ?> >
<input type="hidden" name="title" value="" id="title">
<input type='hidden' name='type' value='nothing'>	
			<tr><td><input type="button" onclick='sub()' value="Save"></td></tr>
		
	</form>
</table>
	<div id="footer">
		<hr>
		
		
	
</body>
</html>
