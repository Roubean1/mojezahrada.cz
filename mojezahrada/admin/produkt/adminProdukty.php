<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminProdukty-style.css">
</head>
<body>

    <?php
    include_once "../autentizace.php";
    include_once "../header.php";
    include_once "../navigace.php";
    ?>

    <button class="novy-produkt"><a href="adminNovyProdukt.php">Nový produkt</a></button>
    <table class="vypisProduktu" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nazev</th>
            <th>Popis</th>
            <th>Cena bez DPH</th>
            <th>Obrázek</th>
            <th>ID dodavatele</th>
            <th>Počet skladem</th>
            <th>Zveřejněno</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once "../../Databaze.php";
        $tabulka= "produkt";
        $dotaz = "*";
        $podminka = "id_kategorie = ".$_GET["id_kategorie"];

        $db = new Databaze();

        $vysledek = $db->vybrat($tabulka,$dotaz,$podminka);


        if ($vysledek->num_rows > 0) {
            while ($radek = $vysledek->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $radek['id_p']; ?></td>
                    <td><?= $radek['nazev_p']; ?></td>
                    <td><?= substr($radek['popis'],0,70);  if(strlen($radek['popis']) > 70) echo "...";?></td>
                    <td><?= $radek['cena_bez_dph']; ?></td>
                    <td><img src="../../<?= $radek['fotka']; ?>" class="nahledProduktu" alt="náhled obrázku produktu"></td>
                    <td><?= $radek['id_d']; ?></td>
                    <td><?= $radek['pocet_skladem']; ?></td>
                    <td><?= $radek['zverejnen']; ?></td>
                    <td>
                        <a href="adminEditaceProduktu.php?id_produktu=<?= $radek['id_p']; ?>" >Editovat</a>
                        <a href="adminProduktSmazat.php?id_produktu=<?= $radek['id_p']; ?>&id_kategorie=<?= $_GET["id_kategorie"];?>">Smazat</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<h5>Žádné produkty</h5>";
        }
        ?>

        </tbody>
    </table>

    <?php
    include_once "../paticka.php";
    ?>
</body>
</html>
