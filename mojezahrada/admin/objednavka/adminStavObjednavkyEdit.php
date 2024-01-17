<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminStavObjednavkyedit-style.css">
</head>
<body>
<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";

$db = new Databaze();

$nazevTabulky = "stav_objednavky";

if(isset($_POST["aktualizovat"])){
    if($_POST["aktualizovat"] == "Aktualizovat komentář") {
        $podminka = "id_objednavky = " . $_GET["id_o"] . " and id_stavu = " . $_GET["id_stavu"];
        $data = array(
            "komentar" => $_POST["komentar"]
        );

        if ($db->aktualizovat($nazevTabulky, $data, $podminka)) {
            header("Location:adminStavObjednavky.php?id_o=" . $_GET["id_o"]);
        } else {

        }
    }
}

$nazevTabulky = "druhy_stavu_objednavek inner join stav_objednavky using(id_stavu)";
$sloupce = "druhy_stavu_objednavek.nazev as nazev, stav_objednavky.komentar as komentar";
$podminka = "id_objednavky = '".$_GET["id_o"]."' and id_stavu =".$_GET["id_stavu"];
$vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);

if($vysledek->num_rows == 1)
{
    echo "<h1>Stav objednávky č.".$_GET["id_o"].":</h1>";
    if($radek = $vysledek->fetch_assoc()){
        ?>
        <h1>Stav objednávky: <?=$radek["nazev"]?></h1>
        <form action="" method="post" class="aktualizovatStav">
            <label for="komentar">Komentář:</label><br>
            <textarea name="komentar" id="komentar"><?=$radek["komentar"]?></textarea><br>
            <input type="submit" value="Aktualizovat komentář" name="aktualizovat" >
        </form>
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


