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
include_once('report_searchs.php');

$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('L', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
$pdf->Cell(85, 5, 'DJELATNIK', 'LR', 0, 'C');
$pdf->Cell(85, 5, 'ZANIMANJE', 'LR', 0, 'C');
//$pdf->Cell(55, 5, 'RADNO MJESTO', 'LR', 0, 'C');
$pdf->Cell(35, 5, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
$pdf->Cell(14, 5, 'SS', 'LR', 0, 'C');
$pdf->Cell(10, 5, 'SSRM', 'LR', 0, 'C');
//$pdf->Cell(10, 5, 'SS', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(17, 5, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(17, 5, 'DZRO', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(30, 5, 'STAZ(g,m,d)', 'LR', 0, 'C', 0, 0, 1);  
$pdf->Ln(5);
    
   
$q = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomskspr.NAZIV as SKASPR, nomsas.NAZIV as SAS, nomssrm.NAZIV as SASRM FROM djel "
        . "LEFT JOIN nomtit "
        . "ON nomtit.ID = djel.TITULA "
        . "LEFT JOIN nomzan "
        . "ON nomzan.ID = djel.ZAN "
        . "LEFT JOIN nomskspr "
        . "ON nomskspr.ID = djel.SKSPR "
        . "LEFT JOIN nomss as nomsas "
        . "ON nomsas.ID = djel.SS "
        . "LEFT JOIN nomss as nomssrm "
        . "ON nomssrm.ID = djel.SSRM "
        . "WHERE STATUS LIKE '01%' AND VRSTA = 1 AND (PODVRSTA = 0102 OR PODVRSTA = 0104 OR PODVRSTA = 0105 OR PODVRSTA = 0202 OR PODVRSTA = 0303 OR PODVRSTA = 0302) AND (DPRO IS NULL AND (DATEDIFF(NOW(), DZRO)+sstazgod*365+sstazmj*30+sstazdani)>=10*365) ";
//        . "WHERE djel.ID IS NOT NULL ".$where." ";
$counter = 0;
$r = mysqli_query($con, $q);
while($row = mysqli_fetch_assoc($r)){
    $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
        $pdf->Cell(8, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(85, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(85, 5, $row["ZANIMANJE"], 'LRTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(55, 5, $row["RAM"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(35, 5, $row["SKASPR"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(14, 5, $row["SAS"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $row["SASRM"], 'LRTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 5, $row["SAS"], 'LRTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(17, 5, date2mysql($row["DATUMR"]), 'LRTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(17, 5, date2mysql($row["DZRO"]), 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);  
}

$pdf->lastPage();

//$logo = "..//images/logo.gif";
//$logoWidth = 55;
$title = 'POPIS DJELATNIKA';
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('L', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
$pdf->Cell(85, 5, 'DJELATNIK', 'LR', 0, 'C');
$pdf->Cell(85, 5, 'ZANIMANJE', 'LR', 0, 'C');
//$pdf->Cell(55, 5, 'RADNO MJESTO', 'LR', 0, 'C');
$pdf->Cell(35, 5, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
$pdf->Cell(14, 5, 'SS', 'LR', 0, 'C');
$pdf->Cell(10, 5, 'SSRM', 'LR', 0, 'C');
//$pdf->Cell(10, 5, 'SS', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(17, 5, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(17, 5, 'DZRO', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(30, 5, 'STAZ(g,m,d)', 'LR', 0, 'C', 0, 0, 1);  
$pdf->Ln(5);
    


   
$q = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomskspr.NAZIV as SKASPR, nomsas.NAZIV as SAS, nomssrm.NAZIV as SASRM FROM djel "
        . "LEFT JOIN nomtit "
        . "ON nomtit.ID = djel.TITULA "
        . "LEFT JOIN nomzan "
        . "ON nomzan.ID = djel.ZAN "
        . "LEFT JOIN nomskspr "
        . "ON nomskspr.ID = djel.SKSPR "
        . "LEFT JOIN nomss as nomsas "
        . "ON nomsas.ID = djel.SS "
        . "LEFT JOIN nomss as nomssrm "
        . "ON nomssrm.ID = djel.SSRM "
        . "WHERE (STATUS LIKE '01%' AND SSRM = 19 AND SS = 19 AND VRSTA = 1 AND (DPRO IS NULL AND (DATEDIFF(NOW(), DZRO)+sstazgod*365+sstazmj*30+sstazdani)>=5*365)) OR (STATUS LIKE '01%' AND SSRM = 19 AND SS = 15 AND VRSTA = 1 AND (DPRO IS NULL AND (DATEDIFF(NOW(), DZRO)+sstazgod*365+sstazmj*30+sstazdani)>=5*365)) OR BRD = 2281 ";
//        . "WHERE djel.ID IS NOT NULL ".$where." ";
$counter = 0;
$r = mysqli_query($con, $q);
while($row = mysqli_fetch_assoc($r)){
    $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
        $pdf->Cell(8, 5, $counter, 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(85, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(85, 5, $row["ZANIMANJE"], 'LRTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(55, 5, $row["RAM"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(35, 5, $row["SKASPR"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(14, 5, $row["SAS"], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $row["SASRM"], 'LRTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(10, 5, $row["SAS"], 'LRTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(17, 5, date2mysql($row["DATUMR"]), 'LRTB', 0, 'C', 0, 0, 1);
//        $pdf->Cell(17, 5, date2mysql($row["DZRO"]), 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $urs[2], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $urs[1], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $urs[0], 'LRTB', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);  
}
$pdf->Output('example_005.pdf', 'I');