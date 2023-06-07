<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['news'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<script src="cms/js/summernote-lite.js"></script>
<style type="text/css">

.imgShow button{
	background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}
.imgShow img{
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.imgShow i{
	color:#a82626;
	font-size:24px;
	padding:5px;
}
#delete{
	display:none;
	position:absolute;
	z-index:1;
}

#delete1{
	display:none;
	position:absolute;
	z-index:1;
}

#pagintxt{
	color:#000;
}
.nnD{
	cursor:pointer;
}

#modalshare{
	max-height:calc(100vh - 170px);
	min-height:calc(100vh - 170px);
}

#modalshare .modal-dialog{
	margin-top:5px;
	width:70vw;
}

#modalshare .modal-dialog .modal-content .modal-body{
	min-height:calc(75vh - 180px);
	max-height:calc(75vh - 180px); 
	overflow-y:scroll; 
}

@media only screen and (max-width: 600px) {
	.flat-toggle.on > span {
		display:none;
	}
	#modalshare{
		top:54px;
		max-height:calc(100vh - 150px);
		min-height:calc(100vh - 150px);
	}
	#modalshare .modal-dialog{
		margin-top:5px;
		width:95vw;
	}
	
	#modalshare .modal-dialog .modal-content {

	}
	
	#modalshare .modal-dialog .modal-content .modal-body{
		min-height:calc(65vh - 150px);
		max-height:calc(65vh - 150px); 
		overflow-y:scroll; 
	}
	
	#modalshare .modal-dialog .modal-content .modal-header .col .header{
		font-size:12px;
	}
}
</style>


<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Add new product group</h3>
<form action="addproductgroup.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<label>Group name:</label>
<input type="text" name="name"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Group Name" required > 





<input type="submit" style="background-color:#941046;" name="Submit" value="       INSERT      " class="submitBtn"> 
	    
		  
<?php
if(isset($_SESSION['msg'])){
	/*$msg2='<div class="alert alert-success">
	<strong>'.$_SESSION['msg'].'</strong>
	</div>'; 
	echo $msg2;*/
	$msg=$_SESSION['msg'];
	echo '<script language="JavaScript" type="text/javascript">swal("'.$msg.'");</script>';
	unset($_SESSION['msg']);
	$msg="";
}

if(isset($_SESSION['msg2'])){
	/*$msg2='<div class="alert alert-warning">
	<strong>'.$_SESSION['msg2'].'</strong>
	</div>'; 
	echo $msg2;*/
	$msg=$_SESSION['msg2'];
	echo '<script language="JavaScript" type="text/javascript">swal("'.$msg.'");</script>';
	unset($_SESSION['msg2']);
	$msg="";
}

?>
	  				
  	</form>
</div>	

<div class="col-sm-12" style="padding:0">
<br>
<br>
<h3 style="text-align:center;text-transform:uppercase">Your added product groups</h3>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<table width="100%" border="0" id="tablenews">
<tr>
<td width="80%" style="border-bottom:#000000 solid 2px;">Name</td>

 <td width="20%" style="border-bottom:#000000 solid 2px;">Action</td>
</tr>				
<?php
$sql = "SELECT id, naziv from shop_group order by id desc"; 
$result = mysqli_query ($con,$sql);
$novosti = array(); 
while($row = mysqli_fetch_array($result)){
	$novosti[] = $row;				
}
?>										
</table>
<div class="row" id="pagesN">
<div class="col-sm-6">
	<span id="pagintxt"></span>
</div>
<div class="col-sm-6" style="text-align:right">
	<a class="pagin" id="previous" style="cursor:pointer"><i class="fa fa-angle-left" ></i> Previous</a>
	<a class="pagin" id="next" style="cursor:pointer">Next <i class="fa fa-angle-right"></i></a>
</div>
</div>
<p id="pretraga" style="margin-top:100px;position:relative">No results</p>
</div>			
 <script>
	$('#editor').summernote({
			tabsize: 8,
			height: 300
		});	
</script>
</div>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
	document.getElementById('delete').style.display="block";
	document.getElementById('output').style.display="block";
  };
  
  function hide(){
	  document.getElementById('output').style.display="none";
	  document.getElementById('delete').style.display="none";
	  
	  var file = document.getElementById("file");
	  file.value = file.defaultValue;
  }
  
  
   var loadFile1 = function(event) {
    var output = document.getElementById('output1');
    output.src = URL.createObjectURL(event.target.files[0]);
	document.getElementById('delete1').style.display="block";
	document.getElementById('output1').style.display="block";
  };

  

  function hide1(){
	  document.getElementById('output1').style.display="none";
	  document.getElementById('delete1').style.display="none";
	  var file = document.getElementById("file1");
	  file.value = file.defaultValue;
  }
</script>
<script language="JavaScript" type="text/javascript">
function checkDelete(id){
	event.preventDefault();
		swal({
			title: "Are you sure?",
			text: "Once deleted, you can not recover it!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
		if (willDelete) {
			window.location.href = "delProductGroup.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}






$(document).ready(function(){
	refresh();	
	
	
});


function refresh(){
	$('#pretraga').css('display','none');
	var tabela = document.getElementById('tablenews');
	$('#tablenews').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);

	var td2 = document.createElement("td");
	td2.width = "80%";	
	td2.innerHTML ="Title";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);
	var td3 = document.createElement("td");
	td3.width = "20%";	
	td3.innerHTML ="Action";
	td3.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td3);
	
	var novosti = <?php echo json_encode($novosti,true); ?>;
	var duzina = novosti.length;
	var koliko = document.getElementById("pagintxt");			
	if(duzina < 10){
		if(duzina == 0){
			koliko.innerHTML = "No projects";
		}else{
			var gr = duzina;
			koliko.innerHTML = "Showing 1-"+duzina+" of "+duzina;
		}
	}else{
		var gr = 10;
		koliko.innerHTML = "Showing 1-10 of "+duzina;
	}
	var pagesnum =  Math.ceil(duzina/10);
	var previous = document.getElementById("previous");
	previous.disabled = true;
	var next = document.getElementById("next");
	if(pagesnum == 1){
		next.disabled = true;
		$('#next').attr("onclick", "");
	}else{
		$('#next').attr("onclick", "pagination(2)");
	}
	
	
	for(i=0;i<gr;i++){
		var tr = document.createElement("tr");		
		tabela.appendChild(tr);
		

		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td2);
		
		var naslov = document.createElement("p");
		naslov.style="font-weight:bold";
		naslov.innerHTML=novosti[i].naziv;
		td2.appendChild(naslov);
		

		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=products5&&id="+novosti[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		div.appendChild(edit);
		
		var div = document.createElement("div");
		div.className="nnD";
		td3.appendChild(div);
		
		var del = document.createElement("a");
		del.id="del"+novosti[i].id;
		del.style="color:#fff";
		del.innerHTML="Delete";
		div.appendChild(del);
		$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
		
	}
}

function pagination(page){
	var tabela = document.getElementById('tablenews');
	$('#tablenews').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);

	var td2 = document.createElement("td");
	td2.width = "80%";	
	td2.innerHTML ="Title";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);
	var td3 = document.createElement("td");
	td3.width = "20%";	
	td3.innerHTML ="Action";
	td3.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td3);
	
	var novosti = <?php echo json_encode($novosti,true); ?>;
	var duzina = novosti.length;
	var koliko = document.getElementById("pagintxt");	
	var prev = page-1;
	var nextp = page+1;
	var pagesnum =  Math.ceil(duzina/10);
	var dg = ((page-1)*10)+1;
	var gr = ((page-1)*10)+10;	
	if(duzina < gr){
		if(duzina == 0){
			koliko.innerHTML = "No projects";
		}else{
			var gr = duzina;
			koliko.innerHTML = "Showing "+dg+"-"+duzina+" of "+duzina;
		}
	}else{
		koliko.innerHTML = "Showing "+dg+"-"+gr+" of "+duzina;
	}
	var previous = document.getElementById("previous");
	if(prev > 0 ){
		previous.disabled = false;
		$('#previous').attr("onclick", "pagination("+prev+")");
	}else{
		previous.disabled = true;
		$('#previous').attr("onclick", "");
	}
	var next = document.getElementById("next");
	if(pagesnum > (nextp-1)){
		$('#next').attr("onclick", "pagination("+nextp+")");
		next.disabled = false;
	}else{
		$('#next').attr("onclick", "");
	}
	
	for(i=(dg-1);i<gr;i++){
		var tr = document.createElement("tr");		
		tabela.appendChild(tr);
		

		
		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td2);
		
		var naslov = document.createElement("p");
		naslov.style="font-weight:bold";
		naslov.innerHTML=novosti[i].naziv;
		td2.appendChild(naslov);
		

		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=products5&&id="+novosti[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		div.appendChild(edit);
		
		var div = document.createElement("div");
		div.className="nnD";
		td3.appendChild(div);
		
		var del = document.createElement("a");
		del.id="del"+novosti[i].id;
		del.style="color:#fff";
		del.innerHTML="Delete";
		div.appendChild(del);
		$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
		
	}
}

function search(a){
	if (a.length < 3) { 
		refresh();
		$('#pretraga').css('display','none');
		$('#tablenews').css('display','table');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=productGroup&&search="+b,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tablenews');
				$('#tablenews').empty();
				$('#tablenews').css('display','table');
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
			
				var td2 = document.createElement("td");
				td2.width = "80%";	
				td2.innerHTML ="Title";
				td2.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td2);
				var td3 = document.createElement("td");
				td3.width = "20%";	
				td3.innerHTML ="Action";
				td3.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td3);
				
				var novosti = data;
				var duzina = novosti.length;
				for(i=0;i<duzina;i++){
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);

					var td2 = document.createElement("td");
					td2.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td2);
					
					var naslov = document.createElement("p");
					naslov.style="font-weight:bold";
					naslov.innerHTML=novosti[i].naziv;
					td2.appendChild(naslov);

					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td3);
					
					var div = document.createElement("div");
					div.className="nnP";
					td3.appendChild(div);
					
					var edit = document.createElement("a");
					edit.href = "cms.php?cms=products5&&id="+novosti[i].id;
					edit.style="color:#fff";
					edit.innerHTML="Edit";
					div.appendChild(edit);
					
					var div = document.createElement("div");
					div.className="nnD";
					td3.appendChild(div);
					
					var del = document.createElement("a");
					del.id="del"+novosti[i].id;
					del.style="color:#fff";
					del.innerHTML="Delete";
					div.appendChild(del);
					$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
				}	
			}else{
				$('#tablenews').css('display','none');
				$('#pagesN').css('display','none');
				$('#pretraga').css('display','block');
			}		
		}, error:function(data){
			
			console.log(data);
		}
	}); 
	}
}
</script>