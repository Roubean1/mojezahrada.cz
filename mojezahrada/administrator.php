<!DOCTYPE html>
<html lang="cs" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
        include_once "link-styly.php";
    ?>
    <link rel="stylesheet" href="styles/administrator-style.css">
</head>
<body>

    <?php
        include_once "autentizace.php";
        include_once "header.php";
        include_once "navigace.php";
    ?>

    <?php

    if($admin == 1){
        ?>
        <div class="administrace">
            <a href="admin/uzivatel/adminVypisUzivatele.php" ><button class="admin">Správa uživatelů</button></a><br>
            <a href="admin/kategorie/adminKategorie.php" ><button class="admin">Správa kategorií</button></a><br>
            <a href="admin/produkt/adminProduktyPodleKategorii.php" ><button class="admin">Správa produktů</button></a><br>
            <a href="admin/objednavka/adminObjednavkyPodleUzivatelu.php" ><button class="admin">Správa objednávek</button></a>
        </div>
        <?php
    }
    else{
        echo"Zde nemáš právo vstoupit mladý Skywalkere";
    }
    ?>

    <?php
        include_once "paticka.php";
    ?>
</body>
</html>