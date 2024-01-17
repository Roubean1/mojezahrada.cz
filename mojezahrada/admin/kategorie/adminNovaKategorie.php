<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminNovaKategorie-style.css">
</head>
<body>

    <?php
    include_once "../autentizace.php";
    include_once "../header.php";
    include_once "../navigace.php";

        $db = new Databaze();
        $nazevTabulky = "kategorie";


        if(count($_POST)>0){
                    $podminka = "nazev = '".$_POST["nazev"]."'";
                    $sloupce = "COUNT(*) as pocet";
                    $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);
                    $data = array(
                        "id_kategorie" => "",
                        "nazev" => $_POST["nazev"]
                    );


                    $radek = $vysledek->fetch_assoc();
                    $pocet = $radek['pocet'];

                    if ($pocet != 0) {
                        echo 'Už existuje';
                    } else {
                        $db->vlozit($nazevTabulky, $data);
                        echo "Nová kategorie vytvořena";
                    }
        }

        ?>
    <form action="" method="post" class="novaKategorie">
        <label for="nazev">Název kategorie:</label><br>
        <input type="text" id="kategorie" name="nazev" placeholder="kategorie" required maxlength="30"><br>
        <input type="submit" value="Nová kategorie" class="tlacitko-nova">
    </form>

    <?php
    include_once "../paticka.php";
    ?>
</body>
</html>