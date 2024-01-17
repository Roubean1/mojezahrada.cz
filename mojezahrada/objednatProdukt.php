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

if($admin == 1 || $zakaznik == 1){
if(isset($_SESSION["kosik"])) {
    $tabulka = "produkt";
    $db = new Databaze();

    echo "<table class='vypisKosik' cellspacing='0'>";
    echo "<tr>";
    echo "  <th>ID produktu:</th>";
    echo "  <th>Nazev produktu:</th>";
    echo "  <th>Fotka:</th>";
    echo "  <th>Cena bez DPH:</th>";
    echo "  <th>Počet skladem:</th>";
    echo "  <th>Počet položek v košíku:</th>";
    echo "  <th></th>";
    echo "</tr>";

    foreach ($_SESSION["kosik"] as  $element=> $hodnota){
    $dotaz = "*";
    $podminka = "id_p =". $element;
    $vysledek = $db->vybrat($tabulka,$dotaz,$podminka);

    if ($vysledek->num_rows > 0) {

    while ($radek = $vysledek->fetch_assoc()) {
    ?>

        <tr>
            <td><?= $radek['id_p']; ?></td>
            <td><?= $radek['nazev_p']; ?></td>
            <td><img src="<?= $radek['fotka']; ?>" style="object-fit: contain; width:160px; height: 160px;"></td>
            <td><?= $radek['cena_bez_dph']; ?></td>
            <td><?= $radek['pocet_skladem']; ?></td>
            <td><?= $hodnota;?></td>
            <td>
            </td>
        </tr>
    <?php
                }
            }
        }
    echo "</table>";
?>

        <form action="souhrnObjednavky.php" method="post">
            <h3>Způsob dopravy:</h3>
            <input type="radio" id="pobocka" name="doprava" value="pobocka" required>
            <label for="pobocka">Vyzvednutí na pobočce</label><br>
            <input type="radio" id="ppl" name="doprava" value="ppl">
            <label for="ppl">PPL</label><br>
            <input type="radio" id="zasilkovna" name="doprava" value="zasilkovna">
            <label for="zasilkovna">Zasilkovna</label>
            <h3>Způsob platby:</h3>
            <input type="radio" id="kartou-online" name="platba" value="kartou-online" required>
            <label for="kartou-online">Kartou online</label><br>
            <input type="radio" id="pri-vyzvednuti" name="platba" value="pri-vyzvednuti">
            <label for="pri-vyzvednuti">Při vyzvednutí</label><br>
            <input type="radio" id="prevodem" name="platba" value="prevodem">
            <label for="prevodem">Zálohou - bankovním převodem</label><br>
            <button>Objednat zboží</button>
        </form>



        <?php

    } else {
        echo "<h5>Nelze objednat</h5>";
    }
}
else{
    header("Location:prihlaseni.php");
}


include_once "paticka.php";
?>
</body>
</html>
