<?php
    $pdo = new PDO('mysql:host=localhost;dbname=dbkfz', 'root', '');

    $sql = "SELECT kundennummer, anrede, titel, vorname, nachname, gebdat, strasse, plz, ort, telefon, email, newsletter, kommentar, kundeseit FROM kunde";
    foreach ($pdo->query($sql) as $row) {
        echo "Kundennummer: ".$row['kundennummer']."<br />";
        echo $row['anrede']." ".$row['titel']." ".$row['vorname']." ".$row['nachname'];
        echo "Geb. Datum:".$row['gebdat']."<br />";
        echo "Strasse: ".$row['strasse']."<br />";
        echo "PLZ: ".$row['plz']."<br />";
        echo  "Ort: ".$row['ort']."<br />";
        echo "Telefon: ".$row['telefon']."<br />";
        echo "E-Mail: ".$row['email']."<br />";
        echo "Newsletter: ".$row['newsletter']."<br />";
        echo "Kommentar: ".$row['kommentar']."<br />";
        echo "Kunde Seit: ".$row['kundeseit']."<br />";
        echo "<br />";
    }

  ?>