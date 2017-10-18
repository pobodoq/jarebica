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
$title1 = 'ORGANIZACIJSKA STRUKTURA SVEUČILIŠNE ';
$title2 = 'KLINIČKE BOLNICE MOSTAR';
//$title = 'ORGANIZACIJSKA STRUKTURA SVEUČILIŠNE '.EOF.' KLINIČKE BOLNICE MOSTAR';


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

$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, '', $title1 . PHP_EOL . $title2);
$pdf->AddPage('P', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
//$pdf->Cell(50, 5, 'KLINIKA', 'TLR', 0, 'C');
//$pdf->Cell(10, 5, '', '', 0, 'C');
//$pdf->Cell(50, 5, 'ODJEL', 'TLR', 0, 'C');
//$pdf->Cell(10, 5, '', '', 0, 'C', 0, 0, 1); 
//$pdf->Cell(50, 5, 'ODSJEK', 'TLR', 0, 'C', 0, 0, 1); 
//$pdf->Cell(10, 5, '', '', 0, 'C', 0, 0, 1); 
//$pdf->Ln(5);
    
if(isset($_GET['klinika'])){
    $query = "SELECT * FROM klinike WHERE SIFRA LIKE '".$_GET["klinika"]."%' ORDER BY SIFRA;";
//    print_r($query);
}else{
    $query = "SELECT * FROM klinike";
}
$clinicList = mysqli_query($con, $query);
$suma=0;
$counter=0;
//$fill = $pdf->SetFillColor(160, 160, 160);
    
while($clinic = mysqli_fetch_assoc($clinicList)){
    $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.klinika LIKE '".$clinic['SIFRA']."%' OR djel.odjel LIKE '".$clinic['SIFRA']."%' OR djel.odsjek LIKE '".$clinic['SIFRA']."%') ".$where." ";
    $checkNulls = mysqli_query($con, $query);
    $checkNulls = mysqli_fetch_assoc($checkNulls);
    $fill = $pdf->SetFillColor(160, 160, 160);
//    $pdf->Cell(180, 5, $clinic['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
    $pdf->writeHTMLCell(50, 15, '', '', $clinic['NAZIV'], 1, 0, false, true, 'C', false);
    $pdf->Ln(15);

    $query = "SELECT * FROM odjeli WHERE SIFRA LIKE '".$clinic['SIFRA']."%' ORDER BY SIFRA ";
    $divisionList = mysqli_query($con, $query);
    while($division = mysqli_fetch_assoc($divisionList)){
        $fill = $pdf->SetFillColor(200, 200, 200);
        $pdf->Cell(25, 20, '', 'R', 0, 'C', '', 0, 0, 1);
        $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
        $pdf->writeHTMLCell(50, 15, '', '', $division['NAZIV'], 1, 0, false, true, 'C', false);
        $pdf->Ln(15);
        $pdf->Cell(85, 5, '', 'R', 0, 'C', '', 0, 0, 1);
        $pdf->Ln(5);
//        $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
        
//        $pdf->Cell(180, 5, $division['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//        $pdf->Ln(5);

        $query = "SELECT * FROM odsjeci WHERE SIFRA LIKE '".$division['SIFRA']."%' ORDER BY SIFRA ";
        $sectionList = mysqli_query($con, $query);
        while($section = mysqli_fetch_assoc($sectionList)){
            $fill = $pdf->SetFillColor(250, 250, 250);
//            $pdf->Cell(180, 5, $section['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
        $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
        $pdf->Cell(60, 15, '', 'R', 0, 'C', '', 0, 0, 1);
        $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
        $pdf->writeHTMLCell(50, 15, '', '', $section['NAZIV'], 1, 0, false, true, 'C', false);
            $pdf->Ln(15);        
        }    
    }        
}
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');