<?php
include 'main.php';
// Ensure post variable exists
if (isset($_POST['email'])) {
    // Validate email address
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo '<a href="../index.php" >
    <img style="  display: block;
    margin-left: auto;
    margin-right: auto;
    width: 80%;" 
    src="greska.png"></a>';
    }
    // Check if email exists in the database
    $stmt = $pdo->prepare('SELECT * FROM subscribers WHERE email = ?');
    $stmt->execute([ $_POST['email'] ]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<a href="../index.php" >
        <img style="  display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;" 
        src="postoji.png"></a>';
    }
    // Insert email address into the database
    $stmt = $pdo->prepare('INSERT INTO subscribers (email,date_subbed) VALUES (?,?)');
    $stmt->execute([ $_POST['email'], date('Y-m-d\TH:i:s') ]);
    // Output success response
    echo '<a href="../index.php" >
    <img style="  display: block;
    margin-left: auto;
    margin-right: auto;
    width: 80%;" 
    src="thx.png"></a>';
} 
    else {
    // No post data specified
    exit('Please provide a valid email address!');
}
?>