<!DOCTYPE html><html lang="de"><head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<ul>
    <ul> 
      <li><a href="/kfz/projekt/index.php"> Home(Kunden)</a></li>
      <li><a href="/kfz/projekt/auftrag/auftrag.php">Auftrag</a></li>
      <li><a href="/kfz/projekt/teile/teile.php">Teile</a></li>
      <li><a href="/kfz/projekt/rechnungen/rechnung.php">Rechnung</a></li>  
    </ul>
  </ul>
  <div class="alert alert-dark" role="alert"><h1>Artikel-Liste </h1></div>
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


?>
<div class="sticky">
<h2>Aktionen:</h2>
<p>
<input type="submit" name="eintragen" formaction="teileeintragen.php" value="Neuen Artikel eintragen">
<input type="submit" name="bearbeiten" formaction="teilebearbeiten.php" value="ausgewählten Datensatz bearbeiten">
<input type="submit" name="löschen" formaction="teileloeschen.php" value="ausgewählte Datensätze löschen">
</p>
<br>
</div>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<!--Script für die Suche -->
<script>
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
</script>
</body>
</html>