<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registracija</title>
    <link rel="stylesheet" href="style_login.css"/>
</head>
<body style="background-image: url('img/bg-login.jpg');   background-repeat: no-repeat;
  background-size: cover; font-family: 'Century Gothic';
  ">
<?php
    require('config.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['user'])) {
        // removes backslashes
        $user = stripslashes($_REQUEST['user']);
        //escapes special characters in a string
        $user = mysqli_real_escape_string($conn, $user);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $pass = stripslashes($_REQUEST['pass']);
        $pass = mysqli_real_escape_string($conn, $pass);
        $x = $_REQUEST['captcha'];
	    $y = $_REQUEST['captcha-rand'];

    if ($x == $y) {
        $query = "INSERT into admin (user, pass, type, email, token)
                     VALUES ('$user', '" . md5($pass) . "','user', '$email', '')";
        $result = mysqli_query($conn, $query);
        $count = 1;
    }else{
        $count = 0;
    }

    
        if ($count>0) { 
            header("location:login.php");

        } else {
            echo "<div class='form'>
                  <h3>Neuspjela registracija!</h3><br/>
                  <p class='link'>Kliknite ovdje za <a href='registration.php'> ponovni pokušaj registracije.</a></p>
                  </div>";
        }
    } else {
?>
<?php
    $rand = rand(9999, 1000);
     
        ?>
    <form class="form" action="" method="post">
        <h1 class="login-title">REGISTRACIJA</h1>
        <input type="text" class="login-input" name="user" placeholder="Korisničko ime"style="font-family: 'Century Gothic';" required />
        <input type="text" class="login-input" name="email" placeholder="E-mail" style="font-family: 'Century Gothic';">
        <input type="password" class="login-input" name="pass" placeholder="Lozinka" style="font-family: 'Century Gothic';">
        <span class="login-input"><?php echo $rand; ?></span>
        <input style="font-family: 'Century Gothic';" type="text" name="captcha" id="captcha" placeholder="Unesite broj za provjeru"  
        data-parsley-trigger="keyup" class="login-input" />
        <input type="hidden" name="captcha-rand" value="<?php echo $rand; ?>" />
        <input type="submit" name="submit" value="Registracija" class="login-button" style="font-weight: bold;font-family: 'Century Gothic';">
        <p class="link">Već imate račun? <a href="login.php">PRIJAVA</a></p>
       <p class="link"style="font-size:10px;"> <a href="index.php">NATRAG NA WEBSITE</a></p>

    </form>
<?php
    }
?>
</body>
</html>
