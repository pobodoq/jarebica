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

include('db.php');
$query = "SELECT ID, NAZIV FROM klinika";
$res = mysqli_query($con, $query);
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
$where = "WHERE djel.ID IS NOT NULL";
if(isset($_GET['brd'])){
    $brd = $_GET['brd'];
    $where .= " AND djel.BRD = ".$brd." ";
}
if(isset($_GET['mjestor'])){
    $mjestor = $_GET['mjestor'];
    $where .= " AND djel.MJESTOR = '".$mjestor."' ";
}
if(isset($_GET['mjestob'])){
    $mjestob = $_GET['mjestob'];
    $where .= " AND djel.MJESTOB = '".$mjestob."' ";
}
if(isset($_GET['spol'])){
    $spol = $_GET['spol'];
    $where .= " AND djel.SPOL = '".$spol."' ";
}
if(isset($_GET['odDzro']) & isset($_GET['doDzro'])){ //situacija kad je unešeno samo od... i kad je unešeno samo do
    $odDzro = $_GET['odDzro'];
    $doDzro = $_GET['doDzro'];
    $where .= " AND djel.DZRO BETWEEN '".$odDzro."' AND '".$doDzro."' ";
}
if(isset($_GET['odDpro']) & isset($_GET['doDpro'])){ //situacija kad je une[enseno samo jedno od]
    $odDpro = $_GET['odDpro'];
    $doDpro = $_GET['doDpro'];
    $where .= " AND djel.DPRO BETWEEN '".$odDpro."' AND '".$doDpro."' ";
}
//if(isset($_GET['oddatumzro'])){
//    $oddatumzro = $_GET['oddatumzro'];                samo jedno od kralju
//}
//if(isset($_GET['dodatumpro'])){
//    $dodatumpro = $_GET['dodatumpro'];
//}
if(isset($_GET['nomss'])){
    $nomss = $_GET['nomss'];
    $where .= " AND djel.SS = '".$nomss."' ";
}
if(isset($_GET['nomzan'])){
    $nomzan = $_GET['nomzan'];
    $where .= " AND djel.ZAN = ".$nomazn." ";
}
if(isset($_GET['klinika'])){
    $klinika = $_GET['klinika'];
    $where .= " AND djel.KLINIKA = ".$klinika." ";
}
if(isset($_GET['odjel'])){
    $odjel = $_GET['odjel'];
    $where .= " AND djel.ODJEL = ".$odjel." ";
}
if(isset($_GET['odsjek'])){
    $odsjek = $_GET['odsjek'];
    $where .= " AND djel.ODSJEK = ".$odsjek." ";
}
if(isset($_GET['statusi'])){
    $statusi = $_GET['statusi'];
    $where .= " AND djel.STATUSI = ".$statusi." ";
}
if(isset($_GET['staz'])){
    $staz = $_GET['staz'];
}
if(isset($_GET['nomtit'])){
    $nomtit = $_GET['nomtit'];
    $where .= " AND djel.TITULA = ".$nomtit." ";
}
if(isset($_GET['nomskspr'])){
    $nomskspr = $_GET['nomskspr'];
    $where .= " AND djel.SKSPR = ".$nomskspr." ";
}
if(isset($_GET['nomvrsta'])){
    $nomvrsta = $_GET['vrsta'];
    $where .= " AND djel.VRSTA = ".$nomvrsta." ";
}
if(isset($_GET['nomnac'])){
    $nomnac = $_GET['nac'];
    $where .= " AND djel.NAC = ".$nomnac." ";
}
if(isset($_GET['specijalizacija'])){
    $specijalizacija = $_GET['specijalizacija']; //specijalizacije i subs posebno, zbog tri mogucnosti, kad bolje razmislim trebat ce i radno mjesto...
}
if(isset($_GET['subspecijalizacija'])){
    $subspecijalizacija = $_GET['subspecijalizacija'];
}
//$where = " AND klinika.ID = ".$rowy[0]." ";
//            $where = "WHERE djel.ID IS NOT NULL";
//            if(!empty($params['brd'])){
//                $where .= " AND djel.".$fields[1]." = ".$params['brd']." ";
//            }
////            if(!empty($params['jmbg'])){
////                $where .= " AND ".$fields[2]." = ".$params['jmbg']." ";
////            }
//            if(!empty($params['prezime'])){
//                $where .= " AND djel.PREZIME LIKE '".$params['prezime']."%' ";
//            }
//            if(!empty($params['ime'])){
//                $where .= " AND djel.IME LIKE '".$params['ime']."%' ";
//            }
//            if(!empty($params['klinika'])){
//                $where .= " AND djel.KLINIKA LIKE '".$params['klinika']."%' ";
//            }
//            if(!empty($params['titula'])){
//                $where .= " AND nomtit.IDe LIKE '%".$params['titula']."%' ";
//            }
//            if(!empty($params['status'])){
//                $where .= " AND djel.STATUS = ".$params['status']." ";
//            }


$query = "SELECT IME, PREZIME, TITULA, nomzan.NAZIV AS ZAN, nomrm.NAZIV AS RM, nomskspr.NAZIV AS SKSPR, nomss.NAZIV AS SS, DATUMR, DZRO, klinika.NAZIV AS KLINIKA "
        . "FROM djel "
        . "LEFT JOIN nomtit "
        . "ON djel.TITULA = nomtit.ID "
        . "LEFT JOIN nomzan "
        . "ON djel.ZAN = nomzan.ID "
        . "LEFT JOIN nomskspr "
        . "ON djel.SKSPR = nomskspr.ID "
        . "LEFT JOIN klinika "
        . "ON djel.KLINIKA = klinika.ID "
        . "LEFT JOIN nomrm "
        . "ON djel.RM = nomrm.ID "
        . "LEFT JOIN nomss "
        . "ON djel.SS = nomss.ID "
        . $where;
//$query = "SELECT IME, PREZIME, OTAC, DATUMR, JMBG, DZRO, DPRO, nomtit.IDe AS TITULA, nomrm.NAZIV AS RM, nomzan.NAZIV AS ZANIMANJE, nomskspr.NAZIV AS SKSP, nomss.NAZIV AS SS, klinika.NAZIV AS ODJEL "
//        . "FROM djel "
//        . "LEFT JOIN nomtit "
//        . "ON djel.TITULA = nomtit.ID "
//        . "LEFT JOIN nomzan "
//        . "ON djel.ZAN = nomzan.ID "
//        . "LEFT JOIN nomskspr "
//        . "ON djel.skspr = nomskspr.ID "
//        . "LEFT JOIN klinika "
//        . "ON djel.klinika = klinika.ID "
//        . "LEFT JOIN nomrm "
//        . "ON djel.rm = nomrm.ID "
//        . "LEFT JOIN nomss "
//        . "ON djel.ss = nomss.ID "
//        . $where; // . "ORDER BY nomzan.NAZIV DESC "; . "ORDER BY kbodjeli.NAZIV ASC ";   BEFORE ORDER         . "WHERE DPRO IS NOT NULL AND kbodjeli.ID = '".$rowy[0]."' "
//FIELD(nomzan.ID,'3','4','5'), nomzan.NAZIV DESC  ovo je za order by field... koji field zelis.. odlicno ha...
$result = mysqli_query($con, $query);
$counter=0;
    $pdf->Cell(8, 6, 'R.B.', 'LR', 0, 'C');
    $pdf->Cell(70, 6, 'DJELATNIK', 'LR', 0, 'C');
    $pdf->Cell(44, 6, 'Ime oca', 'LR', 0, 'C');
    $pdf->Cell(55, 6, 'JMBG', 'LR', 0, 'C');
    $pdf->Cell(20, 6, 'Datum rođ.', 'LR', 0, 'C');
    $pdf->Ln(6);
while($row =  mysqli_fetch_assoc($result)){    
    $counter++;
    $pdf->Cell(8, 6, $counter, 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(70, 6, $row["TITULA"] . ' ' . $row["IME"]. ' '. $row["PREZIME"], 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(44, 6, $row["ZAN"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(55, 6, $row["RM"], 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 6, date2mysql($row["SKSPR"]), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 6, date2mysql($row["SS"]), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 6, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(20, 6, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(6);

}

$pdf->lastPage();
$pdf->resetHeaderTemplate();
}

// ---------------------------------------------------------

//Close and output PDF document

$pdf->Output('primjer.pdf', 'I');

echo json_encode('true');
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
