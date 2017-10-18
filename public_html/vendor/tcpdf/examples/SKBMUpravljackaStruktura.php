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
$upravljacka_struktura = ['Ravnatelj'=>['Pomoćnik ravnatelja za kirurške djelatnosti', 'Pomoćnik ravnatelja za internističke djelatnosti', 'Pomoćnik ravnatelja za pravne, kadrovske i opće poslove', 'Pomoćnik ravnatelja za gospodarsko – financijske poslove', 'Pomoćnik ravnatelja za tehničke poslove', 'Pomoćnik ravnatelja za nastavu i znanstveno istraživački rad', 'Glavna sestra SKB Mostar', 'Savjetnici ravnatelja'], 'Klinike'=>['Predstojnik klinike', 'Zamjenik predstojnika klinike', 'Glavna sestra/tehničar Klinike', 'Voditelj kliničkog odjela', 'Voditelj kliničkog odsjeka', 'Voditelj centra', 'Voditelj radne jedinice', 'Voditelj dnevne bolnice'], 'KZavodi'=>['-	Predstojnik kliničkog zavoda', 'Glavna sestra/tehničar Kliničkog zavoda', 'Voditelj kliničkog odjela', 'Voditelj kliničkog odsjeka'], 'Odjeli'=>['Pročelnik odjela', 'Glavna sestra/tehničar odjela', 'Voditelj odsjeka', 'Voditelj radne jedinice', 'Voditelj dnevne bolnice'], 'Zavodi'=>['Pročelnik zavoda', 'Glavna sestra/ tehničar zavoda', 'Voditelj odsjeka', 'Voditelj radne jedinice'], 'Centri'=>['Pročelnik/voditelj centra', 'Glavna sestra/tehničar centra', 'Voditelj odsjeka'], 'Sluzbe'=>['Voditelj službe', 'Voditelj odsjeka', 'Voditelj radne jedinice'], 'Uredi'=>['Voditelj Ureda'], 'Jedinice'=>['Voditelj radne jedinice']];

$pdf->writeHTMLCell(50, 10, '', '', 'Ravnatelj', 1, 0, false, true, 'C', false);
$pdf->Ln(10);
foreach($upravljacka_struktura['Ravnatelj'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   
$pdf->writeHTMLCell(50, 10, '', '', 'Klinike u SKB Mostar', 1, 0, false, true, 'C', false);
$pdf->Ln(10);
foreach($upravljacka_struktura['Klinike'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   
$pdf->writeHTMLCell(50, 10, '', '', 'Klinički zavodi u SKB Mostar', 1, 0, false, true, 'C', false);
$pdf->Ln(10);
foreach($upravljacka_struktura['KZavodi'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   
$pdf->writeHTMLCell(50, 10, '', '', 'Odjeli u SKB Mostar', 1, 0, false, true, 'C', false);
$pdf->Ln(10);
foreach($upravljacka_struktura['Odjeli'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   
$pdf->writeHTMLCell(50, 10, '', '', 'Zavodi u SKB Mostar', 1, 0, false, true, 'C', false);
$pdf->Ln(10);
foreach($upravljacka_struktura['Zavodi'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   
$pdf->writeHTMLCell(50, 10, '', '', 'Centri u SKB Mostar', 1, 0, false, true, 'C', false);
//$pdf->Ln(25);
foreach($upravljacka_struktura['Centri'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   
$pdf->writeHTMLCell(50, 10, '', '', 'Službe u SKB Mostar', 1, 0, false, true, 'C', false);
$pdf->Ln(10);
foreach($upravljacka_struktura['Sluzbe'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   
$pdf->writeHTMLCell(50, 10, '', '', 'Uredi u SKB Mostar', 1, 0, false, true, 'C', false);
$pdf->Ln(10);
foreach($upravljacka_struktura['Uredi'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   
$pdf->writeHTMLCell(50, 10, '', '', 'Jedinice u SKB Mostar', 1, 0, false, true, 'C', false);
$pdf->Ln(10);
foreach($upravljacka_struktura['Jedinice'] as $x => $x_value) {
    $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
    $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//    $pdf->Cell(10, 5, '', '', 0, 'C', '', 0, 0, 1);
//    $pdf->writeHTMLCell(50, 10, '', '', '', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(10, 10, '', '', '', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(50, 10, '', '', $x_value, 1, 0, false, true, 'C', false);
    $pdf->Ln(15);
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
}   

//while($clinic = mysqli_fetch_assoc($clinicList)){
//    $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.klinika LIKE '".$clinic['SIFRA']."%' OR djel.odjel LIKE '".$clinic['SIFRA']."%' OR djel.odsjek LIKE '".$clinic['SIFRA']."%') ".$where." ";
//    $checkNulls = mysqli_query($con, $query);
//    $checkNulls = mysqli_fetch_assoc($checkNulls);
//    $fill = $pdf->SetFillColor(160, 160, 160);
////    $pdf->Cell(180, 5, $clinic['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//    $pdf->writeHTMLCell(50, 15, '', '', $clinic['NAZIV'], 1, 0, false, true, 'C', false);
//    $pdf->Ln(15);
//
//    $query = "SELECT * FROM odjeli WHERE SIFRA LIKE '".$clinic['SIFRA']."%' ORDER BY SIFRA ";
//    $divisionList = mysqli_query($con, $query);
//    while($division = mysqli_fetch_assoc($divisionList)){
//        $fill = $pdf->SetFillColor(200, 200, 200);
//        $pdf->Cell(25, 20, '', 'R', 0, 'C', '', 0, 0, 1);
//        $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//        $pdf->writeHTMLCell(50, 15, '', '', $division['NAZIV'], 1, 0, false, true, 'C', false);
//        $pdf->Ln(15);
//        $pdf->Cell(85, 5, '', 'R', 0, 'C', '', 0, 0, 1);
//        $pdf->Ln(5);
////        $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//        
////        $pdf->Cell(180, 5, $division['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
////        $pdf->Ln(5);
//
//        $query = "SELECT * FROM odsjeci WHERE SIFRA LIKE '".$division['SIFRA']."%' ORDER BY SIFRA ";
//        $sectionList = mysqli_query($con, $query);
//        while($section = mysqli_fetch_assoc($sectionList)){
//            $fill = $pdf->SetFillColor(250, 250, 250);
////            $pdf->Cell(180, 5, $section['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//        $pdf->Cell(25, 15, '', 'R', 0, 'C', '', 0, 0, 1);
//        $pdf->Cell(60, 15, '', 'R', 0, 'C', '', 0, 0, 1);
//        $pdf->Cell(35, 5, '_________________________', '', 0, 'C', '', 0, 0, 1);
//        $pdf->writeHTMLCell(50, 15, '', '', $section['NAZIV'], 1, 0, false, true, 'C', false);
//            $pdf->Ln(15);        
//        }    
//    }        
//}
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');