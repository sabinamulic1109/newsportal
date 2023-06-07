<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['testimonials'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<style type="text/css">
.nnP{
	padding:3px 8px;
}

</style>
<div align="left">
<div class="col-sm-6 col-sm-offset-3">
	<a href="cms.php?cms=addtestimonial" style="color:#000"><button style="background-color:#941046;" class="submitBtn">ADD NEW TESTIMONIAL</button></a>  
</div>
<div class="col-sm-12">
<h3 style="text-align:center;text-transform:uppercase">Testimonials</h3> 																			
<br>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div> 
<div class="col-sm-12" style="overflow-x:scroll;padding:0">
<table width="100%" border="0" class="" id="tabletestimonials">
<?php
$sql = "SELECT * from testimonials order by id desc"; 
$result = mysqli_query ($con,$sql); 
$testimonials = array();
while($row = mysqli_fetch_array($result)){
	$testimonials[] = $row;
}
?>						
</table>
</div>
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
$(document).ready(function(){
	refresh();	
});

function refresh(){
	$('#pretraga').css('display','none');
	var tabela = document.getElementById('tabletestimonials');
	$('#tabletestimonials').empty();
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
	td3.innerHTML ="Testimonial";
	td3.className="msgRemove";	
	tr.appendChild(td3);
	
	var td4 = document.createElement("td");
	td4.innerHTML ="Date";
	tr.appendChild(td4);
	
	var td5 = document.createElement("td");
	td5.innerHTML ="Status";
	tr.appendChild(td5);
	
	var td6 = document.createElement("td");
	td6.innerHTML ="Action";
	tr.appendChild(td6);
	
	
	var novosti = <?php echo json_encode($testimonials,true); ?>;
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
		td1.innerHTML = novosti[i].authorname+' '+ novosti[i].authorlastname;
		tr.appendChild(td1);

		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";
		td2.innerHTML = novosti[i].authoremail;	
		td2.className="msgRemove";	
		tr.appendChild(td2);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].testimonial.substring(0,30);	
		td3.className="msgRemove";			
		tr.appendChild(td3);
		
		var td4 = document.createElement("td");
		td4.style = "border-bottom:#999999 solid 1px;";
		td4.innerHTML = novosti[i].date;			
		tr.appendChild(td4);
		
		var td5 = document.createElement("td");
		td5.style = "border-bottom:#999999 solid 1px;";		
		tr.appendChild(td5);
		
		var ps = document.createElement("p");
		if(novosti[i].approved == 0 ){
			ps.style = "width:100%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0";
			ps.innerHTML = 'Not approved';
			ps.title = 'Not visible on your page';
		}else{
			ps.style = "width:100%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0";
			ps.innerHTML = 'Approved';
			ps.title = 'Visible on your page';
		}					
		td5.appendChild(ps);
		
		
		var td6 = document.createElement("td");
		td6.style = "border-bottom:#999999 solid 1px;";			
		tr.appendChild(td6);
		
		var read = document.createElement("a");
		read.className="nnP"
		read.href="cms.php?cms=testimonials2&&id="+novosti[i].id;
		read.style="color:#fff";
		read.innerHTML="Read";
		td6.appendChild(read);

	}
}

 function pagination(page){
	var tabela = document.getElementById('tabletestimonials');
	$('#tabletestimonials').empty();
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
	td3.innerHTML ="Testimonial";
	td3.className="msgRemove";	
	tr.appendChild(td3);
	
	var td4 = document.createElement("td");
	td4.innerHTML ="Date";
	tr.appendChild(td4);
	
	var td5 = document.createElement("td");
	td5.innerHTML ="Status";
	tr.appendChild(td5);
	
	var td6 = document.createElement("td");
	td6.innerHTML ="Action";
	tr.appendChild(td6);
	
	var novosti = <?php echo json_encode($testimonials,true); ?>;
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
		td1.innerHTML = novosti[i].authorname+' '+ novosti[i].authorlastname;
		tr.appendChild(td1);

		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";
		td2.innerHTML = novosti[i].authoremail;	
		td2.className="msgRemove";	
		tr.appendChild(td2);
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";
		td3.innerHTML = novosti[i].testimonial.substring(0,30);	
		td3.className="msgRemove";			
		tr.appendChild(td3);
		
		var td4 = document.createElement("td");
		td4.style = "border-bottom:#999999 solid 1px;";
		td4.innerHTML = novosti[i].date;			
		tr.appendChild(td4);
		
		var td5 = document.createElement("td");
		td5.style = "border-bottom:#999999 solid 1px;";		
		tr.appendChild(td5);
		
		var ps = document.createElement("p");
		if(novosti[i].approved == 0 ){
			ps.style = "width:100%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0";
			ps.innerHTML = 'Not approved';
			ps.title = 'Not visible on your page';
		}else{
			ps.style = "width:100%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0";
			ps.innerHTML = 'Approved';
			ps.title = 'Visible on your page';
		}					
		td5.appendChild(ps);
		
		
		var td6 = document.createElement("td");
		td6.style = "border-bottom:#999999 solid 1px;";			
		tr.appendChild(td6);
		
		var read = document.createElement("a");
		read.className="nnP"
		read.href="cms.php?cms=testimonials2&&id="+novosti[i].id;
		read.style="color:#fff";
		read.innerHTML="Read";
		td6.appendChild(read);
	}
} 

function search(a){
	if (a.length < 3) { 
		refresh();
		$('#pretraga').css('display','none');
		$('#tablenews').css('display','block');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=testimonials&&search="+b,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tabletestimonials');
				$('#tabletestimonials').empty();
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
				td3.innerHTML ="Testimonial";
				td3.className="msgRemove";	
				tr.appendChild(td3);
				
				var td4 = document.createElement("td");
				td4.innerHTML ="Date";
				tr.appendChild(td4);
				
				var td5 = document.createElement("td");
				td5.innerHTML ="Status";
				tr.appendChild(td5);
				
				var td6 = document.createElement("td");
				td6.innerHTML ="Action";
				tr.appendChild(td6);
				
				var novosti = data;
				var duzina = novosti.length;
				for(i=0;i<duzina;i++){
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);
					
					var td1 = document.createElement("td");
					td1.style = "border-bottom:#999999 solid 1px;";	
					td1.innerHTML = novosti[i].authorname+' '+ novosti[i].authorlastname;
					tr.appendChild(td1);

					var td2 = document.createElement("td");
					td2.style = "border-bottom:#999999 solid 1px;";
					td2.innerHTML = novosti[i].authoremail;	
					td2.className="msgRemove";	
					tr.appendChild(td2);
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";
					td3.innerHTML = novosti[i].testimonial.substring(0,30);	
					td3.className="msgRemove";			
					tr.appendChild(td3);
					
					var td4 = document.createElement("td");
					td4.style = "border-bottom:#999999 solid 1px;";
					td4.innerHTML = novosti[i].date;			
					tr.appendChild(td4);
					
					var td5 = document.createElement("td");
					td5.style = "border-bottom:#999999 solid 1px;";		
					tr.appendChild(td5);
					
					var ps = document.createElement("p");
					if(novosti[i].approved == 0 ){
						ps.style = "width:100%;background-color:#dc3545;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0";
						ps.innerHTML = 'Not approved';
						ps.title = 'Not visible on your page';
					}else{
						ps.style = "width:100%;background-color:#941046;padding:3px;color:#fff;border-radius:5px;text-transform:capitalize;text-align:center;margin:0";
						ps.innerHTML = 'Approved';
						ps.title = 'Visible on your page';
					}					
					td5.appendChild(ps);
					
					
					var td6 = document.createElement("td");
					td6.style = "border-bottom:#999999 solid 1px;";			
					tr.appendChild(td6);
					
					var read = document.createElement("a");
					read.className="nnP"
					read.href="cms.php?cms=testimonials2&&id="+novosti[i].id;
					read.style="color:#fff";
					read.innerHTML="Read";
					td6.appendChild(read);
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
