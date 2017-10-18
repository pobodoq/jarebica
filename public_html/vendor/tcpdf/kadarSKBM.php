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
$title = 'KADAR SVEUČILIŠNE KLINIČKE BOLNICE MOSTAR NA DAN';


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
$pdf->SetHeaderData($logo, $logoWidth, $title . " " . date_format($date, 'd.m.Y'));
$pdf->AddPage('L', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);

//4
    $titles = ['Liječnici subspecijalisti', 'Liječnici na subspecijalizaciji', 'Liječnici specijalisti', 'Liječnici na specijalizaciji', 'Stomatolozi specijalisti', 'Liječnici opće prakse', 'VSS zdr. sur.', 'VŠS zdr. sur.', 'VŠS med.', 'SSS med.', 'UKUPNO', 'VSS', 'VŠS', 'SSS', 'VKV', 'KV', 'NK', 'NSS', 'UKUPNO', 'SVEUKUPNO'];
    $pdf->writeHTMLCell(177, 5, '', '', 'ZDRAVSTVENI DJELATNICI I SURADNICI', 1, 0, false, true, 'C', false);
    $pdf->writeHTMLCell(90, 5, '', '', 'ADMINISTRATIVNI I TEHNIČKI DJELATNICI', 1, 0, false, true, 'C', false);
    $pdf->Ln(5);
    $pdf->writeHTMLCell(7,  30, '', '', 'R.B', 1, 0, false, true, 'C', true);
    $pdf->writeHTMLCell(80, 30, '', '', 'OSNOVNE SPECIJALIZACIJE', 1, 0, false, true, 'C', false);
    $x=102;
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
    $allCounters = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
while($clinic = mysqli_fetch_assoc($clinicList)){
//        $query = "SELECT ID FROM djel WHERE djel.klinika LIKE '".$clinic['SIFRA']."%' AND djel.odjel LIKE '".$clinic['SIFRA']."%' AND djel.ODSJEK LIKE '".$clinic['SIFRA']."%' ".$where."";
//        $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.klinika LIKE '".$clinic['SIFRA']."%' OR djel.odjel LIKE '".$clinic['SIFRA']."%' OR djel.odsjek LIKE '".$clinic['SIFRA']."%') ".$where." ";
//        $checkNulls = mysqli_query($con, $query);
//        $checkNulls = mysqli_fetch_assoc($checkNulls);
////        while($fuckme = mysqli_fetch_assoc($checkNulls)){echo $fuckme['kaunt']; echo '<br/>';}
//        if($checkNulls['kaunt']!=='0'){        
//            $fill = $pdf->SetFillColor(160, 160, 160);
//            $pdf->Cell(267, 5, $clinic['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Ln(5);
            
//            $pdf->Cell(267, 5, $clinic['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Ln(5);
//    $query = "SELECT COUNT(*) as ukupno, "
//        . "(SELECT COUNT(*) FROM djel t2 WHERE (t2.titula=42) AND (t2.status LIKE '01%') AND (t2.spec1 = ".$spec["ID"]." or t2.spec2 = ".$spec["ID"]." or t2.spec3 = ".$spec["ID"].")) as prof, "
//        . "(SELECT COUNT(*) FROM djel t3 WHERE (t3.titula=10) AND (t3.status LIKE '01%') AND (t3.spec1 = ".$spec["ID"]." or t3.spec2 = ".$spec["ID"]." or t3.spec3 = ".$spec["ID"].")) as doc, "
//        . "(SELECT COUNT(*) FROM djel t4 WHERE (t4.titula=12) AND (t4.status LIKE '01%') AND (t4.spec1 = ".$spec["ID"]." or t4.spec2 = ".$spec["ID"]." or t4.spec3 = ".$spec["ID"].")) as dr, "
//        . "(SELECT COUNT(*) FROM djel t5 WHERE (t5.titula=34) AND (t5.status LIKE '01%') AND (t5.spec1 = ".$spec["ID"]." or t5.spec2 = ".$spec["ID"]." or t5.spec3 = ".$spec["ID"].")) as mr, "
//        . "(SELECT COUNT(*) FROM djel t6 WHERE (t6.status LIKE '01%') AND (t6.naspec = ".$spec['ID'].")) as naspec "
//        . "FROM djel t1 WHERE (t1.spec1 = ".$spec["ID"]." or t1.spec2 = ".$spec["ID"]." or t1.spec3 = ".$spec["ID"].") AND (t1.status LIKE '01%') ";
    if(isset($_GET['odDZRO']) && isset($_GET['doDZRO'])){
        
    }
    //add where suradnici is null 
    $sql_query = "SELECT COUNT(*) as sveukupno, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t2 "
                    . "WHERE (t2.status LIKE '01%') "
                    . "AND(t2.subspec1 IS NOT NULL) "
                    . "AND (t2.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as subspecs, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t3 "
                    . "WHERE (t3.status LIKE '01%') "
                    . "AND(t3.nasubspec IS NOT NULL) "
                    . "AND(t3.subspec1 IS NULL) "
                    . "AND (t3.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as onsubspecs, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t4 "
                    . "WHERE (t4.status LIKE '01%') "
                    . "AND(t4.spec1 IS NOT NULL "
                    . "AND t4.subspec1 IS NULL "
                    . "AND t4.nasubspec IS NULL) "
                    . "AND (t4.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as specs, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t5 "
                    . "WHERE (t5.status LIKE '01%') "
                    . "AND(t5.naspec IS NOT NULL) "
                    . "AND(t5.spec1 IS NULL) "
                    . "AND (t5.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as onspecs, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t6 "
                    . "WHERE (t6.status LIKE '01%') "
                    . "AND(t6.naspec IS NULL AND t6.nasubspec IS NULL AND t6.SPEC1 IS NULL) "
                    . "AND(RM=122 OR RM=290 OR RM=524) "
                    . "AND(t6.KLINIKA LIKE '".$clinic['SIFRA']."%')) "
            . "as opraksa, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t7 "
                    . "WHERE (t7.status LIKE '01%') "
                    . "AND(t7.NASUBSPEC IS NULL AND t7.SUBSPEC1 IS NULL AND t7.SPEC1 IS NULL AND t7.NASPEC IS NULL) "
                    . "AND(t7.vrsta = 1 OR t7.vrsta =2 OR t7.vrsta =3) "
                    . "AND(RM!=122 AND RM!=290 AND RM!=524)" //lijecnici opce prakse su ovde, sada nisu, isto napraviti za ostale
                    . "AND(t7.ssrm = 15) "
                    . "AND (t7.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as VSSmed, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t8 "
                    . "WHERE (t8.status LIKE '01%') "
                    . "AND(t8.vrsta = 1 OR t8.vrsta =2 OR t8.vrsta =3) "
                    . "AND(t8.ssrm = 19) "
                    . "AND (t8.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as VŠSmed, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t9 "
                    . "WHERE (t9.status LIKE '01%') "
                    . "AND(t9.vrsta = 1 OR t9.vrsta =2 OR t9.vrsta =3) "
                    . "AND(t9.ssrm = 7) "
                    . "AND (t9.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as SSSmed, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t10 "
                    . "WHERE (t10.status LIKE '01%') "
                    . "AND(t10.vrsta = 4 OR t10.vrsta = 5) "
                    . "AND(t10.ssrm = 15) "
                    . "AND (t10.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as VSS, "
//            . "(SELECT COUNT (*) "
//                    . "FROM djel t20 "
//                    . "WHERE (t20.status LIKE '01%') "
//                    . "AND (t20.vrsta = 4 OR t20.vrsta = 5) "
//                    . "AND (t20.ssrm = 19) "
//                    . "AND (t20.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
//            . "as VŠSzs, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t20 "
                    . "WHERE (t20.status LIKE '01%') "
                    . "AND(t20.vrsta = 4 OR t20s.vrsta =5) "
                    . "AND(t20.ssrm = 19) "
                    . "AND (t20.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as VŠSzs, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t11 "
                    . "WHERE (t11.status LIKE '01%') "
                    . "AND(t11.vrsta = 4 OR t11.vrsta =5) "
                    . "AND(t11.ssrm = 19) "
                    . "AND (t11.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as VŠS, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t12 "
                    . "WHERE (t12.status LIKE '01%') "
                    . "AND(t12.vrsta = 4 OR t12.vrsta =5) "
                    . "AND(t12.ssrm = 7) AND (t12.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as SSS, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t13 "
                    . "WHERE (t13.status LIKE '01%') "
                    . "AND(t13.vrsta = 4 OR t13.vrsta =5) "
                    . "AND(t13.ssrm = 12)AND (t13.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as VKV, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t14 "
                    . "WHERE (t14.status LIKE '01%') "
                    . "AND(t14.vrsta = 4 OR t14.vrsta =5) "
                    . "AND(t14.ssrm = 1) AND (t14.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as KV, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t15 "
                    . "WHERE (t15.status LIKE '01%') "
                    . "AND(t15.vrsta = 4 OR t15.vrsta =5) "
                    . "AND(t15.ssrm = 3) AND (t15.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as NK, "
            . "(SELECT COUNT(*) "
                    . "FROM djel t16 "
                    . "WHERE (t16.status LIKE '01%') "
                    . "AND(t16.vrsta = 4 OR t16.vrsta =5) "
                    . "AND(t16.ssrm = 4) AND (t16.KLINIKA LIKE '".$clinic['SIFRA']."%' )) "
            . "as NSS "
            . "FROM djel t1 "
            . "WHERE t1.STATUS LIKE '01%' "
            . "AND t1.KLINIKA LIKE '".$clinic['SIFRA']."%' ";
    
//    $sql_query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
//        . "FROM djel "
//        . "LEFT JOIN nomtit "
//        . "ON djel.TITULA = nomtit.ID "
//        . "LEFT JOIN nomzan "
//        . "ON djel.ZAN = nomzan.ID "
//        . "LEFT JOIN nomrm "
//        . "ON djel.RM = nomrm.ID "
//        . "LEFT join nomskspr "
//        . "ON djel.SKSPR = nomskspr.ID "
//        . "LEFT JOIN nomss "
//        . "ON djel.SS = nomss.ID "
//        . "WHERE djel.klinika LIKE '%".$clinic['SIFRA']."%' AND ODJEL IS NULL ".$where." ORDER BY nomrm.INDEX ";
    $count = mysqli_query($con, $sql_query); 
    $counters = [0, 0, 0];

    while($row =  mysqli_fetch_assoc($count)){
        $counter++;
        $counters[0] = $row['subspecs'] + $row['onsubspecs'] + $row['specs'] + $row['onspecs'] + $row['VSSmed'] + $row['VŠSmed'] + $row['SSSmed']; 
        $counters[1] = $row['VSS'] + $row['VŠS'] + $row['SSS'] + $row['VKV'] + $row['KV'] + $row['NK'] + $row['NSS'];
        $counters[2] = $counters[0] + $counters[1];

        $pdf->Cell(7, 3, $counter, 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(80, 3, $clinic['NAZIV'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['subspecs'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['onsubspecs'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['specs'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['onspecs'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, '', 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['opraksa'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['VSSmed'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['VŠSzs'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['VŠSmed'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['SSSmed'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $counters[0], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['VSS'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['VŠS'], 'RT', 0, 'C', 0, 0, 1);//všs suradnici
        $pdf->Cell(9, 3, $row['VŠS'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['SSS'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['VKV'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['KV'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['NK'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $row['NSS'], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(9, 3, $counters[1], 'RT', 0, 'C', 0, 0, 1);//ukupno
        $pdf->Cell(9, 3, $row['sveukupno'], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(9, 3, $counters[2], 'RT', 0, 'C', 0, 0, 1);

        $pdf->Ln(3);  
        $allCounters[0] += $row['subspecs'];
        $allCounters[1] += $row['onsubspecs'];
        $allCounters[2] += $row['specs'];
        $allCounters[3] += $row['onspecs'];
        $allCounters[4] += 0;
        $allCounters[5] += $row['opraksa'];
        $allCounters[6] += $row['VSSmed'];
        $allCounters[7] += $row['VŠSmed'];
        $allCounters[8] += $row['SSSmed'];
        $allCounters[9] += $counters[0];
        $allCounters[10] += $row['VSS'];
        $allCounters[11] += $row['VŠSzs'];
        $allCounters[12] += $row['VŠS'];
        $allCounters[13] += $row['SSS'];
        $allCounters[14] += $row['VKV'];
        $allCounters[15] += $row['KV'];
        $allCounters[16] += $row['NK'];
        $allCounters[17] += $row['NSS'];
        $allCounters[18] += $counters[1];
        $allCounters[19] += $row['sveukupno'];
//        $allCounters[19] += $counters[2];
    }
}
    $pdf->Cell(87, 3, 'UKUPNO', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[0], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[1], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[2], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[3], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[4], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[5], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[6], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[7], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[8], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[9], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[10], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[11], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[12], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[13], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[14], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[15], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[16], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[17], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[18], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(9, 3, $allCounters[19], 'RT', 0, 'C', 0, 0, 1);
    //$pdf->Cell(9, 3, $allCounters[19], 'RT', 0, 'C', 0, 0, 1);
    $pdf->lastPage();
    $pdf->Output('example_005.pdf', 'I');