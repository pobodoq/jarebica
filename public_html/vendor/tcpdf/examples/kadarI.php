<?php    
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 005');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$logo = "..//images/logo.gif";
$logoWidth = 50;
$title = '';


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
// set font
$pdf->SetFont('dejavusans', '', 8);

include('db.php');
include_once('report_search.php');

$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('P', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);

function execute($q, $con){
    $r = mysqli_query($con, $q);
    if(!$r){
        echo mysqli_error($con);
    }
    $row = mysqli_fetch_row($r);
    return $row[0];
}
//   $pdf->cell(20, 5, 'R.B.', 'RTBL', 0, 'C', 0, 0, 1);
   $pdf->cell(70, 5, '', 'LTR', 0, 'C', 0, 0, 1);
   $pdf->cell(20, 5, 'Doktori', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(20, 5, 'Doktori', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(20, 5, 'Diplomirani', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(20, 5, 'Zdravstveni', 'TR', 0, 'C', 0, 0, 1);
   $returnX = $pdf->GetX();
   $returnY = $pdf->GetY();
   $x = 165;
   $y = 47;
    $pdf->SetXY($x, $y);
    $pdf->StartTransform();
    $pdf->Rotate(90);
   $pdf->cell(20, 5, 'Uprava i  ', 'R', 0, 'C', 0, 0, 1);
   $y+=5;
   $pdf->SetXY($x, $y);
   $pdf->cell(20, 5, ' administracija', 'R', 0, 'C', 0, 0, 1);
    $pdf->StopTransform();  
   $x = 175;
   $y = 47;
    $pdf->SetXY($x, $y);
    $pdf->StartTransform();
    $pdf->Rotate(90);
   $pdf->cell(20, 5, 'Administrativni ', 'R', 0, 'C', 0, 0, 1);
   $y+=5;
   $pdf->SetXY($x, $y);
   $pdf->cell(20, 5, ' tehničari', 'R', 0, 'C', 0, 0, 1);
    $pdf->StopTransform();  
   $x = 185;
   $y = 47;
    $pdf->SetXY($x, $y);
        $pdf->StartTransform();
    $pdf->Rotate(90);
   $pdf->cell(20, 10, 'ukupno', 'TRBL', 0, 'C', 0, 0, 1);
       $pdf->StopTransform();  
    $pdf->SetXY($returnX+20, $returnY);
   $pdf->Ln(5);
   $pdf->cell(70, 5, '', 'LR', 0, 'C', 0, 0, 1);
   $pdf->cell(20, 5, ' medicine', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(20, 5, 'stomatologije', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(20, 5, 'farmaceuti', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(20, 5, ' tehničari', 'BR', 0, 'C', 0, 0, 1);
  $pdf->cell(10, 5, '', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, '', 'R', 0, 'C', 0, 0, 1);
   $pdf->Ln(5);
   $pdf->cell(70, 5, 'KLINIKA', 'LR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'Svega', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'Od', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'Svega', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'Od', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'Svega', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'Od', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'Svega', 'TR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'Od', 'TR', 0, 'C', 0, 0, 1);
   $pdf->Ln(5);
      $pdf->cell(70, 5, '', 'LR', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, '', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'toga spec', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, '', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'toga spec', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, '', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'toga spec', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, '', 'R', 0, 'C', 0, 0, 1);
   $pdf->cell(10, 5, 'toga VŠS', 'R', 0, 'C', 0, 0, 1);
   
   $pdf->Ln(5);
$q = "SELECT * FROM klinike ORDER BY SIFRA";
$r = mysqli_query($con, $q);
$zdr_teh=0;
$ukupno=0;
$all_count=0;
$by_column = [0, 0, 0, 0, 0, 0, 0, 0, 0];
while($klinika = mysqli_fetch_assoc($r)){
    $row_count=0;
    //doktori medicine
    $pdf->cell(70, 5, $klinika['NAZIV'], 'RTBL', 0, 'C', 0, 0, 1);
//    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (NASPEC IS NOT NULL OR (RM=122 OR RM=290 OR RM=524) OR (SPEC1 IS NOT NULL AND SPEC1!=38)) AND RM!=659";
    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '01%' ";
    $doc_med=execute($q, $con);
    $pdf->cell(10, 5, $doc_med, 'RTBL', 0, 'C', 0, 0, 1);
    //specijalisti
//    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND SPEC1 IS NOT NULL AND SPEC1!=38 ";
    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA = '0102' OR PODVRSTA = '0104' OR PODVRSTA = '0105') ";
    $specs = execute($q, $con);
    $pdf->cell(10, 5, $specs, 'RTBL', 0, 'C', 0, 0, 1);
    //doktori stomatologije unesi ručno

//    $q= "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND SPEC1=38";
    $q= "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '02%'";
    $stom = execute($q, $con);
    $pdf->cell(10, 5, $stom, 'RTBL', 0, 'C', 0, 0, 1);
    $q= "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0202'";
    $stom_spec = execute($q, $con);
    $pdf->cell(10, 5, $stom_spec, 'RTBL', 0, 'C', 0, 0, 1);
    
    
    //diplomirani farmaceuti
//    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (RM = 212 OR RM = 128 OR RM = 628 OR RM=659) AND VRSTA=1";
    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '03%' ";
    $dipl_farm = execute($q, $con);
    $pdf->cell(10, 5, $dipl_farm, 'RTBL', 0, 'C', 0, 0, 1);    
    // od toga specijalista
//    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND SPEC1=47";
    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0303'";
    $farm_spec = execute($q, $con);
    $pdf->cell(10, 5, $farm_spec, 'RTBL', 0, 'C', 0, 0, 1);
    
    
    //zdravstveni tehničari
//    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND SPEC1 IS NULL AND (RM != 212 AND RM != 128 AND RM != 628 AND RM!=122 AND RM!=290 AND RM!=524) AND NASPEC IS NULL ";
    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%' OR PODVRSTA LIKE '06%') ";
    $zdr_teh = execute($q, $con);
    $pdf->cell(10, 5, $zdr_teh, 'RTBL', 0, 'C', 0, 0, 1);
//    $zdr_teh += $res;
    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM = 19 ";
   $zdr_teh_vss = execute($q, $con);
    $pdf->cell(10, 5, $zdr_teh_vss, 'RTBL', 0, 'C', 0, 0, 1);
    
    $q = "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 4 AND (SSRM = 15 OR SSRM = 19 OR SSRM = 7) ";
    $adm = execute($q, $con);
    $pdf->cell(10, 5, $adm, 'RTBL', 0, 'C', 0, 0, 1);
    
    $q = "SELECT COUNT(*) FROM djel WHERE  KLINIKA = ".$klinika['SIFRA']." AND ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 4 AND (SSRM = 1 OR SSRM =3 OR SSRM = 4 OR SSRM = 12) ";
    $tehn = execute($q, $con);
    $pdf->cell(10, 5, $tehn, 'RTBL', 0, 'C', 0, 0, 1);

    $row_count = $doc_med + $dipl_farm + $zdr_teh + $tehn + $stom +$adm;
    $pdf->cell(10, 5, $row_count, 'RTBL', 0, 'C', 0, 0, 1);
    $all_count += $row_count;
    $pdf->Ln(5);
    
    $by_column[0] +=$doc_med;
    $by_column[1] +=$specs;
    $by_column[4] +=$dipl_farm;
    $by_column[5] +=$farm_spec;
    $by_column[6] +=$zdr_teh;
    $by_column[7] +=$zdr_teh_vss;
    $by_column[8] +=$tehn;
    $by_column[2] +=$stom;
    $by_column[3] +=$stom_spec;
    $by_column[9] +=$adm;
    
    
}
//$by_column[0] -= 2;
$pdf->cell(70, 5, 'UKUPNO', 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[0], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[1], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[2], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[3], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[4], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[5], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[6], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[7], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[9], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $by_column[8], 'RTBL', 0, 'C', 0, 0, 1);
$pdf->cell(10, 5, $all_count, 'RTBL', 0, 'C', 0, 0, 1);

$pdf->Ln(10);
$pdf->Cell(90, 5, '');
$pdf->Cell(90, 5, 'M.P.  Potpis ovlaštene osobe:______________________________');


















$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');
