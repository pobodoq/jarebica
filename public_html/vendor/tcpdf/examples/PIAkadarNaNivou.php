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
$title = 'KADAR SVEUČILIŠNE KLINIČKE BOLNICE MOSTAR';


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
$pdf->SetFont('dejavusans', '', 9);

include('db.php');
include_once('report_searchs.php');
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
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('P', 'A4');

$counter=1;
$fill = $pdf->SetFillColor(160, 160, 160);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Medicinski djelatnici', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'Ostvareno 2015', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'Plan 2016', 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(30, 5, 'Ostvareno 30.6.2017', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'Index 5/3', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, 'Index 5/4', 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);

$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Medicinski djelatnici VSS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Zdravstveni_djelatnici'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['Zdravstveni_djelatnici'], 'LRT', 0, 'C', $fill, 0, 1); 
//$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%' OR PODVRSTA LIKE '05%' AND SSRM=15)  ";
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%') ";
//(PODVRSTA LIKE '05%' AND SSRM=15) ----> ovaj dio je ubačen zbog laboratorijskih tehničara koji se nalaze u odjeljku medicinskih sestara, ali su VSS stručne spreme i zbog toga u izvješću pripadaju odjeljku zajedno sa doktorima
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Zdravstveni_djelatnici']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Zdravstveni_djelatnici']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Liječnici', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Lijecnici'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['Lijecnici'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA LIKE '01%' ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Lijecnici']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Lijecnici']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Subspecijalisti', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(15, 5, $ostvareno['subspecijalisti'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['subspecijalisti'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0104' ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['subspecijalisti']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['subspecijalisti']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LR', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Subspecijalizanti', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['subspecijalizanti'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['subspecijalizanti'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0105' ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['subspecijalizanti']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['subspecijalizanti']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LR', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Specijalisti', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['specijalisti'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['specijalisti'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0102' ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['specijalisti']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['specijalisti']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LR', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Specijalizanti', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['specijalizanti'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['specijalizanti'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0103' ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['specijalizanti']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['specijalizanti']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LR', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Liječnici opće prakse', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['opci_doktori'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['opci_doktori'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0101' ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['opci_doktori']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['opci_doktori']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Liječnici oralne kirurgije - stomatolozi ' , 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['oralni_kirurg'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['oralni_kirurg'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0202' ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['oralni_kirurg']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['oralni_kirurg']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Farmaceuti', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['opci_doktori'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['opci_doktori'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA LIKE '03%' AND (BRD != 3774 AND BRD != 3488 AND BRD != 3367 AND BRD != 3325 AND BRD  != 3324 AND BRD != 3206 AND BRD !=2281) ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 

$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Diplomirani inženjeri biokemije', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND SSRM = 15 AND PODVRSTA LIKE '03%' AND (BRD = 3774 OR BRD = 3488 OR BRD = 3367 OR BRD = 3325 OR BRD  = 3324 OR BRD = 3206) ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 

$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Biolozi', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND SSRM = 15 AND PODVRSTA LIKE '03%' AND BRD = 2281 ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 


$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Medicinski djelatnici VŠS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Zdravstveni_djelatniciVŠS'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['Zdravstveni_djelatniciVŠS'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM = 19  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Zdravstveni_djelatniciVŠS']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Zdravstveni_djelatniciVŠS']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);


$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(100, 5, 'Medicinski tehničari', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(15, 5, $ostvareno['Medicinski_tehničariVŠS'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(15, 5, $plan['Medicinski_tehničariVŠS'], 'LRT', 0, 'C', 0, 0, 1);
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0401' AND SSRM = 19  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Medicinski_tehničariVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Medicinski_tehničariVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Radiološki_tehničari', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Radiološki_tehničariVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['Radiološki_tehničariVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0501' AND SSRM = 19  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Fizioterapeutski tehničari', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Fizioterapeutski_tehničarVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['Fizioterapeutski_tehničarVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0502' AND SSRM = 19  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Fizioterapeutski_tehničarVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Fizioterapeutski_tehničarVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);

$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Radni terapeut', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Radnoterapeutski_tehničarVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['Radnoterapeutski_tehničarVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0504' AND SSRM = 19  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Radnoterapeutski_tehničarVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Radnoterapeutski_tehničarVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Laboratorijski_tehničari', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Laboratorijski_tehničariVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['Laboratorijski_tehničariVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0505' AND SSRM = 19  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Laboratorijski_tehničariVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Laboratorijski_tehničariVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Farmaceutski tehničari', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Laboratorijski_tehničariVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['Laboratorijski_tehničariVŠS'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0507' AND SSRM = 19  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Laboratorijski_tehničariVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Laboratorijski_tehničariVŠS']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);

$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1);
$pdf->Cell(100, 5, 'Medicinski djelatnici SSS', 'LRT', 0, 'C', $fill, 0, 1);
//$pdf->Cell(15, 5, $ostvareno['Zdravstveni_djelatniciSSS'], 'LRT', 0, 'C', $fill, 0, 1);
//$pdf->Cell(15, 5, $plan['Zdravstveni_djelatniciSSS'], 'LRT', 0, 'C', $fill, 0, 1);
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Zdravstveni_djelatniciSSS']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Zdravstveni_djelatniciSSS']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(100, 5, 'Opći medicinski tehničari', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(15, 5, $ostvareno['opci_med_teh'], 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(15, 5, $plan['opci_med_teh'], 'LRT', 0, 'C', 0, 0, 1);
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0401' AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['opci_med_teh']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['opci_med_teh']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Primalje', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['Primalje'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['Primalje'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0403' AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['Primalje']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['Primalje']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Fizioterapeutski tehničari', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['fizioterapeutske'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['fizioterapeutske'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0502' AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['fizioterapeutske']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['fizioterapeutske']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Farmaceutski tehničari', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['farmaceutski'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['farmaceutski'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0507' AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['farmaceutski']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['farmaceutski']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Laboratorijski tehničari', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['laboratorjski'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['laboratorjski'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0505' AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['laboratorjski']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['laboratorjski']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'RTG tehničari', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['rtg'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['rtg'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0501' AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['rtg']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['rtg']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, $counter++, 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Cell(100, 5, 'Ostalo', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['ostalo'], 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, $plan['ostalo'], 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA = '0508' AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['ostalo']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['ostalo']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Ukupno zdravstvenih djelatnika', 'LRT', 0, 'C', $fill, 0, 1);
//$pdf->Cell(15, 5, $ostvareno['ukupno_ZD'], 'LRT', 0, 'C', $fill, 0, 1);
//$pdf->Cell(15, 5, $plan['ukupno_ZD'], 'LRT', 0, 'C', $fill, 0, 1);
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND (PODVRSTA LIKE '01%' OR PODVRSTA LIKE '02%' OR PODVRSTA LIKE '03%' OR PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%')  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['ukupno_ZD']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['ukupno_ZD']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(10);





$pdf->Cell(5, 5, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(100, 5, 'Nemedicinski djelatnici', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Zdravstveni suradnici VSS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA LIKE '06%' AND SSRM = 15 ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Zdravstveni suradnici VŠS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA LIKE '06%' AND SSRM = 19 ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['oralni_kirurg']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['oralni_kirurg']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Zdravstveni suradnici SSS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, '', 'LRT', 0, 'C', 0, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND PODVRSTA LIKE '06%' AND SSRM = 7 ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['oralni_kirurg']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['oralni_kirurg']*100, 2), 'LRT', 0, 'C', 0, 0, 1); 

$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Nemedicinski djelatnici VSS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['administrativniVSS'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['administrativniVSS'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA = 4 AND PODVRSTA NOT LIKE  '06%' AND SSRM = 15  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['administrativniVSS']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['administrativniVSS']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);

$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Nemedicinski djelatnici VŠS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['administrativniVŠS'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['administrativniVŠS'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA = 4 AND PODVRSTA NOT LIKE  '06%' AND SSRM = 19  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);

$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Nemedicinski djelatnici SSS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['administrativniSSS'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['administrativniSSS'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA=4 AND PODVRSTA NOT LIKE '06%' AND SSRM = 7  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['administrativniSSS']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['administrativniSSS']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Nemedicinski djelatnici VKV', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['VKV'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['VKV'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA=4 AND PODVRSTA NOT LIKE '06%' AND SSRM = 12  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['VKV']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['VKV']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Nemedicinski djelatnici KV', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['KV'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['KV'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA=4 AND PODVRSTA NOT LIKE '06%' AND SSRM = 1  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['KV']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['KV']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Nemedecinski djelatnici NK', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['NK'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['NK'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA=4 AND PODVRSTA NOT LIKE '06%' AND SSRM = 3  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['NK']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['NK']*100, 2), 'LRT', 0, 'C', $fill, 0, 1);
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Nemedecinski djelatnici NSS', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['NK'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['NK'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA=4 AND PODVRSTA NOT LIKE '06%' AND SSRM = 4  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['NK']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['NK']*100, 2), 'LRT', 0, 'C', $fill, 0, 1);

$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Ukupno nemedicinskih djelatnika', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['ukupno_adm'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['ukupno_adm'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' AND VRSTA = 4  ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['ukupno_adm']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['ukupno_adm']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);
$pdf->Cell(5, 5, '', 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Cell(100, 5, 'Ukupno zaposlenih u SKBM', 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $ostvareno['SKBM'], 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, $plan['SKBM'], 'LRT', 0, 'C', $fill, 0, 1); 
$q= "SELECT COUNT(*) FROM djel WHERE STATUS LIKE '01%' ";
$execute = execute($con, $q);
$pdf->Cell(30, 5, $execute, 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$ostvareno['SKBM']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
//$pdf->Cell(15, 5, number_format($execute/$plan['SKBM']*100, 2), 'LRT', 0, 'C', $fill, 0, 1); 
$pdf->Ln(5);


$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');