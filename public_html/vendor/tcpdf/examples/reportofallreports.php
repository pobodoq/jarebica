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


$query = "SELECT * FROM klinika";
$resklinika = mysqli_query($con, $query);
$query = "SELECT * FROM odjel";
$resodjel = mysqli_query($con, $query);
$query = "SELECT * FROM odsjek";
$resodsjek = mysqli_query($con, $query);
//$odjeli = array();
//za svaki odjel nova stranica
while($rowklinika = mysqli_fetch_assoc($resklinika)){
    $counter=0;
    $date = new DateTime(date("Y-m-d"));
    $pdf->SetHeaderData($logo, $logoWidth, $title, $rowklinika['NAZIV'] . PHP_EOL . date_format($date, 'd.m.Y'));
    $pdf->AddPage('L', 'A4');
    $pdf->setCellPaddings(0, 0, 0, 0);
    $pdf->setCellMargins(0, 0, 0, 0);
    $pdf->SetFillColor(255, 255, 127);
    $null = NULL;
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
            . "WHERE klinika = '".$rowklinika['SIFRA']."'  AND odjel IS NULL ".$where." ";
//    print_r($query);

    $result = mysqli_query($con, $query);    
    if(mysqli_num_rows($result)===0){
        $pdf->deletePage($pdf->PageNo());
    }else{
        
        $pdf->Cell(8, 6, 'R.B.', 'LR', 0, 'C');
        $pdf->Cell(55, 6, 'DJELATNIK', 'LR', 0, 'C');
        $pdf->Cell(55, 6, 'ZANIMANJE', 'LR', 0, 'C');
        $pdf->Cell(55, 6, 'RADNO MJESTO', 'LR', 0, 'C');
        $pdf->Cell(35, 6, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
        $pdf->Cell(10, 6, 'SS', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 6, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 6, 'DZRO', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(15, 6, 'STAZ', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Ln(6);    
    }
    while($row =  mysqli_fetch_assoc($result)){
        if(!empty($row)){

            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
            $pdf->Cell(8, 6, $counter, 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 6, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 6, $row["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(55, 6, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(35, 6, $row["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(10, 6, $row["SAS"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(17, 6, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(17, 6, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 6, $urs[2], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 6, $urs[1], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(5, 6, $urs[0], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Ln(6);     
        }
    }
        while($rowodjel = mysqli_fetch_assoc($resodjel)){
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
                . "WHERE klinika LIKE '".$rowklinika['SIFRA']."' AND odjel LIKE '".$rowodjel['SIFRA']."' ".$where." ";

            $result = mysqli_query($con, $query);  
            if(mysqli_num_rows($result)===0){
            }else{
                $pdf->Cell(255, 6, $rowodjel['NAZIV'], 'LR', 0, 'C');
                $pdf->Ln(6);
            }
            while($rowz = mysqli_fetch_assoc($result)){
                $urs = rs($rowz['DZRO'], $rowz['DPRO'], $rowz['SSTAZDANI'], $rowz['SSTAZMJ'], $rowz['SSTAZGOD']);
                $counter++;
                $pdf->Cell(8, 6, $counter, 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 6, $rowz["TITL"] . ' ' . $rowz["IME"] . ' ' . $rowz["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 6, $rowz["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 6, $rowz["RAM"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(35, 6, $rowz["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(10, 6, $rowz["SAS"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(17, 6, date2mysql($rowz["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(17, 6, date2mysql($rowz["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 6, $urs[2], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 6, $urs[1], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 6, $urs[0], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Ln(6);     
            }
             while($rowodsjek = mysqli_fetch_assoc($resodsjek)){
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
                . "WHERE klinika LIKE '".$rowklinika['SIFRA']."' AND odjel LIKE '".$rowodjel['SIFRA']."' AND odsjek LIKE '".$rowodsjek['SIFRA']."' ".$where." ";
            $result = mysqli_query($con, $query);  
//            print_r($query);
            if(mysqli_num_rows($result)===0){
            }else{
                $pdf->Cell(255, 6, $rowodsjek['NAZIV'], 'LR', 0, 'C');
                $pdf->Ln(6);
            }
            while($rowzy = mysqli_fetch_assoc($result)){
                $urs = rs($rowzy['DZRO'], $rowzy['DPRO'], $rowzy['SSTAZDANI'], $rowzy['SSTAZMJ'], $rowzy['SSTAZGOD']);
                $counter++;
                $pdf->Cell(8, 6, $counter, 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 6, $rowzy["TITL"] . ' ' . $rowzy["IME"] . ' ' . $rowzy["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 6, $rowzy["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(55, 6, $rowzy["RAM"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(35, 6, $rowzy["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(10, 6, $rowzy["SAS"], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(17, 6, date2mysql($rowzy["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(17, 6, date2mysql($rowzy["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 6, $urs[2], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 6, $urs[1], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Cell(5, 6, $urs[0], 'RT', 0, 'C', 0, 0, 1);
                $pdf->Ln(6);     
            }
        }
        }
       
$pdf->lastPage();
$pdf->resetHeaderTemplate();
}

$pdf->Output('example_005.pdf', 'I');
