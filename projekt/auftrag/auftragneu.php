<!DOCTYPE html><html lang="de"><head>


<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">



<style>
#myInput {
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
        }

        #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
        }

        #myTable th, #myTable td {
        text-align: left;
        padding: 12px;
        }

        #myTable tr {
        border-bottom: 1px solid #ddd;
        }

        #myTable tr.header, #myTable tr:hover {
        background-color: #f1f1f1;
        }

</style>

<meta charset="UTF-8">
<title>Neuen Auftrag erstellen:</title>

</head><body>

<h1>Neuen Auftrag anlegen:</h1>

<form action="auftragneu.php" method="post">


<table class='table table-bordered'>    
    <tr>
    <td style='width:20%;' ><button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal' >Fahrzeug auswählen</button></td>
    <td style='width:10%;' ><div class='form-group'><input type='text' class='form-control' id='fzidup'  placeholder='Fahrzeug' name='fzidup' onfocus='blur()'></div></td>
    <td><div class='form-group'><input type="text" class='form-control' name="bemerkung" placeholder="Bemerkung"> </div></td>
    </tr>
    <tr>
    <td><p>Datum:</p></td>
    <td><p><input type="date"  name="datum"> </p></td>
    <td><p><input type="submit" class='btn btn-info btn-lg' name="neuenAuftraganlegen" value="Auftrag anlgegen"> <input class='btn btn-info btn-lg' type="reset"></p></td>
    </tr>
</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kundenauswahl</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Wählen Sie einen Kunden aus!</p>
            <?php

            //Verbindung zur Datenbank herstellen
            $host_name = 'localhost';
            $user_name = 'root';
            $password = '';
            $database = 'dbkfz';

            $connectmodal = mysqli_connect($host_name, $user_name, $password, $database);
            mysqli_query($connectmodal, "SET NAMES 'utf8'");


            // Anzeige aller Datensätze der Tabelle
            $abfrage = "SELECT  reparatur.`fzid`, `repid`,`kennzeichen`,  `marke`, `typ`,  `vorname`, `kundennummer`, `nachname` FROM reparatur LEFT JOIN fahrzeug on fahrzeug.`fzid` = reparatur.`fzid`
            LEFT JOIN kunde on kunde.`kundennummer` = fahrzeug.`kundeid` GROUP BY `fzid`";

            $resultmodal = mysqli_query($connectmodal, $abfrage);

            //Suchfeld einfügen
            echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Nach Kunde suchen..' title='Type in a name'>";

            //Kopfzeile
            echo "<table id='myTable' border='1' cellpadding='5'>
                <tr class='header'>
                <th style='width:5%;'>FahrzeugID</th>
                <th>Name</th>
                <th>Vorname</th> 
                <th>Kennzeichen</th> 
                <th>Marke</th> 
                <th>Type</th> 
                </tr>";
            echo "<form method='post'>";

            //Inhalt
            while($dsatzmodal = mysqli_fetch_assoc($resultmodal)){
                echo "<tr>";
                $id = $dsatzmodal["repid"];
                $fzid = $dsatzmodal["fzid"];

                echo 
                    "<td>" . "<button class='pickCustomer'  value='$fzid' data-dismiss='modal'>" . $fzid . "</button>" . "</td>" .
                    "<td>" . $dsatzmodal["nachname"] . "</td>" .
                    "<td>" . $dsatzmodal["vorname"] . "</td>" .
                    "<td>" . $dsatzmodal["kennzeichen"] . "</td>" .
                    "<td>" . $dsatzmodal["marke"] . "</td>" .
                    "<td>" . $dsatzmodal["typ"] . "</td>" .
                    "</tr>";
                    }
            echo "</table>";
            ?>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
      </div>
    </div>

  </div>
</div>


<?php
    if(isset($_POST["neuenAuftraganlegen"])){

    //Verbindung zur Datenbank herstellen
    $host_name = 'localhost';
    $user_name = 'root';
    $password = '';
    $database = 'dbkfz';
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    mysqli_query($connect, "SET NAMES 'utf8'");

    //Nutzereingabe in Variablen speichern
    $fzid = $_POST["fzidup"];
    $bez = $_POST["bemerkung"];
    $date = $_POST["datum"];
   

    // String für SQL-Anweisung erstellen
    $insertString = "INSERT INTO reparatur(fzid, bemerkung, datum)
 VALUES ('$fzid', '$bez', '$date')";

   
    // SQL-Anweisung durchführen
    $check = mysqli_query($connect, $insertString);
    $rid = mysqli_insert_id($connect);
 


    if($check) {
        
        echo "Ein neuer Auftrag mit der Nummer:" . " " . $rid . " " . " wurde erfolgreich hinzugefügt, möchten Sie mit der Arikelerfassung starten?";
        echo "<form method='post'>";
        echo "<br>";
        echo "<br>";
        echo "<input type='hidden' name='eintragen' value='$rid' />
              <input type='submit'  class='btn btn-primary btn-lg active' formaction='auftragedit.php' value='Artikel erfassen'></input>";
     
        echo '<a href="auftrag.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Zurück zur Übersicht</a>';
        
    }else {
        echo  "Fehler in der Eingabe, der Datensatz konnte nicht hinzugefügt werden!";  
    }}
?>




</form>
<br>
<div class="alert alert-info" role="alert"><a href="auftrag.php">Zurück zur Übersicht</a></div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

 <script>  

 
$('.pickCustomer').click(function() {
        var name = $(this).val();
        $('#fzidup').val(name);
    });

//Script für die Suche
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    table = document.getElementById('myTable');
    tr = table.getElementsByTagName('tr');
    for (i = 0 ; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[1];
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
</body></html>


