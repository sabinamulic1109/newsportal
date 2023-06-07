

<?php
/* number unread messages */
$sql="SELECT * FROM poruke WHERE isRead=0";
$result=mysqli_query($con,$sql);
$nomsg=mysqli_num_rows($result);

$sql="SELECT * FROM orders WHERE order_status=0";
$result=mysqli_query($con,$sql);
$noauthO=mysqli_num_rows($result);


$sql = "SELECT COUNT(comment_id) AS total FROM notifikacije where comment_status=0";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);



$sql="SELECT * FROM ordersPP WHERE order_status=0";
$result=mysqli_query($con,$sql);
$noPPO=mysqli_num_rows($result);

$noshop=$noPPO+$noauthO;
/* number unapproved testimonials */
$sql="SELECT * FROM testimonials WHERE approved=0";
$result=mysqli_query($con,$sql);
$notmn=mysqli_num_rows($result);
/* number unapproved faq */
$sql="SELECT * FROM tblfaq WHERE approved=0";
$result=mysqli_query($con,$sql);
$notfaq=mysqli_num_rows($result);
/* get roles */
$username = $_SESSION['myusername'];
$getId = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM admin WHERE user = '$username'"));
$userId = $getId['id'];
$roles = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM roles WHERE userid = $userId"));
/* number unread messages faq */
$sql="SELECT ms.status,ms.type,  m.id AS msgid, m.date, m.subject, a.user as sender
			FROM messagestatus ms
			INNER JOIN mymessages m ON
				m.id = ms.message
			INNER JOIN admin a ON
			 a.id = m.sender
		WHERE
			LOWER(ms.status) = 'inbox' and ms.user = $userId and ms.type=0";
$result=mysqli_query($con,$sql);
$nepro=mysqli_num_rows($result);

?>
<aside id="left-sidebar-nav">
	<ul id="slide-out" class="side-nav fixed leftside-navigation" style="width:190px">
		<li class="user-details">
		<div class="row">
			<div class="col col s12 m12 l12" style="text-align:center">
					<img src="cms/images/admin.jpg" alt="" class="circle responsive-img valign profile-image" style="height:60px;width:60px; border-radius:50%">
				</div>
			<div class="col col s12 m12 l12">

				 <ul id="profile-dropdown" class="dropdown-content">
					<li><a href="cms.php?cms=mymessages">My messages</a>
					</li>
					
					</li>
				</ul> 
				<a class="btn-flat dropdown-button waves-effect waves-light profile-btn" href="#" data-activates="profile-dropdown">
				<i class="fa fa-sort-down" style="float: right !important;margin-right: 0!important; font-size: 1rem; line-height: 33px;"></i>
				<?php echo $_SESSION['myusername']; ?>
				<?php if($nepro >0){
					?>
					<span style="color:#941046">(<?php echo $nepro; ?>)</span>
					<?php
				}?>				
				</a>
				<p class="user-roal" style="font-size: 10px;" ><?php echo $_SESSION['email']; ?></p>
			</div>
		</div>
		</li>
		<?php $aktivan = $_GET['cms']; 			 
		?>

		
		<li><a href="cms.php?cms=welcome" class="waves-effect waves-primary" <?php if($aktivan=='welcome'){ ?> style="color:#941046;" <?php } ?>>
			<i class="fa fa-home"></i><span> Welcome </span>
		   </a> 
		</li>
		<li  style="" ><a href="<?php echo $domenaXV; ?>" class="waves-effect waves-primary" target="_blank">
			<i class="fa fa-laptop"></i><span> Preview </span>
		   </a> 
		</li>
		<li>
			 <li class="dropdown">

         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i>Notifikacije (<?php echo $data['total'];?>)
              </a>

            <ul class="dropdown-menu"></ul>

            </li> </span>
		    
		</li>

		<?php if($roles['settings'] == '1' || $userId == '7'){?>
		<li  class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li class="bold"><a class="collapsible-header waves-effect waves-cyan" <?php if($aktivan=='settings'){ ?> style="color:#941046;" <?php } ?>><i class="fa fa-cog"></i><span> Settings </span> </a>
					<div class="collapsible-body" style="">
						<ul style="background-color:#f5f5f5">
							<?php if($roles['settings'] == '1' ){?>
							<li>
								<a href="cms.php?cms=settings" class="waves-effect waves-primary dropmenu"   style="font-size: 11px!important;color:#444!important;">
									<span>Basic settings</span>
								</a> 
							</li>
							<?php } ?>
							<li>
								<a href="cms.php?cms=socialmediaconnect" class="waves-effect waves-primary dropmenu"   style="font-size: 11px!important;color:#444!important;">
									<span>Social media</span>
								</a>
							</li>	
						</ul>
					</div>
				</li>
			</ul>
		</li>	 
			

		<?php } ?>
		
		
		
		
		<?php if($roles['slider'] == '1'){?>
		<li>
			<a href="cms.php?cms=header" class="waves-effect waves-primary" <?php if($aktivan=='header'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-image"></i><span> Header image </span>
			</a> 
		</li>
		<?php } ?>
	<!--	<?php if( $userId != 7){?>
		<li style=""  class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-store"></i> Shop <?php if($noshop>0){echo '('.$noshop.')';} ?></a>
					<div class="collapsible-body" style="">
						<ul style="margin-left: -30px!important;">
							<li >
								<a href="cms.php?cms=products4" class="waves-effect waves-primary dropmenu" <?php if($aktivan=='products4' || $aktivan=='products5'){ ?> style="color:#941046;" <?php } ?>>
									<i class="fa fa-sitemap"></i><span>Categories </span>
								</a> 
							</li>
						
							<li >
								<a href="cms.php?cms=products" class="waves-effect waves-primary dropmenu" <?php if($aktivan=='products' || $aktivan=='products2' || $aktivan=='products3'){ ?> style="color:#941046;" <?php } ?>>
									<i class="fa fa-truck-loading"></i><span>Products </span>
								</a> 
							</li>
							
							
							
							<li class="no-padding">
								<ul class="collapsible collapsible-accordion">
									<li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="fas fa-shopping-basket"></i> Orders </a>
										<div class="collapsible-body" style="">
											<ul style="margin-left: 10px!important;">
												<li >
													<a href="cms.php?cms=ordersAuth" class="waves-effect waves-primary dropmenu" <?php if($aktivan=='ordersAuth' || $aktivan=='ordersAuth2'){ ?> style="    font-size: 11px!important;color:#941046!important;" <?php } else{ ?> style="    font-size: 11px!important;color:#444!important;" <?php } ?>>
														<i class="fa fa-credit-card"></i><span>Authorize <?php if($noauthO>0){echo '('.$noauthO.')';} ?></span>
													</a> 
												</li>
												
													<li >
														<a href="cms.php?cms=ordersPP" class="waves-effect waves-primary dropmenu" <?php if($aktivan=='ordersPP' || $aktivan=='ordersPP2'){ ?> style="    font-size: 11px!important;color:#941046!important;" <?php } else{ ?> style="    font-size: 11px!important;color:#444!important;" <?php } ?>>
															<i class="fab fa-paypal"></i><span>Paypal <?php if($noPPO>0){echo '('.$noPPO.')';} ?></span>
														</a> 
													</li>	
											</ul>
										</div>
									</li>
								</ul>
							</li>
							
							<li class="no-padding">
								<ul class="collapsible collapsible-accordion">
									<li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-user-check"></i> Customers </a>
										<div class="collapsible-body" style="">
											<ul style="margin-left: 10px!important;">
												<li >
													<a href="cms.php?cms=customersAuth" class="waves-effect waves-primary dropmenu" <?php if($aktivan=='customersAuth' || $aktivan=='customersAuth2' || $aktivan=='customersAuth3'){ ?> style="    font-size: 11px!important;color:#941046!important;" <?php } else{ ?> style="    font-size: 11px!important;color:#444!important;" <?php } ?>>
														<i class="fa fa-address-card"></i><span>Authorize</span>
													</a> 
												</li>
												
													<li >
														<a href="cms.php?cms=customersPP" class="waves-effect waves-primary dropmenu" <?php if($aktivan=='customersPP' || $aktivan=='customersPP2' || $aktivan=='customersPP3'){ ?> style="    font-size: 11px!important;color:#941046!important;" <?php } else{ ?> style="    font-size: 11px!important;color:#444!important;" <?php } ?>>
															<i class="fab fa-cc-paypal"></i><span>Paypal</span>
														</a> 
													</li>	
											</ul>
										</div>
									</li>
								</ul>
							</li>
							
							
						</ul>
					</div>
				</li>
			</ul>
		</li>-->
		
		<?php } ?>
		
		
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-file"></i> Pages</a>
					<div class="collapsible-body" style="">
						<ul style="margin-left: -30px!important;">
							<?php if($roles['content'] == '1'){?>
							<li >
								<a href="cms.php?cms=content" class="waves-effect waves-primary dropmenu" <?php if($aktivan=='content' || $aktivan=='content2'){ ?> style="color:#941046;" <?php } ?>>
									<i class="fa fa-file"></i><span>Content</span>
								</a> 
							</li>
							<?php } ?>
							<?php if($roles['news'] == '1'){?>
							
							<li>	
								<a href="cms.php?cms=news" class="waves-effect waves-primary" <?php if($aktivan=='news' || $aktivan=='news2'){ ?> style="color:#941046;" <?php } ?>>
									<i class="fa fa-newspaper"></i> News 
								</a> 			
							</li>	
							<?php } ?>
							<?php if($roles['oglasi'] == '1'){?>
							
							<li>	
								<a href="cms.php?cms=oglasi" class="waves-effect waves-primary" <?php if($aktivan=='oglasi' || $aktivan=='oglasi2'){ ?> style="color:#941046;" <?php } ?>>
								<i class="fa fa-bullhorn"></i> Oglasi 
									
								</a> 			
							</li>	
							<?php } ?>
						<!--	<?php if($roles['jobs'] == '1'){?>
							
							<li>	
								<a href="cms.php?cms=jobs" class="waves-effect waves-primary" <?php if($aktivan=='jobs' || $aktivan=='jobs2'){ ?> style="color:#941046;" <?php } ?>>
								<i class="fa fa-tasks"></i> Poslovi 
									
								</a> 			
							</li>	
							<?php } ?>-->
						</ul>
					</div>
				</li>
			</ul>
		</li>
		
		
		
		
		
		

		<?php if($roles['slider'] == '1'){?>
		<!--
		<li >
			<a href="cms.php?cms=slider" class="waves-effect waves-primary" <?php if($aktivan=='slider' || $aktivan=='slider2'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-image"></i><span> Slider </span>
			</a> 
		</li> -->
		<?php } ?>
		<?php if($roles['menu'] == '1'){?>
		<li style="" >
			<a href="cms.php?cms=menu" class="waves-effect waves-primary" <?php if($aktivan=='menu' || $aktivan=='menu2' || $aktivan=='submenu' || $aktivan=='submenu2'){ echo 'aaa'; ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-bars"></i><span> Menu </span>
			</a> 
		</li>
		<?php } ?>

		<?php if($roles['gallery'] == '1'){?>
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li class="bold"><a class="collapsible-header waves-effect waves-cyan" <?php if($aktivan=='gallery' || $aktivan=='gallery2' || $aktivan=='photo'){ ?> style="color:#941046;" <?php } ?>><i class="fa fa-camera"></i> Photo Gallery </a>
					<div class="collapsible-body" style="">
						<ul style="background-color:#f5f5f5">
							<li >
								<a href="cms.php?cms=gallery" class="waves-effect waves-primary dropmenu"   style="font-size: 11px!important;color:#444!important;">
									<span>All galleries</span>
								</a> 
							</li>
							
								<li >
									<a href="cms.php?cms=photo" class="waves-effect waves-primary dropmenu"   style="font-size: 11px!important;color:#444!important;">
									<span>Add new photo</span>
								</a>
								</li>	
						</ul>
					</div>
				</li>
			</ul>
		</li>	
		<?php } ?>
		<li style="" >
			<a href="cms.php?cms=files" class="waves-effect waves-primary" <?php if($aktivan=='files'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-file"></i><span> Files </span>
			</a> 
		</li>
		<?php if($roles['reservations'] == '1'){?>
		<li style="" >
			<a href="cms.php?cms=reservations" class="waves-effect waves-primary" <?php if($aktivan=='reservations'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-calendar"></i><span> Reservations </span>
			</a> 
		</li>
		<?php } ?>
		<?php if($roles['testimonials'] == '1'){?>
		<li >
			<a href="cms.php?cms=testimonials" class="waves-effect waves-primary" <?php if($aktivan=='testimonials' || $aktivan=='testimonials2' || $aktivan=='addtestimonial'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-bell"></i><span> Testimonials <?php if($notmn>0){echo '('.$notmn.')';} ?></span>
			</a> 
		</li>
		<li >
			<a href="cms.php?cms=faq" class="waves-effect waves-primary" <?php if($aktivan=='faq'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-question"></i><span> FAQ <?php if($notfaq>0){echo '('.$notfaq.')';} ?></span>
			</a> 
		</li>
		<?php } ?>
		<?php if($roles['messages'] == '1'){?>
		<li >
			<a href="cms.php?cms=messages" class="waves-effect waves-primary" <?php if($aktivan=='messages' || $aktivan=='messages2' ){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-envelope"></i><span> Messages<?php if($nomsg>0){echo '('.$nomsg.')';} ?> </span>
			</a> 
		</li>
		<?php } ?>
		<?php if($roles['users'] == '1'){?>
		<li >
			<a href="cms.php?cms=users" class="waves-effect waves-primary" <?php if($aktivan=='users' || $aktivan == 'edituser'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-users"></i><span> Users </span>
			</a> 
		</li>
		<?php } ?>
		<li >
			<a href="cms.php?cms=support" class="waves-effect waves-primary" <?php if($aktivan=='support'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-headset"></i><span> Support </span>
			</a> 
		</li>
		<?php if($roles['userlogs'] == '1'){?>
		<li >
			<a href="cms.php?cms=userlog" class="waves-effect waves-primary" <?php if($aktivan=='userlog'){ ?> style="color:#941046;" <?php } ?>>
				<i class="fa fa-list-alt"></i><span> Users Logs </span>
			</a> 
		</li>
		<?php } ?>		
		<li style="margin-bottom:40px;">
			<a href="odjava.php" class="waves-effect waves-primary">
				<i class="fa fa-sign-out-alt"></i><span> Logout </span>
			</a> 
		</li>
		
		<li style="position:fixed;bottom:0px;background-color:white; z-index:10; width:185px" >
			<a class="waves-effect waves-primary" style="text-align:center">Version 2.0</a>
		</li>
	</ul>
	<a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="fa fa-bars"></i></a>
	
	
	</aside>

	<script>

$(document).ready(function(){

// updating the view with notifications using ajax

function load_unseen_notification(view = '')

{

 $.ajax({

  url:"fetchnotification.php",
  method:"POST",
  data:{view:view},
  dataType:"json",
  success:function(data)

  {

   $('.dropdown-menu').html(data.notification);

   if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification);
   }

  }

 });

}

load_unseen_notification();

// submit form and get new records

$('#comment_form').on('submit', function(event){
 event.preventDefault();

 if($('#subject').val() != '' && $('#comment').val() != '')

 {

  var form_data = $(this).serialize();

  $.ajax({

   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)

   {

    $('#comment_form')[0].reset();
    load_unseen_notification();

   }

  });

 }

 else

 {
  alert("Both Fields are Required");
 }

});

// load new notifications

$(document).on('click', '.dropdown-toggle', function(){

 $('.count').html('');

 load_unseen_notification('yes');

});

setInterval(function(){

 load_unseen_notification();;

}, 5000);

});

</script>