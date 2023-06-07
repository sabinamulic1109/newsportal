<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['testimonials'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<style type="text/css">

</style>
<div align="left">
<?php
$id=$_GET['id'];
$sql = "SELECT * FROM testimonials WHERE id=$id";
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$author = $row['authorname'].' '.$row['authorlastname'];
	$email = $row['authoremail'];
	$testimonial = $row['testimonial'];
	$slika = $row['picture'];
	$approved = $row["approved"];
?>	
	<table width="100%" border="0">
	<tr>
	<th style="border-bottom:#000000 solid 1px;"> 
	<span style="font-weight:bold"><?php echo $author; ?></span> 
	<span style="font-style:italic"><<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>></span> 
	<span style="color:#a6a3a3;float:right"><?php echo $row["date"]; ?></span> </th>
	</tr>
	<tr>
	</tr>
	<tr >
	<td style="padding:20px"><?php
	if(!empty($slika)){
		?><img src="<?php echo $slika; ?>" class="slikaTestimonial" /><?php
	}?>
	<p class="testimonial">
	<?php
	echo $testimonial; ?></p></td>
	</tr>
<?php
}

/* mysqli_query($con,"UPDATE `poruke` SET isRead=1 WHERE id=$ID"); */
?>				
</table>
<?php if($approved == 1){
	echo '<button id="approve'.$id.'" style="width:calc(50% - 10px); height:40px; border-radius:5px; border:none; padding:5px; margin:5px 0;background-color:#dc3545;color:#fff" onclick="disapprove('.$id.')">DISAPPROVE</button>';
}else{
	echo '<button id="approve'.$id.'" style="width:calc(50% - 10px); height:40px; border-radius:5px; border:none; padding:5px; margin:5px 0;background-color:#941046;color:#fff" onclick="approve('.$id.')">APPROVE</button>';	
}
?>	
<button style="width:50%; height:40px; border-radius:5px; border:none; padding:5px; margin:5px 0 5px 5px;background-color:#dc3545;color:#fff" onclick="deleteT(<?php echo $id; ?>)">DELETE</button>		
</div>
<script language="JavaScript" type="text/javascript">
function deleteT(id){
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
				url: "deltestimonial.php?id="+id,
				contentType: "application/json; charset=utf-8",
				dataType: "JSON",
				success:function (data) {
					if(data.state == 'true'){
						swal("Testimonial deleted", {							
						}).then((value) => {
							window.location="cms.php?cms=testimonials";
						});
					}else{
						swal("Error with approving");
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
		url: "approvetestimonial.php?id="+id,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Testimonial approved. Now it will be visible on your page!");
				var idrow="#approve"+id;
				var idd = "approve"+id;
				$(idrow).css('background-color','#dc3545');
				idrow.innerHTML = '';
				document.getElementById(idd).innerHTML ='DISAPPROVE';
				jQuery(idrow).unbind('click');
				$(idrow).attr("onclick","disapprove("+id+")");
			}else{
				swal("Error with approving");
			}			
		}, error:function(data){
			swal("Error with approving");
		}
	});     
}

function disapprove(id){
	$.ajax({
		type:"POST",
		url: "disapprovetestimonial.php?id="+id,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Testimonial disapproved. Now it will not be visible on your page!");
				var idrow="#approve"+id;
				var idd = "approve"+id;
				$(idrow).css('background-color','#941046');
				idrow.innerHTML = '';
				document.getElementById(idd).innerHTML ='APPROVE';
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
 
</script>