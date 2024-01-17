<?php
include_once "autentizace.php";
if(isset($_POST['update_profil'])) {
    $db = new Databaze();

    $tabulka = "zakaznik";


    $sloupce = "id_zakaznika, COUNT(*) as pocet";
    $podminka = "email = '" . $_POST["staryemail"] . "'";
    $vysledek = $db->vybrat($tabulka,$sloupce,$podminka);


    $radek = $vysledek->fetch_assoc();
    $data = array(
        //"id_zakaznika" => "",
        "email" => $_POST["email"],
        "jmeno" => $_POST["jmeno"],
        "prijmeni" => $_POST["prijmeni"],
        "heslo" => $_SESSION["heslo"],
        "mesto" => $_POST["mesto"],
        "ulice" => $_POST["ulice"],
        "cislo_p" => $_POST["cislop"],
        "psc" => $_POST["psc"],
        "telefon_cislo" => $_POST["tel"],
    );

    $podminka = "id_zakaznika='".$radek["id_zakaznika"]."'";
    if($db->aktualizovat($tabulka,$data,$podminka) ==true){
        $_SESSION["uzivatel"] = $_POST["jmeno"];
        $_SESSION["email"] = $_POST["email"];
        header("Location: editaceProfilu.php");
    }
    else{
        echo "Nastala chyba";
    }

}