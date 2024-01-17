<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/ObsahObjednavkyPridat-style.css">
</head>
<body>

<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";

$db = new Databaze();

if(count($_POST)>0){
        $nazevTabulky = "produkt";
        $podminka = "id_p = " . $_POST["id_p"];
        $dotaz = "cena_bez_dph";
        $vysledek = $db->vybrat($nazevTabulky, $dotaz, $podminka);
        $radek = $vysledek->fetch_assoc();
        $data = array(
            "id_o" => $_POST["id_o"],
            "id_p" => $_POST["id_p"],
            "pocet" => $_POST["pocet"],
            "cena_po_objednani" => $radek["cena_bez_dph"]
        );
        $nazevTabulky = "obsah_objednavky";

        if($db->vlozit($nazevTabulky, $data)){
            header("Location: ObsahObjednavky.php?id_o=".$_POST["id_o"]);
        }

}

?>
    <form action="" method="post"  class="obsahObjednavka">
        <input type="hidden" name="id_o" value="<?=$_GET["id_o"]?>">
        <label for="id_p">ID produktu:</label><br>
        <input type="number" id="id_p" name="id_p" placeholder="44" required maxlength="5"><br>
        <label for="pocet">Počet:</label><br>
        <input type="number" name="pocet" id="pocet"><br>
        <input type="submit" value="Nový produkt">
    </form>
    <?php
    include_once "../paticka.php";
    ?>
</body>
</html>