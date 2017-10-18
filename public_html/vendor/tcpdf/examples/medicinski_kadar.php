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
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('L', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
$pdf->Cell(56, 5, 'Ime i prezime', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(25, 5, 'Datum rođenja', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(25, 5, 'Stručna sprema', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(83, 5, 'Zanimanje', 'LR', 0, 'C', 0, 0, 1);
$pdf->Cell(70, 5, 'Naziv radnog mjesta', 'LR', 0, 'C', 0, 0, 1);
$pdf->Ln(5);
    
if(isset($_GET['klinika'])){
    $query = "SELECT * FROM klinike WHERE SIFRA LIKE '".$_GET["klinika"]."%';";
//    print_r($query);
}else{
    $query = "SELECT * FROM klinike";
}
$clinicList = mysqli_query($con, $query);
$suma=0;
$counter=0;
//$fill = $pdf->SetFillColor(160, 160, 160);
    
while($clinic = mysqli_fetch_assoc($clinicList)){
//        $query = "SELECT ID FROM djel WHERE djel.klinika LIKE '".$clinic['SIFRA']."%' AND djel.odjel LIKE '".$clinic['SIFRA']."%' AND djel.ODSJEK LIKE '".$clinic['SIFRA']."%' ".$where."";
        $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.klinika LIKE '".$clinic['SIFRA']."%' OR djel.odjel LIKE '".$clinic['SIFRA']."%' OR djel.odsjek LIKE '".$clinic['SIFRA']."%') ".$where." ";
        $checkNulls = mysqli_query($con, $query);
        $checkNulls = mysqli_fetch_assoc($checkNulls);
//        while($fuckme = mysqli_fetch_assoc($checkNulls)){echo $fuckme['kaunt']; echo '<br/>';}
        if($checkNulls['kaunt']!=='0'){        
            $fill = $pdf->SetFillColor(160, 160, 160);
            $pdf->Cell(267, 5, $clinic['NAZIV'], 'LR', 0, 'L', $fill, 0, 0, 1);
            $pdf->Ln(5);
            
//            $pdf->Cell(267, 5, $clinic['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Ln(5);
    $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS, specijal1.NAZIV as SPEC1, specijal2.NAZIV as SPEC2, specijal3.NAZIV as SPEC3 "
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
        . "LEFT JOIN specijalizacija specijal1 "
        . "ON djel.spec1 = specijal1.ID "
        . "LEFT JOIN specijalizacija specijal2 "
        . "ON djel.spec2 = specijal2.ID "
        . "LEFT JOIN specijalizacija specijal3 "
        . "ON djel.spec3 = specijal3.ID "
        . "WHERE djel.klinika LIKE '%".$clinic['SIFRA']."%' AND ODJEL IS NULL ".$where." ORDER BY nomrm.INDEX ";
//    echo $query;
    $clinicPeople = mysqli_query($con, $query);        

    while($row =  mysqli_fetch_assoc($clinicPeople)){
        
        $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
        $counter++;
        $pdf->Cell(8, 5, $counter, 'LRT', 0, 'L', 0, 0, 1);
        $pdf->Cell(56, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'L', 0, 0, 1);
        $pdf->Cell(25, 5, date2mysql($row["DATUMR"]), 'RT', 0, 'L', 0, 0, 1);
        $pdf->Cell(25, 5, $row["SAS"], 'RT', 0, 'L', 0, 0, 1);
//        if($row['SPEC2']!==null){
            $pdf->Cell(83, 5, $row['ZANIMANJE'], 'RT', 0, 'L', 0, 0, 1);
//        }else{
//            $pdf->Cell(83, 5, $row["SPEC1"], 'RT', 0, 'L', 0, 0, 1);            
//        }
        $pdf->Cell(70, 5, $row["RAM"], 'RT', 0, 'L', 0, 0, 1);
//        $pdf->Cell(60, 5, $row["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(36, 5, $row["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(18, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);  
    }

    $query = "SELECT * FROM odjeli WHERE SIFRA LIKE '".$clinic['SIFRA']."%' ";
    $divisionList = mysqli_query($con, $query);
    while($division = mysqli_fetch_assoc($divisionList)){
        
        $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.odjel LIKE '".$division['SIFRA']."%' OR djel.odsjek LIKE '".$division['SIFRA']."%') ".$where." ";
        $checkNulls = mysqli_query($con, $query);
        $checkNulls = mysqli_fetch_assoc($checkNulls);
        if($checkNulls['kaunt']!=='0'){
            
        $fill = $pdf->SetFillColor(200, 200, 200);
        $pdf->Cell(267, 5, $division['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
        $pdf->Ln(5);
        $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS, specijal1.NAZIV as SPEC1, specijal2.NAZIV as SPEC2, specijal3.NAZIV as SPEC3  "
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
        . "LEFT JOIN specijalizacija specijal1 "
        . "ON djel.spec1 = specijal1.ID "
        . "LEFT JOIN specijalizacija specijal2 "
        . "ON djel.spec2 = specijal2.ID "
        . "LEFT JOIN specijalizacija specijal3 "
        . "ON djel.spec3 = specijal3.ID "
        . "WHERE djel.ODJEL = '".$division['SIFRA']."' AND ODSJEK IS NULL ".$where." ORDER BY nomrm.INDEX ";
        $divisionPeople = mysqli_query($con, $query); 
        while($row =  mysqli_fetch_assoc($divisionPeople)){

            
            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
            $pdf->Cell(8, 5, $counter, 'LRT', 0, 'L', 0, 0, 1);
            $pdf->Cell(56, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'L', 0, 0, 1);
            $pdf->Cell(25, 5, date2mysql($row["DATUMR"]), 'RT', 0, 'L', 0, 0, 1);
            $pdf->Cell(25, 5, $row["SAS"], 'RT', 0, 'L', 0, 0, 1);     
//        if($row['SPEC2']!==null){
            $pdf->Cell(83, 5, $row['ZANIMANJE'], 'RT', 0, 'L', 0, 0, 1);
//        }else{
//            $pdf->Cell(83, 5, $row["SPEC1"], 'RT', 0, 'L', 0, 0, 1);            
//        }
            $pdf->Cell(70, 5, $row["RAM"], 'RT', 0, 'L', 0, 0, 1);
            $pdf->Ln(5);
        }
        $query = "SELECT * FROM odsjeci WHERE SIFRA LIKE '".$division['SIFRA']."%' ";
        $sectionList = mysqli_query($con, $query);
        while($section = mysqli_fetch_assoc($sectionList)){
            $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.odsjek LIKE '".$section['SIFRA']."%') ".$where." ";
            $checkNulls = mysqli_query($con, $query);
            $checkNulls = mysqli_fetch_assoc($checkNulls);
            if($checkNulls['kaunt']!=='0'){
            $fill = $pdf->SetFillColor(250, 250, 250);
                    $pdf->Cell(267, 5, $section['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
        $pdf->Ln(5);
             $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS,specijal1.NAZIV as SPEC1, specijal2.NAZIV as SPEC2, specijal3.NAZIV as SPEC3  "
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
                             . "LEFT JOIN specijalizacija specijal1 "
        . "ON djel.spec1 = specijal1.ID "
        . "LEFT JOIN specijalizacija specijal2 "
        . "ON djel.spec2 = specijal2.ID "
        . "LEFT JOIN specijalizacija specijal3 "
        . "ON djel.spec3 = specijal3.ID "
            . "WHERE djel.odsjek = '".$section['SIFRA']."' ".$where." ORDER BY nomrm.INDEX ";
            $sectionPeople = mysqli_query($con, $query);   
                while($row =  mysqli_fetch_assoc($sectionPeople)){
                $fill = $pdf->SetFillColor(160, 160, 160);
                $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
                $counter++;
                $pdf->Cell(8, 5, $counter, 'LRT', 0, 'L', 0, 0, 1);
                $pdf->Cell(56, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'L', 0, 0, 1);
                $pdf->Cell(25, 5, date2mysql($row["DATUMR"]), 'RT', 0, 'L', 0, 0, 1);
                $pdf->Cell(25, 5, $row["SAS"], 'RT', 0, 'L', 0, 0, 1);        
//        if($row['SPEC2']!==null){
            $pdf->Cell(83, 5, $row['ZANIMANJE'], 'RT', 0, 'L', 0, 0, 1);
//        }else{
//            $pdf->Cell(83, 5, $row["SPEC1"], 'RT', 0, 'L', 0, 0, 1);            
//        }
                $pdf->Cell(70, 5, $row["RAM"], 'RT', 0, 'L', 0, 0, 1);
                $pdf->Ln(5);
            }
        }
        }
    }
    }
        }
}
$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');