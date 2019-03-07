<?php

$kundennummer = $_GET['txtkundennummer'];
$anrede = $_GET['txtanrede'];
$titel = $_GET['txttitel'];
$vorname = $_GET['txtvorname'];
$nachname = $_GET['txtnachname'];
$gebdat = $_GET['txtgeb'];
$strasse = $_GET['txtstrasse'];
$plz = $_GET['txtplz'];
$ort = $_GET['txtort'];
$telefonnummer = $_GET['txttelefon'];
$email = $_GET['txtemail'];
$news = $_GET['txtnews'];
$kommentar = $_GET['txtkommentar'];
$kundeseit = $_GET['txtkundeseit'];


$pdo = new PDO('mysql:host=localhost;dbname=dbkfz','root','');

$statement = $pdo->prepare("INSERT INTO kunde (kundennummer, anrede, titel, vorname, nachname, gebdat, strasse, plz, ort, telefon, email, newsletter, kommentar, kundeseit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$statement->execute(array($kundennummer, $anrede, $titel, $vorname, $nachname, $gebdat, $strasse, $plz, $ort, $telefonnummer, $email, $news, $kommentar, $kundeseit));




?>