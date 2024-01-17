<?php
$tabulka= "kategorie";
$dotaz = "nazev";

$db = new Databaze();

$vysledek = $db->vybrat($tabulka);


if ($vysledek->num_rows > 0) {
    while ($radek = $vysledek->fetch_assoc()) {
        ?>
            <li><a href="vypisKategorieProduktu.php?id_kategorie=<?=$radek["id_kategorie"]?>"><?=$radek["nazev"]; ?></a></li>
        <?php
    }
} else {
    echo "Nejsou žádné kategorie";
}
?>