<!doctype html>
<html>
<head>
	<title>HTML Editor - Full Version</title>
</head>
<body>
    <script type="text/javascript">
        function testerl() {
            var sel = document.getElementById("lstTest1");
            var texterl = sel.options[sel.selectedIndex].firstChild.data;
            
            document.getElementById("txtAusgabe").value = texterl;
        }
        </script>
<h1>Testerl</h1>

<p><input name="txtAusgabe" id="txtAusgabe" type="text" value="Wert" /></p>
<?php

    $pdo = new PDO('mysql:host=localhost;dbname=dbkfz', 'root', '');

    $sql = "SELECT kundennummer, anrede, titel, vorname, nachname, gebdat, strasse, plz, ort, telefon, email, newsletter, kommentar, kundeseit FROM kunde";
    foreach ($pdo->query($sql) as $row) {
        echo "Kundennummer: ".$row['kundennummer']."<br />";

    }

  $banane =  $row['kundennummer'];


  ?>

<p>
<select name="lstTest1" id="lstTest1" onclick="testerl()">
<option value="$banane"></option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
</p>
</body>
</html>
