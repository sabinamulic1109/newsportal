<?php
if($_SESSION['myusername']==''){
	echo header("location:index.php?msg=2");
}
if($roles['news'] == 0){
	echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<link href="css/bootstrap-datepicker3.min.css" rel="stylesheet" media="screen">
<script src="cms/js/summernote-lite.js"></script>
<style type="text/css">

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
	display:block;
	position:absolute;
	z-index:1;
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
<?php

	$noid = $_GET["id"];
	$id=$noid;
	$sql = "SELECT * from shop_artikli where id='$noid'"; 
	$result = mysqli_query ($con,$sql); 
	$row = mysqli_fetch_array($result);
	$idDok = $row["id"];
	$nazivS = $row["naziv"];
	$opisS = $row["opis"];
	$fileDok = $row["foto"];
	$cijenaS = $row["cijena"];
	$cijenaS2 = $row["cijena2"];
	$cijenaS3 = $row["cijena3"];
	$magID = $row["magID"];
	$visible = $row['visible'];
	/* Create direct url to news article - used for share news on social media */
	$targeturl = $domenaXV.'/shop-details.php?id='.$noid;
	/* Create direct url to news article image - used for share news on social media*/
	$imageurl = $domenaXV."/shop/".$fileDok; 
	$statusSH=$row["status"];
	$grupaSH=$row["grupa"];
	$dateToday= date("Y-m-d");
	$discount= $row["discount"];
	$discountFrom=$row["discountDateFrom"];
	$discountTo=$row["discountDateTo"];

	$cijenaSale=$row["cijenaSale"];
	$cijenaSale2=$row["cijenaSale2"];
	$cijenaSale3=$row["cijenaSale3"];
	$isOnSale=0; 

	if($discount>0){
			$isOnSale=1; 
	}

?>	

<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit product article</h3>

<div class="row" >
	<div class="col s12 m6" style="text-align:left"  >
		<h4 class="header" style="margin-bottom:10px">Visibility</h4>
		<div class="flat-toggle <?php if($visible == 1 ){echo ' on'; }?>" title="Change visibility of this article" >
			<?php if($visible == 1 ){ ?>
			<span id="visiblemsg">This product is visible on website</span>
			<?php }else{ ?>
			<span id="visiblemsg">This product is not visible on website</span>
			<?php } ?>
		</div>
	</div>
	<div class="col s12 m6" style="text-align:right;"  >
		<h4 class="header" style="margin-bottom:10px">Share on social media</h4>
		<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="padding:5px 10px;float:right"
		data-a2a-url="<?php echo $targeturl; ?>" 
		data-a2a-image="<?php echo $imageurl; ?>"
		data-a2a-title="<?php echo $mjesecMG.' '.$godinaMG ; ?>"
		>
		<a class="a2a_button_facebook"></a>
		<a class="a2a_button_twitter"></a>
		<a class="a2a_button_pinterest"></a>
		</div>
		<script async src="https://static.addtoany.com/menu/page.js"></script>
	</div>
</div>

<form action="updateproduct.php?id=<?php echo $idDok; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
 
<div class="col s12 m12" style="padding-left:0;padding-right:0">


 <?php if($isOnSale==1){ ?> 

<div class="col s12 m12" style="padding-left:0;padding-right:0"><br>
	<label style="margin: 5px 0">Title</label>	 
		<input type="text" name="naslov"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title" required  value="<? echo $nazivS;?>"> 
</div>	
<label>Group</label>
<select name="grupa"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:0; ">
<?php

$sql = "SELECT * from shop_group order by id"; 
$result = mysqli_query ($con,$sql); 
while($row1 = mysqli_fetch_array($result)){

$idGRP=$row1["id"];
$naslovGRP=$row1["naziv"];
 

 echo '<option value="',$idGRP,'" '; 
 
 if($grupaSH==$idGRP){echo '  selected="selected" ';}
 
 echo '>',$naslovGRP,'</option>';
					
}
?></select>

<br><br>
<input type="checkbox" id="onSale" name="onSale"  checked/>
<label for="onSale"> On sale </label> 


 <div id="formDiscount" style="position:relative; display:block; min-height:150px;">
					<div class="form-group">
						<label for="product_discount" class="col-sm-2 control-label"><span class="text-danger">*</span> Discount:</label>
						<div class="col-sm-3">
							<input type="number" min="1" max="100" class="form-control" value="<?php echo $discount; ?>"  id="discount" name="discount" style="display:inline-block; width: 50%"/> <p style="display:inline-block;">%</p>
						</div>
					</div>
					<div class="form-group">
						<label for="product_discount_from_date" class="col-sm-12 control-label"><span class="text-danger">*</span> Date from:</label>
						<div class="col-sm-12">
							<div class="controls input-append  form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
								<input id="dateFromID" value="<?php echo $discountFrom; ?>" name="dateFromID" size="16" type="text"  readonly>
							</div>
						<input type="hidden" value="<?php echo $discountFrom; ?>" name ="dtp_input1" id="dtp_input1" value="" /><br/>
						</div>
					</div>
					<div class="form-group">
						<label for="product_discount_to_date" class="col-sm-12 control-label"><span class="text-danger">*</span> Date to:</label>
						<div class="col-sm-12">
						<div class="controls input-append  form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input id="dateToID" name="dateToID" value="<?php echo $discountTo; ?>" size="16" type="text"  readonly>
							</div>
						<input type="hidden" value="<?php echo $discountTo; ?>"  name ="dtp_input2" id="dtp_input2" value="" /><br/>
						</div>
					</div>
					
 
 </div>

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Price 
		<div style="display:block;" id="saleC11"><input type="checkbox" id="onSaleC1" name="onSaleC1" value="" <?php if($cijenaSale=="1"){ ?> checked <?php } ?>/>
		<label for="onSaleC1"> On sale </label> </div>
	</label>	
		<input type="text" name="cijena"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Price for 1 Year" placeholder = "Price for 1 Year" value="<?php echo $cijenaS; ?>" required> 

	<label <?php if($id=="1"){  ?> style="display:block;margin: 5px 0" <?php } else { ?> style="display:none;margin: 5px 0"  <?php } ?>> Price 2 Year 
		<div style="display:block;" id="saleC22"><input type="checkbox" id="onSaleC2" name="onSaleC2" value="" <?php if($cijenaSale2=="1"){ ?> checked <?php } ?>/>
		<label for="onSaleC2"> On sale </label> </div>
	</label>
		<input type="text" name="cijena2" <?php if($id=="1"){  ?> style="display:block;width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" <?php } else { ?> style="display:none;"  <?php } ?> title = "Price for  Year" placeholder = "Price for 2 Year" value="<?php echo $cijenaS2; ?>" required> 
	
	<label  <?php if($id=="1"){  ?> style="display:block;margin: 5px 0" <?php } else { ?> style="display:none;margin: 5px 0"  <?php } ?>> Price Non USA
		<div style="display:block;" id="saleC33"><input type="checkbox" id="onSaleC3" name="onSaleC3" value="" <?php if($cijenaSale3=="1"){ ?> checked <?php } ?>/>
		<label for="onSaleC3"> On sale </label> </div>
	</label>
		<input type="text" name="cijena3" <?php if($id=="1"){  ?> style="display:block;width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" <?php } else { ?> style="display:none;"  <?php } ?>  title = "Price Non USA" placeholder = "Price Non USA" value="<?php echo $cijenaS3; ?>" required> 
	

	
</div>	 
	


<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Photo</label>	  
	<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)"> 
</div>	
 
 

<div class="imgShow" style="text-align:center;">
	<!-- <span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span> -->
	<?php if($row["foto"] == ''){
	?>
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;">	
	<?php	
	}else{ ?>
	<p style="text-align:center">
		<a href ="rotateimage.php?type=product&id=<?php echo $idDok; ?>&degrees=90" title="Rotate counterclockwise">
			<i class="fas fa-undo" style="font-size:13px;color:#454545"></i>
		</a> 
		| 
		<a href ="rotateimage.php?type=product&id=<?php echo $idDok; ?>&degrees=270" title="Rotate clockwise">
			<i class="fas fa-redo" style="font-size:13px;color:#454545"></i>
		</a>
	</p>
	<img id="output" width="100%" height="auto" style="max-width:30%;margin-bottom:5px;" src="shop/<?php echo $fileDok; ?>?m=<?php echo filemtime('shop/'.$fileDok); ?> ">
	<?php	
	} ?>
</div>



<br><br><br>
<label><br>Description</label>
 <textarea name="opis" id="editor" style="width:100%; height:402px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;"  placeholder="Description"><?php echo $opisS; ?></textarea>
	
	
	
	
<?php }else{ ?> 




<div class="col s12 m12" style="padding-left:0;padding-right:0"><br>
	<label style="margin: 5px 0">Title</label>	 
		<input type="text" name="naslov"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title" required  value="<? echo $nazivS;?>"> 
</div>	
<label>Group</label>
<select name="grupa"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:0; ">
<?php

$sql = "SELECT * from shop_group order by id"; 
$result = mysqli_query ($con,$sql); 
while($row1 = mysqli_fetch_array($result)){

$idGRP=$row1["id"];
$naslovGRP=$row1["naziv"];
 

 echo '<option value="',$idGRP,'" '; 
 
 if($grupaSH==$idGRP){echo '  selected="selected" ';}
 
 echo '>',$naslovGRP,'</option>';
					
}
?></select>

<br><br>
<input type="checkbox" id="onSale" name="onSale"  />
<label for="onSale"> On sale </label> 


 <div id="formDiscount" style="position:relative; display:none; min-height:150px;">
					<div class="form-group">
						<label for="product_discount" class="col-sm-2 control-label"><span class="text-danger">*</span> Discount:</label>
						<div class="col-sm-3">
							<input type="number" min="1" max="100" class="form-control" value="<?php echo $discount; ?>"  id="discount" name="discount" style="display:inline-block; width: 50%"/> <p style="display:inline-block;">%</p>
						</div>
					</div>
					<div class="form-group">
						<label for="product_discount_from_date" class="col-sm-12 control-label"><span class="text-danger">*</span> Date from:</label>
						<div class="col-sm-12">
							<div class="controls input-append  form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
								<input id="dateFromID" class="datepicker1" value="<?php echo $discountFrom; ?>" name="dateFromID" size="16" type="text"  readonly>
							
							</div>
						<input type="hidden" value="<?php echo $discountFrom; ?>" name ="dtp_input1" id="dtp_input1" value="" /><br/>
						</div>
					</div>
					<div class="form-group">
						<label for="product_discount_to_date" class="col-sm-12 control-label"><span class="text-danger">*</span> Date to:</label>
						<div class="col-sm-12">
						<div class="controls input-append  form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input id="dateToID" name="dateToID" class="datepicker1" value="<?php echo $discountTo; ?>" size="16" type="text"  readonly>
							
							</div>
						<input type="hidden" value="<?php echo $discountTo; ?>"  name ="dtp_input2" id="dtp_input2" value="" /><br/>
						</div>
					</div>
					
 </div>

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Price 
		<div style="display:none;" id="saleC11"><input type="checkbox" id="onSaleC1" name="onSaleC1" value="" <?php if($cijenaSale=="1"){ ?> checked <?php } ?>/>
		<label for="onSaleC1"> On sale </label> </div>
	</label>	
		<input type="text" name="cijena"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Price for 1 Year" placeholder = "Price for 1 Year" value="<?php echo $cijenaS; ?>" required> 

	<label <?php if($id=="1"){  ?> style="display:block;margin: 5px 0" <?php } else { ?> style="display:none;margin: 5px 0"  <?php } ?>> Price 2 Year 
		<div style="display:none;" id="saleC22"><input type="checkbox" id="onSaleC2" name="onSaleC2" value="" <?php if($cijenaSale2=="1"){ ?> checked <?php } ?>/>
		<label for="onSaleC2"> On sale </label> </div>
	</label>
		<input type="text" name="cijena2" <?php if($id=="1"){  ?> style="display:block;width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" <?php } else { ?> style="display:none;"  <?php } ?> title = "Price 2 Year" placeholder = "Price 2 Year" value="<?php echo $cijenaS2; ?>" required> 
	
	<label  <?php if($id=="1"){  ?> style="display:block;margin: 5px 0" <?php } else { ?> style="display:none;margin: 5px 0"  <?php } ?>> Price Non USA
		<div style="display:none;" id="saleC33"><input type="checkbox" id="onSaleC3" name="onSaleC3" value="" <?php if($cijenaSale3=="1"){ ?> checked <?php } ?>/>
		<label for="onSaleC3"> On sale </label> </div>
	</label>
		<input type="text" name="cijena3" <?php if($id=="1"){  ?> style="display:block;width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" <?php } else { ?> style="display:none;"  <?php } ?>  title = "Price Non USA" placeholder = "Price Non USA" value="<?php echo $cijenaS3; ?>" required> 
	

	
</div>	 
	


<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Photo</label>	  
	<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)"> 
</div>	
 
 

<div class="imgShow" style="text-align:center;">
	<!-- <span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span> -->
	<?php if($row["foto"] == ''){
	?>
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;">	
	<?php	
	}else{ ?>
	<p style="text-align:center">
		<a href ="rotateimage.php?type=product&id=<?php echo $idDok; ?>&degrees=90" title="Rotate counterclockwise">
			<i class="fas fa-undo" style="font-size:13px;color:#454545"></i>
		</a> 
		| 
		<a href ="rotateimage.php?type=product&id=<?php echo $idDok; ?>&degrees=270" title="Rotate clockwise">
			<i class="fas fa-redo" style="font-size:13px;color:#454545"></i>
		</a>
	</p>
	<img id="output" width="100%" height="auto" style="max-width:30%;margin-bottom:5px;" src="shop/<?php echo $fileDok; ?>?m=<?php echo filemtime('shop/'.$fileDok); ?> ">
	<?php	
	} ?>
</div>



<br><br><br>
<label><br>Description</label>
 <textarea name="opis" id="editor" style="width:100%; height:402px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;"  placeholder="Description"><?php echo $opisS; ?></textarea>
	




<?php } ?>	


	
 <input type="submit" style="background-color:#941046;" name="Submit" value="       SAVE      " class="submitBtn"> 	   
  	</form>	
</div>
</div>

<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		$('.flat-toggle').on('click', function() {
			$(this).toggleClass('on');
		  
			if ($(this).hasClass('on')) {
			  $('#visiblemsg').html('This article is visible on website');
			  var visible = 1;
			  
			} else {
			  $('#visiblemsg').html('This article is not visible on website');
			  var visible = 0;
			}
			
			updateVisibility(<?php echo $noid; ?>, visible);
		});


		$('#editor').summernote({
			tabsize: 8,
			height: 300,
			followingToolbar: false 
		});	
	});
	
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

	

	var loadFile = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
		/* document.getElementById('delete').style.display="block"; */
		document.getElementById('output').style.display="block";
	};

	function hide(){
	  document.getElementById('output').style.display="none";
	/*   document.getElementById('delete').style.display="none"; */
	  
	  var file = document.getElementById("file");
	  file.value = file.defaultValue;
	}
	
	
	
var idS= "<?php echo $id; ?>";
$(function(){
  $('#onSale').click(function(){
    if ($(this).is(':checked'))
    {
		
		$( "#formDiscount" ).show( "slow" );
		
		$("#discount").prop('required',true);
		$("#dateFromID").prop('required',true);
		$("#dateToID").prop('required',true);

		$( "#saleC11" ).show( );
		if(idS=="1"){
		$( "#saleC22" ).show( );
		$( "#saleC33" ).show( );
		}
    }
	else{
		$("#discount").prop('required',false);
		$("#dateFromID").prop('required',false);
		$("#dateToID").prop('required',false);
		
		$( "#formDiscount" ).hide( "slow" );
	
		$( "#saleC11" ).hide( );
		if(idS=="1"){
		$( "#saleC22" ).hide( );
		$( "#saleC33" ).hide( );
		}
	}
  });
});


$('#dateToID').datepicker1({
			format: 'dd/mm/yyyy',
			autoclose: true
		})

		
$('#dateFromID').datepicker1({
	format: 'dd/mm/yyyy',
	autoclose: true
})

</script>