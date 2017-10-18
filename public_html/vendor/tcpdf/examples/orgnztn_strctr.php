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

$pdf->Cell(100, 4, 'ZDRAVSTVENA USTANOVA', '', 0, '', 0, 0, 1);
$pdf->Cell(30, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 6, 'Obr.br.3-00-60', 'TRBL', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
$pdf->Cell(100, 4, 'SVEUČILIŠNA KLINIČKA BOLNICA MOSTAR', '', 0, '', 0, 0, 1);

$pdf->Ln(7);
$pdf->Cell(40, 4, 'MJESTO, OPĆINA', '', 0, '', 0, 0, 1);
$pdf->Cell(60, 4, 'Mostar', '', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
$pdf->Cell(40, 4, 'ŽUPANIJA', '', 0, '', 0, 0, 1);
$pdf->Cell(60, 4, 'Hercegovačko-Neretvanska', '', 0, 'C', 0, 0, 1);
$pdf->Cell(35, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(5, 4, '', 'RBL', 0, 'C', 0, 0, 1);
$pdf->Cell(5, 4, '', 'RBL', 0, 'C', 0, 0, 1);
$pdf->Cell(5, 4, '', 'RBL', 0, 'C', 0, 0, 1);
$pdf->Cell(5, 4, '', 'RBL', 0, 'C', 0, 0, 1);
$pdf->Cell(5, 4, '', 'RBL', 0, 'C', 0, 0, 1);
$pdf->Cell(5, 4, '', 'RBL', 0, 'C', 0, 0, 1);
$pdf->Cell(5, 4, '', 'RBL', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
$pdf->SetFont('dejavusans', '', 8);
$pdf->Cell(140, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'REGISTAR ORGANIZACIJSKIH JEDINICA', '', 0, 'C', 0, 0, 1);
$pdf->Ln(90);

$pdf->SetFont('dejavusans', '', 12);
$pdf->Cell(180, 5, 'IZVJEŠĆE', '', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
$pdf->Cell(180, 5, 'O ORGANIZACIJSKOJ STRUKTURI I KADROVIMA', '', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
$pdf->Cell(180, 5, 'ZAPOSLENIM U ZDRAVSTVENIM USTANOVAMA', '', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
$pdf->Cell(180, 5, 'na dan 31.12.2016. god.', '', 0, 'C', 0, 0, 1);
$pdf->SetFont('dejavusans', '', 8);


$pdf->resetHeaderTemplate();
$title = '';
$title1 = 'ZDRAVSTVENI DJELATNICI S VISOKOM STRUČNOM SPREMOM';
$title2 = 'PREMA SPECIJALNOSTI, DOBI I SPOLU';
$title3 = 'TABLICA 1';
$pdf->SetHeaderData($logo, $logoWidth, $title, $title1 . PHP_EOL . $title2. PHP_EOL . $title3);
$pdf->AddPage('L', 'A4');
//$fill = $pdf->SetFillColor(200, 200, 200);   
$pdf->Cell(79, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(168, 4, 'Zdravstveni djelatnici', 'TL', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(79, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(120, 4, 's visokom stručnom spremom', 'TL', 0, 'C', 0, 0, 1);
$pdf->Cell(48, 4, 's višom stručnom spremom', 'TL', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(79, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 4, 'Doktori medicine', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 4, 'Doktori stomatolozi', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 4, 'Diplomirani farmaceuti', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(48, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(79, 30, 'Zdravstvena ustanova i općina', 'LRB', 0, 'C', 0, 0, 1);
$pdf->Cell(20, 30, '', 'LRB', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(40, 30, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(30);
$titles = ['Svega(kol. 3-6)', 'Doktori medicine', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega(kol. 8-11)', 'Stomatolozi', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega (kol. 13-16)', 'Farmaceuti', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega(kol. 18-28)', 'Med. sestre općeg smjera', 'Pedijatrijske sestre', 'Zubni tehničari', 'Rentgen tehničari', 'Fizioterapeutski tehničari'];
$x=94;
$y=69;
$pdf->SetXY($x, $y);
$pdf->StartTransform();
$pdf->Rotate(90);
$pdf->writeHTMLCell(42, 20, '', '', 'Ukupno zaposlenih(kol. 2,,7,12,17,29,43,44,48)', 1, 0, false, true, 'C', false);
$pdf->StopTransform();  

$x=114;
$y=69;
for($i=0;$i<count($titles);$i++){
    if($i<15){
        $pdf->SetXY($x, $y);
        $x += 8;
        $pdf->StartTransform();
        $pdf->Rotate(90);
        $pdf->writeHTMLCell(30, 8, '', '', $titles[$i], 1, 0, false, true, 'C', false);
        $pdf->StopTransform();            
    }else{
        $pdf->SetXY($x, $y);
        $x += 8;
        $pdf->StartTransform();
        $pdf->Rotate(90);
        $pdf->writeHTMLCell(34, 8, '', '', $titles[$i], 1, 0, false, true, 'C', false);
        $pdf->StopTransform();
    }
}   
$pdf->Ln(1);
$pdf->Cell(79, 4, '0', 'LRTB', 0, 'C', 0, 0, 1);  
$pdf->Cell(20, 4, '1', 'LRTB', 0, 'C', 0, 0, 1);
for($i=2;$i<23;$i++){
    $pdf->Cell(8, 4, $i, 'LRTB', 0, 'C', 0, 0, 1);
}
$pdf->Ln(5);
$pdf->Cell(79, 7, 'UKUPNO', 'LRTB', 0, 'C', 0, 0, 1);
$q = "SELECT COUNT(*) FROM DJEL WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31')";
$pdf->Cell(20, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);

$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '01%' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1); 
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0101' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0103' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA = '0102' OR PODVRSTA = '0104' OR PODVRSTA = '0105') ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '02%' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0201' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0203' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0202' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '03%' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0302' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0304' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0303' ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0401' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0501' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0502' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);

 $pdf->resetHeaderTemplate();
$title = '';
$title1 = 'ZDRAVSTVENI DJELATNICI S VISOKOM STRUČNOM SPREMOM';
$title2 = 'PREMA SPECIJALNOSTI, DOBI I SPOLU';
$title3 = 'TABLICA 1(nastavak)';
$pdf->SetHeaderData($logo, $logoWidth, $title, $title1 . PHP_EOL . $title2. PHP_EOL . $title3);
$pdf->AddPage('L', 'A4');

$pdf->Cell(168, 4, 'Zdravstveni djelatnici', 'LRB', 0, 'C', 0, 0, 1);
$pdf->Cell(32, 8, 'Zdravstveni suradnici', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(64, 8, 'Administrativni i tehnički djelatnici', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(40, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(48, 4, 's višom stručnom spremom', 'LRB', 0, 'C', 0, 0, 1);
$pdf->Cell(104, 4, 'sa srednjom stručnom spremom', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$titles = ["Farmaceutski tehničari", "Sanitarni tehničari", "Radnoterapeutski tehničari", "Med. sestre primaljskog smjera", "Laboratorijski tehničari", "Ostali zdr. djelatnici", "Svega(kol. 30-42)", "Med. sestre općeg smjera", "Pedijatrijske sestre", "Stomatološke sestre", "Med.sestre ortoptičari", "Zubni tehničari", "Rentgen tehničari", "Fizioterapeutski tehničari", "Farmaceutski tehničari", "Sanitarni tehničari", "Radnoterapeutski tehničari", "Med. Sestre primaljskog smjera", "Laboratorijski tehničari", "Ostali zdr. djelatnici", "S nižom spremom", "Svega(kol. 45-47)", "S visokom spremom", "S višom spremom", "Sa srednjom spremom", "Svega(kol. 49-52)", "S visokom spremom", "S višom spremom", "Sa srednjom spremom", "S nižom spremom", 'Kvalificirani Radnik', 'Nekvalificirani radnik', 'Visoko kvalificirani radnik'];
//$titles = ['Svega(kol. 3-6)', 'Doktori medicine', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega(kol. 8-11)', 'Stomatolozi', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega (kol. 13-16)', 'Farmaceuti', 'Na specijalizaciji', 'Specijalisti', 'Stažisti', 'Svega(kol. 18-28)', 'Med. sestre općeg smjera', 'Pedijatrijske sestre', 'Zubni tehničari', 'Rentgen tehničari', 'Fizioterapeutski tehničari'];
$x=15;
$y=65;
for($i=0;$i<count($titles);$i++){
    if($i===20){
        $pdf->SetXY($x, $y);
        $x += 8;
        $pdf->StartTransform();
        $pdf->Rotate(90);
        $pdf->writeHTMLCell(34, 8, '', '', $titles[$i], 1, 0, false, true, 'C', false);
        $pdf->StopTransform();  
    }else{
        $pdf->SetXY($x, $y);
        $x += 8;
        $pdf->StartTransform();
        $pdf->Rotate(90);
        $pdf->writeHTMLCell(30, 8, '', '', $titles[$i], 1, 0, false, true, 'C', false);
        $pdf->StopTransform();            
    }
}   
$pdf->Ln(1);
for($i=23;$i<56;$i++){
    $pdf->Cell(8, 4, $i, 'LRTB', 0, 'C', 0, 0, 1);
}
$pdf->Ln(5);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0507' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0503' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0504' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0505' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0508' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);

$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0401' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0501' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0502' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0507' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0503' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0504' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0403' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0505' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0508' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);


$pdf->Cell(8, 7, '0', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '06%' ";
$pdf->Cell(8, 7, execute($con, $q) .'*', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0601' AND SSRM=15 ";
$pdf->Cell(8, 7, execute($con, $q).'*', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0601' AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0601' AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);


$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=4 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=4 AND SSRM=15 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=4 AND SSRM=19 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=4 AND SSRM=7 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=4 AND SSRM=4 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=4 AND SSRM=1 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=4 AND SSRM=3 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=4 AND SSRM=12 ";
$pdf->Cell(8, 7, execute($con, $q), 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Ln(15);
$pdf->Cell(150, 7, '*VSS zdravstveni djelatnici, sukladno čl.137. Zakona o zdravstvenoj zaštiti („Službene novine Federacije BiH“ broj 46/10)', '', 0, '', 0, 0, 1);

 
$pdf->resetHeaderTemplate();
$title = '';
$title1 = 'ZDRAVSTVENI DJELATNICI S VISOKOM STRUČNOM SPREMOM';
$title2 = 'PREMA SPECIJALNOSTI, DOBI I SPOLU';
$title3 = 'TABLICA 2.1. Doktori medicine';
$pdf->SetHeaderData($logo, $logoWidth, $title, $title1 . PHP_EOL . $title2. PHP_EOL . $title3);
$pdf->AddPage('P', 'A4');

$sql_query = "SELECT "
        . "(SELECT COUNT(*) FROM djel t2 WHERE ((t2.STATUS LIKE '01%' AND t2.DZRO < '2016-12-31') OR t2.DPRO > '2016-12-31') AND t2.naspec IS NULL AND t2.SPEC1 IS NULL AND(t2.RM=122 OR t2.RM=290 OR t2.RM=524) AND t2.spol=1) as oPraksaAllM, "
        . "(SELECT COUNT(*) FROM djel t3 WHERE ((t3.STATUS LIKE '01%' AND t3.DZRO < '2016-12-31') OR t3.DPRO > '2016-12-31') AND t3.naspec IS NULL AND t3.SPEC1 IS NULL AND(t3.RM=122 OR t3.RM=290 OR t3.RM=524) AND t3.spol=2) as oPraksaAllZ, "
        . "(SELECT COUNT(*) FROM djel t4 WHERE ((t4.STATUS LIKE '01%' AND t4.DZRO < '2016-12-31') OR t4.DPRO > '2016-12-31') AND t4.naspec IS NULL AND t4.SPEC1 IS NULL AND(t4.RM=122 OR t4.RM=290 OR t4.RM=524) AND t4.spol=1 AND (DATEDIFF(NOW(), t4.DATUMR) < 12410)) as dotcM, "
        . "(SELECT COUNT(*) FROM djel t5 WHERE ((t5.STATUS LIKE '01%' AND t5.DZRO < '2016-12-31') OR t5.DPRO > '2016-12-31') AND t5.naspec IS NULL AND t5.SPEC1 IS NULL AND(t5.RM=122 OR t5.RM=290 OR t5.RM=524) AND t5.spol=2 AND (DATEDIFF(NOW(), t5.DATUMR) < 12410)) as dotcZ, "
        . "(SELECT COUNT(*) FROM djel t6 WHERE ((t6.STATUS LIKE '01%' AND t6.DZRO < '2016-12-31') OR t6.DPRO > '2016-12-31') AND t6.naspec IS NULL AND t6.SPEC1 IS NULL AND(t6.RM=122 OR t6.RM=290 OR t6.RM=524) AND t6.spol=1 AND (DATEDIFF(NOW(), t6.DATUMR) BETWEEN 12410 AND 16059)) as doccM, "
        . "(SELECT COUNT(*) FROM djel t7 WHERE ((t7.STATUS LIKE '01%' AND t7.DZRO < '2016-12-31') OR t7.DPRO > '2016-12-31') AND t7.naspec IS NULL AND t7.SPEC1 IS NULL AND(t7.RM=122 OR t7.RM=290 OR t7.RM=524) AND t7.spol=2 AND (DATEDIFF(NOW(), t7.DATUMR) BETWEEN 12410 AND 16059)) as doccZ, "
        . "(SELECT COUNT(*) FROM djel t8 WHERE ((t8.STATUS LIKE '01%' AND t8.DZRO < '2016-12-31') OR t8.DPRO > '2016-12-31') AND t8.naspec IS NULL AND t8.SPEC1 IS NULL AND(t8.RM=122 OR t8.RM=290 OR t8.RM=524) AND t8.spol=1 AND (DATEDIFF(NOW(), t8.DATUMR) BETWEEN 16060 AND 19709)) as dopcM, "
        . "(SELECT COUNT(*) FROM djel t9 WHERE ((t9.STATUS LIKE '01%' AND t9.DZRO < '2016-12-31') OR t9.DPRO > '2016-12-31') AND t9.naspec IS NULL AND t9.SPEC1 IS NULL AND(t9.RM=122 OR t9.RM=290 OR t9.RM=524) AND t9.spol=2 AND (DATEDIFF(NOW(), t9.DATUMR) BETWEEN 16060 AND 19709)) as dopcZ, "
        . "(SELECT COUNT(*) FROM djel t10 WHERE ((t10.STATUS LIKE '01%' AND t10.DZRO < '2016-12-31') OR t10.DPRO > '2016-12-31') AND t10.naspec IS NULL AND t10.SPEC1 IS NULL AND(t10.RM=122 OR t10.RM=290 OR t10.RM=524) AND t10.spol=1 AND (DATEDIFF(NOW(), t10.DATUMR)>= 19710)) as viseppM, "
        . "(SELECT COUNT(*) FROM djel t11 WHERE ((t11.STATUS LIKE '01%' AND t11.DZRO < '2016-12-31') OR t11.DPRO > '2016-12-31') AND t11.naspec IS NULL AND t11.SPEC1 IS NULL AND(t11.RM=122 OR t11.RM=290 OR t11.RM=524) AND t11.spol=2 AND (DATEDIFF(NOW(), t11.DATUMR)>= 19710)) as viseppZ, "
        . "(SELECT COUNT(*) FROM djel t12 WHERE ((t12.STATUS LIKE '01%' AND t12.DZRO < '2016-12-31') OR t12.DPRO > '2016-12-31') AND t12.naspec IS NOT NULL AND t12.SPEC1 IS NULL AND t12.SUBSPEC1 IS NULL AND t12.spol=1) as naspecM, "
        . "(SELECT COUNT(*) FROM djel t13 WHERE ((t13.STATUS LIKE '01%' AND t13.DZRO < '2016-12-31') OR t13.DPRO > '2016-12-31') AND t13.naspec IS NOT NULL AND t13.SPEC1 IS NULL AND t13.SUBSPEC1 IS NULL AND t13.spol=2) as naspecZ, "
        . "(SELECT COUNT(*) FROM djel t14 WHERE ((t14.STATUS LIKE '01%' AND t14.DZRO < '2016-12-31') OR t14.DPRO > '2016-12-31') AND t14.naspec IS NOT NULL AND t14.SPEC1 IS NULL AND t14.SUBSPEC1 IS NULL AND t14.spol=1 AND (DATEDIFF(NOW(), t14.DATUMR) < 12410)) as naspecdotcM, "
        . "(SELECT COUNT(*) FROM djel t15 WHERE ((t15.STATUS LIKE '01%' AND t15.DZRO < '2016-12-31') OR t15.DPRO > '2016-12-31') AND t15.naspec IS NOT NULL AND t15.SPEC1 IS NULL AND t15.SUBSPEC1 IS NULL AND t15.spol=2 AND (DATEDIFF(NOW(), t15.DATUMR) < 12410)) as naspecdotcZ, "
        . "(SELECT COUNT(*) FROM djel t16 WHERE ((t16.STATUS LIKE '01%' AND t16.DZRO < '2016-12-31') OR t16.DPRO > '2016-12-31') AND t16.naspec IS NOT NULL AND t16.SPEC1 IS NULL AND t16.SUBSPEC1 IS NULL AND t16.spol=1 AND (DATEDIFF(NOW(), t16.DATUMR) BETWEEN 12410 AND 16059)) as naspecdoccM, "
        . "(SELECT COUNT(*) FROM djel t17 WHERE ((t17.STATUS LIKE '01%' AND t17.DZRO < '2016-12-31') OR t17.DPRO > '2016-12-31') AND t17.naspec IS NOT NULL AND t17.SPEC1 IS NULL AND t17.SUBSPEC1 IS NULL AND t17.spol=2 AND (DATEDIFF(NOW(), t17.DATUMR) BETWEEN 12410 AND 16059)) as naspecdoccZ, "
        . "(SELECT COUNT(*) FROM djel t18 WHERE ((t18.STATUS LIKE '01%' AND t18.DZRO < '2016-12-31') OR t18.DPRO > '2016-12-31') AND t18.naspec IS NOT NULL AND t18.SPEC1 IS NULL AND t18.SUBSPEC1 IS NULL AND t18.spol=1 AND (DATEDIFF(NOW(), t18.DATUMR) BETWEEN 16060 AND 19709)) as naspecdopcM, "
        . "(SELECT COUNT(*) FROM djel t19 WHERE ((t19.STATUS LIKE '01%' AND t19.DZRO < '2016-12-31') OR t19.DPRO > '2016-12-31') AND t19.naspec IS NOT NULL AND t19.SPEC1 IS NULL AND t19.SUBSPEC1 IS NULL AND t19.spol=2 AND (DATEDIFF(NOW(), t19.DATUMR) BETWEEN 16060 AND 19709)) as naspecdopcZ, "
        . "(SELECT COUNT(*) FROM djel t20 WHERE ((t20.STATUS LIKE '01%' AND t20.DZRO < '2016-12-31') OR t20.DPRO > '2016-12-31') AND t20.naspec IS NOT NULL AND t20.SPEC1 IS NULL AND t20.SUBSPEC1 IS NULL AND t20.spol=1 AND (DATEDIFF(NOW(), t20.DATUMR)>= 19710)) as naspecviseppM, "
        . "(SELECT COUNT(*) FROM djel t21 WHERE ((t21.STATUS LIKE '01%' AND t21.DZRO < '2016-12-31') OR t21.DPRO > '2016-12-31') AND t21.naspec IS NOT NULL AND t21.SPEC1 IS NULL AND t21.SUBSPEC1 IS NULL AND t21.spol=2 AND (DATEDIFF(NOW(), t21.DATUMR)>= 19710)) as naspecviseppZ, "
        . "(SELECT COUNT(*) FROM djel t22 WHERE ((t22.STATUS LIKE '01%' AND t22.DZRO < '2016-12-31') OR t22.DPRO > '2016-12-31') AND t22.SPEC1 IS NOT NULL AND t22.SUBSPEC1 IS NULL AND t22.NASPEC IS NULL  AND t22.BRD != 3525 AND t22.BRD != 3524 AND t22.BRD != 3523 AND t22.SPEC1!=38 AND t22.spol=1) as specM, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE ((t23.STATUS LIKE '01%' AND t23.DZRO < '2016-12-31') OR t23.DPRO > '2016-12-31') AND t23.SPEC1 IS NOT NULL AND t23.SUBSPEC1 IS NULL AND t23.NASPEC IS NULL AND t23.spol=2) as specZ, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE ((t24.STATUS LIKE '01%' AND t24.DZRO < '2016-12-31') OR t24.DPRO > '2016-12-31') AND t24.SPEC1 IS NOT NULL AND t24.SUBSPEC1 IS NULL AND t24.NASPEC IS NULL AND t24.spol=1 AND t24.SPEC1!=38 AND (DATEDIFF(NOW(), t24.DATUMR) < 12410)) as specdotcM, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE ((t25.STATUS LIKE '01%' AND t25.DZRO < '2016-12-31') OR t25.DPRO > '2016-12-31') AND t25.SPEC1 IS NOT NULL AND t25.SUBSPEC1 IS NULL AND t25.NASPEC IS NULL AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR) < 12410)) as specdotcZ, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE ((t26.STATUS LIKE '01%' AND t26.DZRO < '2016-12-31') OR t26.DPRO > '2016-12-31') AND t26.SPEC1 IS NOT NULL AND t26.SUBSPEC1 IS NULL AND t26.NASPEC IS NULL AND t26.spol=1 AND t26.SPEC1!=38 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as specdoccM, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE ((t27.STATUS LIKE '01%' AND t27.DZRO < '2016-12-31') OR t27.DPRO > '2016-12-31') AND t27.SPEC1 IS NOT NULL AND t27.SUBSPEC1 IS NULL AND t27.NASPEC IS NULL AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as specdoccZ, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE ((t28.STATUS LIKE '01%' AND t28.DZRO < '2016-12-31') OR t28.DPRO > '2016-12-31') AND t28.SPEC1 IS NOT NULL AND t28.SUBSPEC1 IS NULL AND t28.NASPEC IS NULL AND t28.spol=1 AND t28.SPEC1!=38 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as specdopcM, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE ((t29.STATUS LIKE '01%' AND t29.DZRO < '2016-12-31') OR t29.DPRO > '2016-12-31') AND t29.SPEC1 IS NOT NULL AND t29.SUBSPEC1 IS NULL AND t29.NASPEC IS NULL AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as specdopcZ, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE ((t30.STATUS LIKE '01%' AND t30.DZRO < '2016-12-31') OR t30.DPRO > '2016-12-31') AND t30.SPEC1 IS NOT NULL AND t30.SUBSPEC1 IS NULL AND t30.NASPEC IS NULL AND t30.spol=1 AND t30.SPEC1!=38 AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as specviseppM, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE ((t31.STATUS LIKE '01%' AND t31.DZRO < '2016-12-31') OR t31.DPRO > '2016-12-31') AND t31.SPEC1 IS NOT NULL AND t31.SUBSPEC1 IS NULL AND t31.NASPEC IS NULL AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as specviseppZ "
        . "FROM djel WHERE ID IS NOT NULL";
    $countres = mysqli_query($con, $sql_query);
    if(!$countres){
        echo mysqli_errno($con) . mysqli_error($con);
    }
    $row = mysqli_fetch_assoc($countres);

    
$pdf->Cell(70, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, 'DOBNA SKUPINA', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
//$pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(70, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'Svega', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'do - 34', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '35 - 44', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '45 - 54', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '55 i više', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
//$pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(70, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'UKUPNO', 'LRTB', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=1 ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=2 ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '01%' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);





//$pdf->Cell(11, 4, $row['oPraksaAllM']+$row['naspecM']+$row['specM'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['oPraksaAllZ']+$row['naspecZ']+$row['specZ'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['dotcM']+$row['naspecdotcM']+$row['specdotcM'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['dotcZ']+$row['naspecdotcZ']+$row['specdotcZ'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['doccM']+$row['naspecdoccM']+$row['specdoccM'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['doccZ']+$row['naspecdoccZ']+$row['specdoccZ'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['dopcM']+$row['naspecdopcM']+$row['specdopcM'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['dopcZ']+$row['naspecdopcZ']+$row['specdopcZ'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['viseppM']+$row['naspecviseppM']+$row['specviseppM'], 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, $row['viseppZ']+$row['naspecviseppZ']+$row['specviseppZ'], 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(65, 4, 'Doktori medicine', 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=1 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=2 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0101' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);

$pdf->Ln(4);
$pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(65, 4, 'Na specijalizaciji', 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=1 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=2 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0103' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);

$pdf->Ln(4);
$pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
$pdf->Cell(65, 4, 'Specijalisti', 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=1 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=2 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0102' OR PODVRSTA = '0105') AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$pdf->SetXY(15, 55);
$pdf->StartTransform();
$pdf->Rotate(90);
$pdf->Cell(12, 5, 'Od toga', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->StopTransform();
$pdf->Ln(4);
$pdf->SetXY(15, 51);
$pdf->Ln(4);

$sql_query = "SELECT * FROM specijalizacija";
$result = mysqli_query($con, $sql_query);
$suma=0;
$counter=0;
$counters = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    while($spec = mysqli_fetch_assoc($result)){
        if($spec['ID']==='47'){
            
        }else{
           $sql_query = "SELECT COUNT(*), "
                    . "(SELECT COUNT(*) FROM djel t22 WHERE ((t22.STATUS LIKE '01%' AND t22.DZRO < '2016-12-31') OR t22.DPRO > '2016-12-31') AND (t22.SPEC1 = ".$spec['ID'].") AND t22.spol=1 AND (t22.PODVRSTA = '0102' OR t22.PODVRSTA = '0105')) as specMU, "
                    . "(SELECT COUNT(*) FROM djel t23 WHERE ((t23.STATUS LIKE '01%' AND t23.DZRO < '2016-12-31') OR t23.DPRO > '2016-12-31') AND (t23.SPEC1 = ".$spec['ID'].") AND t23.spol=2 AND (t23.PODVRSTA = '0102' OR t23.PODVRSTA = '0105')) as specZE, "
                    . "(SELECT COUNT(*) FROM djel t24 WHERE ((t24.STATUS LIKE '01%' AND t24.DZRO < '2016-12-31') OR t24.DPRO > '2016-12-31') AND (t24.SPEC1 = ".$spec['ID'].") AND t24.spol=1 AND (t24.PODVRSTA = '0102' OR t24.PODVRSTA = '0105') AND (DATEDIFF(NOW(), t24.DATUMR) < 12410)) as specdotcMU, "
                    . "(SELECT COUNT(*) FROM djel t25 WHERE ((t25.STATUS LIKE '01%' AND t25.DZRO < '2016-12-31') OR t25.DPRO > '2016-12-31') AND (t25.SPEC1 = ".$spec['ID'].") AND t25.spol=2 AND (t25.PODVRSTA = '0102' OR t25.PODVRSTA = '0105') AND (DATEDIFF(NOW(), t25.DATUMR) < 12410)) as specdotcZE, "
                    . "(SELECT COUNT(*) FROM djel t26 WHERE ((t26.STATUS LIKE '01%' AND t26.DZRO < '2016-12-31') OR t26.DPRO > '2016-12-31') AND (t26.SPEC1 = ".$spec['ID'].") AND t26.spol=1 AND (t26.PODVRSTA = '0102' OR t26.PODVRSTA = '0105') AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as specdoccMU, "
                    . "(SELECT COUNT(*) FROM djel t27 WHERE ((t27.STATUS LIKE '01%' AND t27.DZRO < '2016-12-31') OR t27.DPRO > '2016-12-31') AND (t27.SPEC1 = ".$spec['ID'].") AND t27.spol=2 AND (t27.PODVRSTA = '0102' OR t27.PODVRSTA = '0105') AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as specdoccZE, "
                    . "(SELECT COUNT(*) FROM djel t28 WHERE ((t28.STATUS LIKE '01%' AND t28.DZRO < '2016-12-31') OR t28.DPRO > '2016-12-31') AND (t28.SPEC1 = ".$spec['ID'].") AND t28.spol=1 AND (t28.PODVRSTA = '0102' OR t28.PODVRSTA = '0105') AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as specdopcMU, "
                    . "(SELECT COUNT(*) FROM djel t29 WHERE ((t29.STATUS LIKE '01%' AND t29.DZRO < '2016-12-31') OR t29.DPRO > '2016-12-31') AND (t29.SPEC1 = ".$spec['ID'].") AND t29.spol=2 AND (t29.PODVRSTA = '0102' OR t29.PODVRSTA = '0105') AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as specdopcZE, "
                    . "(SELECT COUNT(*) FROM djel t30 WHERE ((t30.STATUS LIKE '01%' AND t30.DZRO < '2016-12-31') OR t30.DPRO > '2016-12-31') AND (t30.SPEC1 = ".$spec['ID'].") AND t30.spol=1 AND (t30.PODVRSTA = '0102' OR t30.PODVRSTA = '0105') AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as specviseppMU, "
                    . "(SELECT COUNT(*) FROM djel t31 WHERE ((t31.STATUS LIKE '01%' AND t31.DZRO < '2016-12-31') OR t31.DPRO > '2016-12-31') AND (t31.SPEC1 = ".$spec['ID'].") AND t31.spol=2 AND (t31.PODVRSTA = '0102' OR t31.PODVRSTA = '0105') AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as specviseppZE "
                    . "FROM djel WHERE ID IS NOT NULL";
           $response = mysqli_query($con, $sql_query);
           if(!$response){
               echo mysqli_errno($con) . mysqli_error($con);
           }
           else{
           $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
           $pdf->Cell(65, 4, $spec['NAZIV'], 'LRT', 0, 'C', 0, 0, 1);
            while($row = mysqli_fetch_assoc($response)){
                $counters[0] = $counters[0] + $row['specMU'];
                $counters[1] = $counters[1] + $row['specZE'];
                $counters[2] = $counters[2] + $row['specdotcMU'];
                $counters[3] = $counters[3] + $row['specdotcZE'];
                $counters[4] = $counters[4] + $row['specdoccMU'];
                $counters[5] = $counters[5] + $row['specdoccZE'];
                $counters[6] = $counters[6] + $row['specdopcMU'];
                $counters[7] = $counters[7] + $row['specdopcZE'];
                $counters[8] = $counters[8] + $row['specviseppMU'];
                $counters[9] = $counters[9] + $row['specviseppZE'];
                $pdf->Cell(11, 4, $row['specMU'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specZE'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Cell(11, 4, $row['specviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
                $pdf->Ln(4);
            }
        }
    }
}
$pdf->SetXY(15, 231);
$pdf->StartTransform();
$pdf->Rotate(90);
$pdf->Cell(176, 5, 'Specijalnosti', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->StopTransform();
$pdf->Ln(4);
$pdf->SetXY(15, 227);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'UKUPNO', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[0], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[1], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[2], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[3], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[4], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[5], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[6], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[7], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[8], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[9], 'LRTB', 0, 'C', 0, 0, 1);




$pdf->resetHeaderTemplate();
$title = '';
$title1 = 'ZDRAVSTVENI DJELATNICI S VISOKOM STRUČNOM SPREMOM';
$title2 = 'PREMA SPECIJALNOSTI, DOBI I SPOLU';
$title3 = 'TABLICA 2.1. Doktori medicine(nastavak)';
$pdf->SetHeaderData($logo, $logoWidth, $title, $title1 . PHP_EOL . $title2. PHP_EOL . $title3);
$pdf->AddPage('P', 'A4');   

$pdf->Cell(70, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, 'DOBNA SKUPINA', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Subspecijalnost', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'Svega', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'do - 34', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '35 - 44', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '45 - 54', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '55 i više', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);

$sql_query = "SELECT * FROM subspecijalizacija";
$result = mysqli_query($con, $sql_query);
$suma=0;
$counter=0;
$counters = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    while($spec = mysqli_fetch_assoc($result)){
       $sql_query = "SELECT COUNT(*), "
        . "(SELECT COUNT(*) FROM djel t22 WHERE ((t22.STATUS LIKE '01%' AND t22.DZRO < '2016-12-31') OR t22.DPRO > '2016-12-31') AND t22.SUBSPEC1 = ".$spec['ID']." AND t22.PODVRSTA = '0104' AND t22.spol=1) as subspecMU, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE ((t23.STATUS LIKE '01%' AND t23.DZRO < '2016-12-31') OR t23.DPRO > '2016-12-31') AND t23.SUBSPEC1 = ".$spec['ID']." AND t23.PODVRSTA = '0104' AND t23.spol=2) as subspecZE, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE ((t24.STATUS LIKE '01%' AND t24.DZRO < '2016-12-31') OR t24.DPRO > '2016-12-31') AND t24.SUBSPEC1 = ".$spec['ID']." AND t24.PODVRSTA = '0104' AND t24.spol=1 AND (DATEDIFF(NOW(), t24.DATUMR)< 12410)) as subspecdotcMU, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE ((t25.STATUS LIKE '01%' AND t25.DZRO < '2016-12-31') OR t25.DPRO > '2016-12-31') AND t25.SUBSPEC1 = ".$spec['ID']." AND t25.PODVRSTA = '0104' AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR)< 12410)) as subspecdotcZE, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE ((t26.STATUS LIKE '01%' AND t26.DZRO < '2016-12-31') OR t26.DPRO > '2016-12-31') AND t26.SUBSPEC1 = ".$spec['ID']." AND t26.PODVRSTA = '0104' AND t26.spol=1 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as subspecdoccMU, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE ((t27.STATUS LIKE '01%' AND t27.DZRO < '2016-12-31') OR t27.DPRO > '2016-12-31') AND t27.SUBSPEC1 = ".$spec['ID']." AND t27.PODVRSTA = '0104' AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as subspecdoccZE, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE ((t28.STATUS LIKE '01%' AND t28.DZRO < '2016-12-31') OR t28.DPRO > '2016-12-31') AND t28.SUBSPEC1 = ".$spec['ID']." AND t28.PODVRSTA = '0104' AND t28.spol=1 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as subspecdopcMU, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE ((t29.STATUS LIKE '01%' AND t29.DZRO < '2016-12-31') OR t29.DPRO > '2016-12-31') AND t29.SUBSPEC1 = ".$spec['ID']." AND t29.PODVRSTA = '0104' AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as subspecdopcZE, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE ((t30.STATUS LIKE '01%' AND t30.DZRO < '2016-12-31') OR t30.DPRO > '2016-12-31') AND t30.SUBSPEC1 = ".$spec['ID']." AND t30.PODVRSTA = '0104' AND t30.spol=1 AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as subspecviseppMU, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE ((t31.STATUS LIKE '01%' AND t31.DZRO < '2016-12-31') OR t31.DPRO > '2016-12-31') AND t31.SUBSPEC1 = ".$spec['ID']." AND t31.PODVRSTA = '0104' AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as subspecviseppZE "
        . "FROM djel WHERE ID IS NOT NULL";
       $response = mysqli_query($con, $sql_query);
       if(!$response){
           echo mysqli_errno($con) . mysqli_error($con);
       }
       else{
       $pdf->Cell(70, 4, $spec['NAZIV'], 'LRT', 0, 'C', 0, 0, 1);
        while($row = mysqli_fetch_assoc($response)){
            $counters[0] = $counters[0] + $row['subspecMU'];
            $counters[1] = $counters[1] + $row['subspecZE'];
            $counters[2] = $counters[2] + $row['subspecdotcMU'];
            $counters[3] = $counters[3] + $row['subspecdotcZE'];
            $counters[4] = $counters[4] + $row['subspecdoccMU'];
            $counters[5] = $counters[5] + $row['subspecdoccZE'];
            $counters[6] = $counters[6] + $row['subspecdopcMU'];
            $counters[7] = $counters[7] + $row['subspecdopcZE'];
            $counters[8] = $counters[8] + $row['subspecviseppMU'];
            $counters[9] = $counters[9] + $row['subspecviseppZE'];
            $pdf->Cell(11, 4, $row['subspecMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['subspecviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Ln(4);
        }
    }
}
$pdf->Cell(70, 4, 'UKUPNO', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[0], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[1], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[2], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[3], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[4], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[5], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[6], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[7], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[8], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[9], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Ln(10);


$pdf->Cell(70, 4, 'TABLICA 2.2. Doktori stomatologije', '', 0, '', 0, 0, 1);
$pdf->Ln(4);
$counter=0;
$counters = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
$pdf->Cell(70, 4, '', 'LRT', 0, 'C', 0, 0, 1);
$pdf->Cell(110, 4, 'DOBNA SKUPINA', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'Svega', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, 'do - 34', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '35 - 44', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '45 - 54', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(22, 4, '55 i više', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);
$pdf->Cell(70, 4, '', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);

       $sql_query = "SELECT COUNT(*), "
        . "(SELECT COUNT(*) FROM djel t22 WHERE ((t22.STATUS LIKE '01%' AND t22.DZRO < '2016-12-31') OR t22.DPRO > '2016-12-31') AND t22.PODVRSTA = '0202' AND t22.spol=1) as stomMU, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE ((t23.STATUS LIKE '01%' AND t23.DZRO < '2016-12-31') OR t23.DPRO > '2016-12-31') AND t23.PODVRSTA = '0202' AND t23.spol=2) as stomZE, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE ((t24.STATUS LIKE '01%' AND t24.DZRO < '2016-12-31') OR t24.DPRO > '2016-12-31') AND t24.PODVRSTA = '0202' AND t24.spol=1 AND (DATEDIFF(NOW(), t24.DATUMR)< 12410)) as stomdotcMU, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE ((t25.STATUS LIKE '01%' AND t25.DZRO < '2016-12-31') OR t25.DPRO > '2016-12-31') AND t25.PODVRSTA = '0202' AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR)< 12410)) as stomdotcZE, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE ((t26.STATUS LIKE '01%' AND t26.DZRO < '2016-12-31') OR t26.DPRO > '2016-12-31') AND t26.PODVRSTA = '0202' AND t26.spol=1 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as stomdoccMU, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE ((t27.STATUS LIKE '01%' AND t27.DZRO < '2016-12-31') OR t27.DPRO > '2016-12-31') AND t27.PODVRSTA = '0202' AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as stomdoccZE, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE ((t28.STATUS LIKE '01%' AND t28.DZRO < '2016-12-31') OR t28.DPRO > '2016-12-31') AND t28.PODVRSTA = '0202' AND t28.spol=1 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as stomdopcMU, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE ((t29.STATUS LIKE '01%' AND t29.DZRO < '2016-12-31') OR t29.DPRO > '2016-12-31') AND t29.PODVRSTA = '0202' AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as stomdopcZE, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE ((t30.STATUS LIKE '01%' AND t30.DZRO < '2016-12-31') OR t30.DPRO > '2016-12-31') AND t30.PODVRSTA = '0202' AND t30.spol=1 AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as stomviseppMU, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE ((t31.STATUS LIKE '01%' AND t31.DZRO < '2016-12-31') OR t31.DPRO > '2016-12-31') AND t31.PODVRSTA = '0202' AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as stomviseppZE "
        . "FROM djel WHERE ID IS NOT NULL";
       
       $r = mysqli_query($con, $sql_query);
       if(!$r){
           echo mysqli_errno($con) . mysqli_error($con);
       }
       else{
       $pdf->Cell(70, 4, 'Oralna kirurgija', 'LRT', 0, 'C', 0, 0, 1);
        while($row = mysqli_fetch_assoc($r)){
            $counters[0] = $counters[0] + $row['stomMU'];
            $counters[1] = $counters[1] + $row['stomZE'];
            $counters[2] = $counters[2] + $row['stomdotcMU'];
            $counters[3] = $counters[3] + $row['stomdotcZE'];
            $counters[4] = $counters[4] + $row['stomdoccMU'];
            $counters[5] = $counters[5] + $row['stomdoccZE'];
            $counters[6] = $counters[6] + $row['stomdopcMU'];
            $counters[7] = $counters[7] + $row['stomdopcZE'];
            $counters[8] = $counters[8] + $row['stomviseppMU'];
            $counters[9] = $counters[9] + $row['stomviseppZE'];
            $pdf->Cell(11, 4, $row['stomMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomdotcMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomdotcZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomdoccMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomdoccZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomdopcMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomdopcZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomviseppMU'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(11, 4, $row['stomviseppZE'], 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Ln(4);
        }
    }
    
    
           $sql_query = "SELECT COUNT(*), "
        . "(SELECT COUNT(*) FROM djel t22 WHERE ((t22.STATUS LIKE '01%' AND t22.DZRO < '2016-12-31') OR t22.DPRO > '2016-12-31') AND t22.PODVRSTA LIKE '03%' AND t22.spol=1) as stomMU, "
        . "(SELECT COUNT(*) FROM djel t23 WHERE ((t23.STATUS LIKE '01%' AND t23.DZRO < '2016-12-31') OR t23.DPRO > '2016-12-31') AND t23.PODVRSTA LIKE '03%' AND t23.spol=2) as stomZE, "
        . "(SELECT COUNT(*) FROM djel t24 WHERE ((t24.STATUS LIKE '01%' AND t24.DZRO < '2016-12-31') OR t24.DPRO > '2016-12-31') AND t24.PODVRSTA LIKE '03%' AND t24.spol=1 AND (DATEDIFF(NOW(), t24.DATUMR)< 12410)) as stomdotcMU, "
        . "(SELECT COUNT(*) FROM djel t25 WHERE ((t25.STATUS LIKE '01%' AND t25.DZRO < '2016-12-31') OR t25.DPRO > '2016-12-31') AND t25.PODVRSTA LIKE '03%' AND t25.spol=2 AND (DATEDIFF(NOW(), t25.DATUMR)< 12410)) as stomdotcZE, "
        . "(SELECT COUNT(*) FROM djel t26 WHERE ((t26.STATUS LIKE '01%' AND t26.DZRO < '2016-12-31') OR t26.DPRO > '2016-12-31') AND t26.PODVRSTA LIKE '03%' AND t26.spol=1 AND (DATEDIFF(NOW(), t26.DATUMR) BETWEEN 12410 AND 16059)) as stomdoccMU, "
        . "(SELECT COUNT(*) FROM djel t27 WHERE ((t27.STATUS LIKE '01%' AND t27.DZRO < '2016-12-31') OR t27.DPRO > '2016-12-31') AND t27.PODVRSTA LIKE '03%' AND t27.spol=2 AND (DATEDIFF(NOW(), t27.DATUMR) BETWEEN 12410 AND 16059)) as stomdoccZE, "
        . "(SELECT COUNT(*) FROM djel t28 WHERE ((t28.STATUS LIKE '01%' AND t28.DZRO < '2016-12-31') OR t28.DPRO > '2016-12-31') AND t28.PODVRSTA LIKE '03%' AND t28.spol=1 AND (DATEDIFF(NOW(), t28.DATUMR) BETWEEN 16060 AND 19709)) as stomdopcMU, "
        . "(SELECT COUNT(*) FROM djel t29 WHERE ((t29.STATUS LIKE '01%' AND t29.DZRO < '2016-12-31') OR t29.DPRO > '2016-12-31') AND t29.PODVRSTA LIKE '03%' AND t29.spol=2 AND (DATEDIFF(NOW(), t29.DATUMR) BETWEEN 16060 AND 19709)) as stomdopcZE, "
        . "(SELECT COUNT(*) FROM djel t30 WHERE ((t30.STATUS LIKE '01%' AND t30.DZRO < '2016-12-31') OR t30.DPRO > '2016-12-31') AND t30.PODVRSTA LIKE '03%' AND t30.spol=1 AND (DATEDIFF(NOW(), t30.DATUMR)>= 19710)) as stomviseppMU, "
        . "(SELECT COUNT(*) FROM djel t31 WHERE ((t31.STATUS LIKE '01%' AND t31.DZRO < '2016-12-31') OR t31.DPRO > '2016-12-31') AND t31.PODVRSTA LIKE '03%' AND t31.spol=2 AND (DATEDIFF(NOW(), t31.DATUMR)>= 19710)) as stomviseppZE "
        . "FROM djel WHERE ID IS NOT NULL";
    
$pdf->Cell(70, 4, 'UKUPNO', 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[0], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[1], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[2], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[3], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[4], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[5], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[6], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[7], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[8], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Cell(11, 4, $counters[9], 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Ln(10);
//$pdf->Cell(70, 4, '', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(110, 4, 'DOBNA SKUPINA', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);
//$pdf->Cell(70, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, 'Svega', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, 'do - 34', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, '35 - 44', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, '45 - 54', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, '55 i više', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);
//$pdf->Cell(70, 4, '', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);  
$pdf->Cell(70, 4, 'TABLICA 2.3. Diplomirani farmaceuti', '', 0, '', 0, 0, 1);
$pdf->Ln(4);  
$pdf->Cell(70, 4, 'Diplomirani farmaceuti', 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=1 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=2 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0302' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);

$pdf->Ln(4);
$pdf->Cell(70, 4, 'Na specijalizaciji', 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=1 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=2 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0304' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);

$pdf->Ln(4);
$pdf->Cell(70, 4, 'Specijalisti', 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=1 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=2 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA = '0303' ) AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$pdf->Ln(4);

$pdf->Ln(10);
$pdf->Cell(150, 4, 'TABLICA 2.4. Zdravstveni suradnici s visokom stručnom spremom', '', 0, '', 0, 0, 1);
$pdf->Ln(4);
//$pdf->Cell(70, 4, '', 'LRT', 0, 'C', 0, 0, 1);
//$pdf->Cell(110, 4, 'DOBNA SKUPINA', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);
//$pdf->Cell(70, 4, 'Specijalnost', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, 'Svega', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, 'do - 34', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, '35 - 44', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, '45 - 54', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(22, 4, '55 i više', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);
//$pdf->Cell(70, 4, '', 'LR', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'M', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Cell(11, 4, 'Ž', 'RT', 0, 'C', 0, 0, 1);
//$pdf->Ln(4);  
$pdf->Cell(70, 4, 'Visoka sprema', 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=1 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=2 ";
$pdf->Cell(11, 4, execute($con, $q), 'LRT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=1 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
$q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0601' AND SPOL=2 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
$pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);

$pdf->resetHeaderTemplate();
$title = '';
$title1 = 'ZDRAVSTVENI DJELATNICI S VISOKOM STRUČNOM SPREMOM';
$title2 = 'PREMA SPECIJALNOSTI, DOBI I SPOLU';
$title3 = 'TABLICA 3';
$pdf->SetHeaderData($logo, $logoWidth, $title, $title1 . PHP_EOL . $title2. PHP_EOL . $title3);
$pdf->AddPage('P', 'A4');   

$pdf->cell(53, 4, '', 'RTL', 0, 'C', 0, 0, 1);
    $pdf->cell(17, 4, '', 'RTL', 0, 'C', 0, 0, 1);
    $pdf->cell(110, 4, 'Dobna skupina', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->cell(53, 4, ' Profil - ', 'RL', 0, 'C', 0, 0, 1);
    $pdf->cell(17, 4, 'Stručna', 'RL', 0, 'C', 0, 0, 1);
//    $pdf->cell(110, 4, '', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, 'Svega', 'RTLB', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, 'do 34 god.', 'RTLB', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, '34-44', 'RTLB', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, '44-54', 'RTLB', 0, 'C', 0, 0, 1);
    $pdf->Cell(22, 4, '55 i više', 'RTLB', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->cell(53, 4, 'smjer ', 'RL', 0, 'C', 0, 0, 1);
    $pdf->cell(17, 4, 'sprema', 'RL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'M', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'M', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'M', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'M', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'M', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, 'Ž', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->cell(53, 4, '', 'RBL', 0, 'C', 0, 0, 1);
    $pdf->cell(17, 4, '', 'RBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '1', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '2', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '3', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '4', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '5', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '6', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '7', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '8', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '9', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '10', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->cell(53, 4, '  ', 'RL', 0, 'C', 0, 0, 1);
    $pdf->cell(17, 4, 'viša', 'RTL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM = 19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM = 19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->cell(53, 4, 'UKUPNO ', 'RL', 0, 'C', 0, 0, 1);
    $pdf->cell(17, 4, 'srednja', 'TRL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND (PODVRSTA LIKE '04%' OR PODVRSTA LIKE '05%') AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->cell(53, 4, '  ', 'RL', 0, 'C', 0, 0, 1);
    $pdf->cell(17, 4, 'niža', 'RTL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->cell(11, 4, '0', 'RTBL', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, 'SVEGA', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'RT', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '04%' AND SSRM = 19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '04%' AND SSRM = 19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, '', 'R', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'R', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '04%' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA LIKE '04%' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA LIKE '04%' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, 'Općeg smjera', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'RTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0401' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0401' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, '', 'R', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'R', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0401' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0401' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0401' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, 'Pedijatrisjke', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'RTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, '', 'R', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
        $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, 'Primalje', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'RTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0403' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0403' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, '', 'R', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'R', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0403' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0403' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0403' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, 'Stomatološka', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'RTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, '', 'R', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->ln(4);
        $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, 'Ortoptičari', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'RTB', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, '', 'R', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'RT', 0, 'C', 0, 0, 1);
        $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->ln(4);
            $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, 'Ostalo', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'RTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0406' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0406' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(5, 4, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(48, 4, '', 'R', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'R', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0406' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0406' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0406' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->SetXY(15, 111);
    $pdf->StartTransform();
    $pdf->Rotate(90);
    $pdf->writeHTMLCell(56, 5, '', '', 'Medicinske sestre', 1, 0, false, true, 'C', false);
    $pdf->StopTransform();
    $pdf->Ln(5);
    $pdf->SetXY(15, 111);
    
    $pdf->Cell(53, 4, 'RTG tehničari', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0501' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0501' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    
    $pdf->Cell(53, 4, '', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'LR', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0501' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0501' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0501' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
            
    $pdf->Cell(53, 4, 'Fizioterapeutski tehničari', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0502' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0502' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    
    $pdf->Cell(53, 4, '', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'LR', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0502' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0502' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0502' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
            
    $pdf->Cell(53, 4, 'Farmaceutski tehničari', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0507' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0507' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    
    $pdf->Cell(53, 4, '', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'LR', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0507' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0507' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0507' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
            
    $pdf->Cell(53, 4, 'Sanitarni tehničari', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0503' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0503' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    
    $pdf->Cell(53, 4, '', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'LR', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0503' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0503' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0503' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
            
    $pdf->Cell(53, 4, 'Radnoterapeutski tehničari', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0504' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0504' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    
    $pdf->Cell(53, 4, '', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'LR', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0504' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0504' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0504' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
            
    $pdf->Cell(53, 4, 'Laboratorijski tehničari', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0505' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0505' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    
    $pdf->Cell(53, 4, '', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'LR', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0505' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0505' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0505' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(53, 4, 'Zubni tehničari', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'LRTB', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    $pdf->Cell(53, 4, '', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'LR', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Cell(11, 4, '0', 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
                
    $pdf->Cell(53, 4, 'Ostalo', 'LRT', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'viša', 'LRTB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0508' AND SSRM=19 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0508' AND SSRM=19 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=1 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=2 AND SSRM=19 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RT', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);
    
    $pdf->Cell(53, 4, '', 'LRB', 0, 'C', 0, 0, 1);
    $pdf->Cell(17, 4, 'srednja', 'LRB', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0508' AND SSRM=7 AND SPOL = 1 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q = "SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA=1 AND PODVRSTA = '0508' AND SSRM=7 AND SPOL = 2 ";
    $pdf->cell(11, 4, execute($con, $q), 'RTBL', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RTB', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) < 12410) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RTB', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RTB', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 12410 AND 16059) ";
    $pdf->Cell(11, 4, execute($con, $q), 'RTB', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RTB', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR) BETWEEN 16060 AND 19709)";
    $pdf->Cell(11, 4, execute($con, $q), 'RTB', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=1 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RTB', 0, 'C', 0, 0, 1);
    $q="SELECT COUNT(*) FROM djel WHERE ((STATUS LIKE '01%' AND DZRO < '2016-12-31') OR DPRO > '2016-12-31') AND VRSTA = 1 AND PODVRSTA = '0508' AND SPOL=2 AND SSRM=7 AND (DATEDIFF(NOW(), DATUMR)>= 19710)";
    $pdf->Cell(11, 4, execute($con, $q), 'RTB', 0, 'C', 0, 0, 1);
    $pdf->Ln(4);







$pdf->lastPage();
$pdf->Output('Organizacijska_struktura.pdf', 'I');
