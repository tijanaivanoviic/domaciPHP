<?php
require('../db/db.php');
require('../model/Kategorija.php');

$kategorije = new Kategorija($konekcija);

echo json_encode($kategorije->get());
