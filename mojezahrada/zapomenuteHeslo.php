<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="">
    <label for="email">Email:</label>
    <input type="email" id="email" placeholder="zahrada@gmail.com" required><br>
    <input type="button" value="Obnovení hesla">
</form>

<?php
include_once "autentizace.php";
/*Bude se muset vyřešit autentizace*/

/* Budeme posílát přes mailový server*/
$to = "r.tokarsky@seznam.cz";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
    "CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);
?>

</body>
</html>