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
$pdf->SetHeaderData($logo, $logoWidth, $title, "                            NA DAN " . PHP_EOL . "                         " .date_format($date, 'd.m.Y'));
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
        $pdf->writeHTMLCell(25, 10, '', '', 'Ukupno specijalista', 1, 0, false, true, 'C', true);
    $pdf->StopTransform();
    $pdf->SetXY(115, 27);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
        $pdf->writeHTMLCell(50, 5, '', '', 'Specijalisti od toga', 1, 0, false, true, 'C', true);
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
    $pdf->Ln(5);
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
    
$query = "SELECT * FROM specijalizacija";
$result = mysqli_query($con, $query);
$suma=0;
$counter=0;
$counters = [0, 0, 0, 0, 0, 0, 0];
//$ukupno=0;
//$profs=0;
//$docs=0;
//$drs=0;
//$mrs=0;
//$specs=0;
//$fill = $pdf->SetFillColor(160, 160, 160);

while($spec = mysqli_fetch_assoc($result)){
$query = "SELECT COUNT(*) as ukupno, "
        . "(SELECT COUNT(*) FROM djel t2 WHERE (t2.titula=42) AND (t2.status LIKE '01%') AND (t2.spec1 = ".$spec["ID"]." or t2.spec2 = ".$spec["ID"]." or t2.spec3 = ".$spec["ID"].")) as prof, "
        . "(SELECT COUNT(*) FROM djel t3 WHERE (t3.titula=10) AND (t3.status LIKE '01%') AND (t3.spec1 = ".$spec["ID"]." or t3.spec2 = ".$spec["ID"]." or t3.spec3 = ".$spec["ID"].")) as doc, "
        . "(SELECT COUNT(*) FROM djel t4 WHERE (t4.titula=12) AND (t4.status LIKE '01%') AND (t4.spec1 = ".$spec["ID"]." or t4.spec2 = ".$spec["ID"]." or t4.spec3 = ".$spec["ID"].")) as dr, "
        . "(SELECT COUNT(*) FROM djel t5 WHERE (t5.titula=34) AND (t5.status LIKE '01%') AND (t5.spec1 = ".$spec["ID"]." or t5.spec2 = ".$spec["ID"]." or t5.spec3 = ".$spec["ID"].")) as mr, "
        . "(SELECT COUNT(*) FROM djel t6 WHERE (t6.status LIKE '01%') AND (t6.naspec = ".$spec['ID'].")) as naspec "
        . "FROM djel t1 WHERE (t1.spec1 = ".$spec["ID"]." or t1.spec2 = ".$spec["ID"]." or t1.spec3 = ".$spec["ID"].") AND (t1.status LIKE '01%') ";
		
		$countres = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($countres)){
		$counter++;
                    $pdf->Cell(9, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(91, 5, $spec["NAZIV"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(10, 5, $row["ukupno"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(10, 5, $row["prof"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(10, 5, $row["doc"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(10, 5, $row["dr"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(10, 5, $row["mr"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(10, 5, $row["naspec"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(10, 5, "", 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(10, 5, $row['ukupno'] + $row['naspec'], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Ln(5);
                    $counters[0] += $row['ukupno'];
                    $counters[1] += $row['prof'];
                    $counters[2] += $row['doc'];
                    $counters[3] += $row['dr'];
                    $counters[4] += $row['mr'];
                    $counters[5] += $row['naspec'];
                }


}
//    $pdf->Ln(5);
    $pdf->Cell(180, 0, '', 'T');
    $pdf->Ln(5);
    $pdf->Cell(100, 5, "UKUPNO", 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(10, 5, $counters[0], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(10, 5, $counters[1], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(10, 5, $counters[2], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(10, 5, $counters[3], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(10, 5, $counters[4], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(10, 5, $counters[5], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(10, 5, '', 'RT', 0, 'C', 0, 0, 1);
        for($i=0; $i<6;$i++){
        $counters[6] += $counters[$i];
    }
    $pdf->Cell(10, 5, $counters[6], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 0, '', 'T');
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');


/*$query = "SELECT COUNT(*) as ukupno, "
        . "(SELECT COUNT(*) FROM djel t2 WHERE (t2.titula=42) AND (t2.status LIKE '01%') AND (t2.spec1 = ".$spec["ID"]." or t2.spec2 = ".$spec["ID"]." or t2.spec3 = ".$spec["ID"].")) as prof, "
        . "(SELECT COUNT(*) FROM djel t3 WHERE (t3.titula=10) AND (t3.status LIKE '01%') AND (t3.spec1 = ".$spec["ID"]." or t3.spec2 = ".$spec["ID"]." or t3.spec3 = ".$spec["ID"].")) as doc, "
        . "(SELECT COUNT(*) FROM djel t4 WHERE (t4.titula=12) AND (t4.status LIKE '01%') AND (t4.spec1 = ".$spec["ID"]." or t4.spec2 = ".$spec["ID"]." or t4.spec3 = ".$spec["ID"].")) as dr, "
        . "(SELECT COUNT(*) FROM djel t5 WHERE (t5.titula=32) AND (t5.status LIKE '01%') AND (t5.spec1 = ".$spec["ID"]." or t5.spec2 = ".$spec["ID"]." or t5.spec3 = ".$spec["ID"].")) as mr, "
        . "(SELECT COUNT(*) FROM (SELECT COUNT(*) as rmcount FROM djel t6 INNER JOIN NOMRM ON NOMRM.NAZIV LIKE 'specijalizant ".$spec['NAZIV']."%' ) djel t6 WHERE (t6.RM LIKE 'specijalizant ".$spec['NAZIV']."%') AND (t6.status LIKE '01%') ) as naspec "
        . "FROM djel t1 WHERE t1.spec1 = ".$spec["ID"]." or t1.spec2 = ".$spec["ID"]." or t1.spec3 = ".$spec["ID"]."";	*/