<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['gallery'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';	
}
?>	
<style type="text/css">

</style>
<div align="left">
<div class="modal" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h3 class="modal-title" style="float:left;width:90%">Edit gallery title</h3>
        <button type="button" class="close" onclick="closemodal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<h3 id="title" style="margin-top:0"></h3>
			<form action="javascript:saveEdit();" method="post" id="spremi"> 
				<input type="hidden" name="idgal" id="idgal">	
				<div class="form-group">
					<input type="text" class="form-control" class="form-control" name="titleedit" id="titleedit"  placeholder="Answer" required />
				</div>
			  <button type="submit" style="background-color:#941046;color:#fff;width:100%; height:40px; border: 1px solid transparent; padding:5px; margin:5px 0;border-radius: .25rem;">SAVE</button>
			</form>

      </div>
      <div class="modal-footer">
        <a onclick="closemodal()" style="color:#000;cursor:pointer">CLOSE</a>
      </div>
    </div>
  </div>
</div>	

<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Add new gallery</h3>
<form action="addgallery.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
<input type="text" name="naslov"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Gallery Name" required> 
<input type="submit" name="Submit" value="       INSERT      " class="submitBtn" style="background-color:#941046;"> 
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
<h3 style="text-align:center;text-transform:uppercase">Added galleries</h3> 																			
<br>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<table width="100%" border="0" id="tablegallery">
<tr>
<td width="70%" style="border-bottom:#000000 solid 2px;">Title</td>
 <td width="30%" style="border-bottom:#000000 solid 2px;">Action</td>
</tr>
					
<?php

$sql = "SELECT * from galerija where naziv != 'Header' order by id DESC"; 
$result = mysqli_query ($con,$sql); 
$gallery = array();
while($row = mysqli_fetch_array($result)){
	$gallery[] = $row;				
}
?>						
					
</table>
<div class="row" id="pagesN">
<div class="col-sm-6" style="text-align:left">
	<span id="pagintxt"></span>
</div>
<div class="col-sm-6" style="text-align:right">
	<a class="pagin" id="previous" style="cursor:pointer"><i class="fa fa-angle-left" ></i> Previous</a>
	<a class="pagin" id="next" style="cursor:pointer">Next <i class="fa fa-angle-right"></i></a>
</div>
</div>
<p id="pretraga" style="margin-top:100px;position:relative">No results</p>
</div>																
</div>
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
			window.location.href = "delgal.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}

function editGallery(id,title){
	$("#idgal").val(id);
	$("#titleedit").val(title);
	$("#modal").toggle();	     
}

function closemodal(){
	$("#modal").toggle();
	
}

function saveEdit(){
	var formData = $('#spremi').serialize();
	$.ajax({
		type:"POST",
		data:formData,
		url: "editgallery.php",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Changes are saved!", {							
				}).then((value) => {
					location.reload();
				});

			}else{
				swal("Error with saving");
				console.log(data);
			}			
		}, error:function(data){
			swal("Error with saving");
			console.log(data);
		}
	});     
} 

$(document).ready(function(){
	refresh();	
});

function refresh(){
	$('#pretraga').css('display','none');
	var tabela = document.getElementById('tablegallery');
	$('#tablegallery').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");
	td1.width = "40%";	
	td1.innerHTML ="Title";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td1 = document.createElement("td");
	td1.width = "30%";	
	td1.innerHTML ="Link";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td2 = document.createElement("td");
	td2.width = "30%";	
	td2.innerHTML ="Action";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);
	
	var tr = document.createElement("tr");		
	tabela.appendChild(tr);

	var td1 = document.createElement("td");
	td1.style = "border-bottom:#999999 solid 1px;";	
	tr.appendChild(td1);
	
	var naslov = document.createElement("p");
	naslov.style="font-weight:bold";
	naslov.innerHTML='Slider';
	td1.appendChild(naslov);

	var td1 = document.createElement("td");
	td1.style = "border-bottom:#999999 solid 1px;";	
	tr.appendChild(td1);
	
	var td3 = document.createElement("td");
	td3.style = "border-bottom:#999999 solid 1px;";	
	tr.appendChild(td3);
	
	var div = document.createElement("div");
	div.className="nnP";
	td3.appendChild(div);
	
	var edit = document.createElement("a");
	edit.href = "cms.php?cms=slider";
	edit.style="color:#fff";
	edit.innerHTML="Photos";
	div.appendChild(edit);
	
	var menu = <?php echo json_encode($gallery,true); ?>;
	var duzina = menu.length;
	var koliko = document.getElementById("pagintxt");
	//console.log(duzina);
	if(duzina < 10){
		if(duzina == 0){
			koliko.innerHTML = "No results";
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
	//console.log(gr);
	
	for(i=0;i<gr;i++){
		var tr = document.createElement("tr");		
		tabela.appendChild(tr);

		var td1 = document.createElement("td");
		td1.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td1);
		
		var naslov = document.createElement("p");
		naslov.style="font-weight:bold";
		naslov.innerHTML=menu[i].naziv;
		td1.appendChild(naslov);
		
		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td2);
		
		var link = document.createElement("p");
		link.style="font-weight:bold";
		link.innerHTML='gallery.php?id='+menu[i].id;
		td2.appendChild(link);
		
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.id="edit"+menu[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		div.appendChild(edit);
		$("#edit"+menu[i].id).attr('onclick','editGallery('+menu[i].id+', \''+menu[i].naziv+'\')');
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=gallery2&&id="+menu[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Photos";
		div.appendChild(edit);
		
		var div = document.createElement("div");
		div.className="nnD";
		td3.appendChild(div);
		
		var del = document.createElement("a");
		del.id="del"+menu[i].id;
		del.style="color:#fff";
		del.innerHTML="Delete";
		div.appendChild(del);
		$("#del"+menu[i].id).attr('onclick','checkDelete('+menu[i].id+')');
		
	}
}

function pagination(page){
	var tabela = document.getElementById('tablegallery');
	$('#tablegallery').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");
	td1.width = "40%";	
	td1.innerHTML ="Title";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td1 = document.createElement("td");
	td1.width = "30%";	
	td1.innerHTML ="Link";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td3 = document.createElement("td");
	td3.width = "30%";	
	td3.innerHTML ="Action";
	td3.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td3);
	
	if(page == 1){
		var tr = document.createElement("tr");		
		tabela.appendChild(tr);

		var td1 = document.createElement("td");
		td1.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td1);
		
		var naslov = document.createElement("p");
		naslov.style="font-weight:bold";
		naslov.innerHTML='Slider';
		td1.appendChild(naslov);

		var td1 = document.createElement("td");
 		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=slider";
		edit.style="color:#fff";
		edit.innerHTML="Photos";
		div.appendChild(edit);
	}
	
	var menu = <?php echo json_encode($gallery,true); ?>;
	var duzina = menu.length;
	var koliko = document.getElementById("pagintxt");	
	var prev = page-1;
	var nextp = page+1;
	var pagesnum =  Math.ceil(duzina/10);
	var dg = ((page-1)*10)+1;
	var gr = ((page-1)*10)+10;	
	if(duzina < gr){
		if(duzina == 0){
			koliko.innerHTML = "No result";
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
		
		
		var td1 = document.createElement("td");
		td1.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td1);
		
		var naslov = document.createElement("p");
		naslov.style="font-weight:bold";
		naslov.innerHTML=menu[i].naziv;
		td1.appendChild(naslov);
		
		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td2);
		
		var link = document.createElement("p");
		link.style="font-weight:bold";
		link.innerHTML='gallery.php?id='+menu[i].id;
		td2.appendChild(link);

		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.id="edit"+menu[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		div.appendChild(edit);
		$("#edit"+menu[i].id).attr('onclick','editGallery('+menu[i].id+', \''+menu[i].naziv+'\')');
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=gallery2&&id="+menu[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Photos";
		div.appendChild(edit);
		
		var div = document.createElement("div");
		div.className="nnD";
		td3.appendChild(div);
		
		var del = document.createElement("a");
		del.id="del"+menu[i].id;
		del.style="color:#fff";
		del.innerHTML="Delete";
		div.appendChild(del);
		$("#del"+menu[i].id).attr('onclick','checkDelete('+menu[i].id+')');
		
	}
}

function search(a){
	if (a.length < 3) { 
		refresh();
		$('#pretraga').css('display','none');
		$('#tablegallery').css('display','table');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=gallery&&search="+b,
		menuType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tablegallery');
				$('#tablegallery').empty();
				$('#tablegallery').css('display','table');
				
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
				var td1 = document.createElement("td");
				td1.width = "40%";	
				td1.innerHTML ="Title";
				td1.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td1);
				var td1 = document.createElement("td");
				td1.width = "30%";	
				td1.innerHTML ="Link";
				td1.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td1);
				var td3 = document.createElement("td");
				td3.width = "30%";	
				td3.innerHTML ="Action";
				td3.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td3);
				
				var menu = data;
				var duzina = menu.length;
				for(i=0;i<duzina;i++){
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);
					
					
					var td1 = document.createElement("td");
					td1.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td1);
					
					var naslov = document.createElement("p");
					naslov.style="font-weight:bold";
					naslov.innerHTML=menu[i].naziv;
					td1.appendChild(naslov);
					
					var td2 = document.createElement("td");
					td2.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td2);
					
					var link = document.createElement("p");
					link.style="font-weight:bold";
					link.innerHTML='gallery.php?id='+menu[i].id;
					td2.appendChild(link);
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td3);
					
					var div = document.createElement("div");
					div.className="nnP";
					td3.appendChild(div);
					
					var edit = document.createElement("a");
					edit.id="edit"+menu[i].id;
					edit.style="color:#fff";
					edit.innerHTML="Edit";
					div.appendChild(edit);
					$("#edit"+menu[i].id).attr('onclick','editGallery('+menu[i].id+', \''+menu[i].naziv+'\')');
					
					var div = document.createElement("div");
					div.className="nnP";
					td3.appendChild(div);
					
					var edit = document.createElement("a");
					edit.href = "cms.php?cms=gallery2&&id="+menu[i].id;
					edit.style="color:#fff";
					edit.innerHTML="Photos";
					div.appendChild(edit);
					
					var div = document.createElement("div");
					div.className="nnD";
					td3.appendChild(div);
					
					var del = document.createElement("a");
					del.id="del"+menu[i].id;
					del.style="color:#fff";
					del.innerHTML="Delete";
					div.appendChild(del);
					$("#del"+menu[i].id).attr('onclick','checkDelete('+menu[i].id+')');
				}	
			}else{
				$('#tablegallery').css('display','none');
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
