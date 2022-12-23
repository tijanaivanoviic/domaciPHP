<?php
require('../db/db.php');
require('../model/Carape.php');

$carape = new Carape($konekcija);

echo json_encode($carape->get());
