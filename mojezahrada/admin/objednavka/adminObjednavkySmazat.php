<?php
include_once "../../Databaze.php";

$db = new Databaze();
$tabulka = "objednavka";
$podminka = "id_o = " . $_GET["id_o"];

if ($db->smazat($tabulka, $podminka) == true) {
    header('Location: adminObjednavky.php?id_zakaznika='.$_GET["id_zakaznika"]);
} else {
    echo "Chyba v dotazu";
}