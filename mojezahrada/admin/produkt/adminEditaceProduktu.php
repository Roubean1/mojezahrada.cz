<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminEditaceProduktu-style.css">
</head>
<body>

<?php
    include_once "../autentizace.php";
    include_once "../header.php";
    include_once "../navigace.php";

    $db = new Databaze();
    $nazevTabulky = "produkt";

    $sloupce = "*, COUNT(*) as pocet";
    $podminka = "id_p = " . $_GET["id_produktu"];
    $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);
    $radek = $vysledek->fetch_assoc();
    $pocet = $radek['pocet'];


    if($pocet == 1)
    {
        ?>
        <form action="Editprodukt.php" method="POST" class="editaceProduktu">
            <input type="hidden" name="id_p" value="<?= $radek['id_p']; ?>">
                <label>Název produktu:</label><br>
                <input type="text" name="nazev_p" value="<?=$radek['nazev_p'];?>"><br>
                <label>Popis:</label><br>
                <textarea type="text" name="popis"><?=$radek['popis'];?></textarea><br>
                <label>Cena bez DPH:</label><br>
                <input type="number" name="cena_bez_dph" value="<?=$radek['cena_bez_dph'];?>"><br>
                <label>Fotka:</label><br>
                <input type="text" name="fotka" value="<?=$radek['fotka'];?>"><br>
                <label>ID dodavatele</label><br>
                <input type="number" name="id_d" value="<?=$radek['id_d'];?>"><br>
                <label>ID kategorie</label><br>
                <input type="number" name="id_kategorie" value="<?=$radek['id_kategorie'];?>"><br>
                <label>Počet skladem:</label><br>
                <input type="text" name="pocet_skladem" value="<?=$radek['pocet_skladem'];?>"><br>
                <label>Zveřejněn:</label><br>
                <input type="text" name="zverejnen" value="<?=$radek['zverejnen'];?>"><br>
                <button type="submit" name="update_produkt" class="aktualizovatProdukt">
                    Aktualizovat produkt
                </button>
        </form>
        <?php
    }
    else
    {
        echo "Nastala chyba, zkuste načíst stránku znova:";
    }


?>

<?php
include_once "../paticka.php";
?>
</body>
</html>
