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
$pdf->SetFont('dejavusans', '', 11);

include('db.php');
include_once('report_searchs.php');



    
if(isset($_GET['klinika'])){
    $query = "SELECT * FROM klinike WHERE SIFRA LIKE '".$_GET["klinika"]."%';";
//    print_r($query);
}else{
    $query = "SELECT * FROM klinike";
}
$clinicList = mysqli_query($con, $query);
$suma=0;

//$fill = $pdf->SetFillColor(160, 160, 160);
    
while($clinic = mysqli_fetch_assoc($clinicList)){
    $counter=0;
//        $query = "SELECT ID FROM djel WHERE djel.klinika LIKE '".$clinic['SIFRA']."%' AND djel.odjel LIKE '".$clinic['SIFRA']."%' AND djel.ODSJEK LIKE '".$clinic['SIFRA']."%' ".$where."";
        $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.klinika LIKE '".$clinic['SIFRA']."%' OR djel.odjel LIKE '".$clinic['SIFRA']."%' OR djel.odsjek LIKE '".$clinic['SIFRA']."%') ".$where." ";
        $checkNulls = mysqli_query($con, $query);
        $checkNulls = mysqli_fetch_assoc($checkNulls);
//        while($fuckme = mysqli_fetch_assoc($checkNulls)){echo $fuckme['kaunt']; echo '<br/>';}
        if($checkNulls['kaunt']!=='0'){    
            $date = new DateTime(date("Y-m-d"));
            $pdf->SetHeaderData($logo, $logoWidth);
            $pdf->AddPage('P', 'A4');

            $pdf->setCellPaddings(0, 0, 0, 0);
            $pdf->setCellMargins(0, 0, 0, 0);
            $fill = $pdf->SetFillColor(160, 160, 160);     
            
//            $pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C');
//            $pdf->Cell(56, 5, 'DJELATNIK', 'LR', 0, 'C');
//            $pdf->Cell(60, 5, 'ZANIMANJE', 'LR', 0, 'C');
//            $pdf->Cell(60, 5, 'RADNO MJESTO', 'LR', 0, 'C');
//            $pdf->Cell(36, 5, 'ŠKOLSKA SPREMA', 'LR', 0, 'C');
//            $pdf->Cell(11, 5, 'SS', 'LR', 0, 'C', 0, 0, 1);
//            $pdf->Cell(18, 5, 'DATUMR', 'LR', 0, 'C', 0, 0, 1);
//            $pdf->Cell(18, 5, 'DZRO', 'LR', 0, 'C', 0, 0, 1);  
//            $pdf->Ln(5);
//            $pdf->Cell(267, 5, $clinic['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Ln(5);
            
            $query = "SELECT *, nomtit.IDe as TITL "
                    . "FROM djel "
                    . "LEFT JOIN nomtit "
                    . "ON djel.TITULA = nomtit.ID "
                    . "WHERE djel.ID IS NOT NULL ".$where." ";
//                    . "WHERE djel.klinika LIKE '%".$clinic['SIFRA']."%' ";
//    $query = "SELECT IME, PREZIME, DZRO, DPRO, SSTAZDANI, SSTAZMJ, SSTAZGOD, DATUMR, nomtit.Ide as TITL, nomzan.NAZIV as ZANIMANJE, nomrm.NAZIV as RAM, nomskspr.NAZIV as SKASPR, nomss.NAZIV as SAS "
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
//        . "WHERE djel.klinika LIKE '%".$clinic['SIFRA']."%' AND ODJEL IS NULL ".$where." ORDER BY nomrm.INDEX ";
    $clinicPeople = mysqli_query($con, $query);        

    while($row =  mysqli_fetch_assoc($clinicPeople)){
        
//        $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
//        $counter++;
//        $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
//        $pdf->Ln(10);  
        $pdf->Cell(180, 6, 'Broj: _______________ ', '', 0, '', 0, 0, 1);
        $pdf->Ln(5);  
        $pdf->Cell(180, 6, 'Mostar, 30.06.2016. godine', '', 0, '', 0, 0, 1);
        $pdf->Ln(25);  
        $pdf->Cell(180, 6, $row["TITL"] . ' ' .$row["IME"] . ' ' . $row["PREZIME"], '', 0, '', 0, 0, 1);
        $pdf->Ln(5);
        $pdf->Cell(180, 6, $clinic['NAZIV'], '', 0, '', 0, 0, 1);
        $pdf->Ln(25);  
        $pdf->SetFont('dejavusans', 'B', 11);
        $pdf->Cell(180, 6, 'Predmet: Obavijest o vraćanju radne knjižice, ', '', 0, '', 0, 0, 1);
        $pdf->Ln(5);  
        $pdf->Cell(20, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(160, 6, '-dostavlja se. ', '', 0, '', 0, 0, 1);
        $pdf->Ln(20);  
        $pdf->SetFont('dejavusans', '', 11);
        $pdf->Cell(20, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(160, 6, ' Izvješćujemo Vas da sukladno članku 176. Zakona o radu ("Službene novine  ', '', 0, '', 0, 0, 1);
        $pdf->Ln(5);  
        $pdf->Cell(180, 6, 'Federacije BiH", broj: 26/16), odredbe čl. 163.-165., koje su se odnosile na radnu knjižicu, ', '', 0, '', 0, 0, 1);
        $pdf->Ln(5);  
        $pdf->Cell(180, 6, 'prestaju važiti zaključno sa  danom 30.06.2016. godine. ', '', 0, '', 0, 0, 1);
        $pdf->Ln(10);  
        $pdf->Cell(20, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(160, 6, 'Poslodavci su dužni radniku vratiti radnu knjižicu, najkasnije u roku od dva mjeseca od ', '', '', 0, '', 0, 0, 1);
        $pdf->Ln(5);  
        $pdf->Cell(180, 6, 'prestanka važenja istih, odnosno do 31.08.2016. godine. ', '', 0, '', 0, 0, 1);
        $pdf->Ln(10);  
        $pdf->Cell(20, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(40, 6, 'Slijedom navedenog, ', '', 0, '', 0, 0, 1);
        $pdf->SetFont('dejavusans', 'B', 11);
        $pdf->Cell(120, 6, 'molimo Vas da se najkasnije do 31.08.2016. godine javite u , ', '', 0, '', 0, 0, 1);
        $pdf->Ln(5); 
        $pdf->Cell(180, 6, 'Službu za kadrovske poslove SKB Mostar kako bi preuzeli svoju radnu knjižicu. ', '', 0, '', 0, 0, 1);
        $pdf->Ln(25);  
        $pdf->SetFont('dejavusans', '', 11);
        $pdf->Cell(20, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(160, 6, 'S poštovanjem,  ', '', 0, '', 0, 0, 1);
        $pdf->Ln(20);  
        $pdf->Cell(120, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(60, 6, 'V.r.ravnatelj SKB Mostar  ', '', 0, '', 0, 0, 1);
        $pdf->Ln(10);  
        $pdf->Cell(110, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(70, 6, 'prof.dr.sc. Ante Kvesić, dr.med.  ', '', 0, 'C', 0, 0, 1);
        $pdf->Ln(25);  
        $pdf->Cell(180, 6, 'Dostaviti:  ', '', 0, '', 0, 0, 1);
        $pdf->Ln(15);  
        $pdf->Cell(20, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(160, 6, ' - Imenovanom radniku  ', '', 0, '', 0, 0, 1);
        $pdf->Ln(5);  
        $pdf->Cell(20, 6, '', '', 0, '', 0, 0, 1);
        $pdf->Cell(160, 6, ' - Službi za kadrovske poslove (dosje br. '.$row["BRD"].')  ', '', 0, '', 0, 0, 1);
        
//        $pdf->Cell(60, 5, $row["ZANIMANJE"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(60, 5, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(36, 5, $row["SKASPR"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(11, 5, $row["SAS"], 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(18, 5, date2mysql($row["DATUMR"]), 'RT', 0, 'C', 0, 0, 1);
//        $pdf->Cell(18, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
        $pdf->Ln(25);  
        $pdf->lastPage();
//        $pdf->resetHeaderTemplate();
    }

//    $query = "SELECT * FROM odjeli WHERE SIFRA LIKE '".$clinic['SIFRA']."%' ";
//    $divisionList = mysqli_query($con, $query);
//    while($division = mysqli_fetch_assoc($divisionList)){
//        
//        $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.odjel LIKE '".$division['SIFRA']."%' OR djel.odsjek LIKE '".$division['SIFRA']."%') ".$where." ";
//        $checkNulls = mysqli_query($con, $query);
//        $checkNulls = mysqli_fetch_assoc($checkNulls);
//        if($checkNulls['kaunt']!=='0'){
//            
//        $fill = $pdf->SetFillColor(200, 200, 200);
//        $pdf->Cell(267, 5, $division['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//        $pdf->Ln(5);
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
//        . "WHERE djel.ODJEL = '".$division['SIFRA']."' AND ODSJEK IS NULL ".$where." ORDER BY nomrm.INDEX ";
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
//        $query = "SELECT * FROM odsjeci WHERE SIFRA LIKE '".$division['SIFRA']."%' ";
//        $sectionList = mysqli_query($con, $query);
//        while($section = mysqli_fetch_assoc($sectionList)){
//            $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.odsjek LIKE '".$section['SIFRA']."%') ".$where." ";
//            $checkNulls = mysqli_query($con, $query);
//            $checkNulls = mysqli_fetch_assoc($checkNulls);
//            if($checkNulls['kaunt']!=='0'){
//            $fill = $pdf->SetFillColor(250, 250, 250);
//                    $pdf->Cell(267, 5, $section['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//        $pdf->Ln(5);
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
//            . "WHERE djel.odsjek = '".$section['SIFRA']."' ".$where." ORDER BY nomrm.INDEX ";
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
//        }
//    }
//    }
        }
    $pdf->lastPage();
    $pdf->resetHeaderTemplate();
}
//$pdf->lastPage();
$pdf->Output('example_005.pdf', 'I');