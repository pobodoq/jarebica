<?php    

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 005');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$logo = "..//images/logo.gif";
$logoWidth = 55;
$title = 'POPIS DJELATNIKA';


$pdf->setHeaderFont(Array('dejavusans', '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 8);

include_once('db.php');
include_once('report_search.php');
//include_once('report_functions.php');

$date = new DateTime(date("Y-m-d"));

$pdf->SetHeaderData($logo, $logoWidth, '',  PHP_EOL . PHP_EOL. date_format($date, 'd.m.Y'));
$pdf->AddPage('L', 'A4');
$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
$pdf->SetFillColor(255, 255, 127);


$where = substr($where, '4');

$query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS, klinika.NAZIV as klnk "
        . "FROM djel "
        . "LEFT JOIN klinika "
        . "ON djel.klinika = klinika.SIFRA "
        . "LEFT JOIN nomss "
        . "ON djel.SS = nomss.ID "
        . "LEFT JOIN nomskspr "
        . "ON djel.SKSPR = nomskspr.ID "
        . "LEFT JOIN nomrm "
        . "ON djel.RM = nomrm.ID "
        . "LEFT JOIN nomzan "
        . "ON djel.ZAN = nomzan.ID "
        . "LEFT JOIN nomtit "
        . "ON djel.TITULA = nomtit.ID "
        . "WHERE ".$where." ORDER BY klnk ASC ";


$result = mysqli_query($con, $query);
$counter=0;
    
$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
$pdf->Cell(65, 5, 'ODJEL', 'LR', 0, 'C');
$pdf->Cell(55, 5, 'DJELATNIK', 'LR', 0, 'C');
$pdf->Cell(8, 5, 'SS', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(49, 5, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');

$pdf->Cell(53, 5, 'RADNO MJESTO', 'LR', 0, 'C');
//$pdf->Cell(17, 6, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(12, 5, 'STAZ(g,m,d)', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(17, 5, 'DZRO', 'LR', 0, 'C', 0, 0, 1);
$pdf->Ln(5);

while($row =  mysqli_fetch_assoc($result)){

    $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
    $counter++;
    $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(65, 5, $row["klnk"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(55, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 5, $row["SAS"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(49, 5, $row["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(53, 5, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 6, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(4, 5, $urs[2], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(4, 5, $urs[1], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(4, 5, $urs[0], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(5);    
}
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');
