function clock(){var i=new Date,o=document.getElementById("clockInput"),r=i.toString(),n=r.slice(16,18),a=r.slice(19,21),l=r.slice(22,24),e=(parseInt(n),parseInt(a)),s=parseInt(l);s%60==0||s%60==1||s%60==2?o.innerHTML="<div style='display:inline; font-size:21px; background-color:rgba(0,0,0,0.95);font-family:fantasy;  border-radius:5px; color:silver ;display:inline;'>"+n+"</div><b> : </b><div style='display:inline; text-shadow:0px 0px 7px white; font-size:21px; color:black ;font-family:fantasy;  background-color:silver; border-radius:5px;font-size:21px;'>"+a+"</div><b> : </b><div style='display:inline;  background-color:rgba(0,0,0,0.78); border-radius:5px; color:rgb(221,221,221);font-family:fantasy; font-size:21px;'>"+l+"</div>":e%60==0||e%60==1||e%60==2?o.innerHTML="<div style='display:inline; text-shadow:0px 0px 7px white; font-size:21px; color:black ;font-family:fantasy;  background-color:silver; border-radius:5px;font-size:21px;'>"+n+"</div><b> : </b><div style='display:inline;  font-family:fantasy;  background-color:rgba(0,0,0,0.87); border-radius:5px; color:silver ; font-size:21px;color:rgb(210,210,210);'>"+a+"</div><b> : </b><div style='display:inline;  background-color:rgba(0,0,0,0.78); border-radius:5px; color:rgb(221,221,221);font-family:fantasy; font-size:21px;'>"+l+"</div>":o.innerHTML="<div style='display:inline;  font-size:21px; background-color:rgba(0,0,0,0.95);font-family:fantasy;  border-radius:5px; color:silver ;'>"+n+"</div><b> : </b><div style='display:inline;  font-family:fantasy;  background-color:rgba(0,0,0,0.87); border-radius:5px; color:silver ; font-size:21px;color:rgb(210,210,210);'>"+a+"</div><b> : </b><div style='display:inline;  background-color:rgba(0,0,0,0.78); border-radius:5px;font-family:fantasy; font-size:21px;  color:rgb(221,221,221); background-color:rgb(40,40,40);'>"+l+"</div>"}var j=0;