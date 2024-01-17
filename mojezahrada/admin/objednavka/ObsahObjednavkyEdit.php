<?php
session_start();
include_once "../../Databaze.php";
if(isset($_POST['update-obsah']))
{

    $db = new Databaze();

    $tabulka = "obsah_objednavky";
    $podminka = "id_o = " . $_POST["id_o"]." and id_p = ".$_POST["id_p"];

    if ($db->smazat($tabulka, $podminka) == true) {
        $data = array(
            "id_o" => $_POST["id_o"],
            "id_p" => $_POST["id_p"],
            "pocet" => $_POST["pocet"],
            "cena_po_objednani" => $_POST["cena_po_objednani"]
        );
        if ($db->vlozit($tabulka, $data) == true) {
            header("Location: ObsahObjednavkyEditace.php?id_o=" . $_POST["id_o"]."&id_p=" . $_POST["id_p"]);
        } else {
            echo "Nastala chyba";
        }
    } else {
        echo "Chyba v dotazu";
    }

}