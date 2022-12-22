<?php
require('../db/db.php');
require('../model/Carape.php');

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp); // jpg
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 200000)
    && in_array($extension, $allowedExts)
) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Doslo je do greske prilikom upload-a slike.";
    } else {
        $filename = $_POST['naziv'] . "." . $extension;

        if (file_exists("../img/" . $filename)) {
            echo $filename . " vec postoji. ";
        } else {
            move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                "../img/" . $filename
            );
            $carape = new Carape($konekcija);
            $carape->img_path = $filename;
            $carape->id_kategorija = $_POST['id_kategorija'];
            $carape->naziv_carapa = $_POST['naziv'];
            $carape->opis_carapa = $_POST['opis'];
            if ($carape->dodaj())
                echo "Uspesno dodata nova carapa.";
            else echo "Nepoznata greska prilikom dodavanja carape.";
        }
    }
} else {
    echo "Ovaj format slike nije podrzan.";
}
