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
//    $pdf->writeHTMLCell(9,  30, '', '', 'R.B', 1, 0, false, true, 'C', true);
//    $pdf->writeHTMLCell(91, 30, '', '', 'OSNOVNE SPECIJALIZACIJE', 1, 0, false, true, 'C', false);
//    $pdf->SetXY(115, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//        $pdf->writeHTMLCell(30, 10, '', '', 'Ukupno specijalista', 1, 0, false, true, 'C', true);
//    $pdf->StopTransform();
//    $pdf->SetXY(125, 27);
////    $pdf->StartTransform();
////    $pdf->Rotate(90);
//        $pdf->writeHTMLCell(40, 5, '', '', 'Specijalisti od toga', 1, 0, false, true, 'C', true);
////    $pdf->StopTransform();
//    $pdf->SetXY(125, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//    $pdf->writeHTMLCell(25, 10, '', '', 'Prof.dr.sc', 1, 0, false, true, 'C', true);
//     $pdf->StopTransform();
//    $pdf->SetXY(135, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//        $pdf->writeHTMLCell(25, 10, '', '', 'Doc.dr.sc', 1, 0, false, true, 'C', true);
//     $pdf->StopTransform();
//         $pdf->SetXY(145, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//        $pdf->writeHTMLCell(25, 10, '', '', 'dr.sc', 1, 0, false, true, 'C', true);
//     $pdf->StopTransform();
//         $pdf->SetXY(155, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//    $pdf->writeHTMLCell(25, 10, '', '', 'mr.sc', 1, 0, false, true, 'C', false);
//     $pdf->StopTransform();
//     
//     
//
//     
//     $pdf->SetXY(165, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//    $pdf->writeHTMLCell(30, 10, '', '', 'Na specijalizaciji', 1, 0, false, true, 'C', true);
//     $pdf->StopTransform();
//     
//               $pdf->SetXY(175, 37);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//    $pdf->writeHTMLCell(10, 10, '', '', 'od toga', 1, 0, false, true, 'C', true);
//     $pdf->StopTransform();
//     
//     
//         $pdf->SetXY(175, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//    $pdf->writeHTMLCell(20, 10, '', '', 'Na specijalizaciji', 1, 0, false, true, 'C', true);
//     $pdf->StopTransform();
//         $pdf->SetXY(185, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//    $pdf->writeHTMLCell(30, 10, '', '', 'UKUPNO', 1, 0, false, true, 'C', true);
//     $pdf->StopTransform();       
//    $pdf->Ln(1);
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
    

//$ukupno=0;
//$profs=0;
//$docs=0;
//$drs=0;
//$mrs=0;
//$specs=0;
//$fill = $pdf->SetFillColor(160, 160, 160);


//$query = "SELECT COUNT(*) as ukupno, "
//        . "(SELECT COUNT(*) FROM djel t2 WHERE (t2.titula=42 or t2.titula=40) AND (t2.status LIKE '01%') AND t2.spec1 = ".$spec["ID"].") as prof, "
//        . "(SELECT COUNT(*) FROM djel t3 WHERE (t3.titula=10 or t3.titula=36) AND (t3.status LIKE '01%') AND t3.spec1 = ".$spec["ID"].") as doc, "
//        . "(SELECT COUNT(*) FROM djel t4 WHERE (t4.titula=12 or t4.titula=13 or t4.titula=38) AND (t4.status LIKE '01%') AND t4.spec1 = ".$spec["ID"].") as dr, "
//        . "(SELECT COUNT(*) FROM djel t5 WHERE (t5.titula=34 or t5.titula=32 or t5.titula=33 or t5.titula=39) AND (t5.status LIKE '01%') AND t5.spec1 = ".$spec["ID"].") as mr, "
//        . "(SELECT COUNT(*) FROM djel t6 WHERE (t6.status LIKE '01%') AND (t6.naspec = ".$spec['ID'].")) as naspec "
//        . "FROM djel t1 WHERE (t1.spec1 = ".$spec["ID"].") AND (t1.status LIKE '01%')";
$sql_query = "SELECT "
        . "(SELECT COUNT(*) FROM djel t2 WHERE t2.status LIKE '01%' AND t2.naspec IS NULL AND t2.SPEC1 IS NULL AND(t2.RM=122 OR t2.RM=290 OR t2.RM=524) AND t2.spol=1) as oPraksaAllM, " //Count all man from kdrvsk.. 
        . "(SELECT COUNT(*) FROM djel t3 WHERE t3.status LIKE '01%' AND t3.naspec IS NULL AND t3.SPEC1 IS NULL AND(t3.RM=122 OR t3.RM=290 OR t3.RM=524) AND t3.spol=2) as oPraksaAllZ, " // Count all woman from kdrvsk..
        . "(SELECT COUNT(*) FROM djel t4 WHERE t4.status LIKE '01%' AND t4.naspec IS NULL AND t4.SPEC1 IS NULL AND(t4.RM=122 OR t4.RM=290 OR t4.RM=524) AND t4.spol=1 AND (DATEDIFF(NOW(), t4.DATUMR)< 16060)) as dotcM, " // < 34 years
        . "(SELECT COUNT(*) FROM djel t5 WHERE t5.status LIKE '01%' AND t5.naspec IS NULL AND t5.SPEC1 IS NULL AND(t5.RM=122 OR t5.RM=290 OR t5.RM=524) AND t5.spol=2 AND (DATEDIFF(NOW(), t5.DATUMR)< 16060)) as dotcZ, " // < 34 years
        . "(SELECT COUNT(*) FROM djel t6 WHERE t6.status LIKE '01%' AND t6.naspec IS NULL AND t6.SPEC1 IS NULL AND(t6.RM=122 OR t6.RM=290 OR t6.RM=524) AND t6.spol=1 AND (DATEDIFF(NOW(), t6.DATUMR) BETWEEN 16060 AND 19710)) as doccM, "
        . "(SELECT COUNT(*) FROM djel t7 WHERE t7.status LIKE '01%' AND t7.naspec IS NULL AND t7.SPEC1 IS NULL AND(t7.RM=122 OR t7.RM=290 OR t7.RM=524) AND t7.spol=2 AND (DATEDIFF(NOW(), t7.DATUMR) BETWEEN 16060 AND 19710)) as doccZ, "
        . "(SELECT COUNT(*) FROM djel t8 WHERE t8.status LIKE '01%' AND t8.naspec IS NULL AND t8.SPEC1 IS NULL AND(t8.RM=122 OR t8.RM=290 OR t8.RM=524) AND t8.spol=1 AND (DATEDIFF(NOW(), t8.DATUMR) BETWEEN 19170 AND 20075)) as dopcM, "
        . "(SELECT COUNT(*) FROM djel t9 WHERE t9.status LIKE '01%' AND t9.naspec IS NULL AND t9.SPEC1 IS NULL AND(t9.RM=122 OR t9.RM=290 OR t9.RM=524) AND t9.spol=2 AND (DATEDIFF(NOW(), t9.DATUMR) BETWEEN 19170 AND 20075)) as dopcZ, "
        . "(SELECT COUNT(*) FROM djel t10 WHERE t10.status LIKE '01%' AND t10.naspec IS NULL AND t10.SPEC1 IS NULL AND(t10.RM=122 OR t10.RM=290 OR t10.RM=524) AND t10.spol=1 AND (DATEDIFF(NOW(), t10.DATUMR)>= 20075)) as viseppM, "
        . "(SELECT COUNT(*) FROM djel t11 WHERE t11.status LIKE '01%' AND t11.naspec IS NULL AND t11.SPEC1 IS NULL AND(t11.RM=122 OR t11.RM=290 OR t11.RM=524) AND t11.spol=2 AND (DATEDIFF(NOW(), t11.DATUMR)>= 20075)) as viseppZ, "
        . "(SELECT COUNT(*) FROM djel t12 WHERE t12.status LIKE '01%' AND t12.naspec IS NOT NULL AND t12.SPEC1 IS NULL AND (t12.RM!=122 OR t12.RM!=290 OR t12.RM!=524) AND t12.spol=1) as naspecM, "
        . "(SELECT COUNT(*) FROM djel t13 WHERE t13.status LIKE '01%' AND t13.naspec IS NOT NULL AND t13.SPEC1 IS NULL AND (t13.RM!=122 OR t13.RM!=290 OR t13.RM!=524) AND t13.spol=2) as naspecZ, "
        . "(SELECT COUNT(*) FROM djel t14 WHERE t14.status LIKE '01%' AND t14.naspec IS NOT NULL AND t14.SPEC1 IS NULL  AND (t14.RM!=122 OR t14.RM!=290 OR t14.RM!=524) AND t14.spol=1 AND (DATEDIFF(NOW(), t14.DATUMR) BETWEEN 1000 AND 16060)) as naspecdotcM, "
        . "(SELECT COUNT(*) FROM djel t15 WHERE t15.status LIKE '01%' AND t15.naspec IS NOT NULL AND t15.SPEC1 IS NULL  AND (t15.RM!=122 OR t15.RM!=290 OR t15.RM!=524) AND t15.spol=2 AND (DATEDIFF(NOW(), t15.DATUMR)< 16060)) as naspecdotcZ, "
        . "(SELECT COUNT(*) FROM djel t16 WHERE t16.status LIKE '01%' AND t16.naspec IS NOT NULL AND t16.SPEC1 IS NULL  AND (t16.RM!=122 OR t16.RM!=290 OR t16.RM!=524) AND t16.spol=1 AND (DATEDIFF(NOW(), t16.DATUMR) BETWEEN 16060 AND 19710)) as naspecdoccM, "
        . "(SELECT COUNT(*) FROM djel t17 WHERE t17.status LIKE '01%' AND t17.naspec IS NOT NULL AND t17.SPEC1 IS NULL  AND (t17.RM!=122 OR t17.RM!=290 OR t17.RM!=524) AND t17.spol=2 AND (DATEDIFF(NOW(), t17.DATUMR) BETWEEN 16060 AND 19710)) as naspecdoccZ, "
        . "(SELECT COUNT(*) FROM djel t18 WHERE t18.status LIKE '01%' AND t18.naspec IS NOT NULL AND t18.SPEC1 IS NULL  AND (t18.RM!=122 OR t18.RM!=290 OR t18.RM!=524) AND t18.spol=1 AND (DATEDIFF(NOW(), t18.DATUMR) BETWEEN 19710 AND 20075)) as naspecdopcM, "
        . "(SELECT COUNT(*) FROM djel t19 WHERE t19.status LIKE '01%' AND t19.naspec IS NOT NULL AND t19.SPEC1 IS NULL  AND (t19.RM!=122 OR t19.RM!=290 OR t19.RM!=524) AND t19.spol=2 AND (DATEDIFF(NOW(), t19.DATUMR) BETWEEN 19710 AND 20075)) as naspecdopcZ, "
        . "(SELECT COUNT(*) FROM djel t20 WHERE t20.status LIKE '01%' AND t20.naspec IS NOT NULL AND t20.SPEC1 IS NULL AND (t20.RM!=122 OR t20.RM!=290 OR t20.RM!=524) AND t20.spol=1 AND (DATEDIFF(NOW(), t20.DATUMR)>= 20075)) as naspecviseppM, "
        . "(SELECT COUNT(*) FROM djel t21 WHERE t21.status LIKE '01%' AND t21.naspec IS NOT NULL AND t21.SPEC1 IS NULL AND (t21.RM!=122 OR t21.RM!=290 OR t21.RM!=524) AND t21.spol=2 AND (DATEDIFF(NOW(), t21.DATUMR)>= 20075)) as naspecviseppZ, "
        . "(SELECT COUNT(*) FROM djel t22 WHERE t22.status LIKE '01%' AND t22.SPEC1 IS NOT NULL AND (t22.RM!=122 OR t22.RM!=290 OR t22.RM!=524) AND t22.spol=1) as specM, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE t23.status LIKE '01%' AND t23.SPEC1 IS NOT NULL AND (t23.RM!=122 OR t23.RM!=290 OR t23.RM!=524) AND t23.spol=2) as specZ, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE t24.status LIKE '01%' AND t24.SPEC1 IS NOT NULL  AND (t24.RM!=122 OR t24.RM!=290 OR t24.RM!=524) AND t24.spol=1 AND (DATEDIFF(NOW(), t24.DATUMR) BETWEEN 1000 AND 16060)) as specdotcM, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE t25.status LIKE '01%' AND t25.SPEC1 IS NOT NULL  AND (t25.RM!=122 OR t25.RM!=290 OR t25.RM!=524) AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR)< 16060)) as specdotcZ, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE t26.status LIKE '01%' AND t26.SPEC1 IS NOT NULL  AND (t26.RM!=122 OR t26.RM!=290 OR t26.RM!=524) AND t26.spol=1 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 16060 AND 19710)) as specdoccM, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE t27.status LIKE '01%' AND t27.SPEC1 IS NOT NULL  AND (t27.RM!=122 OR t27.RM!=290 OR t27.RM!=524) AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 16060 AND 19710)) as specdoccZ, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE t28.status LIKE '01%' AND t28.SPEC1 IS NOT NULL  AND (t28.RM!=122 OR t28.RM!=290 OR t28.RM!=524) AND t28.spol=1 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 19710 AND 20075)) as specdopcM, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE t29.status LIKE '01%' AND t29.SPEC1 IS NOT NULL  AND (t29.RM!=122 OR t29.RM!=290 OR t29.RM!=524) AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 19710 AND 20075)) as specdopcZ, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE t30.status LIKE '01%' AND t30.SPEC1 IS NOT NULL AND (t30.RM!=122 OR t30.RM!=290 OR t30.RM!=524) AND t30.spol=1 AND (DATEDIFF(NOW(), t30.DATUMR)>= 20075)) as specviseppM, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE t31.status LIKE '01%' AND t31.SPEC1 IS NOT NULL AND (t31.RM!=122 OR t31.RM!=290 OR t31.RM!=524) AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 20075)) as specviseppZ "
        . "FROM djel WHERE ID IS NOT NULL";
//        . "(SELECT COUNT(*) FROM djel t4 WHERE t4.status='01%' AND t4.naspec IS NULL AND t4.SPEC1 IS NULL AND(t4.RM=122 OR t4.RM=290 OR t4.RM=524) AND t2.spol=2) as dotcZ, "
//		AND(t6.naspec IS NULL AND t6.nasubspec IS NULL AND t6.SPEC1 IS NULL) AND(RM=122 OR RM=290 OR RM=524)
    $countres = mysqli_query($con, $sql_query);
    if(!$countres){
        echo mysqli_errno($con) . mysqli_error($con);
    }
    $row = mysqli_fetch_assoc($countres);
//    $counter++;
        
//        $pdf->Cell(91, 4, $spec["NAZIV"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["ukupno"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["prof"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["doc"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["dr"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["mr"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row["naspec"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, "", 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 4, $row['ukupno'] + $row['naspec'], 'RT', 0, 'C', 0, 0, 1);
        
//        $counters[0] += $row['ukupno'];
//        $counters[1] += $row['prof'];
//        $counters[2] += $row['doc'];
//        $counters[3] += $row['dr'];
//        $counters[4] += $row['mr'];
//        $counters[5] += $row['naspec'];

    //    $pdf->SetXY(115, 57);
//    $pdf->StartTransform();
//    $pdf->Rotate(90);
//        $pdf->writeHTMLCell(30, 10, '', '', 'Ukupno specijalista', 1, 0, false, true, 'C', true);
//    $pdf->StopTransform();
$pdf->Cell(70, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, 'DOBNA SKUPINA', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'Svega', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'do - 34', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '35 - 44', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '45 - 54', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '55 i više', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'UKUPNO', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['oPraksaAllM']+$row['naspecM']+$row['specM'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['oPraksaAllZ']+$row['naspecZ']+$row['specZ'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['dotcM']+$row['naspecdotcM']+$row['specdotcM'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['dotcZ']+$row['naspecdotcZ']+$row['specdotcZ'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['doccM']+$row['naspecdoccM']+$row['specdoccM'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['doccZ']+$row['naspecdoccZ']+$row['specdoccZ'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['dopcM']+$row['naspecdopcM']+$row['specdopcM'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['dopcZ']+$row['naspecdopcZ']+$row['specdopcZ'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['viseppM']+$row['naspecviseppM']+$row['specviseppM'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['viseppZ']+$row['naspecviseppZ']+$row['specviseppZ'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Doktori medicine', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['oPraksaAllM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['oPraksaAllZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['dotcM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['dotcZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['doccM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['doccZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['dopcM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['dopcZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['viseppM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['viseppZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Na specijalizaciji', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecdotcM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecdotcZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecdoccM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecdoccZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecdopcM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecdopcZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecviseppM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['naspecviseppZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Specijalisti', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specdotcM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specdotcZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specdoccM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specdoccZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specdopcM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specdopcZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specviseppM'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['specviseppZ'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);

$sql_query = "SELECT * FROM specijalizacija";
$result = mysqli_query($con, $sql_query);
$suma=0;
$counter=0;
$counters = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    while($spec = mysqli_fetch_assoc($result)){
       $sql_query = "SELECT COUNT(*), "
        . "(SELECT COUNT(*) FROM djel t22 WHERE t22.status LIKE '01%' AND (t22.SPEC1 = ".$spec['ID']." OR t22.SPEC2 = ".$spec['ID'].") AND t22.spol=1) as specMU, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE t23.status LIKE '01%' AND (t23.SPEC1 = ".$spec['ID']." OR t23.SPEC2 = ".$spec['ID'].") AND t23.spol=2) as specZE, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE t24.status LIKE '01%' AND (t24.SPEC1 = ".$spec['ID']." OR t24.SPEC2 = ".$spec['ID'].") AND t24.spol=1 AND (DATEDIFF(NOW(), t24.DATUMR) BETWEEN 1000 AND 16060)) as specdotcMU, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE t25.status LIKE '01%' AND (t25.SPEC1 = ".$spec['ID']." OR t25.SPEC2 = ".$spec['ID'].") AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR)< 16060)) as specdotcZE, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE t26.status LIKE '01%' AND (t26.SPEC1 = ".$spec['ID']." OR t26.SPEC2 = ".$spec['ID'].") AND t26.spol=1 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 16060 AND 19710)) as specdoccMU, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE t27.status LIKE '01%' AND (t27.SPEC1 = ".$spec['ID']." OR t27.SPEC2 = ".$spec['ID'].") AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 16060 AND 19710)) as specdoccZE, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE t28.status LIKE '01%' AND (t28.SPEC1 = ".$spec['ID']." OR t28.SPEC2 = ".$spec['ID'].") AND t28.spol=1 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 19710 AND 20075)) as specdopcMU, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE t29.status LIKE '01%' AND (t29.SPEC1 = ".$spec['ID']." OR t29.SPEC2 = ".$spec['ID'].") AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 19710 AND 20075)) as specdopcZE, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE t30.status LIKE '01%' AND (t30.SPEC1 = ".$spec['ID']." OR t30.SPEC2 = ".$spec['ID'].") AND t30.spol=1 AND (DATEDIFF(NOW(), t30.DATUMR)>= 20075)) as specviseppMU, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE t31.status LIKE '01%' AND (t31.SPEC1 = ".$spec['ID']." OR t31.SPEC2 = ".$spec['ID'].") AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 20075)) as specviseppZE "
        . "FROM djel WHERE ID IS NOT NULL";
       $response = mysqli_query($con, $sql_query);
       if(!$response){
           echo mysqli_errno($con) . mysqli_error($con);
       }
       else{
       $pdf->Cell(70, 4, $spec['NAZIV'], 'LRT', 0, 'C', 0, 0, 1);
        while($row = mysqli_fetch_assoc($response)){
            
            
            
            $counters[0] = $counters[0] + $row['specMU'];
            $counters[1] = $counters[1] + $row['specZE'];
            $counters[2] = $counters[2] + $row['specdotcMU'];
            $counters[3] = $counters[3] + $row['specdotcZE'];
            $counters[4] = $counters[4] + $row['specdoccMU'];
            $counters[5] = $counters[5] + $row['specdoccZE'];
            $counters[6] = $counters[6] + $row['specdopcMU'];
            $counters[7] = $counters[7] + $row['specdopcZE'];
            $counters[8] = $counters[8] + $row['specviseppMU'];
            $counters[9] = $counters[9] + $row['specviseppZE'];
            $pdf->Cell(11, 4, $row['specMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['specviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Ln(4);
        }
       }
}
        $pdf->Cell(70, 4, 'UKUPNO', 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[0], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[1], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[2], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[3], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[4], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[5], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[6], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[7], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[8], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $counters[9], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Ln(14);
//    $pdf->Ln(5);
//    $pdf->Cell(180, 0, '', 'T');
//    $pdf->Ln(1);
//    $pdf->Cell(100, 5, "UKUPNO", 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 5, $counters[0], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 5, $counters[1], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 5, $counters[2], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 5, $counters[3], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 5, $counters[4], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 5, $counters[5], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 5, '', 'RT', 0, 'C', 0, 0, 1);
//        for($i=0; $i<6;$i++){
//        $counters[6] += $counters[$i];
//    }
//    $pdf->Cell(10, 5, $counters[0] + $counters[5], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->Cell(180, 0, '', 'T');
        
        //VSSmZSu - ukupno muski zdravstveni suradnici ukupno
        //VSSzZSu - ukupno zenski zdravstveno suradnici ukupno
        //NASPECmZSu - ukupno muski zdravstveni suradnici na specijalizaciji
        //NASPECzZSu - ukupno zenski zdravstveni suradnici na specijalizaciji
        //SPECmZSu - ukupno muski zdravstveni suradnici sa specijalizacijom
        //SPECzZSu - ukupno zenski zdravstveni suradnici sa specijalizacijom
        //VSSmZSdtc - ukupno muskih zdravstvenih suradnika do trideset cetiri godine
        //VSSzZSdtc - ukupno zenskih zdravstvenih suradnika do trideset cetiri godine
        //VSSmZSdcc - ukupno muskih zdravstvenih suradnika do cetrdeset cetiri godine
        //VSSzZSdcc - ukupno zenskih zdravstvenih suradnika do cetrdeset cetiri godine
        //VSSmZSdpc - ukupno muskih zdravstvenih suradnika do pedeset cetiri godine
        //VSSzZSdpc - ukupno zenskih zdravstvenih suradnika do pedeset cetiri godine
        //VSSmZSvpp - ukupno muskih zdravstvenih suradnika iznad pedeset pet godina godina
        //VSSzZSvpp - ukupno zenskih zdravstvenih suradnika iznad pedeset pet godina
$sql_query = "SELECT "
        . "(SELECT COUNT(*) "
        . "FROM djel t1 "
        . "WHERE t1.status LIKE '01%' "
        . "AND t1.spol = 1 "
        . "AND t1.SPEC1 IS NULL "
        . "AND t1.NASPEC IS NULL "
        . "AND (t1.RM!=122 OR t1.RM!=290 OR t1.RM!=524) "
        . "AND t1.SURADNICI IS NOT NULL "
        . ") as VSSmZSu, " 
        . "(SELECT COUNT(*) "
        . "FROM djel t2 "
        . "WHERE t2.status LIKE '01%' "
        . "AND t2.spol = 2 "
        . "AND t2.SPEC1 IS NULL "
        . "AND t2.NASPEC IS NULL "
        . "AND (t2.RM!=122 OR t2.RM!=290 OR t2.RM!=524) "
        . "AND t2.SURADNICI IS NOT NULL "
        . ") as VSSzZSu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t3 "
        . "WHERE t3.status LIKE '01%' "
        . "AND t3.SPEC1 IS NULL "
        . "AND t3.NASPEC IS NOT NULL "
        . "AND (t3.RM!=122 OR t3.RM!=290 OR t3.RM!=524) "
        . "AND t3.SURADNICI IS NOT NULL "
        . ") as NASPECmZSu, " 
        . "(SELECT COUNT(*) "
        . "FROM djel t4 "
        . "WHERE t4.status LIKE '01%' "
        . "AND t4.SPEC1 IS NULL "
        . "AND t4.NASPEC IS NOT NULL "
        . "AND (t4.RM!=122 OR t4.RM!=290 OR t4.RM!=524) "
        . "AND t4.SURADNICI IS NOT NULL "
        . ") as NASPECzZSu, " 
        . "(SELECT COUNT(*) "
        . "FROM djel t5 "
        . "WHERE t5.status LIKE '01%' "
        . "AND t5.SPEC1 IS NOT NULL "
        . "AND t5.SURADNICI IS NOT NULL "
        . ") as SPECmZSu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t5 "
        . "WHERE t5.status LIKE '01%' "
        . "AND t5.SPEC1 IS NOT NULL "
        . "AND t5.SURADNICI IS NOT NULL "
        . ") as SPECzZSu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t6 "
        . "WHERE t6.status LIKE '01%' "
        . "AND t6.spol = 1 "
        . "AND t6.SPEC1 IS NULL "
        . "AND t6.NASPEC IS NULL "
        . "AND t6.SURADNICI IS NOT NULL "
        . "AND (DATEDIFF(NOW(), t6.DATUMR)< 16060) "
        . ") as VSSmZSdtc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t7 "
        . "WHERE t7.status LIKE '01%' "
        . "AND t7.spol = 2 "
        . "AND t7.SPEC1 IS NULL "
        . "AND t7.NASPEC IS NULL "
        . "AND t7.SURADNICI IS NOT NULL "
        . "AND (DATEDIFF(NOW(), t7.DATUMR)< 16060) "
        . ") as VSSzZSdtc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t8 "
        . "WHERE t8.status LIKE '01%' "
        . "AND t8.spol = 1 "
        . "AND t8.SPEC1 IS NULL "
        . "AND t8.NASPEC IS NULL "
        . "AND t8.SURADNICI IS NOT NULL "
        . "AND (DATEDIFF(NOW(), t8.DATUMR) BETWEEN 16060 AND 19710) "
        . ") as VSSmZSdcc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t9 "
        . "WHERE t9.status LIKE '01%' "
        . "AND t9.spol = 2 "
        . "AND t9.SPEC1 IS NULL "
        . "AND t9.NASPEC IS NULL "
        . "AND t9.SURADNICI IS NOT NULL "
        . "AND (DATEDIFF(NOW(), t9.DATUMR) BETWEEN 16060 AND 19710) "
        . ") as VSSzZSdcc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t10 "
        . "WHERE t10.status LIKE '01%' "
        . "AND t10.spol = 1 "
        . "AND t10.SPEC1 IS NULL "
        . "AND t10.NASPEC IS NULL "
        . "AND t10.SURADNICI IS NOT NULL "
        . "AND (DATEDIFF(NOW(), t10.DATUMR) BETWEEN 19170 AND 20075) "
        . ") as VSSmZSdpc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t11 "
        . "WHERE t11.status LIKE '01%' "
        . "AND t11.spol = 2 "
        . "AND t11.SPEC1 IS NULL "
        . "AND t11.NASPEC IS NULL "
        . "AND t11.SURADNICI IS NOT NULL "
        . "AND (DATEDIFF(NOW(), t11.DATUMR) BETWEEN 19170 AND 20075) "
        . ") as VSSzZSdpc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t12 "
        . "WHERE t12.status LIKE '01%' "
        . "AND t12.spol = 1 "
        . "AND t12.SPEC1 IS NULL "
        . "AND t12.NASPEC IS NULL "
        . "AND t12.SURADNICI IS NOT NULL "
        . "AND (DATEDIFF(NOW(), t12.DATUMR)>= 20075) "
        . ") as VSSmZSvpp, "
        . "(SELECT COUNT(*) "
        . "FROM djel t13 "
        . "WHERE t13.status LIKE '01%' "
        . "AND t13.spol = 2 "
        . "AND t13.SPEC1 IS NULL "
        . "AND t13.NASPEC IS NULL "
        . "AND t13.SURADNICI IS NOT NULL "
        . "AND (DATEDIFF(NOW(), t13.DATUMR)>= 20075) "
        . ") as VSSzZSvpp "
        . "FROM djel WHERE ID IS NOT NULL ";

    $zs = mysqli_query($con, $sql_query);
    if(!$zs){
        echo mysqli_errno($con) . mysqli_error($con);
    }
    $row = mysqli_fetch_assoc($zs);
    
$pdf->Cell(70, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, 'DOBNA SKUPINA', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'Svega', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'do - 34', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '35 - 44', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '45 - 54', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '55 i više', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Visoka sprema', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSmZSu'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSzZSu'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSmZSdtc'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSzZSdtc'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSmZSdcc'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSzZSdcc'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSmZSdpc'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSzZSdpc'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSmZSvpp'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['VSSzZSvpp'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Na specijalizaciji', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['NASPECmZSu'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['NASPECzZSu'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Specijalisti', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['SPECmZSu'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $row['SPECzZSu'], 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);





//$pdf->Cell(11, 4, $row['specdotcM'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['specdotcZ'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['specdoccM'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['specdoccZ'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['specdopcM'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['specdopcZ'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['specviseppM'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['specviseppZ'], 'LRT', 0, 'C', 0, 0, 1);
        
        
        
        
        
        
        
        
        
        



//medicinske sestre...

// VSSmZDu - ukupno muskih zdravstvenih djelatnika sa visom strucnom spremom
// VSSzZDu - ukupno zeniskih zdravstvenih djelatnika sa visom strucnom spremom

$sql_query = "SELECT "
        . "(SELECT COUNT(*) "
        . "FROM djel t1 "
        . "WHERE t1.status LIKE '01%' "
        . "AND t1.ssrm = 15 "
        . "AND t1.spol = 1 "
        . "AND t1.SPEC1 IS NULL "
        . "AND t1.NASPEC IS NULL "
        . "AND t1.vrsta =1 "
        . ") as VSSmZDu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t2 "
        . "WHERE t2.status LIKE '01%' "
        . "AND t2.ssrm = 15 "
        . "AND t2.spol = 2 "
        . "AND t2.SPEC1 IS NULL "
        . "AND t2.NASPEC IS NULL "
        . "AND t2.vrsta =1 "
        . ") as VSSzZDu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t3 "
        . "WHERE t3.status LIKE '01%' "
        . "AND t3.ssrm = 7 "
        . "AND t3.spol = 1 "
        . "AND t3.SPEC1 IS NULL "
        . "AND t3.NASPEC IS NULL  "
        . "AND t3.vrsta =1 "
        . ") as SSSmZDu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t4 "
        . "WHERE t4.status LIKE '01%' "
        . "AND t4.ssrm = 7 "
        . "AND t4.spol = 2 "
        . "AND t4.SPEC1 IS NULL "
        . "AND t4.NASPEC IS NULL  "
        . "AND t4.vrsta =1 "
        . ") as SSSzZDu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t5 "
        . "WHERE t5.status LIKE '01%' "
        . "AND t5.ssrm = 4 "
        . "AND t5.spol = 1 "
        . "AND t5.SPEC1 IS NULL "
        . "AND t5.NASPEC IS NULL  "
        . "AND t5.vrsta =1 "
        . ") as NSSmZDu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t66 "
        . "WHERE t66.status LIKE '01%' "
        . "AND t66.ssrm = 4 "
        . "AND t66.spol = 2 "
        . "AND t66.SPEC1 IS NULL "
        . "AND t66.NASPEC IS NULL "
        . "AND t66.vrsta =1 "
        . ") as NSSzZDu, "
        . "(SELECT COUNT(*) "
        . "FROM djel t6 "
        . "WHERE t6.status LIKE '01%' "
        . "AND t6.spol = 1 "
        . "AND t6.SPEC1 IS NULL "
        . "AND t6.NASPEC IS NULL "
        . "AND t6.ssrm = 15 "
        . "AND (DATEDIFF(NOW(), t6.DATUMR)< 16060) "
        . "AND t6.vrsta =1 "
        . ") as VSSmZDdtc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t7 "
        . "WHERE t7.status LIKE '01%' "
        . "AND t7.spol = 2 "
        . "AND t7.SPEC1 IS NULL "
        . "AND t7.NASPEC IS NULL "
        . "AND t7.ssrm = 15 "
        . "AND (DATEDIFF(NOW(), t7.DATUMR)< 16060) "
        . "AND t7.vrsta =1 "
        . ") as VSSzZDdtc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t8 "
        . "WHERE t8.status LIKE '01%' "
        . "AND t8.spol = 1 "
        . "AND t8.SPEC1 IS NULL "
        . "AND t8.NASPEC IS NULL "
        . "AND t8.ssrm = 15 "
        . "AND (DATEDIFF(NOW(), t8.DATUMR) BETWEEN 16060 AND 19710) "
        . "AND t8.vrsta =1 "
        . ") as VSSmZDdcc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t9 "
        . "WHERE t9.status LIKE '01%' "
        . "AND t9.spol = 2 "
        . "AND t9.SPEC1 IS NULL "
        . "AND t9.NASPEC IS NULL "
        . "AND t9.ssrm = 15 "
        . "AND (DATEDIFF(NOW(), t9.DATUMR) BETWEEN 16060 AND 19710) "
        . "AND t9.vrsta =1 "
        . ") as VSSzZDdcc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t10 "
        . "WHERE t10.status LIKE '01%' "
        . "AND t10.spol = 1 "
        . "AND t10.SPEC1 IS NULL "
        . "AND t10.NASPEC IS NULL "
        . "AND t10.ssrm = 15 "
        . "AND (DATEDIFF(NOW(), t10.DATUMR) BETWEEN 19170 AND 20075) "
        . "AND t10.vrsta =1 "
        . ") as VSSmZDdpc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t11 "
        . "WHERE t11.status LIKE '01%' "
        . "AND t11.spol = 2 "
        . "AND t11.SPEC1 IS NULL "
        . "AND t11.NASPEC IS NULL "
        . "AND t11.ssrm = 15 "
        . "AND (DATEDIFF(NOW(), t11.DATUMR) BETWEEN 19170 AND 20075) "
        . "AND t11.vrsta =1 "
        . ") as VSSzZDdpc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t12 "
        . "WHERE t12.status LIKE '01%' "
        . "AND t12.spol = 1 "
        . "AND t12.SPEC1 IS NULL "
        . "AND t12.NASPEC IS NULL "
        . "AND t12.ssrm = 15 "
        . "AND (DATEDIFF(NOW(), t12.DATUMR)>= 20075) "
        . "AND t12.vrsta =1 "
        . ") as VSSmZDvpp, "
        . "(SELECT COUNT(*) "
        . "FROM djel t13 "
        . "WHERE t13.status LIKE '01%' "
        . "AND t13.spol = 2 "
        . "AND t13.SPEC1 IS NULL "
        . "AND t13.NASPEC IS NULL "
        . "AND t13.ssrm = 15 "
        . "AND (DATEDIFF(NOW(), t13.DATUMR)>= 20075) "
        . "AND t13.vrsta =1 "
        . ") as VSSzZDvpp, "
        . "(SELECT COUNT(*) "
        . "FROM djel t14 "
        . "WHERE t14.status LIKE '01%' "
        . "AND t14.spol = 1 "
        . "AND t14.SPEC1 IS NULL "
        . "AND t14.NASPEC IS NULL "
        . "AND t14.ssrm = 7 "
        . "AND (DATEDIFF(NOW(), t14.DATUMR)< 16060) "
        . "AND t14.vrsta =1 "
        . ") as SSSmZDdtc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t15 "
        . "WHERE t15.status LIKE '01%' "
        . "AND t15.spol = 2 "
        . "AND t15.SPEC1 IS NULL "
        . "AND t15.NASPEC IS NULL "
        . "AND t15.ssrm = 7 "
        . "AND (DATEDIFF(NOW(), t15.DATUMR)< 16060) "
        . "AND t15.vrsta =1 "
        . ") as SSSzZDdtc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t16 "
        . "WHERE t16.status LIKE '01%' "
        . "AND t16.spol = 1 "
        . "AND t16.SPEC1 IS NULL "
        . "AND t16.NASPEC IS NULL "
        . "AND t16.ssrm = 7 "
        . "AND (DATEDIFF(NOW(), t16.DATUMR) BETWEEN 16060 AND 19710) "
        . "AND t16.vrsta =1 "
        . ") as SSSmZDdcc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t17 "
        . "WHERE t17.status LIKE '01%' "
        . "AND t17.spol = 2 "
        . "AND t17.SPEC1 IS NULL "
        . "AND t17.NASPEC IS NULL "
        . "AND t17.ssrm = 7 "
        . "AND (DATEDIFF(NOW(), t17.DATUMR) BETWEEN 16060 AND 19710) "
        . "AND t17.vrsta =1 "
        . ") as SSSzZDdcc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t18 "
        . "WHERE t18.status LIKE '01%' "
        . "AND t18.spol = 1 "
        . "AND t18.SPEC1 IS NULL "
        . "AND t18.NASPEC IS NULL "
        . "AND t18.ssrm = 7 "
        . "AND (DATEDIFF(NOW(), t18.DATUMR) BETWEEN 19170 AND 20075) "
        . "AND t18.vrsta =1 "
        . ") as SSSmZDdpc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t19 "
        . "WHERE t19.status LIKE '01%' "
        . "AND t19.spol = 2 "
        . "AND t19.SPEC1 IS NULL "
        . "AND t19.NASPEC IS NULL "
        . "AND t19.ssrm = 7 "
        . "AND (DATEDIFF(NOW(), t19.DATUMR) BETWEEN 19170 AND 20075) "
        . "AND t19.vrsta =1 "
        . ") as SSSzZDdpc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t20 "
        . "WHERE t20.status LIKE '01%' "
        . "AND t20.spol = 1 "
        . "AND t20.SPEC1 IS NULL "
        . "AND t20.NASPEC IS NULL "
        . "AND t20.ssrm = 7 "
        . "AND (DATEDIFF(NOW(), t20.DATUMR)>= 20075) "
        . "AND t20.vrsta =1 "
        . ") as SSSmZDvpp, "
        . "(SELECT COUNT(*) "
        . "FROM djel t21 "
        . "WHERE t21.status LIKE '01%' "
        . "AND t21.spol = 2 "
        . "AND t21.SPEC1 IS NULL "
        . "AND t21.NASPEC IS NULL "
        . "AND t21.ssrm = 7 "
        . "AND (DATEDIFF(NOW(), t21.DATUMR)>= 20075) "
        . "AND t21.vrsta =1 "
        . ") as SSSzZDvpp, "
        . "(SELECT COUNT(*) "
        . "FROM djel t22 "
        . "WHERE t22.status LIKE '01%' "
        . "AND t22.spol = 1 "
        . "AND t22.SPEC1 IS NULL "
        . "AND t22.NASPEC IS NULL "
        . "AND t22.ssrm = 4 "
        . "AND (DATEDIFF(NOW(), t22.DATUMR)< 16060) "
        . "AND t22.vrsta =1 "
        . ") as NSSmZDdtc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t23 "
        . "WHERE t23.status LIKE '01%' "
        . "AND t23.spol = 2 "
        . "AND t23.SPEC1 IS NULL "
        . "AND t23.NASPEC IS NULL "
        . "AND t23.ssrm = 4 "
        . "AND (DATEDIFF(NOW(), t23.DATUMR)< 16060) "
        . "AND t23.vrsta =1 "
        . ") as NSSzZDdtc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t24 "
        . "WHERE t24.status LIKE '01%' "
        . "AND t24.spol = 1 "
        . "AND t24.SPEC1 IS NULL "
        . "AND t24.NASPEC IS NULL "
        . "AND t24.ssrm = 4 "
        . "AND (DATEDIFF(NOW(), t24.DATUMR) BETWEEN 16060 AND 19710) "
        . "AND t24.vrsta =1 "
        . ") as NSSmZDdcc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t25 "
        . "WHERE t25.status LIKE '01%' "
        . "AND t25.spol = 2 "
        . "AND t25.SPEC1 IS NULL "
        . "AND t25.NASPEC IS NULL "
        . "AND t25.ssrm = 4 "
        . "AND (DATEDIFF(NOW(), t25.DATUMR) BETWEEN 16060 AND 19710) "
        . "AND t25.vrsta =1 "
        . ") as NSSzZDdcc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t26 "
        . "WHERE t26.status LIKE '01%' "
        . "AND t26.spol = 1 "
        . "AND t26.SPEC1 IS NULL "
        . "AND t26.NASPEC IS NULL "
        . "AND t26.ssrm = 4 "
        . "AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 19170 AND 20075) "
        . "AND t26.vrsta =1 "
        . ") as NSSmZDdpc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t27 "
        . "WHERE t27.status LIKE '01%' "
        . "AND t27.spol = 2 "
        . "AND t27.SPEC1 IS NULL "
        . "AND t27.NASPEC IS NULL "
        . "AND t27.ssrm = 4 "
        . "AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 19170 AND 20075) "
        . "AND t27.vrsta =1 "
        . ") as NSSzZDdpc, "
        . "(SELECT COUNT(*) "
        . "FROM djel t28 "
        . "WHERE t28.status LIKE '01%' "
        . "AND t28.spol = 1 "
        . "AND t28.SPEC1 IS NULL "
        . "AND t28.NASPEC IS NULL "
        . "AND t28.ssrm = 4 "
        . "AND (DATEDIFF(NOW(), t28.DATUMR)>= 20075) "
        . "AND t28.vrsta =1 "
        . ") as NSSmZDvpp, "
        . "(SELECT COUNT(*) "
        . "FROM djel t29 "
        . "WHERE t29.status LIKE '01%' "
        . "AND t29.spol = 2 "
        . "AND t29.SPEC1 IS NULL "
        . "AND t29.NASPEC IS NULL "
        . "AND t29.ssrm = 4 "
        . "AND (DATEDIFF(NOW(), t29.DATUMR)>= 20075) "
        . "AND t29.vrsta =1 "
        . ") as NSSzZDvpp "
        . "FROM djel ";
        
    $zd = mysqli_query($con, $sql_query);
    if(!$zd){
        echo mysqli_errno($con) . mysqli_error($con);
    }
    $row = mysqli_fetch_assoc($zd);

    $pdf->Cell(70, 4, '', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(110, 4, 'DOBNA SKUPINA', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(70, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, 'Svega', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, 'do - 34', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, '35 - 44', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, '45 - 54', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, '55 i više', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(70, 4, '', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(70, 4, 'Visa', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSmZDu'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSzZDu'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSmZDdtc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSzZDdtc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSmZDdcc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSzZDdcc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSmZDdpc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSzZDdpc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSmZDvpp'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['VSSzZDvpp'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(70, 4, 'srednja', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSmZDu'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSzZDu'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSmZDdtc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSzZDdtc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSmZDdcc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSzZDdcc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSmZDdpc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSzZDdpc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSmZDvpp'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['SSSzZDvpp'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(70, 4, 'Niza', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSmZDu'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSzZDu'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $row['NSSmZDdtc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSzZDdtc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSmZDdcc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSzZDdcc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSmZDdpc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSzZDdpc'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSmZDvpp'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, $row['NSSzZDvpp'], 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(4);
//    $pdf->Cell(70, 4, 'Na specijalizaciji', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 4, $row['NASPECmZSu'], 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 4, $row['NASPECzZSu'], 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(4);
//    $pdf->Cell(70, 4, 'Specijalisti', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 4, $row['SPECmZSu'], 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 4, $row['SPECzZSu'], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
        
        
        
        
        
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');


/*$query = "SELECT COUNT(*) as ukupno, "
        . "(SELECT COUNT(*) FROM djel t2 WHERE (t2.titula=42) AND (t2.status LIKE '01%') AND (t2.spec1 = ".$spec["ID"]." or t2.spec2 = ".$spec["ID"]." or t2.spec3 = ".$spec["ID"].")) as prof, "
        . "(SELECT COUNT(*) FROM djel t3 WHERE (t3.titula=10) AND (t3.status LIKE '01%') AND (t3.spec1 = ".$spec["ID"]." or t3.spec2 = ".$spec["ID"]." or t3.spec3 = ".$spec["ID"].")) as doc, "
        . "(SELECT COUNT(*) FROM djel t4 WHERE (t4.titula=12) AND (t4.status LIKE '01%') AND (t4.spec1 = ".$spec["ID"]." or t4.spec2 = ".$spec["ID"]." or t4.spec3 = ".$spec["ID"].")) as dr, "
        . "(SELECT COUNT(*) FROM djel t5 WHERE (t5.titula=32) AND (t5.status LIKE '01%') AND (t5.spec1 = ".$spec["ID"]." or t5.spec2 = ".$spec["ID"]." or t5.spec3 = ".$spec["ID"].")) as mr, "
        . "(SELECT COUNT(*) FROM (SELECT COUNT(*) as rmcount FROM djel t6 INNER JOIN NOMRM ON NOMRM.NAZIV LIKE 'specijalizant ".$spec['NAZIV']."%' ) djel t6 WHERE (t6.RM LIKE 'specijalizant ".$spec['NAZIV']."%') AND (t6.status LIKE '01%') ) as naspec "
        . "FROM djel t1 WHERE t1.spec1 = ".$spec["ID"]." or t1.spec2 = ".$spec["ID"]." or t1.spec3 = ".$spec["ID"]."";	*/