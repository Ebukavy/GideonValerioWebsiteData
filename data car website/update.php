<?php

include 'db.php';

$database = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $kolom1 = $_POST["kolom1"];
    $kolom2 = $_POST["kolom2"];
    $kolom3 = $_POST["kolom3"];
}
?>