<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Neu Fahrzeug</title>
</head>
<body>
    <form action="fahrzeug.php" method="POST">
     
        <p class="font-italic">kundeid<input type="text" name="kundeid" value="<?php echo $_GET['kundeid'] ?>" disabled></p>
        <p class="font-italic">marke<input type="text" name="marke"></p>
        <p class="font-italic">typ<input type="text" name="typ"></p>
        <p class="font-italic">kennzeichen<input type="text" name="kennzeichen"></p>
        <p class="font-italic">fahrgestellnummer<input type="text" name="fahrgestellnummer"></p>
        <p class="font-italic">nationalcode<input type="text" name="nationalcode"></p>
        <p class="font-italic">motorkennzeichen<input type="text" name="motorkennzeichen"></p>
        <p class="font-italic">getriebekennzeichen<input type="text" name= "getriebekennzeichen"></p>
        <p class="font-italic">farbe<input type="text" name="farbe"></p>
        <p class="font-italic">treibstoff<input type="text" name="treibstoff"></p>
        <p class="font-italic">leistung<input type="number" name="leistung"></p>
        <p class="font-italic">hubraum<input type="number" name="hubraum"></p>
        <p class="font-italic">erstzulassung<input type="date" name="erstzulassung"></p>

             


                
    
        <button type="submit" name="Eingeben">Eingeben</button>


    </form>
</body>
</html>