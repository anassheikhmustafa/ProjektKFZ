<!DOCTYPE html>
<html>
    <head>

            <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <title>Auftrag</title>

    <style>

        ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: rgb(209, 202, 202);
        }
        li {
        float: left;
        }
        li a {
        display: block;
        color: rgb(49, 8, 8);
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        }
        li a:hover:not(.active) {
        background-color: rgb(190, 182, 182);
        }
        .active {
        background-color: #4CAF50;
        }
 




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

        #myTabledd {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
        }

        #myTabledd th, #myTabledd td {
        text-align: left;
        padding: 12px;
        }

        #myTabledd tr {
        border-bottom: 1px solid #ddd;
        }

        #myTabledd tr.header, #myTabledd tr:hover {
        background-color: #f1f1f1;
        }

    </style>
    </head>
<body>
<ul>
    <ul> 
      <li><a href="/kfz/projekt/index.php"> Home(Kunden)</a></li>
      <li><a href="/kfz/projekt/auftrag/auftrag.php">Auftrag</a></li>
      <li><a href="/kfz/projekt/teile/teile.php">Teile</a></li>
      <li><a href="/kfz/projekt/reperatur/reperatur.php">Reperatur</a></li>  
    </ul>
  </ul>
<?php

echo "<form method='post'>";
echo "<input type='submit' class='btn btn-info btn-block' name='eintragen' formaction='auftragneu.php' value='Neuen Auftrag erstellen'>";
echo "<br>";
?>

<?php 
error_reporting(E_ALL);
echo "
<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
      
    <table class='table table-bordered'>    
        <tr>
            <td><center><button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal' >Kunde suchen</button></center></td>
            <td><div class='form-group'><input type='text' class='form-control' id='namap'  placeholder='Kundennummer' name='namap'></div></td>
            <td><center><input type='hidden' name='abgeschickt' />
            <input type='submit'  class='btn btn-info btn-lg'></input></center></td>
        </tr>
    </table>
</form>";

  
if (isset($_POST['abgeschickt'])){
    if( empty ($_POST['namap']) == TRUE){
       echo "<div class='alert alert-danger'>" . "<strong>" . "Achtung! " . "</strong>" . "Sie müssen einen Kunden auswählen!" . "</div>";
       
    } else {
    $kdnnam = $_POST['namap'];
    
        //Verbindung zur Datenbank herstellen
        $host_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $database = 'dbkfz';

        $connect = mysqli_connect($host_name, $user_name, $password, $database);
        mysqli_query($connect, "SET NAMES 'utf8'");


        // Anzeige aller Datensätze der Tabelle
        $abfrage = "SELECT reparatur.`fzid`, `repid`,`kennzeichen`, `datum`, `marke`, `typ`, `bemerkung`, `vorname`, `kundennummer`, `nachname` FROM reparatur LEFT JOIN fahrzeug on fahrzeug.`fzid` = reparatur.`fzid`
        LEFT JOIN kunde on kunde.`kundennummer` = fahrzeug.`kundeid` WHERE kundennummer like '%$kdnnam%' Order By `datum` DESC";

        $result = mysqli_query($connect, $abfrage);
        $result2 = mysqli_query($connect, $abfrage);
        $result3 = mysqli_query($connect, $abfrage);

        $dsatz3 = mysqli_fetch_assoc($result2);
      

        echo "<br />" . "<div class='alert alert-primary' role='alert'>" . $dsatz3['kundennummer'] . ' '  . $dsatz3['nachname'] . ' '  .  $dsatz3['vorname'] . "</div>" . "<br />";
 
        while($dsatz2 = mysqli_fetch_assoc($result2)){
        
        $id2 = $dsatz2["repid"];
        $kdnr2 = $dsatz2["kundennummer"];
        }

        echo "<table  id='myTabledd'  border='1' cellpadding='5'>
        <tr class='header'>
        <th style='width:5%;'>Row</th>
        <th style='width:5%;'>Main</th>
        <th style='width:5%;'>Delet</th>
        <th style='width:5%;'>ID</th>
        <th style='width:10%;'>Datum</th>
        <th style='width:5%;'>Marke</th>
        <th style='width:5%;'>Type</th>
        <th style='width:5%;'>Kennzeichen</th> 
        <th>Bemerkung</th>
        </tr>";
            
        //Inhalt
      
        while($row = mysqli_fetch_assoc($result)){
            
                
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
            echo"<tr>" .
                "<td>" ."<input type='hidden' name='auswahledit' value='".$row['repid']."'><input type='submit' class='btn btn-info btn-lg'  formaction='auftragedit.php' value='Edit' />" . "</td>" .
                "<td>" ."<input type='hidden' name='auswahlkopfedit' value='".$row['repid']."'><input type='submit' class='btn btn-info btn-lg'  formaction='auftrageditkopf.php' value='Edit' />" . "</td>" .  
                "<td>" ."<input type='submit' class='btn btn-danger btn-lg' name='auswahl".$row['repid']."' formaction='auftragdelet.php' value='Delet'>" . "</td>" . 
                "<td>" . $row['repid']. "</td>" .
                "<td>" . $row["datum"] . "</td>" .
                "<td>" . $row["marke"] . "</td>" .
                "<td>" . $row["typ"] . "</td>" .
                "<td>" . $row["kennzeichen"] . "</td>" .
                "<td>" . $row["bemerkung"] . "</td>" .
                "</tr>";
            echo "</form>";
        }
      
        echo "</table>";
            }
}
?>
     

<!-- Modal -->
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
            $abfrage = "SELECT reparatur.`fzid`, `repid`,`kennzeichen`,  `vorname`, `kundennummer`, `nachname` FROM reparatur LEFT JOIN fahrzeug on fahrzeug.`fzid` = reparatur.`fzid`
            LEFT JOIN kunde on kunde.`kundennummer` = fahrzeug.`kundeid` GROUP BY `kundennummer`";

            $resultmodal = mysqli_query($connectmodal, $abfrage);

            //Suchfeld einfügen
            echo "<input type='text' id='myInput' onkeyup='myFunction()' placeholder='Nach Kunde suchen..' title='Type in a name'>";

            //Kopfzeile
            echo "<table id='myTable' border='1' cellpadding='5'>
                <tr class='header'>
                <th style='width:5%;'>Kundennummer</th>
                <th>Name</th>
                <th>Vorname</th> 
                </tr>";
            echo "<form method='post'>";

            //Inhalt
            while($dsatzmodal = mysqli_fetch_assoc($resultmodal)){
                echo "<tr>";
                $id = $dsatzmodal["repid"];
                $kdnr = $dsatzmodal["kundennummer"];

                echo 
                    "<td>" . "<button class='pickCustomer'  value='$kdnr' data-dismiss='modal'>" . $kdnr . "</button>" . "</td>" .
                    "<td>" . $dsatzmodal["nachname"] . "</td>" .
                    "<td>" . $dsatzmodal["vorname"] . "</td>" .
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

</form>

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
</body>          