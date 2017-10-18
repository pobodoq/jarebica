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
$title = 'Sveučilišna klinička bolnica Mostar';
$title1 = '';


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

include('db.php');
include_once('report_searchs.php');
$pdf->SetHeaderData($logo, $logoWidth, $title, PHP_EOL . $title1);
$pdf->AddPage('L', 'A4');

$counter=0;  
$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title, "" . PHP_EOL . date_format($date, 'd.m.Y'));
$pdf->AddPage('L', 'A4');
$fill = $pdf->SetFillColor(200, 200, 200);     
$pdf->Ln(5);
$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(199, 5, 'RADNO MJESTO', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(60, 5, 'Poveznica', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Ln(5);
$pdf->Cell(8, 5, '', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(199, 5, '', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(60, 5, '', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Ln(5);
$query = "SELECT * FROM nomrm ORDER BY nomrm.INDEX";
$nomrm = mysqli_query($con, $query);        
while($row =  mysqli_fetch_assoc($nomrm)){
    $counter++;
    $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, $row["ID"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(179, 5, $row["NAZIV"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(60, 5, '', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(5);
}
$pdf->lastPage();
$pdf->Output('nomenklature-radnih-mjesta.pdf', 'I');




