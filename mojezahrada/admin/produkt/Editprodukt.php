<?php
session_start();
include_once "../../Databaze.php";
if(isset($_POST['update_produkt']))
{

    $db = new Databaze();

    $tabulka = "produkt";
    $data = array(
        "id_p" => "",
        "nazev_p" => $_POST["nazev_p"],
        "popis" => $_POST["popis"],
        "cena_bez_dph" => $_POST["cena_bez_dph"],
        "fotka" => $_POST["fotka"],
        "id_d" => $_POST["id_d"],
        "id_kategorie" => $_POST["id_kategorie"],
        "pocet_skladem" => $_POST["pocet_skladem"],
        "zverejnen" => $_POST["zverejnen"]
    );
    $podminka = "id_p='".$_POST["id_p"]."'";
    if($db->aktualizovat($tabulka,$data,$podminka) ==true){
        header("Location: adminEditaceProduktu.php?id_produktu=".$_GET["id_produktu"]);
    }
    else{
        echo"Nastala chyba";
    }

}