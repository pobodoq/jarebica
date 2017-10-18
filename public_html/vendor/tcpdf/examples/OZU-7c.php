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
$title = '';
$title1 = 'DJELATNICI ZAPOSLENI U ZDRAVSTVENIM USTANOVAMA';
$title2 = 'PREMA STUPNJU STRUČNE SPREME PO OPĆINAMA';


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
$pdf->SetFont('dejavusans', '', 10);

include('db.php');
function execute($con, $q){
    $r = mysqli_query($con, $q);
    if(!$r){
        echo mysqli_error($con);
    }else{
        $r = mysqli_fetch_row($r);
        return $r[0];
    }
}


$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, '');
$pdf->AddPage('P', 'A4');

$pdf->Cell(160, 4, 'BOSNA I HERCEGOVINA - FEDERACIJA BOSNE I HERCEGOVINE', '', 0, '', 0, 0, 1);
$pdf->Cell(20, 4, 'OZU-7c', '', 0, '', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(180, 4, 'Kanton HNŽ____________________', '', 0, '', 0, 0, 1);
$pdf->Ln(7);
$pdf->Cell(20, 4, '', '', 0, '', 0, 0, 1);
$pdf->Cell(160, 4, 'Naziv zdravstvene ustanove: Sveučilišna klinička bolnica Mostar', '', 0, '', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(120, 4, '', '', 0, '', 0, 0, 1);
$pdf->Cell(60, 4, 'Primarni nivo', '', 0, '', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(120, 4, '', '', 0, '', 0, 0, 1);
$pdf->Cell(60, 4, 'Sekundarnu nivo', '', 0, '', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(20, 4, '', '', 0, '', 0, 0, 1);
$pdf->Cell(30, 4, 'Javna ustanova', '', 0, '', 0, 0, 1);
$pdf->Cell(70, 4, '', '', 0, '', 0, 0, 1);
$pdf->Cell(60, 4, 'Tercijarni nivo', '', 0, '', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(20, 4, '', '', 0, '', 0, 0, 1);
$pdf->Cell(30, 4, 'Privatna ustanova', '', 0, '', 0, 0, 1);
$pdf->Cell(70, 4, '', '', 0, '', 0, 0, 1);
$pdf->Cell(60, 4, 'Apoteke', '', 0, '', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(120, 4, '', '', 0, '', 0, 0, 1);
$pdf->Cell(60, 4, 'Javno-zdravstvena djelatnost', '', 0, '', 0, 0, 1);
$pdf->Ln(8);
$pdf->Cell(180, 4, 'PREGLED BROJA I STRUKTURE ZAPOSLENIHU ZDRAVSTVENIM USTANOVAMA', '', 0, 'C', 0, 0, 1);
$pdf->Ln(6);
$pdf->Cell(10, 4, 'R.', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, 'Zaposleni po strukama i', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 4, 'Broj zaposlenih', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, 'Index', 'TRL', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(10, 4, 'br.', 'L', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, 'stupnjevima stručne spreme', 'L', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '2015', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '2016', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '(3/2)', 'RL', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(10, 4, '0', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, '1', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '2', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '3', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '4', 'TRL', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(10, 4, '', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(170, 4, 'Zdravstveni radnici i suradnici', 'TLR', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(10, 4, '1.1.', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, 'Doktori mediine', 'TL', 0, 'C', 0, 0, 1);
$q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2015-12-31') OR (DZRO < '2015-12-31' AND DPRO > '2015-12-31')) AND (PODVRSTA = '0101' OR PODVRSTA = '0103') ";
//            else if($key === 'uposleniDo' && $val!==''){
//                $where .= " AND ((STATUS LIKE '01%' AND DZRO < '".Listppl::datetomysql($val)."') OR (DZRO < '".Listppl::datetomysql($val)."' AND DPRO > '".Listppl::datetomysql($val)."')) ";
//            }

$pdf->Cell(20, 4, execute($con, $q), 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '3', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '4', 'TRL', 0, 'C', 0, 0, 1);
















$pdf->lastPage();
$pdf->Output('Organizacijska_struktura.pdf', 'I');