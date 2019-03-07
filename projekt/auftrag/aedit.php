<!DOCTYPE html><html lang="de"><head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head><body>

<div class="alert alert-info" role="alert">
<h1>Ausgewählten Datensatz bearbeiten</h1></div>


<?php

// 1. Verbindung zur Datenbank herstellen
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'dbkfz';

$connect = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");


// 2. Prüfe Radio-Button-Auswahl
if(isset($_POST["auswahl"])){

    // 3. Datenbankabfrage starten
    $id = $_POST["auswahl"];
    $abfrage = "SELECT reparaturdetails.`teileid`, `repdetid`,`anzahl`,  `bezeichnung` FROM reparaturdetails LEFT JOIN teile on teile.`teileid` = reparaturdetails.`teileid` WHERE repdetid = $id";
    $result = mysqli_query($connect, $abfrage);

    // 4. Datensatz in Variablen speichern
    $dsatz = mysqli_fetch_assoc($result);
    $id = $dsatz["repdetid"];
    $bez = $dsatz["bezeichnung"];
    $anzahl = $dsatz["anzahl"];

    // 5. Das Bearbeiten-Formular anzeigen
    echo "<form action='aedit.php' method='post'>";
    echo "<p> $bez  </p>";
    echo "<input name='repdetid' type='hidden' value='$id'>";
    echo "<p><input name='anzahl' value='$anzahl'> Anzahl</p>";
    echo "<input name='bearbeitungAbschicken' value='Bearbeitung abschließen' type='submit' class='btn btn-info btn-lg'>";
    echo "</form>";
    echo "<br>";
    echo "<a href='auftragedit.php' class='btn btn-secondary btn-lg'>zurück zur Übersicht</a>";
}

//6. Datensatz aktualisieren mit UPDATE
if(isset($_POST["bearbeitungAbschicken"])){
    $id = $_POST["repdetid"];
    $anzahl = str_replace(',', '.', $_POST["anzahl"]);

//String für Update-Anweisung erstellen
$update = "UPDATE reparaturdetails SET
anzahl = '$anzahl' 
WHERE repdetid = $id";

//MySQL-Anweisung ausführen
    mysqli_query($connect, $update);
 
    echo "Datensatz bearbeitet.<br>";
    echo "<a href='auftragedit.php' class='btn btn-info btn-lg'>zurück zur Übersicht</a>";
}

//Wenn der Nutzer in auftragedit.php keine Auswahl getroffen hat:
if(!isset($_POST["auswahl"]) && !isset($_POST["bearbeitungAbschicken"])){
    echo "Es wurde kein Datensatz ausgewählt.<br>";
    echo "<a href='auftragedit.php' class='btn btn-info btn-lg'>zurück zur Übersicht</a>";
}

?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body></html>