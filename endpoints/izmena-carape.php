<?php
require('../db/db.php');
require('../model/Carape.php');

$carape = new Carape($konekcija);
$carape->id = $_POST['id'];
$error = false;
$errorPoruka = 'Greska kod izmene ';
if (isset($_POST['naziv'])) {
    $carape->naziv_carapa = $_POST['naziv'];
    if (!$carape->izmenaNaziva()) {
        $error = true;
        $errorPoruka .= 'naziva';
    }
}

if ($error)
    $errorPoruka .= 'i ';

if (isset($_POST['opis'])) {
    $carape->opis_carapa = $_POST['opis'];
    if (!$carape->izmenaOpisa()) {
        $errorPoruka .= 'opisa ';
    }
}

if ($error)
    echo $errorPoruka;
else echo "Uspesna izmena!";
