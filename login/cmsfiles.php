<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['gallery'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<script src="cms/js/summernote-lite.js"></script>
<style type="text/css">


#pagintxt{
	color:#000;
}
.nnD{
	cursor:pointer;
}
</style>


<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Add new file</h3>
<form action="addfile.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
 
<input type="text" name="naslov"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title" required > 
<input type="file" name="photo1" id="file"  style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)">  


<input type="submit" name="Submit" value="       INSERT      " class="submitBtn" style="background-color:#941046;"> 
	    
		  
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

<div class="col-sm-12" style="padding:0">
<br>
<br>
<h3 style="text-align:center;text-transform:uppercase">Your added files</h3>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<div id="ajaxglavni">


</div>
<p id="pretraga" style="margin-top:100px;position:relative">No results</p>
</div>			
</div>

<script language="JavaScript" type="text/javascript">

function copyText(pid) {
	console.log(pid);
	var copyText = document.getElementById(pid);
	copyText.select();
	document.execCommand("copy");
	swal("Link is copied");
}

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
			window.location.href = "delfile.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}

$(document).ready(function(){
	pagination(1);	
});

function pagination(page){
	var update = '<?php echo filemtime('ajax/getfiles.php'); ?>';
	$.ajax({
		type:'GET',
		url: "ajax/getfiles.php??m="+update+"&&page="+page,
		beforeSend:function(){
			
		},
		success:function(html){
			$('#pretraga').css('display','none');
			$('#ajaxglavni').empty();
			$('#ajaxglavni').append(html);				
		},error:function(html){
			console.log(html);
		}
	});
}
function search(a){
	if (a.length < 3) { 
		pagination(1);	
		$('#pretraga').css('display','none');
		$('#tablenews').css('display','block');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=file&&search="+b,
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
				td1.innerHTML ="File";
				td1.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td1);
				var td2 = document.createElement("td");
				td2.width = "60%";	
				td2.innerHTML ="Link";
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
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);
					
					var td1 = document.createElement("td");
					td1.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td1);
					
					var img = document.createElement("p");
					img.innerHTML=novosti[i].naslov;
					td1.appendChild(img);
					
					var td2 = document.createElement("td");
					td2.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td2);
					
					var naslov = document.createElement("p");
					naslov.style="font-weight:bold";
					naslov.innerHTML=novosti[i].file;
					td2.appendChild(naslov);

					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td3);
						
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