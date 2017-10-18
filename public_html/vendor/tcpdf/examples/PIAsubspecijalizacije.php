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
    function execute($con, $q){
    $r = mysqli_query($con, $q);
    if(!$r){
        echo mysqli_error($con);
    }else{
        $r = mysqli_fetch_row($r);
        return $r[0];
    }
}
$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('P', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
    $pdf->writeHTMLCell(9,  30, '', '', 'R.B', 1, 0, false, true, 'C', true);
    $pdf->writeHTMLCell(91, 30, '', '', 'SUBSPECIJALIZACIJE', 1, 0, false, true, 'C', false);
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
    $pdf->writeHTMLCell(30, 10, '', '', 'Ukupno na specijalizaciji', 1, 0, false, true, 'C', true);
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
    
$query = "SELECT * FROM subspecijalizacija";
$result = mysqli_query($con, $query);
$suma=0;
$counter=0;
$counters = [0, 0, 0, 0, 0, 0];
//$fill = $pdf->SetFillColor(160, 160, 160);

    $counter=0;
while($spec = mysqli_fetch_assoc($result)){

        $pdf->Cell(9, 4, $counter++, 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(91, 4, $spec["NAZIV"], 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE SUBSPEC1 = ".$spec["ID"]." AND (PODVRSTA = '0104') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[0] += $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE SUBSPEC1 = ".$spec["ID"]." AND (PODVRSTA = '0104') AND (TITULA=42 OR TITULA = 40) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[1] += $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE SUBSPEC1 = ".$spec["ID"]." AND (PODVRSTA = '0104') AND (TITULA=10 OR TITULA = 36) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[2] += $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE SUBSPEC1 = ".$spec["ID"]." AND (PODVRSTA = '0104') AND (TITULA=12 OR TITULA = 13) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[3] += $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE SUBSPEC1 = ".$spec["ID"]." AND (PODVRSTA = '0104') AND (TITULA=34 OR TITULA = 32) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[4] += $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE NASUBSPEC = ".$spec["ID"]." AND (PODVRSTA = '0105') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $counters[5] += $execute;
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, '', 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (SUBSPEC1 = ".$spec["ID"]." OR NASUBSPEC = ".$spec["ID"].")  AND (PODVRSTA = '0104' OR PODVRSTA = '0105') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        $pdf->Ln(4);  
//$query = "SELECT COUNT(*) as ukupno, "
//        . "(SELECT COUNT(*) FROM djel t2 WHERE (t2.titula=42 or t2.titula=40) AND (t2.status LIKE '01%') AND (t2.subspec1 = ".$spec["ID"]." or t2.subspec2 = ".$spec["ID"]." or t2.subspec3 = ".$spec["ID"].")) as prof, "
//        . "(SELECT COUNT(*) FROM djel t3 WHERE (t3.titula=10 or t3.titula=36) AND (t3.status LIKE '01%') AND (t3.subspec1 = ".$spec["ID"]." or t3.subspec2 = ".$spec["ID"]." or t3.subspec3 = ".$spec["ID"].")) as doc, "
//        . "(SELECT COUNT(*) FROM djel t4 WHERE (t4.titula=12 or t4.titula=13 or t4.titula=38) AND (t4.status LIKE '01%') AND (t4.subspec1 = ".$spec["ID"]." or t4.subspec2 = ".$spec["ID"]." or t4.subspec3 = ".$spec["ID"].")) as dr, "
//        . "(SELECT COUNT(*) FROM djel t5 WHERE (t5.titula=34 or t5.titula=32 or t5.titula=33 or t5.titula=39) AND (t5.status LIKE '01%') AND (t5.subspec1 = ".$spec["ID"]." or t5.subspec2 = ".$spec["ID"]." or t5.subspec3 = ".$spec["ID"].")) as mr, "
//        . "(SELECT COUNT(*) FROM djel t6 WHERE (t6.status LIKE '01%') AND (t6.nasubspec = ".$spec['ID'].")) as nasubspec "
//        . "FROM djel t1 WHERE (t1.subspec1 = ".$spec["ID"]." or t1.subspec2 = ".$spec["ID"]." or t1.subspec3 = ".$spec["ID"].") AND (t1.status LIKE '01%')";		
//		$countres = mysqli_query($con, $query);
//        while($row = mysqli_fetch_assoc($countres)){
//            $counter++;
//        $pdf->Cell(9, 4, $counter, 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(91, 4, $spec["NAZIV"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["ukupno"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["prof"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["doc"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["dr"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["mr"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["nasubspec"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, "", 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["ukupno"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Ln(4);  
//        $counters[0] += $row['ukupno'];
//        $counters[1] += $row['prof'];
//        $counters[2] += $row['doc'];
//        $counters[3] += $row['dr'];
//        $counters[4] += $row['mr'];
//        $counters[5] += $row['nasubspec'];
//            
//        }

	
}

////    $pdf->Ln(5);
//    $pdf->Cell(180, 0, '', 'T');
//$pdf->Ln(1);
//$pdf->Cell(100, 5, "Ukupno", 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(10, 5, $counters[0], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(10, 5, $counters[1], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(10, 5, $counters[2], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(10, 5, $counters[3], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(10, 5, $counters[4], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(10, 5, $counters[5], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 5, '', 'RT', 0, 'C', 0, 0, 1);
//        for($i=0; $i<6;$i++){
//        $counters[6] += $counters[$i];
//    }
//    $pdf->Cell(10, 5, $counters[0]+$counters[5], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->Cell(180, 0, '', 'T');
        $pdf->Ln(4);
        
        
        
        $pdf->Cell(9, 4, '', 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(91, 4, 'UKUPNO', 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0104') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0104') AND (TITULA=42 OR TITULA = 40) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0104') AND (TITULA=10 OR TITULA = 36) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0104') AND (TITULA=12 OR TITULA = 13) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0104') AND (TITULA=34 OR TITULA = 32) AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0105') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 4, '', 'RT', 0, 'C', 0, 0, 1);
        $q= "SELECT COUNT(*) FROM djel WHERE (PODVRSTA = '0104' OR PODVRSTA = '0105') AND STATUS LIKE '01%'";
        $execute = execute($con, $q);
        $pdf->Cell(10, 4, $execute, 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Ln(4);
//        $pdf->Cell(9, 4, '', 'L', 0, 'C', 0, 0, 1);
//        $pdf->Cell(91, 4, '', 'B', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $counters[0], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $counters[1], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $counters[2], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $counters[3], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $counters[4], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $counters[5], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, '', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, '', 'RT', 0, 'C', 0, 0, 1);
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');