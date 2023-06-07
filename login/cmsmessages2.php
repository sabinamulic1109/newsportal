<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['messages'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>

<div align="left">
<?php
$ID=$_GET['ID'];
$sql = "SELECT * FROM poruke WHERE id=$ID";
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
if($row["name"]==0){	
	mysqli_query($con,"UPDATE `poruke` SET isRead=1 WHERE id=$ID");	
}
?>	
<table width="100%" border="0">
<tr>
<th style="border-bottom:#000000 solid 1px;"> 
<span style="font-weight:bold"><?php echo $row["name"]; ?></span> 
<span style="font-style:italic"><<a href="mailto:<?php echo $row["email"]; ?>"><?php echo $row["email"]; ?></a>></span> 
<span style="color:#a6a3a3;font-size:12px;"><?php echo date('m/d/Y', strtotime($row["date"])); ?></span> </th>
</tr>
<tr >
<td><i class="fa fa-phone"></i> <?php echo $row["phone"]; ?></td>
</tr>
<tr >
<td style="padding:20px"><?php echo $row["message"]; ?></td>
</tr>
<?php
}
?>						
</table>		
</div>