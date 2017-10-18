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
include_once('report_searchs.php');

$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth);
$pdf->AddPage('P', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
//$pdf->Cell(180, 5, 'BROJ DJELATNIKA PREDVIĐENIH SISTEMATIZACIJOM', 'LRTB', 0, 'C');
//$pdf->Ln(5);
$pdf->Cell(10, 5, 'R.B.', 'LRB', 0, 'C');
$pdf->Cell(110, 5, 'KLINIKE', 'LRB', 0, 'C');
$pdf->Cell(30, 5, 'PO SISTEMATIZACIJI', 'LRB', 0, 'C');
$pdf->Cell(30, 5, 'TRENUTNO', 'LRB', 0, 'C');
$pdf->Ln(5);
    
if(isset($_GET['klinika'])){
    $query = "SELECT * FROM klinike WHERE SIFRA LIKE '".$_GET["klinika"]."%';";
//    print_r($query);
}else{
    $query = "SELECT * FROM klinike ORDER BY SIFRA ASC ";
}
$clinicList = mysqli_query($con, $query);
$suma=0;
$counter=0;
//$fill = $pdf->SetFillColor(160, 160, 160);
    $counterAll = 0;
while($clinic = mysqli_fetch_assoc($clinicList)){
    $counterByClinic = 0;
    $counterByClinicSistem = 0;
//        $query = "SELECT ID FROM djel WHERE djel.klinika LIKE '".$clinic['SIFRA']."%' AND djel.odjel LIKE '".$clinic['SIFRA']."%' AND djel.ODSJEK LIKE '".$clinic['SIFRA']."%' ".$where."";
        $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.klinika LIKE '".$clinic['SIFRA']."%' AND djel.odjel IS NULL AND djel.odsjek IS NULL) ".$where." ";
        $checkNulls = mysqli_query($con, $query);
        $checkNulls = mysqli_fetch_assoc($checkNulls);
//        while($fuckme = mysqli_fetch_assoc($checkNulls)){echo $fuckme['kaunt']; echo '<br/>';}
//        if($checkNulls['kaunt']!=='0'){
            $counterByClinic += $checkNulls['kaunt'];
            $counterByClinicSistem += $clinic['SISTEMATIZACIJA'];
            $fill = $pdf->SetFillColor(160, 160, 160);
            $counter++;
            $pdf->Cell(10, 5, $counter, 'LR', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(110, 5, $clinic['NAZIV'], 'LRB', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Cell(30, 5, $clinic['SISTEMATIZACIJA'] . '*', 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Cell(60, 5, $checkNulls['kaunt'], 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Ln(5);

            
    $query = "SELECT * FROM odjeli WHERE SIFRA LIKE '".$clinic['SIFRA']."%' ORDER BY SIFRA ASC ";
    $divisionList = mysqli_query($con, $query);
    while($division = mysqli_fetch_assoc($divisionList)){
        
        $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.odjel LIKE '".$division['SIFRA']."%' AND djel.odsjek IS NULL) ".$where." ";
        $checkNulls = mysqli_query($con, $query);
        $checkNulls = mysqli_fetch_assoc($checkNulls);
//        if($checkNulls['kaunt']!=='0'){
        $counterByClinic += $checkNulls['kaunt'];
        $counterByClinicSistem += $division['SISTEMATIZACIJA'];
        $fill = $pdf->SetFillColor(200, 200, 200);
        if($division['SIFRA']==='002710'){         
            $pdf->Cell(10, 5, '', 'LR', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(110, 5, $division['NAZIV'], 'LRB', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Cell(30, 5, $division['SISTEMATIZACIJA'] . '**', 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Cell(60, 5, $checkNulls['kaunt'], 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Ln(5);
        }else if($division['SIFRA']==='003202'){
            $counterByClinicSistem += 47;
            $pdf->Cell(10, 5, '', 'LR', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(110, 5, $division['NAZIV'], 'LRB', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Cell(30, 5, $division['SISTEMATIZACIJA'] . ' + 47**', 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Cell(60, 5, $checkNulls['kaunt'], 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Ln(5);
        }
        else{
            $pdf->Cell(10, 5, '', 'LR', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(110, 5, $division['NAZIV'], 'LRB', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Cell(30, 5, $division['SISTEMATIZACIJA'], 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Cell(60, 5, $checkNulls['kaunt'], 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Ln(5);            
        }
        
        
        
//        $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
//        . "FROM djel "
//        . "LEFT JOIN nomtit "
//        . "ON djel.TITULA = nomtit.ID "
//        . "LEFT JOIN nomzan "
//        . "ON djel.ZAN = nomzan.ID "
//        . "LEFT JOIN nomrm "
//        . "ON djel.RM = nomrm.ID "
//        . "LEFT join nomskspr "
//        . "ON djel.SKSPR = nomskspr.ID "
//        . "LEFT JOIN nomss "
//        . "ON djel.SS = nomss.ID "
//        . "WHERE djel.ODJEL = '".$division['SIFRA']."' AND ODSJEK IS NULL ".$where."; ";
//        $divisionPeople = mysqli_query($con, $query); 
//        while($row =  mysqli_fetch_assoc($divisionPeople)){
//
//            
//            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
//            $counter++;
//            $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//            $pdf->Cell(56, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
//            $pdf->Cell(60, 5, $row["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
//            $pdf->Cell(60, 5, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
//            $pdf->Cell(36, 5, $row["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
//            $pdf->Cell(11, 5, $row["SAS"], 'RT', 0, 'C', 0, 0, 1);
//            $pdf->Cell(18, 5, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
//            $pdf->Cell(18, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
//            $pdf->Ln(5);
//        }
        
        
        
        $query = "SELECT * FROM odsjeci WHERE SIFRA LIKE '".$division['SIFRA']."%' ORDER BY SIFRA ASC ";
        $sectionList = mysqli_query($con, $query);
        while($section = mysqli_fetch_assoc($sectionList)){
            $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.odsjek LIKE '".$section['SIFRA']."%') ".$where." ";
            $checkNulls = mysqli_query($con, $query);
            $checkNulls = mysqli_fetch_assoc($checkNulls);
//            if($checkNulls['kaunt']!=='0'){
                $counterByClinic += $checkNulls['kaunt'];
                $counterByClinicSistem += $section['SISTEMATIZACIJA'];
            $fill = $pdf->SetFillColor(250, 250, 250);
            $pdf->Cell(10, 5, '', 'LR', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(110, 5, $section['NAZIV'], 'LRB', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Cell(30, 5, $section['SISTEMATIZACIJA'], 'LRB', 0, 'C', $fill, 0, 0, 1);
            $pdf->Cell(60, 5, $checkNulls['kaunt'], 'LRB', 0, 'C', $fill, 0, 0, 1);
        $pdf->Ln(5);
            $fill = $pdf->SetFillColor(0, 0, 0);

            
            
            
            
            
            
            
            
//             $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
//            . "FROM djel "
//            . "LEFT JOIN nomtit "
//            . "ON djel.TITULA = nomtit.ID "
//            . "LEFT JOIN nomzan "
//            . "ON djel.ZAN = nomzan.ID "
//            . "LEFT JOIN nomrm "
//            . "ON djel.RM = nomrm.ID "
//            . "LEFT join nomskspr "
//            . "ON djel.SKSPR = nomskspr.ID "
//            . "LEFT JOIN nomss "
//            . "ON djel.SS = nomss.ID "
//            . "WHERE djel.odsjek = '".$section['SIFRA']."' ".$where."; ";
//            $sectionPeople = mysqli_query($con, $query);   
//                while($row =  mysqli_fetch_assoc($sectionPeople)){
//                $fill = $pdf->SetFillColor(160, 160, 160);
//                $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
//                $counter++;
//                $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//                $pdf->Cell(56, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
//                $pdf->Cell(60, 5, $row["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
//                $pdf->Cell(60, 5, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
//                $pdf->Cell(36, 5, $row["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
//                $pdf->Cell(11, 5, $row["SAS"], 'RT', 0, 'C', 0, 0, 1);
//                $pdf->Cell(18, 5, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
//                $pdf->Cell(18, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
//                $pdf->Ln(5);
//            }
//        }
        }
//    }
    }
//        }
    $counterAllSistem += $counterByClinicSistem;
    $counterAll += $counterByClinic;
                $pdf->Cell(10, 5, '', 'LRB', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(110, 5, 'UKUPNO', 'LRB', 0, 'C', 0, 0, 0, 1);
//            $pdf->Cell(30, 5, $counterByClinicSistem, 'LRB', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(60, 5, $counterByClinic, 'LRB', 0, 'C', 0, 0, 0, 1);
//            $pdf->Cell(40, 5, '', 'LRB', 0, 'C', 0, 0, 0, 1);
            $pdf->Ln(5);
}
            $pdf->Cell(10, 5, '', 'LRB', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(110, 5, 'UKUPNO PO SVIM KLINIKAMA', 'LRB', 0, 'C', 0, 0, 0, 1);
//            $pdf->Cell(30, 5, $counterAllSistem, 'LRB', 0, 'C', 0, 0, 0, 1);
            $pdf->Cell(60, 5, $counterAll, 'LRB', 0, 'C', 0, 0, 0, 1);
//            $pdf->Cell(40, 5, '', 'LRB', 0, 'C', 0, 0, 0, 1);
            $pdf->Ln(10);
            
//            $pdf->Cell(175, 5, '** DJELATNICE ZA SERVIRANJE HRANE BOLESNICIMA – SERVIRKE NISU PLANIRANE NA POJEDINIM ORGANIZACIONIM ');
//            $pdf->Ln(5);
//            $pdf->Cell(175, 5, ' JEDINICAMA VEĆ SU OBJEDINJENE U SLUŽBI ZA PREHRANU!  (47 servirki). ');
//            $pdf->Ln(10);
//            $pdf->Cell(175, 5, '** SPREMAČICE SU OBJEDINJENE U SERVIS ZA ODRŽAVANJE HIGIJENE ODAKLE ĆE IH PRETPOSTAVLJENI U ');
//            $pdf->Ln(5);
//            $pdf->Cell(175, 5, ' DOGOVORU S GLAVNOM SESTROM BOLNICE I GLAVNIM SESTRAMA ORGANIZACIONIH JEDINICA, RASPOREĐIVATI NA ');
//            $pdf->Ln(5);
//            $pdf->Cell(175, 5, ' RAD PREMA POTREBI! (165 spremačica). ');
//            $pdf->Ln(10);
//            $pdf->Cell(175, 5, '* DJELATNICI KOJI NISU RASPOREĐENI PO KLINIČKIM ODJELIMA, ODSJECIMA VEĆ SU ISKLJUČIVO PREDVIĐENI ');
//            $pdf->Ln(5);
//            $pdf->Cell(175, 5, 'ZA KLINIKE/ODJELE/ZAVODE/SLUŽBE.');
//            * DJELATNICE ZA SERVIRANJE HRANE BOLESNICIMA – SERVIRKE NISU PLANIRANE NA POJEDINIM ORGANIZACIONIM JEDINICAMA VEĆ SU OBJEDINJENE U SLUŽBI ZA PREHRANU!  (47 servirki)
//
//*SPREMAČICE SU OBJEDINJENE U SERVIS ZA ODRŽAVANJE HIGIJENE ODAKLE ĆE IH PRETPOSTAVLJENI U DOGOVORU S GLAVNOM SESTROM BOLNICE I GLAVNIM SESTRAMA ORGANIZACIONIH JEDINICA, RASPOREĐIVATI NA RAD PREMA POTREBI! (165 spremačica)

$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');