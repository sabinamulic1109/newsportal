<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
?>
<style>
.nnE:hover{
	color:#fff;
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
<div class="col-sm-12" style="padding:0">
<br>

<h3 style="text-align:center;text-transform:uppercase">You sent message</h3> 																			
<br>
<?php
$id=$_GET['id'];
$user = $_SESSION['id'];
$sql = "SELECT ms.status,ms.type,m.id AS msgid,m.message as poruka, m.date, m.subject, a.user as receiver, m.receiver as sid
			FROM messagestatus ms
			INNER JOIN mymessages m ON
				m.id = ms.message
			INNER JOIN admin a ON
			 a.id = m.receiver
		WHERE m.id = $id GROUP BY m.id";	
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$receiverid = $row['sid'];
?>	
<table width="100%" border="0">
<tr>
<th style="border-bottom:#000000 solid 1px;"> 
<span style="font-weight:bold"><?php echo $row["receiver"]; ?></span>  
<span style="color:#a6a3a3;font-size:10px;"><?php echo date('m/d/Y', strtotime($row["date"])); ?></span> </th>
</tr>

<tr >
<td style="padding:20px"><?php echo $row["poruka"]; ?></td>
</tr>
<?php
}
?>						
</table>
<div style="text-align:center;padding:50px">
<a onclick="sendMsg(<?php echo $receiverid; ?>)" class="nnE" style="padding:8px 20px;">SEND NEW MESSAGE</a>
</div>
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
					<label for="exampleInputEmail1">Subject</label>
					<input type="text" class="form-control" name="subject" id="subject"  placeholder="Subject"/>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Message</label>
					<textarea class="form-control" name="message" id="message"  placeholder="Message" required style="overflow:auto;resize:none" rows="4"></textarea>
				</div>
				 <button type="submit" style="background-color: #941046;" class="submitBtn">SEND</button>		
			</form>
      </div>
      <div class="modal-footer">
        <a onclick="closemodal()" style="color:#000;cursor:pointer">CLOSE</a>
      </div>
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
<script>
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
</script>