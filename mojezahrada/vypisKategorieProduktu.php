<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "link-styly.php";
    ?>
</head>
<body>

<?php
include_once "autentizace.php";
include_once "header.php";
include_once "navigace.php";
?>

<div class="banner-container">
    <h1 id="napis-banner">TO NEJLEPŠÍ PRO VAŠÍ ZAHRADU</h1>
    <img src="images/velky_banner.png" alt="Banner" id="banner">
</div>


<div class="produkty">
    <?php
    $vypis_kategorie_produktu = 1;
    include_once "vypisProduktu.php";
    ?>
</div>

<?php
include_once "paticka.php";
?>
</body>
</html>
