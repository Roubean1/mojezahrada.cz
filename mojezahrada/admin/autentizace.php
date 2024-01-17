<?php

session_start();
include_once "../../Databaze.php";
$id_zakaznika= null;
if(isset($_SESSION["email"])) {
    $db = new Databaze();
    $nazevTabulky = "zakaznik";
    $sloupce = "COUNT(*) as pocet, prava, heslo, id_zakaznika";
    $podminka = "email = '" . $_SESSION["email"] . "'";
    $vysledek = $db->vybrat($nazevTabulky, $sloupce, $podminka);


    $radek = $vysledek->fetch_assoc();
    $pocet = $radek['pocet'];
    $id_zakaznika = $radek["id_zakaznika"];
    if ($pocet == 1) {

        if ($radek["heslo"] == $_SESSION["heslo"]) {
            if($radek["prava"]==0){
                $zakaznik = 1;
                $admin = 0;
            }

            if($radek["prava"]==1){
                $admin = 1;
                $zakaznik = 0;
            }

        } else {
            echo "Chyba při ověření";
        }
    } else {
        echo "Našlo se více uživatelů, chyba";
    }

    if($zakaznik == 1){
    ?>
    <p style="text-align: right;">
        Uživatel:<?php
        echo "<b>".$_SESSION["uzivatel"]."<b>";
        ?>
        <a href="zakaznikObjednavky.php">Přehled objednávek</a>
        <a href="editaceProfilu.php">Profil</a>
        <a href="odhlaseni.php" >Odhlášení</a>
    </p>

<?php
    }

    if($admin == 1){
        ?>
        <p style="text-align: right;">
        Administrátor:<?php
        echo "<b>".$_SESSION["uzivatel"]."<b>";
        ?>
            <a href="../../zakaznikObjednavky.php">Přehled objednávek</a>
            <a href="../../administrator.php">Správa webu</a>
            <a href="../../editaceProfilu.php">Profil</a>
            <a href="../../odhlaseni.php" >Odhlášení</a>
    </p>
    <?php
    }


}




?>
