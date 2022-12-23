<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "carape";

$konekcija = new mysqli($servername, $username, $password, $db);

if ($konekcija->connect_error) {
    die("Connection failed: " . $konekcija->connect_error);
}
