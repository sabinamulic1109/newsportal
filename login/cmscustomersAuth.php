<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['messages'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';	
}
?>
<style type="text/css">
td,tr{
	border-bottom:1px solid black;
}

</style>
<div align="left">
<div class="col-sm-12" style="padding:0">
<br>

<h3 style="text-align:center;text-transform:uppercase">Authorize.Net Customers</h3> 																			
<br>
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

<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<div class="col-sm-12" style="overflow-x:scroll;padding:0">
<table width="100%" border="0" class="" id="tablemessages">
<tr>
<th >Name</th>
<th>Email</th>
<th>Phone</th>
<th>Date</th>
<th>Action</th>
</tr>
<?php


$sql = "SELECT customer_id, customer_full_name, customer_phone,customer_email,date from customers order by customer_id desc"; 
$messages = array();
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$messages[] = $row;
?>	

<?php
}
?>						

</table>
</div>
<div class="row" id="pagesN" style="padding:5px 0">
<!-- <div class="col-sm-"> <div class="nnD" id="obrisidugme" onclick="deleteMultiple();">Delete selected messages</div> </div> -->
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
</div>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
	refresh();	
});

function checkDelete(id){
	swal({
		title: "Are you sure?",
		text: "Once deleted, you can not recover it!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
	if (willDelete) {
		window.location.href = "delCustomerAuth.php?id="+id;
	  } else {
		swal("You have canceled deleting");
	  }
	}); 
}

function deleteMultiple(){
	swal({
		title: "Are you sure?",
		text: "Once deleted, you can not recover it!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
	if (willDelete) {
		var provjera = '';
		var checkboxes = document.querySelectorAll('input[name="checkiran"]'), values = [];
		Array.prototype.forEach.call(checkboxes, function(el) {
			values.push(el.value);		
		});
		
		$.each(values, function (key, value) {
			var id = "msg"+value;
			var check = document.getElementById(id);
			if(check.checked == true){
				var checked = 1;
				$.ajax({
				type:"POST",
				url: "delCustomerAuthajax.php?id="+value,
				contentType: "application/json; charset=utf-8",
				dataType: "JSON",
					success:function (data) {
						provjera = true;
						provjeraF(provjera);
					}, error:function(data){
						provjera = false;				
						provjeraF(provjera);
					}
				});	
			}else{
			}			
		});
      } else {
        swal("You have canceled deleting");
      }
    }); 
	
}
function provjeraF(provjera){
	if(provjera == true){
		swal('Customers are deleted');
		location.reload();
	}else{
		swal('Something went wrong');	
	}
}

function refresh(){
	$('#pretraga').css('display','none');
	var tabela = document.getElementById('tablemessages');
	$('#tablemessages').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	
	var td = document.createElement("td");
	td.innerHTML ="Name";
	tr.appendChild(td);
	
	var td2 = document.createElement("td");
	td2.innerHTML ="Email";
	td2.className="msgRemove";	
	tr.appendChild(td2);
	
	var td3 = document.createElement("td");
	td3.innerHTML ="Phone";
	td3.className="msgRemove";
	tr.appendChild(td3);
	
	var td4 = document.createElement("td");
	td4.innerHTML ="Date";
	tr.appendChild(td4);
	
	var td5 = document.createElement("td");
	td5.innerHTML ="Action";
	tr.appendChild(td5);
	
	
	
	var novosti = <?php echo json_encode($messages,true); ?>;
	var duzina = novosti.length;
	var koliko = document.getElementById("pagintxt");			
	if(duzina < 10){
		if(duzina == 0){
			koliko.innerHTML = "No results";
			$('#obrisidugme').css('display','none');
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
		if(novosti[i].status == 0){
			td1.style = "font-weight:bold;color:#941046";		
		}
		td1.innerHTML = novosti[i].customer_full_name;	
		tr.appendChild(td1);
		
		var td2 = document.createElement("td");
		if(novosti[i].status == 0){
			td2.style = "font-weight:bold;color:#941046";		
		}
		td2.innerHTML = novosti[i].customer_email;	
		td2.className="msgRemove";
		tr.appendChild(td2);
		
		var td3 = document.createElement("td");
		if(novosti[i].status == 0){
			td3.style = "font-weight:bold;color:#941046";		
		}
		td3.innerHTML = novosti[i].customer_phone;	
		td3.className="msgRemove";		
		tr.appendChild(td3);
		
		var td4 = document.createElement("td");
		if(novosti[i].status == 0){
			td4.style = "font-weight:bold;color:#941046";		
		}
		td4.innerHTML = novosti[i].date;			
		tr.appendChild(td4);
		
		var td5 = document.createElement("td");
		tr.appendChild(td5);
		
		var read = document.createElement("a");
		read.className="nnE"
		read.href="cms.php?cms=customersAuth3&&ID="+novosti[i].customer_id;
		read.style="margin-left:5px;color:#fff";
		read.innerHTML="View";
		td5.appendChild(read);
		
		var read = document.createElement("a");
		read.className="nnP"
		read.href="cms.php?cms=customersAuth2&&ID="+novosti[i].customer_id;
		read.style="color:#fff";
		read.innerHTML="Edit";
		td5.appendChild(read);

		
		
		
	}
}

function pagination(page){
	var tabela = document.getElementById('tablemessages');
	$('#tablemessages').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	
	var td = document.createElement("td");
	td.innerHTML ="Name";
	tr.appendChild(td);
	
	var td2 = document.createElement("td");
	td2.innerHTML ="Email";
	td2.className="msgRemove";
	tr.appendChild(td2);
	
	var td3 = document.createElement("td");
	td3.innerHTML ="Phone";
	td3.className="msgRemove";
	tr.appendChild(td3);
	
	var td4 = document.createElement("td");
	td4.innerHTML ="Date";
	tr.appendChild(td4);
	
	var td5 = document.createElement("td");
	td5.innerHTML ="Action";
	tr.appendChild(td5);
	
	var novosti = <?php echo json_encode($messages,true); ?>;
	var duzina = novosti.length;
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
		if(novosti[i].status == 0){
			td1.style = "font-weight:bold;color:#941046";		
		}
		td1.innerHTML = novosti[i].customer_full_name;	
		tr.appendChild(td1);

		var td2 = document.createElement("td");
		if(novosti[i].status == 0){
			td2.style = "font-weight:bold;color:#941046";		
		}
		td2.innerHTML = novosti[i].customer_email;	
		td2.className="msgRemove";
		tr.appendChild(td2);
		
		var td3 = document.createElement("td");
		if(novosti[i].status == 0){
			td3.style = "font-weight:bold;color:#941046";		
		}
		td3.innerHTML = novosti[i].customer_phone;	
		td3.className="msgRemove";		
		tr.appendChild(td3);
		
		var td4 = document.createElement("td");
		if(novosti[i].status == 0){
			td4.style = "font-weight:bold;color:#941046";		
		}
		td4.innerHTML = novosti[i].date;			
		tr.appendChild(td4);
		
		var td5 = document.createElement("td");
		tr.appendChild(td5);
		
		var read = document.createElement("a");
		read.className="nnE"
		read.href="cms.php?cms=customersAuth3&&ID="+novosti[i].customer_id;
		read.style="margin-left:5px;color:#fff";
		read.innerHTML="View";
		td5.appendChild(read);
		
		var read = document.createElement("a");
		read.className="nnP"
		read.href="cms.php?cms=customersAuth2&&ID="+novosti[i].customer_id;
		read.style="color:#fff";
		read.innerHTML="Edit";
		td5.appendChild(read);
		
	}
}

function search(a){
	if (a.length < 3) { 
		refresh();
		$('#pretraga').css('display','none');
		$('#tablemessages').css('display','table');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=customerAuth&&search="+b,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tablemessages');
				$('#tablemessages').empty();
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
				
				var td = document.createElement("td");
				td.innerHTML ="Name";
				tr.appendChild(td);
				
				var td2 = document.createElement("td");
				td2.innerHTML ="Email";
				td2.className="msgRemove";
				tr.appendChild(td2);
				
				var td3 = document.createElement("td");
				td3.innerHTML ="Phone";
				td3.className="msgRemove";
				tr.appendChild(td3);
				
				var td4 = document.createElement("td");
				td4.innerHTML ="Date";
				tr.appendChild(td4);
				
				var td5 = document.createElement("td");
				td5.innerHTML ="Action";
				tr.appendChild(td5);
				
				var novosti = data;
				var duzina = novosti.length;
				for(i=0;i<duzina;i++){
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);
					
					var td1 = document.createElement("td");
					if(novosti[i].status == 0){
						td1.style = "font-weight:bold;color:#941046";		
					}
					td1.innerHTML = novosti[i].customer_full_name;	
					tr.appendChild(td1);

					var td2 = document.createElement("td");
					if(novosti[i].status == 0){
						td2.style = "font-weight:bold;color:#941046";		
					}
					td2.innerHTML = novosti[i].customer_email;	
					td2.className="msgRemove";
					tr.appendChild(td2);
					
					var td3 = document.createElement("td");
					if(novosti[i].status == 0){
						td3.style = "font-weight:bold;color:#941046";		
					}
					td3.innerHTML = novosti[i].customer_phone;	
					td3.className="msgRemove";	
					tr.appendChild(td3);
					
					var td4 = document.createElement("td");
					if(novosti[i].status == 0){
						td4.style = "font-weight:bold;color:#941046";		
					}
					td4.innerHTML = novosti[i].date;			
					tr.appendChild(td4);
					
					var td5 = document.createElement("td");
					tr.appendChild(td5);
					
					var read = document.createElement("a");
					read.className="nnE"
					read.href="cms.php?cms=customersAuth3&&ID="+novosti[i].customer_id;
					read.style="margin-left:5px;color:#fff";
					read.innerHTML="View";
					td5.appendChild(read);
					
					var read = document.createElement("a");
					read.className="nnP"
					read.href="cms.php?cms=customersAuth2&&ID="+novosti[i].customer_id;
					read.style="color:#fff";
					read.innerHTML="Edit";
					td5.appendChild(read);
				}	
			}else{
				$('#tablemessages').css('display','none');
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





