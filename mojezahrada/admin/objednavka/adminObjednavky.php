<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Mojezahrada.cz</title>
    <?php
    include_once "../link-styly.php";
    ?>
    <link rel="stylesheet" href="../../styles/adminObjednavky-style.css">
</head>
<body>
    <?php
    include_once "../autentizace.php";
    include_once "../header.php";
    include_once "../navigace.php";

        $tabulka= "objednavka";
        $dotaz = "*";
        $podminka = "id_zakaznika ='".$_GET["id_zakaznika"]."'";

        $db = new Databaze();

        $vysledek = $db->vybrat($tabulka,$dotaz,$podminka);


        if ($vysledek->num_rows > 0){
            ?>
            <button class="novy-produkt"><a href="adminInformaceoZakaznikovi.php?id_zakaznika=<?= $_GET['id_zakaznika']; ?>" >Informace o zákazníkovi</a></button>
            <button class="novy-produkt"><a href="adminObjednavkaPridat.php?id_zakaznika=<?= $_GET['id_zakaznika']; ?>" >Vytvořit objednávku</a></button>
            <h1>Uživatel:</h1>
                <table class="vypisObjednavek" cellspacing="0">
            <thead>
            <tr>
                <th>ID objednávky</th>
                <th>Poznámka</th>
                <th>Způsob dopravy</th>
                <th>Způsob platby</th>
                <th>Čas vytvoření objednávky</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($radek = $vysledek->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $radek['id_o']; ?></td>
                    <td><?= $radek['poznamky']; ?></td>
                    <td><?= $radek['zpusob_dopravy']; ?></td>
                    <td><?= $radek['zpusob_platby']; ?></td>
                    <td><?= $radek['cas_vytvoreni_objednavky']; ?></td>
                    <td>
                        <a href="ObsahObjednavky.php?id_o=<?= $radek['id_o']; ?>" >Produkty v objednávce</a><br>
                        <a href="adminStavObjednavky.php?id_o=<?= $radek['id_o']; ?>" >Stav objednavky</a><br>
                        <a href="adminObjednavkaEditovat.php?id_o=<?= $radek['id_o']?>&id_z=<?= $_GET["id_zakaznika"]?>">Upravit</a><br>
                        <a href="adminObjednavkySmazat.php?id_o=<?= $radek['id_o']; ?>&id_zakaznika=<?= $_GET["id_zakaznika"]?>" >Smazat</a><br>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
                </table>
        <?php
        } else {

            echo "<tr>
                    <td><h5>Žádné objednávky</h5></td>
                  </tr>";
        }
        ?>
    <?php
    include_once "../paticka.php";
    ?>
</body>
</html>
