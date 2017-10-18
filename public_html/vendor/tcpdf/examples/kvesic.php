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


$pdf->setHeaderFont(Array('times', '', PDF_FONT_SIZE_MAIN));
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
$pdf->SetFont('dejavusans', '', 11);

//include_once('db.php');
//include_once('report_search.php');
////include_once('report_functions.php');
//   $klinika = $_GET['klinika'];
//    $date = new DateTime(date("Y-m-d"));
//$d = $date->d;
//$m = $date->m;
//$y = $date->y;
    $pdf->SetHeaderData($logo, $logoWidth, '');
//    $odjeli[] = $rowy; ,  date_format($date, 'd.m.Y')
    $pdf->SetPrintFooter(false);
    $pdf->AddPage('P', 'A4');

// set cell padding
    $pdf->setCellPaddings(0, 0, 0, 0);

// set cell margins
    $pdf->setCellMargins(0, 0, 0, 0);

// set color for background
    $pdf->SetFillColor(255, 255, 127);
    
//    $query = "SELECT *, nomtit.IDe as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
//            . "FROM djel "
//            . "LEFT JOIN nomss "
//            . "ON djel.SS = nomss.ID " //ne radi zato što je to u bazi varchar...
//            . "LEFT JOIN nomskspr "
//            . "ON djel.SKSPR = nomskspr.ID "
//            . "LEFT JOIN nomrm "
//            . "ON djel.RM = nomrm.ID "
//            . "LEFT JOIN nomzan "
//            . "ON djel.ZAN = nomzan.ID "
//            . "LEFT JOIN nomtit "
//            . "ON djel.TITULA = nomtit.ID "
//            . "LIMIT 10";
    
//    $query = "SELECT *, nomrm.NAZIV as RM, klinika.NAZIV as klinika, godod.UKUPNO as ukupno, godod.GODODOD as godod, godod.GODODDO as goddo "
//            . "FROM djel "
//            . "INNER JOIN nomrm "
//            . "ON nomrm.ID = djel.RM "
//            . "INNER JOIN klinika "
//            . "ON klinika.SIFRA = djel.KLINIKA "
//            . "INNER JOIN godod "
//            . "ON godod.DJEL = djel.ID "
//            . "WHERE djel.KLINIKA = ".$klinika." ";
    
//    $query = "SELECT *, klinika.NAZIV as klinika, nomrm.NAZIV as RM, nomtit.IDe as TITULA "
//            . "FROM godod "
//            . "LEFT JOIN djel "
//            . "ON djel.ID = godod.DJEL "
//            . "INNER JOIN klinika "
//            . "ON klinika.SIFRA = djel.KLINIKA "
//            . "INNER JOIN nomrm "
//            . "ON nomrm.ID = djel.RM "
//            . "LEFT JOIN nomtit "
//            . "ON nomtit.ID = djel.TITULA "
//            . "WHERE djel.KLINIKA = ".$klinika." ";
//    print_r($query);

//    $result = mysqli_query($con, $query);
//    print_r($query);
//    $counter=0;
    
//    if(mysqli_num_rows($result)===0){            
//        $pdf->deletePage($pdf->PageNo());
////        $pdf->resetHeaderTemplate();
//
//    }else{
        
//        $pdf->Cell(8, 6, 'R.B.', 'LR', 0, 'C');
//        $pdf->Cell(56, 6, 'DJELATNIK', 'LR', 0, 'C');
//        $pdf->Cell(60, 6, 'ZANIMANJE', 'LR', 0, 'C');
//        $pdf->Cell(60, 6, 'RADNO MJESTO', 'LR', 0, 'C');
//        $pdf->Cell(36, 6, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
//        $pdf->Cell(11, 6, 'SS', 'LR', 0, 'C', 0, 0, 1);
//        $pdf->Cell(18, 6, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
//        $pdf->Cell(18, 6, 'DZRO', 'LR', 0, 'C', 0, 0, 1);
//        $pdf->Cell(15, 6, 'STAZ', 'LR', 0, 'C', 0, 0, 1);
//        $pdf->Ln(6);
    
//    }


//while($row =  mysqli_fetch_assoc($result)){
//    if(!empty($row)){
//    $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
//    $counter++;
    $pdf->Cell(180, 5, 'Broj: ___________________');
    $pdf->Ln(7);
    $pdf->Cell(180, 5, 'Mostar, 23.2.2016. godine');
    $pdf->Ln(10);
    $pdf->Cell(180, 5, 'Temeljem članka 112. i 52. stav 2 Zakona o radu ("Službene novine Federacije BIH",', '', 0, '', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'broj 62/15), Pravilnika o radu SKB Mostar i Plana korištenja godišnjih odmora za ', '', 0, '', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '2016. godinu, donosim');
    $pdf->Ln(10);    
    $pdf->SetFont('dejavusans', 'B', 11);
    $pdf->Cell(80, 5, '', '', 0, '', 0, 0, 1);
    $pdf->Cell(180, 5, 'RJEŠENJE', '', 0, '', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(57);
    $pdf->Cell(180, 5, 'o korištenju godišnjeg odmora');
    $pdf->Ln(12);    
//    $rm = mb_strtolower($row["RM"], 'UTF-8');
    $pdf->SetFont('dejavusans', '', 11);
    $pdf->Cell(5, 5, '1.');
    $pdf->SetFont('dejavusans', 'B', 11);
    $pdf->Cell(65, 5, ' Prof.dr.sc. Ante Kvesić, ', 'B', 0, 'C', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 11);
    $pdf->Cell(115, 5, ' radniku na radnom mjestu ravnatelj na ', '', 0, '', 0, 0, 1);
    $pdf->Ln(5);
//    $klinika = mb_strtolower(Ravnateljstvo, 'UTF-8');
//    $klinika = ucfirst($klinika);
    $pdf->Cell(70, 5, ' Ravnateljstvo ', 'B', 0, 'J', 0, 0, 1);
    $pdf->SetFont('dejavusans', 'B', 11);
    $pdf->Cell(110, 5, ' utvrđuje se pravo na godišnji odmor za 2016. godinu, ', '', 0, '', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(73, 5, '    u trajanju od ukupno 30 radnih dana, ', '', 0, '', 0, 0, 1);
    $pdf->SetFont('dejavusans', '', 11);
    $pdf->Cell(107, 5, 'prema sljedećim osnovama i kriterijima: ', '', 0, 'L', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '    -zakonska osnova 20 radnih dana');
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '   -pripadajući broj dana temeljem kriterija utvrđenih člankom 45. Pravilnika o radu SKB', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '    Mostar');
    $pdf->Ln(10);
    $pdf->Cell(180, 5, '2. Jedan dan godišnjeg odmora radnik može koristiti kad  želi, uz obavezu da o tome obavijesti', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '   poslodavca namjanje tri dana prije njegovog korištenja.', '', 0, '', 0, 0, 1);
    $pdf->Ln(10);
    $pdf->Cell(180, 5, '3. Za vrijeme korištenja godišnjeg odmora radnik ima pravo na naknadu plaće u skladu sa', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '   člankom 52. stav 3. Zakona o radu.', '', 0, '', 0, 0, 1);    
    $pdf->Ln(12);
    $pdf->Cell(75);
    $pdf->SetFont('dejavusans', 'B', 11);
    $pdf->Cell(100, 5, 'Obrazloženje');
    $pdf->SetFont('dejavusans', '', 11);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'Sukladno članku 48. Zakona o radu ("Službene novine Federacije BiH", broj 62/15)', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'radnik koji se prvi put uposli ili ima prekid rada između dva radna odnosa dulji od ', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '15 dana, stječe pravo na godišnju odmor nakon 6 mjeseci neprekidnog rada.');
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'Ako radnik nije stekao pravo na godišnji odmor, ima pravo na najmanje jedan dan godišnjeg ', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'odmora za svaki navršeni mjesec dana rada, sukladno kolektivnom ugovoru, pravilniku o radu', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'i ugovoru o radu.', '', 0, '', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'Dužina trajanja godišnjeg odmora iz točke 1. ovog rješenja određena je tako što je zakonski', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'minimum godišnjeg odmora uvećan za pripadajući broj dana temeljem kriterija utvrđenih', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'Pravilnikom o radu SKB Mostar.', '', 0, '', 0, 0, 1);
        $pdf->Ln(5);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'Protiv ovog rješenja može se uložiti pismeni prigovor poslodavcu, u roku od 30 dana od ', '', 0, 'J', 0, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'dana dostavljanja ovog rješenja');
    $pdf->Ln(12);
    $pdf->Cell(110);
    $pdf->Cell(180, 5, 'Predsjednik upravnog vijeća');
    $pdf->Ln(8);
    $pdf->Cell(120);
    $pdf->Cell(180, 5, 'v.r. Dr. Branka Galić'); 
    $pdf->Ln(5);
    $pdf->Cell(180, 5, 'Dostaviti:');
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '-Imenovanom radniku');
    $pdf->Ln(5);
    $pdf->Cell(180, 5, '-Službi za kadrovske poslove'); 
    $pdf->Ln(20);
    $pdf->Ln(6);     
        
$pdf->lastPage();
//$pdf->SetPrintFooter(false);
$pdf->resetHeaderTemplate();


$pdf->Output('example_005.pdf', 'I');

