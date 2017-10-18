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
$pdf->SetHeaderData($logo, $logoWidth, "", PHP_EOL . 'Djelatnici zaposleni u zdravstvenim ustanovama prema stupnju stručne spreme i profilu po općinama');
$pdf->AddPage('L', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);


















        $sql_query = "SELECT "
        . "(SELECT COUNT(*) FROM djel t2 WHERE t2.status LIKE '01%' AND t2.naspec IS NULL AND t2.SPEC1 IS NULL AND(t2.RM=122 OR t2.RM=290 OR t2.RM=524)) as oPraksa, "
        . "(SELECT COUNT(*) FROM djel t22 WHERE t22.status LIKE '01%' AND t22.SPEC1 IS NOT NULL  AND t22.NASPEC IS NULL AND t22.SPEC1!=38) as spec, "
        . "(SELECT COUNT(*) FROM djel t12 WHERE t12.status LIKE '01%' AND t12.naspec IS NOT NULL AND t12.SPEC1 IS NULL AND t12.SUBSPEC1 IS NULL AND t12.BRD != 3525 AND t12.BRD != 3524 AND t12.BRD != 3523) as naspec, " 
        . "(SELECT COUNT(*) FROM djel t4 WHERE t4.status LIKE '01%' AND (t4.RM = 212 OR t4.RM = 128 OR t4.RM = 628) AND t4.spec1 IS NULL AND t4.naspec IS NULL) as diplfarm, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE t24.status LIKE '01%' AND t24.spec1 IS NULL AND t24.naspec=47 AND t24.BRD!=3526) as naspecfarm, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE t25.status LIKE '01%' AND t25.spec1=47 AND t25.BRD!=1242) as specfarm, "
        . "(SELECT COUNT(*) "
        . "FROM djel t3 "
        . "WHERE t3.STATUS LIKE '01%' "
        . "AND (t3.RM=7 "
        . "OR t3.RM=355 "
        . "OR t3.RM=537 "
        . "OR t3.RM=543 "
        . "OR t3.RM=218 "
        . "OR t3.RM=490 "
        . "OR t3.RM=634 "
        . "OR t3.RM=296 "
        . "OR t3.RM=435 "
        . "OR t3.RM=468 "
        . "OR t3.RM=489 "
        . "OR t3.RM=554 "
        . "OR t3.RM=332 "
        . "OR t3.RM=601 "
        . "OR t3.RM=408 "
        . "OR t3.RM=511 "
        . "OR t3.RM=559 "
        . "OR t3.RM=344 "
        . "OR t3.RM=561 "
        . "OR t3.RM=472 "
        . "OR t3.RM=510 "
        . "OR t3.RM=555 "
        . "OR t3.RM=598 "
        . "OR t3.RM=6 "
        . "OR t3.RM=583 "
        . "OR t3.RM=536 "
        . "OR t3.RM=297 "
        . "OR t3.RM=309 "
        . "OR t3.RM=324 "
        . "OR t3.RM=349 "
        . "OR t3.RM=358 "
        . "OR t3.RM=382 "
        . "OR t3.RM=389 "
        . "OR t3.RM=392 "
        . "OR t3.RM=460 "
        . "OR t3.RM = 591 "
        . "OR t3.BRD = 2729 "
        . "OR t3.BRD = 2310 ) "
        . ") as opciSmjerVUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t13 "
        . "WHERE t13.STATUS LIKE '01%' " //uposleni u skbm
//        . "AND SPEC1 IS NULL AND NASPEC IS NULL AND SUBSPEC1 IS NULL AND NASUBSPEC IS NULL " 
//        . "AND t13.VRSTA = 1 " //medicinsko osoblje
//        . "AND t2.SSRM = 15 " //medicinsko osoblje
        . "AND (t13.RM=148 "
        . "OR t13.RM=173 "
        . "OR t13.RM=8 "
        . "OR t13.RM=475 "
        . "OR t13.RM=505 "
        . "OR t13.RM=553 "
        . "OR t13.RM=549 "
        . "OR t13.RM=563 "
        . "OR t13.RM=564 "
        . "OR t13.RM=556 "
        . "OR t13.RM=362 "
        . "OR t13.RM=428 "
        . "OR t13.RM=557 "
        . "OR t13.RM=558 "
        . "OR t13.RM=68 "
        . "OR t13.RM=195 "
        . "OR t13.RM=210 "
        . "OR t13.RM=211 "
        . "OR t13.RM=238 "
        . "OR t13.RM=245 "
        . "OR t13.RM=307 "
        . "OR t13.RM=308 "
        . "OR t13.RM=312 "
        . "OR t13.RM=317 "
        . "OR t13.RM=321 "
        . "OR t13.RM=326 "
        . "OR t13.RM=327 "
        . "OR t13.RM=345 "
        . "OR t13.RM=354 "
        . "OR t13.RM=361 "
        . "OR t13.RM=366 "
        . "OR t13.RM=371 "
        . "OR t13.RM=373 "
        . "OR t13.RM=376 "
        . "OR t13.RM=390 ) "
        . ") as opciSmjerSUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t53 "
        . "WHERE t53.STATUS LIKE '01%' " 
        . "AND (t53.RM=168 "
        . "OR t53.RM=21 "
        . "OR t53.RM=172 "
        . "OR t53.RM=658 "
        . "OR t53.RM=580) "
        . ") as RTGVUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t63 "
        . "WHERE t63.STATUS LIKE '01%' " 
        . "AND t63.RM=22 "
        . ") as RTGSUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t73 "
        . "WHERE t73.STATUS LIKE '01%' " 
        . "AND (t73.RM=365 "         
        . "OR t73.RM=410 "
        . "OR t73.RM=71) "
        . ") as FTPVUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t133 "
        . "WHERE t133.STATUS LIKE '01%' " 
        . "AND (t133.RM=73) "         
        . ") as FTPSUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t83 "
        . "WHERE t83.STATUS LIKE '01%' " 
        . "AND (t83.RM=464 "
        . "OR t83.RM=137) "
        . ") as FARMSUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t93 "
        . "WHERE t93.STATUS LIKE '01%' " 
        . "AND (t93.RM=147 "
        . "OR t93.RM=478) "
        . ") as SANITARNIVUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t103 "
        . "WHERE t103.STATUS LIKE '01%' " 
        . "AND (t103.RM=130 "
        . ") "
        . ") as SANITARNISUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t33 "
        . "WHERE t33.STATUS LIKE '01%' " 
        . "AND (t33.RM=189) "
        . ") as RTTVUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t23 "
        . "WHERE t23.STATUS LIKE '01%' " 
        . "AND (t23.RM=30 "
        . "OR t23.RM=6 "
        . "OR t23.RM=363 "
        . "OR t23.RM=562 "
        . "OR t23.RM=341 "
        . "OR t23.RM=653) "
        . ") as PrimaljeSUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t113 "
        . "WHERE t113.STATUS LIKE '01%' "  
        . "AND (t113.RM=496 "
        . "OR t113.RM=127 "
        . "OR t113.RM=26 "
        . "OR t113.RM=622 "
        . "OR t113.RM=603 "
        . "OR t113.RM=194 "
        . "OR t113.RM=603 "
        . "OR t113.RM=588 "
        . "OR t113.RM=360 "
        . "OR t113.RM=26 "
        . "OR t113.RM=657 "
        . "OR t113.RM=659 "
        . "OR t113.RM=622) "
        . ") as LABVUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t123 "
        . "WHERE t123.STATUS LIKE '01%' " 
        . "AND (t123.RM=27 "
        . "OR t123.RM=357) "
        . ") as LABSUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t200 "
        . "WHERE t200.STATUS LIKE '01%' "
        . "AND RM = 607 "
        . ") as OstaloVUk, "
        . "(SELECT COUNT(*) "
        . "FROM djel t143 "
        . "WHERE t143.STATUS LIKE '01%' " 
        . "AND (t143.RM=499 "
        . "OR t143.RM=284) "
        . ") as OstaloSUk, "
        . "(SELECT COUNT(*) FROM djel t300 "
        . "WHERE t300.STATUS LIKE '01%' "
        . "AND t300.SSRM = 15 "
        . "AND t300.VRSTA = 4 "
        . ") as admVSS, "
        . "(SELECT COUNT(*) FROM djel t301 "
        . "WHERE t301.STATUS LIKE '01%' "
        . "AND t301.SSRM = 19 "
        . "AND t301.VRSTA = 4 "
        . ") as admVŠS, "
        . "(SELECT COUNT(*) FROM djel t302 "
        . "WHERE t302.STATUS LIKE '01%' "
        . "AND t302.SSRM = 7 "
        . "AND t302.VRSTA = 4 "
        . ") as admSSS, "
        . "(SELECT COUNT(*) FROM djel t303 "
        . "WHERE t303.STATUS LIKE '01%' "
        . "AND t303.SSRM = 4 "
        . "AND t303.VRSTA = 4 "
        . ") as admNSS, "
        . "(SELECT COUNT(*) FROM djel t304 "
        . "WHERE t304.STATUS LIKE '01%' "
        . "AND t304.SSRM = 1 "
        . "AND t304.VRSTA = 4 "
        . ") as admKV, "
        . "(SELECT COUNT(*) FROM djel t305 "
        . "WHERE t305.STATUS LIKE '01%' "
        . "AND t305.SSRM = 3 "
        . "AND t305.VRSTA = 4 "
        . ") as admNK, "
        . "(SELECT COUNT(*) FROM djel t306 "
        . "WHERE t306.STATUS LIKE '01%' "
        . "AND t306.SSRM = 12 "
        . "AND t306.VRSTA = 4 "
        . ") as admVKV "
        . "FROM djel";      
        
    $result = mysqli_query($con, $sql_query);
    if(!$result){
        echo mysqli_errno($con) . mysqli_error($con);
    }else{
        $row = mysqli_fetch_assoc($result);
    }

        
        
        //$pdf->StartTransform();
//$pdf->Rotate(-90);
//$pdf->Cell(0,0,'This is a sample data',1,1,'L',0,'');
//$pdf->StopTransform();
$pdf->Cell(79, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(168, 4, 'Zdravstveni djelatnici', 'TL', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(79, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(120, 4, 's visokom stručnom spremom', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(48, 4, 's višom stručnom spremom', 'TL', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(79, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 4, 'Doktori medicine', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 4, 'Doktori stomatolozi', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 4, 'Diplomirani farmaceuti', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(48, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(79, 30, 'Zdravstvena ustanova i općina', 'LRB', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 30, '', 'LRB', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(30);
$titles = ['Svega(kol. 3-6)', 'Doktori medicine', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega(kol. 8-11)', 'Stomatolozi', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega (kol. 13-16)', 'Farmaceuti', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega(kol. 18-28)', 'Med. sestre općeg smjera', 'Pedijatrijske sestre', 'Zubni tehničari', 'Rentgen tehničari', 'Fizioterapeutski tehničari'];
    $x=114;
    $y=69;
    for($i=0;$i<count($titles);$i++){
        if($i<15){
            $pdf->SetXY($x, $y);
            $x += 8;
            $pdf->StartTransform();
            $pdf->Rotate(90);
            $pdf->writeHTMLCell(30, 8, '', '', $titles[$i], 1, 0, false, true, 'C', false);
            $pdf->StopTransform();            
        }else{
            $pdf->SetXY($x, $y);
            $x += 8;
            $pdf->StartTransform();
            $pdf->Rotate(90);
            $pdf->writeHTMLCell(34, 8, '', '', $titles[$i], 1, 0, false, true, 'C', false);
            $pdf->StopTransform();
        }
    }   
    $pdf->Ln(1);
  $pdf->Cell(79, 4, '0', 'LRTB', 0, 'C', 0, 0, 1);  
  $pdf->Cell(20, 4, '1', 'LRTB', 0, 'C', 0, 0, 1);
  for($i=2;$i<23;$i++){
      $pdf->Cell(8, 4, $i, 'LRTB', 0, 'C', 0, 0, 1);
  }
  $pdf->Ln(5);
  $pdf->Cell(79, 7, 'UKUPNO', 'LRTB', 0, 'C', 0, 0, 1);  
  $pdf->Cell(20, 7,  $row['oPraksa']+$row['naspec']+$row['spec']+$row['diplfarm']+$row['naspecfarm']+$row['specfarm']+$row['opciSmjerVUk']+$row['RTGVUk']+$row['FTPVUk']+$row['RTTVUk']+$row['SANITARNIVUk']+$row['LABVUk']+$row['opciSmjerSUk']+$row['RTGSUk']+$row['FTPSUk']+$row['FARMSUk']+$row['SANITARNISUk']+$row['PrimaljeSUk']+$row['LABSUk']+$row['OstaloSUk']+$row['OstaloVUk']+$row['admVSS']+$row['admVŠS']+$row['admSSS']+$row['admNSS']+$row['admNK']+$row['admKV']+$row['admVKV'], 'LRTB', 0, 'C', 0, 0, 1);
//  for($i=2;$i<23;$i++){
//      $pdf->Cell(8, 7, '', 'LRTB', 0, 'C', 0, 0, 1);
//  }
//  $pdf->Ln(7);
//      $x=114;
//    $y=69;
//    $pdf->SetXY($x, $y);
//    $pdf->Cell(79, 7, '', 'LRT', 0, 'C', 0, 0, 1); 
//    $pdf->Cell(20, 7, '', 'LRT', 0, 'C', 0, 0, 1); 
    $pdf->Cell(8, 7, $row['oPraksa']+$row['naspec']+$row['spec'], 'LRTB', 0, 'C', 0, 0, 1); 
    $pdf->Cell(8, 7, $row['oPraksa'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['naspec'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['spec'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '1', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '1', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['diplfarm']+$row['naspecfarm']+$row['specfarm'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['diplfarm'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['naspecfarm'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['specfarm'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['opciSmjerVUk']+$row['RTGVUk']+$row['FTPVUk']+$row['RTTVUk']+$row['SANITARNIVUk']+$row['LABVUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['opciSmjerVUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['RTGVUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['FTPVUk'], 'LRTB', 0, 'C', 0, 0, 1);
    
    
    
    

        
      
  
  $pdf->resetHeaderTemplate();
$pdf->SetHeaderData($logo, $logoWidth, "", PHP_EOL . "Djelatnici zaposleni u zdravstvenim ustanovama prema stupnju stručne spreme i profilu po općinama");
$pdf->AddPage('L', 'A4');



//$pdf->Cell(79, 4, '', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(20, 4, '', '', 0, 'C', 0, 0, 1);
//$pdf->Cell(168, 4, 'Zdravstveni djelatnici', 'TL', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);
//$pdf->Cell(79, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(20, 4, '', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(120, 4, 's visokom stručnom spremom', 'TL', 0, 'C', 0, 0, 1);
//$pdf->Cell(48, 4, 's višom stručnom spremom', 'TL', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);
//$pdf->Cell(79, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(20, 4, '', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(40, 4, '', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(40, 4, '', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(40, 4, '', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(48, 4, '', 'T', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);
//$pdf->Cell(79, 30, 'Specijalnost', 'LRB', 0, 'C', 0, 0, 1);
//$pdf->Cell(20, 30, '', 'LRB', 0, 'C', 0, 0, 1);
//$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(168, 4, 'Zdravstveni djelatnici', 'LRB', 0, 'C', 0, 0, 1);
$pdf->Cell(32, 8, 'Zdravstveni suradnici', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(64, 8, 'Administrativni i tehnički djelatnici', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(40, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(56, 4, 's višom stručnom spremom', 'LRB', 0, 'C', 0, 0, 1);
$pdf->Cell(104, 4, 'sa srednjom stručnom spremom', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$titles = ["Farmaceutski tehničari", "Sanitarni tehničari", "Radnoterapeutski tehničari", "Med. sestre primaljskog smjera", "Laboratorijski tehničari", "Ostali zdr. djelatnici", "Svega(kol. 30-42)", "Med. sestre općeg smjera", "Pedijatrijske sestre", "Stomatološke sestre", "Med.sestre ortoptičari", "Zubni tehničari", "Rentgen tehničari", "Fizioterapeutski tehničari", "Farmaceutski tehničari", "Sanitarni tehničari", "Radnoterapeutski tehničari", "Med. Sestre primaljskog smjera", "Laboratorijski tehničari", "Ostali zdr. djelatnici", "S nižom spremom", "Svega(kol. 45-47)", "S visokom spremom", "S višom spremom", "Sa srednjom spremom", "Svega(kol. 49-52)", "S visokom spremom", "S višom spremom", "Sa srednjom spremom", "S nižom spremom", 'Kvalificirani Radnik', 'Nekvalificirani radnik', 'Visoko kvalificirani radnik'];
//$titles = ['Svega(kol. 3-6)', 'Doktori medicine', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega(kol. 8-11)', 'Stomatolozi', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega (kol. 13-16)', 'Farmaceuti', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega(kol. 18-28)', 'Med. sestre općeg smjera', 'Pedijatrijske sestre', 'Zubni tehničari', 'Rentgen tehničari', 'Fizioterapeutski tehničari'];
    $x=15;
    $y=65;
    for($i=0;$i<count($titles);$i++){
        if($i===20){
            $pdf->SetXY($x, $y);
            $x += 8;
            $pdf->StartTransform();
            $pdf->Rotate(90);
            $pdf->writeHTMLCell(34, 8, '', '', $titles[$i], 1, 0, false, true, 'C', false);
            $pdf->StopTransform();  
        }else{
            $pdf->SetXY($x, $y);
            $x += 8;
            $pdf->StartTransform();
            $pdf->Rotate(90);
            $pdf->writeHTMLCell(30, 8, '', '', $titles[$i], 1, 0, false, true, 'C', false);
            $pdf->StopTransform();            
        }
    }   
    $pdf->Ln(1);
  for($i=23;$i<56;$i++){
      $pdf->Cell(8, 4, $i, 'LRTB', 0, 'C', 0, 0, 1);
  }
    $pdf->Ln(5);
//  for($i=23;$i<53;$i++){
//      $pdf->Cell(8, 7, '', 'LRTB', 0, 'C', 0, 0, 1);
//  }
  
      $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['SANITARNIVUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['RTTVUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['LABVUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['OstaloVUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['opciSmjerSUk']+$row['RTGSUk']+$row['FTPSUk']+$row['FARMSUk']+$row['SANITARNISUk']+$row['PrimaljeSUk']+$row['LABSUk']+$row['OstaloSUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['opciSmjerSUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['RTGSUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['FTPSUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['FARMSUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['SANITARNISUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['PrimaljeSUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['LABSUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['OstaloSUk'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['admVSS']+$row['admVŠS']+$row['admSSS']+$row['admNSS']+$row['admNK']+$row['admKV']+$row['admVKV'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['admVSS'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['admVŠS'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['admSSS'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['admNSS'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['admKV'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['admNK'], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(8, 7, $row['admVKV'], 'LRTB', 0, 'C', 0, 0, 1);

//  $pdf->Ln(5);
//  $pdf->Cell(79, 4, 'UKUPNO', 'LRTB', 0, 'C', 0, 0, 1);  
//  $pdf->Cell(20, 4, '', 'LRTB', 0, 'C', 0, 0, 1);
//  for($i=2;$i<23;$i++){
//      $pdf->Cell(8, 4, '', 'LRTB', 0, 'C', 0, 0, 1);
//  }




                    //na specijalizaciji

                                                //stomatolozi
                                                //JEDAN JEBENI STOMATOLOG
                

                            //diplomirani farmaceuti, moras rijesiti specijalizacije iako se te iste specijalizacije vec nalaze pod specijalizacijama


                            //med sestre opceg smjera
                
                
                
                
                
                
                
                
                
$pdf->resetHeaderTemplate();
$pdf->SetHeaderData($logo, $logoWidth, "", PHP_EOL . "Zdravstveni djelatnici s visokom stručnom spremom prema specijalnosti, dobi i spolu");
$pdf->AddPage('P', 'A4');




















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
        . "(SELECT COUNT(*) FROM djel t2 WHERE t2.status LIKE '01%' AND t2.naspec IS NULL AND t2.SPEC1 IS NULL AND(t2.RM=122 OR t2.RM=290 OR t2.RM=524) AND t2.spol=1) as oPraksaAllM, "
        . "(SELECT COUNT(*) FROM djel t3 WHERE t3.status LIKE '01%' AND t3.naspec IS NULL AND t3.SPEC1 IS NULL AND(t3.RM=122 OR t3.RM=290 OR t3.RM=524) AND t3.spol=2) as oPraksaAllZ, "
        . "(SELECT COUNT(*) FROM djel t4 WHERE t4.status LIKE '01%' AND t4.naspec IS NULL AND t4.SPEC1 IS NULL AND(t4.RM=122 OR t4.RM=290 OR t4.RM=524) AND t4.spol=1 AND (DATEDIFF(NOW(), t4.DATUMR) < 12410)) as dotcM, "
        . "(SELECT COUNT(*) FROM djel t5 WHERE t5.status LIKE '01%' AND t5.naspec IS NULL AND t5.SPEC1 IS NULL AND(t5.RM=122 OR t5.RM=290 OR t5.RM=524) AND t5.spol=2 AND (DATEDIFF(NOW(), t5.DATUMR) < 12410)) as dotcZ, "
        . "(SELECT COUNT(*) FROM djel t6 WHERE t6.status LIKE '01%' AND t6.naspec IS NULL AND t6.SPEC1 IS NULL AND(t6.RM=122 OR t6.RM=290 OR t6.RM=524) AND t6.spol=1 AND (DATEDIFF(NOW(), t6.DATUMR) BETWEEN 12410 AND 16059)) as doccM, "
        . "(SELECT COUNT(*) FROM djel t7 WHERE t7.status LIKE '01%' AND t7.naspec IS NULL AND t7.SPEC1 IS NULL AND(t7.RM=122 OR t7.RM=290 OR t7.RM=524) AND t7.spol=2 AND (DATEDIFF(NOW(), t7.DATUMR) BETWEEN 12410 AND 16059)) as doccZ, "
        . "(SELECT COUNT(*) FROM djel t8 WHERE t8.status LIKE '01%' AND t8.naspec IS NULL AND t8.SPEC1 IS NULL AND(t8.RM=122 OR t8.RM=290 OR t8.RM=524) AND t8.spol=1 AND (DATEDIFF(NOW(), t8.DATUMR) BETWEEN 16060 AND 19709)) as dopcM, "
        . "(SELECT COUNT(*) FROM djel t9 WHERE t9.status LIKE '01%' AND t9.naspec IS NULL AND t9.SPEC1 IS NULL AND(t9.RM=122 OR t9.RM=290 OR t9.RM=524) AND t9.spol=2 AND (DATEDIFF(NOW(), t9.DATUMR) BETWEEN 16060 AND 19709)) as dopcZ, "
        . "(SELECT COUNT(*) FROM djel t10 WHERE t10.status LIKE '01%' AND t10.naspec IS NULL AND t10.SPEC1 IS NULL AND(t10.RM=122 OR t10.RM=290 OR t10.RM=524) AND t10.spol=1 AND (DATEDIFF(NOW(), t10.DATUMR)>= 19710)) as viseppM, "
        . "(SELECT COUNT(*) FROM djel t11 WHERE t11.status LIKE '01%' AND t11.naspec IS NULL AND t11.SPEC1 IS NULL AND(t11.RM=122 OR t11.RM=290 OR t11.RM=524) AND t11.spol=2 AND (DATEDIFF(NOW(), t11.DATUMR)>= 19710)) as viseppZ, "
        . "(SELECT COUNT(*) FROM djel t12 WHERE t12.status LIKE '01%' AND t12.naspec IS NOT NULL AND t12.SPEC1 IS NULL AND t12.SUBSPEC1 IS NULL AND t12.spol=1) as naspecM, "
        . "(SELECT COUNT(*) FROM djel t13 WHERE t13.status LIKE '01%' AND t13.naspec IS NOT NULL AND t13.SPEC1 IS NULL AND t13.SUBSPEC1 IS NULL AND t13.spol=2) as naspecZ, "
        . "(SELECT COUNT(*) FROM djel t14 WHERE t14.status LIKE '01%' AND t14.naspec IS NOT NULL AND t14.SPEC1 IS NULL AND t14.SUBSPEC1 IS NULL AND t14.spol=1 AND (DATEDIFF(NOW(), t14.DATUMR) < 12410)) as naspecdotcM, "
        . "(SELECT COUNT(*) FROM djel t15 WHERE t15.status LIKE '01%' AND t15.naspec IS NOT NULL AND t15.SPEC1 IS NULL AND t15.SUBSPEC1 IS NULL AND t15.spol=2 AND (DATEDIFF(NOW(), t15.DATUMR) < 12410)) as naspecdotcZ, "
        . "(SELECT COUNT(*) FROM djel t16 WHERE t16.status LIKE '01%' AND t16.naspec IS NOT NULL AND t16.SPEC1 IS NULL AND t16.SUBSPEC1 IS NULL AND t16.spol=1 AND (DATEDIFF(NOW(), t16.DATUMR) BETWEEN 12410 AND 16059)) as naspecdoccM, "
        . "(SELECT COUNT(*) FROM djel t17 WHERE t17.status LIKE '01%' AND t17.naspec IS NOT NULL AND t17.SPEC1 IS NULL AND t17.SUBSPEC1 IS NULL AND t17.spol=2 AND (DATEDIFF(NOW(), t17.DATUMR) BETWEEN 12410 AND 16059)) as naspecdoccZ, "
        . "(SELECT COUNT(*) FROM djel t18 WHERE t18.status LIKE '01%' AND t18.naspec IS NOT NULL AND t18.SPEC1 IS NULL AND t18.SUBSPEC1 IS NULL AND t18.spol=1 AND (DATEDIFF(NOW(), t18.DATUMR) BETWEEN 16060 AND 19709)) as naspecdopcM, "
        . "(SELECT COUNT(*) FROM djel t19 WHERE t19.status LIKE '01%' AND t19.naspec IS NOT NULL AND t19.SPEC1 IS NULL AND t19.SUBSPEC1 IS NULL AND t19.spol=2 AND (DATEDIFF(NOW(), t19.DATUMR) BETWEEN 16060 AND 19709)) as naspecdopcZ, "
        . "(SELECT COUNT(*) FROM djel t20 WHERE t20.status LIKE '01%' AND t20.naspec IS NOT NULL AND t20.SPEC1 IS NULL AND t20.SUBSPEC1 IS NULL AND t20.spol=1 AND (DATEDIFF(NOW(), t20.DATUMR)>= 19710)) as naspecviseppM, "
        . "(SELECT COUNT(*) FROM djel t21 WHERE t21.status LIKE '01%' AND t21.naspec IS NOT NULL AND t21.SPEC1 IS NULL AND t21.SUBSPEC1 IS NULL AND t21.spol=2 AND (DATEDIFF(NOW(), t21.DATUMR)>= 19710)) as naspecviseppZ, "
        . "(SELECT COUNT(*) FROM djel t22 WHERE t22.status LIKE '01%' AND t22.SPEC1 IS NOT NULL AND t22.SUBSPEC1 IS NULL AND t22.NASPEC IS NULL  AND t22.BRD != 3525 AND t22.BRD != 3524 AND t22.BRD != 3523 AND t22.SPEC1!=38 AND t22.spol=1) as specM, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE t23.status LIKE '01%' AND t23.SPEC1 IS NOT NULL AND t23.SUBSPEC1 IS NULL AND t23.NASPEC IS NULL AND t23.spol=2) as specZ, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE t24.status LIKE '01%' AND t24.SPEC1 IS NOT NULL AND t24.SUBSPEC1 IS NULL AND t24.NASPEC IS NULL AND t24.spol=1 AND t24.SPEC1!=38 AND (DATEDIFF(NOW(), t24.DATUMR) < 12410)) as specdotcM, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE t25.status LIKE '01%' AND t25.SPEC1 IS NOT NULL AND t25.SUBSPEC1 IS NULL AND t25.NASPEC IS NULL AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR) < 12410)) as specdotcZ, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE t26.status LIKE '01%' AND t26.SPEC1 IS NOT NULL AND t26.SUBSPEC1 IS NULL AND t26.NASPEC IS NULL AND t26.spol=1 AND t26.SPEC1!=38 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as specdoccM, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE t27.status LIKE '01%' AND t27.SPEC1 IS NOT NULL AND t27.SUBSPEC1 IS NULL AND t27.NASPEC IS NULL AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as specdoccZ, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE t28.status LIKE '01%' AND t28.SPEC1 IS NOT NULL AND t28.SUBSPEC1 IS NULL AND t28.NASPEC IS NULL AND t28.spol=1 AND t28.SPEC1!=38 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as specdopcM, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE t29.status LIKE '01%' AND t29.SPEC1 IS NOT NULL AND t29.SUBSPEC1 IS NULL AND t29.NASPEC IS NULL AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as specdopcZ, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE t30.status LIKE '01%' AND t30.SPEC1 IS NOT NULL AND t30.SUBSPEC1 IS NULL AND t30.NASPEC IS NULL AND t30.spol=1 AND t30.SPEC1!=38 AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as specviseppM, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE t31.status LIKE '01%' AND t31.SPEC1 IS NOT NULL AND t31.SUBSPEC1 IS NULL AND t31.NASPEC IS NULL AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as specviseppZ "
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
        if($spec['ID']==='47'){
            
        }else{
           $sql_query = "SELECT COUNT(*), "
            . "(SELECT COUNT(*) FROM djel t22 WHERE t22.status LIKE '01%' AND (t22.SPEC1 = ".$spec['ID'].") AND t22.spol=1 AND t22.SUBSPEC1 IS NULL) as specMU, "
            . "(SELECT COUNT(*) FROM djel t23 WHERE t23.status LIKE '01%' AND (t23.SPEC1 = ".$spec['ID'].") AND t23.spol=2 AND t23.SUBSPEC1 IS NULL) as specZE, "
            . "(SELECT COUNT(*) FROM djel t24 WHERE t24.status LIKE '01%' AND (t24.SPEC1 = ".$spec['ID'].") AND t24.spol=1 AND t24.SUBSPEC1 IS NULL AND t24.NASPEC IS NULL AND (DATEDIFF(NOW(), t24.DATUMR) < 12410)) as specdotcMU, "
            . "(SELECT COUNT(*) FROM djel t25 WHERE t25.status LIKE '01%' AND (t25.SPEC1 = ".$spec['ID'].") AND t25.spol=2 AND t25.SUBSPEC1 IS NULL AND t25.NASPEC IS NULL AND (DATEDIFF(NOW(), t25.DATUMR) < 12410)) as specdotcZE, "
            . "(SELECT COUNT(*) FROM djel t26 WHERE t26.status LIKE '01%' AND (t26.SPEC1 = ".$spec['ID'].") AND t26.spol=1 AND t26.SUBSPEC1 IS NULL AND t26.NASPEC IS NULL AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as specdoccMU, "
            . "(SELECT COUNT(*) FROM djel t27 WHERE t27.status LIKE '01%' AND (t27.SPEC1 = ".$spec['ID'].") AND t27.spol=2 AND t27.SUBSPEC1 IS NULL AND t27.NASPEC IS NULL AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as specdoccZE, "
            . "(SELECT COUNT(*) FROM djel t28 WHERE t28.status LIKE '01%' AND (t28.SPEC1 = ".$spec['ID'].") AND t28.spol=1 AND t28.SUBSPEC1 IS NULL AND t28.NASPEC IS NULL AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as specdopcMU, "
            . "(SELECT COUNT(*) FROM djel t29 WHERE t29.status LIKE '01%' AND (t29.SPEC1 = ".$spec['ID'].") AND t29.spol=2 AND t29.SUBSPEC1 IS NULL AND t29.NASPEC IS NULL AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as specdopcZE, "
            . "(SELECT COUNT(*) FROM djel t30 WHERE t30.status LIKE '01%' AND (t30.SPEC1 = ".$spec['ID'].") AND t30.spol=1 AND t30.SUBSPEC1 IS NULL AND t30.NASPEC IS NULL AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as specviseppMU, "
            . "(SELECT COUNT(*) FROM djel t31 WHERE t31.status LIKE '01%' AND (t31.SPEC1 = ".$spec['ID'].") AND t31.spol=2 AND t31.SUBSPEC1 IS NULL AND t31.NASPEC IS NULL AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as specviseppZE "
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
        
//        $pdf->Ln(5);
//       $pdf->Cell(70, 4, 'Doktori stomatologije', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '1', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '0', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '0', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '0', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '0', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '0', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '0', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '0', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '1', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, '0', 'LRT', 0, 'C', 0, 0, 1);
//        
//        $sql_query = "SELECT COUNT(*) FROM djel WHERE (RM = 526 OR RM 128 OR RM = 628)";
       $sql_query = "SELECT "
        . "(SELECT COUNT(*) FROM djel t22 WHERE t22.status LIKE '01%' AND (t22.RM = 212 OR t22.RM = 128 OR t22.RM = 628) AND t22.spol=1) as farmMU, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE t23.status LIKE '01%' AND (t23.RM = 212 OR t23.RM = 128 OR t23.RM = 628) AND t23.spol=2) as farmZE, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE t24.status LIKE '01%' AND (t24.RM = 212 OR t24.RM = 128 OR t24.RM = 628) AND t24.spol=1 AND (DATEDIFF(NOW(), t24.DATUMR) < 12410)) as farmdotcMU, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE t25.status LIKE '01%' AND (t25.RM = 212 OR t25.RM = 128 OR t25.RM = 628) AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR) < 12410)) as farmdotcZE, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE t26.status LIKE '01%' AND (t26.RM = 212 OR t26.RM = 128 OR t26.RM = 628) AND t26.spol=1 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as farmdoccMU, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE t27.status LIKE '01%' AND (t27.RM = 212 OR t27.RM = 128 OR t27.RM = 628) AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as farmdoccZE, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE t28.status LIKE '01%' AND (t28.RM = 212 OR t28.RM = 128 OR t28.RM = 628) AND t28.spol=1 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as farmdopcMU, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE t29.status LIKE '01%' AND (t29.RM = 212 OR t29.RM = 128 OR t29.RM = 628) AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as farmdopcZE, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE t30.status LIKE '01%' AND (t30.RM = 212 OR t30.RM = 128 OR t30.RM = 628) AND t30.spol=1 AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as farmviseppMU, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE t31.status LIKE '01%' AND (t31.RM = 212 OR t31.RM = 128 OR t31.RM = 628) AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as farmviseppZE "
        . "FROM djel WHERE ID IS NOT NULL";
//       echo $sql_query;
       $results = mysqli_query($con, $sql_query);
       $rows = mysqli_fetch_array($results);
       $pdf->Ln(10);
       $pdf->Cell(70, 4, 'Diplomirani farmaceuti', 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmMU'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmZE'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, $rows['farmviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
        
        
        
$pdf->resetHeaderTemplate();
$pdf->SetHeaderData($logo, $logoWidth, "", PHP_EOL .  "Zdravstveni djelatnici s visokom stručnom spremom prema specijalnosti, dobi i spolu");
$pdf->AddPage('P', 'A4');   

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

$sql_query = "SELECT * FROM subspecijalizacija";
$result = mysqli_query($con, $sql_query);
$suma=0;
$counter=0;
$counters = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    while($spec = mysqli_fetch_assoc($result)){
       $sql_query = "SELECT COUNT(*), "
        . "(SELECT COUNT(*) FROM djel t22 WHERE t22.status LIKE '01%' AND t22.SUBSPEC1 = ".$spec['ID']." AND t22.spol=1) as subspecMU, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE t23.status LIKE '01%' AND t23.SUBSPEC1 = ".$spec['ID']." AND t23.spol=2) as subspecZE, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE t24.status LIKE '01%' AND t24.SUBSPEC1 = ".$spec['ID']." AND t24.spol=1 AND (DATEDIFF(NOW(), t24.DATUMR)< 12410)) as subspecdotcMU, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE t25.status LIKE '01%' AND t25.SUBSPEC1 = ".$spec['ID']." AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR)< 12410)) as subspecdotcZE, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE t26.status LIKE '01%' AND t26.SUBSPEC1 = ".$spec['ID']." AND t26.spol=1 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as subspecdoccMU, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE t27.status LIKE '01%' AND t27.SUBSPEC1 = ".$spec['ID']." AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as subspecdoccZE, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE t28.status LIKE '01%' AND t28.SUBSPEC1 = ".$spec['ID']." AND t28.spol=1 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as subspecdopcMU, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE t29.status LIKE '01%' AND t29.SUBSPEC1 = ".$spec['ID']." AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as subspecdopcZE, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE t30.status LIKE '01%' AND t30.SUBSPEC1 = ".$spec['ID']." AND t30.spol=1 AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as subspecviseppMU, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE t31.status LIKE '01%' AND t31.SUBSPEC1 = ".$spec['ID']." AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as subspecviseppZE "
        . "FROM djel WHERE ID IS NOT NULL";
       $response = mysqli_query($con, $sql_query);
       if(!$response){
           echo mysqli_errno($con) . mysqli_error($con);
       }
       else{
       $pdf->Cell(70, 4, $spec['NAZIV'], 'LRT', 0, 'C', 0, 0, 1);
        while($row = mysqli_fetch_assoc($response)){
            $counters[0] = $counters[0] + $row['subspecMU'];
            $counters[1] = $counters[1] + $row['subspecZE'];
            $counters[2] = $counters[2] + $row['subspecdotcMU'];
            $counters[3] = $counters[3] + $row['subspecdotcZE'];
            $counters[4] = $counters[4] + $row['subspecdoccMU'];
            $counters[5] = $counters[5] + $row['subspecdoccZE'];
            $counters[6] = $counters[6] + $row['subspecdopcMU'];
            $counters[7] = $counters[7] + $row['subspecdopcZE'];
            $counters[8] = $counters[8] + $row['subspecviseppMU'];
            $counters[9] = $counters[9] + $row['subspecviseppZE'];
            $pdf->Cell(11, 4, $row['subspecMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
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

       
//       $sql_query = "SELECT "
//        . "(SELECT COUNT(*) FROM djel t22 WHERE t22.status LIKE '01%' AND t22.SSRM = 15 AND t22.spol=1 AND t22.SURADNICI IS NOT NULL) as suradniciVMU, "
//        . "(SELECT COUNT(*) FROM djel t23 WHERE t23.status LIKE '01%' AND t23.SSRM = 15 AND t23.spol=2 AND t23.SURADNICI IS NOT NULL) as suradniciVZE, "
//        . "(SELECT COUNT(*) FROM djel t24 WHERE t24.status LIKE '01%' AND t24.SSRM = 15 AND t24.spol=1 AND t24.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t24.DATUMR) BETWEEN 1000 AND 12410)) as suradniciVdotcMU, "
//        . "(SELECT COUNT(*) FROM djel t25 WHERE t25.status LIKE '01%' AND t25.SSRM = 15 AND t25.spol=2 AND t25.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t25.DATUMR)< 12410)) as suradniciVdotcZE, "
//        . "(SELECT COUNT(*) FROM djel t26 WHERE t26.status LIKE '01%' AND t26.SSRM = 15 AND t26.spol=1 AND t26.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as suradniciVdoccMU, "
//        . "(SELECT COUNT(*) FROM djel t27 WHERE t27.status LIKE '01%' AND t27.SSRM = 15 AND t27.spol=2 AND t27.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as suradniciVdoccZE, "
//        . "(SELECT COUNT(*) FROM djel t28 WHERE t28.status LIKE '01%' AND t28.SSRM = 15 AND t28.spol=1 AND t28.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as suradniciVdopcMU, "
//        . "(SELECT COUNT(*) FROM djel t29 WHERE t29.status LIKE '01%' AND t29.SSRM = 15 AND t29.spol=2 AND t29.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as suradniciVdopcZE, "
//        . "(SELECT COUNT(*) FROM djel t30 WHERE t30.status LIKE '01%' AND t30.SSRM = 15 AND t30.spol=1 AND t30.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t30.DATUMR)>= 19709)) as suradniciVviseppMU, "
//        . "(SELECT COUNT(*) FROM djel t31 WHERE t31.status LIKE '01%' AND t31.SSRM = 15 AND t31.spol=2 AND t31.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t31.DATUMR)>= 19709)) as suradniciVviseppZE, "
//        . "(SELECT COUNT(*) FROM djel t32 WHERE t32.status LIKE '01%' AND t32.NASPEC IS NOT NULL AND t32.SPEC1 IS NULL AND t32.spol=1 AND t32.SURADNICI IS NOT NULL) as suradniciNaspecMU, "
//        . "(SELECT COUNT(*) FROM djel t33 WHERE t33.status LIKE '01%' AND t33.NASPEC IS NOT NULL AND t33.SPEC1 IS NULL AND t33.spol=2 AND t33.SURADNICI IS NOT NULL) as suradniciNaspecZE, "
//        . "(SELECT COUNT(*) FROM djel t34 WHERE t34.status LIKE '01%' AND t34.NASPEC IS NOT NULL AND t34.SPEC1 IS NULL AND t34.spol=1 AND t34.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t34.DATUMR) BETWEEN 1000 AND 12410)) as suradniciNaspecdotcMU, "
//        . "(SELECT COUNT(*) FROM djel t35 WHERE t35.status LIKE '01%' AND t35.NASPEC IS NOT NULL AND t35.SPEC1 IS NULL AND t35.spol=2 AND t35.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t35.DATUMR)< 12410)) as suradniciNaspecdotcZE, "
//        . "(SELECT COUNT(*) FROM djel t36 WHERE t36.status LIKE '01%' AND t36.NASPEC IS NOT NULL AND t36.SPEC1 IS NULL AND t36.spol=1 AND t36.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t36.DATUMR) BETWEEN 12410 AND 16059)) as suradniciNaspecdoccMU, "
//        . "(SELECT COUNT(*) FROM djel t37 WHERE t37.status LIKE '01%' AND t37.NASPEC IS NOT NULL AND t37.SPEC1 IS NULL AND t37.spol=2 AND t37.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t37.DATUMR) BETWEEN 12410 AND 16059)) as suradniciNaspecdoccZE, "
//        . "(SELECT COUNT(*) FROM djel t38 WHERE t38.status LIKE '01%' AND t38.NASPEC IS NOT NULL AND t38.SPEC1 IS NULL AND t38.spol=1 AND t38.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t38.DATUMR) BETWEEN 16060 AND 19709)) as suradniciNaspecdopcMU, "
//        . "(SELECT COUNT(*) FROM djel t39 WHERE t39.status LIKE '01%' AND t39.NASPEC IS NOT NULL AND t39.SPEC1 IS NULL AND t39.spol=2 AND t39.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t39.DATUMR) BETWEEN 16060 AND 19709)) as suradniciNaspecdopcZE, "
//        . "(SELECT COUNT(*) FROM djel t40 WHERE t40.status LIKE '01%' AND t40.NASPEC IS NOT NULL AND t40.SPEC1 IS NULL AND t40.spol=1 AND t40.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t40.DATUMR)>= 19709)) as suradniciNaspecviseppMU, "
//        . "(SELECT COUNT(*) FROM djel t41 WHERE t41.status LIKE '01%' AND t41.NASPEC IS NOT NULL AND t41.SPEC1 IS NULL AND t41.spol=2 AND t41.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t41.DATUMR)>= 19709)) as suradniciNaspecviseppZE, "
//        . "(SELECT COUNT(*) FROM djel t42 WHERE t42.status LIKE '01%' AND t42.SPEC1 IS NOT NULL AND t42.spol=1 AND t42.SURADNICI IS NOT NULL) as suradniciSpecMU, "
//        . "(SELECT COUNT(*) FROM djel t43 WHERE t43.status LIKE '01%' AND t43.SPEC1 IS NOT NULL AND t43.spol=2 AND t43.SURADNICI IS NOT NULL) as suradniciSpecZE, "
//        . "(SELECT COUNT(*) FROM djel t44 WHERE t44.status LIKE '01%' AND t44.SPEC1 IS NOT NULL AND t44.spol=1 AND t44.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t44.DATUMR) BETWEEN 1000 AND 12410)) as suradniciSpecdotcMU, "
//        . "(SELECT COUNT(*) FROM djel t45 WHERE t45.status LIKE '01%' AND t45.SPEC1 IS NOT NULL AND t45.spol=2 AND t45.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t45.DATUMR)< 12410)) as suradniciSpecdotcZE, "
//        . "(SELECT COUNT(*) FROM djel t46 WHERE t46.status LIKE '01%' AND t46.SPEC1 IS NOT NULL AND t46.spol=1 AND t46.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t46.DATUMR) BETWEEN 12410 AND 16059)) as suradniciSpecdoccMU, "
//        . "(SELECT COUNT(*) FROM djel t47 WHERE t47.status LIKE '01%' AND t47.SPEC1 IS NOT NULL AND t47.spol=2 AND t47.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t47.DATUMR) BETWEEN 12410 AND 16059)) as suradniciSpecdoccZE, "
//        . "(SELECT COUNT(*) FROM djel t48 WHERE t48.status LIKE '01%' AND t48.SPEC1 IS NOT NULL AND t48.spol=1 AND t48.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t48.DATUMR) BETWEEN 16060 AND 19709)) as suradniciSpecdopcMU, "
//        . "(SELECT COUNT(*) FROM djel t49 WHERE t49.status LIKE '01%' AND t49.SPEC1 IS NOT NULL AND t49.spol=2 AND t49.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t49.DATUMR) BETWEEN 16060 AND 19709)) as suradniciSpecdopcZE, "
//        . "(SELECT COUNT(*) FROM djel t50 WHERE t50.status LIKE '01%' AND t50.SPEC1 IS NOT NULL AND t50.spol=1 AND t50.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t50.DATUMR)>= 19709)) as suradniciSpecviseppMU, "
//        . "(SELECT COUNT(*) FROM djel t51 WHERE t51.status LIKE '01%' AND t51.SPEC1 IS NOT NULL AND t51.spol=2 AND t51.SURADNICI IS NOT NULL AND (DATEDIFF(NOW(), t51.DATUMR)>= 19709)) as suradniciSpecviseppZE "
//        . "FROM djel WHERE ID IS NOT NULL";
//       
//          $results = mysqli_query($con, $sql_query);
//       $rows = mysqli_fetch_array($results);
//       $pdf->Ln(5);
//       $pdf->Cell(70, 4, 'Visoka sprema', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciVviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
//         $pdf->Ln(5);
//       $pdf->Cell(70, 4, 'Na specijalizaciji', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciNaspecviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
//         $pdf->Ln(5);
//       $pdf->Cell(70, 4, 'Specijalisti', 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 4, $rows['suradniciSpecviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
//        
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
        
//$pdf->resetHeaderTemplate();
//$pdf->SetHeaderData($logo, $logoWidth, "Tablica 3","");
//$pdf->AddPage('P', 'A4');   
//        $query = "SELECT "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t2 "
//        . "WHERE t2.STATUS LIKE '01%' " //uposleni u skbm
////        . "AND SPEC1 IS NULL AND NASPEC IS NULL AND SUBSPEC1 IS NULL AND NASUBSPEC IS NULL " 
//        . "AND t2.SPOL=1 " //muski spol
//        . "AND t2.VRSTA = 1 " //medicinsko osoblje
////        . "AND t2.SSRM = 15 " //medicinsko osoblje
//        . "AND (t2.RM = 7 "
//        . "OR t2.RM = 7 "
//        . "OR t2.RM = 355 "
//        . "OR t2.RM = 537 "
//        . "OR t2.RM = 543) " 
//        . ") as ukupnoMedSM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t3 "
//        . "WHERE t3.STATUS LIKE '01%' "
//        . "AND t3.SPOL = 1 "
////        . "AND t3.VRSTA = 1 "
////        . "AND t3.SSRM = 19 "
//        . "AND (t3.RM=7 "
//        . "OR t3.RM=7 "
//        . "OR t3.RM=355 "
//        . "OR t3.RM=537 "
//        . "OR t3.RM=543 "
//        . "OR t3.RM=218 "
//        . "OR t3.RM=490 "
//        . "OR t3.RM=634 "
//        . "OR t3.RM=296 "
//        . "OR t3.RM=435 "
//        . "OR t3.RM=468 "
//        . "OR t3.RM=489 "
//        . "OR t3.RM=554 "
//        . "OR t3.RM=332 "
//        . "OR t3.RM=601 "
//        . "OR t3.RM=408 "
//        . "OR t3.RM=511 "
//        . "OR t3.RM=559 "
//        . "OR t3.RM=344 "
//        . "OR t3.RM=561 "
//        . "OR t3.RM=472 "
//        . "OR t3.RM=510 "
//        . "OR t3.RM=555 "
//        . "OR t3.RM=598 "
//        . "OR t3.RM=6 "
//        . "OR t3.RM=583 "
//        . "OR t3.RM=536 "
//        . "OR t3.RM=297 "
//        . "OR t3.RM=309 "
//        . "OR t3.RM=324 "
//        . "OR t3.RM=349 "
//        . "OR t3.RM=358 "
//        . "OR t3.RM=382 "
//        . "OR t3.RM=389 "
//        . "OR t3.RM=392 "
//        . "OR t3.RM=460"
//        . "OR t3.RM=607 "
//        . "OR t3.RM= 591 "
//        . "OR t3.BRD=2729 "
//        . "OR t3.BRD=2310 ) "
//        . ") as opciSmjerVUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t4 "
//        . "WHERE t4.STATUS LIKE '01%' "
//        . "AND t4.SPOL = 2 "
////        . "AND t4.VRSTA = 1 "
////        . "AND t4.SSRM = 19 "
//        . "AND (t4.RM=7 "
//        . "OR t4.RM=7 "
//        . "OR t4.RM=355 "
//        . "OR t4.RM=537 "
//        . "OR t4.RM=543 "
//        . "OR t4.RM=218 "
//        . "OR t4.RM=490 "
//        . "OR t4.RM=634 "
//        . "OR t4.RM=296 "
//        . "OR t4.RM=435 "
//        . "OR t4.RM=468 "
//        . "OR t4.RM=489 "
//        . "OR t4.RM=554 "
//        . "OR t4.RM=332 "
//        . "OR t4.RM=601 "
//        . "OR t4.RM=408 "
//        . "OR t4.RM=511 "
//        . "OR t4.RM=559 "
//        . "OR t4.RM=344 "
//        . "OR t4.RM=561 "
//        . "OR t4.RM=472 "
//        . "OR t4.RM=510 "
//        . "OR t4.RM=555 "
//        . "OR t4.RM=598 "
//        . "OR t4.RM=6 "
//        . "OR t4.RM=583 "
//        . "OR t4.RM=536 "
//        . "OR t4.RM=297 "
//        . "OR t4.RM=309 "
//        . "OR t4.RM=324 "
//        . "OR t4.RM=349 "
//        . "OR t4.RM=358 "
//        . "OR t4.RM=382 "
//        . "OR t4.RM=389 "
//        . "OR t4.RM=392 "
//        . "OR t4.RM=460 "
//        . "OR t4.RM=607 "
//        . "OR t4.RM= 591 "
//        . "OR t4.BRD=2729 "
//        . "OR t4.BRD=2310 ) "
//        . ") as opciSmjerVUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t5 "
//        . "WHERE t5.STATUS LIKE '01%' "
//        . "AND t5.SPOL = 1 "
////        . "AND t5.VRSTA = 1 "
////        . "AND t5.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t5.DATUMR)< 12410) "
//        . "AND (t5.RM=7 "
//        . "OR t5.RM=7 "
//        . "OR t5.RM=355 "
//        . "OR t5.RM=537 "
//        . "OR t5.RM=543 "
//        . "OR t5.RM=218 "
//        . "OR t5.RM=490 "
//        . "OR t5.RM=634 "
//        . "OR t5.RM=296 "
//        . "OR t5.RM=435 "
//        . "OR t5.RM=468 "
//        . "OR t5.RM=489 "
//        . "OR t5.RM=554 "
//        . "OR t5.RM=332 "
//        . "OR t5.RM=601 "
//        . "OR t5.RM=408 "
//        . "OR t5.RM=511 "
//        . "OR t5.RM=559 "
//        . "OR t5.RM=344 "
//        . "OR t5.RM=561 "
//        . "OR t5.RM=472 "
//        . "OR t5.RM=510 "
//        . "OR t5.RM=555 "
//        . "OR t5.RM=598 "
//        . "OR t5.RM=6 "
//        . "OR t5.RM=583 "
//        . "OR t5.RM=536 "
//        . "OR t5.RM=297 "
//        . "OR t5.RM=309 "
//        . "OR t5.RM=324 "
//        . "OR t5.RM=349 "
//        . "OR t5.RM=358 "
//        . "OR t5.RM=382 "
//        . "OR t5.RM=389 "
//        . "OR t5.RM=392 "
//        . "OR t5.RM=460 "
//        . "OR t5.RM=607 "
//        . "OR t5.RM= 591 "
//        . "OR t5.BRD=2729 "
//        . "OR t5.BRD=2310 ) "
//        . ") as opciSmjerVdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t6 "
//        . "WHERE t6.STATUS LIKE '01%' "
//        . "AND t6.SPOL = 2 "
////        . "AND t6.VRSTA = 1 "
////        . "AND t6.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t6.DATUMR)< 12410) "
//        . "AND (t6.RM=7 "
//        . "OR t6.RM=7 "
//        . "OR t6.RM=355 "
//        . "OR t6.RM=537 "
//        . "OR t6.RM=543 "
//        . "OR t6.RM=218 "
//        . "OR t6.RM=490 "
//        . "OR t6.RM=634 "
//        . "OR t6.RM=296 "
//        . "OR t6.RM=435 "
//        . "OR t6.RM=468 "
//        . "OR t6.RM=489 "
//        . "OR t6.RM=554 "
//        . "OR t6.RM=332 "
//        . "OR t6.RM=601 "
//        . "OR t6.RM=408 "
//        . "OR t6.RM=511 "
//        . "OR t6.RM=559 "
//        . "OR t6.RM=344 "
//        . "OR t6.RM=561 "
//        . "OR t6.RM=472 "
//        . "OR t6.RM=510 "
//        . "OR t6.RM=555 "
//        . "OR t6.RM=598 "
//        . "OR t6.RM=6 "
//        . "OR t6.RM=583 "
//        . "OR t6.RM=536 "
//        . "OR t6.RM=297 "
//        . "OR t6.RM=309 "
//        . "OR t6.RM=324 "
//        . "OR t6.RM=349 "
//        . "OR t6.RM=358 "
//        . "OR t6.RM=382 "
//        . "OR t6.RM=389 "
//        . "OR t6.RM=392 "
//        . "OR t6.RM=460 "
//        . "OR t6.RM=607 "
//        . "OR t6.RM= 591 "
//        . "OR t6.BRD=2729 "
//        . "OR t6.BRD=2310 ) "
//        . ") as opciSmjerVdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t7 "
//        . "WHERE t7.STATUS LIKE '01%' "
//        . "AND t7.SPOL = 1 "
////        . "AND t7.VRSTA = 1 "
////        . "AND t7.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t7.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t7.RM=7 "
//        . "OR t7.RM=7 "
//        . "OR t7.RM=355 "
//        . "OR t7.RM=537 "
//        . "OR t7.RM=543 "
//        . "OR t7.RM=218 "
//        . "OR t7.RM=490 "
//        . "OR t7.RM=634 "
//        . "OR t7.RM=296 "
//        . "OR t7.RM=435 "
//        . "OR t7.RM=468 "
//        . "OR t7.RM=489 "
//        . "OR t7.RM=554 "
//        . "OR t7.RM=332 "
//        . "OR t7.RM=601 "
//        . "OR t7.RM=408 "
//        . "OR t7.RM=511 "
//        . "OR t7.RM=559 "
//        . "OR t7.RM=344 "
//        . "OR t7.RM=561 "
//        . "OR t7.RM=472 "
//        . "OR t7.RM=510 "
//        . "OR t7.RM=555 "
//        . "OR t7.RM=598 "
//        . "OR t7.RM=6 "
//        . "OR t7.RM=583 "
//        . "OR t7.RM=536 "
//        . "OR t7.RM=297 "
//        . "OR t7.RM=309 "
//        . "OR t7.RM=324 "
//        . "OR t7.RM=349 "
//        . "OR t7.RM=358 "
//        . "OR t7.RM=382 "
//        . "OR t7.RM=389 "
//        . "OR t7.RM=392 "
//        . "OR t7.RM=460 "
//        . "OR t7.RM=607 "
//        . "OR t7.RM= 591 "
//        . "OR t7.BRD=2729 "
//        . "OR t7.BRD=2310 ) "
//        . ") as opciSmjerVdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t8 "
//        . "WHERE t8.STATUS LIKE '01%' "
//        . "AND t8.SPOL = 2 "
////        . "AND t8.VRSTA = 1 "
////        . "AND t8.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t8.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t8.RM=7 "
//        . "OR t8.RM=7 "
//        . "OR t8.RM=355 "
//        . "OR t8.RM=537 "
//        . "OR t8.RM=543 "
//        . "OR t8.RM=218 "
//        . "OR t8.RM=490 "
//        . "OR t8.RM=634 "
//        . "OR t8.RM=296 "
//        . "OR t8.RM=435 "
//        . "OR t8.RM=468 "
//        . "OR t8.RM=489 "
//        . "OR t8.RM=554 "
//        . "OR t8.RM=332 "
//        . "OR t8.RM=601 "
//        . "OR t8.RM=408 "
//        . "OR t8.RM=511 "
//        . "OR t8.RM=559 "
//        . "OR t8.RM=344 "
//        . "OR t8.RM=561 "
//        . "OR t8.RM=472 "
//        . "OR t8.RM=510 "
//        . "OR t8.RM=555 "
//        . "OR t8.RM=598 "
//        . "OR t8.RM=6 "
//        . "OR t8.RM=583 "
//        . "OR t8.RM=536 "
//        . "OR t8.RM=297 "
//        . "OR t8.RM=309 "
//        . "OR t8.RM=324 "
//        . "OR t8.RM=349 "
//        . "OR t8.RM=358 "
//        . "OR t8.RM=382 "
//        . "OR t8.RM=389 "
//        . "OR t8.RM=392 "
//        . "OR t8.RM=460 "
//        . "OR t8.RM=607 "
//        . "OR t8.RM= 591 "
//        . "OR t8.BRD=2729 "
//        . "OR t8.BRD=2310 ) "
//        . ") as opciSmjerVdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t9 "
//        . "WHERE t9.STATUS LIKE '01%' "
//        . "AND t9.SPOL = 1 "
////        . "AND t9.VRSTA = 1 "
////        . "AND t9.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t9.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t9.RM=7 "
//        . "OR t9.RM=7 "
//        . "OR t9.RM=355 "
//        . "OR t9.RM=537 "
//        . "OR t9.RM=543 "
//        . "OR t9.RM=218 "
//        . "OR t9.RM=490 "
//        . "OR t9.RM=634 "
//        . "OR t9.RM=296 "
//        . "OR t9.RM=435 "
//        . "OR t9.RM=468 "
//        . "OR t9.RM=489 "
//        . "OR t9.RM=554 "
//        . "OR t9.RM=332 "
//        . "OR t9.RM=601 "
//        . "OR t9.RM=408 "
//        . "OR t9.RM=511 "
//        . "OR t9.RM=559 "
//        . "OR t9.RM=344 "
//        . "OR t9.RM=561 "
//        . "OR t9.RM=472 "
//        . "OR t9.RM=510 "
//        . "OR t9.RM=555 "
//        . "OR t9.RM=598 "
//        . "OR t9.RM=6 "
//        . "OR t9.RM=583 "
//        . "OR t9.RM=536 "
//        . "OR t9.RM=297 "
//        . "OR t9.RM=309 "
//        . "OR t9.RM=324 "
//        . "OR t9.RM=349 "
//        . "OR t9.RM=358 "
//        . "OR t9.RM=382 "
//        . "OR t9.RM=389 "
//        . "OR t9.RM=392 "
//        . "OR t9.RM=460 "
//        . "OR t9.RM=607 "
//        . "OR t9.RM= 591 "
//        . "OR t9.BRD=2729 "
//        . "OR t9.BRD=2310 ) "
//        . ") as opciSmjerVdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t10 "
//        . "WHERE t10.STATUS LIKE '01%' "
//        . "AND t10.SPOL = 2 "
////        . "AND t10.VRSTA = 1 "
////        . "AND t10.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t10.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t10.RM=7 "
//        . "OR t10.RM=7 "
//        . "OR t10.RM=355 "
//        . "OR t10.RM=537 "
//        . "OR t10.RM=543 "
//        . "OR t10.RM=218 "
//        . "OR t10.RM=490 "
//        . "OR t10.RM=634 "
//        . "OR t10.RM=296 "
//        . "OR t10.RM=435 "
//        . "OR t10.RM=468 "
//        . "OR t10.RM=489 "
//        . "OR t10.RM=554 "
//        . "OR t10.RM=332 "
//        . "OR t10.RM=601 "
//        . "OR t10.RM=408 "
//        . "OR t10.RM=511 "
//        . "OR t10.RM=559 "
//        . "OR t10.RM=344 "
//        . "OR t10.RM=561 "
//        . "OR t10.RM=472 "
//        . "OR t10.RM=510 "
//        . "OR t10.RM=555 "
//        . "OR t10.RM=598 "
//        . "OR t10.RM=6 "
//        . "OR t10.RM=583 "
//        . "OR t10.RM=536 "
//        . "OR t10.RM=297 "
//        . "OR t10.RM=309 "
//        . "OR t10.RM=324 "
//        . "OR t10.RM=349 "
//        . "OR t10.RM=358 "
//        . "OR t10.RM=382 "
//        . "OR t10.RM=389 "
//        . "OR t10.RM=392 "
//        . "OR t10.RM=460 "
//        . "OR t10.RM=607 "
//        . "OR t10.RM= 591 "
//        . "OR t10.BRD=2729 "
//        . "OR t10.BRD=2310 ) "
//        . ") as opciSmjerVdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t11 "
//        . "WHERE t11.STATUS LIKE '01%' "
//        . "AND t11.SPOL = 1 "
////        . "AND t11.VRSTA = 1 "
////        . "AND t11.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t11.DATUMR)>= 19710) "
//        . "AND (t11.RM=7 "
//        . "OR t11.RM=7 "
//        . "OR t11.RM=355 "
//        . "OR t11.RM=537 "
//        . "OR t11.RM=543 "
//        . "OR t11.RM=218 "
//        . "OR t11.RM=490 "
//        . "OR t11.RM=634 "
//        . "OR t11.RM=296 "
//        . "OR t11.RM=435 "
//        . "OR t11.RM=468 "
//        . "OR t11.RM=489 "
//        . "OR t11.RM=554 "
//        . "OR t11.RM=332 "
//        . "OR t11.RM=601 "
//        . "OR t11.RM=408 "
//        . "OR t11.RM=511 "
//        . "OR t11.RM=559 "
//        . "OR t11.RM=344 "
//        . "OR t11.RM=561 "
//        . "OR t11.RM=472 "
//        . "OR t11.RM=510 "
//        . "OR t11.RM=555 "
//        . "OR t11.RM=598 "
//        . "OR t11.RM=6 "
//        . "OR t11.RM=583 "
//        . "OR t11.RM=536 "
//        . "OR t11.RM=297 "
//        . "OR t11.RM=309 "
//        . "OR t11.RM=324 "
//        . "OR t11.RM=349 "
//        . "OR t11.RM=358 "
//        . "OR t11.RM=382 "
//        . "OR t11.RM=389 "
//        . "OR t11.RM=392 "
//        . "OR t11.RM=460 "
//        . "OR t11.RM=607 "
//        . "OR t11.RM= 591 "
//        . "OR t11.BRD=2729 "
//        . "OR t11.BRD=2310 ) "
//        . ") as opciSmjerVvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t12 "
//        . "WHERE t12.STATUS LIKE '01%' "
//        . "AND t12.SPOL = 2 "
////        . "AND t12.VRSTA = 1 "
////        . "AND t12.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t12.DATUMR)>= 19710) "
//        . "AND (t12.RM=7 "
//        . "OR t12.RM=7 "
//        . "OR t12.RM=355 "
//        . "OR t12.RM=537 "
//        . "OR t12.RM=543 "
//        . "OR t12.RM=218 "
//        . "OR t12.RM=490 "
//        . "OR t12.RM=634 "
//        . "OR t12.RM=296 "
//        . "OR t12.RM=435 "
//        . "OR t12.RM=468 "
//        . "OR t12.RM=489 "
//        . "OR t12.RM=554 "
//        . "OR t12.RM=332 "
//        . "OR t12.RM=601 "
//        . "OR t12.RM=408 "
//        . "OR t12.RM=511 "
//        . "OR t12.RM=559 "
//        . "OR t12.RM=344 "
//        . "OR t12.RM=561 "
//        . "OR t12.RM=472 "
//        . "OR t12.RM=510 "
//        . "OR t12.RM=555 "
//        . "OR t12.RM=598 "
//        . "OR t12.RM=6 "
//        . "OR t12.RM=583 "
//        . "OR t12.RM=536 "
//        . "OR t12.RM=297 "
//        . "OR t12.RM=309 "
//        . "OR t12.RM=324 "
//        . "OR t12.RM=349 "
//        . "OR t12.RM=358 "
//        . "OR t12.RM=382 "
//        . "OR t12.RM=389 "
//        . "OR t12.RM=392 "
//        . "OR t12.RM=460 "
//        . "OR t12.RM=607 "
//        . "OR t12.RM= 591"
//        . "OR t12.BRD=2729 "
//        . "OR t12.BRD=2310 ) "
//        . ") as opciSmjerVvppZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t13 "
//        . "WHERE t13.STATUS LIKE '01%' " //uposleni u skbm
////        . "AND SPEC1 IS NULL AND NASPEC IS NULL AND SUBSPEC1 IS NULL AND NASUBSPEC IS NULL " 
//        . "AND t13.SPOL=1 " //muski spol
////        . "AND t13.VRSTA = 1 " //medicinsko osoblje
////        . "AND t2.SSRM = 15 " //medicinsko osoblje
//        . "AND (t13.RM=148 "
//        . "OR t13.RM=173 "
//        . "OR t13.RM=8 "
//        . "OR t13.RM=475 "
//        . "OR t13.RM=505 "
//        . "OR t13.RM=553 "
//        . "OR t13.RM=549 "
//        . "OR t13.RM=563 "
//        . "OR t13.RM=564 "
//        . "OR t13.RM=556 "
//        . "OR t13.RM=362 "
//        . "OR t13.RM=428 "
//        . "OR t13.RM=557 "
//        . "OR t13.RM=558 "
//        . "OR t13.RM=68 "
//        . "OR t13.RM=195 "
//        . "OR t13.RM=210 "
//        . "OR t13.RM=211 "
//        . "OR t13.RM=238 "
//        . "OR t13.RM=245 "
//        . "OR t13.RM=307 "
//        . "OR t13.RM=308 "
//        . "OR t13.RM=312 "
//        . "OR t13.RM=317 "
//        . "OR t13.RM=321 "
//        . "OR t13.RM=326 "
//        . "OR t13.RM=327 "
//        . "OR t13.RM=345 "
//        . "OR t13.RM=354 "
//        . "OR t13.RM=361 "
//        . "OR t13.RM=366 "
//        . "OR t13.RM=371 "
//        . "OR t13.RM=373 "
//        . "OR t13.RM=376 "
//        . "OR t13.RM=390 ) "
//        . ") as opciSmjerSUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t14 "
//        . "WHERE t14.STATUS LIKE '01%' "
//        . "AND t14.SPOL = 2 "
////        . "AND t3.VRSTA = 1 "
////        . "AND t3.SSRM = 19 "
//        . "AND (t14.RM=148 "
//        . "OR t14.RM=173 "
//        . "OR t14.RM=8 "
//        . "OR t14.RM=475 "
//        . "OR t14.RM=505 "
//        . "OR t14.RM=553 "
//        . "OR t14.RM=549 "
//        . "OR t14.RM=563 "
//        . "OR t14.RM=564 "
//        . "OR t14.RM=556 "
//        . "OR t14.RM=362 "
//        . "OR t14.RM=428 "
//        . "OR t14.RM=557 "
//        . "OR t14.RM=558 "
//        . "OR t14.RM=68 "
//        . "OR t14.RM=195 "
//        . "OR t14.RM=210 "
//        . "OR t14.RM=211 "
//        . "OR t14.RM=238 "
//        . "OR t14.RM=245 "
//        . "OR t14.RM=307 "
//        . "OR t14.RM=308 "
//        . "OR t14.RM=312 "
//        . "OR t14.RM=317 "
//        . "OR t14.RM=321 "
//        . "OR t14.RM=326 "
//        . "OR t14.RM=327 "
//        . "OR t14.RM=345 "
//        . "OR t14.RM=354 "
//        . "OR t14.RM=361 "
//        . "OR t14.RM=366 "
//        . "OR t14.RM=371 "
//        . "OR t14.RM=373 "
//        . "OR t14.RM=376 "
//        . "OR t14.RM=390 ) "
//        . ") as opciSmjerSUkZ, "
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t15 "
//        . "WHERE t15.STATUS LIKE '01%' "
//        . "AND t15.SPOL = 1 "
////        . "AND t15.VRSTA = 1 "
////        . "AND t15.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t15.DATUMR)< 12410) "
//        . "AND (t15.RM=148 "
//        . "OR t15.RM=173 "
//        . "OR t15.RM=8 "
//        . "OR t15.RM=475 "
//        . "OR t15.RM=505 "
//        . "OR t15.RM=553 "
//        . "OR t15.RM=549 "
//        . "OR t15.RM=563 "
//        . "OR t15.RM=564 "
//        . "OR t15.RM=556 "
//        . "OR t15.RM=362 "
//        . "OR t15.RM=428 "
//        . "OR t15.RM=557 "
//        . "OR t15.RM=558 "
//        . "OR t15.RM=68 "
//        . "OR t15.RM=195 "
//        . "OR t15.RM=210 "
//        . "OR t15.RM=211 "
//        . "OR t15.RM=238 "
//        . "OR t15.RM=245 "
//        . "OR t15.RM=307 "
//        . "OR t15.RM=308 "
//        . "OR t15.RM=312 "
//        . "OR t15.RM=317 "
//        . "OR t15.RM=321 "
//        . "OR t15.RM=326 "
//        . "OR t15.RM=327 "
//        . "OR t15.RM=345 "
//        . "OR t15.RM=354 "
//        . "OR t15.RM=361 "
//        . "OR t15.RM=366 "
//        . "OR t15.RM=371 "
//        . "OR t15.RM=373 "
//        . "OR t15.RM=376 "
//        . "OR t15.RM=390 ) "
//        . ") as opciSmjerSdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t16 "
//        . "WHERE t16.STATUS LIKE '01%' "
//        . "AND t16.SPOL = 2 "
////        . "AND t12.VRSTA = 1 "
////        . "AND t12.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t16.DATUMR)< 12410) "
//        . "AND (t16.RM=148 "
//        . "OR t16.RM=173 "
//        . "OR t16.RM=8 "
//        . "OR t16.RM=475 "
//        . "OR t16.RM=505 "
//        . "OR t16.RM=553 "
//        . "OR t16.RM=549 "
//        . "OR t16.RM=563 "
//        . "OR t16.RM=564 "
//        . "OR t16.RM=556 "
//        . "OR t16.RM=362 "
//        . "OR t16.RM=428 "
//        . "OR t16.RM=557 "
//        . "OR t16.RM=558 "
//        . "OR t16.RM=68 "
//        . "OR t16.RM=195 "
//        . "OR t16.RM=210 "
//        . "OR t16.RM=211 "
//        . "OR t16.RM=238 "
//        . "OR t16.RM=245 "
//        . "OR t16.RM=307 "
//        . "OR t16.RM=308 "
//        . "OR t16.RM=312 "
//        . "OR t16.RM=317 "
//        . "OR t16.RM=321 "
//        . "OR t16.RM=326 "
//        . "OR t16.RM=327 "
//        . "OR t16.RM=345 "
//        . "OR t16.RM=354 "
//        . "OR t16.RM=361 "
//        . "OR t16.RM=366 "
//        . "OR t16.RM=371 "
//        . "OR t16.RM=373 "
//        . "OR t16.RM=376 "
//        . "OR t16.RM=390 ) "
//        . ") as opciSmjerSdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t17 "
//        . "WHERE t17.STATUS LIKE '01%' "
//        . "AND t17.SPOL = 1 "
////        . "AND t17.VRSTA = 1 "
////        . "AND t17.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t17.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t17.RM=148 "
//        . "OR t17.RM=173 "
//        . "OR t17.RM=8 "
//        . "OR t17.RM=475 "
//        . "OR t17.RM=505 "
//        . "OR t17.RM=553 "
//        . "OR t17.RM=549 "
//        . "OR t17.RM=563 "
//        . "OR t17.RM=564 "
//        . "OR t17.RM=556 "
//        . "OR t17.RM=362 "
//        . "OR t17.RM=428 "
//        . "OR t17.RM=557 "
//        . "OR t17.RM=558 "
//        . "OR t17.RM=68 "
//        . "OR t17.RM=195 "
//        . "OR t17.RM=210 "
//        . "OR t17.RM=211 "
//        . "OR t17.RM=238 "
//        . "OR t17.RM=245 "
//        . "OR t17.RM=307 "
//        . "OR t17.RM=308 "
//        . "OR t17.RM=312 "
//        . "OR t17.RM=317 "
//        . "OR t17.RM=321 "
//        . "OR t17.RM=326 "
//        . "OR t17.RM=327 "
//        . "OR t17.RM=345 "
//        . "OR t17.RM=354 "
//        . "OR t17.RM=361 "
//        . "OR t17.RM=366 "
//        . "OR t17.RM=371 "
//        . "OR t17.RM=373 "
//        . "OR t17.RM=376 "
//        . "OR t17.RM=390 ) "
//        . ") as opciSmjerSdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t18 "
//        . "WHERE t18.STATUS LIKE '01%' "
//        . "AND t18.SPOL = 2 "
////        . "AND t18.VRSTA = 1 "
////        . "AND t18.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t18.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t18.RM=148 "
//        . "OR t18.RM=173 "
//        . "OR t18.RM=8 "
//        . "OR t18.RM=475 "
//        . "OR t18.RM=505 "
//        . "OR t18.RM=553 "
//        . "OR t18.RM=549 "
//        . "OR t18.RM=563 "
//        . "OR t18.RM=564 "
//        . "OR t18.RM=556 "
//        . "OR t18.RM=362 "
//        . "OR t18.RM=428 "
//        . "OR t18.RM=557 "
//        . "OR t18.RM=558 "
//        . "OR t18.RM=68 "
//        . "OR t18.RM=195 "
//        . "OR t18.RM=210 "
//        . "OR t18.RM=211 "
//        . "OR t18.RM=238 "
//        . "OR t18.RM=245 "
//        . "OR t18.RM=307 "
//        . "OR t18.RM=308 "
//        . "OR t18.RM=312 "
//        . "OR t18.RM=317 "
//        . "OR t18.RM=321 "
//        . "OR t18.RM=326 "
//        . "OR t18.RM=327 "
//        . "OR t18.RM=345 "
//        . "OR t18.RM=354 "
//        . "OR t18.RM=361 "
//        . "OR t18.RM=366 "
//        . "OR t18.RM=371 "
//        . "OR t18.RM=373 "
//        . "OR t18.RM=376 "
//        . "OR t18.RM=390 ) "
//        . ") as opciSmjerSdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t19 "
//        . "WHERE t19.STATUS LIKE '01%' "
//        . "AND t19.SPOL = 1 "
////        . "AND t19.VRSTA = 1 "
////        . "AND t19.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t19.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t19.RM=148 "
//        . "OR t19.RM=173 "
//        . "OR t19.RM=8 "
//        . "OR t19.RM=475 "
//        . "OR t19.RM=505 "
//        . "OR t19.RM=553 "
//        . "OR t19.RM=549 "
//        . "OR t19.RM=563 "
//        . "OR t19.RM=564 "
//        . "OR t19.RM=556 "
//        . "OR t19.RM=362 "
//        . "OR t19.RM=428 "
//        . "OR t19.RM=557 "
//        . "OR t19.RM=558 "
//        . "OR t19.RM=68 "
//        . "OR t19.RM=195 "
//        . "OR t19.RM=210 "
//        . "OR t19.RM=211 "
//        . "OR t19.RM=238 "
//        . "OR t19.RM=245 "
//        . "OR t19.RM=307 "
//        . "OR t19.RM=308 "
//        . "OR t19.RM=312 "
//        . "OR t19.RM=317 "
//        . "OR t19.RM=321 "
//        . "OR t19.RM=326 "
//        . "OR t19.RM=327 "
//        . "OR t19.RM=345 "
//        . "OR t19.RM=354 "
//        . "OR t19.RM=361 "
//        . "OR t19.RM=366 "
//        . "OR t19.RM=371 "
//        . "OR t19.RM=373 "
//        . "OR t19.RM=376 "
//        . "OR t19.RM=390 ) "
//        . ") as opciSmjerSdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t20 "
//        . "WHERE t20.STATUS LIKE '01%' "
//        . "AND t20.SPOL = 2 "
////        . "AND t20.VRSTA = 1 "
////        . "AND t20.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t20.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t20.RM=148 "
//        . "OR t20.RM=173 "
//        . "OR t20.RM=8 "
//        . "OR t20.RM=475 "
//        . "OR t20.RM=505 "
//        . "OR t20.RM=553 "
//        . "OR t20.RM=549 "
//        . "OR t20.RM=563 "
//        . "OR t20.RM=564 "
//        . "OR t20.RM=556 "
//        . "OR t20.RM=362 "
//        . "OR t20.RM=428 "
//        . "OR t20.RM=557 "
//        . "OR t20.RM=558 "
//        . "OR t20.RM=68 "
//        . "OR t20.RM=195 "
//        . "OR t20.RM=210 "
//        . "OR t20.RM=211 "
//        . "OR t20.RM=238 "
//        . "OR t20.RM=245 "
//        . "OR t20.RM=307 "
//        . "OR t20.RM=308 "
//        . "OR t20.RM=312 "
//        . "OR t20.RM=317 "
//        . "OR t20.RM=321 "
//        . "OR t20.RM=326 "
//        . "OR t20.RM=327 "
//        . "OR t20.RM=345 "
//        . "OR t20.RM=354 "
//        . "OR t20.RM=361 "
//        . "OR t20.RM=366 "
//        . "OR t20.RM=371 "
//        . "OR t20.RM=373 "
//        . "OR t20.RM=376 "
//        . "OR t20.RM=390 ) "
//        . ") as opciSmjerSdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t21 "
//        . "WHERE t21.STATUS LIKE '01%' "
//        . "AND t21.SPOL = 1 "
////        . "AND t21.VRSTA = 1 "
////        . "AND t21.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t21.DATUMR)>= 19710) "
//        . "AND (t21.RM=148 "
//        . "OR t21.RM=173 "
//        . "OR t21.RM=8 "
//        . "OR t21.RM=475 "
//        . "OR t21.RM=505 "
//        . "OR t21.RM=553 "
//        . "OR t21.RM=549 "
//        . "OR t21.RM=563 "
//        . "OR t21.RM=564 "
//        . "OR t21.RM=556 "
//        . "OR t21.RM=362 "
//        . "OR t21.RM=428 "
//        . "OR t21.RM=557 "
//        . "OR t21.RM=558 "
//        . "OR t21.RM=68 "
//        . "OR t21.RM=195 "
//        . "OR t21.RM=210 "
//        . "OR t21.RM=211 "
//        . "OR t21.RM=238 "
//        . "OR t21.RM=245 "
//        . "OR t21.RM=307 "
//        . "OR t21.RM=308 "
//        . "OR t21.RM=312 "
//        . "OR t21.RM=317 "
//        . "OR t21.RM=321 "
//        . "OR t21.RM=326 "
//        . "OR t21.RM=327 "
//        . "OR t21.RM=345 "
//        . "OR t21.RM=354 "
//        . "OR t21.RM=361 "
//        . "OR t21.RM=366 "
//        . "OR t21.RM=371 "
//        . "OR t21.RM=373 "
//        . "OR t21.RM=376 "
//        . "OR t21.RM=390 ) "
//        . ") as opciSmjerSvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t22 "
//        . "WHERE t22.STATUS LIKE '01%' "
//        . "AND t22.SPOL = 2 "
////        . "AND t22.VRSTA = 1 "
////        . "AND t22.SSRM = 19 "
//        . "AND (DATEDIFF(NOW(), t22.DATUMR)>= 19710) "
//        . "AND (t22.RM=148 "
//        . "OR t22.RM=173 "
//        . "OR t22.RM=8 "
//        . "OR t22.RM=475 "
//        . "OR t22.RM=505 "
//        . "OR t22.RM=553 "
//        . "OR t22.RM=549 "
//        . "OR t22.RM=563 "
//        . "OR t22.RM=564 "
//        . "OR t22.RM=556 "
//        . "OR t22.RM=362 "
//        . "OR t22.RM=428 "
//        . "OR t22.RM=557 "
//        . "OR t22.RM=558 "
//        . "OR t22.RM=68 "
//        . "OR t22.RM=195 "
//        . "OR t22.RM=210 "
//        . "OR t22.RM=211 "
//        . "OR t22.RM=238 "
//        . "OR t22.RM=245 "
//        . "OR t22.RM=307 "
//        . "OR t22.RM=308 "
//        . "OR t22.RM=312 "
//        . "OR t22.RM=317 "
//        . "OR t22.RM=321 "
//        . "OR t22.RM=326 "
//        . "OR t22.RM=327 "
//        . "OR t22.RM=345 "
//        . "OR t22.RM=354 "
//        . "OR t22.RM=361 "
//        . "OR t22.RM=366 "
//        . "OR t22.RM=371 "
//        . "OR t22.RM=373 "
//        . "OR t22.RM=376 "
//        . "OR t22.RM=390 ) "
//        . ") as opciSmjerSvppZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t23 "
//        . "WHERE t23.STATUS LIKE '01%' " 
//        . "AND t23.SPOL=1 " 
//        . "AND (t23.RM=30 "
//        . "OR t23.RM=6 "
//        . "OR t23.RM=363 "
//        . "OR t23.RM=562 "
//        . "OR t23.RM=341) "
//        . ") as PrimaljeSUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t24 "
//        . "WHERE t24.STATUS LIKE '01%' " 
//        . "AND t24.SPOL=2 " 
//        . "AND (t24.RM=30 "
//        . "OR t24.RM=363 "
//        . "OR t24.RM=6 "
//        . "OR t24.RM=562 "
//        . "OR t24.RM=341) "
//        . ") as PrimaljeSUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t25 "
//        . "WHERE t25.STATUS LIKE '01%' " 
//        . "AND t25.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t25.DATUMR)< 12410) "
//        . "AND (t25.RM=30 "
//        . "OR t25.RM=363 "
//        . "OR t25.RM=6 "
//        . "OR t25.RM=562 "
//        . "OR t25.RM=341) "
//        . ") as PrimaljeSdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t26 "
//        . "WHERE t26.STATUS LIKE '01%' "
//        . "AND t26.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t26.DATUMR)< 12410) "
//        . "AND (t26.RM=30 "
//        . "OR t26.RM=363 "
//        . "OR t26.RM=562 "
//        . "OR t26.RM=6 "
//        . "OR t26.RM=341) "
//        . ") as PrimaljeSdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t27 "
//        . "WHERE t27.STATUS LIKE '01%' "
//        . "AND t27.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t27.RM=30 "
//        . "OR t27.RM=363 "
//        . "OR t27.RM=6 "
//        . "OR t27.RM=562 "
//        . "OR t27.RM=341) "
//        . ") as PrimaljeSdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t28 "
//        . "WHERE t28.STATUS LIKE '01%' " 
//        . "AND t28.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t28.RM=30 "
//        . "OR t28.RM=363 "
//        . "OR t28.RM=6 "
//        . "OR t28.RM=562 "
//        . "OR t28.RM=341) "
//        . ") as PrimaljeSdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t29 "
//        . "WHERE t29.STATUS LIKE '01%' "
//        . "AND t29.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t29.RM=30 "
//        . "OR t29.RM=363 "
//        . "OR t29.RM=6 "
//        . "OR t29.RM=562 "
//        . "OR t29.RM=341) "
//        . ") as PrimaljeSdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t30 "
//        . "WHERE t30.STATUS LIKE '01%' " 
//        . "AND t30.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t30.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t30.RM=30 "
//        . "OR t30.RM=363 "
//        . "OR t30.RM=562 "
//        . "OR t30.RM=6 "
//        . "OR t30.RM=341) "
//        . ") as PrimaljeSdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t31 "
//        . "WHERE t31.STATUS LIKE '01%' " 
//        . "AND t31.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710) "
//        . "AND (t31.RM=30 "
//        . "OR t31.RM=363 "
//        . "OR t31.RM=562 "
//        . "OR t31.RM=6 "
//        . "OR t31.RM=341) "
//        . ") as PrimaljeSvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t32 "
//        . "WHERE t32.STATUS LIKE '01%' " 
//        . "AND t32.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t32.DATUMR)>= 19710) "
//        . "AND (t32.RM=30 "
//        . "OR t32.RM=363 "
//        . "OR t32.RM=6 "
//        . "OR t32.RM=562 "
//        . "OR t32.RM=341) "
//        . ") as PrimaljeSvppZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t33 "
//        . "WHERE t33.STATUS LIKE '01%' " 
//        . "AND t33.SPOL=1 " 
//        . "AND (t33.RM=189) "
//        . ") as RTTVUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t34 "
//        . "WHERE t34.STATUS LIKE '01%' " 
//        . "AND t34.SPOL=2 " 
//        . "AND (t34.RM=189) "
//        . ") as RTTVUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t35 "
//        . "WHERE t35.STATUS LIKE '01%' " 
//        . "AND t35.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t35.DATUMR)< 12410) "
//        . "AND (t35.RM=189) "
//        . ") as RTTVdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t36 "
//        . "WHERE t36.STATUS LIKE '01%' "
//        . "AND t36.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t36.DATUMR)< 12410) "
//        . "AND (t36.RM=189) "
//        . ") as RTTVdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t37 "
//        . "WHERE t37.STATUS LIKE '01%' "
//        . "AND t37.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t37.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t37.RM=189) "
//        . ") as RTTVdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t38 "
//        . "WHERE t38.STATUS LIKE '01%' " 
//        . "AND t38.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t38.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t38.RM=189) "
//        . ") as RTTVdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t39 "
//        . "WHERE t39.STATUS LIKE '01%' "
//        . "AND t39.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t39.DATUMR) BETWEEN 16060 AND 19709) "
//         . "AND (t39.RM=189) "
//        . ") as RTTVdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t40 "
//        . "WHERE t40.STATUS LIKE '01%' " 
//        . "AND t40.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t40.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t40.RM=189) "
//        . ") as RTTVdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t41 "
//        . "WHERE t41.STATUS LIKE '01%' " 
//        . "AND t41.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t41.DATUMR)>= 19710) "
//        . "AND (t41.RM=189) "
//        . ") as RTTVvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t42 "
//        . "WHERE t42.STATUS LIKE '01%' " 
//        . "AND t42.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t42.DATUMR)>= 19710) "
//        . "AND (t42.RM=189) "
//        . ") as RTTVvppZ, "
//        
//        
//        
////        . "(SELECT COUNT(*) "
////        . "FROM djel t42 "
////        . "WHERE t42.STATUS LIKE '01%' " 
////        . "AND t42.SPOL=1 " 
////        . "AND (t42.RM=499 "
////        . "OR t42.RM=284) "
////        . ") as RTTSUkM, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t44 "
////        . "WHERE t44.STATUS LIKE '01%' " 
////        . "AND t44.SPOL=2 " 
////        . "AND (t44.RM=499 "
////        . "OR t44.RM=284) "
////        . ") as RTTSUkZ, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t45 "
////        . "WHERE t45.STATUS LIKE '01%' " 
////        . "AND t45.SPOL=1 " 
////        . "AND (DATEDIFF(NOW(), t45.DATUMR)< 12410) "
////        . "AND (t45.RM=499 "
////        . "OR t45.RM=284) "
////        . ") as RTTSdotcM, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t46 "
////        . "WHERE t46.STATUS LIKE '01%' "
////        . "AND t46.SPOL=2 "
////        . "AND (DATEDIFF(NOW(), t46.DATUMR)< 12410) "
////        . "AND (t46.RM=499 "
////        . "OR t46.RM=284) "
////        . ") as RTTSdotcZ, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t47 "
////        . "WHERE t47.STATUS LIKE '01%' "
////        . "AND t47.SPOL=1 " 
////        . "AND (DATEDIFF(NOW(), t47.DATUMR) BETWEEN 12410 AND 16059) "
////        . "AND (t47.RM=499 "
////        . "OR t47.RM=284) "
////        . ") as RTTSdoccM, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t48 "
////        . "WHERE t48.STATUS LIKE '01%' " 
////        . "AND t48.SPOL=2 " 
////        . "AND (DATEDIFF(NOW(), t48.DATUMR) BETWEEN 12410 AND 16059) "
////        . "AND (t48.RM=499 "
////        . "OR t48.RM=284) "
////        . ") as RTTSdoccZ, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t49 "
////        . "WHERE t49.STATUS LIKE '01%' "
////        . "AND t49.SPOL=1 "
////        . "AND (DATEDIFF(NOW(), t49.DATUMR) BETWEEN 16060 AND 19709) "
////        . "AND (t49.RM=499 "
////        . "OR t49.RM=284) "
////        . ") as RTTSdopcM, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t50 "
////        . "WHERE t50.STATUS LIKE '01%' " 
////        . "AND t50.SPOL=2 " 
////        . "AND (DATEDIFF(NOW(), t50.DATUMR) BETWEEN 16060 AND 19709) "
////        . "AND (t50.RM=499 "
////        . "OR t50.RM=284) "
////        . ") as RTTSdopcZ, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t51 "
////        . "WHERE t51.STATUS LIKE '01%' " 
////        . "AND t51.SPOL=1 " 
////        . "AND (DATEDIFF(NOW(), t51.DATUMR)>= 19710) "
////        . "AND (t51.RM=499 "
////        . "OR t51.RM=284) "
////        . ") as RTTSvppM, "
////        . "(SELECT COUNT(*) "
////        . "FROM djel t52 "
////        . "WHERE t52.STATUS LIKE '01%' " 
////        . "AND t52.SPOL=2 " 
////        . "AND (DATEDIFF(NOW(), t52.DATUMR)>= 19710) "
////        . "AND (t52.RM=499 "
////        . "OR t52.RM=284) "
////        . ") as RTTSvppZ, "
//        
//       
//        
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t143 "
//        . "WHERE t143.STATUS LIKE '01%' " 
//        . "AND t143.SPOL=1 " 
//        . "AND (t143.RM=499 "
//        . "OR t143.RM=284) "
//        . ") as OstaloSUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t144 "
//        . "WHERE t144.STATUS LIKE '01%' " 
//        . "AND t144.SPOL=2 " 
//        . "AND (t144.RM=499 "
//        . "OR t144.RM=284) "
//        . ") as OstaloSUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t145 "
//        . "WHERE t145.STATUS LIKE '01%' " 
//        . "AND t145.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t145.DATUMR)< 12410) "
//        . "AND (t145.RM=499 "
//        . "OR t145.RM=284) "
//        . ") as OstaloSdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t146 "
//        . "WHERE t146.STATUS LIKE '01%' "
//        . "AND t146.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t146.DATUMR)< 12410) "
//        . "AND (t146.RM=499 "
//        . "OR t146.RM=284) "
//        . ") as OstaloSdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t147 "
//        . "WHERE t147.STATUS LIKE '01%' "
//        . "AND t147.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t147.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t147.RM=499 "
//        . "OR t147.RM=284) "
//        . ") as OstaloSdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t148 "
//        . "WHERE t148.STATUS LIKE '01%' " 
//        . "AND t148.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t148.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t148.RM=499 "
//        . "OR t148.RM=284) "
//        . ") as OstaloSdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t149 "
//        . "WHERE t149.STATUS LIKE '01%' "
//        . "AND t149.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t149.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t149.RM=499 "
//        . "OR t149.RM=284) "
//        . ") as OstaloSdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t150 "
//        . "WHERE t150.STATUS LIKE '01%' " 
//        . "AND t150.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t150.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t150.RM=499 "
//        . "OR t150.RM=284) "
//        . ") as OstaloSdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t151 "
//        . "WHERE t151.STATUS LIKE '01%' " 
//        . "AND t151.SPOL=1 " 
//        . "AND (DATEDIFF(NOW(), t151.DATUMR)>= 19710) "
//        . "AND (t151.RM=499 "
//        . "OR t151.RM=284) "
//        . ") as OstaloSvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t152 "
//        . "WHERE t152.STATUS LIKE '01%' " 
//        . "AND t152.SPOL=2 " 
//        . "AND (DATEDIFF(NOW(), t152.DATUMR)>= 19710) "
//        . "AND (t152.RM=499 "
//        . "OR t152.RM=284) "
//        . ") as OstaloSvppZ, "
//        
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t53 "
//        . "WHERE t53.STATUS LIKE '01%' " 
//        . "AND t53.SPOL=1 " 
//        . "AND (t53.RM=168 "
//        . "OR t53.RM=21 "
//        . "OR t53.RM=172 "
//        . "OR t53.RM=658 "
//        . "OR t53.RM=580) "
//        . ") as RTGVUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t54 "
//        . "WHERE t54.STATUS LIKE '01%' " 
//        . "AND t54.SPOL=2 " 
//        . "AND (t54.RM=168 "
//        . "OR t54.RM=21 "
//        . "OR t54.RM=172 "
//        . "OR t54.RM=658 "
//        . "OR t54.RM=580) "
//        . ") as RTGVUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t55 "
//        . "WHERE t55.STATUS LIKE '01%' " 
//        . "AND t55.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t55.DATUMR)< 12410) "
//        . "AND (t55.RM=168 "
//        . "OR t55.RM=21 "
//        . "OR t55.RM=172 "
//        . "OR t55.RM=658 "
//        . "OR t55.RM=580) "
//        . ") as RTGVdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t56 "
//        . "WHERE t56.STATUS LIKE '01%' " 
//        . "AND t56.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t56.DATUMR)< 12410) "
//        . "AND (t56.RM=168 "
//        . "OR t56.RM=21 "
//        . "OR t56.RM=172 "
//        . "OR t56.RM=658 "
//        . "OR t56.RM=580) "
//        . ") as RTGVdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t57 "
//        . "WHERE t57.STATUS LIKE '01%' " 
//        . "AND t57.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t57.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t57.RM=168 "
//        . "OR t57.RM=21 "
//        . "OR t57.RM=172 "
//        . "OR t57.RM=658 "
//        . "OR t57.RM=580) "
//        . ") as RTGVdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t58 "
//        . "WHERE t58.STATUS LIKE '01%' " 
//        . "AND t58.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t58.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t58.RM=168 "
//        . "OR t58.RM=21 "
//        . "OR t58.RM=172 "
//        . "OR t58.RM=658 "
//        . "OR t58.RM=580) "
//        . ") as RTGVdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t59 "
//        . "WHERE t59.STATUS LIKE '01%' " 
//        . "AND t59.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t59.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t59.RM=168 "
//        . "OR t59.RM=21 "
//        . "OR t59.RM=172 "
//        . "OR t59.RM=658 "
//        . "OR t59.RM=580) "
//        . ") as RTGVdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t60 "
//        . "WHERE t60.STATUS LIKE '01%' " 
//        . "AND t60.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t60.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t60.RM=168 "
//        . "OR t60.RM=21 "
//        . "OR t60.RM=172 "
//        . "OR t60.RM=658 "
//        . "OR t60.RM=580) "
//        . ") as RTGVdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t61 "
//        . "WHERE t61.STATUS LIKE '01%' " 
//        . "AND t61.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t61.DATUMR) >= 19710) "
//        . "AND (t61.RM=168 "
//        . "OR t61.RM=21 "
//        . "OR t61.RM=172 "
//        . "OR t61.RM=658 "
//        . "OR t61.RM=580) "
//        . ") as RTGVvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t62 "
//        . "WHERE t62.STATUS LIKE '01%' " 
//        . "AND t62.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t62.DATUMR) >= 19710) "
//        . "AND (t62.RM=168 "
//        . "OR t62.RM=21 "
//        . "OR t62.RM=172 "
//        . "OR t62.RM=658 "
//        . "OR t62.RM=580) "
//        . ") as RTGVvppZ, "
//        
//       
//        . "(SELECT COUNT(*) "
//        . "FROM djel t63 "
//        . "WHERE t63.STATUS LIKE '01%' " 
//        . "AND t63.SPOL=1 " 
//        . "AND t63.RM=22 "
//        . ") as RTGSUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t64 "
//        . "WHERE t64.STATUS LIKE '01%' " 
//        . "AND t64.SPOL=2 " 
//        . "AND t64.RM=22 "
//        . ") as RTGSUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t65 "
//        . "WHERE t65.STATUS LIKE '01%' " 
//        . "AND t65.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t65.DATUMR)< 12410) "
//        . "AND t65.RM=22 "
//        . ") as RTGSdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t66 "
//        . "WHERE t66.STATUS LIKE '01%' " 
//        . "AND t66.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t66.DATUMR)< 12410) "
//        . "AND t66.RM=22 "
//        . ") as RTGSdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t67 "
//        . "WHERE t67.STATUS LIKE '01%' " 
//        . "AND t67.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t67.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND t67.RM=22 "
//        . ") as RTGSdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t68 "
//        . "WHERE t68.STATUS LIKE '01%' " 
//        . "AND t68.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t68.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND t68.RM=22 "
//        . ") as RTGSdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t69 "
//        . "WHERE t69.STATUS LIKE '01%' " 
//        . "AND t69.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t69.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND t69.RM=22 "
//        . ") as RTGSdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t70 "
//        . "WHERE t70.STATUS LIKE '01%' " 
//        . "AND t70.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t70.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND t70.RM=22 "
//        . ") as RTGSdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t71 "
//        . "WHERE t71.STATUS LIKE '01%' " 
//        . "AND t71.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t71.DATUMR) >= 19710) "
//        . "AND t71.RM=22 "
//        . ") as RTGSvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t72 "
//        . "WHERE t72.STATUS LIKE '01%' " 
//        . "AND t72.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t72.DATUMR) >= 19710) "
//        . "AND t72.RM=22 "
//        . ") as RTGSvppZ, "
//        
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t73 "
//        . "WHERE t73.STATUS LIKE '01%' " 
//        . "AND t73.SPOL=1 " 
//        . "AND (t73.RM=365 "         
//        . "OR t73.RM=410 "
//        . "OR t73.RM=71) "
//        . ") as FTPVUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t74 "
//        . "WHERE t74.STATUS LIKE '01%' " 
//        . "AND t74.SPOL=2 " 
//        . "AND (t74.RM=365 "         
//        . "OR t74.RM=410 "
//        . "OR t74.RM=71) "
//        . ") as FTPVUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t75 "
//        . "WHERE t75.STATUS LIKE '01%' " 
//        . "AND t75.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t75.DATUMR)< 12410) "
//        . "AND (t75.RM=365 "         
//        . "OR t75.RM=410 "
//        . "OR t75.RM=71) "
//        . ") as FTPVdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t76 "
//        . "WHERE t76.STATUS LIKE '01%' " 
//        . "AND t76.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t76.DATUMR)< 12410) "
//        . "AND (t76.RM=365 "         
//        . "OR t76.RM=410 "
//        . "OR t76.RM=71) "
//        . ") as FTPVdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t77 "
//        . "WHERE t77.STATUS LIKE '01%' " 
//        . "AND t77.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t77.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t77.RM=365 "         
//        . "OR t77.RM=410 "
//        . "OR t77.RM=71) "
//        . ") as FTPVdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t78 "
//        . "WHERE t78.STATUS LIKE '01%' " 
//        . "AND t78.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t78.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t78.RM=365 "         
//        . "OR t78.RM=410 "
//        . "OR t78.RM=71) "
//        . ") as FTPVdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t79 "
//        . "WHERE t79.STATUS LIKE '01%' " 
//        . "AND t79.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t79.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t79.RM=365 "         
//        . "OR t79.RM=410 "
//        . "OR t79.RM=71) "
//        . ") as FTPVdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t80 "
//        . "WHERE t80.STATUS LIKE '01%' " 
//        . "AND t80.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t80.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t80.RM=365 "         
//        . "OR t80.RM=410 "
//        . "OR t80.RM=71) "
//        . ") as FTPVdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t81 "
//        . "WHERE t81.STATUS LIKE '01%' " 
//        . "AND t81.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t81.DATUMR) >= 19710) "
//        . "AND (t81.RM=365 "         
//        . "OR t81.RM=410 "
//        . "OR t81.RM=71) "
//        . ") as FTPVvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t82 "
//        . "WHERE t82.STATUS LIKE '01%' " 
//        . "AND t82.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t82.DATUMR) >= 19710) "
//        . "AND (t82.RM=365 "         
//        . "OR t82.RM=410 "
//        . "OR t82.RM=71) "
//        . ") as FTPVvppZ, "
//        
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t133 "
//        . "WHERE t133.STATUS LIKE '01%' " 
//        . "AND t133.SPOL=1 " 
//        . "AND (t133.RM=73) "         
//        . ") as FTPSUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t134 "
//        . "WHERE t134.STATUS LIKE '01%' " 
//        . "AND t134.SPOL=2 " 
//        . "AND (t134.RM=73) "         
//        . ") as FTPSUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t135 "
//        . "WHERE t135.STATUS LIKE '01%' " 
//        . "AND t135.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t135.DATUMR)< 12410) "
//        . "AND (t135.RM=73) "         
//        . ") as FTPSdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t136 "
//        . "WHERE t136.STATUS LIKE '01%' " 
//        . "AND t136.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t136.DATUMR)< 12410) "
//        . "AND (t136.RM=73) "         
//        . ") as FTPSdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t137 "
//        . "WHERE t137.STATUS LIKE '01%' " 
//        . "AND t137.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t137.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t137.RM=73) "         
//        . ") as FTPSdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t138 "
//        . "WHERE t138.STATUS LIKE '01%' " 
//        . "AND t138.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t138.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t138.RM=73) "         
//        . ") as FTPSdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t139 "
//        . "WHERE t139.STATUS LIKE '01%' " 
//        . "AND t139.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t139.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t139.RM=73) "         
//        . ") as FTPSdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t140 "
//        . "WHERE t140.STATUS LIKE '01%' " 
//        . "AND t140.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t140.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t140.RM=73) "         
//        . ") as FTPSdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t141 "
//        . "WHERE t141.STATUS LIKE '01%' " 
//        . "AND t141.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t141.DATUMR) >= 19710) "
//        . "AND (t141.RM=73) "         
//        . ") as FTPSvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t142 "
//        . "WHERE t142.STATUS LIKE '01%' " 
//        . "AND t142.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t142.DATUMR) >= 19710) "
//        . "AND (t142.RM=73) "         
//        . ") as FTPSvppZ, "
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t83 "
//        . "WHERE t83.STATUS LIKE '01%' " 
//        . "AND t83.SPOL=1 " 
//        . "AND (t83.RM=464 "
//        . "OR t83.RM=137) "
//        . ") as FARMSUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t84 "
//        . "WHERE t84.STATUS LIKE '01%' " 
//        . "AND t84.SPOL=2 " 
//        . "AND (t84.RM=464 "
//        . "OR t84.RM=137) "
//        . ") as FARMSUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t85 "
//        . "WHERE t85.STATUS LIKE '01%' " 
//        . "AND t85.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t85.DATUMR)< 12410) "
//        . "AND (t85.RM=464 "
//        . "OR t85.RM=137) "
//        . ") as FARMSdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t86 "
//        . "WHERE t86.STATUS LIKE '01%' " 
//        . "AND t86.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t86.DATUMR)< 12410) "
//        . "AND (t86.RM=464 "
//        . "OR t86.RM=137) "
//        . ") as FARMSdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t87 "
//        . "WHERE t87.STATUS LIKE '01%' " 
//        . "AND t87.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t87.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t87.RM=464 "
//        . "OR t87.RM=137) "
//        . ") as FARMSdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t88 "
//        . "WHERE t88.STATUS LIKE '01%' " 
//        . "AND t88.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t88.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t88.RM=464 "
//        . "OR t88.RM=137) "
//        . ") as FARMSdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t89 "
//        . "WHERE t89.STATUS LIKE '01%' " 
//        . "AND t89.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t89.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t89.RM=464 "
//        . "OR t89.RM=137) "
//        . ") as FARMSdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t90 "
//        . "WHERE t90.STATUS LIKE '01%' " 
//        . "AND t90.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t90.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t90.RM=464 "
//        . "OR t90.RM=137) "
//        . ") as FARMSdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t91 "
//        . "WHERE t91.STATUS LIKE '01%' " 
//        . "AND t91.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t91.DATUMR) >= 19710) "
//        . "AND (t91.RM=464 "
//        . "OR t91.RM=137) "
//        . ") as FARMSvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t92 "
//        . "WHERE t92.STATUS LIKE '01%' " 
//        . "AND t92.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t92.DATUMR) >= 19710) "
//        . "AND (t92.RM=464 "
//        . "OR t92.RM=137) "
//        . ") as FARMSvppZ, "
//        
//        
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t93 "
//        . "WHERE t93.STATUS LIKE '01%' " 
//        . "AND t93.SPOL=1 " 
//        . "AND (t93.RM=147 "
//        . "OR t93.RM=478) "
//        . ") as SANITARNIVUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t94 "
//        . "WHERE t94.STATUS LIKE '01%' " 
//        . "AND t94.SPOL=2 " 
//        . "AND (t94.RM=147 "
//        . "OR t94.RM=478) "
//        . ") as SANITARNIVUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t95 "
//        . "WHERE t95.STATUS LIKE '01%' " 
//        . "AND t95.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t95.DATUMR)< 12410) "
//        . "AND (t95.RM=147 "
//        . "OR t95.RM=478) "
//        . ") as SANITARNIVdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t96 "
//        . "WHERE t96.STATUS LIKE '01%' " 
//        . "AND t96.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t96.DATUMR)< 12410) "
//        . "AND (t96.RM=147 "
//        . "OR t96.RM=478) "
//        . ") as SANITARNIVdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t97 "
//        . "WHERE t97.STATUS LIKE '01%' " 
//        . "AND t97.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t97.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t97.RM=147 "
//        . "OR t97.RM=478) "
//        . ") as SANITARNIVdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t98 "
//        . "WHERE t98.STATUS LIKE '01%' " 
//        . "AND t98.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t98.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t98.RM=147 "
//        . "OR t98.RM=478) "
//        . ") as SANITARNIVdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t99 "
//        . "WHERE t99.STATUS LIKE '01%' " 
//        . "AND t99.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t99.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t99.RM=147 "
//        . "OR t99.RM=478) "
//        . ") as SANITARNIVdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t100 "
//        . "WHERE t100.STATUS LIKE '01%' " 
//        . "AND t100.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t100.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t100.RM=147 "
//        . "OR t100.RM=478) "
//        . ") as SANITARNIVdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t101 "
//        . "WHERE t101.STATUS LIKE '01%' " 
//        . "AND t101.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t101.DATUMR) >= 19710) "
//        . "AND (t101.RM=147 "
//        . "OR t101.RM=478) "
//        . ") as SANITARNIVvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t102 "
//        . "WHERE t102.STATUS LIKE '01%' " 
//        . "AND t102.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t102.DATUMR) >= 19710) "
//        . "AND (t102.RM=147 "
//        . "OR t102.RM=478) "
//        . ") as SANITARNIVvppZ, "
//        
//       
//        . "(SELECT COUNT(*) "
//        . "FROM djel t103 "
//        . "WHERE t103.STATUS LIKE '01%' " 
//        . "AND t103.SPOL=1 " 
//        . "AND (t103.RM=130 "
//        . ") "
//        . ") as SANITARNISUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t104 "
//        . "WHERE t104.STATUS LIKE '01%' " 
//        . "AND t104.SPOL=2 " 
//        . "AND (t104.RM=130 "
//        . ") "
//        . ") as SANITARNISUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t105 "
//        . "WHERE t105.STATUS LIKE '01%' " 
//        . "AND t105.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t105.DATUMR)< 12410) "
//        . "AND (t105.RM=130 "
//        . " ) "
//        . ") as SANITARNISdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t106 "
//        . "WHERE t106.STATUS LIKE '01%' " 
//        . "AND t106.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t106.DATUMR)< 12410) "
//        . "AND (t106.RM=130 "
//        . " ) "
//        . ") as SANITARNISdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t107 "
//        . "WHERE t107.STATUS LIKE '01%' " 
//        . "AND t107.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t107.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t107.RM=130 "
//        . " ) "
//        . ") as SANITARNISdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t108 "
//        . "WHERE t108.STATUS LIKE '01%' " 
//        . "AND t108.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t108.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t108.RM=130 "
//        . " ) "
//        . ") as SANITARNISdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t109 "
//        . "WHERE t109.STATUS LIKE '01%' " 
//        . "AND t109.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t109.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t109.RM=130 "
//        . " ) "
//        . ") as SANITARNISdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t110 "
//        . "WHERE t110.STATUS LIKE '01%' " 
//        . "AND t110.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t110.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t110.RM=130 "
//        . " ) "
//        . ") as SANITARNISdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t111 "
//        . "WHERE t111.STATUS LIKE '01%' " 
//        . "AND t111.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t111.DATUMR) >= 19710) "
//        . "AND (t111.RM=130 "
//        . " ) "
//        . ") as SANITARNISvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t112 "
//        . "WHERE t112.STATUS LIKE '01%' " 
//        . "AND t112.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t112.DATUMR) >= 19710) "
//        . "AND (t112.RM=130 "
//        . " ) "
//        . ") as SANITARNISvppZ, "
//        
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t113 "
//        . "WHERE t113.STATUS LIKE '01%' " 
//        . "AND t113.SPOL=1 " 
//        . "AND (t113.RM=496 "
//        . "OR t113.RM=127 "
//        . "OR t113.RM=26 "
//        . "OR t113.RM=622 "
//        . "OR t113.RM=603 "
//        . "OR t113.RM=194 "
//        . "OR t113.RM=603 "
//        . "OR t113.RM=588 "
//        . "OR t113.RM=360 "
//        . "OR t113.RM=26 "
//        . "OR t113.RM=657 "
//                        . "OR t113.RM=659 "
//        . "OR t113.RM=622) "
//        . ") as LABVUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t114 "
//        . "WHERE t114.STATUS LIKE '01%' " 
//        . "AND t114.SPOL=2 " 
//        . "AND (t114.RM=496 "
//        . "OR t114.RM=127 "
//        . "OR t114.RM=26 "
//        . "OR t114.RM=622 "
//        . "OR t114.RM=603 "
//        . "OR t114.RM=194 "
//        . "OR t114.RM=603 "
//        . "OR t114.RM=588 "
//        . "OR t114.RM=360 "
//        . "OR t114.RM=26 "
//        . "OR t114.RM=657 "
//                        . "OR t113.RM=659 "
//        . "OR t114.RM=622) "
//        . ") as LABVUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t115 "
//        . "WHERE t115.STATUS LIKE '01%' " 
//        . "AND t115.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t115.DATUMR)< 12410) "
//        . "AND (t115.RM=496 "
//        . "OR t115.RM=127 "
//        . "OR t115.RM=26 "
//        . "OR t115.RM=622 "
//        . "OR t115.RM=603 "
//        . "OR t115.RM=194 "
//        . "OR t115.RM=603 "
//                        . "OR t113.RM=659 "
//        . "OR t115.RM=588 "
//        . "OR t115.RM=360 "
//        . "OR t115.RM=26 "
//        . "OR t115.RM=657 "
//        . "OR t115.RM=622) "
//        . ") as LABVdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t116 "
//        . "WHERE t116.STATUS LIKE '01%' " 
//        . "AND t116.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t116.DATUMR)< 12410) "
//        . "AND (t116.RM=496 "
//        . "OR t116.RM=127 "
//        . "OR t116.RM=26 "
//        . "OR t116.RM=622 "
//        . "OR t116.RM=603 "
//        . "OR t116.RM=194 "
//        . "OR t116.RM=603 "
//        . "OR t116.RM=588 "
//        . "OR t116.RM=360 "
//        . "OR t116.RM=26 "
//        . "OR t116.RM=657 "
//                        . "OR t113.RM=659 "
//        . "OR t116.RM=622) "
//        . ") as LABVdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t117 "
//        . "WHERE t117.STATUS LIKE '01%' " 
//        . "AND t117.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t117.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t117.RM=496 "
//        . "OR t117.RM=127 "
//        . "OR t117.RM=26 "
//        . "OR t117.RM=622 "
//        . "OR t117.RM=603 "
//        . "OR t117.RM=194 "
//        . "OR t117.RM=603 "
//        . "OR t117.RM=588 "
//        . "OR t117.RM=360 "
//        . "OR t117.RM=26 "
//        . "OR t117.RM=657 "
//                        . "OR t113.RM=659 "
//        . "OR t117.RM=622) "
//        . ") as LABVdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t118 "
//        . "WHERE t118.STATUS LIKE '01%' " 
//        . "AND t118.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t118.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t118.RM=496 "
//        . "OR t118.RM=127 "
//        . "OR t118.RM=26 "
//        . "OR t118.RM=622 "
//        . "OR t118.RM=603 "
//        . "OR t118.RM=194 "
//        . "OR t118.RM=603 "
//        . "OR t118.RM=588 "
//        . "OR t118.RM=360 "
//        . "OR t118.RM=26 "
//        . "OR t118.RM=657 "
//                        . "OR t113.RM=659 "
//        . "OR t118.RM=622) "
//        . ") as LABVdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t119 "
//        . "WHERE t119.STATUS LIKE '01%' " 
//        . "AND t119.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t119.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t119.RM=496 "
//        . "OR t119.RM=127 "
//        . "OR t119.RM=26 "
//        . "OR t119.RM=622 "
//        . "OR t119.RM=603 "
//        . "OR t119.RM=194 "
//        . "OR t119.RM=603 "
//        . "OR t119.RM=588 "
//        . "OR t119.RM=360 "
//        . "OR t119.RM=26 "
//        . "OR t119.RM=657 "
//                        . "OR t113.RM=659 "
//        . "OR t119.RM=622) "
//        . ") as LABVdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t120 "
//        . "WHERE t120.STATUS LIKE '01%' " 
//        . "AND t120.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t120.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t120.RM=496 "
//        . "OR t120.RM=127 "
//        . "OR t120.RM=26 "
//        . "OR t120.RM=622 "
//        . "OR t120.RM=603 "
//        . "OR t120.RM=194 "
//        . "OR t120.RM=603 "
//        . "OR t120.RM=588 "
//        . "OR t120.RM=360 "
//        . "OR t120.RM=26 "
//        . "OR t120.RM=657 "
//                        . "OR t113.RM=659 "
//        . "OR t120.RM=622) "
//        . ") as LABVdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t121 "
//        . "WHERE t121.STATUS LIKE '01%' " 
//        . "AND t121.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t121.DATUMR) >= 19710) "
//        . "AND (t121.RM=496 "
//        . "OR t121.RM=127 "
//        . "OR t121.RM=26 "
//        . "OR t121.RM=622 "
//        . "OR t121.RM=603 "
//        . "OR t121.RM=194 "
//        . "OR t121.RM=603 "
//        . "OR t121.RM=588 "
//        . "OR t121.RM=360 "
//        . "OR t121.RM=26 "
//        . "OR t121.RM=657 "
//                        . "OR t113.RM=659 "
//        . "OR t121.RM=622) "
//        . ") as LABVvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t122 "
//        . "WHERE t122.STATUS LIKE '01%' " 
//        . "AND t122.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t122.DATUMR) >= 19710) "
//        . "AND (t122.RM=496 "
//        . "OR t122.RM=127 "
//        . "OR t122.RM=26 "
//        . "OR t122.RM=622 "
//        . "OR t122.RM=603 "
//        . "OR t122.RM=194 "
//        . "OR t122.RM=603 "
//        . "OR t122.RM=588 "
//        . "OR t122.RM=360 "
//        . "OR t122.RM=26 "
//                        . "OR t113.RM=659 "
//        . "OR t122.RM=657 "
//        . "OR t122.RM=622) "
//        . ") as LABVvppZ, "       
//        
//        
//        . "(SELECT COUNT(*) "
//        . "FROM djel t123 "
//        . "WHERE t123.STATUS LIKE '01%' " 
//        . "AND t123.SPOL=1 " 
//        . "AND (t123.RM=27 "
//        . "OR t123.RM=357) "
//        . ") as LABSUkM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t124 "
//        . "WHERE t124.STATUS LIKE '01%' " 
//        . "AND t124.SPOL=2 " 
//        . "AND (t124.RM=27 "
//        . "OR t124.RM=357) "
//        . ") as LABSUkZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t125 "
//        . "WHERE t125.STATUS LIKE '01%' " 
//        . "AND t125.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t125.DATUMR)< 12410) "
//        . "AND (t125.RM=27 "
//        . "OR t125.RM=357) "
//        . ") as LABSdotcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t126 "
//        . "WHERE t126.STATUS LIKE '01%' " 
//        . "AND t126.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t126.DATUMR)< 12410) "
//        . "AND (t126.RM=27 "
//        . "OR t126.RM=357) "
//        . ") as LABSdotcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t127 "
//        . "WHERE t127.STATUS LIKE '01%' " 
//        . "AND t127.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t127.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t127.RM=27 "
//        . "OR t127.RM=357) "
//        . ") as LABSdoccM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t128 "
//        . "WHERE t128.STATUS LIKE '01%' " 
//        . "AND t128.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t128.DATUMR) BETWEEN 12410 AND 16059) "
//        . "AND (t128.RM=27 "
//        . "OR t128.RM=357) "
//        . ") as LABSdoccZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t129 "
//        . "WHERE t129.STATUS LIKE '01%' " 
//        . "AND t129.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t129.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t129.RM=27 "
//        . "OR t129.RM=357) "
//        . ") as LABSdopcM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t130 "
//        . "WHERE t130.STATUS LIKE '01%' " 
//        . "AND t130.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t130.DATUMR) BETWEEN 16060 AND 19709) "
//        . "AND (t130.RM=27 "
//        . "OR t130.RM=357) "
//        . ") as LABSdopcZ, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t131 "
//        . "WHERE t131.STATUS LIKE '01%' " 
//        . "AND t131.SPOL=1 "
//        . "AND (DATEDIFF(NOW(), t131.DATUMR) >= 19710) "
//        . "AND (t131.RM=27 "
//        . "OR t131.RM=357) "
//        . ") as LABSvppM, "
//        . "(SELECT COUNT(*) "
//        . "FROM djel t132 "
//        . "WHERE t132.STATUS LIKE '01%' " 
//        . "AND t132.SPOL=2 "
//        . "AND (DATEDIFF(NOW(), t132.DATUMR) >= 19710) "
//        . "AND (t132.RM=27 "
//        . "OR t132.RM=357) "
//        . ") as LABSvppZ "
//        . "FROM djel";
//$nomrm = mysqli_query($con, $query);        
//$row =  mysqli_fetch_assoc($nomrm);
////    $counter++;
////    $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
////    $pdf->Cell(20, 5, $row["ukupnoMedSM"], 'RT', 0, 'C', 0, 0, 1);
////    
////     ZAGLAVLJE
////     267
//    
//    //medicinske sestre viŠa svega
//    $ukMedSesVM = $row['opciSmjerVUkM'];
//    $ukMedSesVZ = $row['opciSmjerVUkZ'];
//    $ukMedSesVdotcM = $row['opciSmjerVdotcM'];
//    $ukMedSesVdotcZ = $row['opciSmjerVdotcZ'];
//    $ukMedSesVdoccM = $row['opciSmjerVdoccM'];
//    $ukMedSesVdoccZ = $row['opciSmjerVdoccZ'];
//    $ukMedSesVdopcM = $row['opciSmjerVdopcM'];
//    $ukMedSesVdopcZ = $row['opciSmjerVdopcZ'];
//    $ukMedSesVvppM = $row['opciSmjerVvppM'];
//    $ukMedSesVvppZ = $row['opciSmjerVvppZ'];
//    //medicinske sestre srednja svega
//    $ukMedSesSM = $row['opciSmjerSUkM'] + $row['PrimaljeSUkM'] + $row['OstaloSUkM'];
//    $ukMedSesSZ = $row['opciSmjerSUkZ'] + $row['OstaloSUkZ'] + $row['PrimaljeSUkZ'];
//    $ukMedSesSdotcM = $row['opciSmjerSdotcM'] + $row['OstaloSdotcM'] + $row['PrimaljeSdotcM'];
//    $ukMedSesSdotcZ = $row['opciSmjerSdotcZ'] + $row['OstaloSdotcZ'] + $row['PrimaljeSdotcZ'];
//    $ukMedSesSdoccM = $row['opciSmjerSdoccM'] + $row['OstaloSdoccM'] + $row['PrimaljeSdoccM'];
//    $ukMedSesSdoccZ = $row['opciSmjerSdoccZ'] + $row['OstaloSdoccZ'] + $row['PrimaljeSdoccZ'];
//    $ukMedSesSdopcM = $row['opciSmjerSdopcM'] + $row['OstaloSdopcM'] + $row['PrimaljeSdopcM'];
//    $ukMedSesSdopcZ = $row['opciSmjerSdopcZ'] + $row['OstaloSdopcZ'] + $row['PrimaljeSdopcZ'];
//    $ukMedSesSvppM = $row['opciSmjerSvppM'] + $row['OstaloSvppM'] + $row['PrimaljeSvppM'];
//    $ukMedSesSvppZ = $row['opciSmjerSvppZ'] + $row['OstaloSvppZ'] + $row['PrimaljeSvppZ'];
//    
//    //tehničari viša svega
//    $ukTehVM = $row['RTGVUkM'] + $row['FTPVUkM'] + $row['SANITARNIVUkM'] + $row['LABVUkM'] + $row['RTTVUkM'];
//    $ukTehVZ = $row['RTGVUkZ'] + $row['FTPVUkZ'] + $row['SANITARNIVUkZ'] + $row['LABVUkZ'] + $row['RTTVUkZ'];
//    $ukTehVdotcM = $row['RTGVdotcM'] + $row['FTPVdotcM'] + $row['SANITARNIVdotcM'] + $row['LABVdotcM'] + $row['RTTVdotcM'];
//    $ukTehVdotcZ = $row['RTGVdotcZ'] + $row['FTPVdotcZ'] + $row['SANITARNIVdotcZ'] + $row['LABVdotcZ'] + $row['RTTVdotcZ'];
//    $ukTehVdoccM = $row['RTGVdoccM'] + $row['FTPVdoccM'] + $row['SANITARNIVdoccM'] + $row['LABVdoccM'] + $row['RTTVdoccM'];
//    $ukTehVdoccZ = $row['RTGVdoccZ'] + $row['FTPVdoccZ'] + $row['SANITARNIVdoccZ'] + $row['LABVdoccZ'] + $row['RTTVdoccZ'];
//    $ukTehVdopcM = $row['RTGVdopcM'] + $row['FTPVdopcM'] + $row['SANITARNIVdopcM'] + $row['LABVdopcM'] + $row['RTTVdopcM'];
//    $ukTehVdopcZ = $row['RTGVdopcZ'] + $row['FTPVdopcZ'] + $row['SANITARNIVdopcZ'] + $row['LABVdopcZ'] + $row['RTTVdopcZ'];
//    $ukTehVvppM = $row['RTGVvppM'] + $row['FTPVvppM'] + $row['SANITARNIVvppM'] + $row['LABVvppM'] + $row['RTTVvppM'];
//    $ukTehVvppZ = $row['RTGVvppZ'] + $row['FTPVvppZ'] + $row['SANITARNIVvppZ'] + $row['LABVvppZ'] + $row['RTTVvppZ'];
//    //tehničari srednja svega
//    $ukTehSM = $row['RTGSUkM'] + $row['FTPSUkM'] + $row['SANITARNISUkM'] + $row['LABSUkM'] + $row['FARMSUkM'];
//    $ukTehSZ = $row['RTGSUkZ'] + $row['FTPSUkZ'] + $row['SANITARNISUkZ'] + $row['LABSUkZ'] + $row['FARMSUkZ'];
//    $ukTehSdotcM = $row['RTGSdotcM'] + $row['FTPSdotcM'] + $row['SANITARNISdotcM'] + $row['LABSdotcM']  + $row['FARMSdotcM'];
//    $ukTehSdotcZ = $row['RTGSdotcZ'] + $row['FTPSdotcZ'] + $row['SANITARNISdotcZ'] + $row['LABSdotcZ'] + $row['FARMSdotcZ'];
//    $ukTehSdoccM = $row['RTGSdoccM'] + $row['FTPSdoccM'] + $row['SANITARNISdoccM'] + $row['LABSdoccM'] + $row['FARMSdoccM'];
//    $ukTehSdoccZ = $row['RTGSdoccZ'] + $row['FTPSdoccZ'] + $row['SANITARNISdoccZ'] + $row['LABSdoccZ'] + $row['FARMSdoccZ'];
//    $ukTehSdopcM = $row['RTGSdopcM'] + $row['FTPSdopcM'] + $row['SANITARNISdopcM'] + $row['LABSdopcM'] + $row['FARMSdopcM'];
//    $ukTehSdopcZ = $row['RTGSdopcZ'] + $row['FTPSdopcZ'] + $row['SANITARNISdopcZ'] + $row['LABSdopcZ'] + $row['FARMSdopcZ'];
//    $ukTehSvppM = $row['RTGSvppM'] + $row['FTPSvppM'] + $row['SANITARNISvppM'] + $row['LABSvppM'] + $row['FARMSvppM'];
//    $ukTehSvppZ = $row['RTGSvppZ'] + $row['FTPSvppZ'] + $row['SANITARNISvppZ'] + $row['LABSvppZ'] + $row['FARMSvppZ'];
//    
//    //UKUPNO
//    //ukupno viša
//    $UKUPNOVM = $ukMedSesVM + $ukTehVM;
//    $UKUPNOVZ = $ukMedSesVZ + $ukTehVZ;
//    $UKUPNOVdotcM = $ukMedSesVdotcM + $ukTehVdotcM;
//    $UKUPNOVdotcZ = $ukMedSesVdotcZ + $ukTehVdotcZ;
//    $UKUPNOVdoccM = $ukMedSesVdoccM + $ukTehVdoccM;
//    $UKUPNOVdoccZ = $ukMedSesVdoccZ + $ukTehVdoccZ;
//    $UKUPNOVdopcM = $ukMedSesVdopcM + $ukTehVdopcM;
//    $UKUPNOVdopcZ = $ukMedSesVdopcZ + $ukTehVdopcZ;
//    $UKUPNOVvppM = $ukMedSesVvppM + $ukTehVvppM;
//    $UKUPNOVvppZ = $ukMedSesVvppZ + $ukTehVvppZ;
//
//    //ukupno srednja
//    $UKUPNOSM = $ukMedSesSM + $ukTehSM;
//    $UKUPNOSZ = $ukMedSesSZ + $ukTehSZ;
//    $UKUPNOSdotcM = $ukMedSesSdotcM + $ukTehSdotcM;
//    $UKUPNOSdotcZ = $ukMedSesSdotcZ + $ukTehSdotcZ;
//    $UKUPNOSdoccM = $ukMedSesSdoccM + $ukTehSdoccM;
//    $UKUPNOSdoccZ = $ukMedSesSdoccZ + $ukTehSdoccZ;
//    $UKUPNOSdopcM = $ukMedSesSdopcM + $ukTehSdopcM;
//    $UKUPNOSdopcZ = $ukMedSesSdopcZ + $ukTehSdopcZ;
//    $UKUPNOSvppM = $ukMedSesSvppM + $ukTehSvppM;
//    $UKUPNOSvppZ = $ukMedSesSvppZ + $ukTehSvppZ;
//    
//    $pdf->Ln(5);
//    $pdf->cell(53, 5, '', 'RTL', 0, 'C', 0, 0, 1);
//    $pdf->cell(17, 5, '', 'RTL', 0, 'C', 0, 0, 1);
//    $pdf->cell(110, 5, 'Dobna skupina', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->cell(53, 5, ' Profil - ', 'RL', 0, 'C', 0, 0, 1);
//    $pdf->cell(17, 5, 'Stručna', 'RL', 0, 'C', 0, 0, 1);
////    $pdf->cell(110, 5, '', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->Cell(22, 5, 'Svega', 'RTLB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(22, 5, 'do 34 god.', 'RTLB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(22, 5, '34-44', 'RTLB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(22, 5, '44-54', 'RTLB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(22, 5, '55 i više', 'RTLB', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->cell(53, 5, 'smjer ', 'RL', 0, 'C', 0, 0, 1);
//    $pdf->cell(17, 5, 'sprema', 'RL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'M', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'M', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'M', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'M', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'M', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->cell(53, 5, '', 'RBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(17, 5, '', 'RBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '1', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '2', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '3', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '4', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '5', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '6', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '7', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '8', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '9', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '10', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->cell(53, 5, '  ', 'RL', 0, 'C', 0, 0, 1);
//    $pdf->cell(17, 5, 'viša', 'RTL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVdotcM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVdotcZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVdoccM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVdoccZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVdopcM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVdopcZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVvppM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOVvppZ, 'RTBL', 0, 'C', 0, 0, 1);
//    
//    $pdf->Ln(5);
//    $pdf->cell(53, 5, 'UKUPNO ', 'RL', 0, 'C', 0, 0, 1);
//    $pdf->cell(17, 5, 'srednja', 'TRL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSdotcM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSdotcZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSdoccM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSdoccZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSdopcM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSdopcZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSvppM, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, $UKUPNOSvppZ, 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->cell(53, 5, '  ', 'RL', 0, 'C', 0, 0, 1);
//    $pdf->cell(17, 5, 'niža', 'RTL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->cell(11, 5, '0', 'RTBL', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
////    $pdf->Ln(5);
//    
//    //SVEGA medicinskih sestara
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, 'SVEGA', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVdotcM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVdotcZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVdoccM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVdoccZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVdopcM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVdopcZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVvppM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesVvppZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, '', 'R', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSdotcM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSdotcZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSdoccM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSdoccZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSdopcM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSdopcZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSvppM, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $ukMedSesSvppZ, 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
////OPCE SESTRE VŠS
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, 'Općeg smjera', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerVvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    
////}
////    $pdf->Cell(179, 5, $row["NAZIV"], 'RT', 0, 'C', 0, 0, 1);
////    $pdf->Cell(60, 5, '', 'RT', 0, 'C', 0, 0, 1);
//    //OPĆE SESTRE SSS
//    
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, '', 'R', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["opciSmjerSvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    //
//    //PEDIJATRIJSKIH SESTARA NEMA
//    //
//    //
//        $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, 'Pedijatrisjke', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//        $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, '', 'R', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    
//    //PRIMALJE SSS, VŠS NEMA
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, 'Primalje', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, '', 'R', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["PrimaljeSvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    
//    
//    //STOMATOLOŠKA nema ništa
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, 'Stomatološka', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, '', 'R', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->ln(5);
//    
//    //ORTOPTIČARI nema ništa
//    
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, 'Ortoptičari', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, '', 'R', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->ln(5);
//    
//    
//    //OSTALO VŠS
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, 'Ostalo', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    
//    //OSTALO SSS
//    $pdf->Cell(5, 5, '', '', 0, 'C', 0, 0, 1);
//    $pdf->Cell(48, 5, '', 'RB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RTB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["OstaloSvppZ"], 'RT', 0, 'C', 0, 0, 1);
////    $pdf->Ln(5);
//        $pdf->SetXY(15, 137);
//        $pdf->StartTransform();
//        $pdf->Rotate(90);
//        $pdf->writeHTMLCell(70, 5, '', '', 'Medicinske sestre', 1, 0, false, true, 'C', false);
//        $pdf->StopTransform();
//        $pdf->Ln(5);
//        $pdf->SetXY(15, 137);
//    //RTG VŠS
//    $pdf->Cell(53, 5, 'Rentgen tehničari', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGVvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    //RTG SSS
//        $pdf->Cell(53, 5, '', 'LR', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTGSvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//    
//        //fizioterapeuti VŠS, sss PLEASEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
//        $pdf->Cell(53, 5, 'Fizioterapeutski tehničari', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPVvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//        $pdf->Cell(53, 5, '', 'LR', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FTPSvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//        //farmaceuti SSS, VŠS nema
//    $pdf->Cell(53, 5, 'Farmaceutski tehničari', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//        $pdf->Cell(53, 5, '', 'LR', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["FARMSvppZ"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Ln(5);
//    
//        //sanitarni VŠS
//        $pdf->Cell(53, 5, 'Sanitarni tehničari', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNIVvppZ"], 'RT', 0, 'C', 0, 0, 1);
//      $pdf->Ln(5);
//        //sanitarni SSS
//          $pdf->Cell(53, 5, '', 'LR', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["SANITARNISvppZ"], 'RT', 0, 'C', 0, 0, 1);
//      $pdf->Ln(5);
//      
//      
//      //Radnoterapeutski tehničara nema
//          $pdf->Cell(53, 5, 'Radnoterapeutski tehničari', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["RTTVvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//          $pdf->Cell(53, 5, '', 'LR', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RTB', 0, 'C', 0, 0, 1);
//
//    $pdf->Ln(5);
//      
//        //LAB VŠS
//        $pdf->Cell(53, 5, 'Laboratorijski tehničari', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVUkM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVUkZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVdotcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVdotcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVdoccM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVdoccZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVdopcM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVdopcZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVvppM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABVvppZ"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//        //LAB VSS
//        $pdf->Cell(53, 5, '', 'LRB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RTB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSUkM"], 'RTB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSUkZ"], 'RTB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSdotcM"], 'RTB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSdotcZ"], 'RTB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSdoccM"], 'RTB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSdoccZ"], 'RTB', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSdopcM"], 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSdopcZ"], 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSvppM"], 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, $row["LABSvppZ"], 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//      $pdf->Cell(53, 5, 'Zubni tehničari', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//          $pdf->Cell(53, 5, '', 'LR', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//      $pdf->Cell(53, 5, 'Ostali profili', 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'viša', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
//          $pdf->Cell(53, 5, '', 'BLR', 0, 'C', 0, 0, 1);
//    $pdf->Cell(17, 5, 'srednja', 'RTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 5, '0', 'RBT', 0, 'C', 0, 0, 1);
//    $pdf->Ln(5);
        
        
    $pdf->lastPage();

        
        
        
        
$pdf->Output('example_005.pdf', 'I');


/*$query = "SELECT COUNT(*) as ukupno, "
        . "(SELECT COUNT(*) FROM djel t2 WHERE (t2.titula=42) AND (t2.status LIKE '01%') AND (t2.spec1 = ".$spec["ID"]." or t2.spec2 = ".$spec["ID"]." or t2.spec3 = ".$spec["ID"].")) as prof, "
        . "(SELECT COUNT(*) FROM djel t3 WHERE (t3.titula=10) AND (t3.status LIKE '01%') AND (t3.spec1 = ".$spec["ID"]." or t3.spec2 = ".$spec["ID"]." or t3.spec3 = ".$spec["ID"].")) as doc, "
        . "(SELECT COUNT(*) FROM djel t4 WHERE (t4.titula=12) AND (t4.status LIKE '01%') AND (t4.spec1 = ".$spec["ID"]." or t4.spec2 = ".$spec["ID"]." or t4.spec3 = ".$spec["ID"].")) as dr, "
        . "(SELECT COUNT(*) FROM djel t5 WHERE (t5.titula=32) AND (t5.status LIKE '01%') AND (t5.spec1 = ".$spec["ID"]." or t5.spec2 = ".$spec["ID"]." or t5.spec3 = ".$spec["ID"].")) as mr, "
        . "(SELECT COUNT(*) FROM (SELECT COUNT(*) as rmcount FROM djel t6 INNER JOIN NOMRM ON NOMRM.NAZIV LIKE 'specijalizant ".$spec['NAZIV']."%' ) djel t6 WHERE (t6.RM LIKE 'specijalizant ".$spec['NAZIV']."%') AND (t6.status LIKE '01%') ) as naspec "
        . "FROM djel t1 WHERE t1.spec1 = ".$spec["ID"]." or t1.spec2 = ".$spec["ID"]." or t1.spec3 = ".$spec["ID"]."";	*/