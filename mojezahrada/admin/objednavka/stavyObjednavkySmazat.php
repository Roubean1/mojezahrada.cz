<?php
include_once "../../Databaze.php";

$db = new Databaze();
$tabulka = "stav_objednavky";
$podminka = "id_objednavky = " . $_GET["id_o"] . " and id_stavu = " . $_GET["id_stavu"];

if ($db->smazat($tabulka, $podminka) == true) {
    header('Location: adminStavObjednavky.php?id_o=' . $_GET["id_o"]);
} else {
    echo "Chyba v dotazu";
}