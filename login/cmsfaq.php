<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['testimonials'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<style type="text/css">

tr{
	border-bottom:1px solid black;
}
#modal{
	top:40%;	
}
</style>
<div align="left">
<div class="col-sm-8 col-sm-offset-2">
	<h3 style="text-align:center;text-transform:uppercase">Add new question</h3>
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

	<form action="addfaq.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<input type="text" name="question"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Frequently asked question" required > 
		<input type="text" name="answer"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Answer" required > 
		<input type="submit" name="Submit" value="       SAVE      " class="submitBtn" style="background-color:#941046;"> 
	</form>				
</div>
<div class="col-sm-12" style="padding:0">
<br>
<br>
<h3 style="text-align:center;text-transform:uppercase">Questions and answers</h3>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<table width="100%" border="0" id="tablequestions">
<tr>
<th class="thfaq2" style="border-bottom:#000000 solid 2px;">Question</th>
<th class="thfaq" style="border-bottom:#000000 solid 2px;">Status</th>
<th class="thfaq" style="border-bottom:#000000 solid 2px;">Visible</th>
<th class="thfaq" style="border-bottom:#000000 solid 2px;">Delete</th>
<th class="thfaqshow" >Status/Visible/Delete</th>
</tr>
<?php


$sql = "SELECT * from tblfaq order by id desc"; 
$result = mysqli_query ($con,$sql);
$questions = array(); 
while($row = mysqli_fetch_array($result)){
	$questions[] = $row;
	$odgovor = str_replace("\\", '', $row["answer"]);
	$odgovor = str_replace("'","\'", $odgovor);
?>	

<tr id="trow<?php echo $row["id"]; ?>">
<td><?php echo $row["question"]; ?></td>
<td class="tdfaq" onclick="editAnswer(<?php echo $row["id"]; ?>,'<?php echo $row["question"]; ?>','<?php echo $odgovor; ?>');" style="cursor:pointer">
<?php if($row["answer"]==null){
	echo '<p style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer">Not answered</p>';
}else{
	echo '<p style="width:80%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer">Answered</p>';	
}
?>

</td>
<td class="tdfaq">
<?php if($row["approved"]==0){
	echo '<p id="approve'.$row["id"].'" style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer" onclick="approve('.$row["id"].');">Not visible</p>';
}else{
	echo '<p id="approve'.$row["id"].'" style="width:80%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer" onclick="disapprove('.$row["id"].');">Visible</p>';	
}
?>

</td>
<td class="tdfaq">
	<p style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer" onclick="deleteQ(<?php echo $row["id"]; ?>);">Delete</p>
</td>
</tr>
<?php
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

<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" style="float:left;width:90%">Edit question and answer</h3>
        <button type="button" class="close" onclick="closemodal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<h3 id="title" style="margin-top:0"></h3>
			<form action="javascript:saveAnswer();" method="post" id="spremi"> 
				<input type="hidden" name="idfaq" id="idfaq">	
				<div class="form-group">
					<label for="exampleInputEmail1">Your answer</label>
					<textarea class="form-control" name="answeredit" id="answeredit"  placeholder="Answer" required style="overflow:auto;resize:none" rows="4"></textarea>
				</div>
			  <button type="submit" class="submitBtn" style="background-color:#941046;">SAVE</button>
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
function deleteQ(id){
	event.preventDefault();
		swal({
			title: "Are you sure?",
			text: "Once deleted, you can not recover it!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type:"POST",
				url: "delquestion.php?id="+id,
				contentType: "application/json; charset=utf-8",
				dataType: "JSON",
				success:function (data) {
					if(data.state == 'true'){
						swal("Question deleted", {							
						}).then((value) => {
							var idrow="#trow"+id;
							$(idrow).css('display','none');
						});
					}else{
						swal("Error with deleting");
					}				
				}, error:function(data){
					swal("Error with deleting");
				}
			});
      } else {
			swal("You have canceled deleting");
      }
    }); 
}

function approve(id){
	$.ajax({
		type:"POST",
		url: "approvequestion.php?id="+id,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Question aproved. Now it will be visible on your page!");
				var idrow="#approve"+id;
				var idd = "approve"+id;
				$(idrow).css('background-color','#941046');
				idrow.innerHTML = '';
				document.getElementById(idd).innerHTML ='Visible';
				jQuery(idrow).unbind('click');
				$(idrow).attr("onclick","disapprove("+id+")");
			}else{
				swal("Error with approving");
				console.log(data);
			}			
		}, error:function(data){
			swal("Error with approving");
			console.log(data);
		}
	});     
} 
function disapprove(id){
	$.ajax({
		type:"POST",
		url: "disapprovequestion.php?id="+id,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Question disaproved. Now it will not be visible on your page!");
				var idrow="#approve"+id;
				var idd = "approve"+id;
				$(idrow).css('background-color','#dc3545');
				idrow.innerHTML = '';
				document.getElementById(idd).innerHTML ='Not visible';
				jQuery(idrow).unbind('click');
				$(idrow).attr("onclick","approve("+id+")");
			}else{
				swal("Error with approving");
			}			
		}, error:function(data){
			swal("Error with approving");
		}
	});     
} 

function editAnswer(id,question, answer){
	document.getElementById('title').innerHTML =question;
	$("#idfaq").val(id);
	$("#answeredit").val(answer);
	//$("#modal").css('z-index','999999999999');
	$("#modal").toggle();
};

function closemodal(){
	$("#modal").toggle();
	
}

function saveAnswer(){
	var formData = $('#spremi').serialize();
	$.ajax({
		type:"POST",
		data:formData,
		url: "saveanswer.php",
		//contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Changes are saved!");
				$("#modal").toggle();
			}else{
				swal("Error with saving");
			}			
		}, error:function(data){
			swal("Error with saving");
		}
	});     
} 

$(document).ready(function(){
	refresh();	
});

function refresh(){
	$('#pretraga').css('display','none');
	var tabela = document.getElementById('tablequestions');
	$('#tablequestions').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");	
	td1.className = "thfaq2";
	td1.innerHTML ="Question";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	
	var td2 = document.createElement("td");	
	td2.className = "thfaq";
	td2.innerHTML ="Status";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);
	
	var td3 = document.createElement("td");	
	td3.className = "thfaq";
	td3.innerHTML ="Visible";
	td3.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td3);
	
	var td4 = document.createElement("td");	
	td4.className = "thfaq";
	td4.innerHTML ="Delete";
	td4.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td4);
	
	var td5 = document.createElement("td");	
	td5.className = "thfaqshow";
	td5.innerHTML ="Status/Visible/Delete";
	tr.appendChild(td5);
	
	var questions = <?php echo json_encode($questions,true); ?>;
	var duzina = questions.length;
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
		tr.id ="trow"+questions[i].id;	
		tabela.appendChild(tr);
		
		var td1 = document.createElement("td");
		td1.innerHTML = questions[i].question;
		tr.appendChild(td1);

		var td2 = document.createElement("td");
		td2.className ="tdfaq";	
		tr.appendChild(td2);
		
		var answ = '';
		var pap = document.createElement("td");
		pap.id = 'status'+questions[i].id;
		if(questions[i].answer == null || questions[i].answer == ''){
			pap.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
			pap.innerHTML = "Not answered";
		}else{
			answ = questions[i].answer.replace("\\", "");
			answ = answ.replace("'", "`");
			pap.style="width:80%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
			pap.innerHTML = "Answered";
		}
		td2.appendChild(pap);
		
		$('#status'+questions[i].id).attr('onclick','editAnswer('+questions[i].id+',\''+questions[i].question+'\',\''+answ+'\')');
		
		
		var td3 = document.createElement("td");
		td3.className ="tdfaq";
		tr.appendChild(td3);
		
		var paa = document.createElement("td");
		paa.id = 'approve'+questions[i].id;
		if(questions[i].approved == 0){
			paa.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
			paa.innerHTML = "Not visible";
			td3.appendChild(paa);
			$('#approve'+questions[i].id).attr('onclick','approve('+questions[i].id+')');
		}else{
			paa.style="width:80%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
			paa.innerHTML = "Visible";
			td3.appendChild(paa);
			$('#approve'+questions[i].id).attr('onclick','disapprove('+questions[i].id+')');
		}
		
		var td4 = document.createElement("td");
		td4.className ="tdfaq";	
		tr.appendChild(td4);
		
		var paa = document.createElement("td");
		paa.id = 'deleteQ'+questions[i].id;
		paa.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
		paa.innerHTML = "Delete";
		td4.appendChild(paa);
		$('#deleteQ'+questions[i].id).attr('onclick','deleteQ('+questions[i].id+')');
		
	}
}

function pagination(page){
	var tabela = document.getElementById('tablequestions');
	$('#tablequestions').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");	
	td1.className = "thfaq2";
	td1.innerHTML ="Question";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	
	var td2 = document.createElement("td");	
	td2.className = "thfaq";
	td2.innerHTML ="Status";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);
	
	var td3 = document.createElement("td");	
	td3.className = "thfaq";
	td3.innerHTML ="Visible";
	td3.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td3);
	
	var td4 = document.createElement("td");	
	td4.className = "thfaq";
	td4.innerHTML ="Delete";
	td4.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td4);
	
	var td5 = document.createElement("td");	
	td5.className = "thfaqshow";
	td5.innerHTML ="Status/Visible/Delete";
	tr.appendChild(td5);
	
	var questions = <?php echo json_encode($questions,true); ?>;
	var duzina = questions.length;
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
		tr.id ="trow"+questions[i].id;	
		tabela.appendChild(tr);
		
		var td1 = document.createElement("td");
		td1.innerHTML = questions[i].question;
		tr.appendChild(td1);

		var td2 = document.createElement("td");
		td2.className ="tdfaq";	
		tr.appendChild(td2);
		
		var pap = document.createElement("td");
		pap.id = 'status'+questions[i].id;
		var answ = '';
		if(questions[i].answer == null || questions[i].answer == ''){
			pap.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
			pap.innerHTML = "Not answered";
		}else{
			answ = questions[i].answer.replace("\\", "");
			answ = answ.replace("'", "`");
			pap.style="width:80%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
			pap.innerHTML = "Answered";
		}
		td2.appendChild(pap);
		
		$('#status'+questions[i].id).attr('onclick','editAnswer('+questions[i].id+',\''+questions[i].question+'\',\''+answ+'\')');
		
		
		var td3 = document.createElement("td");
		td3.className ="tdfaq";
		tr.appendChild(td3);
		
		var paa = document.createElement("td");
		paa.id = 'approve'+questions[i].id;
		if(questions[i].approved == 0){
			paa.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
			paa.innerHTML = "Not visible";
			td3.appendChild(paa);
			$('#approve'+questions[i].id).attr('onclick','approve('+questions[i].id+')');
		}else{
			paa.style="width:80%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
			paa.innerHTML = "Visible";
			td3.appendChild(paa);
			$('#approve'+questions[i].id).attr('onclick','disapprove('+questions[i].id+')');
		}
		
		var td4 = document.createElement("td");
		td4.className ="tdfaq";	
		tr.appendChild(td4);
		
		var paa = document.createElement("td");
		paa.id = 'deleteQ'+questions[i].id;
		paa.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
		paa.innerHTML = "Delete";
		td4.appendChild(paa);
		$('#deleteQ'+questions[i].id).attr('onclick','deleteQ('+questions[i].id+')');
		
	}
} 

function search(a){
	if (a.length < 3) { 
		refresh();
		$('#pretraga').css('display','none');
		$('#tablequestions').css('display','table');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=questions&&search="+b,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tablequestions');
				$('#tablequestions').empty();
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
				var td1 = document.createElement("td");	
				td1.className = "thfaq2";
				td1.innerHTML ="Question";
				td1.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td1);
				
				var td2 = document.createElement("td");	
				td2.className = "thfaq";
				td2.innerHTML ="Status";
				td2.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td2);
				
				var td3 = document.createElement("td");	
				td3.className = "thfaq";
				td3.innerHTML ="Visible";
				td3.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td3);
				
				var td4 = document.createElement("td");	
				td4.className = "thfaq";
				td4.innerHTML ="Delete";
				td4.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td4);
				
				var td5 = document.createElement("td");	
				td5.className = "thfaqshow";
				td5.innerHTML ="Status/Visible/Delete";
				tr.appendChild(td5);
				
				var questions = data;
				var duzina = questions.length;
				for(i=0;i<duzina;i++){
					var tr = document.createElement("tr");
					tr.id ="trow"+questions[i].id;	
					tabela.appendChild(tr);
					
					var td1 = document.createElement("td");
					td1.innerHTML = questions[i].question;
					tr.appendChild(td1);

					var td2 = document.createElement("td");
					td2.className ="tdfaq";	
					tr.appendChild(td2);
					
					var pap = document.createElement("td");
					pap.id = 'status'+questions[i].id;
					
					var answ = '';
					if(questions[i].answer == null || questions[i].answer == ''){
						pap.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
						pap.innerHTML = "Not answered";
					}else{
						answ = questions[i].answer.replace("\\", "");
						answ = answ.replace("'", "`");
						pap.style="width:80%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
						pap.innerHTML = "Answered";
					}
					td2.appendChild(pap);
					
					$('#status'+questions[i].id).attr('onclick','editAnswer('+questions[i].id+',\''+questions[i].question+'\',\''+answ+'\')');
					
					
					var td3 = document.createElement("td");
					td3.className ="tdfaq";
					tr.appendChild(td3);
					
					var paa = document.createElement("td");
					paa.id = 'approve'+questions[i].id;
					if(questions[i].approved == 0){
						paa.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
						paa.innerHTML = "Not visible";
						td3.appendChild(paa);
						$('#approve'+questions[i].id).attr('onclick','approve('+questions[i].id+')');
					}else{
						paa.style="width:80%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
						paa.innerHTML = "Visible";
						td3.appendChild(paa);
						$('#approve'+questions[i].id).attr('onclick','disapprove('+questions[i].id+')');
					}
					
					var td4 = document.createElement("td");
					td4.className ="tdfaq";	
					tr.appendChild(td4);
					
					var paa = document.createElement("td");
					paa.id = 'deleteQ'+questions[i].id;
					paa.style="width:80%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0;cursor:pointer;border-bottom: none;";
					paa.innerHTML = "Delete";
					td4.appendChild(paa);
					$('#deleteQ'+questions[i].id).attr('onclick','deleteQ('+questions[i].id+')');
				}	
			}else{
				$('#tablequestions').css('display','none');
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

