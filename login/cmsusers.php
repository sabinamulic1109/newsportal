<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['users'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<script src="cms/js/summernote-lite.js"></script>
<style type="text/css">

#roles{
	padding:5px 0;	
	display:none
}
label{
	padding-left:20px !important;
	padding-right:10px;
}
#modal{
	top:64px;
	transform:none;
	height:calc(100vh - 115px);
	
}
.modal-content{
	height:450px;
	overflow:auto;
} 

</style>
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Add new user</h3> 																			
<br>
<form action="adduser.php" method="post" enctype="multipart/form-data" name="form1" id="form1">		  
<input type="text" name="username"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Username" required> 
<input type="text" name="email"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Email" required> 
<input type="password" name="password"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Password" required> 
<input type="password" name="repeat"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Repeat password" required>
<select onchange="selectType();" name="type" id="type">
	<option disabled selected>Type of user</option>
	<option value="admin">Administrator</option>
	<option value="user">User</option>
</select>
<div id="roles">
<label  style="width:100%; text-align:left; padding:5px; margin:5px 0;">Assign what this user can manage and see!</label>
<input type="checkbox" id="settings" name="settings"/>
<label for="settings" >Settings</label>
<input type="checkbox" id="content" name="content"/>
<label for="content" >Content</label>
<input type="checkbox" id="slider" name="slider"/>
<label for="slider">Slider</label>
<input type="checkbox" id="menu" name="menu"/>
<label for="menu">Menu</label>
<input type="checkbox" id="news" name="news"/>
<label for="news">News</label>
<input type="checkbox" id="gallery" name="gallery"/>
<label for="gallery">Gallery</label>
<input type="checkbox" id="reservations" name="reservations"/>
<label for="reservations">Reservations</label>
<input type="checkbox" id="testimonials" name="testimonials"/>
<label for="testimonials">Testimonials</label>
<input type="checkbox" id="messages" name="messages"/>
<label for="messages">Messages</label>
<input type="checkbox" id="users" name="users"/>
<label for="users">Users</label>
<input type="checkbox" id="userlogs" name="userlogs"/>
<label for="userlogs">Userlogs</label>
<input type="checkbox" id="jobs" name="jobs"/>
<label for="jobs">Jobs</label>
<input type="checkbox" id="oglasi" name="oglasi"/>
<label for="oglasi">Oglasi</label>


</div>  
<input type="submit" style="background-color:#941046;" name="Submit" value="SAVE" class="submitBtn"> 	 
</form>	
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

</div>

	
<br>
<br>
<div class="col-sm-12" style="padding:0">
<br>

<h3 style="text-align:center;text-transform:uppercase">Users</h3> 																			
<br>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<table width="100%" border="0" id="tableusers">
<tr>
<td width="70%" style="border-bottom:#000000 solid 2px;"><div align="left">User</div></td>
 <td width="30%" style="border-bottom:#000000 solid 2px;"><div align="left">Action</div></td>
</tr>					
<?php
$sql = "SELECT id, user FROM `admin` WHERE `user` != 'superadmin' order by id"; 
$result = mysqli_query ($con,$sql); 
$users = array();
while($row = mysqli_fetch_array($result)){
	$users[] = $row;			
}
?>				
</table>
<div class="row" id="pagesN" style="text-align:left">
<div class="col-sm-6">
	<span id="pagintxt"></span>
</div>
<div class="col-sm-6" style="text-align:right">
	<a class="pagin" id="previous" style="cursor:pointer"><i class="fa fa-angle-left" ></i> Previous</a>
	<a class="pagin" id="next" style="cursor:pointer">Next <i class="fa fa-angle-right"></i></a>
</div>
</div>
<p id="pretraga" style="margin-top:100px;position:relative">No results</p>

<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content"  style="text-align:left">
      <div class="modal-header">
        <h3 class="modal-title" style="float:left;width:90%">Send message</h3>
        <button type="button" class="close" onclick="closemodal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<h3 id="title" style="margin-top:0"></h3>
			<form action="javascript:sendTo();" method="post" id="spremi"> 
				<input type="hidden" name="iduser" id="iduser">					
				<div class="form-group">
					<label for="exampleInputEmail1" style="padding-left:0 !important">Subject</label>
					<input type="text" class="form-control" name="subject" id="subject"  placeholder="Subject"/>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1" style="padding-left:0 !important">Message</label>
					<textarea class="form-control" name="message" id="message"  placeholder="Message" required style="overflow:auto;resize:none" rows="4"></textarea>
				</div>
				 <button style="background-color:#941046;" type="submit" class="submitBtn">SEND</button>		
			</form>
      </div>
      <div class="modal-footer">
        <a onclick="closemodal()" style="color:#000;cursor:pointer">CLOSE</a>
      </div>
    </div>
  </div>
</div>


</div>	
 <script>
	$('#message').summernote({
			tabsize: 8,
			height: 300
		});	
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
			window.location.href = "deluser.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}
function selectType(){
	var tip = $('#type').val();
	if(tip == 'user'){
		$('#roles').css('display','block');
	}else{
		$('#roles').css('display','none');
	}
}

function sendMsg(id){
	$("#iduser").val(id);
	//$("#modal").css('z-index','999999999999');
	$("#modal").toggle();
};

function closemodal(){
	$("#modal").toggle();
	
}

function sendTo(){
	var formData = $('#spremi').serialize();
	$.ajax({
		type:"POST",
		data:formData,
		url: "sendmessage.php",
		//contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Message sent!");
				console.log(data);
				$("#modal").toggle();
			}else{
				swal("Error with sending message");
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
	var tabela = document.getElementById('tableusers');
	$('#tableusers').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");
	td1.width = "70%";	
	td1.innerHTML ="User";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td2 = document.createElement("td");
	td2.width = "30%";	
	td2.innerHTML ="Action";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);

	
	var novosti = <?php echo json_encode($users,true); ?>;
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
		
		var td1 = document.createElement("td");
		td1.style = "border-bottom:#999999 solid 1px;text-align:left";	
		tr.appendChild(td1);
		
		var div = document.createElement("div");
		div.innerHTML = novosti[i].user;
		td1.appendChild(div);
		
		var poruka = document.createElement("a");
		poruka.id = "poruka"+novosti[i].id;		
		div.appendChild(poruka);

		if(novosti[i].id != <?php echo $_SESSION['id']; ?> ){
			$("#poruka"+novosti[i].id).attr('onclick','sendMsg('+novosti[i].id+')');
			var ikona = document.createElement("i");
			ikona.style = " margin-left:15px;cursor:pointer";
			ikona.className = 'fa fa-envelope';
			poruka.appendChild(ikona);
		}
		
		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td2);
		
		var edit = document.createElement("a");
		edit.href="cms.php?cms=edituser&&id="+novosti[i].id;
		edit.className = "nnP";
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		td2.appendChild(edit);
	
		if(novosti[i].id == 1 || novosti[i].id == 2 ){
			
		}else{
			var del = document.createElement("a");
			del.id="del"+novosti[i].id;
			del.className = "nnD";
			del.style="color:#fff";
			del.innerHTML="Delete";
			td2.appendChild(del);
			$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
		}
	}
}

function pagination(page){
	var tabela = document.getElementById('tableusers');
	$('#tableusers').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");
	td1.width = "70%";	
	td1.innerHTML ="User";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td2 = document.createElement("td");
	td2.width = "30%";	
	td2.innerHTML ="Action";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);
	
	var novosti = <?php echo json_encode($users,true); ?>;
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
		
		var td1 = document.createElement("td");
		td1.style = "border-bottom:#999999 solid 1px;text-align:left";	
		tr.appendChild(td1);
		
		var div = document.createElement("div");
		div.innerHTML = novosti[i].user;
		td1.appendChild(div);
		
		var poruka = document.createElement("a");
		poruka.id = "poruka"+novosti[i].id;		
		div.appendChild(poruka);

		if(novosti[i].id != <?php echo $_SESSION['id']; ?> ){
			$("#poruka"+novosti[i].id).attr('onclick','sendMsg('+novosti[i].id+')');
			var ikona = document.createElement("i");
			ikona.style = " margin-left:15px;cursor:pointer";
			ikona.className = 'fa fa-envelope';
			poruka.appendChild(ikona);
		}
		
		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td2);
		
		var edit = document.createElement("a");
		edit.href="cms.php?cms=edituser&&id="+novosti[i].id;
		edit.className = "nnP";
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		td2.appendChild(edit);
	
		if(novosti[i].id == 1 || novosti[i].id == 2 ){
			
		}else{
			var del = document.createElement("a");
			del.id="del"+novosti[i].id;
			del.className = "nnD";
			del.style="color:#fff";
			del.innerHTML="Delete";
			td2.appendChild(del);
			$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
		}	
	}
} 

function search(a){
	if (a.length < 3) { 
		refresh();
		$('#pretraga').css('display','none');
		$('#tableusers').css('display','table');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=users&&search="+b,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tableusers');
				$('#tableusers').empty();
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
				var td1 = document.createElement("td");
				td1.width = "70%";	
				td1.innerHTML ="User";
				td1.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td1);
				var td2 = document.createElement("td");
				td2.width = "30%";	
				td2.innerHTML ="Action";
				td2.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td2);
				
				var novosti = data;
				var duzina = novosti.length;
				for(i=0;i<duzina;i++){
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);
					
					var td1 = document.createElement("td");
					td1.style = "border-bottom:#999999 solid 1px;text-align:left";	
					tr.appendChild(td1);
					
					var div = document.createElement("div");
					div.innerHTML = novosti[i].user;
					td1.appendChild(div);
					
					var poruka = document.createElement("a");
					poruka.id = "poruka"+novosti[i].id;		
					div.appendChild(poruka);

					if(novosti[i].id != <?php echo $_SESSION['id']; ?> ){
						$("#poruka"+novosti[i].id).attr('onclick','sendMsg('+novosti[i].id+')');
						var ikona = document.createElement("i");
						ikona.style = " margin-left:15px;cursor:pointer";
						ikona.className = 'fa fa-envelope';
						poruka.appendChild(ikona);
					}
					
					var td2 = document.createElement("td");
					td2.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td2);
					
					var edit = document.createElement("a");
					edit.href="cms.php?cms=edituser&&id="+novosti[i].id;
					edit.className = "nnP";
					edit.style="color:#fff";
					edit.innerHTML="Edit";
					td2.appendChild(edit);
				
					if(novosti[i].id == 1 || novosti[i].id == 2 ){
						
					}else{
						var del = document.createElement("a");
						del.id="del"+novosti[i].id;
						del.className = "nnD";
						del.style="color:#fff";
						del.innerHTML="Delete";
						td2.appendChild(del);
						$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
					}
				}	
			}else{
				$('#tableusers').css('display','none');
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









