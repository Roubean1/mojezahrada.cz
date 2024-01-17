<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminEditaceUzivateleUpravit-style.css">
</head>
<body>

<?php
include_once "../autentizace.php";
include_once "../header.php";
include_once "../navigace.php";

    if(isset($_POST["update_profil"])){
            $db = new Databaze();

            $tabulka = "zakaznik";


            $sloupce = "id_zakaznika, COUNT(*) as pocet";
            $podminka = "id_zakaznika = '" . $_GET["id_zakaznika"] . "'";
            $vysledek = $db->vybrat($tabulka, $sloupce, $podminka);


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

            $podminka = "id_zakaznika='" . $radek["id_zakaznika"] . "'";
            if ($db->aktualizovat($tabulka, $data, $podminka) == true) {
                $_SESSION["uzivatel"] = $_POST["jmeno"];
                $_SESSION["email"] = $_POST["email"];
                header("Location: adminEditaceUzivateleUpravit.php?id_zakaznika=".$_GET["id_zakaznika"]);
            } else {
                echo "Nastala chyba";
            }
    }


    $db = new Databaze();
    $nazevTabulky = "zakaznik";

    $sloupce = "*, COUNT(*) as pocet";
    $podminka = "id_zakaznika = '" . $_GET["id_zakaznika"] . "'";
    $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);
    $radek = $vysledek->fetch_assoc();
    $pocet = $radek['pocet'];


    if($pocet == 1)
    {
        ?>
        <form action="adminEditaceUzivateleUpravit.php?id_zakaznika=<?=$_GET["id_zakaznika"]?>" method="POST" class="upravaUzivatele">
            <input type="hidden" name="email" value="<?= $radek['email']; ?>">
            <div>
                <label>Jméno:</label><br>
                <input type="text" name="jmeno" value="<?=$radek['jmeno'];?>">
            </div>
            <div>
                <label>Příjmení:</label><br>
                <input type="text" name="prijmeni" value="<?=$radek['prijmeni'];?>">
            </div>
            <div>
                <label>Město:</label><br>
                <input type="text" name="mesto" value="<?=$radek['mesto'];?>">
            </div>
            <div>
                <label>Ulice:</label><br>
                <input type="text" name="ulice" value="<?=$radek['ulice'];?>">
            </div>
            <div>
                <label>Číslo popisné</label><br>
                <input type="text" name="cislop" value="<?=$radek['cislo_p'];?>">
            </div>
            <div >
                <label>PSČ:</label><br>
                <input type="number" name="psc" value="<?=$radek['psc'];?>">
            </div>
            <div>
                <label>Telefonní číslo:</label><br>
                <input type="text" name="tel" value="<?=$radek['telefon_cislo'];?>">
            </div>
            <div>
                <button type="submit" name="update_profil" class="tlacitko-aktualizovatUzivatele">
                    Aktualizovat profil
                </button>
            </div>

        </form>
        <?php
    }
    else
    {
        echo "Nastala chyba, zkuste načíst stránku znova:";
    }

    ?>
</div>

<?php
include_once "../paticka.php";
?>
</body>
</html>
