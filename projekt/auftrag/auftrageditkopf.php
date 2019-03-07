<!DOCTYPE html><html lang="de">
<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


</head>
<body>

<h1>Ausgewählten Datensatz bearbeiten</h1>

<?php

// 1. Verbindung zur Datenbank herstellen
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'dbkfz';

$connect = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");


// 2. Prüfe Button-Auswahl
if(isset($_POST["auswahlkopfedit"])){

    // 3. Datenbankabfrage starten
    $idr = $_POST["auswahlkopfedit"];
    $abfrage = "SELECT reparatur.`fzid`, `repid`,`kennzeichen`, `datum`, `marke`, `typ`, `bemerkung`, `vorname`, `kundennummer`, `nachname` FROM reparatur LEFT JOIN fahrzeug on fahrzeug.`fzid` = reparatur.`fzid`
    LEFT JOIN kunde on kunde.`kundennummer` = fahrzeug.`kundeid`   WHERE repid = $idr";
    $result = mysqli_query($connect, $abfrage);

    // 4. Datensatz in Variablen speichern
    $dsatz = mysqli_fetch_assoc($result);
    $bez = $dsatz["bemerkung"];
    $datum = $dsatz["datum"];

    $kundennrsession = $dsatz['kundennummer'];
    $_SESSION['kundennummerID'] = $kundennrsession;
    $kdnr2 = $_SESSION['kundennummerID'];

    // 5. Das Bearbeiten-Formular anzeigen
    echo "<form action='auftrageditkopf.php' method='post'>";
    echo "<p>" . "Reparaturauftrag: " . "<input name='repid' type='text' value='$idr' onfocus='blur()'>";
    echo "<p><input  class='form-control' type='text' name='bemerkung' value='$bez'> Bemerkung</p>";
    echo "<p><input style='width:20%;' type='date' class='form-control' name='datum' value='$datum'> Datum</p>";
    echo "<input name='bearbeitungAbschicken' class='btn btn-primary btn-lg active' value='Bearbeitung abschließen' type='submit'>";
    echo "</form>";

    echo "<a href='auftrag.php'  class='btn btn-secondary btn-lg'>Zurück zur Übersicht</a>";
    
}

//6. Datensatz aktualisieren mit UPDATE
if(isset($_POST["bearbeitungAbschicken"])){
    $id = $_POST["repid"];
    $bez = $_POST["bemerkung"];
    $datum = $_POST["datum"];

//String für Update-Anweisung erstellen
$update = "UPDATE reparatur SET
bemerkung = '$bez', 
datum = '$datum' 
WHERE repid = $id";

//MySQL-Anweisung ausführen
    mysqli_query($connect, $update);
 
    echo "Datensatz bearbeitet.<br>";
    echo "<a href='auftrag.php'  class='btn btn-secondary btn-lg'>Zurück zur Übersicht</a>";
}
//Wenn der Nutzer in auftrag.php keine Auswahl getroffen hat:
if(!isset($_POST["auswahlkopfedit"]) && !isset($_POST["bearbeitungAbschicken"])){
    echo "Es wurde kein Datensatz ausgewählt.<br>";
    echo "<a href='auftrag.php'  class='btn btn-secondary btn-lg'>Zurück zur Übersicht</a>";
}



?>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body></html>