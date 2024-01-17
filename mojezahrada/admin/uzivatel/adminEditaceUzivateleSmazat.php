<?php
    include_once "../../Databaze.php";

    $db = new Databaze();
    $tabulka = "zakaznik";
    $podminka = "id_zakaznika = '".$_GET["id_zakaznika"]."'";

    if($db->smazat($tabulka,$podminka) == true){
        header("Location:adminVypisUzivatele.php");
    }
    else{
        echo"Chyba v dotazu";
    }


