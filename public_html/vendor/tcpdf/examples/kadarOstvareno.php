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
$title = 'POPIS MEDICINSKOG KADRA';


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
$pdf->SetHeaderData($logo, $logoWidth, $title, PHP_EOL . date_format($date, 'd.m.Y'));
$pdf->AddPage('L', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
$pdf->Cell(56, 5, 'Zdravstveni djelatnici', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(25, 5, 'Ostvareno 2015', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(25, 5, 'Ostvareno 2016', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(83, 5, 'Index 4/3', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(70, 5, 'Naziv radnog mjesta', 'LR', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
    
//if(isset($_GET['klinika'])){
//    $query = "SELECT * FROM klinike WHERE SIFRA LIKE '".$_GET["klinika"]."%';";
////    print_r($query);
//}else{
//    $query = "SELECT * FROM klinike";
//}
$sql_query = "SELECT ID, NAZIV FROM nomrm";
$rmList = mysqli_query($con, $sql_query);
$suma=0;
$counter=0;
//$fill = $pdf->SetFillColor(160, 160, 160);

while($rm = mysqli_fetch_assoc($rmList)){
    echo $rm['NAZIV'];
    echo $rm['ID'];
    $sql_query = "SELECT COUNT(*) as ukupno, "
                . "(SELECT COUNT(*) "
                    . "FROM djel t2 WHERE t2.rm = ".$rm['ID']." AND (t2.DZRO BETWEEN '1970-01-01' AND '2015-12-31') AND (t2.DPRO IS NULL OR t2.DPRO > '2015-12-31')) as prevYearCountPerRm, "
                . "(SELECT COUNT(*) "
                    . "FROM djel WHERE rm = ".$rm['ID']." AND DZRO BETWEEN '2015-12-31' AND '2016-12-31' AND DPRO IS NULL) as thisYearCountPerRm "
            . "FROM djel t1 WHERE t1.DPRO IS NULL ";
    $rmCount = mysqli_query($con, $sql_query);
    while($row= mysqli_fetch_assoc($rmCount)){
        $counter++;
        $pdf->Cell(8, 5, $counter, 'LRT', 0, 'L', 0, 0, 1);
        $pdf->Cell(56, 5, $rm['NAZIV'], 'RT', 0, 'L', 0, 0, 1);
        $pdf->Cell(25, 5, $row['prevYearCountPerRm'], 'RT', 0, 'L', 0, 0, 1);
        $pdf->Cell(25, 5, $row['thisYearCountPerRm'], 'RT', 0, 'L', 0, 0, 1);
        $pdf->Ln(5);  
    }    
}
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');

//                    . "FROM djel WHERE DZRO BETWEEN 2015-12-31 AND 2016-12-31 AND DPRO IS NULL) as thisYearCount "
//                . "(SELECT COUNT(*) "
//                . "(SELECT COUNT(*) "
//                    . "FROM djel WHERE DZRO BETWEEN 1970-01-01 AND 31.12.2015 AND (DPRO IS NULL OR DPRO > 2015-12-31)) as prevYearCount "