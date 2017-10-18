<?php

require_once('tcpdf_include.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dragan Kvesić');
$pdf->SetTitle('Izvještaj 2_PP');
$pdf->SetSubject('Izvještaj');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$logo = "..//images/logo.gif";
$logoWidth = 55;
$title = 'POPIS DJELATNIKA';

$pdf->setHeaderFont(Array('dejavusans', '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

$pdf->SetFont('dejavusans', '', 8);

include('db.php');
include_once('report_searchs.php');

//$date = new DateTime(date("Y-m-d"));
//$pdf->SetHeaderData($logo, $logoWidth, $title);
//$pdf->AddPage('L', 'A4');

////$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
////$pdf->Cell(56, 5, 'DJELATNIK', 'LR', 0, 'C');
////$pdf->Cell(60, 5, 'ZANIMANJE', 'LR', 0, 'C');
////$pdf->Cell(60, 5, 'RADNO MJESTO', 'LR', 0, 'C');
////$pdf->Cell(36, 5, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
////$pdf->Cell(11, 5, 'SS', 'LR', 0, 'C', 0, 0, 1);
////$pdf->Cell(18, 5, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
////$pdf->Cell(18, 5, 'DZRO', 'LR', 0, 'C', 0, 0, 1);  
////$pdf->Ln(5);
//    
if(@isset($_GET['klinika'])){
    $query = @"SELECT * FROM klinike WHERE SIFRA LIKE '".@$_GET["klinika"]."%';";
//    echo $query;
}else{
    $query = @"SELECT * FROM klinike";
}
$clinicList = mysqli_query($con, $query);
$suma=0;
while($clinic = mysqli_fetch_assoc($clinicList)){
    $counter=0;
    $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.klinika LIKE '".$clinic['SIFRA']."%' OR djel.odjel LIKE '".$clinic['SIFRA']."%' OR djel.odsjek LIKE '".$clinic['SIFRA']."%') ".$where." ";
    $checkNulls = mysqli_query($con, $query);
    $checkNulls = mysqli_fetch_assoc($checkNulls);
    if($checkNulls['kaunt']!=='0'){
        $date = new DateTime(date("Y-m-d"));
        $pdf->SetHeaderData($logo, $logoWidth, $title, $clinic['NAZIV'] . PHP_EOL . date_format($date, 'd.m.Y'));
        $pdf->AddPage('L', 'A4');
//        $pdf->SetLineWidth(0.1);
//        $pdf->setCellPaddings(0, 0, 0, 0);
//        $pdf->setCellMargins(0, 0, 0, 0);
        $fill = $pdf->SetFillColor(160, 160, 160);
        
//        $pdf->writeHTMLCell($w, $h, $x, $y, $html, $border, $ln, $fill, $reseth, $align)
        $pdf->writeHTMLCell(8, 7, '', '', 'R.B.', 'LR', 0, true, '', 'C');
        $pdf->writeHTMLCell(56, 7, '', '', 'DJELATNIK', 'LR', 0, true, '', 'C');
        $pdf->writeHTMLCell(60, 7, '', '', 'ZANIMANJE', 'LR', 0, true, '', 'C');
        $pdf->writeHTMLCell(60, 7, '', '', 'RADNO MJESTO', 'LR', 0, true, '', 'C');
        $pdf->writeHTMLCell(36, 7, '', '', 'ŠKOLSKA SPREMA', 'LR', 0, true, '', 'C');
        $pdf->writeHTMLCell(11, 7, '', '', 'SS', 'LR', 0, true, '', 'C');
        $pdf->writeHTMLCell(18, 7, '', '', 'DATUMR', 'LR', 0, true, '', 'C');
        $pdf->writeHTMLCell(18, 7, '', '', 'DZRO', 'LR', 0, true, '', 'C');  
        $pdf->Ln(7);
        $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
            . "FROM djel "
            . "LEFT JOIN nomtit "
            . "ON djel.TITULA = nomtit.ID "
            . "LEFT JOIN nomzan "
            . "ON djel.ZAN = nomzan.ID "
            . "LEFT JOIN nomrm "
            . "ON djel.RM = nomrm.ID "
            . "LEFT join nomskspr "
            . "ON djel.SKSPR = nomskspr.ID "
            . "LEFT JOIN nomss "
            . "ON djel.SS = nomss.ID "
            . "WHERE djel.klinika LIKE '%".$clinic['SIFRA']."%' AND ODJEL IS NULL ".$where." ORDER BY nomrm.INDEX ";
        $clinicPeople = mysqli_query($con, $query);
        while($row =  mysqli_fetch_assoc($clinicPeople)){
            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
//            $pdf->writehtm
            $pdf->writeHTMLCell(8, 7, '', '', $counter, 'LRT', 0, 0, true, 'C');
            $pdf->writeHTMLCell(56, 7, '', '', $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, false, true, 'C');
            $pdf->writeHTMLCell(60, 7, '', '', $row["ZANIMANJE"], 'RT', 0, 0, true, 'C');
            $pdf->writeHTMLCell(60, 7, '', '', $row["RAM"], 'RT', 0, 0, true, 'C');
            $pdf->writeHTMLCell(36, 7, '', '', $row["SKASPR"], 'RT', 0, 0, true, 'C');
            $pdf->writeHTMLCell(11, 7, '', '', $row["SAS"], 'RT', 0, 0, true, 'C');
            $pdf->writeHTMLCell(18, 7, '', '', date2mysql($row["DATUMR"]), 'RT', 0, 0, true, 'C');
            $pdf->writeHTMLCell(18, 7, '', '', date2mysql($row["DZRO"]), 'RT', 0, 0, true, 'C');
            $pdf->Ln(7);  
            if($counter%20===0){
                $pdf->AddPage();    
            }
        }
        $query = "SELECT * FROM odjeli WHERE SIFRA LIKE '".$clinic['SIFRA']."%' ";
        $divisionList = mysqli_query($con, $query);
        while($division = mysqli_fetch_assoc($divisionList)){
            $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.odjel LIKE '".$division['SIFRA']."%' OR djel.odsjek LIKE '".$division['SIFRA']."%') ".$where." ";
            $checkNulls = mysqli_query($con, $query);
            $checkNulls = mysqli_fetch_assoc($checkNulls);
            if($checkNulls['kaunt']!=='0'){
                $pdf->SetFillColor(200, 200, 200);
//                if($counter%20===0){
//                    $pdf->AddPage();    
//                }
                $pdf->writeHTMLCell(267, 5, '', '', $division['NAZIV'], 'LR', 0, false, true, 'C');
                $pdf->Ln(5);
                $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
                . "FROM djel "
                . "LEFT JOIN nomtit "
                . "ON djel.TITULA = nomtit.ID "
                . "LEFT JOIN nomzan "
                . "ON djel.ZAN = nomzan.ID "
                . "LEFT JOIN nomrm "
                . "ON djel.RM = nomrm.ID "
                . "LEFT join nomskspr "
                . "ON djel.SKSPR = nomskspr.ID "
                . "LEFT JOIN nomss "
                . "ON djel.SS = nomss.ID "
                . "WHERE djel.ODJEL = '".$division['SIFRA']."' AND ODSJEK IS NULL ".$where." ORDER BY nomrm.INDEX ";
                $divisionPeople = mysqli_query($con, $query); 
                while($row =  mysqli_fetch_assoc($divisionPeople)){
                    $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
                    $counter++;
                    $pdf->writeHTMLCell(8, 7, '', '', $counter, 'RTLB', 0, false, true, 'C');
                    $pdf->writeHTMLCell(56, 7, '', '', $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RTB', 0, false, true, 'C');
                    $pdf->writeHTMLCell(60, 7, '', '', $row["ZANIMANJE"], 'RTB', 0, false, true, 'C');
                    $pdf->writeHTMLCell(60, 7, '', '', $row["RAM"], 'RTB', 0, false, true, 'C');
                    $pdf->writeHTMLCell(36, 7, '', '', $row["SKASPR"], 'RTB', 0, false, true, 'C');
                    $pdf->writeHTMLCell(11, 7, '', '', $row["SAS"], 'RTB', 0, false, true, 'C');
                    $pdf->writeHTMLCell(18, 7, '', '', date2mysql($row["DATUMR"]), 'RTB', 0, false, true, 'C');
                    $pdf->writeHTMLCell(18, 7, '', '', date2mysql($row["DZRO"]), 'RTB', 0, false, true, 'C');
                    $pdf->Ln(7);
                    if($counter%20===0){
                        $pdf->AddPage();    
                    }
                }
                $query = "SELECT * FROM odsjeci WHERE SIFRA LIKE '".$division['SIFRA']."%' ";
                $sectionList = mysqli_query($con, $query);
                while($section = mysqli_fetch_assoc($sectionList)){
                    $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.odsjek LIKE '".$section['SIFRA']."%') ".$where." ";
                    $checkNulls = mysqli_query($con, $query);
                    $checkNulls = mysqli_fetch_assoc($checkNulls);
                    if($checkNulls['kaunt']!=='0'){
                        $pdf->SetFillColor(250, 250, 250);
                        $pdf->writeHTMLCell(267, 7, $section['NAZIV'], 'LRTB', 0, false, true, 'C');
                        $pdf->Ln(7);
                         $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
                        . "FROM djel "
                        . "LEFT JOIN nomtit "
                        . "ON djel.TITULA = nomtit.ID "
                        . "LEFT JOIN nomzan "
                        . "ON djel.ZAN = nomzan.ID "
                        . "LEFT JOIN nomrm "
                        . "ON djel.RM = nomrm.ID "
                        . "LEFT join nomskspr "
                        . "ON djel.SKSPR = nomskspr.ID "
                        . "LEFT JOIN nomss "
                        . "ON djel.SS = nomss.ID "
                        . "WHERE djel.odsjek = '".$section['SIFRA']."' ".$where." ORDER BY nomrm.INDEX ";
                        $sectionPeople = mysqli_query($con, $query);   
                        while($row =  mysqli_fetch_assoc($sectionPeople)){
                            $fill = $pdf->SetFillColor(160, 160, 160);
                            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
                            $counter++;
                            $pdf->writeHTMLCell(8, 7, $counter, 'LRTB', 0, false, false, 'C');
                            $pdf->writeHTMLCell(56, 7, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'LRT', 0, false, false, 'C');
                            $pdf->writeHTMLCell(60, 7, $row["ZANIMANJE"], 'RT', 0, false, false, 'C');
                            $pdf->writeHTMLCell(60, 7, $row["RAM"], 'RT', 0, false, false, 'C');
                            $pdf->writeHTMLCell(36, 7, $row["SKASPR"], 'RT', 0, false, false, 'C');
                            $pdf->writeHTMLCell(11, 7, $row["SAS"], 'RT', 0, false, false, 'C');
                            $pdf->writeHTMLCell(18, 7, date2mysql($row["DATUMR"]), 'RT', 0, false, false, 'C');
                            $pdf->writeHTMLCell(18, 7, date2mysql($row["DZRO"]), 'RT', 0, false, false, 'C');
                            $pdf->Ln(5);
                            if($counter%20===0){
                                $pdf->AddPage();    
                            }
                        }
                    }
                }
            }
        }
    }
    $pdf->lastPage();
    $pdf->resetHeaderTemplate();
}
$pdf->Output('2_PP.pdf', 'I');