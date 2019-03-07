<!DOCTYPE html><html lang="de"><head></head><body>
<?php
session_start();

//Datenbank-Verbindung herstellen
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'dbkfz';
$connect = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");
$connect2 = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect2, "SET NAMES 'utf8'");

//Ausgewählte Datensätze löschen:
for($i=1; $i<=999999; $i++){
    if(isset($_POST["auswahl$i"])){

        $abfrage2 = "SELECT reparatur.`fzid`, `repid`,`kennzeichen`, `datum`, `marke`, `typ`, `bemerkung`, `vorname`, `kundennummer`, `nachname` FROM reparatur LEFT JOIN fahrzeug on fahrzeug.`fzid` = reparatur.`fzid`
        LEFT JOIN kunde on kunde.`kundennummer` = fahrzeug.`kundeid`  WHERE repid=$i";
        $result2 = mysqli_query($connect2, $abfrage2);

        // Datensatz in Variablen speichern
        $dsatz2 = mysqli_fetch_assoc($result2);
        $kdnr = $dsatz2["kundennummer"];

        $kundennrsession = $dsatz2['kundennummer'];
        $_SESSION['kundennummerID'] = $kundennrsession;
        $kdnr2 = $_SESSION['kundennummerID'];


        // Datensatz löschen
        $deleteAnweisung = "DELETE FROM reparatur  WHERE repid=$i";
        $result = mysqli_query($connect, $deleteAnweisung);
        echo "Datensatz mit der ID $i wurde gelöscht. <br>";
    }

}



?>

<a href="auftrag.php">Zurück zur Übersicht</a>

</body></html>