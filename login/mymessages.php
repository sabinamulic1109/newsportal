<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
$logged = $_SESSION['id'];
?>
<style type="text/css">
td,tr{
	border-bottom:1px solid black;
}
.tabs .indicator{
    background-color: #155a63;
}
 .tabs .tab a:hover{	
	color: #155a63;
}

#modal{
	top:64px;
	transform:none;
	height:calc(100vh - 115px);
	
}
.modal-content{
	height:calc(100vh - 175px);
	overflow:auto;
}  

</style>
<div align="left">
<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content"  style="text-align:left">
      <div class="modal-header">
        <h3 class="modal-title" style="float:left;width:90%">Send message</h3>
        <button type="button" class="close"  aria-label="Close" onclick="$('#modal').toggle();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<h3 id="title" style="margin-top:0"></h3>
			<form action="javascript:sendTo();" method="post" id="spremi"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Receiver</label>
					<select class="form-control" name="iduser" id="iduser">
					<?php
					$sql = "SELECT id,user FROM admin where id != 2 and id != $logged";	
					$result = mysqli_query ($con,$sql); 
					while($row = mysqli_fetch_array($result)){	
					?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['user']; ?></option>
					<?php }?>
					</select>
				</div>	
				<div class="form-group">
					<label for="exampleInputEmail1">Subject</label>
					<input type="text" class="form-control" name="subject" id="subject"  placeholder="Subject"/>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Message</label>
					<textarea class="form-control" name="message" id="message"  placeholder="Message" required style="overflow:auto;resize:none" rows="4"></textarea>
				</div>
				 <button type="submit" style="background-color: #941046;" class="submitBtn">SAVE</button>		
			</form>
      </div>
      <div class="modal-footer">
        <a style="color:#000;cursor:pointer" onclick="$('#modal').toggle();">CLOSE</a>
      </div>
    </div>
  </div>
</div>


<div class="col-sm-12" style="padding:0">
<br>
<h3 style="text-align:center;text-transform:uppercase">My messages</h3> 																			

<div style="text-align:center;margin-bottom:1.168rem">
<a  class="nnE" onclick="$('#modal').toggle();" style="padding:8px 20px;">New message</a>
<br>
</div>
<div class="row">
<div class="col-sm-12">
<ul class="tabs tab-demo z-depth-1">
  <li class="tab col s3"><a class="active" href="#test1">Inbox</a>
  </li>
  <li class="tab col s3"><a id="outboxtab" href="#test2">Outbox</a>
  </li>
  </li>
</ul>
</div>

<div class="col-sm-12">
<div id="test1" class="col-sm-12">
  <table id="tableinbox" style="margin-top:25px"> 
  <thead>
	<th>Sender</th>
	<th>Subject</th>
	<th>Date</th>
	<th>Action</th>
  </thead>
  <tbody id="tblinbox">
  </tbody>
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
	<p id="pretraga" style="position:relative">No results</p>
</div>
<div id="test2" class="col-sm-12">
  <table id="tableoutbox" style="margin-top:25px"> 
   <thead>
	<th>Receiver</th>
	<th>Subject</th>
	<th>Date</th>
	<th>Action</th>
  </thead>
  <tbody id="tbloutbox">
  </tbody>
  </table>
  <div class="row" id="pagesN2">
	<div class="col-sm-6">
		<span id="pagintxt2"></span>
	</div>
	<div class="col-sm-6" style="text-align:right">
		<a class="pagin" id="previous2" style="cursor:pointer"><i class="fa fa-angle-left" ></i> Previous</a>
		<a class="pagin" id="next2" style="cursor:pointer">Next <i class="fa fa-angle-right"></i></a>
	</div>
	</div>
	<p id="pretraga2" style="position:relative">No results</p>
</div>
</div>
</div>






</div>		
</div>
<script>
	$('#message').summernote({
			tabsize: 8,
			height: 300,
			followingToolbar: false 
		});	
</script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
	refreshInbox();	
});

function refreshInbox(){
	var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
	$.ajax({
		type:"POST",
		url: "getInbox.php?page="+1,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			$('#pretraga').css('display','none');
			var tabela = document.getElementById('tblinbox');
			$('#tblinbox').empty();
			
			var novosti = data.poruke;
			var duzina = data.broj;
			var koliko = document.getElementById("pagintxt");			
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

			for(i=0;i<gr;i++){
				var tr = document.createElement("tr");		
				tabela.appendChild(tr);
				
				var td1 = document.createElement("td");
				if(novosti[i].type == 0){
					td1.style = "font-weight:bold;color:#941046";		
				}
				td1.innerHTML = novosti[i].sender;
				tr.appendChild(td1);

				var td2 = document.createElement("td");
				if(novosti[i].type == 0){
					td2.style = "font-weight:bold;color:#941046";		
				}
				td2.innerHTML = novosti[i].subject;			
				tr.appendChild(td2);
				
				var td3 = document.createElement("td");
				if(novosti[i].type == 0){
					td3.style = "font-weight:bold;color:#941046";		
				}
				td3.innerHTML = new Date(novosti[i].date).toLocaleDateString('en-US',options);			
				tr.appendChild(td3);
				
				var td5 = document.createElement("td");
				tr.appendChild(td5);
				
				var read = document.createElement("a");
				read.className="nnP"
				read.href="cms.php?cms=receivedmsg&&id="+novosti[i].msgid;
				read.style="color:#fff";
				read.innerHTML="Read";
				td5.appendChild(read);
			}
		}, error:function(data){
			
			console.log(data);
		}
	}); 
	
}

function pagination(page){
	var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
	$.ajax({
		type:"POST",
		url: "getInbox.php?page="+page,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			$('#pretraga').css('display','none');
			var tabela = document.getElementById('tblinbox');
			$('#tblinbox').empty();
			
			var novosti = data.poruke;
			var duzina = data.broj;
			var koliko = document.getElementById("pagintxt");			
			var prev = page-1;
			var nextp = page+1;
			var pagesnum =  Math.ceil(duzina/10);
			var dg = ((page-1)*10)+1;
			var gr = ((page-1)*10)+10;	
			if(duzina < gr){
				if(duzina == 0){
					koliko.innerHTML = "No results";
				}else{
					var gr = duzina;
					koliko.innerHTML = "Showing "+dg+"-"+duzina+" of "+duzina;
				}
			}else{
				var gr = duzina;
				koliko.innerHTML = "Showing "+dg+"-"+duzina+" of "+duzina;
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
			for(i=0;i<data.poruke.length;i++){
				var tr = document.createElement("tr");		
				tabela.appendChild(tr);
				
				var td1 = document.createElement("td");
				if(novosti[i].type == 0){
					td1.style = "font-weight:bold;color:#941046";		
				}
				td1.innerHTML = novosti[i].sender;
				tr.appendChild(td1);

				var td2 = document.createElement("td");
				if(novosti[i].type == 0){
					td2.style = "font-weight:bold;color:#941046";		
				}
				td2.innerHTML = novosti[i].subject;			
				tr.appendChild(td2);
				
				var td3 = document.createElement("td");
				if(novosti[i].type == 0){
					td3.style = "font-weight:bold;color:#941046";		
				}
				td3.innerHTML = new Date(novosti[i].date).toLocaleDateString('en-US',options);			
				tr.appendChild(td3);
				
				var td5 = document.createElement("td");
				tr.appendChild(td5);
				
				var read = document.createElement("a");
				read.className="nnP"
				read.href="cms.php?cms=receivedmsg&&id="+novosti[i].msgid;
				read.style="color:#fff";
				read.innerHTML="Read";
				td5.appendChild(read); 
			}
		}, error:function(data){

			console.log(data);
		}
	});
}

$('#outboxtab').on('click', function(e){
	var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
	$.ajax({
		type:"POST",
		url: "getOutbox.php?page="+1,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			$('#pretraga2').css('display','none');
			var tabela = document.getElementById('tbloutbox');
			$('#tbloutbox').empty();
			
			var novosti = data.poruke;
			var duzina = data.broj;
			var koliko = document.getElementById("pagintxt2");			
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
			var previous = document.getElementById("previous2");
			previous.disabled = true;
			var next = document.getElementById("next2");
			if(pagesnum == 1){
				next.disabled = true;
				$('#next2').attr("onclick", "");
			}else{
				$('#next2').attr("onclick", "paginationO(2)");
			}

			for(i=0;i<gr;i++){
				var tr = document.createElement("tr");		
				tabela.appendChild(tr);
				
				var td1 = document.createElement("td");
				if(novosti[i].type == 0){
					td1.style = "font-weight:bold;color:#941046";		
				}
				td1.innerHTML = novosti[i].receiver;
				tr.appendChild(td1);

				var td2 = document.createElement("td");
				if(novosti[i].type == 0){
					td2.style = "font-weight:bold;color:#941046";		
				}
				td2.innerHTML = novosti[i].subject;			
				tr.appendChild(td2);
				
				var td3 = document.createElement("td");
				if(novosti[i].isRead == 0){
					td3.style = "font-weight:bold;color:#941046";		
				}
				td3.innerHTML = new Date(novosti[i].date).toLocaleDateString('en-US',options);			
				tr.appendChild(td3);
				
				var td5 = document.createElement("td");
				tr.appendChild(td5);
				
				var read = document.createElement("a");
				read.className="nnP"
				read.href="cms.php?cms=sentmsg&&id="+novosti[i].msgid;
				read.style="color:#fff";
				read.innerHTML="Read";
				td5.appendChild(read);
			}
		}, error:function(data){
			
			console.log(data);
		}
	}); 	
		
});

function paginationO(page){
	var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
	$.ajax({
		type:"POST",
		url: "getOutbox.php?page="+page,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			$('#pretraga').css('display','none');
			var tabela = document.getElementById('tbloutbox');
			$('#tbloutbox').empty();
			
			var novosti = data.poruke;
			var duzina = data.broj;
			var koliko = document.getElementById("pagintxt2");			
			var prev = page-1;
			var nextp = page+1;
			var pagesnum =  Math.ceil(duzina/10);
			var dg = ((page-1)*10)+1;
			var gr = ((page-1)*10)+10;	
			if(duzina < gr){
				if(duzina == 0){
					koliko.innerHTML = "No results";
				}else{
					var gr = duzina;
					koliko.innerHTML = "Showing "+dg+"-"+duzina+" of "+duzina;
				}
			}else{
				var gr = duzina;
				koliko.innerHTML = "Showing "+dg+"-"+duzina+" of "+duzina;
			}
			var previous = document.getElementById("previous2");
			if(prev > 0 ){
				previous.disabled = false;
				$('#previous2').attr("onclick", "paginationO("+prev+")");
			}else{
				previous.disabled = true;
				$('#previous2').attr("onclick", "");
			}
			var next = document.getElementById("next2");
			if(pagesnum > (nextp-1)){
				$('#next2').attr("onclick", "paginationO("+nextp+")");
				next.disabled = false;
			}else{
				$('#next2').attr("onclick", "");
			}
			for(i=0;i<data.poruke.length;i++){
				var tr = document.createElement("tr");		
				tabela.appendChild(tr);
				
				var td1 = document.createElement("td");
				if(novosti[i].type == 0){
					td1.style = "font-weight:bold;color:#941046";		
				}
				td1.innerHTML = novosti[i].receiver;
				tr.appendChild(td1);

				var td2 = document.createElement("td");
				if(novosti[i].type == 0){
					td2.style = "font-weight:bold;color:#941046";		
				}
				td2.innerHTML = novosti[i].subject;			
				tr.appendChild(td2);
				
				var td3 = document.createElement("td");
				if(novosti[i].isRead == 0){
					td3.style = "font-weight:bold;color:#941046";		
				}
				td3.innerHTML = new Date(novosti[i].date).toLocaleDateString('en-US',options);			
				tr.appendChild(td3);
				
				var td5 = document.createElement("td");
				tr.appendChild(td5);
				
				var read = document.createElement("a");
				read.className="nnP"
				read.href="cms.php?cms=sentmsg&&id="+novosti[i].msgid;
				read.style="color:#fff";
				read.innerHTML="Read";
				td5.appendChild(read); 
			}
		}, error:function(data){

			console.log(data);
		}
	});
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
</script>





