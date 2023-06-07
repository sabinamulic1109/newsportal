<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['content'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';	
}
?>
<style type="text/css">
</style>
<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Add new content</h3>
<form action="addcontent.php" method="post" enctype="multipart/form-data" name="form1" id="form1">		 
<input type="text" name="naslov"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title" required> 	 
<input type="submit" name="Submit" style="background-color: #941046;" value="       INSERT      " class="submitBtn"> 

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
<h3 style="text-align:center;text-transform:uppercase">Your added content</h3>
<div class="col-sm-12" style="padding:0">
	<input placeholder="Type at least 3 characters to search..." id="search-input" class="form-control" type="text"  onkeyup="search(this.value)">
</div>
<div id="ajaxglavni">


</div>
<p id="pretraga" style="margin-top:100px;position:relative">No results</p>
</div>		
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
			window.location.href = "deltext.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}

$(document).ready(function(){
	pagination(1);	
});

function pagination(page){
	$.ajax({
		type:'GET',
		url: "ajax/getcontent.php?page="+page,
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
		$('#tablecontent').css('display','table');
		$('#pagesN').css('display','block');
	} else {
		b = a.replace(" ",".");
		$.ajax({
		type:"POST",
		url: "search.php?type=content&&search="+b,
		contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			
			if(data.length > 0){
				$('#pretraga').css('display','none');
				$('#pagesN').css('display','none');
				var tabela = document.getElementById('tablecontent');
				$('#tablecontent').empty();
				$('#tablecontent').css('display','table');
				
				var tr = document.createElement("tr");
				tr.style="font-weight:bold";	
				tabela.appendChild(tr);
				var td1 = document.createElement("td");
				td1.width = "80%";	
				td1.innerHTML ="Title";
				td1.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td1);
				var td3 = document.createElement("td");
				td3.width = "20%";	
				td3.innerHTML ="Action";
				td3.style = "border-bottom:#999999 solid 2px;";	
				tr.appendChild(td3);
				
				var content = data;
				var duzina = content.length;
				for(i=0;i<duzina;i++){
					var tr = document.createElement("tr");		
					tabela.appendChild(tr);
					
					
					var td1 = document.createElement("td");
					td1.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td1);
					
					var naslov = document.createElement("p");
					naslov.style="font-weight:bold";
					naslov.innerHTML=content[i].naslov;
					td1.appendChild(naslov);
					
					
					var td3 = document.createElement("td");
					td3.style = "border-bottom:#999999 solid 1px;";	
					tr.appendChild(td3);
					
					var div = document.createElement("div");
					div.className="nnP";
					td3.appendChild(div);
					
					var edit = document.createElement("a");
					edit.href = "cms.php?cms=content2&&id="+content[i].id;
					edit.style="color:#fff";
					edit.innerHTML="Edit";
					div.appendChild(edit);
					
					var div = document.createElement("div");
					div.className="nnD";
					td3.appendChild(div);
					
					var del = document.createElement("a");
					del.id="del"+content[i].id;
					del.style="color:#fff";
					del.innerHTML="Delete";
					div.appendChild(del);
					$("#del"+content[i].id).attr('onclick','checkDelete('+content[i].id+')');
				}	
			}else{
				$('#tablecontent').css('display','none');
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
</div>


