<?php
    $db = new Databaze();


    //pcš přesně 5 znaků

    if(isset($_POST["koment"]) == true){
        if(isset($_SESSION["email"])) {
            $nazevTabulky = "zakaznik";
            $podminka = "email = '" . $_SESSION["email"] . "' and heslo= '". $_SESSION["heslo"]."'";
            $sloupce = "*";
            $uzivatel = $db->vybrat($nazevTabulky, $sloupce, $podminka);
            $uzivatel = $uzivatel->fetch_assoc();

            $nazevTabulky = "komentar_produktu_od_zakaznika";
            $podminka = "id_produktu = '" . $_GET["id_p"] . "' and id_zakaznika= '".$uzivatel["id_zakaznika"]."'";
            $sloupce = "*";
            $zadal = $db->vybrat($nazevTabulky, $sloupce, $podminka);
            if(isset($_POST["koment"])) {
                if ($_POST["koment"] == "Přidat Komentář") {
                    if ($zadal->num_rows >= 1) {
                        echo "Komentář jsi už zadal";
                    } else {
                        $data = array(
                            "id_zakaznika" => $uzivatel["id_zakaznika"],
                            "id_produktu" => $_GET["id_p"],
                            "komentar_uzivatele" => $_POST["komentar"],
                            "hodnoceni" => $_POST["hodnoceni"]
                        );

                        if ($db->vlozit($nazevTabulky, $data)) {
                            header("Location:infoProdukt.php?id_p=".$_GET["id_p"]);
                        } else {
                            echo "chyba";
                        }


                    }
                }
            }
        }else{
            echo "Uživatel se musí přihlásit";
        }
    }
    ?>
</head>
<body>
<form action="" method="post">
    <label for="komentar">Komentář:</label><br>
    <textarea id="komentar" name="komentar" rows="10" cols="70" required placeholder="Zadej co si o tom myslíš..." minlength="5" maxlength="2000"></textarea><br>
    <label for="hodnoceni">Hodnocení:</label><br>
    <input type="number" id="hodnoceni" name="hodnoceni" placeholder="" min="1" max="5" required><br>
    <input type="submit" value="Přidat Komentář" name="koment">
</form>
</body>