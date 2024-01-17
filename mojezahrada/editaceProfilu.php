<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz - Úprava údajů</title>
    <?php
    include_once "link-styly.php";
    ?>
    <link rel="stylesheet" href="styles/editaceProfilu-style.css">
</head>

<body>
    <?php
        include_once "autentizace.php";
        include_once "header.php";
        include_once "navigace.php";
    ?>
    <h1>Úprava údajů</h1>
            <div>
                <?php
                    $db = new Databaze();
                    $nazevTabulky = "zakaznik";
                    $sloupce = "*, COUNT(*) as pocet";
                    $podminka = "email = '" . $_SESSION["email"] . "' and heslo = '".$_SESSION["heslo"]."'";
                    $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);
                    $radek = $vysledek->fetch_assoc();
                    $pocet = $radek['pocet'];

                    if($pocet == 1)
                    {
                        ?>

                        <form action="edit.php" method="POST" class="editaceProfilu">
                                <input type="hidden" name="staryemail" value="<?=$radek['email'];?>">

                                <label>E-mail:</label><br>
                                <input type="text" name="email" value="<?=$radek['email'];?>"><br>

                                <label>Jméno:</label><br>
                                <input type="text" name="jmeno" value="<?=$radek['jmeno'];?>"><br>

                                <label>Příjmení:</label><br>
                                <input type="text" name="prijmeni" value="<?=$radek['prijmeni'];?>"><br>

                                <label>Město:</label><br>
                                <input type="text" name="mesto" value="<?=$radek['mesto'];?>"><br>

                                <label>Ulice:</label><br>
                                <input type="text" name="ulice" value="<?=$radek['ulice'];?>"><br>

                                <label>Číslo popisné</label><br>
                                <input type="text" name="cislop" value="<?=$radek['cislo_p'];?>"><br>

                                <label>PSČ:</label><br>
                                <input type="number" name="psc" value="<?=$radek['psc'];?>"><br>

                                <label>Telefonní číslo:</label><br>
                                <input type="text" name="tel" value="<?=$radek['telefon_cislo'];?>"><br>

                                <button type="submit" name="update_profil" class="aktualizovat-profil">
                                    Aktualizovat profil
                                </button>
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
        include_once "paticka.php";
    ?>

</body>

</html>

