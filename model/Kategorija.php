<?php

class Kategorija
{

    private $konekcija;
    private $tabela = "kategorije";

    public $id;
    public $naziv;
    public $opis;

    public function __construct($konekcija)
    {
        $this->konekcija = $konekcija;
    }

    public function get()
    {
        $sql = "SELECT * FROM " . $this->tabela;

        $kategorije = array();
        $res = $this->konekcija->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($kategorije, $row);
            }
        }
        return $kategorije;
    }
}
