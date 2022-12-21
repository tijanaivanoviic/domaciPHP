<?php

class Carape
{

    private $konekcija;
    private $tabela = "carape";

    public $id;
    public $naziv_carapa;
    public $opis_carapa;
    public $id_kategorija;
    public $img_path;

    public function __construct($konekcija)
    {
        $this->konekcija = $konekcija;
    }

    public function get()
    {
        $sql = "SELECT carape.*, k.id AS _id, k.naziv_kategorija, k.opis_kategorija FROM " . $this->tabela . " JOIN kategorije k ON carape.id_kategorija = k.id";

        $carape = array();
        $res = $this->konekcija->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($carape, $row);
            }
        }
        return $carape;
    }

    public function sortiraj($kolona, $direction)
    {
        $sql = "SELECT carape.*, k.id AS _id, k.naziv_kategorija FROM " . $this->tabela . "
            JOIN kategorije k ON carape.id_kategorija = k.id 
            ORDER BY `$kolona` $direction";
        $carape = array();
        $res = $this->konekcija->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($carape, $row);
            }
        }
        return $carape;
    }

    public function dodaj()
    {
        $sql = "INSERT INTO " . $this->tabela . " (naziv_carapa, opis_carapa, id_kategorija, img_path)
        VALUES ('" . $this->naziv_carapa . "', '" . $this->opis_carapa . "', " . $this->id_kategorija . ", '$this->img_path')";
        if ($this->konekcija->query($sql)) {
            return true;
        }

        return false;
    }

    public function brisanje()
    {
        $sql = "DELETE FROM " . $this->tabela . " WHERE id = " . $this->id;
        if ($this->konekcija->query($sql)) {
            return "Uspesno obrisano";
        }
        return "Doslo je do greske";
    }

    public function izmenaNaziva()
    {
        $sql = "UPDATE " . $this->tabela . " SET naziv_carapa = '$this->naziv_carapa' WHERE id = " . $this->id;
        if ($this->konekcija->query($sql)) {
            return true;
        }
        return false;
    }

    public function izmenaOpisa()
    {
        $sql = "UPDATE " . $this->tabela . " SET opis_carapa = '$this->opis_carapa' WHERE id = " . $this->id;
        if ($this->konekcija->query($sql)) {
            return true;
        }
        return false;
    }
}
