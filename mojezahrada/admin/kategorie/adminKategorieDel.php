<?php

include_once "../../Databaze.php";

$db = new Databaze();
$tabulka = "kategorie";
$podminka = "id_kategorie = " . $_GET["id_kategorie"];

if ($db->smazat($tabulka, $podminka) == true) {
    header("Location: adminKategorie.php");
} else {
    echo "Chyba v dotazu";
}
