<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminProduktyPodleKategorii-style.css">
</head>
<body>

    <?php
    include_once "../autentizace.php";
    include_once "../header.php";
    include_once "../navigace.php";
    ?>

    <div class="center">
        <?php
        $tabulka= "kategorie";
        $dotaz = "*";

        $db = new Databaze();

        $vysledek = $db->vybrat($tabulka,$dotaz);


        if ($vysledek->num_rows > 0) {
            echo "<h1 class=".'"nadpis-kategorieProdukt"'.">Kategorie produktů:</h1>";
            while ($radek = $vysledek->fetch_assoc()) {
                ?>

                    <a class="kategorie-Produkt" href="adminProdukty.php?id_kategorie=<?= $radek["id_kategorie"];?>"><?= $radek['nazev']; ?></a>

                <?php
            }
        } else {
            echo "<h5>Žádní uživatelé</h5>";
        }
        ?>
    </div>

    <?php
    include_once "../paticka.php";
    ?>
</body>
</html>
