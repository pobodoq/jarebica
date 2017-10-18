<?php    
///////////////////////////////////////////////////////////////////////////////////////////////////////////// nreport2a
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
    $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
            . "FROM djel "
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
            . "WHERE klinika = '".$rowklinika['SIFRA']."' ".$where." ORDER BY KLINIKA, ODJEL ASC";
//    print_r($query);

    $result = mysqli_query($con, $query);    
//    if(mysqli_num_rows($result)===0){
//        $pdf->deletePage($pdf->PageNo());
//    }else{
        
        $pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
        $pdf->Cell(55, 5, 'DJELATNIK', 'LR', 0, 'C');
        $pdf->Cell(55, 5, 'ZANIMANJE', 'LR', 0, 'C');
        $pdf->Cell(55, 5, 'RADNO MJESTO', 'LR', 0, 'C');
        $pdf->Cell(35, 5, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
        $pdf->Cell(10, 5, 'SS', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 5, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 5, 'DZRO', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(15, 5, 'STAZ', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);    
//    }
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// ispisivanje queryija klinike
    ////////////////////////////////////////////////////////////////////////////
    while($row =  mysqli_fetch_assoc($result)){
        if($row['ODJEL']===NULL){
//        if(!empty($row)){
            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
            $pdf->Cell(8, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 5, $row["ZANIMANJE"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 5, $row["RAM"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 5, $row["SKASPR"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(10, 5, $row["SAS"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(17, 5, date2mysql($row["DATUMR"]), 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(17, 5, date2mysql($row["DZRO"]), 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Ln(5);     
        }else{
                $query = "SELECT * FROM odjel WHERE SIFRA LIKE '".$rowklinika['SIFRA']."%' ";
    $resodjel = mysqli_query($con, $query);
//    print_r($query);
    while($rowodjel = mysqli_fetch_assoc($resodjel)){
//        if($rowklinika['SIFRA']===substr($rowodjel['SIFRA'], 0, 4)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodjel querzy
    ////////////////////////////////////////////////////////////////////////////
        $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
            . "FROM djel "
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
            . "WHERE odjel LIKE '".$rowodjel['SIFRA']."' ".$where." ORDER BY ODJEL, ODSJEK ASC ";
//        }
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result)===0){
        }else{
            
            $pdf->Cell(267, 5, $rowodjel['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
            $pdf->Ln(5);
        }
        while($rowz = mysqli_fetch_assoc($result)){
            if($rowz['ODSJEK']===NULL){
            $urs = rs($rowz['DZRO'], $rowz['DPRO'], $rowz['SSTAZDANI'], $rowz['SSTAZMJ'], $rowz['SSTAZGOD']);
            $counter++;
            $pdf->Cell(8, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 5, $rowz["TITL"] . ' ' . $rowz["IME"] . ' ' . $rowz["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 5, $rowz["ZANIMANJE"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 5, $rowz["RAM"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 5, $rowz["SKASPR"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(10, 5, $rowz["SAS"], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(17, 5, date2mysql($rowz["DATUMR"]), 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(17, 5, date2mysql($rowz["DZRO"]), 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
            $pdf->Ln(5);   
            }else{
                        $query = "SELECT * FROM odsjek WHERE SIFRA LIKE '".$rowodjel['SIFRA']."%' ";
//        print_r($query);
        $resodsjek = mysqli_query($con, $query);
        while($rowodsjek = mysqli_fetch_assoc($resodsjek)){
//            if($rowodjel['SIFRA']===substr($rowodsjek['SIFRA'], 0, 6)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodsjek query
    ////////////////////////////////////////////////////////////////////////////
            $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
                . "FROM djel "
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
                . "WHERE odsjek LIKE '".$rowodsjek['SIFRA']."' ".$where." ORDER BY ODSJEK";
//            }
            $result = mysqli_query($con, $query);  
//                print_r($query);
            if(mysqli_num_rows($result)===0){
            }else{
                $pdf->Cell(275, 5, $rowodsjek['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
                $pdf->Ln(5);
            }
            while($rowzy = mysqli_fetch_assoc($result)){
                $urs = rs($rowzy['DZRO'], $rowzy['DPRO'], $rowzy['SSTAZDANI'], $rowzy['SSTAZMJ'], $rowzy['SSTAZGOD']);
                $counter++;
                $pdf->Cell(8, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 5, $rowzy["TITL"] . ' ' . $rowzy["IME"] . ' ' . $rowzy["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 5, $rowzy["ZANIMANJE"], 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 5, $rowzy["RAM"], 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(35, 5, $rowzy["SKASPR"], 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(10, 5, $rowzy["SAS"], 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(17, 5, date2mysql($rowzy["DATUMR"]), 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(17, 5, date2mysql($rowzy["DZRO"]), 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
                $pdf->Ln(5);     
            }
        }
            }
        }

    }
        }
    }       
    $suma +=$counter; 
    
$pdf->lastPage();
$pdf->resetHeaderTemplate();
}
$pdf->Cell(5, 5, $suma, 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Output('example_005.pdf', 'I');