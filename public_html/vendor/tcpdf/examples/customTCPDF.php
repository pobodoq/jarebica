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
$title = 'POPIS DJELATNIKA';


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
$query = "SELECT ID, NAZIV FROM kbodjeli";
$res = mysqli_query($con, $query);
//$odjeli = array();
$i=0;
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

$query = "SELECT IME, PREZIME, OTAC, DATUMR, JMBG, DZRO, DPRO, nomtit.IDe AS TITULA, nomrm.NAZIV AS RM, nomzan.NAZIV AS ZANIMANJE, nomskspr.NAZIV AS SKSP, nomss.NAZIV AS SS, kbodjeli.NAZIV AS ODJEL "
        . "FROM djel "
        . "LEFT JOIN nomtit "
        . "ON djel.TITULA = nomtit.ID "
        . "LEFT JOIN nomzan "
        . "ON djel.ZAN = nomzan.ID "
        . "LEFT JOIN nomskspr "
        . "ON djel.skspr = nomskspr.ID "
        . "LEFT JOIN kbodjeli "
        . "ON djel.kbodjel = kbodjeli.ID "
        . "LEFT JOIN nomrm "
        . "ON djel.rm = nomrm.ID "
        . "LEFT JOIN nomss "
        . "ON djel.ss = nomss.ID "
        . "WHERE DPRO IS NOT NULL AND kbodjeli.ID = '".$rowy[0]."' "
        . "ORDER BY nomzan.NAZIV ASC"; // . "ORDER BY nomzan.NAZIV DESC "; . "ORDER BY kbodjeli.NAZIV ASC ";
//FIELD(nomzan.ID,'3','4','5'), nomzan.NAZIV DESC  ovo je za order by field... koji field zelis.. odlicno ha...
$result = mysqli_query($con, $query);
$counter=0;
    $pdf->Cell(8, 6, 'R.B.', 'LR', 0, 'C');
    $pdf->Cell(70, 6, 'DJELATNIK', 'LR', 0, 'C');
//    $pdf->Cell(40, 6, 'PREZIME', 'LR', 0, 'C');    
    $pdf->Cell(44, 6, 'Ime oca', 'LR', 0, 'C');
//    $pdf->Cell(15, 6, 'OTAC', 'LR', 0, 'C');
    $pdf->Cell(55, 6, 'JMBG', 'LR', 0, 'C');
//    $pdf->Cell(40, 6, 'Školska sprema', 'LR', 0, 'C');
//    $pdf->Cell(10, 6, 'SS', 'LR', 0, 'C');
    $pdf->Cell(20, 6, 'Datum rođ.', 'LR', 0, 'C');
//    $pdf->Cell(20, 6, 'Datum ZRO', 'LR', 0, 'C');
//    $pdf->Cell(30, 6, 'Radni staŽ(g,m,d)', 'LR', 0, 'C');
//    $pdf->Cell(30, 6, 'Stručna sprema', 'LR', 0, 'C');
    $pdf->Ln(6);
while($row =  mysqli_fetch_assoc($result)){    
    
//    $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
    $counter++;
    $pdf->Cell(8, 6, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(70, 6, $row["TITULA"] . ' ' . $row["IME"]. ' '. $row["PREZIME"], 'LRT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(40, 6, $row["PREZIME"], 'RT', 0, 'C');
    $pdf->Cell(44, 6, $row["OTAC"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(15, 6, $row["OTAC"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(55, 6, $row["JMBG"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(40, 6, $row["SKSP"], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 6, $row["SS"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 6, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(20, 6, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 6, $urs[2], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 6, $urs[1], 'RT', 0, 'C', 0, 0, 1);
//    $pdf->Cell(10, 6, $urs[0], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(6);
//    $pdf->cell
//    $pdf->cell
}

//$pdf->MultiCell(10, 5, '9999', 1, 'L', 0, 0, '', '', true);
//$pdf->MultiCell(50, 5, ''.$txt, 1, 'L', 0, 1, '', '', true);
//$pdf->MultiCell(25, 5, 'Blago', 1, 'C', 0, 2, '', '', true);
//$pdf->Cell(55, 6, 'Dragan', 1, 0, 'L');
//$pdf->Cell(55, 6, 'Kvesic', 1, 0, 'L');
//$pdf->Ln(10);
//$pdf->Cell(55, 6, 'Dragan', 1, 0, 'L');
//$pdf->Cell(55, 6, 'Kvesic', 1, 0, 'L');
//$pdf->Cell(55, 6, 'Dragan', 1, 0, 'L');
//$pdf->Ln(10);
//
//$pdf->Cell(55, 6, 'Kvesic', 1, 0, 'L');
//$pdf->Cell(55, 6, 'Dragan', 1, 0, 'L');
//$pdf->Cell(55, 6, 'Kvesic', 1, 0, 'L');
//
//$pdf->Ln(10, 5);
//
//// set color for background
//$pdf->SetFillColor(220, 255, 220);
//
//// Vertical alignment
//$pdf->MultiCell(55, 40, '[VERTICAL ALIGNMENT - TOP] '.$txt, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'T');
//$pdf->MultiCell(55, 40, '[VERTICAL ALIGNMENT - MIDDLE] '.$txt, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'M');
//$pdf->MultiCell(55, 40, '[VERTICAL ALIGNMENT - BOTTOM] '.$txt, 1, 'J', 1, 1, '', '', true, 0, false, true, 40, 'B');
//
//$pdf->Ln(4);
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// set color for background
//$pdf->SetFillColor(215, 235, 255);
//
//// set some text for example
//$txt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.
//
//Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.';
//
//// print a blox of text using multicell()
//$pdf->MultiCell(80, 5, $txt."\n", 1, 'J', 1, 1, '' ,'', true);
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// AUTO-FITTING
//
//// set color for background
//$pdf->SetFillColor(255, 235, 235);
//
//// Fit text on cell by reducing font size
//$pdf->MultiCell(55, 60, '[FIT CELL] '.$txt."\n", 1, 'J', 1, 1, 125, 145, true, 0, false, true, 60, 'M', true);
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// CUSTOM PADDING
//
//// set color for background
//$pdf->SetFillColor(255, 255, 215);
//
//// set font
//$pdf->SetFont('helvetica', '', 8);
//
//// set cell padding
//$pdf->setCellPaddings(2, 4, 6, 8);
//
//$txt = "CUSTOM PADDING:\nLeft=2, Top=4, Right=6, Bottom=8\nLorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue.\n";
//
//$pdf->MultiCell(55, 5, $txt, 1, 'J', 1, 2, 125, 210, true);

// move pointer to last page
$pdf->lastPage();
$pdf->resetHeaderTemplate();
}

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_005.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
function date2mysql($date){
    return date("d.m.Y",strtotime($date));
}
function mysql2date($date){
     return date("Y.m.d",strtotime($date));
}
function rs($dzro, $dpro, $sstazdani, $sstazmj, $sstazgod){
        if(!empty($row["DPRO"])){
            $date1 = new DateTime(date("Y-m-d",strtotime($dzro)));
            $date2 = new DateTime(date("Y-m-d", strtotime($dpro)));
            $diff = $date1->diff($date2);
        }else{
            $date1 = new DateTime(date("Y-m-d",strtotime($dzro)));
            $date2 = new DateTime(date("Y-m-d"));
            $diff = $date1->diff($date2);
        }
                //sadasnji
        $sadstazdani=$diff->d;
        $sadstazmj=$diff->m;
        $sadstazgod=$diff->y;
        
        //ukupno
//        $row['USTAZDANI'] = $row['SSTAZDANI']+$row["SADSTAZDANI"];
//        $row['USTAZMJ'] = $row["SSTAZMJ"]+$row["SADSTAZMJ"];
//        $row['USTAZGOD'] = $row["SSTAZGOD"]+$row["SADSTAZGOD"];
        
        $ustazdani = $sstazdani + $sadstazdani;
        $ustazmj = $sstazmj + $sadstazmj;
        $ustazgod = $sstazgod + $sadstazgod;
        //extremi ////////////////////////////////////////////////////////////////////////
        
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