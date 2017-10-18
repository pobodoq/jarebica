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
include_once('report_search.php');
//include_once('report_functions.php');


$query = "SELECT ID, NAZIV, SIFRA FROM klinika";

$res = mysqli_query($con, $query);
//$odjeli = array();
$i=0;
//za svaki odjel nova stranica
while($rowy = mysqli_fetch_row($res)){

    $date = new DateTime(date("Y-m-d"));
//$d = $date->d;
//$m = $date->m;
//$y = $date->y;
    $pdf->SetHeaderData($logo, $logoWidth, $title, $rowy[1] . PHP_EOL . date_format($date, 'd.m.Y'));
//    $odjeli[] = $rowy; 
    $pdf->AddPage('L', 'A4');

// set cell padding
    $pdf->setCellPaddings(0, 0, 0, 0);

// set cell margins
    $pdf->setCellMargins(0, 0, 0, 0);

// set color for background
    $pdf->SetFillColor(255, 255, 127);
    
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
            . "WHERE klinika LIKE '".$rowy[2]."%' ".$where." ";

    $result = mysqli_query($con, $query);
//    print_r($query);
    $counter=0;
    
    if(mysqli_num_rows($result)===0){            
        $pdf->deletePage($pdf->PageNo());
//        $pdf->resetHeaderTemplate();

    }else{
        
        $pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
        $pdf->Cell(55, 5, 'DJELATNIK', 'LR', 0, 'C');
        $pdf->Cell(55, 5, 'ZANIMANJE', 'LR', 0, 'C');
        $pdf->Cell(55, 5, 'RADNO MJESTO', 'LR', 0, 'C');
        $pdf->Cell(35, 5, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
        $pdf->Cell(10, 5, 'SS', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 5, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 5, 'DZRO', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Cell(15, 5, 'STAZ(g,m,d)', 'LR', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);    
    }

while($row =  mysqli_fetch_assoc($result)){
    if(!empty($row)){
        
        $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
        $counter++;
        $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
        $pdf->Cell(55, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(55, 5, $row["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(55, 5, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(35, 5, $row["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(10, 5, $row["SAS"], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 5, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(17, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(5, 5, $urs[2], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(5, 5, $urs[1], 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(5, 5, $urs[0], 'RT', 0, 'C', 0, 0, 1);

        $pdf->Ln(5);
     
    }
        
}
$pdf->lastPage();
$pdf->resetHeaderTemplate();
}

$pdf->Output('example_005.pdf', 'I');
