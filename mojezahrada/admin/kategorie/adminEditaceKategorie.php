<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminEditaceKategorie-style.css">
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
    $nazevTabulky = "kategorie";

    $sloupce = "*, COUNT(*) as pocet";
    $podminka = "id_kategorie = '" . $_GET["id_kategorie"] . "'";
    $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);
    $radek = $vysledek->fetch_assoc();
    $pocet = $radek['pocet'];


    if($pocet == 1)
    {
        ?>
        <form action="adminEditKategorie.php" method="POST" class="editaceKategorie">
            <input type="hidden" name="id" value="<?= $radek['id_kategorie']; ?>">
            <div>
                <label>Název:</label><br>
                <input type="text" name="nazev" value="<?=$radek['nazev'];?>">
            </div>
            <div>
                <button type="submit" name="update_kategorie" class="tlacitko-aktualizovatKategorii">
                    Aktualizovat kategorii
                </button>
            </div>

        </form>
        <?php
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
