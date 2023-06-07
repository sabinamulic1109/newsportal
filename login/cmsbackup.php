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

<h3 style="text-align:center;text-transform:uppercase">Please make a back up</h3> 	
<br><br>

<button onclick="backup()" style="background-color: #941046;"  class="submitBtn">Backup database</button>


<h3 style="text-align:center;text-transform:uppercase">On which day do you want to backup database</h3> 	
<br><br>
	<input type="checkbox" id="monday" name="dani" value="1"  />
	<label for="monday">Monday</label>
	<input type="checkbox" id="tuesday" name="dani" value="2" />
	<label for="tuesday">Tuesday</label>
	<input type="checkbox" id="wednesday" name="dani" value="3"  />
	<label for="wednesday">Wednesday</label>
	<input type="checkbox" id="thursday" name="dani" value="4"/>
	<label for="thursday">Thursday</label>
	<input type="checkbox" id="friday" name="dani" value="5"  />
	<label for="friday">Friday</label>
	<input type="checkbox" id="saturday" name="dani" value="6" />
	<label for="saturday">Saturday</label>
	<input type="checkbox" id="sunday" name="dani" value="7" />
	<label for="sunday">Sunday</label>


<h3 style="text-align:center;text-transform:uppercase">Choose which admins to receive notification for back up</h3> 	
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
<button onclick="setadmin()" style="background-color: #941046;"  class="submitBtn">Save changes</button>



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
			url: "setAdminBackup.php?id="+value+"&&check="+checked,
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
function backup(){
	 $.ajax({
		type:"POST",
		url: "backupdata.php",
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			console.log(data);
			var link = document.createElement("a");
			link.download = data.name;
			link.href = data.path+data.name+'.sql.zip';
			console.log(link.href);
			link.click();
		}, error:function(data){
			console.log(data);
		}
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