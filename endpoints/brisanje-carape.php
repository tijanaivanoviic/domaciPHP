<?php
require('../db/db.php');
require('../model/Carape.php');

$carape = new Carape($konekcija);
$carape->id = $_GET['id'];

echo json_encode($carape->brisanje());
