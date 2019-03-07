<!DOCTYPE html><html lang="de"><head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>



<ul>
    <ul> 
      <li><a href="/kfz/projekt/index.php"> Home(Kunden)</a></li>
      <li><a href="/kfz/projekt/auftrag/auftrag.php">Auftrag</a></li>
      <li><a href="/kfz/projekt/teile/teile.php">Teile</a></li>
      <li><a href="/kfz/projekt/fahrzeuge/fahrzeug.html">Reperatur</a></li>  
    </ul>
  </ul>
  <h1>Artikel-Liste: </h1>
<?php

//Verbindung zur Datenbank herstellen
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'dbkfz';

$connect = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");


// Anzeige aller Datensätze der Tabelle
$abfrage = "SELECT * FROM teile";

$result = mysqli_query($connect, $abfrage);

echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Nach Artikelnummer suchen..' title='Type in a name'>";
echo '<p><input type="submit" name="eintragen" formaction="teileeintragen.php" value="Neuen Artikel eintragen"></p>';

echo "<table id='myTable' border='1' cellpadding='5'>
      <trclass='header'>
      <th style='width:5%;'>edit</th>  
      <th style='width:5%;'>delete</th>  
      <th style='width:5%;'>ID</th>
      <th>Artikelnummer</th>
      <th>Bezeichnung</th>
      <th>Preis</th> 
      </tr>";
echo "<form method='post'>";


while($dsatz = mysqli_fetch_assoc($result)){
    echo "<tr>";
    $id = $dsatz["teileid"];

    echo "<td><input type='radio' name='auswahl' value='$id'></td>" .
         "<td><input type='checkbox' name='auswahl$id' value='$id'></td>" .

         "<td>" . $dsatz["teileid"] . "</td>" .
         "<td>" . $dsatz["artnr"] . "</td>" .
         "<td>" . $dsatz["bezeichnung"] . "</td>" .
         "<td>" . $dsatz["preis"] . ' €' ."</td>" .
         "</tr>";
}

echo "</table>";

//Script für die Suche
echo "<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  table = document.getElementById('myTable');
  tr = table.getElementsByTagName('tr');
  for (i = 0 ; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }       
  }
}
</script>";

?>
<div class="sticky">
<h2>Aktionen:</h2>
<p>
<input type="submit" name="eintragen" formaction="teileeintragen.php" value="Neuen Artikel eintragen">
</p>
<p>
<input type="submit" name="bearbeiten" formaction="teilebearbeiten.php" value="ausgewählten Datensatz bearbeiten">
</p>
<p>
<input type="submit" name="löschen" formaction="teileloeschen.php" value="ausgewählte Datensätze löschen">
</p>
<br>
</div>

</form>
</body>
</html>