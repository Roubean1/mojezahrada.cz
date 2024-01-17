<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "link-styly.php";
    ?>
    <link rel="stylesheet" href="styles/kosik-style.css">
</head>
<body>

<?php
include_once "autentizace.php";
include_once "header.php";
include_once "navigace.php";
    if($admin == 1 || $zakaznik == 1){
        if(isset($_SESSION["kosik"])) {



            $tabulka= "produkt";
            echo "<table class=".'"'."vypisKosik".'"'." cellspacing=".'"'."0".'"'.">";
            echo "<tr>";
            echo "  <th>ID produktu:</th>";
            echo "  <th>Nazev produktu:</th>";
            echo "  <th>Fotka:</th>";
            echo "  <th>Cena bez DPH:</th>";
            echo "  <th>Počet skladem:</th>";
            echo "  <th>Počet položek v košíku:</th>";
            echo "  <th></th>";
            echo "</tr>";
            $db = new Databaze();
            foreach ($_SESSION["kosik"] as  $element=> $hodnota){
                $dotaz = "*";
                $podminka = "id_p =". $element;
                $vysledek = $db->vybrat($tabulka,$dotaz,$podminka);



                if ($vysledek->num_rows > 0) {
                    while ($radek = $vysledek->fetch_assoc()) {
                        if(isset($_POST["uprav"])){
                            if($_POST["uprav"]=="Smazat produkt"){
                                unset($_SESSION["kosik"][$_POST["id_p"]]);
                                $_POST["uprav"]=null;
                                unset($_POST["uprav"]);
                                header("Location:kosik.php");
                            }
                            if($_POST["uprav"]=="Přidat počet"){
                                if($_SESSION["kosik"][$_POST["id_p"]] < $radek['pocet_skladem'])
                                    $_SESSION["kosik"][$_POST["id_p"]]++;
                                $_POST["uprav"]=null;
                                unset($_POST["uprav"]);
                                header("Location:kosik.php");
                            }
                            if($_POST["uprav"]=="Odebrat počet"){
                                $_SESSION["kosik"][$_POST["id_p"]]--;
                                if($_SESSION["kosik"][$_POST["id_p"]] == 0) {
                                    unset($_SESSION["kosik"][$_POST["id_p"]]);
                                }
                                $_POST["uprav"]=null;
                                unset($_POST["uprav"]);
                                header("Location:kosik.php");
                            }
                        }
                        ?>
                            <tr>
                                        <td><?= $radek['id_p']; ?></td>
                                        <td><?= $radek['nazev_p']; ?></td>
                                        <td><img src="<?= $radek['fotka']; ?>" style="object-fit: contain; width:160px; height: 160px;"></td>
                                        <td><?= $radek['cena_bez_dph']; ?></td>
                                        <td><?= $radek['pocet_skladem']; ?></td>
                                        <td><?= $hodnota;?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_p" value="<?= $radek['id_p']; ?>">
                                                <input type="submit" name="uprav" value="Smazat produkt">
                                            </form>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_p" value="<?= $radek['id_p']; ?>">
                                                <input type="submit" name="uprav" value="Přidat počet">
                                            </form>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_p" value="<?= $radek['id_p']; ?>">
                                                <input type="submit" name="uprav" value="Odebrat počet">
                                            </form>
                                        </td>
                            </tr>
                        <?php
                    }
                }
            }
                echo "</table>";
            ?>
            <button><a href="objednatProdukt.php">Objednat</a></button>

            <?php
            }
        else {
                echo "<h5>Žádné produkty</h5>";
            }
    }
    else{
        header("Location:prihlaseni.php");
    }

include_once "paticka.php";
?>
</body>
</html>
