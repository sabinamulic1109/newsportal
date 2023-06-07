<?php

$con=mysqli_connect("localhost", "root", "", "portal");

mysqli_set_charset( $con, 'utf8');
$result = mysqli_query($con,"SELECT * FROM postavke");
$row = mysqli_fetch_array($result);