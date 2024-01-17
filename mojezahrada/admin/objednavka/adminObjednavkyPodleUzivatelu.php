<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminObjednavkyPodleUzivatelu-style.css">
</head>
<body>

<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";
?>
<div class="center">
    <?php
    $tabulka= "zakaznik";
    $dotaz = "id_zakaznika, jmeno, prijmeni";

    $db = new Databaze();

    $vysledek = $db->vybrat($tabulka,$dotaz);


    if ($vysledek->num_rows > 0) {
        echo "<h1 class=".'"nadpis-Objednavky"'.">Uživatelé:</h1>";
        while ($radek = $vysledek->fetch_assoc()) {
            ?>

            <a class="kategorie-Uzivatele" href="adminObjednavky.php?id_zakaznika=<?= $radek["id_zakaznika"];?>"><?=$radek['id_zakaznika']?> <?=$radek['jmeno']?> <?= $radek['prijmeni']; ?></a>

            <?php
        }
    } else {
        echo "<h5>Žádní uživatelé</h5>";
    }
    ?>
</div>

<?php
include_once "../paticka.php";
?>
</body>
</html>