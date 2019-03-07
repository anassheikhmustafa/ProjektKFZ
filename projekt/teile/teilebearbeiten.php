<!DOCTYPE html><html lang="de"><head></head><body>

<h1>Ausgewählten Datensatz bearbeiten</h1>

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
    $abfrage = "SELECT * FROM teile WHERE teileid = $id";
    $result = mysqli_query($connect, $abfrage);

    // 4. Datensatz in Variablen speichern
    $dsatz = mysqli_fetch_assoc($result);
    $artnr = $dsatz["artnr"];
    $bez = $dsatz["bezeichnung"];
    $preis = $dsatz["preis"];

    // 5. Das Bearbeiten-Formular anzeigen
    echo "<form action='teilebearbeiten.php' method='post'>";
    echo "<input name='teileid' type='hidden' value='$id'>";
    echo "<p><input name='artnr' value='$artnr'> Artikelnummer</p>";
    echo "<p><input name='bezeichnung' value='$bez'> Bezeichnung</p>";
    echo "<p><input name='preis' value='$preis'> Preis</p>";
    echo "<input name='bearbeitungAbschicken' value='Bearbeitung abschließen' type='submit'>";
    echo "</form>";

    echo "<a href='teile.php'>zurück zur Übersicht</a>";
}

//6. Datensatz aktualisieren mit UPDATE
if(isset($_POST["bearbeitungAbschicken"])){
    $id = $_POST["teileid"];
    $artnr = $_POST["artnr"];
    $bez = $_POST["bezeichnung"];
    $preis = str_replace(',', '.', $_POST["preis"]);

//String für Update-Anweisung erstellen
$update = "UPDATE teile SET
artnr = '$artnr', 
bezeichnung = '$bez', 
preis = '$preis' 
WHERE teileid = $id";

//MySQL-Anweisung ausführen
    mysqli_query($connect, $update);
 
    echo "Datensatz bearbeitet.<br>";
    echo "<a href='teile.php'>zurück zur Übersicht</a>";
}

//Wenn der Nutzer in teile.php keine Auswahl getroffen hat:
if(!isset($_POST["auswahl"]) && !isset($_POST["bearbeitungAbschicken"])){
    echo "Es wurde kein Datensatz ausgewählt.<br>";
    echo "<a href='teile.php'>zurück zur Übersicht</a>";
}

?>

</body></html>