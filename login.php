<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Prijava</title>
    <link rel="stylesheet" href="style_login.css"/>
</head>
<body style="background-image: url('img/bg-login.jpg');   background-repeat: no-repeat;
  background-size: cover;font-family: 'Century Gothic';
  ">
<?php
    require('config.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['user'])) {
        $user = stripslashes($_REQUEST['user']);    // removes backslashes
        $user = mysqli_real_escape_string($conn, $user);
        $pass = stripslashes($_REQUEST['pass']);
        $pass = mysqli_real_escape_string($conn, $pass);
        // Check user is exist in the database
        $query    = "SELECT * FROM admin WHERE user='$user'
                     AND pass='" . md5($pass) . "'";
    $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['user'] = $user;
            // Redirect to user dashboard page
            header("Location: dodajOglas.php");
        } else {
            echo "<div class='form'>
                  <h3>Netačan unos.</h3><br/>
                  <p class='link'>Kliknite ovdje za <a href='login.php'>ponovnu prijavu.</a></p>
                  </div>";
        }
    } else {
?>
  <?php
    $rand = rand(9999, 1000);
     
        ?>
    <form class="form" method="post" name="login" action="login/check1.php">
        <h1 class="login-title">PRIJAVA</h1>
        <input type="text" class="login-input" name="username" placeholder="Korisničko ime" autofocus="true" style="font-family: 'Century Gothic';"/>
        <input type="password" class="login-input" name="password" placeholder="Lozinka" style="font-family: 'Century Gothic';"/>
        <span class="login-input"><?php echo $rand; ?></span>
        <input style="font-family: 'Century Gothic';" type="text" name="captcha" id="captcha" placeholder="Unesite broj za provjeru"  required
        data-parsley-trigger="keyup" class="login-input" />
        <input type="hidden" name="captcha-rand" value="<?php echo $rand; ?>" />
        <input type="submit" value="Prijava" name="submit" class="login-button"style="font-weight: bold;font-family: 'Century Gothic';"/>
        <p class="link">Nemate račun? <a href="registration.php">REGISTRACIJA</a></p>
        <p class="link"style="font-size:10px;"> <a href="index.php">NATRAG NA WEBSITE</a></p>
        
        <?php
					if(isset($_GET['msg'])){
					$msg=$_GET['msg'];
					
					if($msg==1){
						
						echo '<HR><div class="alert alert-danger" style="color:red; font-weight:bold; margin-left:80px;" role="alert">NEUSPJELA PRIJAVA!</div>';
						
					}
                  else  if($msg==2){
						
						echo '<HR><div class="alert alert-danger" style="color:red; font-weight:bold; margin-left:80px;" role="alert">NEUSPJELA PRIJAVA!</div>';
						
					}
                    else{
						echo '<div class="alert alert-danger" style="color:red; font-weight:bold; margin-left:80px;" role="alert">NEUSPJELA PRIJAVA!</div>';
					}
					}
				?>
						

  </form>
  
<?php
    }
?>

</body>
</html>
