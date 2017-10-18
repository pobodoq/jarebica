<?php    

require_once('tcpdf_include.php');

function execute($con, $q){
    $r = mysqli_query($con, $q);
    if(!$r){
        echo mysqli_error($con);
    }else{
        $r = mysqli_fetch_row($r);
        return $r[0];
    }
}

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 005');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$logo = "..//images/logo.gif";
$logoWidth = 55;
$title = 'KADAR SVEUČILIŠNE KLINIČKE BOLNICE MOSTAR';


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
$pdf->SetFont('dejavusans', '', 7);

include('db.php');
include_once('report_searchs.php');

$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('L', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);

//4
    $titles = ['Liječnici subspecijalisti', 'Liječnici na subspecijalizaciji', 'Liječnici specijalisti', 'Liječnici na specijalizaciji', 'Stomatolozi specijalisti', 'Liječnici opće prakse', 'VSS zdr. sur.', 'VSS med.', 'VŠS zdr. sur.', 'VŠS med.', 'SSS med.', 'UKUPNO', 'VSS', 'VŠS', 'SSS', 'VKV', 'KV', 'NK', 'NSS', 'UKUPNO', 'SVEUKUPNO'];
    $pdf->writeHTMLCell(177, 5, '', '', 'ZDRAVSTVENI DJELATNICI I SURADNICI', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(90, 5, '', '', 'ADMINISTRATIVNI I TEHNIČKI DJELATNICI', 1, 0, false, true, 'C', false);
    $pdf->Ln(5);
    $pdf->writeHTMLCell(7,  30, '', '', 'R.B', 1, 0, false, true, 'C', true);
    $pdf->writeHTMLCell(71, 30, '', '', 'OSNOVNE SPECIJALIZACIJE', 1, 0, false, true, 'C', false);
    $x=93;
    $y=62;
    for($i=0;$i<count($titles);$i++){
        $pdf->SetXY($x, $y);
        $x += 9;
        $pdf->StartTransform();
        $pdf->Rotate(90);
        $pdf->writeHTMLCell(30, 9, '', '', $titles[$i], 1, 0, false, true, 'C', false);
        $pdf->StopTransform();
    }   
    $pdf->Ln(1);    
if(isset($_GET['klinika'])){
    $query = "SELECT * FROM klinike WHERE SIFRA LIKE '".$_GET["klinika"]."%';";
//    print_r($query);
}else{
    $query = "SELECT * FROM klinike";
}
$clinicList = mysqli_query($con, $query);
$suma=0;
$counter=0;
//$fill = $pdf->SetFillColor(160, 160, 160);
    $allCounters = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
while($clinic = mysqli_fetch_assoc($clinicList)){
    $counter++;
    
    $pdf->Cell(7, 3, $counter, 'LRT', 0, 'C', 0, 0, 1);    
    $pdf->Cell(71, 3, $clinic['NAZIV'], 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta = '0104' ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta = '0105' ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta = '0102' ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta = '0103' ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta = '0202' ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta = '0101' ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta = '0601' AND SSRM = 15 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND (podvrsta LIKE '03%' OR podvrsta LIKE '04%' OR podvrsta LIKE '05%') AND SSRM = 15 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta = '0601' AND SSRM = 19 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND (podvrsta LIKE '03%' OR podvrsta LIKE '04%' OR podvrsta LIKE '05%') AND SSRM = 19 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND (podvrsta LIKE '03%' OR podvrsta LIKE '04%' OR podvrsta LIKE '05%') AND SSRM = 7 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND (podvrsta LIKE '01%' OR podvrsta LIKE '02%' OR podvrsta LIKE '03%' OR podvrsta LIKE '04%' OR podvrsta LIKE '05%' OR podvrsta LIKE '06%')";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 15 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 19 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 7 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 12 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 1 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 3 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 4 ";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."' AND podvrsta != '0601' AND vrsta = 4";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND klinika = '".$clinic['SIFRA']."'";
    $pdf->Cell(9, 3, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(3);
    
//    $count = mysqli_query($con, $sql_query); 
    
    

}
    $pdf->Cell(78, 3, 'UKUPNO', 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta = '0104'";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta = '0105'";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta = '0102'";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta = '0103'";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta = '0202'";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta = '0101'";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta = '0601' AND SSRM = 15";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND (podvrsta LIKE '03%' OR podvrsta LIKE '04%' OR podvrsta LIKE '05%') AND SSRM = 15";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta = '0601' AND SSRM = 19";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND (podvrsta LIKE '03%' OR podvrsta LIKE '04%' OR podvrsta LIKE '05%') AND SSRM = 19";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND (podvrsta LIKE '03%' OR podvrsta LIKE '04%' OR podvrsta LIKE '05%') AND SSRM = 7";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
        $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND (podvrsta LIKE '01%' OR podvrsta LIKE '02%' OR podvrsta LIKE '03%' OR podvrsta LIKE '04%' OR podvrsta LIKE '05%' OR podvrsta LIKE '06%')";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 15 ";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
        $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 19 ";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 7 ";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 12 ";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 1 ";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 3 ";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta != '0601' AND vrsta = 4 AND SSRM = 4 ";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' AND podvrsta != '0601' AND vrsta = 4";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM `djel` WHERE status LIKE '01%' ";
    $pdf->Cell(9, 3, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);

    $pdf->lastPage();
    $pdf->Output('example_005.pdf', 'I');