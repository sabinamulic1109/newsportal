<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['menu'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';	
}
?>
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Add new menu item</h3>
<form action="addmenu.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
<input type="text" name="naslov"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Menu" required> 
<input type="text" name="url" title="If this menu item will have Submenu, please enter #"   style="width:calc(50% - 15px); height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0; float:left" placeholder="Enter URL">
<p style="width:30px;height:40px;float:left;text-align:center;margin:5px 0;padding:7px 5px;">or</p>
<select name="urlmenu" style="width:calc(50% - 15px); height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0" placeholder="Choose menu">
<option value="">Choose from menu</option>
<?php
$sql = "SELECT * from tekst order by id"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){

$value='text.php?id='.$row["id"];
$naslov=$row["naslov"];
?>
<option value="<?php echo $value; ?>"><?php echo $naslov; ?></option>
<?php } ?>
</select> 
<!-- <input type="text" name="pozicija"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Position" title="" required> -->
	 
 <input type="submit" name="Submit" style="background-color:#941046;" value="       INSERT      " class="submitBtn"> 
				  
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
<h3 style="text-align:center;text-transform:uppercase">Your added menus</h3>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<table width="100%" border="0" id="tablemenu">
<tr>
<td width="70%" style="border-bottom:#000000 solid 2px;"><div align="left">Title</div></td>
 <td width="30%" style="border-bottom:#000000 solid 2px;"><div align="left">Action</div></td>
</tr>			
<?php
$sql = "SELECT * from grupe order by id desc"; 
$result = mysqli_query ($con,$sql); 
$menu = array();
while($row = mysqli_fetch_array($result)){
	$menu[] = $row;		
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
			window.location.href = "delmenu.php?id="+id;
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
	var tabela = document.getElementById('tablemenu');
	$('#tablemenu').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");
	td1.width = "70%";	
	td1.innerHTML ="Title";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td2 = document.createElement("td");
	td2.width = "30%";	
	td2.innerHTML ="Action";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);

	
	var menu = <?php echo json_encode($menu,true); ?>;
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

		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=menu2&&id="+menu[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		div.appendChild(edit);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=submenu&&id="+menu[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Submenu";
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
	var tabela = document.getElementById('tablemenu');
	$('#tablemenu').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");
	td1.width = "70%";	
	td1.innerHTML ="Title";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td3 = document.createElement("td");
	td3.width = "30%";	
	td3.innerHTML ="Action";
	td3.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td3);
	
	var menu = <?php echo json_encode($menu,true); ?>;
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

		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=menu2&&id="+menu[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		div.appendChild(edit);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=submenu&&id="+menu[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Submenu";
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
		$('#tablemenu').css('display','table');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=menu&&search="+b,
		menuType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tablemenu');
				$('#tablemenu').empty();
				$('#tablemenu').css('display','table');
				
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
				var td1 = document.createElement("td");
				td1.width = "70%";	
				td1.innerHTML ="Title";
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
					
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td3);
					
					var div = document.createElement("div");
					div.className="nnP";
					td3.appendChild(div);
					
					var edit = document.createElement("a");
					edit.href = "cms.php?cms=menu2&&id="+menu[i].id;
					edit.style="color:#fff";
					edit.innerHTML="Edit";
					div.appendChild(edit);
					
					var div = document.createElement("div");
					div.className="nnP";
					td3.appendChild(div);
					
					var edit = document.createElement("a");
					edit.href = "cms.php?cms=submenu&&id="+menu[i].id;
					edit.style="color:#fff";
					edit.innerHTML="Submenu";
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
				$('#tablemenu').css('display','none');
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









