<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="style.css" rel="stylesheet" type="text/css" media="screen" />

  <title>Kfz</title>

</head>
<body>

  <ul>
    <ul> 
      <li><a href="index.html"> Home(Kunden)</a></li>
      <li><a href="rechnung.html">Rechung</a></li>
      <li><a href="teile/teile.php">Teile</a></li>  
    </ul>
  </ul>
  
  <?php
  echo "Sch&ouml;n, dass du da bist!";
  ?>



  <div class="vertical-menu">
  
       <a href="index.html">HOME</a>
       <br />
       <a href="schulbuch.html">Schulbücher</a>
       <br />
       <a href="lernsoftware.html">Lernsoftware</a>
       <br />
       <a href="musikalien.html">Musikalien</a>
       <br />
       <a href="fortbildung.html">Fortbildung</a>
       <br />
      <a href="shop.php">Shop</a>
      <br />
      <a href="impressum.html">Impressum</a>
  </div>
</div>
 
</div>
<div>
<button id="modalActivate" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalPreview">
  Neuer Kunde!
</button>
</div>
<!-- Modal -->
<div class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalPreviewLabel"> Neu Kunde anlegen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body">
            <form action="kunden/kunden.php" method="GET">
              <table border="0" cellspacing="2" cellpadding="2">
                <tbody>
                  <tr>
                    <td align="right">Kundennummer:</td>
                    <td>
                      <input maxlength="20" name="txtkundennummer" size="20" type="text" />
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Anrede:</td>
                    <td>
                      <select name="txtanrede">
                        <option value="0">Bitte wählen</option>
                        <option value="Herr">Herr</option>
                        <option value="Frau">Frau</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                      <td align="right">Titel:</td>
                      <td>
                        <input maxlength="5" name="txttitel" size="3" type="text" />
                      </td>
                  <tr>
                    <td align="right">Vorname:</td>
                    <td>
                      <input maxlength="50" name="txtvorname" size="20" type="text" />
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Nachname:</td>
                    <td>
                      <input maxlength="50" name="txtnachname" size="20" type="text" />
                    </td>
                  </tr>
                  <tr>
                      <td align="right">Geb. Datum:</td>
                      <td>
                        <input maxlength="50" name="txtgeb" size="7" type="date" />
                      </td>
                  <tr>
                    <td align="right">Strasse:</td>
                    <td>
                      <input maxlength="50" name="txtstrasse" size="20" type="text" />
                    </td>
                  </tr>
                  <tr>
                  <td align="right">PLZ:</td>
                  <td>
                    <input maxlength="5" name="txtplz" size="6" type="text" />
                  </td>
                  </tr>
                  <tr>
                    <td align="right">Ort:</td>
                    <td>
                      <input maxlength="50" name="txtort" size="20" type="text" />
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Telefon:</td>
                    <td>
                      <input name="txttelefon" size="20" type="text" value="0043" />
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Email:</td>
                    <td>
                      <input maxlength="80" name="txtemail" size="20" type="text" />
                    </td>
                  </tr>
                  <tr>
                      <td align="right">Newsletter:</td>
                      <td>
                        <select name="txtnews">
                          <option value="0">Bitte wählen</option>
                          <option value="ja">Ja</option>
                          <option value="nein">Nein</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="right">Kommentar:</td>
                      <td>
                        <input maxlength="50" name="txtkommentar" size="10" type="text" />
                      </td>
                    </tr>
                    <tr>
                      <td align="right">Kunde seit:</td>
                      <td>
                        <input maxlength="50" name="txtkundeseit" size="10" type="date" />
                      </td>
                    </tr>
                </tbody>
              </table>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zurück</button>
            <button type="submit" class="btn btn-default">Abschicken</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
</body>
</html>

