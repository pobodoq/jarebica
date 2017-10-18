<?php
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
include_once('report_search.php');
//include_once('report_functions.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 005');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$logo = "..//images/logo.gif";
$logoWidth = 55;
$title = 'UKUPAN BROJ UPOSLENIH PO ODJELIMA';


// set header and footer fonts
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
//
//// add a page
//$pdf->AddPage('L', 'A4');
//
//// set cell padding
//$pdf->setCellPaddings(0, 0, 0, 0);
//
//// set cell margins
//$pdf->setCellMargins(0, 0, 0, 0);
//
//// set color for background
//$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example

// Multicell test
//$pdf->MultiCell(55, 5, '[LEFT] '.$txt, 1, 'L', 1, 0, '', '', true);
//$pdf->MultiCell(55, 5, '[RIGHT] '.$txt, 1, 'R', 0, 1, '', '', true);
//$pdf->MultiCell(55, 5, '[CENTER] '.$txt, 1, 'C', 0, 0, '', '', true);
//$pdf->MultiCell(55, 5, '[JUSTIFY] '.$txt."\n", 1, 'J', 1, 2, '' ,'', true);
//$pdf->MultiCell(55, 5, '[DEFAULT] '.$txt, 1, 'L', 0, 1, '', '', true);


include('db.php');
//$query = "SELECT COUNT(*) FROM kbodjeli";
//$result = mysqli_query($con, $query);
//$count = mysqli_fetch_row($result);
//$query = "SELECT ID, NAZIV FROM kbodjeli";
//$res = mysqli_query($con, $query);
//$odjeli = array();
//$date = new DateTime(date("Y-m-d"));  
//$d = $date->d;
//$m = $date->m;
//$y = $date->y;
$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title, ''.date_format($date, 'd.m.Y'));
//    $odjeli[] = $rowy; 
$pdf->AddPage('P', 'A4');

// set cell padding
$pdf->setCellPaddings(0, 0, 0, 0);

// set cell margins
$pdf->setCellMargins(0, 0, 0, 0);

// set color for background
$pdf->SetFillColor(255, 255, 127);
    $pdf->Cell(35, '', '', 0);
    $pdf->Cell(8, 5, 'R.B.', 'LRB', 0, 'C');
    $pdf->Cell(105, 5, 'ODJEL', 'LRB', 0, 'C');
    $pdf->Cell(15, 5, 'BROJ UPOSLENIH', 'LRB', 0, 'C');
    
    $pdf->Ln(5);
    
$query = "SELECT SIFRA FROM klinika";
$result = mysqli_query($con, $query);
$rows = array();
$counter=0;
//$row =  mysqli_fetch_row($result);
while($row =  mysqli_fetch_row($result)){
    $counter++;
//    $rows[] = $row;
//    $query = "SELECT COUNT(*) FROM djel "
//            . "INNER JOIN kbodjeli "
//            . "ON kbodjeli.ID = ".$row[0]." ";
    $query = "SELECT COUNT(*) FROM djel WHERE klinika LIKE '".$row[0]."' ";
    $res = mysqli_query($con, $query);
    while($rowy = mysqli_fetch_row($res)){
        $quer = "SELECT NAZIV FROM klinika WHERE SIFRA LIKE '".$row[0]."' ORDER BY NAZIV ASC";
        $re = mysqli_query($con, $quer);
        $rowdb = mysqli_fetch_row($re);
    $pdf->Cell(35, '', '', 0);
    $pdf->Cell(8, 5, $counter, 'LR', 0, 'C');
    $pdf->Cell(105, 5, $rowdb[0], 'LR', 0, 'C');
    $pdf->Cell(15, 5, $rowy[0], 'LR', 0, 'C');
    
    $pdf->Ln(5);
//    $pdf->Cell(40, 6, $rowy, 'LR', 'C');
    }
}



//    $pdf->Cell(8, 6, '1', 'LR', 0, 'C');
//    $pdf->Cell(55, 6, $row[1], 'LR', 'C');
//    $pdf->Cell(40, 6, $row[0], 'LR', 'C');
//while($row =  mysqli_fetch_assoc($result)){
//    
//
//    $pdf->Ln(6);
////    $pdf->cell
////    $pdf->cell
//}

$pdf->lastPage();
//$pdf->resetHeaderTemplate();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_005.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
