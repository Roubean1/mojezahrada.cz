<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <link rel="stylesheet" href="styles/infoProdukt-style.css">
    <?php
    include_once "link-styly.php";
    ?>
</head>
<body>
<?php
include_once "autentizace.php";
include_once "header.php";
include_once "navigace.php";

$tabulka= "produkt";
$dotaz = "*";
$podminka = "id_p =".$_GET["id_p"];

$db = new Databaze();

$vysledek = $db->vybrat( $tabulka, $dotaz, $podminka);

$tabulka = "parametry_produktu p inner join parametr_produktu_produkt pr on p.id_parametru_produktu=pr.id_parametru_produktu";
$dotaz = "nazev, hodnota";
$podminka = "id_produktu =".$_GET["id_p"];

$vypisparametru = $db->vybrat( $tabulka, $dotaz, $podminka);



if ($vysledek->num_rows == 1) {
    while ($radek = $vysledek->fetch_assoc()) {
        if($radek["zverejnen"]=="1"){
        ?>
                <div class="obrazekProdutku-container">

                        <img src="<?=$radek["fotka"]?>" alt="<?=$radek["nazev_p"]?>" class="obrazekProdutku">
                </div>
            <div class="infoProdukt">
                <h3 class="nadpisProduktu"><?=$radek["nazev_p"]?></h3>
                <p class="cenaProduktu">Cena s DPH: <?=$radek["cena_bez_dph"]*1.21?> Kč</p>
                <p class="cenaProduktu">Cena bez DPH: <?=$radek["cena_bez_dph"]?> Kč</p>
                <p class="sklademProdukt">Skladem: <?=$radek["pocet_skladem"]?></p>
                <p class="kodProdukt">Kód produktu: <?=$radek["id_p"]?></p>
                <?php
                if(isset($zakaznik) || isset($admin)){
                    if(($zakaznik == 1) || ($admin == 1)){
                        if($radek["pocet_skladem"]>0){
                            if(isset($_POST["kosik"])){
                                if(!(isset($_SESSION["kosik"][$_POST["kosik"]]))){
                                    $_SESSION["kosik"][$_POST["kosik"]]=1;
                                }
                                else {
                                    $_SESSION["kosik"][$_POST["kosik"]]++;
                                }
                            }
                        ?>
                            <form action="" method="post">
                                <input type="hidden" name="id_p" value="<?=$_GET["id_p"]?>">
                                <button class="doKosikuProdukt" name="kosik" value="<?=$_GET["id_p"]?>"><i class="fa-solid fa-bag-shopping"></i>Do košíku</button>
                            </form>
                        <?php
                        }
                        else{
                        ?>
                            <button class="doKosikuProdukt"><i class="fa-solid fa-bag-shopping"></i>Není skladem</button>
                        <?php
                        }
                    }
                }
                else{

                ?>

                        <a href="prihlaseni.php">
                        <button class="doKosikuProdukt" name="kosik" value="<?=$_GET["id_p"]?>"><i class="fa-solid fa-bag-shopping"></i>Do košíku</button>
                        </a>

                <?php
                }
                ?>
                <button class="doOblibenychProdukt"><i class="fa-solid fa-heart"></i>Do oblíbených</button>
            </div>
            <div class="cistic"></div>
            <p class="popis"><?=$radek["popis"]?></p>
            <?php

            //Parametry
            if ($vypisparametru->num_rows >= 1) {
                ?>
                    <table class="parametryProduktu">
                            <tr>
                                <th>Parametry:</th>
                                <th></th>
                            </tr>
        <?php
                while ($parametry = $vypisparametru->fetch_assoc()) {
                    ?>

                            <tr>
                                <td><?= $parametry["nazev"]?></td>
                                <td><?= $parametry["hodnota"]?></td>
                            </tr>
                    <?php
                }
                echo"</table>";
            }
        if(isset($zakaznik) || isset($admin)) {
            if ($zakaznik == 1 || $admin == 1) {
                include_once "vlozKomentar.php";
            }
        }
            //vypis komentare
        $tabulka = "komentar_produktu_od_zakaznika k inner join zakaznik z using(id_zakaznika)";
        $dotaz = "z.jmeno, z.prijmeni, k.komentar_uzivatele, k.hodnoceni, k.cas_vytvoreni_komentare";
        $podminka = "k.id_produktu=".$_GET["id_p"];
        $vypiskomentare = $db->vybrat( $tabulka, $dotaz, $podminka);

        if ($vypiskomentare->num_rows >= 1) {
            ?>
                        <table class="komentareProduktu">
                            <tr>
                                <th>Komentáře:</th>
                                <th></th>
                            </tr>
                            <?php
                            while ($komentare = $vypiskomentare->fetch_assoc()) {
                                ?>

                                <tr>
                                    <td><?= $komentare["jmeno"]?></td>
                                    <td><?= $komentare["prijmeni"]?></td>
                                    <td><?= $komentare["komentar_uzivatele"]?></td>
                                    <td><?= $komentare["hodnoceni"]?></td>
                                    <td><?= $komentare["cas_vytvoreni_komentare"]?></td>
                                </tr>
                                <?php
                            }
                            echo"</table>";
            }
        }
    }
} else {
    echo "Není vybraný žádný produkt";
}


include_once "paticka.php";
?>
</body>
