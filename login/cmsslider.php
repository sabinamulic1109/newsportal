<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['slider'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';	
}
?>
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
	display:none;
	position:absolute;
	z-index:1;
}
</style>
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Add new slide to your slider</h3>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
<input type="text" name="naslov"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title" required> 
<input type="text" name="podnaslov"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Subtitle" required> 
<input type="text" name="url"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Link" required> 
<input type="file" name="photo1" id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)" required>  
		<div class="imgShow">
			<span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span>
			<img id="output" width="100%" height="auto" style="margin-bottom:5px;">
		</div> 
<div align="right"> 
<input type="submit" style="background-color:#941046;" name="Submit" value="       Insert      " class="submitBtn"></div>	 	  
<?php
if(isset($_POST)){
	if(!empty($_POST["naslov"])){
		$target = "slider/"; 
		$target = $target . basename( $_FILES['photo1']['name']); 
		$random_digit=rand(000000,999999);

		$naslov=$_POST["naslov"];
		$naslov = str_replace("\\", '', $naslov);
		$naslov = str_replace("'","\'", $naslov);
		$podnaslov=$_POST["podnaslov"];
		$podnaslov = str_replace("\\", '', $podnaslov);
		$podnaslov = str_replace("'","\'", $podnaslov);		
		$url=$_POST["url"];
		$url = str_replace("\\", '', $url);
		$url = str_replace("'","\'", $url);	

		$slikax=$_REQUEST["photo1"];
		$slikax=($_FILES['photo1']['name']); 
		if($slikax!=""){$slika=$random_digit.$slikax;}
		$target = "slider/".$slika; 
		
		$sql="SELECT * FROM slider WHERE naslov='$naslov'";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);	

		if($count == 0){
			$akcija = mysqli_query($con,"INSERT INTO `slider` VALUES (0,'".$naslov."','".$podnaslov."','".$slika."','".$url."')") ; 
			if($akcija == true){
				$types = array('image/jpeg', 'image/gif', 'image/png', 'application/pdf');
				if (in_array($_FILES['photo1']['type'], $types)) {
					move_uploaded_file($_FILES['photo1']['tmp_name'], $target);
				}	
				$today = date('Y-m-d');
				mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new slide ".$naslov."','".$today."')") ;
				$user=$_SESSION['myusername'];
				$date=date("Y-m-d h:i:sa");
				$function="Added new slide ".$naslov;
				$userLog=$date.", ".$user.", ".$function."\n";				
				$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
				fwrite($myfile, $userLog);
				$msg='<div class="alert alert-success">
				<strong>DONE!</strong>
				</div>';
			}else{
				$user=$_SESSION['myusername'];
				$date=date("Y-m-d h:i:sa");
				$function="Error description: " . mysqli_error($con);
				$userLog=$date.", ".$user.", ".$function."\n";				
				$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
				fwrite($myfile, $userLog);
				$msg='<div class="alert alert-success">
				<strong>'.mysqli_error($con).'</strong>
				</div>';
			}
		}else{
			$msg='<div class="alert alert-warning">
				<strong>You already have slider with this title!</strong>
				</div>'; 
		}
		echo $msg;
	}
}
?> 
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
	 
</form>	
</div>
<div class="col-sm-12">
<br>
<br>
<h3 style="text-align:center;text-transform:uppercase">Your added slides</h3>
<div align="left">
<table width="100%" border="0">
<tr>
<td width="20%" style="border-bottom:#000000 solid 2px;">Photo</td>
<td width="70%" style="border-bottom:#000000 solid 2px;">Title</td>
<td width="10%" style="border-bottom:#000000 solid 2px;">Action</td>
</tr>				
<?php
$sql = "SELECT * from slider order by id desc"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
$idDok=$row["id"];
$naslovS=$row["naslov"];
$podnaslovS=$row["podnaslov"];
$fileDok=$row["file"];
 echo '<tr>
 <td style="border-bottom:#999999 solid 1px;"><img class="sliderslika" src="slider/',$fileDok,'"></td>
<td style="border-bottom:#999999 solid 1px;"><p><strong>',$naslovS,'</strong></p><p>',$podnaslovS,'</p></td>
<td style="border-bottom:#999999 solid 1px;">
<div class="nnP"><a href="cms.php?cms=slider2&&id=',$idDok,'"><span style="color:#fff;">Edit</span></a></div>
<div class="nnD"><a href="delsl.php?id=',$idDok,'" onclick="return checkDelete('.$idDok.')"><span style="color:#fff;">Delete</span></a></div>
</td>
</tr>';				
}
?>										
</table>
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
			window.location.href = "delsl.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}
</script>
</div>