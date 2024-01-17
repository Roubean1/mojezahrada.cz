<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
</head>
<body>

<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";

$tabulka= "produkt";
$dotaz = "*";

$db = new Databaze();

$vysledek = $db->vybrat($tabulka);
if(isset($_POST["poslat"])) {

    if (($_POST["poslat"]) == "objednat") {
        $tabulka = "objednavka";
        $data = array(
            //"id_o" => "",
            "id_zakaznika" => $_GET["id_zakaznika"],
            "poznamky" => $_POST["poznamka"],
            "zpusob_dopravy" => $_POST["doprava"],
            "zpusob_platby" => $_POST["platba"]
        );

        if($objednavka = $db->vlozit($tabulka,$data)){
            header("Location:adminObjednavky.php?id_zakaznika=".$_GET['id_zakaznika']);
        }
        else{
            echo "chyba při tvorbě objednavky";
        }
    }
}


$tabulka = "produkt";



?>

        <form action="adminObjednavkaPridat.php?id_zakaznika=<?= $_GET['id_zakaznika']; ?>" method="post">
            <h3>Způsob dopravy:</h3>
                <input type="radio" id="pobocka" name="doprava" value="pobocka" required>
                <label for="pobocka">Vyzvednutí na pobočce</label><br>
                <input type="radio" id="ppl" name="doprava" value="ppl">
                <label for="ppl">PPL</label><br>
                <input type="radio" id="zasilkovna" name="doprava" value="zasilkovna">
                <label for="zasilkovna">Zasilkovna</label>
            <h3>Způsob platby:</h3>
                <input type="radio" id="kartou-online" name="platba" value="Kartou online" required>
                <label for="kartou-online">Kartou online</label><br>
                <input type="radio" id="pri-vyzvednuti" name="platba" value="Při vyzvednutí">
                <label for="pri-vyzvednuti">Při vyzvednutí</label><br>
                <input type="radio" id="prevodem" name="platba" value="převodem">
                <label for="prevodem">Zálohou - bankovním převodem</label><br>
            <textarea maxlength="200" placeholder="Zde můžete zadat něco si byste chtěli k objednávce dodat..." cols="90" rows="10" name="poznamka"></textarea><br>
            <button name="poslat" value="objednat" >Vytvořit Objednavku</button>
        </form>


<?php
include_once "../paticka.php";
?>
</body>
</html>