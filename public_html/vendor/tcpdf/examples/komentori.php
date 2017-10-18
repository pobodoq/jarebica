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
$title = 'PRIJEDLOG KANDIDATA ZA KOMENTORE';
$title1 = 'SPECIJALIZACIJA ODNOSNO SUBSPECIJALIZACIJA';


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
//include_once('report_search.php');
//include_once('report_functions.php');




    $date = new DateTime(date("Y-m-d"));
//$d = $date->d;
//$m = $date->m;
//$y = $date->y;
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->SetHeaderData($logo, $logoWidth, '', $title .PHP_EOL . $title1 . PHP_EOL . date_format($date, 'd.m.Y'));
    $pdf->SetFont('dejavusans', '', 8);
//    $odjeli[] = $rowy; 
    $pdf->AddPage('P', 'A4');

// set cell padding
    $pdf->setCellPaddings(0, 0, 0, 0);

// set cell margins
    $pdf->setCellMargins(0, 0, 0, 0);

// set color for background
    $pdf->SetFillColor(255, 255, 127);
    $query = "SELECT ID, NAZIV, SIFRA FROM klinike";

$res = mysqli_query($con, $query);
//$odjeli = array();
$i=1;
//za svaki odjel nova stranica
//        $pdf->Cell(10, 5, 'R.B.', 'LRBT', 0, 'C');
//        $pdf->Cell(100, 5, 'Ime i prezime', 'LRBT', 0, 'C');
//        $pdf->Cell(20, 5, 'Završetak spec.', 'LRBT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(50, 5, 'STAŽ', 'LRBT', 0, 'C', 0, 0, 1);
//        $pdf->Ln(5);
while($rowz = mysqli_fetch_assoc($res)){
    
    $query = "SELECT *, nomtit.IDe as TITL, sp1.NAZIV as spec1, sp2.NAZIV as spec2, sp3.NAZIV as spec3, sbsp1.NAZIV as subspec1, sbsp2.NAZIV as subspec2, sbsp3.NAZIV as subspec3 "
            . "FROM djel "
            . "LEFT JOIN specijalizacija sp1 "
            . "ON sp1.ID = djel.SPEC1 "
            . "LEFT JOIN specijalizacija sp2 "
            . "ON sp2.ID = djel.SPEC2 "
            . "LEFT JOIN specijalizacija sp3 "
            . "ON sp3.ID = djel.SPEC3 "
            . "LEFT JOIN subspecijalizacija sbsp1 "
            . "ON sbsp1.ID = djel.SUBSPEC1 "
            . "LEFT JOIN subspecijalizacija sbsp2 "
            . "ON sbsp2.ID = djel.SUBSPEC2 "
            . "LEFT JOIN subspecijalizacija sbsp3 "
            . "ON sbsp3.ID = djel.SUBSPEC3 "
            . "LEFT JOIN nomtit "
            . "ON djel.TITULA = nomtit.ID "
            . "WHERE djel.SPEC1 IS NOT NULL AND DPRO IS NULL AND djel.KLINIKA LIKE '".$rowz['SIFRA']."%' ";

    $result = mysqli_query($con, $query);
//    print_r($query);
    $counter=0;
    
//    if(mysqli_num_rows($result)===0){            
//        $pdf->deletePage($pdf->PageNo());
//        $pdf->resetHeaderTemplate();

//    }else{
        
//        $pdf->Cell(10, 5, 'R.B.', 'LR', 0, 'C');
//        $pdf->Cell(100, 5, 'Ime i prezime', 'LR', 0, 'C');
//        $pdf->Cell(20, 5, 'Završetak spec.', 'LR', 0, 'C', 0, 0, 1);
////        $pdf->Cell(87, 6, 'RADNO MJESTO', 'LR', 0, 'C');
////        $pdf->Cell(36, 6, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
////        $pdf->Cell(11, 6, 'SS', 'LR', 0, 'C', 0, 0, 1);
////        $pdf->Cell(18, 6, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
////        $pdf->Cell(18, 6, 'DZRO', 'LR', 0, 'C', 0, 0, 1);
//        $pdf->Cell(50, 5, 'STAŽ', 'LR', 0, 'C', 0, 0, 1);
//        $pdf->Ln(5);
    
//    }
    if(mysqli_num_rows($result)===0){
        
    }else{
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(180, 10, $i++ .'. '. $rowz['NAZIV'], 0, 'C');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->Ln(10);
                $pdf->Cell(10, 5, 'R.B.', 'LRBT', 0, 'C');
        $pdf->Cell(100, 5, 'Ime i prezime, spec/subspec', 'LRBT', 0, 'C');
        $pdf->Cell(20, 5, 'Završetak spec.', 'LRBT', 0, 'C', 0, 0, 1);
        $pdf->Cell(50, 5, 'STAŽ', 'LRBT', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);
    }


while($row =  mysqli_fetch_assoc($result)){
    if(!empty($row)){
        
//        if(isset($_GET['staz'])){
//            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
//            $staz = $_GET['staz'];
//            if($staz<=$urs[2]){
    $urs = rs($row["DATUMSPEC1"]);
    if($urs[2]>= 5){
    $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist '.$row["spec1"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, mysql2date($row["DATUMSPEC1"]), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, $urs[2] . ' god. ' . $urs[1] . ' mj. ' . $urs[0] . ' d. ', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Ln();

    if($row['spec2']!==null){
        $pdf->Ln();
        $urs = rs($row["DATUMSPEC2"]);
        $pdf->Cell(10, 5, '', 'LR', 0);
        $pdf->Cell(100, 5,'Specijalist '.$row["spec2"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, mysql2date($row["DATUMSPEC2"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(50, 5, $urs[2] . ' god. ' . $urs[1] . ' mj. ' . $urs[0] . ' d. ', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(75, 5, $row["spec2"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Ln();
    }
    if($row['spec3']!==null){
        $pdf->Ln();
        $urs = rs($row["DATUMSPEC3"]);
        $pdf->Cell(10, 5, '', 'LR', 0);
        $pdf->Cell(100, 5, 'Specijalist '.$row["spec3"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, mysql2date($row["DATUMSPEC3"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(50, 5, $urs[2] . ' god. ' . $urs[1] . ' mj. ' . $urs[0] . ' d. ', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(75, 5, $row["spec2"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Ln();
    }
    if($row['subspec1']!==null){
        $pdf->Ln();
        $urs = rs($row["DATUMSUBSPEC1"]);
        $pdf->Cell(10, 5, '', 'LR', 0);
        $pdf->Cell(100, 5, 'Subspecijalist '.$row["subspec1"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, mysql2date($row["DATUMSUBSPEC1"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(50, 5, $urs[2] . ' god. ' . $urs[1] . ' mj. ' . $urs[0] . ' d. ', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(75, 5, $row["spec2"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Ln();
    }
        if($row['subspec2']!==null){
        $pdf->Ln();
        $urs = rs($row["DATUMSUBSPEC2"]);
        $pdf->Cell(10, 5, '', 'LR', 0);
        $pdf->Cell(100, 5, 'Subspecijalist '.$row["subspec2"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, mysql2date($row["DATUMSUBSPEC2"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(50, 5, $urs[2] . ' god. ' . $urs[1] . ' mj. ' . $urs[0] . ' d. ', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(75, 5, $row["spec2"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Ln();
    }
    if($row['subspec3']!==null){
        $pdf->Ln();
        $urs = rs($row["DATUMSUBSPEC3"]);
        $pdf->Cell(10, 5, '', 'LR', 0);
        $pdf->Cell(100, 5, 'Subspecijalist '.$row["subspec3"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, mysql2date($row["DATUMSUBSPEC3"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(50, 5, $urs[2] . ' god. ' . $urs[1] . ' mj. ' . $urs[0] . ' d. ', 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(75, 5, $row["spec2"], 'RT', 0, 'C', 0, 0, 1);
    }
    $pdf->Ln(5);
    $pdf->Cell(180, 0, '', 'T');
    
    
//    $pdf->Cell(75, 5, $row["spec3"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(75, 5, $row["subspec1"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(75, 5, $row["subspec2"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(75, 5, $row["subspec3"], 'RT', 0, 'C', 0, 0, 1);
    
    
//    $pdf->Cell(75, 5, $row["spec2"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(87, 6, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(36, 6, $row["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(11, 6, $row["SAS"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(18, 6, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(18, 6, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(7, 5, $urs[2], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(7, 5, $urs[1], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(7, 5, $urs[0], 'RT', 0, 'C', 0, 0, 1);

    $pdf->Ln(0);
//            }
//        }else{}
    }
    }
    
}
if($rowz['SIFRA']==='0001'){
        $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' dr.sc. Diana Zelenika', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist interne medicine', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '23.04.1998' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '17 god. 11 mj. 6 d. ', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln();
        $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Subspecijalist kardiologije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '17.6.2005' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '10 god. 9 mj. 12 d. ', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln();
}
if($rowz['SIFRA']==='0014'){
            $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prim.doc.dr.sc. Vjekoslav Mandić', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist ginekologije i opstetricije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '27.01.1998' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '18 god. 2 mj. 2 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
        $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Subspecijalist zdravstvenog menadžmenta', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '08.09.2014' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '1 god. 6 mj. 21 d. ', 'RT', 0, 'C', 0, 0, 1);//izra
    $pdf->Ln();

    $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Ante Ćorušić', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist ginekologije i opstetricije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '17.12.1992' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '23 god. 3 mj. 12 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
        $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Subspecijalist ginekološke onkologije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '02.11.2004' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '1 god. 4 mj. 27 d. ', 'RT', 0, 'C', 0, 0, 1);//izracunati
    $pdf->Ln();
    
        $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Herman Haller', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist ginekologije i opstetricije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '24.05.1995' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '20 god. 10 mj. 5 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
        $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Subspecijalist ginekološke onkologije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '12.04.2005' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '10 god. 11 mj. 17 d. ', 'RT', 0, 'C', 0, 0, 1);//izracunati
    $pdf->Ln();
}
if($rowz['SIFRA']==='0018'){
            $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Vesna Golubović', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist anestezije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '14.03.1975' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '41 god. 0 mj. 15 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
        $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Subspecijalist intezivne medicine', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '12.06.2006' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '9 god. 9 mj. 17 d. ', 'RT', 0, 'C', 0, 0, 1);//izracunati
    $pdf->Ln();
    
    $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Mladen Perić', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist anesteziologije i reanimacije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '29.05.1985' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '30 god. 10 mj. 0 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
        $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Subspecijalist intezivne medicine', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '04.11.2004' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '11 god. 4 mj. 25 d. ', 'RT', 0, 'C', 0, 0, 1);//izracunati
    $pdf->Ln();
}
if($rowz['SIFRA']==='0015'){
    $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Vlado Petric', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist otorinolaringologije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '24.12.1974' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '41 god. 3 mj. 5 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
    
                $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Vedran Uglešić', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist maksilofakcijalne kirurgije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '08.05.1990' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '25 god. 10 mj. 21 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
}
//if($rowz['SIFRA']==='0003'){
//                $counter++;
//    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->SetFont('dejavusans', 'B', 8);
//    $pdf->Cell(100, 5, ' prof.dr.sc. Ivan Gilja', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->SetFont('dejavusans', '', 8);
//    $pdf->Cell(20, 5, '', 'RT');
//    $pdf->Cell(50, 5, '', 'RT');    
//    $pdf->Ln();
//    $pdf->Cell(10, 5, '', 'LR', 0);
//    $pdf->Cell(100, 5, 'Specijalist urologije', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(20, 5, '19.10.1981' , 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(50, 5, '34 god. 5 mj. 10 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
//    $pdf->Ln();
//
//}
if($rowz['SIFRA']==='0012'){
                $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Josip Mašković', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist radiologije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '23.08.1974' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '41 god. 7 mj. 6 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
}
if($rowz['SIFRA']==='0006'){
                $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Zdravko Mandić', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist oftalmologije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '14.12.1981' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '34 god. 3 mj. 15 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
}
if($rowz['SIFRA']==='0013'){
                $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Marija Definis-Gojanović', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist sudske medicine', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '26.04.1993' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '22 god. 11 mj. 3 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();

}
//if($rowz['SIFRA']==='0005'){
//            $counter++;
//    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->SetFont('dejavusans', 'B', 8);
//    $pdf->Cell(100, 5, ' prof.dr.sc. Eduard Vrdoljak', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->SetFont('dejavusans', '', 8);
//    $pdf->Cell(20, 5, '', 'RT');
//    $pdf->Cell(50, 5, '', 'RT');    
//    $pdf->Ln();
//    $pdf->Cell(10, 5, '', 'LR', 0);
//    $pdf->Cell(100, 5, 'Specijalist radioterapije', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(20, 5, '27.11.1995' , 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(50, 5, '20 god. 4 mj. 2 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
//    $pdf->Ln();
//}
if($rowz['SIFRA']==='0008'){
            $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' mr.sc. Zdravko Kuzman', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist pedijatrije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '26.02.1998' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '18 god. 1 mj. 3 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
        $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Subspecijalist pedijatrijske neurologije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '24.10.2006' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '9 god. 5 mj. 5 d. ', 'RT', 0, 'C', 0, 0, 1);//izracunati
    $pdf->Ln();
}
if($rowz['SIFRA']==='0009'){
            $counter++;
    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->Cell(100, 5, ' prof.dr.sc. Ivan Vasilj', 'RT', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 8);
    $pdf->Cell(20, 5, '', 'RT');
    $pdf->Cell(50, 5, '', 'RT');    
    $pdf->Ln();
    $pdf->Cell(10, 5, '', 'LR', 0);
    $pdf->Cell(100, 5, 'Specijalist epidemiologije', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '06.03.1997' , 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(50, 5, '19 god. 0 mj. 23 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
    $pdf->Ln();
}
//if($rowz['SIFRA']==='0023'){
//    $counter++;
//    $pdf->Cell(10, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->SetFont('dejavusans', 'B', 8);
//    $pdf->Cell(100, 5, ' Ljiljana Pavlović', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->SetFont('dejavusans', '', 8);
//    $pdf->Cell(20, 5, '', 'RT');
//    $pdf->Cell(50, 5, '', 'RT');    
//    $pdf->Ln();
//    $pdf->Cell(10, 5, '', 'LR', 0);
//    $pdf->Cell(100, 5, 'Specijalist urgente medicine', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(20, 5, '26.02.1998' , 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(50, 5, '18 god. 1 mj. 3 d. ', 'RT', 0, 'C', 0, 0, 1); //izracunati
//    $pdf->Ln();
//        $pdf->Cell(10, 5, '', 'LR', 0);
//    $pdf->Cell(100, 5, 'Subspecijalist pedijatrijske neurologije', 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(20, 5, '24.10.2006' , 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(50, 5, '9 god. 5 mj. 5 d. ', 'RT', 0, 'C', 0, 0, 1);//izracunati
//    $pdf->Ln();
//}
}
$pdf->lastPage();
$pdf->resetHeaderTemplate();
//}

$pdf->Output('example_005.pdf', 'I');
function rs($spec){

            $date1 = new DateTime(date("Y-m-d", strtotime($spec)));
            $date2 = new DateTime(date("Y-m-d"));
//            $date2 = new DateTime(date("Y-m-d", $date));
            $diff = $date1->diff($date2);
                //sadasnji
        $ustazdani=$diff->d;
        $ustazmj=$diff->m;
        $ustazgod=$diff->y;

        if($ustazdani === 60){
            $ustazdani = 30;
            $ustazmj++;
        }
        if($ustazdani > 60){
            $ustazdani= fmod($ustazdani, 60);
            $ustazmj = $ustazmj + 2;
        }
        if($ustazdani > 30){
            $ustazdani = fmod($ustazdani, 30);
            $ustazmj++;
        }        
        if($ustazmj === 24){
            $ustazmj = 12;
            $ustazgod++;
        }
        if($ustazmj > 24){
            $ustazmj = fmod($ustazmj, 24);
            $ustazgod +=2;
        }
        if($ustazmj > 12){
            $ustazmj = fmod($ustazmj, 12);
            $ustazgod++;
        }
        $arr[0] = $ustazdani;
        $arr[1] = $ustazmj;
        $arr[2] = $ustazgod;
        return $arr;
}
function mysql2date($date){
    return date("d.m.Y",strtotime($date));
}
function date2mysql($date){
    return date("Y-m-d",strtotime($date));
}