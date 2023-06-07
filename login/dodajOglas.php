<html>
<head>
    <meta charset="utf-8"/>
    <title>Objava oglasa</title>
    <link rel="stylesheet" href="../style_login.css"/>
</head>
<style>
.logoutLblPos{

position:fixed;
right:10px;
top:5px;
}</style>
<form align="right" name="" method="post" action="../logout.php">
  <label class="logoutLblPos">
  <button style=" font-family:'Century Gothic';  black; background-color:white ; border:white; border-radius:5px;">Odjava</i></button>
  </label>
</form>
<body style="background-image: url('../img/bg-login.jpg');   background-repeat: no-repeat;
  background-size: cover;font-family: 'Century Gothic';">

  <div class="col-sm-8 col-sm-offset-2" id="add-form" style="<?php echo $showform; ?>">
  <form class="form" method="post" name="form1" id="form1" action="addoglasiweb.php"method="post" enctype="multipart/form-data">
  <h1 class="login-title">OBJAVI NOVI OGLAS</h1>
  <input type="text" class="login-input" name="naslov" placeholder="Naslov" autofocus="true" style="font-family: 'Century Gothic';"/>
<input type="checkbox" id="position" name="position" style="font-family: 'Century Gothic';"/>
<label for="position" style="font-family: 'Century Gothic';">Horizontalni</label>
<input type="text" class="login-input" name="link" placeholder="Link" autofocus="true" style="font-family: 'Century Gothic';"/>

Slika

<input type="file" name="photo1" style="font-family: 'Century Gothic';" id="file"  style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)">  
<div class="imgShow">
	<span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss" style="font-family: 'Century Gothic';"></i></span>
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;">
</div>		
<!--<textarea name="tekst" id="editor" style="width:100%; height:402px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;"></textarea>
	-->
   
 <input type="submit" value="Objavi" name="submit" class="login-button"style="font-weight: bold;font-family: 'Century Gothic';"/>
  	
</form>


</div>
</body></html>