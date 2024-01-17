<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminNovyProdukt-style.css">
</head>
<body>

    <?php
    include_once "../autentizace.php";
    include_once "../header.php";
    include_once "../navigace.php";

        $db = new Databaze();
        $nazevTabulky = "produkt";


        if(count($_POST)>0){

            $slozkaNaNahrani = "../../images/nahrane/";
            $cilovySoubor = $slozkaNaNahrani . basename($_FILES["nahratSoubor"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($cilovySoubor,PATHINFO_EXTENSION));
            $isFotka = getimagesize($_FILES["nahratSoubor"]["tmp_name"]);
            if($isFotka !== false) {
                $uploadOk = 1;
            } else {
                echo "Soubor není obrázek.";
                $uploadOk = 0;
            }

            if (file_exists($cilovySoubor)) {
                echo "Soubor již existuje.";
                $uploadOk = 0;
            }

            if ($_FILES["nahratSoubor"]["size"] > 2500000) {
                echo "Soubor je příliš velký.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Nepodařilo se nahrát soubor.";
            } else {
                if (move_uploaded_file($_FILES["nahratSoubor"]["tmp_name"], $cilovySoubor)) {
                    echo "Soubor " . htmlspecialchars(basename($_FILES["nahratSoubor"]["name"])) . " byl nahrán.";
                    $podminka = "nazev_p = '" . $_POST["nazev_p"] . "'";
                    $sloupce = "COUNT(*) as pocet";
                    $vysledek = $db->vybrat($nazevTabulky, $sloupce, $podminka);
                    $data = array(
                        "id_p" => "",
                        "nazev_p" => $_POST["nazev_p"],
                        "popis" => $_POST["popis"],
                        "cena_bez_dph" => $_POST["cena_bez_dph"],
                        "fotka" => substr($cilovySoubor, 3),
                        "id_d" => $_POST["id_d"],
                        "id_kategorie" => $_POST["id_kategorie"],
                        "pocet_skladem" => $_POST["pocet_skladem"],
                        "zverejnen" => $_POST["zverejnen"]
                    );


                    $radek = $vysledek->fetch_assoc();
                    $pocet = $radek['pocet'];

                    if ($pocet != 0) {
                        echo 'Produkt již existuje';
                    } else {
                        $db->vlozit($nazevTabulky, $data);
                        echo "Nový produkt vytvořen";
                    }
                } else {
                    echo "Nastala chyba při nahrávání souboru.";
                }
            }
        }

        ?>
    </head>
    <form action="" method="post" enctype="multipart/form-data" class="novyProdukt">
        <label for="nazev_p">Název produktu:</label><br>
        <input type="text" id="nazev_p" name="nazev_p" placeholder="Nazev" required maxlength="70"><br>
        <label for="popis">Popis:</label><br>
        <textarea id="popis" name="popis" rows="10" cols="70">Zde zadej popis</textarea><br>
        <label for="cena_bez_dph">Cena bez DPH:</label><br>
        <input type="number" id="cena_bez_dph" name="cena_bez_dph" placeholder="44" step="0.01" required maxlength="11"><br>
        <label for="nahratSoubor">Nahraj soubor:</label><br>
        <input type="file" name="nahratSoubor" id="nahratSoubor"><br>
        <label for="id_d">Dodavatel:</label><br>
        <select name="id_d" id="id_d">
            <?php

            $tabulka= "dodavatel";
            $dotaz = "id_d,nazev_d";

            $vysledek = $db->vybrat($tabulka,$dotaz);

            if ($vysledek->num_rows > 0) {
                while ($radek = $vysledek->fetch_assoc()) {
                    ?>
                    <option value="<?=$radek["id_d"]?>"><?=$radek["nazev_d"]?></option>
                    <?php
                }
            } else {
                echo '<option value="">Žádná kategorie není vytvořena</option>';
            }
            ?>
        </select><br>
        <label for="id_kategorie">Kategorie:</label><br>
        <select name="id_kategorie" id="id_kategorie">
            <?php

            $tabulka= "kategorie";
            $dotaz = "nazev";

            $vysledek = $db->vybrat($tabulka);

            if ($vysledek->num_rows > 0) {
                while ($radek = $vysledek->fetch_assoc()) {
                    ?>
                    <option value="<?=$radek["id_kategorie"]?>"><?=$radek["nazev"]?></option>
                    <?php
                }
            } else {
                echo '<option value="">Žádná kategorie není vytvořena</option>';
            }
            ?>
        </select><br>
        <label for="pocet_skladem">Počet skladem:</label><br>
        <input type="number" id="pocet_skladem" name="pocet_skladem" placeholder="4" required maxlength="5"><br>
        <label for="zverejnen">Zveřejnění:</label><br>
        <select name="zverejnen" id="zverejnen">
            <option value="1">Veřejné</option>
            <option value="0">Soukromé</option>
        </select><br>
        <input type="submit" value="Nový produkt">
    </form>
    <?php
    include_once "../paticka.php";
    ?>
</body>
</html>

