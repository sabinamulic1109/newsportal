<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}

?>
<style type="text/css">

tr{
	border-bottom:1px solid black;
}
.submitBtn{
	padding:10px;
	cursor:pointer;
	text-transform:uppercase
}
.submitBtn:hover{
	color:#fff
}
#modal{
	top:64px;
	transform:none;
	height:calc(100vh - 115px);
	
}
.modal-content{
	height:auto;
	overflow:auto;
}
.col-sm-4 .boxq{
	color:#941046;
	width:100%;
	height:200px;
	border:1px solid #941046;
	border-radius:5px;
	padding:25px;
	text-align:center;
	cursor:pointer;
	transition:all 0.5s
}
.col-sm-4 .boxq:hover{
	transform:scale(1.1);
	color: #333;
}



</style>
<div align="left">
<div class="col-sm-10 col-sm-offset-1">
	<h2 style="text-align:center;text-transform:uppercase;font-size:2rem">We offer you full support</h2>
	<div class="row">
		<div class="col-sm-4">
			<div class="boxq">
				<i style="font-size:50px" class="fa fa-question-circle"></i>
				<p style="padding-top:25px">You have a question for us?</p>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="boxq">
				<i style="font-size:50px" class="fa fa-life-ring"></i>
				<p style="padding-top:25px">You have trouble with our application?</p>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="boxq">
				<i style="font-size:50px" class="fa fa-lightbulb"></i>
				<p style="padding-top:25px">You have a suggestion for us?</p>
			</div>
		</div>
	</div>
	<br>
	<br>
	<p> We value your opinion and think it is very important to take good care of our clients.
		That's why we offer full support to all our clients. 
		Our team is here to help you with every problem you may get. 
	</p>
	<br>
	<div style="text-align:center;padding:10px">
	<a href="https://www.vicitdigital.com/support.php" style="background-color: #941046;" target="_blank" class="submitBtn btnCheckQ">Check our list of answered questions</a>
	</div>
	<br>
	<p>If you have trouble using our application, find a bug or you have some suggestions, 
	we are here for you, just click on the button above. 
	We do out best to fully answer any question you have, in details, with easy instructions.</p>
	<br>
	<br>
	<h4 style="">Can't find what you are looking for?</h4>
	<p>Our support team is here every day for you. You have a question? We have the answer. 
	Just click on the button below and send us a message.
	</p>
	<div style="text-align:center;padding:10px">
	<a onclick="showmodal()" style="background-color: #941046;"  class="submitBtn">Ask us</a>
	</div>
	<br>
	<p>Send us a question and we will answer you in shortest time posible, with the best solution for you.
	</p>
		
</div>
<div class="col-sm-12" style="padding:0">
<br>
<br> 


<div class="modal" id="modal" tabindex="-1" role="dialog" style="overflow:scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" style="float:left;width:90%">Send us question</h3>
        <button type="button" class="close" onclick="closemodal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<h3 id="title" style="margin-top:0"></h3>
			<form action="javascript: saveAnswer()" method="post" id="spremi"> 
				<input type="hidden" name="idfaq" id="idfaq">	
				<div class="form-group">					
					<textarea class="form-control" name="message" id="message"  placeholder="Your question" required ></textarea>
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
<script language="JavaScript" type="text/javascript">

$('#message').summernote({
		tabsize: 8,
		height: 250
	});	

function showmodal(){
	//$("#modal").css('z-index','999999999999');
	$("#modal").toggle();
};

function closemodal(){ 
	$("#modal").toggle();
	
}

function saveAnswer(){
	var formData = $('#spremi').serialize();
	console.log(formData);
	 $.ajax({
		
		type:"POST",
		data:formData,
		url: "sendsupportquestion.php",
		//contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Our support has received your guestion, and we will contact you shortly with the answer.");
				$("#modal").toggle();
			}else{
				swal("Your question was not send. Please try again later.");
				console.log(data);
			}			
		}, error:function(data){
			swal("Error.");
			console.log(data);
		}
	});      
}

$(document).ready(function(){

});

</script>

