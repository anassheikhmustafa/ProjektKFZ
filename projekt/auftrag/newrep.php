<!DOCTYPE html><html lang="de">
<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<title>Auftrag</title>

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

</head><body>
<div class="alert alert-info" role="alert">
<h1>Artikel zu Auftrag erfassen</h1></div>

<?php


//$id = $_SESSION['auswahledit'];
echo "<br>";

if(isset($_POST["neuenArtikelanlegen"])){

    //Nutzereingabe in Variablen speichern
    $teileid = $_POST["teileid"];
    $anz = str_replace(',', '.', $_POST["anzahl"]);
   

    // String für SQL-Anweisung erstellen
    $insertString = "INSERT INTO reparaturdetails(repid, teileid, anzahl)
 VALUES ('$id', '$teileid', '$anz');";

    // SQL-Anweisung durchführen
    $check = mysqli_query($connect3, $insertString);

    if($check) {
        echo "Ein neuer Datensatz erfolgreich hinzugefügt";
    }else {
        echo  "Fehler in der Eingabe, der Datensatz konnte nicht hinzugefügt werden!";  
    }}

    
?>

<!--<form action="auftragedit.php" method="post">  <p><input name="teileid"> Teileid</p> -->
<form  method='post'>
    <p><button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal' >Artikel Auswählen</button></p>
    <p><input type='text' id='namap'  placeholder='TeileId' name='teileid' onfocus='blur()'></p>
    <p><input name="anzahl"> Anzahl</p>
    <p><input type="submit" name="neuenArtikelanlegen" value="Artikel eintragen"  class="btn btn-info btn-lg"> <input  class="btn btn-danger btn-lg" type="reset"></p>

</form>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Artikelauswahl</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Wählen Sie einen Artikel aus!</p>
            <?php

            //Verbindung zur Datenbank herstellen
            $host_name = 'localhost';
            $user_name = 'root';
            $password = '';
            $database = 'dbkfz';

            $connectmodal = mysqli_connect($host_name, $user_name, $password, $database);
            mysqli_query($connectmodal, "SET NAMES 'utf8'");


            // Anzeige aller Datensätze der Tabelle
            $abfrage = "SELECT * FROM teile";

            $resultmodal = mysqli_query($connectmodal, $abfrage);

            //Suchfeld einfügen
            echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Nach Artikel suchen..' title='Type in a name'>";

            //Kopfzeile
            echo "<table id='myTable' border='1' cellpadding='5'>
                <tr class='header'>
                <th style='width:5%;'>ID</th>
                <th>Artikelnummer</th>
                <th>Bezeichnung</th> 
                </tr>";
            echo "<form method='post'>";

            //Inhalt
            while($dsatzmodal = mysqli_fetch_assoc($resultmodal)){
                echo "<tr>";
                $idar = $dsatzmodal["teileid"];
                $artnr = $dsatzmodal["artnr"];

                echo 
                    "<td>" . "<button class='pickCustomer'  value='$idar' data-dismiss='modal'>" . $idar . "</button>" . "</td>" .
                    "<td>" . $dsatzmodal["artnr"] . "</td>" .
                    "<td>" . $dsatzmodal["bezeichnung"] . "</td>" .
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


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script> 
    $('.pickCustomer').click(function() {
        var name = $(this).val();
        $('#namap').val(name);
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