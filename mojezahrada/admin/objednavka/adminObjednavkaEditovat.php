<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminObjednavkaEditovat-style.css">
</head>
<body>
<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";

$db = new Databaze();

$nazevTabulky = "objednavka";

if(isset($_POST["aktualizovat"])){
    if($_POST["aktualizovat"] == "Aktualizovat objednavku") {
        $podminka = "id_o = " . $_GET["id_o"];
        $data = array(
            "poznamky" => $_POST["poznamky"],
            "zpusob_dopravy" => $_POST["doprava"],
            "zpusob_platby" => $_POST["platba"]
        );

        if ($db->aktualizovat($nazevTabulky, $data, $podminka)) {
            header("Location:adminObjednavky.php?id_zakaznika=" . $_GET["id_z"]);
        } else {

        }
    }
}

$nazevTabulky = "objednavka";
$sloupce = "*";
$podminka = "id_o = ".$_GET["id_o"];
$vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);

if($vysledek->num_rows == 1)
{
    echo "<h1>Objednávka č.".$_GET["id_o"].":</h1>";
    if($radek = $vysledek->fetch_assoc()){
        ?>
        <form action="" method="post" class="upravaObjednavky">
            <label for="poznamky">Poznámky:</label><br>
            <textarea name="poznamky" id="poznamky"><?=$radek["poznamky"]?></textarea><br>
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
            <input type="submit" value="Aktualizovat objednavku" name="aktualizovat" class="aktualizovatObjednavku">
        </form>
        <script>
            radiobutton = document.getElementById("<?=$radek["zpusob_dopravy"]?>");
            radiobutton.checked = true;
            radiobutton = document.getElementById("<?=$radek["zpusob_platby"]?>");
            radiobutton.checked = true;
        </script>
        <?php
    }
}
else
{
    echo "Nastala chyba, zkuste načíst stránku znova:";
}

include_once "../paticka.php";
?>
</body>
</html>
