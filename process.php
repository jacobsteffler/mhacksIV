<?php
require_once('Ziggeo.php');
$ziggeo = new Ziggeo('3ed818d9203c4a5b815fb691d8d0a311', 'e4669e432a755c096b4c8dca52b9d105', 'ecc4b8c297b93d82b1417a070f64eb22');

$name = $_GET["t"];
file_put_contents("received/" . $name . ".mp4", $ziggeo->streams()->download_video($_GET["t"], $_GET["vt"]));
$ziggeo->videos()->delete($_GET["t"]);
?>