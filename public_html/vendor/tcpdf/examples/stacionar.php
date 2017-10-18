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
$title = 'IZVJEŠTAJ O RADU BOLNIČKO-STACIONARNE USTANOVE';


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

    $x=15;
    $y=70;
    $pdf->SetXY($x, $y);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->cell(45, 5, 'Kanton općina', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->StopTransform();
    $x=20;
    $y=70;
    $pdf->SetXY($x, $y);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->cell(30, 5, 'Naziv', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->StopTransform();
    $x=35;
    $y=70;

    $x=20;
    $y=25;
    $pdf->SetXY($x, $y);
    $pdf->cell(85, 15, 'Zdravstvena ustanova', 'RTBL', 0, 'C', 0, 0, 1);
    $x=25;
    $y=40;
    $pdf->SetXY($x, $y);
    $pdf->cell(80, 30, 'odjeljenje', 'RTBL', 0, 'C', 0, 0, 1);
    $x=105;
    $y=25;
    $pdf->SetXY($x, $y);
    $pdf->cell(72, 5, 'Zdravstveni radnici', 'RTBL', 0, 'C', 0, 0, 1);
    $x=105;
    $y=30;
    $pdf->SetXY($x, $y);
    $pdf->cell(45, 5, 'Doktori medicine', 'RTBL', 0, 'C', 0, 0, 1);
    $x=150;
    $y=30;
    $pdf->SetXY($x, $y);
    $pdf->cell(27, 5, 'Ostali', 'RTBL', 0, 'C', 0, 0, 1);
    $x=177;
    $y=25;
    $pdf->SetXY($x, $y);
    $pdf->cell(18, 15, 'Zdravstveni suradnici', 'RTBL', 0, 'C', 0, 0, 1);
    

    $titles = ['Svega', 'Specijalist', 'Sekundarci', 'Specijalizanti', 'Stažeri', 'Svega', 'Viša stručna sprema', 'Srednja stručna sprema', 'Svega', 'Od toga sa visokom stručnom spremom'];
//    $pdf->writeHTMLCell(177, 5, '', '', 'ZDRAVSTVENI DJELATNICI I SURADNICI', 1, 0, false, true, 'C', false);
//    $pdf->writeHTMLCell(90, 5, '', '', 'ADMINISTRATIVNI I TEHNIČKI DJELATNICI', 1, 0, false, true, 'C', false);
    $pdf->Ln(5);
//    $pdf->writeHTMLCell(7,  30, '', '', 'R.B', 1, 0, false, true, 'C', true);
//    $pdf->writeHTMLCell(71, 30, '', '', 'OSNOVNE SPECIJALIZACIJE', 1, 0, false, true, 'C', false);
    $x=105;
    $y=70;
    for($i=0;$i<count($titles);$i++){
        $pdf->SetXY($x, $y);
        $x += 9;
        $pdf->StartTransform();
        $pdf->Rotate(90);
        if($i===0 || $i===5){
            $pdf->writeHTMLCell(35, 9, '', '', $titles[$i], 1, 0, false, true, 'C', false);
        }else{
            $pdf->writeHTMLCell(30, 9, '', '', $titles[$i], 1, 0, false, true, 'C', false);            
        }
        $pdf->StopTransform();
    } 
    $pdf->Ln(0);
    
     $x=114;
    $y=35;
    $pdf->SetXY($x, $y);
     $pdf->cell(36, 5, 'Od toga', 'RTBL', 0, 'C', 0, 0, 1);
     $x=159;
    $y=35;
    $pdf->SetXY($x, $y);
     $pdf->cell(18, 5, 'Od toga', 'RTBL', 0, 'C', 0, 0, 1);
    
    $q = "SELECT * FROM djel WHERE (KLINIKA = 0001 OR KLINIKA = 0002 OR KLINIKA = 0003 OR KLINIKA = 0005 OR KLINIKA = 0006 OR KLINIKA = 0007 OR KLINIKA = 0008 OR KLINIKA = 0009 OR KLINIKA = 0010 OR KLINIKA = 0011 OR KLINIKA = 0014 OR KLINIKA = 0015 OR KLINIKA = 0016 OR KLINIKA = 0017 OR KLINIKA = 0018 "
            . "LEFT JOIN klinike "
            . "ON klinike.SIFRA = djel.KLINIKA "
            . "(SELECT)";
    $arrays = ['0001', '0002', '0003', '0004', '0005', '0006', '0007', '0008', '0009', '0010', '0011', '0014', '0015', '0016', '0017', '0018'];
    
    
    $x=25;
    $y=65;
    for($i=0;$i<count($arrays);$i++){
        $y+=5;
        $pdf->SetXY($x, $y);
        $q = "SELECT * FROM klinike WHERE SIFRA = ".$arrays[$i]." ";
//        echo $q;
        $r = mysqli_query($con, $q);
        if(!$r){
            echo mysqli_error($con);
        }
        $row = mysqli_fetch_assoc($r);
        $pdf->cell(80, 5, $row["NAZIV"], 'RTBL', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);
    }
    
    $x=114;
    $y=65;
    for($i=0;$i<count($arrays);$i++){
        $y+=5;
        $pdf->SetXY($x, $y);
//        $q = "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND SPEC1 IS NOT NULL AND KLINIKA = ".$arrays[$i]." ";
        $q = "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND (PODVRSTA = '0102' OR PODVRSTA = '0104' OR PODVRSTA = '0105') AND KLINIKA = ".$arrays[$i]." ";
        $r = mysqli_query($con, $q);
        if(!$r){
            echo mysqli_error($con);
        }
        $row = mysqli_fetch_row($r);
        $pdf->cell(9, 5, $row[0], 'RTBL', 0, 'C', 0, 0, 1);
        $x+=9;
        $pdf->SetXY($x, $y);
//        $q= "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$arrays[$i]." AND status LIKE '01%' AND VRSTA = 1 AND (RM=122 OR RM=290 OR RM=524) ";
        $q= "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$arrays[$i]." AND status LIKE '01%' AND VRSTA = 1 AND PODVRSTA = '0101' ";
        $r = mysqli_query($con, $q);
        if(!$r){
            echo mysqli_error($con);
        }
        $row = mysqli_fetch_row($r);
        $pdf->cell(9, 5, $row[0], 'RTBL', 0, 'C', 0, 0, 1);
        $x+=9;
        $pdf->SetXY($x, $y);
//        $q = "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND SPEC1 IS NULL AND NASPEC IS NOT NULL AND KLINIKA = ".$arrays[$i]." ";
        $q= "SELECT COUNT(*) FROM djel WHERE KLINIKA = ".$arrays[$i]." AND status LIKE '01%' AND VRSTA = 1 AND PODVRSTA = '0103' AND KLINIKA = ".$arrays[$i]."";
        $r = mysqli_query($con, $q);
        if(!$r){
            echo mysqli_error($con);
        }
        $row = mysqli_fetch_row($r);
        $pdf->cell(9, 5, $row[0], 'RTBL', 0, 'C', 0, 0, 1);
        $x-=27;
        $pdf->SetXY($x, $y);
//        $q = "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND (SPEC1 IS NOT NULL OR NASPEC IS NOT NULL OR (RM=122 OR RM=290 OR RM=524)) AND KLINIKA = ".$arrays[$i]." ";
        $q = "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA LIKE '01%' AND KLINIKA = ".$arrays[$i]." ";
        $r = mysqli_query($con, $q);
        if(!$r){
            echo mysqli_error($con);
        }
        $row = mysqli_fetch_row($r);
        $pdf->cell(9, 5, $row[0], 'RTBL', 0, 'C', 0, 0, 1);
//        t2.RM=122 OR t2.RM=290 OR t2.RM=524 doturi medicine
        
        $pdf->cell(9, 5, '', 'RTBL', 0, 'C', 0, 0, 1);
        $x+=9;
        $pdf->Ln(5);
    }
    $x=141;
    $y=70;
    for($i=0;$i<count($arrays);$i++){
        $pdf->SetXY($x, $y);
        $y+=5;
        $pdf->cell(9, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);
    }
    $x=159;
    $y=65;
    $pdf->SetXY($x, $y);
    for($i=0;$i<count($arrays);$i++){
        $y+=5;
        $pdf->SetXY($x, $y);
        $q = "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA = 1 AND PODVRSTA NOT LIKE '01%' AND PODVRSTA NOT LIKE '02%' AND SSRM = 19 AND KLINIKA = ".$arrays[$i]." ";
        $r = mysqli_query($con, $q);
        if(!$r){
            echo mysqli_error($con);
        }
        $row = mysqli_fetch_row($r);
        $pdf->cell(9, 5, $row[0], 'RTBL', 0, 'C', 0, 0, 1);
        $x+=9;
        $pdf->SetXY($x, $y);
        $q = "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA = 1 AND PODVRSTA NOT LIKE '01%' AND PODVRSTA NOT LIKE '02%' AND SSRM = 7 AND KLINIKA = ".$arrays[$i]." ";
        $r = mysqli_query($con, $q);
        if(!$r){
            echo mysqli_error($con);
        }
        $row = mysqli_fetch_row($r);
        $pdf->cell(9, 5, $row[0], 'RTBL', 0, 'C', 0, 0, 1);
        $x-=18;
        $pdf->SetXY($x, $y);
        $q = "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA = 1 AND PODVRSTA NOT LIKE '01%' AND PODVRSTA NOT LIKE '02%' AND KLINIKA = ".$arrays[$i]." ";
        $r = mysqli_query($con, $q);
        if(!$r){
            echo mysqli_error($con);
        }
        $row = mysqli_fetch_row($r);
        $pdf->cell(9, 5, $row[0], 'RTBL', 0, 'C', 0, 0, 1);
        $x+=9;
        $pdf->Ln(5);
    }
    $x=177;
    $y=70;
    for($i=0;$i<count($arrays);$i++){
        $pdf->SetXY($x, $y);
        $y+=5;
        $pdf->cell(9, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);
    }
    $x=186;
    $y=70;
    for($i=0;$i<count($arrays);$i++){
        $pdf->SetXY($x, $y);
        $y+=5;
        $pdf->cell(9, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);
    }
    $x=15;
    $y=150;
    $pdf->SetXY($x, $y);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->cell(80, 5, 'Hercegovačko-Neretvanska županija/kanton', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->StopTransform();
    $x=20;
    $y=150;
    $pdf->SetXY($x, $y);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->cell(80, 5, 'SVEUČILIŠNA KLINIČKA BOLNICA MOSTAR', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->StopTransform();    

$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');
