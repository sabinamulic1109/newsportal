<?php

include '../config.php';

$page = $_GET['page'];
$rezultat = array();
$dg = (($page-1)*10);
$gg = 10;

$sql = "SELECT id, naslov from tekst order by id desc LIMIT $dg, $gg"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$rezultat[] = $row;
}

$sql= "SELECT id, naslov from tekst order by id desc";
$result = mysqli_query ($con,$sql); 
$count = array();
while($row = mysqli_fetch_array($result)){	
	$count[] = $row;
}
$ukupno = count($count);
$pagesnum =  ceil($ukupno/10);
if($page == 1){
	$previous = '';
}else{
	$previous = 'pagination('.($page - 1).')';
}
if($pagesnum > $page){
	$next = 'pagination('.($page + 1).')';
}else{
	$next = '';
}
$od = (($page-1)*10) + 1;
if(($page*10) > 10){
	$do = ($page*10);
}else{
	$do = $ukupno;
}
?>

<table width="100%;" border="0" id="tablecontent">
<tr style="font-weight: bold;">
	<td width="80%" style="border-bottom: 2px solid rgb(153, 153, 153);">Title</td>
	<td width="20%" style="border-bottom: 2px solid rgb(153, 153, 153);">Action</td>
</tr>
<?php foreach($rezultat as $r){ ?>
<tr>
	<td style="border-bottom: 1px solid rgb(153, 153, 153);">
		<p style="font-weight: bold;"><?php echo $r['naslov']; ?></p>
	</td>
	<td style="border-bottom: 1px solid rgb(153, 153, 153);">
		<div class="nnP"><a href="cms.php?cms=content2&&id=<?php echo $r['id']; ?>" style="color: rgb(255, 255, 255);">Edit</a></div>
		<div class="nnD"><a id="del1" onclick="checkDelete(<?php echo $r['id']; ?>)" style="color: rgb(255, 255, 255);">Delete</a></div>
	</td>
</tr>
<?php } ?>
</table>
<div class="row" id="pagesN">
<div class="col-sm-6">
	<span id="pagintxt">Showing <?php echo $od; ?> - <?php echo $do; ?> of <?php echo $ukupno; ?></span>
</div>
<div class="col-sm-6" style="text-align:right">
	<a class="pagin" id="previous" style="cursor:pointer" onclick="<?php echo $previous; ?>"><i class="fa fa-angle-left"></i> Previous</a>
	<a class="pagin" id="next" style="cursor:pointer" onclick="<?php echo $next; ?>">Next <i class="fa fa-angle-right"></i></a>
</div>
</div>