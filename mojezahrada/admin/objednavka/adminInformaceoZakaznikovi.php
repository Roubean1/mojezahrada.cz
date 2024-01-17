<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminObjednavky-style.css">
</head>
<body>
<?php
    include_once "../autentizace.php";
    include_once "../header.php";
    include_once "../navigace.php";
    ?>
    <table class="vypisObjednavek" cellspacing="0">
        <thead>
        <tr>
            <th>Email</th>
            <th>Jméno</th>
            <th>Příjmení</th>
            <th>Mesto</th>
            <th>Ulice</th>
            <th>Číslo popisné</th>
            <th>PSČ</th>
            <th>Práva</th>
            <th>Telefonní číslo</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $tabulka= "zakaznik";
        $dotaz = "*";
        $db = new Databaze();
        $podminka = "id_zakaznika = '" . $_GET["id_zakaznika"] . "'";
        $vysledek = $db->vybrat($tabulka,"*",$podminka);


        if ($vysledek->num_rows == 1) {
            while ($radek = $vysledek->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $radek['email']; ?></td>
                    <td><?= $radek['jmeno']; ?></td>
                    <td><?= $radek['prijmeni']; ?></td>
                    <td><?= $radek['mesto']; ?></td>
                    <td><?= $radek['ulice']; ?></td>
                    <td><?= $radek['cislo_p']; ?></td>
                    <td><?= $radek['psc']; ?></td>
                    <td><?= $radek['prava']; ?></td>
                    <td><?= $radek['telefon_cislo']; ?></td>
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
