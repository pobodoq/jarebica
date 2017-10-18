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
//include('report_functions.php');


$query = "SELECT * FROM klinika";
$resklinika = mysqli_query($con, $query);
//print_r($query);

//$odjeli = array();
//za svaki odjel nova stranica
$suma=0;
while($rowklinika = mysqli_fetch_assoc($resklinika)){
    $counter=0;
    $date = new DateTime(date("Y-m-d"));
    $pdf->SetHeaderData($logo, $logoWidth, $title, $rowklinika['NAZIV'] . PHP_EOL . date_format($date, 'd.m.Y'));
    $pdf->AddPage('P', 'A4');
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
    $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS, nomstatusi.NAZIV as statusi "
            . "FROM djel "
            . "LEFT JOIN nomstatusi "
            . "ON djel.STATUS = nomstatusi.ID "
            . "LEFT JOIN nomss "
            . "ON djel.SS = nomss.ID " //ne radi zato što je to u bazi varchar...
            . "LEFT JOIN nomskspr "
            . "ON djel.SKSPR = nomskspr.ID "
            . "LEFT JOIN nomrm "
            . "ON djel.RM = nomrm.ID "
            . "LEFT JOIN nomzan "
            . "ON djel.ZAN = nomzan.ID "
            . "LEFT JOIN nomtit "
            . "ON djel.TITULA = nomtit.ID "
            . "WHERE klinika = '".$rowklinika['SIFRA']."'  AND odjel IS NULL ".$where." ORDER BY nomrm.INDEX ";
//    print_r($query);

    $resultklinika = mysqli_query($con, $query);    
//    if(mysqli_num_rows($result)===0){
//        $pdf->deletePage($pdf->PageNo());
//    }else{
        
        $pdf->Cell(9, 5, 'R.B.', 'LR', 0, 'C');
        $pdf->Cell(80, 5, 'DJELATNIK', 'LR', 0, 'C');        
        $pdf->Cell(36, 5, 'JMBG', 'LR', 0, 'C');
        $pdf->Cell(55, 5, 'ZANIMANJE', 'LR', 0, 'C');
        $pdf->Ln(5);    
//    }
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// ispisivanje queryija klinike
    ////////////////////////////////////////////////////////////////////////////
    while($row =  mysqli_fetch_assoc($resultklinika)){
//        if(!empty($row)){
            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
    $pdf->Cell(9, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(15, 6, $row["BRD"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(80, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(36, 5, $row["JMBG"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(55, 5, $row["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Ln(5);     
//        }
    }
    $query = "SELECT * FROM odjel WHERE SIFRA LIKE '".$rowklinika['SIFRA']."%' ";
    $resodjel = mysqli_query($con, $query);
//    print_r($query);
    while($rowodjel = mysqli_fetch_assoc($resodjel)){
//        if($rowklinika['SIFRA']===substr($rowodjel['SIFRA'], 0, 4)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodjel querzy
    ////////////////////////////////////////////////////////////////////////////
        $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS, nomstatusi.NAZIV as statusi "
            . "FROM djel "
            . "LEFT JOIN nomstatusi "
            . "ON djel.STATUS = nomstatusi.ID "
            . "LEFT JOIN nomss "
            . "ON djel.SS = nomss.ID " //ne radi zato što je to u bazi varchar...
            . "LEFT JOIN nomskspr "
            . "ON djel.SKSPR = nomskspr.ID "
            . "LEFT JOIN nomrm "
            . "ON djel.RM = nomrm.ID "
            . "LEFT JOIN nomzan "
            . "ON djel.ZAN = nomzan.ID "
            . "LEFT JOIN nomtit "
            . "ON djel.TITULA = nomtit.ID "
            . "WHERE odjel LIKE '".$rowodjel['SIFRA']."' AND odsjek IS NULL ".$where." ORDER BY nomrm.INDEX ";
//        }
        $resultodjel = mysqli_query($con, $query);
        if(mysqli_num_rows($resultodjel)===0){
        }else{
            
            $pdf->Cell(180, 5, $rowodjel['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
            $pdf->Ln(5);
        }
        while($rowz = mysqli_fetch_assoc($resultodjel)){
            $urs = rs($rowz['DZRO'], $rowz['DPRO'], $rowz['SSTAZDANI'], $rowz['SSTAZMJ'], $rowz['SSTAZGOD']);
            $counter++;
    $pdf->Cell(9, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(15, 6, $row["BRD"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(80, 5, $rowz["TITL"] . ' ' . $rowz["IME"] . ' ' . $rowz["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(36, 5, $rowz["JMBG"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(55, 5, $rowz["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Ln(5);     
        }
        $query = "SELECT * FROM odsjek WHERE SIFRA LIKE '".$rowodjel['SIFRA']."%' ";
//        print_r($query);
        $resodsjek = mysqli_query($con, $query);
        while($rowodsjek = mysqli_fetch_assoc($resodsjek)){
//            if($rowodjel['SIFRA']===substr($rowodsjek['SIFRA'], 0, 6)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodsjek query
    ////////////////////////////////////////////////////////////////////////////
            $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS, nomstatusi.NAZIV as statusi "
                . "FROM djel "
                . "LEFT JOIN nomstatusi "
                . "ON djel.STATUS = nomstatusi.ID "
                . "LEFT JOIN nomss "
                . "ON djel.SS = nomss.ID " //ne radi zato što je to u bazi varchar...
                . "LEFT JOIN nomskspr "
                . "ON djel.SKSPR = nomskspr.ID "
                . "LEFT JOIN nomrm "
                . "ON djel.RM = nomrm.ID "
                . "LEFT JOIN nomzan "
                . "ON djel.ZAN = nomzan.ID "
                . "LEFT JOIN nomtit "
                . "ON djel.TITULA = nomtit.ID "
                . "WHERE odsjek LIKE '".$rowodsjek['SIFRA']."' ".$where." ORDER BY nomrm.INDEX ";
//            }
            $resultodsjek = mysqli_query($con, $query);  
//                print_r($query);
            if(mysqli_num_rows($resultodsjek)===0){
            }else{
                $pdf->Cell(180, 5, $rowodsjek['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
                $pdf->Ln(5);
            }
            while($rowzy = mysqli_fetch_assoc($resultodsjek)){
                $urs = rs($rowzy['DZRO'], $rowzy['DPRO'], $rowzy['SSTAZDANI'], $rowzy['SSTAZMJ'], $rowzy['SSTAZGOD']);
                $counter++;
    $pdf->Cell(9, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(15, 6, $row["BRD"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(80, 5, $rowzy["TITL"] . ' ' . $rowzy["IME"] . ' ' . $rowzy["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(36, 5, $rowzy["JMBG"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(55, 5, $rowzy["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
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
$pdf->Ln(5);
$pdf->Cell(9, 5, $suma, 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Output('example_005.pdf', 'I');