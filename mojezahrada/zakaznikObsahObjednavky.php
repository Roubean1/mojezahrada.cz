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


$tabulka= "obsah_objednavky inner join produkt using(id_p)";
$dotaz = "produkt.nazev_p as nazev, obsah_objednavky.pocet as pocet, obsah_objednavky.cena_po_objednani as cena, obsah_objednavky.id_p as id_p";
$podminka = "obsah_objednavky.id_o ='".$_GET["id_o"]."'";

$db = new Databaze();

$vysledek = $db->vybrat($tabulka,$dotaz,$podminka);
?>
<h1>Obsah objednávky č.<?=$_GET["id_o"]?>:</h1>
<?php
if ($vysledek->num_rows > 0){
    ?>
    <table class="vypisKosik" cellspacing="0">
        <thead>
        <tr>
            <th>Název produktu</th>
            <th>Počet kusů</th>
            <th>Cena stanovená při objednání</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($radek = $vysledek->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $radek['nazev']; ?></td>
                <td><?= $radek['pocet']; ?></td>
                <td><?= $radek['cena']; ?> Kč</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
} else {

    echo "<tr>
                    <td><h5>Žádný obsah</h5></td>
                  </tr>";
}
?>


<?php
include_once "paticka.php";
?>
</body>
</html>

