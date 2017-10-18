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
$title = 'LIJEČNICI PO GRANAMA SPECIJALNOSTI';


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
include_once('report_search.php');

$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('P', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
//$pdf->StartTransform();
//$pdf->Rotate(-90);
//$pdf->Cell(0,0,'This is a sample data',1,1,'L',0,'');
//$pdf->StopTransform();
    $pdf->writeHTMLCell(9,  30, '', '', 'R.B', 1, 0, false, true, 'C', true);
    $pdf->writeHTMLCell(91, 30, '', '', 'OSNOVNE SPECIJALIZACIJE', 1, 0, false, true, 'C', false);
    $pdf->SetXY(115, 57);
    $pdf->StartTransform();
    $pdf->Rotate(90);
        $pdf->writeHTMLCell(30, 10, '', '', 'Ukupno specijalista', 1, 0, false, true, 'C', true);
    $pdf->StopTransform();
    $pdf->SetXY(125, 27);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
        $pdf->writeHTMLCell(40, 5, '', '', 'Specijalisti od toga', 1, 0, false, true, 'C', true);
//    $pdf->StopTransform();
    $pdf->SetXY(125, 57);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->writeHTMLCell(25, 10, '', '', 'Prof.dr.sc', 1, 0, false, true, 'C', true);
     $pdf->StopTransform();
    $pdf->SetXY(135, 57);
    $pdf->StartTransform();
    $pdf->Rotate(90);
        $pdf->writeHTMLCell(25, 10, '', '', 'Doc.dr.sc', 1, 0, false, true, 'C', true);
     $pdf->StopTransform();
         $pdf->SetXY(145, 57);
    $pdf->StartTransform();
    $pdf->Rotate(90);
        $pdf->writeHTMLCell(25, 10, '', '', 'dr.sc', 1, 0, false, true, 'C', true);
     $pdf->StopTransform();
         $pdf->SetXY(155, 57);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->writeHTMLCell(25, 10, '', '', 'mr.sc', 1, 0, false, true, 'C', false);
     $pdf->StopTransform();
     
     

     
     $pdf->SetXY(165, 57);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->writeHTMLCell(30, 10, '', '', 'Na specijalizaciji', 1, 0, false, true, 'C', true);
     $pdf->StopTransform();
     
               $pdf->SetXY(175, 37);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->writeHTMLCell(10, 10, '', '', 'od toga', 1, 0, false, true, 'C', true);
     $pdf->StopTransform();
     
     
         $pdf->SetXY(175, 57);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->writeHTMLCell(20, 10, '', '', 'Na specijalizaciji', 1, 0, false, true, 'C', true);
     $pdf->StopTransform();
         $pdf->SetXY(185, 57);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->writeHTMLCell(30, 10, '', '', 'UKUPNO', 1, 0, false, true, 'C', true);
     $pdf->StopTransform();       
    $pdf->Ln(1);
//$pdf->Cell(9, 5, 'R.B.', 'LR', 0, 'C');
//$pdf->Cell(51, 5, 'osnovne specijalizacije', 'LR', 0, 'C');
//$pdf->Cell(15, 5, 'ukupno spec', 'LR', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'prof ', 'LR', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'doc ', 'LR', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'dr ', 'LR', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'mr ', 'LR', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'na spec', 'LR', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'sveukupno ', 'LR', 0, 'C', 0, 0, 1); 
//$pdf->Ln(5);
    function execute($con, $q){
    $r = mysqli_query($con, $q);
    if(!$r){
        echo mysqli_error($con);
    }else{
        $r = mysqli_fetch_row($r);
        return $r[0];
    }
}
$query = "SELECT * FROM specijalizacija ORDER BY NAZIV";
$result = mysqli_query($con, $query);
$suma=0;
$counter=0;
$counters = [0, 0, 0, 0, 0, 0, 0];


while($spec = mysqli_fetch_assoc($result)){

    $counter++;
        $pdf->Cell(9, 4, $counter, 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(91, 4, $spec["NAZIV"], 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (SPEC1 = ".$spec["ID"]." OR SPEC2 = ".$spec["ID"].") AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%') AND STATUS LIKE '01%' ";
        $execute = execute($con, $q);
        $counters[0]+= $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (SPEC1 = ".$spec["ID"]." OR SPEC2 = ".$spec["ID"].") AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%') AND (TITULA=42 OR TITULA = 40) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[1]+= $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (SPEC1 = ".$spec["ID"]." OR SPEC2 = ".$spec["ID"].") AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%') AND (TITULA=10 OR TITULA = 36) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[2]+= $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (SPEC1 = ".$spec["ID"]." OR SPEC2 = ".$spec["ID"].") AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%') AND (TITULA=12 OR TITULA = 13) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[3]+= $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (SPEC1 = ".$spec["ID"]." OR SPEC2 = ".$spec["ID"].") AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%') AND (TITULA=34 OR TITULA = 32) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[4]+= $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (NASPEC = ".$spec["ID"]." AND SPEC1 IS NULL) AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[5]+= $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $pdf->Cell(10, 4, '', 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (SPEC1 = ".$spec["ID"]." OR SPEC2 = ".$spec["ID"]." OR NASPEC = ".$spec["ID"].")  AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[6]+= $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);

        $pdf->Ln(4);

}

        $pdf->Ln(4);
        
        
        
        
        $pdf->Cell(9, 4, '', 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(91, 4, 'UKUPNO SPECIJALIZACIJA', 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, $counters[0], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, $counters[1], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, $counters[2], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, $counters[3], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, $counters[4], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, $counters[5], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, '', 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, $counters[6], 'RT', 0, 'C', 0, 0, 1);
        
        $pdf->Ln(4);
        
        $pdf->Cell(9, 4, '', 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(91, 4, 'UKUPNO SPECIJALISTA', 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0102' OR PODVRSTA = '0104' OR PODVRSTA = '0105' OR PODVRSTA = '0303' OR PODVRSTA = '0202') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0102' OR PODVRSTA = '0104' OR PODVRSTA = '0105' OR PODVRSTA = '0303' OR PODVRSTA ='0304') AND (TITULA=42 OR TITULA = 40) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0102' OR PODVRSTA = '0104' OR PODVRSTA = '0105' OR PODVRSTA = '0303' OR PODVRSTA ='0304') AND (TITULA=10 OR TITULA = 36) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0102' OR PODVRSTA = '0104' OR PODVRSTA = '0105' OR PODVRSTA = '0303' OR PODVRSTA ='0304') AND (TITULA=12 OR TITULA = 13) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0102' OR PODVRSTA = '0104' OR PODVRSTA = '0105' OR PODVRSTA = '0303' OR PODVRSTA ='0304') AND (TITULA=34 OR TITULA = 32) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0103' OR PODVRSTA = '0203' OR PODVRSTA = '0304') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, '', 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0102' OR PODVRSTA = '0103' OR PODVRSTA = '0104' OR PODVRSTA = '0105' OR PODVRSTA = '0303' OR PODVRSTA = '0304' OR PODVRSTA = '0202' OR PODVRSTA = '0203') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');
