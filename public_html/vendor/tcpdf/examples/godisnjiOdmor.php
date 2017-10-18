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

$counter=0;
$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('L', 'A4');
$pdf->SetLineWidth(0.1);
$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
$fill = $pdf->SetFillColor(217, 217, 217);

//$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
$pdf->writeHTMLCell(10, 12, '', '', 'REDNI BROJ', 1, 0, false, true, 'C', true);
$pdf->Cell(76, 10, 'DJELATNIK', 'TRL', 0, 'C');
//$pdf->writeHTMLCell(68, 10, '', '', 'DJELATNIK', 1, 0, false, true, 'C', true);
//$pdf->Cell(20, 5, 'ZAKONSKI MIN.', 'LR', 0, 'C', 0, 0, 1);
$pdf->writeHTMLCell(20, 12, '', '', 'ZAKONSKI MINIMUM', 1, 0, false, true, 'C', true);
//$pdf->Cell(15, 5, 'RS G-M-D', 'LR', 0, 'C', 0, 0, 1);
$pdf->writeHTMLCell(21, 12, '', '', 'RADNI STAŽ G-M-D', 1, 0, false, true, 'C', true);
//$pdf->Cell(15, 5, 'PREMA SS', 'LR', 0, 'C', 0, 0, 1);
$pdf->writeHTMLCell(20, 12, '', '', 'PREMA STRUČNOJ SPREMI', 1, 0, false, true, 'C', true);
//$pdf->Cell(25, 5, 'PREMA UVJ. RADA', 'LR', 0, 'C');
$pdf->writeHTMLCell(20, 12, '', '', 'PREMA UVJETIMA RADA', 1, 0, false, true, 'C', true);
//$pdf->Cell(35, 5, 'PREMA POS. SOC. UVJETIMA', 'LR', 0, 'C', 0, 0, 1);
$pdf->writeHTMLCell(20, 12, '', '', 'PREMA SOCIJALNIM UVJETIMA', 1, 0, false, true, 'C', true);
//$pdf->Cell(35, 5, 'PREMA RADNOM STAZU', 'LR', 0, 'C', 0, 0, 1);
$pdf->writeHTMLCell(20, 12, '', '', 'PREMA RADNOM STAŽU', 1, 0, false, true, 'C', true);
$pdf->Cell(20, 12, 'UKUPNO', 'TRL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 12, 'OD DATUMA', 'TRL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 12, 'DO DATUMA', 'TRL', 0, 'C', 0, 0, 1);
$pdf->Ln(12);    

////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////// klinika query
////////////////////////////////////////////////////////////////////////////
$query = "SELECT *, nomtit.IDe as TITL, nomss.GO as GOD, nomrm.INDEX "
        . "FROM djel "
        . "LEFT JOIN nomrm "
        . "ON djel.RM = nomrm.ID "
        . "LEFT JOIN godod "
        . "ON djel.ID = godod.DJEL "
        . "LEFT JOIN nomtit "
        . "ON djel.TITULA = nomtit.ID "
        . "LEFT JOIN nomss "
        . "ON djel.SSRM = nomss.ID "
        . "WHERE STATUS LIKE '01%' AND KLINIKA = '".$_GET['klinika']."' AND ODJEL IS NULL ORDER BY nomrm.INDEX ";
$resultklinika = mysqli_query($con, $query);
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// ispisivanje query-ja klinike
    ////////////////////////////////////////////////////////////////////////////
while($row =  mysqli_fetch_assoc($resultklinika)){
    $urs = rest($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
    $counter++;
    $pdf->Cell(10, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(76, 5, $row['TITL'].' '. $row["IME"] . ' ' . $row["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, '20', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(7, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(7, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(7, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, $row["GOD"], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, $row["RADU"], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, $row["SOCU"], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, $row["RS"], 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 5, $row["UKUPNO"], 'LRTB', 0, 'C', 0, 0, 1);
    if($row["GODODOD"]==='NULL' | date2mysql($row["GODODOD"])==='01.01.1970'){
        $pdf->Cell(20, 5,'', 'LRTB', 0, 'C', 0, 0, 1);
    }
    else{
        $pdf->Cell(20, 5, date2mysql($row["GODODOD"]), 'LRTB', 0, 'C', 0, 0, 1);
    }
    if($row["GODODDO"]==='NULL' | date2mysql($row["GODODDO"])==='01.01.1970'){
        $pdf->Cell(20, 5, '', 'LRTB', 0, 'C', 0, 0, 1);
    }else{
        $pdf->Cell(20, 5, date2mysql($row["GODODDO"]), 'LRTB', 0, 'C', 0, 0, 1);
    }
    $pdf->Ln(5);
}
$query = "SELECT * FROM odjeli WHERE SIFRA LIKE '".$_GET['klinika']."%' ORDER BY SIFRA ";
$resodjel = mysqli_query($con, $query);
while($rowodjel = mysqli_fetch_assoc($resodjel)){
    
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodjel query
    ////////////////////////////////////////////////////////////////////////////
    $query = "SELECT *, nomtit.IDe as TITL, nomss.GO as GOD, nomrm.INDEX "
            . "FROM djel "
            . "LEFT JOIN nomrm "
            . "ON djel.RM = nomrm.ID "
            . "LEFT JOIN godod "
            . "ON djel.ID = godod.DJEL "
            . "LEFT JOIN nomtit "
            . "ON djel.TITULA = nomtit.ID "
            . "LEFT JOIN nomss "
            . "ON djel.SSRM = nomss.ID "
            . "WHERE STATUS LIKE '01%' AND ODJEL = '".$rowodjel['SIFRA']."' AND ODSJEK IS NULL ORDER BY nomrm.INDEX ";
    $resultodjel = mysqli_query($con, $query);
    if(mysqli_num_rows($resultodjel)===0){
    }else{
        $pdf->Cell(267, 5, $rowodjel['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
        $pdf->Ln(5);
    }
    while($rowz = mysqli_fetch_assoc($resultodjel)){
        $urs = rest($rowz['DZRO'], $rowz['DPRO'], $rowz['SSTAZDANI'], $rowz['SSTAZMJ'], $rowz['SSTAZGOD']);
        $counter++;
        $pdf->Cell(10, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(76, 5, $rowz['TITL'].' '.$rowz["IME"] . ' ' . $rowz["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, '20', 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(7, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(7, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(7, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowz["GOD"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowz["RADU"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowz["SOCU"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowz["RS"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowz["UKUPNO"], 'LRTB', 0, 'C', 0, 0, 1);
        if($rowz["GODODOD"]==='NULL' | date2mysql($rowz["GODODOD"])==='01.01.1970'){
            $pdf->Cell(20, 5,'', 'LRTB', 0, 'C', 0, 0, 1);
        }
        else{
            $pdf->Cell(20, 5, date2mysql($rowz["GODODOD"]), 'LRTB', 0, 'C', 0, 0, 1);
        }
        if($rowz["GODODDO"]==='NULL' | date2mysql($rowz["GODODDO"])==='01.01.1970'){
            $pdf->Cell(20, 5, '', 'LRTB', 0, 'C', 0, 0, 1);
        }else{
            $pdf->Cell(20, 5, date2mysql($rowz["GODODDO"]), 'LRTB', 0, 'C', 0, 0, 1);
        }
        $pdf->Ln(5);     
    }
    $query = "SELECT * FROM odsjeci WHERE SIFRA LIKE '".$rowodjel['SIFRA']."%' ORDER BY SIFRA ";
    $resodsjek = mysqli_query($con, $query);
    while($rowodsjek = mysqli_fetch_assoc($resodsjek)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodsjek query
    ////////////////////////////////////////////////////////////////////////////
        $query = "SELECT *, nomtit.IDe as TITL, nomss.GO as GOD, nomrm.INDEX "
                . "FROM djel "
                . "LEFT JOIN nomrm "
                . "ON nomrm.ID = djel.RM "
                . "LEFT JOIN godod "
                . "ON djel.ID = godod.DJEL "
                . "LEFT JOIN nomtit "
                . "ON djel.TITULA = nomtit.ID "
                . "LEFT JOIN nomss "
                . "ON djel.SSRM = nomss.ID "
                . "WHERE STATUS LIKE '01%' AND odsjek = '".$rowodsjek['SIFRA']."' ORDER BY nomrm.INDEX ";
        $resultodsjek = mysqli_query($con, $query);  
        if(mysqli_num_rows($resultodsjek)===0){
        }else{
            $pdf->Cell(267, 5, $rowodsjek['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
            $pdf->Ln(5);
        }
        while($rowzy = mysqli_fetch_assoc($resultodsjek)){
            $urs = rest($rowzy['DZRO'], $rowzy['DPRO'], $rowzy['SSTAZDANI'], $rowzy['SSTAZMJ'], $rowzy['SSTAZGOD']);
            $counter++;
        $pdf->Cell(10, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(76, 5, $rowzy['TITL'].' '.$rowzy["IME"] . ' ' . $rowzy["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, '20', 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(7, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(7, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(7, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowzy["GOD"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowzy["RADU"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowzy["SOCU"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowzy["RS"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(20, 5, $rowzy["UKUPNO"], 'LRTB', 0, 'C', 0, 0, 1);
        $godod = $rowzy["GODODOD"];
        $goddo = $rowzy["GODODDO"];
        if($rowzy["GODODOD"]==='NULL' | date2mysql($rowzy["GODODDO"])==='01.01.1970'){
            $pdf->Cell(20, 5,'', 'LRTB', 0, 'C', 0, 0, 1);
        }
        else{
            $pdf->Cell(20, 5, date2mysql($godod), 'LRTB', 0, 'C', 0, 0, 1);
        }
        if($rowzy["GODODDO"]==='NULL' | date2mysql($rowzy["GODODDO"])==='01.01.1970'){
            $pdf->Cell(20, 5, '', 'LRTB', 0, 'C', 0, 0, 1);
        }else{
            $pdf->Cell(20, 5, date2mysql($goddo), 'LRTB', 0, 'C', 0, 0, 1);
        }
            $pdf->Ln(5);
        }
    }
}
$suma +=$counter;    
$pdf->lastPage();
//$pdf->resetHeaderTemplate();

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