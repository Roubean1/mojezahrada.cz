<?php
session_start();
include_once "../../Databaze.php";
if(isset($_POST['update_kategorie']))
{

    $db = new Databaze();
    $tabulka = "kategorie";
    $data = array(
        "id_kategorie" => $_POST["id"],
        "nazev" => $_POST["nazev"],
    );
    $podminka = "id_kategorie='".$_POST["id"]."'";
    if($db->aktualizovat($tabulka,$data,$podminka) ==true){
        header("Location: adminEditaceKategorie.php?id_kategorie=".$_POST["id"]);
    }
    else{
        echo"Nastala chyba";
    }

}