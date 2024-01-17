<?php
include_once "../../Databaze.php";

$db = new Databaze();
$tabulka = "obsah_objednavky";
$podminka = "id_o = " . $_GET["id_o"]." and id_p = ".$_GET["id_p"];

if ($db->smazat($tabulka, $podminka) == true) {
    header('Location: ObsahObjednavky.php?id_o='.$_GET["id_o"]);
} else {
    echo "Chyba v dotazu";
}