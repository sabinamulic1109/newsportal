<?php
$conn = mysqli_connect("localhost", "root", "", "portal");

mysqli_set_charset( $conn, 'utf8');
$result = mysqli_query($conn,"SELECT * FROM postavke");
$row = mysqli_fetch_array($result);
?>