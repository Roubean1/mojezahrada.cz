<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "link-styly.php";
    ?>
</head>
<body>

<?php
include_once "autentizace.php";
include_once "header.php";
include_once "navigace.php";
if(isset($admin) || isset($zakaznik)) {
    if ($admin == 1 || $zakaznik == 1) {
        if (isset($_SESSION["kosik"])) {

            $db = new Databaze();
            $dotazIdO = "id_o";
            $tabulkaIdO = "objednavka";
            $podminkaIdO = "id_zakaznika = " . $id_zakaznika . " 
        ORDER BY cas_vytvoreni_objednavky DESC
        LIMIT 1";
            $IdO = $db->vybrat($tabulkaIdO, $dotazIdO, $podminkaIdO);

            $IdO = $IdO->fetch_assoc();


            $tabulka = "obsah_objednavky";

            foreach ($_SESSION["kosik"] as $element => $hodnota) {
                $dotazCena = "cena_bez_dph";
                $tabulkaCena = "produkt";
                $podminkaCena = "id_p = " . $element;

                $Cena = $db->vybrat($tabulkaCena, $dotazCena, $podminkaCena);

                $Cena = $Cena->fetch_assoc();

                $data = array(
                    "id_o" => $IdO["id_o"],
                    "id_p" => $element,
                    "pocet" => $hodnota,
                    "cena_po_objednani" => $Cena["cena_bez_dph"]
                );
                $db->vlozit($tabulka, $data);

                header("Location:index.php");


            }
            $_SESSION["kosik"] = null;
            unset($_SESSION["kosik"]);
        }
    }
}
else{
    header("Location:prihlaseni.php");
}

include_once "paticka.php";
?>
</body>
</html>
