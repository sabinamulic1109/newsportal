<?php
$admins = array();

$sql = "SELECT a.id, a.user, a.email, m.sendmail
		FROM admin a
		LEFT JOIN sendmailadmin m ON
		a.id = m.admin
		where lower(type)='admin' and a.user != 'superadmin'"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$admins[] = $row;
}
?>

<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Email receivers list</h3> 	
<br><br>
<table >
<tr>
	<th style="padding:15px 5px">Administrator</th>
	<th style="width:100px; padding:15px 5px">Send emails</th>
</tr>
<?php foreach($admins as $admin){?>
<tr>
	<td><?php echo $admin['user']; ?></td>
	<td style="width:100px;text-align:center">
	<?php if($admin['sendmail'] == 1){ ?>
		<input type="checkbox" id="admin<?php echo $admin['id']; ?>" name="checkiran" value="<?php echo $admin['id']; ?>" checked />
		<label for="admin<?php echo $admin['id']; ?>"></label>

	<?php }else{ ?>
		<input type="checkbox" id="admin<?php echo $admin['id']; ?>" name="checkiran" value="<?php echo $admin['id']; ?>" />
		<label for="admin<?php echo $admin['id']; ?>"></label>
	<?php } ?>
	</td>
</tr>

<?php }?>
</table>
<button onclick="setadmin()" style="background-color: #941046;" class="submitBtn">Save changes</button>



</div>
<script>
function setadmin(){
	var provjera = '';
	var checkboxes = document.querySelectorAll('input[name="checkiran"]'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);		
    });
	$.each(values, function (key, value) {
		var id = "admin"+value;
		var check = document.getElementById(id);
		if(check.checked == true){
			var checked = 1;
		}else{
			var checked = 0;
		}
		 $.ajax({
			type:"POST",
			url: "setAdmin.php?id="+value+"&&check="+checked,
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
		
	});
	
	
}
function provjeraF(provjera){
	if(provjera == true){
		swal('Changes are saved');
	}else{
		swal('Something went wrong');	
	}
}
</script>