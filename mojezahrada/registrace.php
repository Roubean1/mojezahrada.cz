<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Registrace</title>
    <link rel="stylesheet" href="styles/registrace-style.css">
    <?php
        include_once "autentizace.php";
        include_once "link-styly.php";
        $db = new Databaze();
        $nazevTabulky = "zakaznik";

        //pcš přeně 5 znaků
        // email a heslo nesmí být dvakrat stejne, primarni klic je ted jenom id

        if(count($_POST)>0){
            if(strlen($_POST["psc"])==5) {
                if ($_POST["heslo"] == $_POST["hesloZnovu"]) {
                    $hesloZahashovane = hash("sha256", $_POST["heslo"]);
                    $data = array(
                        "email" => $_POST["email"],
                        "jmeno" => $_POST["jmeno"],
                        "prijmeni" => $_POST["prijmeni"],
                        "heslo" => $hesloZahashovane,
                        "mesto" => $_POST["mesto"],
                        "ulice" => $_POST["ulice"],
                        "cislo_p" => $_POST["cislo_p"],
                        "psc" => $_POST["psc"],
                        "telefon_cislo" => $_POST["tel"]
                    );
                    //print_r($data);
                    $sloupce = "COUNT(*) as pocet";
                    $podminka = "email = '" . $_POST["email"] . "'";
                    $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);


                    $radek = $vysledek->fetch_assoc();
                    $pocet = $radek['pocet'];

                    if ($pocet > 0) {
                        echo 'Uživatel s daným e-mailem už existuje.';
                    } else {
                        if(($db->vlozit($nazevTabulky, $data))==true){;
                        echo "Registrace proběhla úspěšně.";
                        header("Location:prihlaseni.php");
                    }
                        else{
                            echo "Chyba při vytváření účtu";
                        }
                    }
                } else {
                    echo "Hesla se neshodují.";
                }
            }
        }
    ?>
</head>
<body>
    <?php
    include_once "header.php";
    include_once "navigace.php";
    ?>
    <form action="" method="post" class="registrace">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="zahrada@gmail.com" required maxlength="50"><br>
        <label for="jmeno">Jméno:</label><br>
        <input type="text" id="jmeno" name="jmeno" placeholder="Roman" required maxlength="50"><br>
        <label for="prijmeni">Příjmení:</label><br>
        <input type="text" id="prijmeni" name="prijmeni" placeholder="Konvička" required maxlength="50"><br>
        <label for="heslo">Heslo:</label><br>
        <input type="password" id="heslo" name="heslo" placeholder="********" required minlength="8" maxlength="64"><br>
        <label for="hesloZnovu">Heslo znovu:</label><br>
        <input type="password" id="hesloZnovu" name="hesloZnovu" placeholder="********" required minlength="8" maxlength="64"><br>
        <label for="mesto">Město:</label><br>
        <input type="text" id="mesto" name="mesto" placeholder="Praha" required maxlength="40"><br>
        <label for="psc">PSČ:</label><br>
        <input type="number" id="psc" name="psc" placeholder="10000" required minlength="5" maxlength="5"><br>
        <label for="ulice">Ulice:</label><br>
        <input type="text" id="ulice" name="ulice" placeholder="Dejvická" required maxlength="40"><br>
        <label for="cisloPopisne">Číslo popisné:</label><br>
        <input type="number" id="cisloPopisne" name="cislo_p" placeholder="34" required maxlength="5"><br>
        <label for="telCislo">TEL:</label><br>
        <input type="number" id="telCislo" name="tel" placeholder="723452145" required maxlength="20"><br>
        <input type="submit" class="registrovat" value="Registrovat">
    </form>

    <div class="odkazy">
        <a href="prihlaseni.php">Přihlásit se</a>
        <a href="zapomenuteHeslo.php">Zapomenuté heslo</a>
    </div>

    <?php
    include_once "paticka.php";
    ?>
</body>
</html>