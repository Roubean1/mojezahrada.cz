<?php


include_once "../../Databaze.php";

$db = new Databaze();
$tabulka = "produkt";
$podminka = "id_p = " . $_GET["id_produktu"];

if ($db->smazat($tabulka, $podminka) == true) {
    header("Location: adminProdukty.php?id_kategorie=".$_GET["id_kategorie"]);
} else {
    echo "Chyba v dotazu";
}