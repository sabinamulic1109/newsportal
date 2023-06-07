<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['news'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}

if(isset($_GET['form'])){

		$showform = 'display:block';
		$showadded = 'display:none';

}else{
	$showform = 'display:none';
	$showadded = 'display:block';
}
?>
<script src="cms/js/summernote-lite.js"></script>
<style type="text/css">

.nnE {
    margin-left: 3px;
}

.imgShow button{
	background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}
.imgShow img{
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.imgShow i{
	color:#a82626;
	font-size:24px;
	padding:5px;
}
#delete{
	display:none;
	position:absolute;
	z-index:1;
}

#pagintxt{
	color:#000;
}
.nnD{
	cursor:pointer;
}


#modalshare{
	max-height:calc(100vh - 170px);
	min-height:calc(100vh - 170px);
}

#modalshare .modal-dialog{
	margin-top:5px;
	width:70vw;
}



#modalshare .modal-dialog .modal-content .modal-body{
	min-height:calc(75vh - 180px);
	max-height:calc(75vh - 180px); 
	overflow-y:scroll; 
}

@media only screen and (max-width: 600px) {
	.flat-toggle.on > span {
		display:none;
	}

	#modalshare{
		top:54px;
		max-height:calc(100vh - 150px);
		min-height:calc(100vh - 150px);
	}

	#modalshare .modal-dialog{
		margin-top:5px;
		width:95vw;
	}

	#modalshare .modal-dialog .modal-content {
	}

	#modalshare .modal-dialog .modal-content .modal-body{
		min-height:calc(65vh - 150px);
		max-height:calc(65vh - 150px); 
		overflow-y:scroll; 
	}

	#modalshare .modal-dialog .modal-content .modal-header .col .header{
		font-size:12px;
	}

	.submitBtn{
		top: 50px;
		position: fixed;
		width: 102%;
		margin-left: -9%;
	}

	#add-header{
		margin-top:50px;
	}
}
</style>


<div align="left">
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
<div class="col-sm-8 col-sm-offset-2" id="add-form" style="<?php echo $showform; ?>">
<h3 style="text-align:center;text-transform:uppercase" >Add new shop article<br><br>
<!-- <a href="cms.php?cms=products4" class="nnP" style="text-align:center;font-size:14px!important;">Products Groups</a><br> --></h3>
<form action="addproduct.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<label>Title</label>
<input type="text" name="naslov"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title" required > 
<label>Price</label>
<input type="text" name="cijena"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Price" required > 
<label>Group</label>
<select name="grupa"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:0; ">
<?php

$sql = "SELECT * from shop_group order by id"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){

$idS=$row["id"];
$naslovS=$row["naziv"];
 


 echo '<option value="',$idS,'">',$naslovS,'</option>';
					
}
?>	</select>


<br><br>
<label>Photo</label>
<input type="file" name="photo1" id="file"  style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)">  

<div class="imgShow" style="text-align:center;">
	<span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span>
	<img id="output" width="100%" height="auto" style="max-width:30%;margin-bottom:5px;">
</div>		
<br>
<label>Description</label>
<textarea name="tekst" id="editor" placeholder="Description" style="width:100%; height:402px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;"></textarea>

<input type="submit" style="background-color:#941046;" name="Submit" value="       INSERT      " class="submitBtn"> 
	    
		  
<?php




if(isset($_SESSION['publish'])){
	$noid=$_SESSION["newsid"];
	$sql = "SELECT * from shop_artikli where id='$noid'"; 
	$result = mysqli_query ($con,$sql); 
	$row = mysqli_fetch_array($result);

	$aboutnaslov=$row["naziv"];
	$aboutpodnaslov=$row["cijena"];
	$aboutcontent=$row["opis"];
	$aboutphoto=$row["foto"];
?>
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,600" rel="stylesheet">
	<style>
	.section-title h2 {
		font-family: 'Raleway', sans-serif;
		position: relative;
		font-size: 30px;
		letter-spacing: 3px;
		font-weight: 600;
	}
	
	.slikaopis2 {
		width: 100%;
		object-fit: cover;
		padding-bottom: 50px;
	}
	
	/* Toggle button */
	.flat-toggle {
		width: 32px;
		border-radius: 4px;
		height: 10px;
		background-color: #DDD;
		position: relative;
		margin: 20px 0;
		-moz-user-select: none;
		-khtml-user-select: none;
		-webkit-user-select: none;
		-o-user-select: none;
		user-select: none;
	}

	.flat-toggle:after {
		border-radius: 100%;
		background-color: #941046;
		position: absolute;
		left: 0;
		top: -3px;
		width: 15px;
		height: 15px;
		content: '';
		-webkit-transform: translate(0);
		-ms-transform: translate(0);
		transform: translateX(0);
		 transition: all 0.2s ease-in-out;
		-webkit-transition: all 0.2s ease-in-out;
		-moz-transition: all 0.2s ease-in-out;
	}

	.flat-toggle > span {
		margin-left: 45px;
		position: relative;
		top: -2px;
		color: #941046;
		white-space: nowrap;
		display: block;
		cursor: pointer;
	}

	.flat-toggle:hover {
		cursor: pointer;
	}

	.flat-toggle:hover span {
		color: black;
		cursor: pointer;
	}

	.flat-toggle.on {
		background-color: #7aafb6;
		transform: translate3d(0,0,0);
	}

	.flat-toggle.on:hover span {
		color: #941046;
		cursor: pointer;
	}

	.flat-toggle.on:after {
		background-color: #00A3D9;
		-webkit-transform: translate(17px);
		-ms-transform: translate(17px);
		transform: translateX(17px);
	}

	.flat-toggle.on > span {
		text-align:right;
		color: #941046;
	}




	
	
			
	</style>
	<div style="display:none!important;">
	<div class="modal" id="modalshare" tabindex="-1" role="dialog" >
		<div class="modal-dialog" role="document">
			<div class="modal-content"  style="min-width:70vw"   >
				<div class="modal-header row" >
					<div class="col s6" style="text-align:left"  >
						<h4 class="header" style="margin-bottom:10px">Visibility</h4>
						<div class="flat-toggle on" title="Change visibility of this product" >
							<span id="visiblemsg">This product is visible on website</span>
						</div>
					</div>
					<div class="col s6" style="text-align:right;"  >
						<h4 class="header" style="margin-bottom:10px">Share on social media</h4>
						<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="padding:5px 10px;float:right"
						data-a2a-url="<?php echo $_SESSION['target']; ?>" 
						data-a2a-image="<?php echo $_SESSION['imagelink']; ?>"
						data-a2a-title="<?php echo $_SESSION['title']; ?>"
						>
						<a class="a2a_button_facebook"></a>
						<a class="a2a_button_twitter"></a>
						<a class="a2a_button_pinterest"></a>
						</div>
						<script async src="https://static.addtoany.com/menu/page.js"></script>
					</div>

					
				</div>
				<div class="modal-body row" style=""  >
					<div class="col-xs-12">
						<div class="section-title text-center">
							<div class="col-md-6" ><h2><?php echo $aboutnaslov; ?></h2></div>
							<div class="col-md-12" ><h4>Price: $ <?php echo $aboutpodnaslov; ?> </h4></div>
						</div>
					</div>	
				
					<div class="col-md-6 col-xs-12" >
							<img class="slikaopis2" src="shop/<?php echo $aboutphoto; ?>" >
					</div>
					
					<div class="col-md-6 col-xs-12">
						<div class="about-content">
							<?php echo $aboutcontent; ?>
						</div>
					</div>

				
				</div>
				<div class="modal-footer">
				<a onclick="$('#modalshare').toggle(); $('body').css('overflow','auto');" style="color:#000;cursor:pointer">CLOSE</a>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script>
	$('body').css('overflow','hidden'); 
	$('#modalshare').css('top','64px'); 
	$('#modalshare').css('z-index','100'); 
	$('#modalshare').toggle();
	
	$('.flat-toggle').on('click', function() {
		$(this).toggleClass('on');
	  
		if ($(this).hasClass('on')) {
		  $('#visiblemsg').html('This product is visible on website');
		  var visible = 1;
		  
		} else {
		  $('#visiblemsg').html('This product is not visible on website');
		  var visible = 0;
		}
		
		updateVisibility(<?php echo $noid; ?>, visible);
	});
	
	</script>
<?php
	
	unset($_SESSION['publish']);
	unset($_SESSION['target']);
	unset($_SESSION['imagelink']);
	unset($_SESSION['title']); 
}
		
?> 		  				
  	</form>
</div>	

<div class="col-sm-12" id="added" style="padding:0; <?php echo $showadded; ?>">
	<h3 style="text-align:left;text-transform:uppercase"> Added products
		<span style="float:right;max-width:145px" class="nnP newN">
			<a href="cms.php?cms=products&&form=1" style="background-color:#941046;" style="color: rgb(255, 255, 255);font-size:14px" >Add product</a>
		</span>
	</h3>

<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<table width="100%" border="0" id="tablenews">
<tr>
<td width="20%" style="border-bottom:#000000 solid 2px;">Photo</td>
<td width="60%" style="border-bottom:#000000 solid 2px;">Title</td>
 <td width="20%" style="border-bottom:#000000 solid 2px;">Action</td>
</tr>				
<?php
$sql = "SELECT id, naziv, foto,cijena,visible, discount,discountDateFrom,discountDateTo,cijenaSale from shop_artikli order by id desc"; 
$result = mysqli_query ($con,$sql);
$novosti = array(); 
while($row = mysqli_fetch_array($result)){
	$novosti[] = $row;				
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
 <script>
	$('#editor').summernote({
			tabsize: 8,
			height: 300,
			followingToolbar: false 
		});	
</script>
</div>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
	document.getElementById('delete').style.display="block";
	document.getElementById('output').style.display="block";
  };
  
  function hide(){
	  document.getElementById('output').style.display="none";
	  document.getElementById('delete').style.display="none";
	  
	  var file = document.getElementById("file");
	  file.value = file.defaultValue;
  }
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
			window.location.href = "delproducts.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}


function updateVisibility(newsid, visible){
	var formData = new FormData();
	$.ajax({
		type:"POST",
		data:formData,
		url: "updateProductsVisible.php?newsid="+newsid+"&&visible="+visible,
		//contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			$('#modalloader').toggle();
		},
		success:function (data) {
			$('#modalloader').css('display','none');
			if(data.state == 'true'){
				swal("Changes saved!");
			}else{
				swal("Error with saving");
				console.log(data);
			}	
		}, error:function(data){
			$('#modalloader').css('display','none');
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
	var tabela = document.getElementById('tablenews');
	$('#tablenews').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");
	td1.width = "20%";	
	td1.innerHTML ="Photo";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td2 = document.createElement("td");
	td2.width = "60%";	
	td2.innerHTML ="Title";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);
	var td3 = document.createElement("td");
	td3.width = "20%";	
	td3.innerHTML ="Action";
	td3.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td3);
	
	var novosti = <?php echo json_encode($novosti,true); ?>;
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
		
		var visible=novosti[i].visible;
		var ispisVisible="";
		
		var isOnSale=0;
		var discount = novosti[i].discount;
		var discountFrom = novosti[i].discountDateFrom;
		var discountTo = novosti[i].discountDateTo;
		var dateToday ="<?php echo date("d/m/Y")?>";
		var cijenaSale=  novosti[i].cijenaSale;
		var discountValue=0;
		var cijenaSH = novosti[i].cijena;
		
		if(discount>0){
			if((discountFrom <= dateToday) && (dateToday <= discountTo)){
				isOnSale=1; 
				if(cijenaSale=="1"){
				discountValue = (cijenaSH - (cijenaSH * (discount/100)));
				}else{
					discountValue = cijenaSH;
				}
			}
			else{
				isOnSale=0; 
			}
		}

		discountValue = discountValue.toFixed(2);
		
		
		
		
		var tr = document.createElement("tr");		
		tabela.appendChild(tr);
		
		var td1 = document.createElement("td");
		td1.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td1);
		
		var img = document.createElement("img");
		img.className="sliderslika";
		img.src="shop/"+novosti[i].foto;
		td1.appendChild(img);
		
		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td2);
		
		if(visible=="1"){
			ispisVisible="(active)";
			var podnaslov3 = document.createElement("p");
			podnaslov3.style="color:#941046";
			podnaslov3.innerHTML=ispisVisible;
			td2.appendChild(podnaslov3);
		}else{
			ispisVisible="(not active)";
			var podnaslov3 = document.createElement("p");
			podnaslov3.style="color:#dc3545";
			podnaslov3.innerHTML=ispisVisible;
			td2.appendChild(podnaslov3);
			
		}
				
		var naslov = document.createElement("p");
		naslov.style="font-weight:bold";
		naslov.innerHTML=novosti[i].naziv;
		td2.appendChild(naslov);
		
		var podnaslov = document.createElement("p");
		podnaslov.innerHTML="Price: $ "+novosti[i].cijena;
		td2.appendChild(podnaslov);
		
		if(isOnSale==1){
			
		var podnaslov2 = document.createElement("p");
		podnaslov2.style="background-color:#dc3545;color:white;padding:5px 10px;    width: max-content; font-weight: bold; border-radius: 5px;";
		podnaslov2.innerHTML="ON SALE";
		td2.appendChild(podnaslov2);
		
		var podnaslov4 = document.createElement("p");
		podnaslov4.style="color:#dc3545;";
		podnaslov4.innerHTML="Discount Price: $ "+discountValue;
		td2.appendChild(podnaslov4);
			
		}else{}
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=products2&&id="+novosti[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		div.appendChild(edit);
		
		var div = document.createElement("div");
		div.className="nnE";
		td3.appendChild(div);
		
		var photos = document.createElement("a");
		photos.href = "cms.php?cms=products3&&id="+novosti[i].id;
		photos.style="color:#fff";
		photos.innerHTML="Photos";
		div.appendChild(photos);
		
		var div = document.createElement("div");
		div.className="nnD";
		td3.appendChild(div);
		
		var del = document.createElement("a");
		del.id="del"+novosti[i].id;
		del.style="color:#fff";
		del.innerHTML="Delete";
		div.appendChild(del);
		$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
		
	}
}

function pagination(page){
	var tabela = document.getElementById('tablenews');
	$('#tablenews').empty();
	var tr = document.createElement("tr");
	tr.style="font-weight:bold";	
	tabela.appendChild(tr);
	var td1 = document.createElement("td");
	td1.width = "20%";	
	td1.innerHTML ="Photo";
	td1.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td1);
	var td2 = document.createElement("td");
	td2.width = "60%";	
	td2.innerHTML ="Title";
	td2.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td2);
	var td3 = document.createElement("td");
	td3.width = "20%";	
	td3.innerHTML ="Action";
	td3.style = "border-bottom:#999999 solid 2px;";	
	tr.appendChild(td3);
	
	var novosti = <?php echo json_encode($novosti,true); ?>;
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
		
		var visible=novosti[i].visible;
		var ispisVisible="";
		
		var isOnSale=0;
		var discount = novosti[i].discount;
		var discountFrom = novosti[i].discountDateFrom;
		var discountTo = novosti[i].discountDateTo;
		var dateToday ="<?php echo date("d/m/Y")?>";
		var cijenaSale=  novosti[i].cijenaSale;
		var discountValue=0;
		var cijenaSH = novosti[i].cijena;
		
		if(discount>0){
			if((discountFrom <= dateToday) && (dateToday <= discountTo)){
				isOnSale=1; 
				if(cijenaSale=="1"){
				discountValue = (cijenaSH - (cijenaSH * (discount/100)));
				}else{
					discountValue = cijenaSH;
				}
			}
			else{
				isOnSale=0; 
			}
		}

		discountValue = discountValue.toFixed(2);
		
		
		
		
		
		var tr = document.createElement("tr");		
		tabela.appendChild(tr);
		
		var td1 = document.createElement("td");
		td1.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td1);
		
		var img = document.createElement("img");
		img.className="sliderslika";
		img.src="shop/"+novosti[i].foto;
		td1.appendChild(img);
		
		var td2 = document.createElement("td");
		td2.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td2);
		
		if(visible=="1"){
			ispisVisible="(active)";
			var podnaslov3 = document.createElement("p");
			podnaslov3.style="color:#941046";
			podnaslov3.innerHTML=ispisVisible;
			td2.appendChild(podnaslov3);
		}else{
			ispisVisible="(not active)";
			var podnaslov3 = document.createElement("p");
			podnaslov3.style="color:#dc3545";
			podnaslov3.innerHTML=ispisVisible;
			td2.appendChild(podnaslov3);
			
		}
		
		var naslov = document.createElement("p");
		naslov.style="font-weight:bold";
		naslov.innerHTML=novosti[i].naziv;
		td2.appendChild(naslov);
		
		var podnaslov = document.createElement("p");
		podnaslov.innerHTML="Price: $ "+novosti[i].cijena;
		td2.appendChild(podnaslov);
		
		if(isOnSale==1){
			
		var podnaslov2 = document.createElement("p");
		podnaslov2.style="background-color:#dc3545;color:white;padding:5px 10px;    width: max-content; font-weight: bold; border-radius: 5px;";
		podnaslov2.innerHTML="ON SALE";
		td2.appendChild(podnaslov2);
		
		var podnaslov4 = document.createElement("p");
		podnaslov4.style="color:#dc3545;";
		podnaslov4.innerHTML="Discount Price: $ "+discountValue;
		td2.appendChild(podnaslov4);
			
		}else{}
		
		var td3 = document.createElement("td");
		td3.style = "border-bottom:#999999 solid 1px;";	
		tr.appendChild(td3);
		
		var div = document.createElement("div");
		div.className="nnP";
		td3.appendChild(div);
		
		var edit = document.createElement("a");
		edit.href = "cms.php?cms=products2&&id="+novosti[i].id;
		edit.style="color:#fff";
		edit.innerHTML="Edit";
		div.appendChild(edit);
		
		var div = document.createElement("div");
		div.className="nnE";
		td3.appendChild(div);
		
		var photos = document.createElement("a");
		photos.href = "cms.php?cms=products3&&id="+novosti[i].id;
		photos.style="color:#fff";
		photos.innerHTML="Photos";
		div.appendChild(photos);
		
		var div = document.createElement("div");
		div.className="nnD";
		td3.appendChild(div);
		
		var del = document.createElement("a");
		del.id="del"+novosti[i].id;
		del.style="color:#fff";
		del.innerHTML="Delete";
		div.appendChild(del);
		$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
		
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
		url: "search.php?type=products&&search="+b,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tablenews');
				$('#tablenews').empty();
				$('#tablenews').css('display','block');
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
				var td1 = document.createElement("td");
				td1.width = "20%";	
				td1.innerHTML ="Photo";
				td1.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td1);
				var td2 = document.createElement("td");
				td2.width = "60%";	
				td2.innerHTML ="Title";
				td2.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td2);
				var td3 = document.createElement("td");
				td3.width = "20%";	
				td3.innerHTML ="Action";
				td3.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td3);
				
				var novosti = data;
				var duzina = novosti.length;
				for(i=0;i<duzina;i++){
					
					var visible=novosti[i].visible;
					var ispisVisible="";
					
					var isOnSale=0;
					var discount = novosti[i].discount;
					var discountFrom = novosti[i].discountDateFrom;
					var discountTo = novosti[i].discountDateTo;
					var dateToday ="<?php echo date("d/m/Y")?>";
					var cijenaSale=  novosti[i].cijenaSale;
					var discountValue=0;
					var cijenaSH = novosti[i].cijena;
					
					if(discount>0){
						if((discountFrom <= dateToday) && (dateToday <= discountTo)){
							isOnSale=1; 
							if(cijenaSale=="1"){
							discountValue = (cijenaSH - (cijenaSH * (discount/100)));
							}else{
								discountValue = cijenaSH;
							}
						}
						else{
							isOnSale=0; 
						}
					}

					discountValue = discountValue.toFixed(2);
					
					
					
					
					
					
					
					
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);
					
					var td1 = document.createElement("td");
					td1.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td1);
					
					var img = document.createElement("img");
					img.className="sliderslika";
					img.src="shop/"+novosti[i].foto;
					td1.appendChild(img);
					
					var td2 = document.createElement("td");
					td2.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td2);
					
					if(visible=="1"){
						ispisVisible="(active)";
						var podnaslov3 = document.createElement("p");
						podnaslov3.style="color:#941046";
						podnaslov3.innerHTML=ispisVisible;
						td2.appendChild(podnaslov3);
					}else{
						ispisVisible="(not active)";
						var podnaslov3 = document.createElement("p");
						podnaslov3.style="color:#dc3545";
						podnaslov3.innerHTML=ispisVisible;
						td2.appendChild(podnaslov3);
						
					}
					
					var naslov = document.createElement("p");
					naslov.style="font-weight:bold";
					naslov.innerHTML=novosti[i].naziv;
					td2.appendChild(naslov);
					
					var podnaslov = document.createElement("p");
					podnaslov.innerHTML="Price: $ "+novosti[i].cijena;
					td2.appendChild(podnaslov);
					
					if(isOnSale==1){
		
					var podnaslov2 = document.createElement("p");
					podnaslov2.style="background-color:#dc3545;color:white;padding:5px 10px;    width: max-content; font-weight: bold; border-radius: 5px;";
					podnaslov2.innerHTML="ON SALE";
					td2.appendChild(podnaslov2);
					
					var podnaslov4 = document.createElement("p");
					podnaslov4.style="color:#dc3545;";
					podnaslov4.innerHTML="Discount Price: $ "+discountValue;
					td2.appendChild(podnaslov4);
						
					}else{}
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td3);
					
					var div = document.createElement("div");
					div.className="nnP";
					td3.appendChild(div);
					
					var edit = document.createElement("a");
					edit.href = "cms.php?cms=products2&&id="+novosti[i].id;
					edit.style="color:#fff";
					edit.innerHTML="Edit";
					div.appendChild(edit);
					
					var div = document.createElement("div");
					div.className="nnE";
					td3.appendChild(div);
					
					var photos = document.createElement("a");
					photos.href = "cms.php?cms=products3&&id="+novosti[i].id;
					photos.style="color:#fff";
					photos.innerHTML="Photos";
					div.appendChild(photos);
					
					var div = document.createElement("div");
					div.className="nnD";
					td3.appendChild(div);
					
					var del = document.createElement("a");
					del.id="del"+novosti[i].id;
					del.style="color:#fff";
					del.innerHTML="Delete";
					div.appendChild(del);
					$("#del"+novosti[i].id).attr('onclick','checkDelete('+novosti[i].id+')');
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