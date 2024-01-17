<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminKategorie-style.css">
</head>
<body>

<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";
?>
<button class="novy"><a href="adminNovaKategorie.php">Nová kategorie</a></button>
<table class="vypisKategorie" cellspacing="0">
    <thead>
        <tr>
            <th>ID kategorie</th>
            <th>Název</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $tabulka= "kategorie";
    $dotaz = "*";

    $db = new Databaze();

    $vysledek = $db->vybrat($tabulka,$dotaz);


    if ($vysledek->num_rows > 0) {
        while ($radek = $vysledek->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $radek['id_kategorie']; ?></td>
                <td><?= $radek['nazev']; ?></td>
                <td>

                    <a href="adminEditaceKategorie.php?id_kategorie=<?= $radek['id_kategorie']; ?>" >Editovat</a>
                    <a href="adminKategorieDel.php?id_kategorie=<?= $radek['id_kategorie']; ?>" >Smazat</a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<h5>Žádní uživatelé</h5>";
    }
    ?>

    </tbody>
</table>

<?php
include_once "../paticka.php";
?>
</body>
</html>
