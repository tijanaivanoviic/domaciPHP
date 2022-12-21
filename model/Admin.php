<?php

class Admin
{

    private $konekcija;
    private $tabela = "admini";

    public $id;
    public $password;
    public $nadimak;

    public function __construct($konekcija)
    {
        $this->konekcija = $konekcija;
    }


    public function login()
    {
        $sql = "SELECT * FROM " . $this->tabela . " WHERE nadimak = '$this->nadimak' AND password = '$this->password'";

        if ($result = $this->konekcija->query($sql)) {

            $korisnik = $result->fetch_assoc();
            return $korisnik;
        }
        return null;
    }
}
