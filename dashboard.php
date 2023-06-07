<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style_login.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['user']; ?>!</p>
        <p>You are in user dashboard page.</p>
        <p><a href="logout.php">Odjava</a></p>
    </div>
</body>
</html>
