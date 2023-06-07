<?php
	if(!isset($_SESSION['myusername'])){
		echo '<script>window.location.href = "index.php?msg=2"</script>';	
	}

?>
<link href="css/lightslider.css" rel="stylesheet">	
<script type="text/javascript" src="js/lightslider.js"></script>
<link rel="stylesheet"  href="css/chartist.css">
<h1>Welcome To Administration Page</h1>

<div class="row">
	<div class="col-md-7" style="text-align:left">
		<h3>Manage your website data with this CMS</h3>
	</div>
	<div class="col-md-5" style="text-align:right">
		<p style="font-size:18px;margin:1em 0">Download instructions<a href="cms.pdf" download> <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:28px;"></i> </a></p>
	</div>
</div>

<div class="row">
	<div class="col-md-7" style="text-align:left">
		<h3>Quick navigation</h3>
	</div>
	<div class="col-md-12" style="text-align:center">
		<span style="max-width:145px; font-size: 25px; height: 40px;" class="nnP QB" style="background-color:#941046;">
			<a href="cms.php?cms=news&&form=1"  style="color: rgb(255, 255, 255);font-size:14px" ><i class="fa fa-plus"></i> Add new article</a>
		</span> 
		<span style="max-width:145px; font-size: 25px; height: 40px;" class="nnP QB" style="background-color:#941046;"> 
			<a href="cms.php?cms=photo"  style="color: rgb(255, 255, 255);font-size:14px" ><i class="fa fa-plus"></i> Add new photo</a>
		</span>
	</div>
</div>


<hr>
<div class="row">
	<div class="col-md-7" style="text-align:left">
		<h4>How to use your CMS</h4>
		<p>Our support team is happy to help you with every question you have about managing your website through CMS. 
		If you have any problems, you can contact us.</p>
	</div>
	<div class="col-md-5">
		<h4>Support</h4>
		<a href="cms.php?cms=support" style="text-transform:uppercase; font-weight:bold; font-size:1rem">Contact us</a>
	</div>
</div>
<hr>
<div class="row"> 
	<ul id="responsive" class="gallery content-slider list-unstyled clearfix ">
		<li>
			<h4 style="padding-top:15px">How to login to your CMS</h4>
			<a href="https://www.youtube.com/watch?v=NGDO4ogn9dI" target="_blank">
				<img src="howto/login.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Setting up your page</h4>
			<a href="https://www.youtube.com/watch?v=mtb3aNEbncY" target="_blank">
				<img src="howto/settings.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Your social media</h4>
			<a href="https://www.youtube.com/watch?v=mtb3aNEbncY" target="_blank">
				<img src="howto/sociallinks.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Add pages to website</h4>
			<a href="https://www.youtube.com/watch?v=EL-sWMS5JX8" target="_blank">
				<img src="howto/pages.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Managing with menu bar</h4>
			<a href="https://www.youtube.com/watch?v=-tgNxAD5iy4&t=2s" target="_blank">
				<img src="howto/menu.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Adding news</h4>
			<a href="https://www.youtube.com/watch?v=eHhTHXggstM" target="_blank">
				<img src="howto/news.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Manage with gallery</h4>
			<a href="https://www.youtube.com/watch?v=HUiB3XeMk8g" target="_blank">
				<img src="howto/gallery.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Add files</h4>
			<a href="https://www.youtube.com/watch?v=KF-DAlXC50o" target="_blank">
				<img src="howto/files.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Reservations</h4>
			<a href="https://www.youtube.com/watch?v=fppSikMjjR0" target="_blank">
				<img src="howto/reservation.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Testimonials</h4>
			<a href="https://www.youtube.com/watch?v=uKRBuAcD9vc" target="_blank">
				<img src="howto/testimonial.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">FAQ</h4>
			<a href="https://www.youtube.com/watch?v=ue6XsK8Btw8" target="_blank">
				<img src="howto/faq.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Messages</h4>
			<a href="https://www.youtube.com/watch?v=bohYkPd8OFU" target="_blank">
				<img src="howto/message.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Users</h4>
			<a href="https://www.youtube.com/watch?v=aA9JKWrQbyo" target="_blank">
				<img src="howto/message.png" style="width:100%">
			</a>
		</li>
		<li>
			<h4 style="padding-top:15px">Support</h4>
			<a href="https://www.youtube.com/watch?v=of-zZtc2NAc" target="_blank">
				<img src="howto/support.png" style="width:100%">
			</a>
		</li>
	</ul>
</div>

<?php
$mjeseci = ['Jan','Feb','Mar','Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
$godina = date('Y');
$sve = array();
$ukupno = array();
for($i = 0; $i <12;$i++){
	$month = $mjeseci[$i];
	$sql = "SELECT count(date) as number, month from tblvisits where month = '$month' and year = $godina"; 
	$result = mysqli_query ($con,$sql); 
	while($row = mysqli_fetch_array($result)){
		$sve[] =array('number' => $row['number'], 'month' => $month);	
	}
}

$sql = "SELECT count(date) as number, month from tblvisits"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$ukupno[] =array('number' => $row['number']);	
}

$sql = "SELECT count(date) as number, month from tblvisits where year = $godina"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$ovegodine = $row['number'];	
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
</style>

<div class="row">
	<div class="col-md-4" style="text-align:left">
		<div class="panel-body h-200 row">
			<div class="col-md-9">
				<h4 class="stats-title">Page statistics</h4>
			</div>
			<div class="col-md-3" style="text-align:right">
				<h4 class="stats-title"> <i class="fas fa-desktop"></i></h4>
			</div>
			<div class="col-md-12" >
				<h5 class="stats-title2">All Page Views</h5>
				<h1 class="text-success"><?php echo $ukupno[0]['number']; ?></h1>
			</div>
			<div class="col-md-12" >
				<h5 class="stats-title2">This year</h5>
				<h1 class="text-success"><?php echo $ovegodine; ?></h1>
			</div>
		</div>
	</div>
	<div class="col-md-8 panel-body h-200 " style="text-align:left">
		<h4 class="stats-title">Page views this year</h4>
		<div id="ct-chart7" style="height:350px"></div>
	</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#responsive').lightSlider({
        item:4,
        loop:true,
        slideMove:2,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        speed:600,
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:3,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:1,
                    slideMove:1
                  }
            }
        ]
    });  
  });
</script>
<script src="js/chartist.min.js" ></script>
<script type="text/javascript">
var labele = [];
var values = [];
var jsonData = <?php echo json_encode($sve,true); ?>;
$.each(jsonData, function (key, value) {
	labele.push(value.month);
	values.push(value.number);
	console.log(value.number);
});	

$(function () {
	new Chartist.Line('#ct-chart7', {
		labels: labele,
		series: [ values
		]
	}, {
		low: 0,
		showArea: true
	});
});
</script>