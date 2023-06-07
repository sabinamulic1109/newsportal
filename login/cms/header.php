
	<!-- CORE CSS-->
	<link href="cms/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="cms/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="cms/css/main.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="cms/css/font-awesome/all.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="cms/css/font.css" rel="stylesheet">
	<link href="cms/css/summernote-lite.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/x-icon" href="cms/images/geologo.png">
  <!-- Custome CSS-->    


  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <?php if(isset( $_SESSION['myusername'])){ ?>
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color" style="background-color:#941046;">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="" class="brand-logo" ><img style="height: 50px;" src="../login/cms/images/geologo.png" ></a> <span class="logo-text"><?php echo $naslovXV; ?></span></h1></li>
                    </ul>
					
					
					<ul class="right hide-on-med-and-down">
					<li class="welcome-li">Welcome to VicitCMS, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;color:#white;padding-left:10px; text-transform: uppercase;"> <?php echo $_SESSION['myusername']; ?> </span></li>
					<li ><a href="odjava.php"><i class="fa fa-sign-out-alt"></i></a></li>

					</ul>
                        
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <?php }else{ ?> 

  <?php } ?>
  <!-- END HEADER -->