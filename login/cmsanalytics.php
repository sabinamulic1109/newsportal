<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
?>
<link rel="stylesheet"  href="css/chartist.css">

<h1>Your website analytics</h1>

<div class="row">
	<div class="col-md-12" style="text-align:left">
		<h3>This is the page where you can see statistics of your website.</h3>
	</div>
</div>
<hr>

<?php
$mjeseci = ['Jan','Feb','Mar','Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
$godina = date('Y');
$sve = array();
$ukupno = array();
$ovegodine = '';
$izzemlje = '';
$izzemljesve = '';

for($i = 0; $i <12;$i++){
	$month = $mjeseci[$i];
	$sql = "SELECT count(date) as number, month from tblvisits where month = '$month' and year = $godina"; 
	$result = mysqli_query ($con,$sql); 
	while($row = mysqli_fetch_array($result)){
		$sve[] =array('number' => $row['number'], 'month' => $month);	
	}
}

$sql = "SELECT count(date) as number, ANY_VALUE(month) from tblvisits"; 
$result = mysqli_query ($con,$sql);
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$ukupno[] =array('number' => $row['number']);	
	}
} 


$sql = "SELECT count(date) as number, ANY_VALUE(month) from tblvisits where year = $godina"; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$ovegodine = $row['number'];	
	}
}

$sql = "SELECT count(date) as number, country from tblvisits where year = '$godina' group by country order by number DESC LIMIT 1"; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$izzemlje = $row['country'];	
	}
}

$sql = "SELECT count(date) as number, country from tblvisits  group by country order by number DESC LIMIT 1"; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$izzemljesve = $row['country'];	
	}
}
$zemlje = array();
$sql = "SELECT count(date) as number, country from tblvisits where year = '$godina' group by country order by number DESC "; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$zemlje[] = $row;	
	}
}

$novosti = array();
$sql = "SELECT visits, naslov from novosti  order by visits DESC LIMIT 5 "; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$novosti[] = $row;	
	}
}

$stranice = array();
$sql = "SELECT visits, naslov from tekst order by visits DESC LIMIT 5 "; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$stranice[] = $row;	
	}
}

$brnovosti = '';
$sql = "SELECT count(naslov) as broj from novosti"; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$brnovosti = $row['broj'];	
	}
}


$brstranica = '';
$sql = "SELECT count(naslov) as broj from tekst"; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$brstranica = $row['broj'];	
	}
}

$brusera = '';
$sql = "SELECT count(user) as broj FROM admin where user != 'superadmin' "; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$brusera = $row['broj'];	
	}
}

$aktivniuser = array();
$sql = "SELECT count(id) as aktivnost, user FROM userlog GROUP BY user ORDER BY aktivnost DESC"; 
$result = mysqli_query ($con,$sql); 
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$aktivniuser[] = $row;	
	}
}
?>
<style>
.panel-body{
	background: #fff;
    border: 1px solid #eaeaea;
    border-radius: 2px;
    padding: 20px;
	position: relative;
}	
.stats-title{
    text-transform: uppercase;
    font-size: 20px;
    font-weight: 600;
}
.stats-title2{
    text-transform: uppercase;
    font-weight: 600;
}
#sredina{
	border-left: 1px solid #eee; 
	border-top: none;  
	padding-left:5%;
}
@media (max-width:999px){
	#sredina{
		border-top: 1px solid #eee;  
		border-left: none;
		padding-left:15px;
	}
}

</style>
<div class="row">
	<div class="col-md-12" style="text-align:left">
		<div class="panel-body h-200 row">
			<div class="col-md-9">
				<h4 class="stats-title">Page statistics</h4>
			</div>
			<div class="col-md-3" style="text-align:right">
				<h4 class="stats-title"> <i class="fas fa-desktop"></i></h4>
			</div>

			<div class="col-md-3">
				<h5 class="stats-title2">This year</h5>
				<h1 class="text-success"><?php echo $ovegodine; ?></h1>
			</div>
			<div class="col-md-3" >
				<h5 class="stats-title2">Most visits from:</h5>
				<h1 class="text-success" style="font-size: 25px;"><?php echo $izzemlje; ?></h1>
			</div>
			
			<div class="col-md-3" id="sredina" >
				<h5 class="stats-title2">Page Views through years</h5>
				<h1 class="text-success"><?php echo $ukupno[0]['number']; ?></h1>
			</div>
			<div class="col-md-3" >
				<h5 class="stats-title2">Most visits from:</h5>
				<h1 class="text-success" style="font-size: 25px;"><?php echo $izzemljesve; ?></h1>
			</div>
		</div>
		
		<div class="panel-body row" >
			<div class="col-md-8 " style="text-align:left; padding:0">
				<h4 class="stats-title">Page views per month</h4>
				<div id="ct-chart7" style="height:350px"></div>
			</div>
			
			<div class="col-md-4" style="text-align:left">
				<h4 class="stats-title">Page views this year per country</h4>
				<table>
					<thead>
						<tr>
							<th>Country</th>
							<th>Number of views</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach($zemlje as $z){ ?>
						<tr>
							<td><?php echo $z['country']; ?></td>
							<td><?php echo $z['number']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="panel-body row" >
			<div class="col-md-4 " style="text-align:left; padding:0">
				<h4 class="stats-title">Most visited pages</h4>
				
				<div id="ct-chart1" style="height:350px"></div>
				
				
			</div>
			
			<div class="col-md-4" style="text-align:left">
				<h4 class="stats-title">Top 5 articles</h4>
				
				<div id="ct-chart2" style="height:350px"></div>
			</div>
			
			<div class="col-md-4" style="text-align:left">
				<h5 class="stats-title" style="font-size:28px">CMS stats</h5>
				
				<h2 class="stats-title2">Number of CMS users <span style="float:right" class="text-success"><?php echo $brusera; ?></span></h2>
				
				<h2 class="stats-title2">Most active CMS user <span style="float:right" class="text-success"><?php echo $aktivniuser[0]['user']; ?></span></h2>
				
				<h2 class="stats-title2">Articles <span style="float:right" class="text-success"><?php echo $brnovosti; ?></span></h2>
				
				<h2 class="stats-title2">Pages <span style="float:right" class="text-success"><?php echo $brstranica; ?></span></h2>
			</div>
		</div>
		
		
	</div>
	
</div>




<script src="js/chartist.min.js" ></script>

<script type="text/javascript">

var labele = [];
var values = [];

var jsonData = <?php echo json_encode($sve,true); ?>;
$.each(jsonData, function (key, value) {
	labele.push(value.month);
	values.push(value.number);
});	

/*	
$(function () {
	new Chartist.Line('#ct-chart7', {
		labels: labele,
		series: [ values
		]
	}, {
		low: 0,
		showArea: true
	});
});*/


new Chartist.Line('#ct-chart7', {
  labels: labele,
  series: [
    values
  ]
}, {
  fullWidth: true,
  chartPadding: {
    right: 40
  }
});

var labelen = [];
var valuesn = [];

var jsonData = <?php echo json_encode($novosti,true); ?>;

$.each(jsonData, function (key, value) {
	labelen.push(value.naslov);
	valuesn.push(value.visits);
});	

var labelep = [];
var valuesp = [];

var jsonData = <?php echo json_encode($stranice,true); ?>;
var max = jsonData[0].visits;
max = parseInt(max) + 1;
$.each(jsonData, function (key, value) {
	labelep.push(value.naslov);
	valuesp.push(value.visits);
});

/* Pages chart */

var data = {
  labels: labelep,
  series: [
    valuesp
  ]
};

var options = {
  high: max,
  low: 0
};

new Chartist.Bar('#ct-chart1', data, options);

/* News chart */

new Chartist.Bar('#ct-chart2', {
  labels: labelen,
  series: [
    valuesn
  ]
}, {
  seriesBarDistance: 10,
  reverseData: true,
  horizontalBars: true,
  axisY: {
    offset: 70
  }
});

</script>
