<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminStavObjednavky-style.css">
</head>
<body>
<?php
    include_once "../autentizace.php";
    include_once "../header.php";
    include_once "../navigace.php";
    ?>


    <?php
    $db = new Databaze();
    $nazevTabulky = "druhy_stavu_objednavek inner join stav_objednavky using(id_stavu)";

    $sloupce = "druhy_stavu_objednavek.nazev as nazev, stav_objednavky.komentar as komentar,stav_objednavky.cas_stavu as cas_stavu, stav_objednavky.id_stavu as id_stavu";
    $podminka = "id_objednavky = '" . $_GET["id_o"] . "'";
    $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);
?>
<button class="novy-produkt"><a href="stavyObjednavky.php?id_o=<?=$_GET["id_o"]?>" >Přidat stav</a></button>
<h1>Stav objednávky č.<?=$_GET["id_o"]?>:</h1>
<?php

    if($vysledek->num_rows >0){
        ?>
        <table class="vypisStavuObjednavky" cellspacing="0">
    <thead>
    <tr>
        <th>Stav objednavky</th>
        <th>Komentář</th>
        <th>Čas stavu</th>
        <th></th>
    </tr>
    </thead>
            <?php
        while ($radek = $vysledek->fetch_assoc()){
        ?>

    <tbody>
        <tr>
            <td><?= $radek['nazev']; ?></td>
            <td><?= $radek['komentar']; ?></td>
            <td><?= $radek['cas_stavu']; ?></td>
            <td>
                <a href="adminStavObjednavkyEdit.php?id_o=<?=$_GET["id_o"]?>&id_stavu=<?=$radek['id_stavu']?>">Upravit</a>
                <a href="stavyObjednavkySmazat.php?id_o=<?=$_GET["id_o"]?>&id_stavu=<?=$radek['id_stavu']?>">Smazat</a>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
        </table>
            <?php
    }
    else
    {
        echo "Nejsou žádné stavy";
    }

    include_once "../paticka.php";
    ?>
</body>
</html>
