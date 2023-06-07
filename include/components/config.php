<?php

$con = mysqli_connect("localhost", "root", "", "portal");

mysqli_set_charset( $con, 'utf8');
$result = mysqli_query($con,"SELECT * FROM postavke");
$row = mysqli_fetch_array($result);

 

$naslovXV=$row["naslov"];
$opisXV=$row["opis"];
$kljucneXV=$row["kljucne"];
$adresaXV=$row["adresa"];
$gradXV=$row["grad"];
$zemljaXV=$row["zemlja"];
$telefonXV=$row["telefon"];
$telefon2XV=$row["telefon2"];
$emailXV=$row["email"];
$domenaXV=$row["domena"];

/* 	define('DB_HOST', 'localhost');
	define('DB_USER', 'vicitdig_democms');
	define('DB_PASS', 'democms!2019');
	define('DB_NAME', 'vicitdig_democms'); */
 
?>