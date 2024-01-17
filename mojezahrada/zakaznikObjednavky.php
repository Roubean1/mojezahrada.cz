<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "link-styly.php";
    ?>
    <link rel="stylesheet" href="styles/kosik-style.css">
</head>
<body>
<?php
include_once "autentizace.php";
include_once "header.php";
include_once "navigace.php";
?>

<table class="vypisKosik" cellspacing="0">
    <thead>
    <tr>
        <th>ID objednávky</th>
        <th>Poznámka</th>
        <th>Způsob dopravy</th>
        <th>Způsob platby</th>
        <th>Čas vytvoření objednávky</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    include_once "autentizace.php";
    include_once "header.php";
    include_once "navigace.php";
    $tabulka= "objednavka";
    $dotaz = "*";
    $podminka = "id_zakaznika ='".$id_zakaznika."'";

    $db = new Databaze();

    $vysledek = $db->vybrat($tabulka,$dotaz,$podminka);


    if ($vysledek->num_rows > 0) {
        while ($radek = $vysledek->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $radek['id_o']; ?></td>
                <td><?= $radek['poznamky']; ?></td>
                <td><?= $radek['zpusob_dopravy']; ?></td>
                <td><?= $radek['zpusob_platby']; ?></td>
                <td><?= $radek['cas_vytvoreni_objednavky']; ?></td>
                <td>
                    <a href="zakaznikObsahObjednavky.php?id_o=<?= $radek['id_o']; ?>" >Obsah objednávky</a>
                    <a href="zakaznikStavObjednavky.php?id_o=<?= $radek['id_o']; ?>" >Stav objednávky</a>
                </td>
            </tr>
            <?php
        }
    } else {

        echo "<tr>
                <td><h5>Žádné objednávky</h5></td>
              </tr>";
    }
    ?>

    </tbody>
</table>

<?php
include_once "paticka.php";
?>
</body>
</html>