<?php
session_start();
$reparaturId = $_SESSION['repid'];

// 1. Verbindung zur Datenbank herstellen
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database = 'dbkfz';

$connect = mysqli_connect($host_name, $user_name, $password, $database);

$rechnungs_nummer = $reparaturId;
$rechnungs_datum = date("d.m.Y");
$lieferdatum = date("d.m.Y");
$pdfAuthor = "Das A-Team";

$rechnungs_header = '
<img src="logo.png">
KFZ-Projekt
Das A-Team
Einfach toll :)';

//Session in Variable
$id = $reparaturId;
// Datenbankabfrage starten
$abfrage= "SELECT reparatur.`fzid`, `repid`,`kennzeichen`, `datum`, `marke`, `typ`, `bemerkung`, `vorname`, `kundennummer`, `nachname` FROM reparatur LEFT JOIN fahrzeug on fahrzeug.`fzid` = reparatur.`fzid`
LEFT JOIN kunde on kunde.`kundennummer` = fahrzeug.`kundeid`  WHERE repid = $id";
$result = mysqli_query($connect, $abfrage);

// Datensatz in Variablen speichern
$dsatz = mysqli_fetch_assoc($result);
$bez2 = $dsatz["bemerkung"];
$datum2 = $dsatz["datum"];
$kdnr = $dsatz["kundennummer"];
$kdnam = $dsatz["nachname"];
$kdnam2 = $dsatz["vorname"];
$marke = $dsatz["marke"];
$typ = $dsatz["typ"];
$kz = $dsatz["kennzeichen"];

$rechnungs_empfaenger = '<b>' . ' Name: ' . '</b>' . $kdnam . ' ' . $kdnam2 .  ' ' .  '<b>' . ' Reparaturdatum: ' . '</b>' . $datum2 . '<br>' .
'<b>' . ' Fahrzeug: ' . '</b>' . $marke . ' ' . $typ . '<b>' . ' Bemerkung: ' . '</b>' . $bez2 ;

$rechnungs_footer = "Wir danken für Ihren Auftrag!";


//Auflistung eurer verschiedenen Posten im Format [Produktbezeichnuns, Menge, Einzelpreis]


$abfrage2 = "SELECT reparaturdetails.`teileid`, `repdetid`,`anzahl`,  `bezeichnung` FROM reparaturdetails LEFT JOIN teile on teile.`teileid` = reparaturdetails.`teileid` where repid=$id";

$result2 = mysqli_query($connect, $abfrage2);

$pdfName = "Auftrag_".$rechnungs_nummer.".pdf";


//////////////////////////// Inhalt des PDFs als HTML-Code \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


// Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
// tcpdf unterstützt recht viele HTML-Befehle. Die Nutzung von CSS ist allerdings
// stark eingeschränkt.

$html = '
<table cellpadding="5" cellspacing="0" style="width: 100%; ">
	<tr>
		<td>'.nl2br(trim($rechnungs_header)).'</td>
	   <td style="text-align: right">
Auftragsnummer '.$rechnungs_nummer.'<br>
Auftragsdatum: '.$rechnungs_datum.'<br>
		</td>
	</tr>

	<tr>
		 <td style="font-size:1.3em; font-weight: bold;">
<br><br>
Auftrag
<br>
		 </td>
	</tr>


	<tr>
		<td colspan="2">'.nl2br(trim($rechnungs_empfaenger)).'</td>
	</tr>
</table>
<br><br><br>

<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
	<tr style="background-color: #cccccc; padding:5px;">
		<td style="padding:5px;"><b>Bezeichnung</b></td>
		<td style="padding:5px;"><b>Menge</b></td>
		<td style="text-align: center;"><b>Bemerkung</b></td>
	</tr>';
			
while($dsatz2 = mysqli_fetch_assoc($result2)){
	$bezeichnung = $dsatz2["bezeichnung"];
	$me = $dsatz2["anzahl"];

	$html .= '<tr>
				<td>'.$bezeichnung.'</td>
				<td style="padding:5px;">'.$me.'</td>		
				<td style="text-align: center;">[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]</td>	
				</tr>';
}
$html .="</table><br><br><br>";



$html .= nl2br($rechnungs_footer);



//////////////////////////// Erzeugung eures PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// TCPDF Library laden
require_once('../tcpdf/tcpdf.php');

// Erstellung des PDF Dokuments
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Dokumenteninformationen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pdfAuthor);
$pdf->SetTitle('Rechnung '.$rechnungs_nummer);
$pdf->SetSubject('Rechnung '.$rechnungs_nummer);


// Header und Footer Informationen
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Auswahl des Font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Auswahl der MArgins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Automatisches Autobreak der Seiten
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Image Scale 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Schriftart
$pdf->SetFont('dejavusans', '', 10);

// Neue Seite
$pdf->AddPage();

// Fügt den HTML Code in das PDF Dokument ein
$pdf->writeHTML($html, true, false, true, false, '');

//Ausgabe der PDF

//Variante 1: PDF direkt an den Benutzer senden:
$pdf->Output($pdfName, 'I');

//Variante 2: PDF im Verzeichnis abspeichern:
//$pdf->Output(dirname(__FILE__).'/'.$pdfName, 'F');
//echo 'PDF herunterladen: <a href="'.$pdfName.'">'.$pdfName.'</a>';

?>
