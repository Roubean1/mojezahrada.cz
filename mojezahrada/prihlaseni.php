<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz - Přihlášení</title>
    <link rel="stylesheet" href="styles/prihlaseni-style.css">
    <?php
    include_once "autentizace.php";
    include_once "link-styly.php";
    if (count($_POST) > 0){
        $db = new Databaze();
        $nazevTabulky = "zakaznik";

        $sloupce = "COUNT(*) as pocet, heslo, jmeno, prijmeni";
        $podminka = "email = '" . $_POST["email"] . "'";
        $vysledek = $db->vybrat($nazevTabulky,$sloupce,$podminka);


        $radek = $vysledek->fetch_assoc();
        $pocet = $radek['pocet'];

        if ($pocet == 1) {
            $ZaHashovaneHeslo = hash("sha256",$_POST["heslo"]);

            if ($radek["heslo"] == $ZaHashovaneHeslo) {
                $_SESSION["uzivatel"] = $radek["jmeno"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["heslo"] = $radek["heslo"];
                print_r($_SESSION["uzivatel"]);
                header('Location: index.php');
                echo "Přihlášení proběhlo úspěšně";
                exit;
            }
            else {
                echo "Chybně zadané přihlašovací údaje";
            }
        }
        else {
            echo "Chybně zadané přihlašovací údaje";
        }
    }
    ?>
</head>
<body>
    <?php
        include_once "header.php";
        include_once "navigace.php";
    ?>
    <form action="" method="post" class="prihlaseni">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="zahrada@gmail.com" required maxlength="50"><br>
        <label for="heslo">Heslo:</label><br>
        <input type="password" id="heslo" name="heslo" placeholder="********" required minlength="8" maxlength="64"><br>
        <input type="submit" class="prihlasit-se" value="Přihlásit se" name="prihlaseni">
    </form>

    <div class="odkazy">
        <a href="registrace.php">Zaregistrovat se</a>
        <a href="zapomenuteHeslo.php">Zapomenuté heslo</a>
    </div>
    <?php
        include_once "paticka.php";
    ?>
</body>
</html>