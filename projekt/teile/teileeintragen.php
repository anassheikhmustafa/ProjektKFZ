<!DOCTYPE html><html lang="de"><head>
<meta charset="UTF-8">
<title>Neuen Artikel anlegen:</title>

<?php
    if(isset($_POST["neuenArtikelanlegen"])){

    //Verbindung zur Datenbank herstellen
    $host_name = 'localhost';
    $user_name = 'root';
    $password = '';
    $database = 'dbkfz';
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    mysqli_query($connect, "SET NAMES 'utf8'");

    //Nutzereingabe in Variablen speichern
    $artnr = $_POST["artnr"];
    $bez = $_POST["bezeichnung"];
    $preis = str_replace(',', '.', $_POST["preis"]);
   

    // String für SQL-Anweisung erstellen
    $insertString = "INSERT INTO teile(artnr, bezeichnung, preis)
 VALUES ('$artnr', '$bez', '$preis');";

    // SQL-Anweisung durchführen
    $check = mysqli_query($connect, $insertString);

    if($check) {
        echo "Ein neuer Datensatz erfolgreich hinzugefügt";
    }else {
        echo  "Fehler in der Eingabe, der Datensatz konnte nicht hinzugefügt werden!";  
    }}
?>

</head><body>

<h1>Neuen Artikel hinzufügen:</h1>

<form action="teileeintragen.php" method="post">
    <p><input name="artnr"> Artikelnr</p>
    <p><input name="bezeichnung"> Bezeichnung</p>
    <p><input name="preis"> Preis</p>
    <p><input type="submit" name="neuenArtikelanlegen" value="Artikel eintragen"> <input type="reset"></p>

</form>

<a href="teile.php">Zurück zur Übersicht</a>

</body></html>


