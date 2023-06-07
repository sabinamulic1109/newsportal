<?php
include('config.php');?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SLOBODA GOVORA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
  
    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body style="background-image: url('img/bg-login.jpg');   background-repeat: no-repeat;
  background-size: cover;">
<!-- Topbar Start -->

    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center bg-dark px-lg-5">
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-sm bg-dark p-0">
                    <ul class="navbar-nav ml-n2">
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="#">
                                <?php echo date("d.m.Y.");?> </a>
                        </li>
                        
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="contact.html">Kontakt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body small" href="login.php">Prijava</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 text-right d-none d-md-block">
                <nav class="navbar navbar-expand-sm bg-dark p-0">
                    <ul class="navbar-nav ml-auto mr-n2">
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-twitter"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-facebook-f"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-linkedin-in"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-instagram"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-google-plus-g"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-youtube"></small></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
          <div class="row align-items-center  py-3 px-lg-5" style="background-image:url('img/megafon.gif'); height:140px;">
            <div class="col-lg-4" style="margin-left:70px;">
                <a href="index.php" class="navbar-brand p-0 d-none d-lg-block">
                    <h1 class="m-0 display-4 text-uppercase text-info">OGLASNI<span class="text-secondary font-weight-normal">PORTAL</span>
                    SLOBODA<span class="text-secondary font-weight-normal">GOVORA</span></h1>

                </a>
            </div>
            
            
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-4 text-uppercase text-info">SLOBODA<span class="text-white font-weight-normal">GOVORA</span></h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">HOME</a>
                 <!--   <a href="category.html" class="nav-item nav-link">KATEGORIJE</a>-->
                    <a href="najnovije.php" class="nav-item nav-link">NAJNOVIJE</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">TEME</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="politika.php" class="dropdown-item">POLITIKA</a>
                            <a href="biznis.php" class="dropdown-item">BIZNIS</a>
                            <a href="crnahronika.php" class="dropdown-item">CRNA HRONIKA</a>
                            <a href="sport.php" class="dropdown-item">SPORT</a>
                            <a href="zdravlje.php" class="dropdown-item">ZDRAVLJE</a>
                            <a href="zabava.php" class="dropdown-item">ZABAVA</a>
                            <a href="nauka.php" class="dropdown-item">NAUKA</a>
                            <a href="ljepota.php" class="dropdown-item">LJEPOTA</a>
<a href="hrana.php" class="dropdown-item">HRANA</a>

                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">VIJESTI IZ..</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="regija.php" class="dropdown-item">REGIONA</a>
                            <a href="global.php" class="dropdown-item">SVIJETA</a>
                           
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">KONTAKT</a>
                </div>
                <form action="search.php" method="GET">
                <div class="input-group ml-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                    <input type="text" class="form-control border-0"name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Traži..">
    
                    <div class="input-group-append">
                        <button class="input-group-text bg-info text-dark border-0 px-3" type="submit"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div></form>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <br>
    <!-- Breaking News Start -->
    <?php 
				$sql = "SELECT * from novosti where visible = 1 order by id desc limit 3"; 
				$result = mysqli_query ($conn,$sql);
				$novosti = array();	
				while($row = mysqli_fetch_array($result)){
					$novosti[] = $row;
				}
				?>
    <div class="container-fluid bg-dark py-3 mb-3">
        <div class="container" >
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="bg-info text-dark text-center font-weight-medium py-2" style="width: 170px;">Najnovije vijesti</div>
                        
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                            style="width: calc(100% - 170px); padding-right: 90px;">
                             <?php
				foreach($novosti as $vijest){
				?>
<div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="single.php?id=<?php echo $vijest['id']; ?>">
    <?php echo $vijest['naslov']; ?>  <i style="font-size:10px; color:yellow;"><?php echo $vijest['podnaslov']; ?></i>
</a></div><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->

  

    <!-- Featured News Slider Start CRNA HRONIKA-->
    <div class="container-fluid pt-5 mb-3">
        <div class="container" >
            <div class="section-title">
                <h4 class="m-0 text-uppercase font-weight-bold">VIJESTI IZ PUTOVANJA</h4>
            </div>
            <?php 
				$sql = "SELECT * from novosti where visible = 1 and zanr='putovanje' order by id desc"; 
				$result = mysqli_query ($conn,$sql);
				$novosti = array();	
				while($row = mysqli_fetch_array($result)){
					$novosti[] = $row;
				}
				?>
            <div class="owl-carousel news-carousel carousel-item-4 position-relative">
            <?php
				foreach($novosti as $vijest){
				?>
                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid h-100" src="login/news/<?php echo $vijest['foto']; ?>" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                        </div>
                        <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="single.php?id=<?php echo $vijest['id']; ?>"><?php echo $vijest['naslov']; ?></a>
                        <small><?php echo date('d.m.Y.', strtotime($vijest['datum']));?></small>
                    </div>
                   

                </div><?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured News Slider End -->


    <!-- News With Sidebar Start -->
    <?php 
				$sql = "SELECT * from novosti where visible = 1 and zanr='putovanje'  order by id desc"; 
				$result = mysqli_query ($conn,$sql);
				$novosti = array();	
				while($row = mysqli_fetch_array($result)){
					$novosti[] = $row;
				}
				?>
  <div class="container-fluid" style="background-image: url('img/bg-login.jpg');   background-repeat: no-repeat;
  background-size: cover;">
        <div class="container" >
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                    <?php 
$sql = "SELECT * from oglasi where visible = 1 and position=1 limit 1"; 
$result = mysqli_query ($conn,$sql);
$oglasi = array();	
while($row1 = mysqli_fetch_array($result)){
    $oglasi[] = $row1;
}
            foreach ($oglasi as $horizontalno2) { ?>
        
                        <div class="col-lg-12 mb-3">
                            <a href="<?php echo $horizontalno2['link']; ?>">
                    <img class="img-fluid w-100" src="login/oglasi/<?php echo $horizontalno2['foto']; ?>" alt=""></a>
                        </div><?php } ?>
                
                        <div class="col-12">
                            
                        </div>
                        <?php foreach($novosti as $vijest) { ?>
                        <div class="col-lg-4">
                         <a href="single.php?id=<?php echo $vijest['id']; ?>">   
                         <div class="position-relative mb-3" >
                                <img class="img-fluid w-100" style="height:180px; " src="login/news/<?php echo $vijest['foto']; ?>" >
                                <div class="bg-white border border-top-0 p-4">
                                    <div class="mb-2">
                                        <a class="badge badge-info text-uppercase font-weight-semi-bold p-2 mr-2" style="font-size:8px;"
                                            href="single.php?id=<?php echo $vijest['id']; ?>"><?php echo $vijest['zanr']; ?></a>
                                    </div>
                                    <a style="font-size:10px;" class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="single.php?id=<?php echo $vijest['id']; ?>">
                                    <?php echo strip_tags(substr($vijest['naslov'],0,50)).''; ?></a>
                               <a  style="color:gray;"   href="single.php?id=<?php echo $vijest['id']; ?>"   >
                                 <p class="m-0" style="font-size:10px; text-align:justify; height:65px;"><?php echo strip_tags(substr($vijest['tekst'],0,150)).'...'; ?></p></a>
                                </div>
                               <!-- <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                                        <small>John Doe</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>
                                        <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                                    </div>
                                </div>-->
                            </div></a>
                        </div> <?php } ?>
                        
                             <!--   <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                                        <small>John Doe</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>
                                        <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                                    </div>
                                </div>-->
                        <div class="col-lg-6">
                           
                        </div>
                        <div class="col-lg-6">
                            
                        </div>
                        <div class="col-lg-6">
                         
                        </div>
                        <div class="col-lg-6">
            </div>
                        <div class="col-lg-12">
                            
                        </div>
                        <div class="col-lg-6">
                           
                        </div>
                        <div class="col-lg-6">
                           
                        </div>
                    </div>
                </div>
                
             <div class="col-lg-4">
                   <!--  Social Follow Start 
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Follow Us</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-3">
                            <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #39569E;">
                                <i class="fab fa-facebook-f text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Fans</span>
                            </a>
                            <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #52AAF4;">
                                <i class="fab fa-twitter text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Followers</span>
                            </a>
                            <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #0185AE;">
                                <i class="fab fa-linkedin-in text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Connects</span>
                            </a>
                            <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #C8359D;">
                                <i c lass="fab fa-instagram text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Followers</span>
                            </a>
                            <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #DC472E;">
                                <i class="fab fa-youtube text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Subscribers</span>
                            </a>
                            <a href="" class="d-block w-100 text-white text-decoration-none" style="background: #055570;">
                                <i class="fab fa-vimeo-v text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>
                                <span class="font-weight-medium">12,345 Followers</span>
                            </a>
                        </div>
                    </div> -->
                    <!-- Social Follow End --> 

                    <!-- Ads Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Oglas</h4>
                        </div>
                        

<?php 
$sql = "SELECT * from oglasi where visible = 1 and position=0 order by id desc "; 
$result = mysqli_query ($conn,$sql);
$oglasi = array();	
while($row1 = mysqli_fetch_array($result)){
    $oglasi[] = $row1;
}
?>
	                            <?php foreach ($oglasi as $oglasi) { ?>

                        <div class="bg-white text-center border border-top-0 p-3">
<a href="<?php echo $oglasi['link'];?>">
<img class="img-fluid" src="login/oglasi/<?php echo $oglasi['foto']; ?>" alt=""></a>
                        </div><?php }?>
                    </div> 
                    <!-- Ads End -->

  <!--                   Popular News Start -->
                     <!-- Popular News Start 
                     <?php 
				$sql = "SELECT * from novosti where visible = 1 order by id desc limit 9"; 
				$result = mysqli_query ($conn,$sql);
				$novosti = array();	
				while($row = mysqli_fetch_array($result)){
					$novosti[] = $row;
				}
				?>
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">NAJNOVIJE</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-3">
                        <?php
				foreach($novosti as $vijest){
				?>
                            <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                                <img class="img-fluid" style="width:80px;" src="login/news/<?php echo $vijest['foto']; ?>" alt="">
                                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                    <div class="mb-2">
                                        <a class="badge badge-info text-uppercase font-weight-semi-bold p-1 mr-2" href="single.php?id=<?php echo $vijest['id']; ?>"><?php echo $vijest['zanr']; ?></a>
                                        <a class="text-body" href="single.php?id=<?php echo $vijest['id']; ?>"><small><?php echo date('d.m.Y.', strtotime($vijest['datum']));?></small></a>
                                    </div>
                                    <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="single.php?id=<?php echo $vijest['id']; ?>"><?php echo strip_tags(substr($vijest['naslov'],0,50)).'...'; ?></a>
                                </div>
                            </div><?php }?>
                            
                        </div>
                    </div>
                     Popular News End -->

                    <!-- Newsletter Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Newsletter</h4>
                        </div>
                        <div class="bg-white text-center border border-top-0 p-3">
                            <p>Ostavite e-mail kako bi bili redovno informirani o najnovijim vijestima.</p>
                            <div class="input-group mb-2" style="width: 100%;">
                           <form action="newsletter/subscribe.php" method="post" >

                                <input type="text" name="email" class="form-control form-control-lg" placeholder="Unesite E-mail">
                                <div class="input-group-append">
<a href="#">   <button type="submit" class="btn btn-info font-weight-bold px-3">Pretplatite se</button></a>
                                </div>
                </form>
                            </div>
                            <small>Portal Sloboda govora</small>
                        </div>
                    </div>
                    <!-- Newsletter End -->

                    <!-- Tags Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">TAGOVI</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-3">
                            <div class="d-flex flex-wrap m-n1">
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Politika</a>
                <a href="biznis.php" class="btn btn-sm btn-outline-secondary m-1">Biznis</a>
                <a href="zdravlje.php" class="btn btn-sm btn-outline-secondary m-1">Zdravlje</a>
                <a href="hrana.php" class="btn btn-sm btn-outline-secondary m-1">Hrana</a>
                <a href="zdravlje.php" class="btn btn-sm btn-outline-secondary m-1">Zdravlje</a>
                <a href="obrazovanje.php" class="btn btn-sm btn-outline-secondary m-1">Obrazovanje</a>
                <a href="nauka.php" class="btn btn-sm btn-outline-secondary m-1">Nauka</a>
                <a href="zabava.php" class="btn btn-sm btn-outline-secondary m-1">Zabava</a>
                <a href="putovanje.php" class="btn btn-sm btn-outline-secondary m-1">Putovanje</a>
                <a href="crnahronika.php" class="btn btn-sm btn-outline-secondary m-1">Crna hronika</a>
                <a href="ljepota.php" class="btn btn-sm btn-outline-secondary m-1">Ljepota</a>
                <a href="regija.php" class="btn btn-sm btn-outline-secondary m-1">Regionalne</a>
                <a href="global.php" class="btn btn-sm btn-outline-secondary m-1">Globalne</a>
                <a href="najnovije.php" class="btn btn-sm btn-outline-secondary m-1">Najnovije</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tags End -->
                </div>
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->

<div class="containter-fluid pt-5 px-sm-3 px-md-5 mt-5" style="background-image: url('img/bg-login.jpg');   background-repeat: no-repeat;
  background-size: cover;">
<?php 
$sql = "SELECT * from oglasi where visible = 1 and position=1 order by id desc limit 1"; 
$result = mysqli_query ($conn,$sql);
$oglasi = array();	
while($row1 = mysqli_fetch_array($result)){
    $oglasi[] = $row1;
}
            foreach ($oglasi as $horizontalno) { ?>
                        <div class="col-lg-12 mb-3">
                            <a href="<?php echo $horizontalno['link']; ?>">
                            <img class="img-fluid w-100"  src="login/oglasi/<?php echo $horizontalno['foto']; ?>" alt=""></a>
                        </div><?php }?>
            
                </div>


<!-- Footer Start -->
<div class="container-fluid bg-dark pt-5 px-sm-3 px-md-5 mt-5">
    <div class="row py-4">
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Kontaktirajte nas!</h5>
            <p class="font-weight-medium"><i class="fa fa-map-marker-alt mr-2"></i>Bihać, BiH</p>
            <p class="font-weight-medium"><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
            <p class="font-weight-medium"><i class="fa fa-envelope mr-2"></i>info@geosoft.com</p>
            <h6 class="mt-4 mb-3 text-white text-uppercase font-weight-bold">Podržite nas</h6>
            <div class="d-flex justify-content-start">
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square mr-2" href=""><i class="fab fa-instagram"></i></a>
                <a class="btn btn-lg btn-secondary btn-lg-square" href=""><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Online oglašavanje</h5>
            <div class="mb-3">
                <div class="mb-2">
                    <a class="badge badge-info text-uppercase font-weight-semi-bold p-1 mr-2" href="">
                        VELIKA POSJEĆENOST.
                    </a>
                </div>
                <a class="small text-body text-uppercase font-weight-medium" href="">
                    Portal Sloboda govora bilježi broj pregleda, koji raste iz dana u dan.</a>
            </div>
            <div class="mb-3">
                <div class="mb-2">
                    <a class="badge badge-info text-uppercase font-weight-semi-bold p-1 mr-2" href="">PRISTUPAČNA CIJENA.</a>
                </div>
                <a class="small text-body text-uppercase font-weight-medium" href="">
                    Cijene oglasa pristupačne za sve - male i velike biznise.</a>
            </div>
            <div class="">
                <div class="mb-2">
                    <a class="badge badge-info text-uppercase font-weight-semi-bold p-1 mr-2" href="">KONTINUIRANO PRAĆENJE I INOVACIJE.</a>
                </div>
                <a class="small text-body text-uppercase font-weight-medium" href="">
                    Ostanite u korak s vremenom.</a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Brzi linkovi</h5>
            <div class="m-n1">
                <a href="politika.php" class="btn btn-sm btn-secondary m-1">Politika</a>
                <a href="biznis.php" class="btn btn-sm btn-secondary m-1">Biznis</a>
                <a href="zdravlje.php" class="btn btn-sm btn-secondary m-1">Zdravlje</a>
                <a href="hrana.php" class="btn btn-sm btn-secondary m-1">Hrana</a>
                <a href="sport.php" class="btn btn-sm btn-secondary m-1">Sport</a>
                <a href="obrazovanje.php" class="btn btn-sm btn-secondary m-1">Obrazovanje</a>
                <a href="nauka.php" class="btn btn-sm btn-secondary m-1">Nauka</a>
                <a href="zabava.php" class="btn btn-sm btn-secondary m-1">Zabava</a>
                <a href="putovanje.php" class="btn btn-sm btn-secondary m-1">Putovanje</a>
                <a href="crnahronika.php" class="btn btn-sm btn-secondary m-1">Crna hronika</a>
                <a href="ljepota.php" class="btn btn-sm btn-secondary m-1">Ljepota</a>
                <a href="regija.php" class="btn btn-sm btn-secondary m-1">Regionalne</a>
                <a href="global" class="btn btn-sm btn-secondary m-1">Globalne</a>
                <a href="najnovije.php" class="btn btn-sm btn-secondary m-1">Najnovije</a>
           
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="mb-4 text-white text-uppercase font-weight-bold">Sponzori</h5>
            <div class="row">
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="login/news/ed.jpg" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="login/news/sr.png" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="login/news/geosoft.png" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="login/news/tesla.png" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="login/news/bhtelecom.png" alt=""></a>
                </div>
                <div class="col-4 mb-3">
                    <a href=""><img class="w-100" src="login/news/amazon.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4 px-sm-3 px-md-5" style="background: #111111;">
    <p class="m-0 text-center">&copy; <a href="index.php">Portal Sloboda govora</a>. All Rights Reserved. 
    
    Design by <a href=""></a>Geosoft-studio.<br>
</p>
</div>
<!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-info btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>