<?php

if(isset($_POST["subject"]))

{

include("../config.php");

$subject = mysqli_real_escape_string($conn, $_POST["subject"]);

$comment = mysqli_real_escape_string($conn, $_POST["comment"]);

$query = "INSERT INTO notifikacije(comment_subject, comment_text)VALUES ('$subject', '$comment')";

mysqli_query($conn, $query);

}

?>