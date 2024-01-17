<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/ObsahObjednavkyEditace-style.css">
</head>
<body>

<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";
?>

<div>
    <?php
    $db = new Databaze();
    $nazevTabulky = "obsah_objednavky";
    $dotaz = "*";
    $podminka = "id_o = " . $_GET["id_o"] . " and id_p = " . $_GET["id_p"];
    $vysledek = $db->vybrat($nazevTabulky,$dotaz,$podminka);


    if($vysledek->num_rows == 1)
    {
        echo "<h1>Obsah objednávky č.".$_GET["id_o"].":</h1>";
        if($radek = $vysledek->fetch_assoc()){
        ?>
        <form action="ObsahObjednavkyEdit.php" method="post" class="upravaObsahuObjednavky">
            <input type="hidden" name="id_o" value="<?= $_GET['id_o']; ?>"><br>
            <label>ID produtku:</label><br>
            <input type="number" name="id_p" value="<?=$_GET['id_p'];?>"><br>
            <label>Počet:</label><br>
            <input type="number" name="pocet" value="<?=$radek['pocet'];?>"><br>
            <label>Cena po objednání:</label><br>
            <input type="number" name="cena_po_objednani" value="<?=$radek['cena_po_objednani'];?>"><br>
            <button type="submit" name="update-obsah" class="aktualizovatObsah">
                    Aktualizovat obsah
            </button>
        </form>
        <?php
        }
    }
    else
    {
        echo "Nastala chyba, zkuste načíst stránku znova:";
    }

    ?>
</div>

<?php
include_once "../paticka.php";
?>
</body>
</html>
