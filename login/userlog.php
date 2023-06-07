<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}

$sql = "SELECT * from userlog where user != 'superadmin' order by id desc"; 
$logs = array();
$result = mysqli_query ($con,$sql); 

while($row = mysqli_fetch_array($result)){
	$logs[] = $row;
}
?>
<style>
#dataTable_length{
	display:none
}
#dataTable{
	max-width:100vw
}
.col-sm-12{
	padding:0
}
.dataTables_wrapper .dataTables_filter {
    float: left;
    text-align: right;
	width:100%;
}
.dataTables_wrapper .dataTables_filter input {
   width:67vw;
   border-radius:5px;
   height:35px
}
</style>
<link rel="stylesheet" type="text/css" href="cms/css/datatables.min.css"/>
<p style="font-size:18px;">	<br> Download userlog as text file: <a href="userLog.txt" download style="cursor:pointer"> <i class="fa fa-file-alt" aria-hidden="true" style="font-size:28px;"></i> </a></p>
<script type="text/javascript" src="cms/js/datatables.min.js"></script>
<div class="col-sm-12" style="overflow:hidden;margin-top:25px">
<table id="dataTable"  cellspacing="0" style="border:none;width:100%"> 
	<thead>
	<tr >
		<th style="display:none"></th>
		<th>User</th>
		
		<th>Action</th>
		<th>Date</th>
		
	
		</tr>
	</thead> 
	<tbody>    
	</tbody>
</table>
</div>
<script>

$(document).ready(function(){
	var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
	var jsonData = <?php echo json_encode($logs,true); ?>;
		$('#dataTable').dataTable({
			data: jsonData,
			responsive: true,
			"columnDefs": [
					{
						"targets": [ 0 ],
						"visible": false,
						"searchable": false
					}
				],
			"order": [[ 0, "desc" ]],
			"searching": true,
			 
		    columns: [
			{     "data"     :     "id"     }, 
			{     "data"     :     "user"     },
			{     "data"     :     "action"     },
			{
				 sName: "date",
				 mDataProp: function (source, type, val) {
					 if(source["date"]!="undefined"){
						 var datum = source["date"].substring(0, 10);					
						 return new Date(datum)
							.toLocaleDateString('en-US',options)
					 }
				 }, bSortable: false
			 },	
    		]
	}); 
});

</script>