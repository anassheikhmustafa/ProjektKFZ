<!DOCTYPE html><html lang="de"><head>


<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<title>Auftrag</title>

<style>
div.sticky {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  padding: 40px;
  width: 100%;
  font-size: 15px;
  background-color: #F8F8FF;
  
}
* {
  box-sizing: border-box;
}

#myInput {
background-position: 10px 10px;
background-repeat: no-repeat;
width: 100%;
font-size: 16px;
padding: 12px 20px 12px 40px;
border: 1px solid #ddd;
margin-bottom: 12px;
}

#myTable {
border-collapse: collapse;
width: 100%;
border: 1px solid #ddd;
font-size: 18px;
}

#myTable th, #myTable td {
text-align: left;
padding: 12px;
}

#myTable tr {
border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
background-color: #f1f1f1;
}
</style>

</head><body>
<div class="alert alert-info" role="alert">
<h1>Auftragsübersicht</h1></div>

<?php

session_start();
if(isset($_POST["auswahledit"])){
$repidsession = $_POST['auswahledit'];
$_SESSION['auswahledit'] = $repidsession;}
if(isset($_POST["eintragen"])){
    $repidsession = $_POST['eintragen'];
    $_SESSION['eintragen'] = $repidsession;}

    if(isset($_SESSION["auswahledit"])){
   $name = $_SESSION['auswahledit'];}
   else{
    $name = $_SESSION['eintragen']; 
   }

 
// 1. Verbindung zur Datenbank herstellen
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'dbkfz';

$connect = mysqli_connect($host_name, $user_name, $password, $database);
$connect2 = mysqli_connect($host_name, $user_name, $password, $database);
$connect3 = mysqli_connect($host_name, $user_name, $password, $database);
$connect4 = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");
mysqli_query($connect2, "SET NAMES 'utf8'");
mysqli_query($connect3, "SET NAMES 'utf8'");

    // Datenbankabfrage starten
    $id = $name;
    $abfrage2 = "SELECT reparatur.`fzid`, `repid`,`kennzeichen`, `datum`, `marke`, `typ`, `bemerkung`, `vorname`, `kundennummer`, `nachname` FROM reparatur LEFT JOIN fahrzeug on fahrzeug.`fzid` = reparatur.`fzid`
    LEFT JOIN kunde on kunde.`kundennummer` = fahrzeug.`kundeid`  WHERE repid = $id";
    $result2 = mysqli_query($connect2, $abfrage2);

    // Datensatz in Variablen speichern
    $dsatz2 = mysqli_fetch_assoc($result2);
    $bez2 = $dsatz2["bemerkung"];
    $datum2 = $dsatz2["datum"];
    $kdnr = $dsatz2["kundennummer"];
    $kdnam = $dsatz2["nachname"];
    $marke = $dsatz2["marke"];
    $typ = $dsatz2["typ"];
    $kz = $dsatz2["kennzeichen"];

   
        $kundennrsession = $dsatz2['kundennummer'];
        $_SESSION['kundennummerID'] = $kundennrsession;
        $kdnr2 = $_SESSION['kundennummerID'];

    // Das Bearbeiten-Formular anzeigen
    echo "<p>" . "<b>" . "Kunde: " . "</b>". "$kdnr" . " " . "$kdnam". " " . "<b>" . "Fahrzeug: " . "</b>". "$marke" . " " . "$typ" . " " . "$kz" .  "</p>";
    echo "<p>" . "<b>" . "Reparaturauftrag: " . "</b>". "$id" . "<b>" . " " . "Datum: " . "</b>". "$datum2" . "</p>";
    echo "<p>" . "<b>" . "Bemerkung: "  . "</b>" . "$bez2" . "</p>";
    echo "</form>";

    echo "<a href='auftrag.php'  class='btn btn-secondary btn-lg'>Zurück zur Übersicht</a>";

    echo"</form>";
    echo "<br><br>";

    include "newrep.php";


// Anzeige aller Datensätze der Tabelle
$id = $name;
$abfrage2 = "SELECT reparaturdetails.`teileid`, `repdetid`,`anzahl`,  `bezeichnung` FROM reparaturdetails LEFT JOIN teile on teile.`teileid` = reparaturdetails.`teileid` where repid=$id";

$result4 = mysqli_query($connect4, $abfrage2);


echo "<table id='myTable' border='1' cellpadding='5'>
      <trclass='header'>
      <th style='width:5%;'>edit</th>  
      <th style='width:5%;'>delete</th>  
      <th>Teileid</th>
      <th>Anzahl</th> 
      </tr>";
echo "<form method='post'>";


while($dsatz4 = mysqli_fetch_assoc($result4)){
    echo "<tr>";
    $idt = $dsatz4["repdetid"];

    echo "<td><input type='radio' name='auswahl' value='$idt'></td>" .
         "<td><input type='checkbox' name='auswahl$idt' value='$idt'></td>" .
         "<td>" . $dsatz4["teileid"] . " " . $dsatz4["bezeichnung"] .  "</td>" .
         "<td>" . $dsatz4["anzahl"] ."</td>" .
         "</tr>";
}

echo "</table>";

?>

<div class="sticky">
<p>
<input type="submit" name="bearbeiten" formaction="aedit.php" value="ausgewählten Datensatz bearbeiten"  class="btn btn-info btn-lg"><input type="submit" name="löschen" formaction="adelet.php" value="ausgewählte Datensätze löschen" class="btn btn-danger btn-lg">
</p>
<br>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body></html>