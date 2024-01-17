<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "link-styly.php";
    ?>
    <link rel="stylesheet" href="styles/kosik-style.css">
</head>
<body>

<?php
include_once "autentizace.php";
include_once "header.php";
include_once "navigace.php";



if(isset($zakaznik) || ($admin)){
    if(($zakaznik == 1) || ($admin == 1)){
        if(isset($_SESSION["kosik"])) {
            $tabulka= "produkt";
            $dotaz = "*";

            $db = new Databaze();

            $vysledek = $db->vybrat($tabulka);
            if(isset($_POST["poslat"])) {

                if (($_POST["poslat"]) == "objednat") {
                    $tabulka = "objednavka";
                    $data = array(
                        //"id_o" => "",
                        "id_zakaznika" => $id_zakaznika,
                        "poznamky" => $_POST["poznamka"],
                        "zpusob_dopravy" => $_POST["doprava"],
                        "zpusob_platby" => $_POST["platba"]
                    );

                    if($objednavka = $db->vlozit($tabulka,$data)){
                        header("Location:index.php");
                    }
                    else{
                        echo "chyba při tvorbě objednavky";
                    }
                            }
            }


                $tabulka = "produkt";

                echo "<table class='vypisKosik' cellspacing='0'>";
                echo "<tr>";
                echo "  <th>ID produktu:</th>";
                echo "  <th>Nazev produktu:</th>";
                echo "  <th>Fotka:</th>";
                echo "  <th>Cena bez DPH:</th>";
                echo "  <th>Počet skladem:</th>";
                echo "  <th>Počet položek v košíku:</th>";
                echo "  <th></th>";
                echo "</tr>";

                foreach ($_SESSION["kosik"] as  $element=> $hodnota){
                $dotaz = "*";
                $podminka = "id_p =". $element;
                $vysledek = $db->vybrat($tabulka,$dotaz,$podminka);

                    if ($vysledek->num_rows > 0) {

                        while ($radek = $vysledek->fetch_assoc()) {
                        ?>

                        <tr>
                            <td><?= $radek['id_p']; ?></td>
                            <td><?= $radek['nazev_p']; ?></td>
                            <td><img src="<?= $radek['fotka']; ?>" style="object-fit: contain; width:160px; height: 160px;"></td>
                            <td><?= $radek['cena_bez_dph']; ?></td>
                            <td><?= $radek['id_kategorie']; ?></td>
                            <td><?= $radek['pocet_skladem']; ?></td>
                            <td><?= $hodnota;?></td>
                        </tr>
                    <?php
                        }
                    }
                }
                echo "</table>";
                ?>
                    <h3>Způsob dopravy:</h3>
                    <p><?=$_POST["doprava"]?></p>
                    <h3>Způsob platby:</h3>
                    <p><?=$_POST["platba"]?></p>
                    <h3>Komentář:</h3>
                    <form action="" method="post">
                        <input type="hidden" name="doprava" value="<?=$_POST["doprava"]?>">
                        <input type="hidden" name="platba" value="<?=$_POST["platba"]?>">
                        <textarea maxlength="200" placeholder="Zde můžete zadat něco si byste chtěli k objednávce dodat..." cols="90" rows="10" name="poznamka"></textarea><br>
                        <button name="poslat" value="objednat" ">Potvrdit objednávku</button>
                    </form>
                <?php
            } else {
                echo "<h5>Nelze objednat</h5>";
            }
    }
}
else{
    header("Location:prihlaseni.php");
}

include_once "paticka.php";
?>
</body>
</html>