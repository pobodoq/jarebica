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
$title = 'POPIS DJELATNIKA';


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
include('report_search.php');
include('report_functions.php');


$query = "SELECT * FROM klinike ORDER BY SIFRA";
$resklinika = mysqli_query($con, $query);
//print_r($query);

//$odjeli = array();
//za svaki odjel nova stranica
$suma=0;
while($rowklinika = mysqli_fetch_assoc($resklinika)){
    $counter=0;
//    print_r($rowklinika['SIFRA']);
    $date = new DateTime(date("Y-m-d"));
    $pdf->SetHeaderData($logo, $logoWidth, $title, $rowklinika['NAZIV'] . PHP_EOL . date_format($date, 'Y'));
    $pdf->AddPage('L', 'A4');
    $pdf->SetLineWidth(0.1);
    $pdf->setCellPaddings(0, 0, 0, 0);
    $pdf->setCellMargins(0, 0, 0, 0);
//    $pdf->SetFillColor(255, 255, 127);
    $fill = $pdf->SetFillColor(217, 217, 217);
//    rgb(242, 242, 242)
    
//    $null = NULL;
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// klinika query
    ////////////////////////////////////////////////////////////////////////////
//    $query = "SELECT *, nomtit.IDe AS TITL, godod.RADU as UR, godod.RS as RS, godod.SOCU as SU, godod.GO as UK, godod.gododod as GODIOD, godod.gododdo as GODIDO FROM djel LEFT JOIN godod WHERE djel.ID = godod.DJEL ";
    $query = "SELECT *, nomtit.IDe as TITL, nomss.GO as GOD, nomrm.INDEX "
            . "FROM djel "
            . "INNER JOIN nomrm "
            . "ON djel.RM = nomrm.ID "
            . "INNER JOIN godod "
            . "ON djel.ID = godod.DJEL "
            . "LEFT JOIN nomtit "
            . "ON djel.TITULA = nomtit.ID "
            . "LEFT JOIN nomss "
            . "ON djel.SSRM = nomss.ID "
            . "WHERE klinika = '".$rowklinika['SIFRA']."' AND ODJEL IS NULL ORDER BY nomrm.INDEX ";
    
//    $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
//            . "FROM djel "
//            . "LEFT JOIN nomss "
//            . "ON djel.SS = nomss.ID " //ne radi zato što je to u bazi varchar...
//            . "LEFT JOIN nomskspr "
//            . "ON djel.SKSPR = nomskspr.ID "
//            . "LEFT JOIN nomrm "
//            . "ON djel.RM = nomrm.ID "
//            . "LEFT JOIN nomzan "
//            . "ON djel.ZAN = nomzan.ID "
//            . "LEFT JOIN nomtit "
//            . "ON djel.TITULA = nomtit.ID "
//            . "WHERE klinika = '".$rowklinika['SIFRA']."'  AND odjel IS NULL ".$where." ";
//    print_r($query);

    $resultklinika = mysqli_query($con, $query);
//    if(mysqli_num_rows($result)===0){
//        $pdf->deletePage($pdf->PageNo());
//    }else{
        
        $pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
        $pdf->Cell(70, 5, 'DJELATNIK', 'LR', 0, 'C');
        $pdf->Cell(20, 5, 'ZAKONSKI MIN.', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(15, 5, 'RS G-M-D', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(15, 5, 'PREMA SS', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(25, 5, 'PREMA UVJ. RADA', 'LR', 0, 'C');
        $pdf->Cell(35, 5, 'PREMA POS. SOC. UVJETIMA', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(35, 5, 'PREMA RADNOM STAZU', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, 'UKUPNO', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 5, 'OD', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 5, 'DO', 'LR', 0, 'C', 0, 0, 1);

        $pdf->Ln(5);    
//    }
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// ispisivanje queryija klinike
    ////////////////////////////////////////////////////////////////////////////
    while($row =  mysqli_fetch_assoc($resultklinika)){
//        if(!empty($row)){
            $urs = rest($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
            $pdf->Cell(8, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(70, 5, $row['TITL'].' '. $row["IME"] . ' ' . $row["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(20, 5, '20', 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(15, 5, $row["GOD"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(25, 5, $row["RADU"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 5, $row["SOCU"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 5, $row["RS"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(10, 5, $row["UKUPNO"], 'LRTB', 0, 'C', 0, 0, 1);
            if($row["GODODOD"]==='NULL' | date2mysql($row["GODODOD"])==='01.01.1970'){
                $pdf->Cell(17, 5,'', 'LRTB', 0, 'C', 0, 0, 1);
            }
            else{
                $pdf->Cell(17, 5, date2mysql($row["GODODOD"]), 'LRTB', 0, 'C', 0, 0, 1);
            }
            if($row["GODODDO"]==='NULL' | date2mysql($row["GODODDO"])==='01.01.1970'){
                $pdf->Cell(17, 5, '', 'LRTB', 0, 'C', 0, 0, 1);
            }else{
                $pdf->Cell(17, 5, date2mysql($row["GODODDO"]), 'LRTB', 0, 'C', 0, 0, 1);
            }

            $pdf->Ln(5);     
//        }
    }
    $query = "SELECT * FROM odjel WHERE SIFRA LIKE '".$rowklinika['SIFRA']."%' ORDER BY SIFRA ";
    $resodjel = mysqli_query($con, $query);
//    print_r($query);
    while($rowodjel = mysqli_fetch_assoc($resodjel)){
//        if($rowklinika['SIFRA']===substr($rowodjel['SIFRA'], 0, 4)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodjel querzy
    ////////////////////////////////////////////////////////////////////////////
    //
    //
    //
    //
    $query = "SELECT *, nomtit.IDe as TITL, nomss.GO as GOD, nomrm.INDEX "
            . "FROM djel "
            . "INNER JOIN nomrm "
            . "ON djel.RM = nomrm.ID "
            . "INNER JOIN godod "
            . "ON djel.ID = godod.DJEL "
            . "LEFT JOIN nomtit "
            . "ON djel.TITULA = nomtit.ID "
            . "LEFT JOIN nomss "
            . "ON djel.SSRM = nomss.ID "
            . "WHERE odjel = '".$rowodjel['SIFRA']."' AND odsjek IS NULL ORDER BY nomrm.INDEX ";
//        $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
//            . "FROM djel "
//            . "LEFT JOIN nomss "
//            . "ON djel.SS = nomss.ID " //ne radi zato što je to u bazi varchar...
//            . "LEFT JOIN nomskspr "
//            . "ON djel.SKSPR = nomskspr.ID "
//            . "LEFT JOIN nomrm "
//            . "ON djel.RM = nomrm.ID "
//            . "LEFT JOIN nomzan "
//            . "ON djel.ZAN = nomzan.ID "
//            . "LEFT JOIN nomtit "
//            . "ON djel.TITULA = nomtit.ID "
//            . "WHERE odjel LIKE '".$rowodjel['SIFRA']."' AND odsjek IS NULL ".$where." ";
//        }
        $resultodjel = mysqli_query($con, $query);
        if(mysqli_num_rows($resultodjel)===0){
        }else{
            
            $pdf->Cell(267, 5, $rowodjel['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
            $pdf->Ln(5);
        }
        while($rowz = mysqli_fetch_assoc($resultodjel)){
            $urs = rest($rowz['DZRO'], $rowz['DPRO'], $rowz['SSTAZDANI'], $rowz['SSTAZMJ'], $rowz['SSTAZGOD']);
            $counter++;
            $pdf->Cell(8, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(70, 5, $rowz['TITL'].' '.$rowz["IME"] . ' ' . $rowz["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(20, 5, '20', 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(15, 5, $rowz["GOD"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(25, 5, $rowz["RADU"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 5, $rowz["SOCU"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 5, $rowz["RS"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(10, 5, $rowz["UKUPNO"], 'LRTB', 0, 'C', 0, 0, 1);
            if($rowz["GODODOD"]==='NULL' | date2mysql($rowz["GODODOD"])==='01.01.1970'){
                $pdf->Cell(17, 5,'', 'LRTB', 0, 'C', 0, 0, 1);
            }
            else{
                $pdf->Cell(17, 5, date2mysql($rowz["GODODOD"]), 'LRTB', 0, 'C', 0, 0, 1);
            }
            if($rowz["GODODDO"]==='NULL' | date2mysql($rowz["GODODDO"])==='01.01.1970'){
                $pdf->Cell(17, 5, '', 'LRTB', 0, 'C', 0, 0, 1);
            }else{
                $pdf->Cell(17, 5, date2mysql($rowz["GODODDO"]), 'LRTB', 0, 'C', 0, 0, 1);
            }

            $pdf->Ln(5);     
        }
        $query = "SELECT * FROM odsjek WHERE SIFRA LIKE '".$rowodjel['SIFRA']."%' ORDER BY SIFRA ";
//        print_r($query);
        $resodsjek = mysqli_query($con, $query);
        while($rowodsjek = mysqli_fetch_assoc($resodsjek)){
//            if($rowodjel['SIFRA']===substr($rowodsjek['SIFRA'], 0, 6)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodsjek query
    ////////////////////////////////////////////////////////////////////////////
    //
    //
    $query = "SELECT *, nomtit.IDe as TITL, nomss.GO as GOD, nomrm.INDEX "
            . "FROM djel "
            . "INNER JOIN nomrm "
            . "ON nomrm.ID = djel.RM "
            . "INNER JOIN godod "
            . "ON djel.ID = godod.DJEL "
            . "LEFT JOIN nomtit "
            . "ON djel.TITULA = nomtit.ID "
            . "LEFT JOIN nomss "
            . "ON djel.SSRM = nomss.ID "
            . "WHERE odsjek = '".$rowodsjek['SIFRA']."' ORDER BY nomrm.INDEX ";
//            $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
//                . "FROM djel "
//                . "LEFT JOIN nomss "
//                . "ON djel.SS = nomss.ID " //ne radi zato što je to u bazi varchar...
//                . "LEFT JOIN nomskspr "
//                . "ON djel.SKSPR = nomskspr.ID "
//                . "LEFT JOIN nomrm "
//                . "ON djel.RM = nomrm.ID "
//                . "LEFT JOIN nomzan "
//                . "ON djel.ZAN = nomzan.ID "
//                . "LEFT JOIN nomtit "
//                . "ON djel.TITULA = nomtit.ID "
//                . "WHERE odsjek LIKE '".$rowodsjek['SIFRA']."' ".$where." ";
//            }
            $resultodsjek = mysqli_query($con, $query);  
//                print_r($query);
            if(mysqli_num_rows($resultodsjek)===0){
            }else{
                $pdf->Cell(267, 5, $rowodsjek['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
                $pdf->Ln(5);
            }
            while($rowzy = mysqli_fetch_assoc($resultodsjek)){
                $urs = rest($rowzy['DZRO'], $rowzy['DPRO'], $rowzy['SSTAZDANI'], $rowzy['SSTAZMJ'], $rowzy['SSTAZGOD']);
                $counter++;
            $pdf->Cell(8, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(70, 5, $rowzy['TITL'].' '.$rowzy["IME"] . ' ' . $rowzy["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(20, 5, '20', 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(15, 5, $rowzy["GOD"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(25, 5, $rowzy["RADU"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 5, $rowzy["SOCU"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 5, $rowzy["RS"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(10, 5, $rowzy["UKUPNO"], 'LRTB', 0, 'C', 0, 0, 1);
            $godod = $rowzy["GODODOD"];
            $goddo = $rowzy["GODODDO"];
            if($rowzy["GODODOD"]==='NULL' | date2mysql($rowzy["GODODDO"])==='01.01.1970'){
                $pdf->Cell(17, 5,'', 'LRTB', 0, 'C', 0, 0, 1);
            }
            else{
                $pdf->Cell(17, 5, date2mysql($godod), 'LRTB', 0, 'C', 0, 0, 1);
            }
            if($rowzy["GODODDO"]==='NULL' | date2mysql($rowzy["GODODDO"])==='01.01.1970'){
                $pdf->Cell(17, 5, '', 'LRTB', 0, 'C', 0, 0, 1);
            }else{
                $pdf->Cell(17, 5, date2mysql($goddo), 'LRTB', 0, 'C', 0, 0, 1);
            }
            
            
            

                $pdf->Ln(5);     
            }
        }        
    }       
    $suma +=$counter; 
    
$pdf->lastPage();
$pdf->resetHeaderTemplate();
//    if(mysqli_num_rows($resultklinika)===0 & mysqli_num_rows($resultodjel)===0 & mysqli_num_rows($resultodsjek)===0){
//        $pdf->deletePage($pdf->PageNo());
//    }
}

$pdf->Output('example_005.pdf', 'I');
function rest($dzro, $dpro, $sstazdani, $sstazmj, $sstazgod){

        $date1 = new DateTime(date("Y-m-d",strtotime($dzro)));
        $date2 = new DateTime(date("Y-1-1"));
        $diff = $date1->diff($date2);
                //sadasnji
        $sadstazdani=$diff->d;
        $sadstazmj=$diff->m;
        $sadstazgod=$diff->y;

        
        $ustazdani = $sstazdani + $sadstazdani;
        $ustazmj = $sstazmj + $sadstazmj;
        $ustazgod = $sstazgod + $sadstazgod;

        
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