<!DOCTYPE html><html lang="de"><head></head><body>
<?php

//Datenbank-Verbindung herstellen
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'dbkfz';
$connect = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");

//Ausgewählte Datensätze löschen:
for($i=1; $i<=999999; $i++){
    if(isset($_POST["auswahl$i"])){
        $deleteAnweisung = "DELETE FROM reparatur  WHERE repid=$i";
        $result = mysqli_query($connect, $deleteAnweisung);
        echo "Datensatz mit der ID $i wurde gelöscht. <br>";
    }
}
?>

<a href="auftrag.php">Zurück zur Übersicht</a>

</body></html>