<?php
require('../db/db.php');
require('../model/Carape.php');

$carape = new Carape($konekcija);

echo json_encode($carape->sortiraj($_GET['kolona'], $_GET['direction']));
