<?php  
session_start(); 
include 'config.php';
$page = $_GET['page'];
$p = (($page-1)*10);
$id = $_SESSION['id'];
//echo $type;
$rezultat = array();

$sql = "SELECT ms.status,ms.type,  m.id AS msgid, m.date, m.subject,  m.message AS poruka, a.user as receiver
		FROM messagestatus ms
		INNER JOIN mymessages m ON
			m.id = ms.message
		INNER JOIN admin a ON
			 a.id = m.receiver
		WHERE
		LOWER(ms.status) = 'sent' and ms.user = $id
		ORDER BY m.id desc	
		LIMIT $p, 10"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$rezultat[] = $row;
}

$broj = array();
$sql = "SELECT ms.status FROM messagestatus ms INNER JOIN mymessages m ON m.id = ms.message INNER JOIN admin a ON a.id = m.receiver WHERE
		LOWER(ms.status) = 'sent' and ms.user = $id"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
	$broj[] = $row;
}
$vrati['poruke'] = $rezultat;
$vrati['broj'] =count($broj);
echo json_encode($vrati);


?>