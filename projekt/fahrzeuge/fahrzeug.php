<?php 

$kundeid = $_POST['kundeid'];
$marke = $_POST['marke'];
$typ =$_POST['typ'];
$kennzeichen =$_POST['kennzeichen'];
$fahrgestellnummer = $_POST['fahrgestellnummer'];
$nationalcode = $_POST['nationalcode'];
$motorkennzeichen = $_POST['motorkennzeichen'];
$getriebekennzeichen = $_POST['getriebekennzeichen'];
$farbe = $_POST['farbe'];
$treibstoff = $_POST['treibstoff'];
$leistung = $_POST['leistung'];
$hubraum = $_POST['hubraum'];
$erstzulassung = $_POST['erstzulassung'];


$pdo = new PDO('mysql:host=localhost;dbname=dbkfz', 'root','');

$statement = $pdo->prepare("INSERT INTO fahrzeug (kundeid, marke, typ, kennzeichen, fahrgestellnummer ,nationalcode ,motorkennzeichen ,getriebekennzeichen, farbe, treibstoff ,leistung ,hubraum, erstzulassung) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$statement->execute(array($kundeid, $marke, $typ, $kennzeichen ,$fahrgestellnummer, $nationalcode ,$motorkennzeichen ,$getriebekennzeichen ,$farbe ,$treibstoff ,$leistung ,$hubraum, $erstzulassung  ) ); 
echo "added successfully"; 


?>