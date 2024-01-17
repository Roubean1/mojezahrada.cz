<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/stavyObjednavky-style.css">
</head>
<body>
<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";

    $db = new Databaze();
    $nazevTabulky = "stav_objednavky";


    if(count($_POST)>0){
        $podminka = "id_objednavky = '".$_GET["id_o"]."' and id_stavu =".$_POST["stav"];
        $sloupce = "COUNT(*) as pocet";
        $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);
        $data = array(
                "id_stavu" => $_POST["stav"],
                "id_objednavky" => $_GET["id_o"],
                "komentar" => $_POST["text"]
        );


        $radek = $vysledek->fetch_assoc();
        $pocet = $radek['pocet'];

        if ($pocet != 0) {
            echo 'Už existuje';
        } else {
            $db->vlozit($nazevTabulky, $data);
            header("Location:adminStavObjednavky.php?id_o=".$_GET["id_o"]);
        }
    }
    ?>

    <form action="" method="post" class="pridat-stav">
        <label for="stav">Vyber stav:</label><br>
        <select id="stav" name="stav">
            <option value="1">Vytvořena</option>
            <option value="2">Přijata</option>
            <option value="3">Zpracovává se</option>
            <option value="4">Připravena</option>
            <option value="5">Zrušena</option>
        </select><br>
        <textarea name="text"></textarea><br>
        <input type="submit" value="Přidat stav" name="pridat_stav" class="">
    </form>

<?php
include_once "../paticka.php";
?>
</body>
</html>


