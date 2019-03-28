<!DOCTYPE html>
<html>
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <title>Rechnungen Seite </title>    

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

     </style>

     <ul>
     <ul> 
      <li><a href="/kfz/projekt/index.php">Home(Kunden)</a></li>
      <li><a href="/kfz/projekt/auftrag/auftrag.php">Auftrag</a></li>
      <li><a href="/kfz/projekt/teile/teile.php">Teile</a></li>
      <li><a href="/kfz/projekt/rechnungen/rechnung.php">Rechnung</a></li>  
      
     </ul>
     </ul>
    </head>
 <body>
 <ul><li><a href="/kfz/projekt/rechnungen/rechnungsdet.php">Rechnung Details</a></li></ul>

 <h1> Neu Rechnung hinzufügen</h1>
 
 <form>
 
  <table>

    <tr><td>Rechnungsnummer<input type="text" name="Rechnungsnummer" disabled></td></tr>
    <tr><td>Rechnungsdatum<input type="date" name="Rechnungsdatum"></td></tr>


     <!-- the 1th dropdown list in html within the php -->
    <tr><td><label>Kunden Name</label>    
     <select name="dbbk"> 
        <option>Select</option>    
            <?php

            //the query which execute the table into the dropdown list(must be a loop)

             if ($stmt=$conn->query("SELECT * FROM kunde"))
             {
                while($r=$stmt->fetch_array(MYSQLI_ASSOC)){
         
            ?>
        <option value = "<?php echo $r ['vorname']?>"> <?php echo $r['vorname'] ." ". $r['nachname']?></option>

        <?php } }  ?>
          
     </select>
    </td></tr>

   <!-- the 2th dropdown list in html within the php -->
    <tr><td><select name="dbbf">

     <option>Verfügbare Autos</option>
    
     <?php 
      //the query which execute the table into the dropdown list(must be a loop)
      if ($stmt=$conn->query("SELECT * FROM fahrzeug "))
      {
         while($f=$stmt->fetch_array(MYSQLI_ASSOC)){
         
     ?>
     <option value = "<?php echo $f ['marke']?>">  <?php echo $f['marke'] ." - ". $f['typ'] . "-" . $f['kennzeichen'] ?></option>
    
     <?php } }  ?>
    
    
     </select>
    </td></tr></td></tr>

    <tr><td>Status<input type="text" name="nachname"></td></tr>
    <tr><td><button type="submit">Eingeben</button></td></tr>

 </table>

</form>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
