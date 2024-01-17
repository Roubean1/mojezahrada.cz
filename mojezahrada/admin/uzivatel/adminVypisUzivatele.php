<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminVypisUzivatele-style.css">
</head>
<body>

<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";
?>
<button class="novy"><a href="../../registrace.php">Nový uživatel</a></button>
<table class="vypisUzivatele" cellspacing="0">

    <thead>
    <tr>
        <th>ID zakaznika</th>
        <th>Jméno</th>
        <th>Příjmení</th>
        <th>Heslo</th>
        <th>Město</th>
        <th>Ulice</th>
        <th>Číslo popisné</th>
        <th>PSČ</th>
        <th>Práva</th>
        <th>Telefonní číslo</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $tabulka= "zakaznik";
    $dotaz = "*";

    $db = new Databaze();

    $vysledek = $db->vybrat($tabulka,$dotaz);


    if ($vysledek->num_rows > 0) {
        while ($radek = $vysledek->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $radek['id_zakaznika']; ?></td>
                <td><?= $radek['jmeno']; ?></td>
                <td><?= $radek['prijmeni']; ?></td>
                <td><?= $radek['heslo']; ?></td>
                <td><?= $radek['mesto']; ?></td>
                <td><?= $radek['ulice']; ?></td>
                <td><?= $radek['cislo_p']; ?></td>
                <td><?= $radek['psc']; ?></td>
                <td><?= $radek['prava']; ?></td>
                <td><?= $radek['telefon_cislo']; ?></td>
                <td>

                    <a href="../uzivatel/adminEditaceUzivateleUpravit.php?id_zakaznika=<?= $radek['id_zakaznika']; ?>" >Editovat</a>
                    <a href="../uzivatel/adminEditaceUzivateleSmazat.php?id_zakaznika=<?= $radek['id_zakaznika']; ?>" >Smazat</a>
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
