<?php
require('../db/db.php');
require('../model/Admin.php');

$admin = new Admin($konekcija);
$admin->nadimak = $_GET['nadimak'];
$admin->password = $_GET['password'];
$korisnik = $admin->login();
echo json_encode($korisnik ? $korisnik : false);
