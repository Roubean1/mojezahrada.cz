<?php
class Databaze {
    private $server = "localhost";
    private $uzivatel = "root";
    private $heslo = "";
    private $databaze = "eshop_zahrada";


    public function pripojit() {
        $spojeni = mysqli_connect($this->server, $this->uzivatel, $this->heslo, $this->databaze);

        if (!$spojeni) {
            die("Připojení k databázi selhalo: " . mysqli_connect_error());
        }

        return $spojeni;
    }

    // Metoda pro vkládání záznamů
    public function vlozit($tabulka, $data) {
        $spojeni = $this->pripojit();

        $sloupce = implode(", ", array_keys($data));
        $hodnoty = "'" . implode("', '", array_values($data)) . "'";

        $dotaz = "INSERT INTO $tabulka ($sloupce) VALUES ($hodnoty)";
        if (mysqli_query($spojeni, $dotaz)) {
            return true;
        } else {
            return false;
        }

        mysqli_close($spojeni);
    }

    // Metoda pro aktualizaci záznamů
    public function aktualizovat($tabulka, $data, $podminka) {
        $spojeni = $this->pripojit();

        $hodnoty = "";

        foreach ($data as $sloupec => $hodnota) {
            $hodnoty .= "$sloupec = '$hodnota', ";
        }

        $hodnoty = rtrim($hodnoty, ", ");

        $dotaz = "UPDATE $tabulka SET $hodnoty WHERE $podminka";

        if (mysqli_query($spojeni, $dotaz)) {
            return true;
        } else {
            return false;
        }

        mysqli_close($spojeni);
    }

    // Metoda pro výběr záznamů
    public function vybrat($tabulka, $sloupce = "*", $podminka = "") {
        $spojeni = $this->pripojit();

        $dotaz = "SELECT $sloupce FROM $tabulka";

        if ($podminka != "") {
            $dotaz .= " WHERE $podminka";
        }
        $vysledek = mysqli_query($spojeni, $dotaz);

        mysqli_close($spojeni);

        return $vysledek;
    }

    // Metoda pro mazání záznamů
    public function smazat($tabulka, $podminka) {
        $spojeni = $this->pripojit();

        $dotaz = "DELETE FROM $tabulka WHERE $podminka";

        if (mysqli_query($spojeni, $dotaz)) {
            return true;
        } else {
            return false;
        }

        mysqli_close($spojeni);
    }
}



