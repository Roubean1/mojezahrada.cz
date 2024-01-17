<?php

if(isset($vypis_vsechno)){
    $tabulka= "produkt";
    $dotaz = "*";
    $podminka = "1 = 1 LIMIT 12";


    $vysledek = $db->vybrat($tabulka, $dotaz,$podminka);


    if ($vysledek->num_rows > 0) {
        while ($radek = $vysledek->fetch_assoc()) {
            if($radek["zverejnen"]=="1"){
                ?>

                <div class="produkt">
                    <a href="infoProdukt.php?id_p=<?=$radek["id_p"]?>">
                        <div class="ramecek">
                            <img src="<?=$radek["fotka"]?>" alt="<?=$radek["nazev_p"]?>">
                        </div>
                        <h3><?=$radek["nazev_p"]?></h3>
                        <p class="cena">Cena: <?=$radek["cena_bez_dph"]*1.21?> Kč</p>
                    </a>
                </div>

                <?php
            }
        }
    } else {
        echo "Nejsou žádné produkty";
    }
}

else if(isset($vypis_kategorie_produktu)){
    $tabulka= "produkt";
    $dotaz = "*";
    $podminka = "id_kategorie = ".$_GET["id_kategorie"];


    $vysledek = $db->vybrat($tabulka, $dotaz,$podminka);


    if ($vysledek->num_rows > 0) {
        while ($radek = $vysledek->fetch_assoc()) {
            if($radek["zverejnen"]=="1"){
                ?>

                <div class="produkt">
                    <a href="infoProdukt.php?id_p=<?=$radek["id_p"]?>">
                        <div class="ramecek">
                            <img src="<?=$radek["fotka"]?>" alt="<?=$radek["nazev_p"]?>">
                        </div>
                        <h3><?=$radek["nazev_p"]?></h3>
                        <p class="cena">Cena: <?=$radek["cena_bez_dph"]*1.21?> Kč</p>
                    </a>
                </div>

                <?php
            }
        }
    } else {
        echo "Nejsou žádné produkty";
    }
}

else if(isset($_GET['search']))
{
    $hodnotaFiltru = $_GET['search'];
    $tabulka = "produkt";
    $dotaz = "*";
    $podminka = "CONCAT(CONCAT(id_p,''),nazev_p, popis) LIKE '%".$hodnotaFiltru."%'";
    $vysledek = $db->vybrat($tabulka,$dotaz,$podminka);
    if($vysledek->num_rows > 0) {
        while ($radek = $vysledek->fetch_assoc()) {
            if($radek["zverejnen"]=="1"){
                ?>

                    <div class="produkt">
                        <a href="infoProdukt.php?id_p=<?=$radek["id_p"]?>">
                            <div class="ramecek">
                                <img src="<?=$radek["fotka"]?>" alt="<?=$radek["nazev_p"]?>">
                            </div>
                            <h3><?=$radek["nazev_p"]?></h3>
                            <p class="cena">Cena: <?=$radek["cena_bez_dph"]*1.21?> Kč</p>
                        </a>
                    </div>

                <?php
            }
        }
    }
        else
        {
            ?>
            <tr>
                <td colspan="4">No Record Found</td>
            </tr>
            <?php
        }
    }
?>