<!DOCTYPE html><html lang="de"><head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head><body>
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


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body></html>