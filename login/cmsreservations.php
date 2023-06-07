<?php
if($_SESSION['myusername']==''){echo header("location:index.php?msg=2");
}
if($roles['reservations'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>	
<style type="text/css">
#modal{
	top:64px;
	transform:none;
	height:calc(100vh - 115px);
	
}
.modal-content{
	height:calc(100vh - 175px);
	overflow:auto;
} 
.nnD{
	padding: 8px 15px;
}
.nnP:hover, .nnD:hover{
	color:#fff;
}

td{
	border-bottom:1px solid black;
}
th{
	padding: 15px 5px;
	border-bottom:#000000 solid 2px;
}
@media only screen and (max-width:500px){
th{
	border-bottom:#000000 solid 1px;
}
tr{
	padding:0 !important;
	float: left;
}
}
</style>
<div align="left">
<div class="col-sm-12" style="padding:0">
<br>

<h3 style="text-align:center;text-transform:uppercase">Received reservations</h3> 																			
<br>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<div class="col-sm-12" style="padding:0">
<table width="100%" border="0" class="responsive-table display" id="tablereservations">
<thead>
<tr>
<th >Dog</th>
<th >Arrival</th>
<th >Departure</th>
<th >Name</th>
<th >Mail</th>
<th >Phone</th>
<th >Message</th>
<th >Date</th>
<th >Read</th>
</tr>
</thead>
<?php
$sql = "SELECT * from reservation order by id desc"; 
$result = mysqli_query ($con,$sql); 
$reservations = array();
while($row = mysqli_fetch_array($result)){
	$reservations[] = $row;		
}
?>										
</table>
</div>

<div class="row" id="pagesN" style="z-index:-1;padding:20px 15px;">
<div class="" style="float:left;width:50%;text-align:left;padding-top:20px;">
	<span id="pagintxt"></span>
</div>
<div  style="text-align:right;float:left;width:50%;padding-top:20px;">
	<a class="pagin" id="previous" style="cursor:pointer"><i class="fa fa-angle-left" ></i> Previous</a>
	<a class="pagin" id="next" style="cursor:pointer">Next <i class="fa fa-angle-right"></i></a>
</div>
</div>
<p id="pretraga" style="margin-top:100px;position:relative">No results</p>

<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" style="float:left;width:90%">Reservation</h3>
        <button type="button" class="close" onclick="closemodal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<h3 id="title" style="margin-top:0"></h3>
			<form action="" method="post" id="spremi"> 
				<input type="hidden" name="idfaq" id="idfaq">					
				<div class="form-group">
					<label for="exampleInputEmail1">Dog name</label>
					<p id="dogname"></p>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Arrival</label>
					<p id="arrival"></p>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Departure</label>
					<p id="departure" ></p>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Client</label>
					<p id="client" ></p>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Client's email</label>
					<p id="email" ></p>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Client's phone</label>
					<p id="phone" ></p>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Message</label>
					<p id="message"></p>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Date</label>
					<p id="date" ></p>
				</div>				
			</form>
			<div style="text-align:center"><a class="nnD" id="deleteR">Delete reservation</a></div>

      </div>
      <div class="modal-footer">
        <a onclick="closemodal()" style="color:#000;cursor:pointer">CLOSE</a>
      </div>
    </div>
  </div>
</div>
		
</div>
</div><script>
function readR(id){
	/* $("#idfaq").val(id);
	$("#answeredit").val(answer); */
	
	$.ajax({
		type:"POST",
		url: "getReservation.php?id="+id,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			var rez = data[0];
			var dog = document.getElementById('dogname');
			dog.innerHTML = rez.dog;
			var arrival = document.getElementById('arrival');
			arrival.innerHTML = rez.dateArrival+','+rez.timeArrival+' h';
			var departure = document.getElementById('departure');
			departure.innerHTML = rez.dateDeparture+','+rez.timeDeparture+' h';
			var client = document.getElementById('client');
			client.innerHTML = rez.name;
			var email = document.getElementById('email');
			email.innerHTML = rez.email;
			var phone = document.getElementById('phone');
			phone.innerHTML = rez.phone;
			var message = document.getElementById('message');
			message.innerHTML = rez.message;
			var date = document.getElementById('date');
			date.innerHTML = rez.date;
			
			$('#deleteR').attr('onclick','deleteReservation('+rez.id+')');
		}, error:function(data){
			
		}
	}); 
	
	
	$("#modal").css('z-index','2');
	$(".nav-wrapper").css('z-index','-1');
	$("#modal").toggle();
};

function closemodal(){
	$("#modal").toggle();
	
}

function deleteReservation(id){
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
				url: "deleteReservation.php?id="+id,
				contentType: "application/json; charset=utf-8",
				dataType: "JSON",
				success:function (data) {
					if(data.state == 'true'){
						swal("Reservation deleted!", {	
								}).then((value) => {
								location.reload();
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

$(document).ready(function(){
	refresh();	
});

function refresh(){
	$('#pretraga').css('display','none');
	var tabela = document.getElementById('tablereservations');
	$('#tablereservations').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	
	var td = document.createElement("th");
	td.innerHTML ="Dog";
	tr.appendChild(td);
	
	var td2 = document.createElement("th");
	td2.innerHTML ="Arrival";
	tr.appendChild(td2);
	
	var td3 = document.createElement("th");
	td3.innerHTML ="Departure";
	tr.appendChild(td3);
	
	var td4 = document.createElement("th");
	td4.innerHTML ="Client";
	tr.appendChild(td4);
	
	var td5 = document.createElement("th");
	td5.innerHTML ="Email";
	tr.appendChild(td5);
	
	var td6 = document.createElement("th");
	td6.innerHTML ="Phone";
	tr.appendChild(td6);
	
	var td7 = document.createElement("th");
	td7.innerHTML ="Message";
	tr.appendChild(td7);
	
	var td8 = document.createElement("th");
	td8.innerHTML ="Date";
	tr.appendChild(td8);
	
	var td9 = document.createElement("th");
	td9.innerHTML ="Action";
	tr.appendChild(td9);
	
	var novosti = <?php echo json_encode($reservations,true); ?>;
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
		td1.style = "border-bottom:#999999 solid 1px;";	
		td1.innerHTML = novosti[i].dog;
		tr.appendChild(td1);

		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";
		td2.innerHTML = novosti[i].dateArrival+','+novosti[i].timeArrival+' h';	
		tr.appendChild(td2);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].dateDeparture+','+novosti[i].timeDeparture+' h';			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].name;			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].email;			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].phone;			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].message.substring(0,30);			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].date;			
		tr.appendChild(td3);
		
		var td4 = document.createElement("td");
		td4.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td4);
		
		var read = document.createElement("a");
		read.className="nnP"
		read.id="read"+novosti[i].id;
		read.style="color:#fff";
		read.innerHTML="Read";
		td4.appendChild(read);
		$("#read"+novosti[i].id).attr('onclick','readR('+novosti[i].id+')');
		
	}
}

function pagination(page){
	var tabela = document.getElementById('tablereservations');
	$('#tablereservations').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	
	var td = document.createElement("th");
	td.innerHTML ="Dog";
	tr.appendChild(td);
	
	var td2 = document.createElement("th");
	td2.innerHTML ="Arrival";
	tr.appendChild(td2);
	
	var td3 = document.createElement("th");
	td3.innerHTML ="Departure";
	tr.appendChild(td3);
	
	var td4 = document.createElement("th");
	td4.innerHTML ="Client";
	tr.appendChild(td4);
	
	var td5 = document.createElement("th");
	td5.innerHTML ="Email";
	tr.appendChild(td5);
	
	var td6 = document.createElement("th");
	td6.innerHTML ="Phone";
	tr.appendChild(td6);
	
	var td7 = document.createElement("th");
	td7.innerHTML ="Message";
	tr.appendChild(td7);
	
	var td8 = document.createElement("th");
	td8.innerHTML ="Date";
	tr.appendChild(td8);
	
	var td9 = document.createElement("th");
	td9.innerHTML ="Action";
	tr.appendChild(td9);
	
	var novosti = <?php echo json_encode($reservations,true); ?>;
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
		td1.style = "border-bottom:#999999 solid 1px;";	
		td1.innerHTML = novosti[i].dog;
		tr.appendChild(td1);

		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";
		td2.innerHTML = novosti[i].dateArrival+','+novosti[i].timeArrival+' h';	
		tr.appendChild(td2);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].dateDeparture+','+novosti[i].timeDeparture+' h';			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].name;			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].email;			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].phone;			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].message.substring(0,30);			
		tr.appendChild(td3);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].date;			
		tr.appendChild(td3);
		
		var td4 = document.createElement("td");
		td4.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td4);
		
		var read = document.createElement("a");
		read.className="nnP"
		read.id="read"+novosti[i].id;
		read.style="color:#fff";
		read.innerHTML="Read";
		td4.appendChild(read);
		$("#read"+novosti[i].id).attr('onclick','readR('+novosti[i].id+')');
		
	}
}

function search(a){
	if (a.length < 3) { 
		refresh();
		$('#pretraga').css('display','none');
		$('#tablereservations').css('display','block');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=reservations&&search="+b,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tablereservations');
				$('#tablereservations').empty();
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
				
				var td = document.createElement("td");
				td.innerHTML ="Dog";
				tr.appendChild(td);
				
				var td2 = document.createElement("td");
				td2.innerHTML ="Arrival";
				tr.appendChild(td2);
				
				var td3 = document.createElement("td");
				td3.innerHTML ="Departure";
				tr.appendChild(td3);
				
				var td4 = document.createElement("td");
				td4.innerHTML ="Client";
				tr.appendChild(td4);
				
				var td5 = document.createElement("td");
				td5.innerHTML ="Email";
				tr.appendChild(td5);
				
				var td6 = document.createElement("td");
				td6.innerHTML ="Phone";
				tr.appendChild(td6);
				
				var td7 = document.createElement("td");
				td7.innerHTML ="Message";
				tr.appendChild(td7);
				
				var td8 = document.createElement("td");
				td8.innerHTML ="Date";
				tr.appendChild(td8);
				
				var td9 = document.createElement("td");
				td9.innerHTML ="Action";
				tr.appendChild(td9);
				
				var novosti = data;
				var duzina = novosti.length;
				for(i=0;i<duzina;i++){
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);
					
					var td1 = document.createElement("td");
					td1.style = "border-bottom:#999999 solid 1px;";	
					td1.innerHTML = novosti[i].dog;
					tr.appendChild(td1);

					var td2 = document.createElement("td");
					td2.style = "border-bottom:#999999 solid 1px;";
					td2.innerHTML = novosti[i].dateArrival+','+novosti[i].timeArrival+' h';	
					tr.appendChild(td2);
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";
					td3.innerHTML = novosti[i].dateDeparture+','+novosti[i].timeDeparture+' h';			
					tr.appendChild(td3);
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";
					td3.innerHTML = novosti[i].name;			
					tr.appendChild(td3);
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";
					td3.innerHTML = novosti[i].email;			
					tr.appendChild(td3);
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";
					td3.innerHTML = novosti[i].phone;			
					tr.appendChild(td3);
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";
					td3.innerHTML = novosti[i].message.substring(0,30);			
					tr.appendChild(td3);
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";
					td3.innerHTML = novosti[i].date;			
					tr.appendChild(td3);
					
					var td4 = document.createElement("td");
					td4.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td4);
					
					var read = document.createElement("a");
					read.className="nnP"
					read.id="read"+novosti[i].id;
					read.style="color:#fff";
					read.innerHTML="Read";
					td4.appendChild(read);
					$("#read"+novosti[i].id).attr('onclick','readR('+novosti[i].id+')');
				}	
			}else{
				$('#tablereservations').css('display','none');
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


