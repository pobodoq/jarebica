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
$title = 'Sveučilišna klinička bolnica Mostar';

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

$pdf->SetFont('dejavusans', '', 8);

include('db.php');
include_once('report_searchs.php');

$date = new DateTime(date("Y-m-d"));
$pdf->SetHeaderData($logo, $logoWidth, $title);
$pdf->AddPage('L', 'A4');

$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
//            $fill = $pdf->SetFillColor(200, 200, 200);     
$pdf->Ln(5);
$pdf->Cell(8, 5, 'R.B.', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(63, 5, 'Ime i prezime', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(77, 5, 'Radno mjesto', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(28, 5, 'Stručna sprema', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(33, 5, 'Datum zasnivanja', 'LR', 0, 'C', $fill, 0, 0, 1);  
$pdf->Cell(58, 5, 'Vrsta ugovora ', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Ln(5);
$pdf->Cell(8, 5, '', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(63, 5, '', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(77, 5, '', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(28, 5, 'radnog mjesta', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Cell(33, 5, ' radnog odnosa', 'LR', 0, 'C', $fill, 0, 0, 1);  
$pdf->Cell(58, 5, '(određeno/neodređeno)', 'LR', 0, 'C', $fill, 0, 0, 1);
$pdf->Ln(5);
    
$query = "SELECT * FROM klinike";
$clinicList = mysqli_query($con, $query);
$counter=0;
//$fill = $pdf->SetFillColor(160, 160, 160);
    
while($clinic = mysqli_fetch_assoc($clinicList)){
    $query = "SELECT COUNT(*) as kaunt FROM djel WHERE (djel.klinika LIKE '".$clinic['SIFRA']."%' OR djel.odjel LIKE '".$clinic['SIFRA']."%' OR djel.odsjek LIKE '".$clinic['SIFRA']."%') ".$where." ";
    $checkNulls = mysqli_query($con, $query);
    $checkNulls = mysqli_fetch_assoc($checkNulls);
    if($checkNulls['kaunt']!=='0'){        
        $fill = $pdf->SetFillColor(160, 160, 160);
        $pdf->Cell(267, 5, $clinic['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
        $pdf->Ln(5);
        $query = "SELECT *, nomtit.IDe as TITL, nomrm.NAZIV as RAM, nomstatusi.NAZIV as STAT, nomss.NAZIV as SSRMJ "
                . "FROM djel "
                . "LEFT JOIN nomtit "
                . "ON djel.TITULA = nomtit.ID "
                . "LEFT JOIN nomrm "
                . "ON djel.RM = nomrm.ID "
                . "LEFT JOIN nomstatusi "
                . "ON djel.STATUS = nomstatusi.SIFRA "
                . "LEFT JOIN nomss "
                . "ON djel.SS = nomss.ID "
                . "WHERE djel.klinika LIKE '%".$clinic['SIFRA']."%' AND ODJEL IS NULL ".$where." "
                . "ORDER BY nomrm.INDEX ";
        $clinicPeople = mysqli_query($con, $query);        
        while($row =  mysqli_fetch_assoc($clinicPeople)){
            $counter++;
            $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
            $pdf->Cell(63, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(77, 5, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(28, 5, $row["SSRMJ"], 'RT', 0, 'C', 0, 0, 1);
            $pdf->Cell(33, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
            if(substr($row["STATUS"], 0, 4)==='0102'){
                $pdf->Cell(58, 5, "Određeno radno vrijeme", 'RT', 0, 'C', 0, 0, 1);
            }else if(substr($row["STATUS"], 0, 4)==='0101'){
                $pdf->Cell(58, 5, "Neodređeno radno vrijeme", 'RT', 0, 'C', 0, 0, 1);
            }else{            
                $pdf->Cell(58, 5, $row["STAT"], 'RT', 0, 'C', 0, 0, 1);
            }
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
                $query = "SELECT *, nomtit.IDe as TITL, nomrm.NAZIV as RAM, nomstatusi.NAZIV as STAT, nomss.NAZIV as SSRMJ "
                        . "FROM djel "
                        . "LEFT JOIN nomtit "
                        . "ON djel.TITULA = nomtit.ID "
                        . "LEFT JOIN nomrm "
                        . "ON djel.RM = nomrm.ID "
                        . "LEFT JOIN nomstatusi "
                        . "ON djel.STATUS = nomstatusi.SIFRA "
                        . "LEFT JOIN nomss "
                        . "ON djel.SS = nomss.ID "
                        . "WHERE djel.ODJEL LIKE '%".$division['SIFRA']."%' AND djel.ODSJEK IS NULL ".$where." "
                        . "ORDER BY nomrm.INDEX ";
                $divisionPeople = mysqli_query($con, $query); 
                while($row =  mysqli_fetch_assoc($divisionPeople)){
                    $counter++;
                    $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(63, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(77, 5, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(28, 5, $row["SSRMJ"], 'RT', 0, 'C', 0, 0, 1);
                    $pdf->Cell(33, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
                    if(substr($row["STATUS"], 0, 4)==='0102'){
                        $pdf->Cell(58, 5, "Određeno radno vrijeme", 'RT', 0, 'C', 0, 0, 1);
                    }else if(substr($row["STATUS"], 0, 4)==='0101'){
                        $pdf->Cell(58, 5, "Neodređeno radno vrijeme", 'RT', 0, 'C', 0, 0, 1);
                    }else{            
                        $pdf->Cell(58, 5, $row["STAT"], 'RT', 0, 'C', 0, 0, 1);
                    }
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
                        $query = "SELECT *, nomtit.IDe as TITL, nomrm.NAZIV as RAM, nomstatusi.NAZIV as STAT, nomss.NAZIV as SSRMJ "
                                . "FROM djel "
                                . "LEFT JOIN nomtit "
                                . "ON djel.TITULA = nomtit.ID "
                                . "LEFT JOIN nomrm "
                                . "ON djel.RM = nomrm.ID "
                                . "LEFT JOIN nomstatusi "
                                . "ON djel.STATUS = nomstatusi.SIFRA "
                                . "LEFT JOIN nomss "
                                . "ON djel.SS = nomss.ID "
                                . "WHERE djel.ODSJEK LIKE '%".$section['SIFRA']."%' ".$where." "
                                . "ORDER BY nomrm.INDEX ";
                        $sectionPeople = mysqli_query($con, $query);   
                        while($row =  mysqli_fetch_assoc($sectionPeople)){
                            $fill = $pdf->SetFillColor(160, 160, 160);
                            $counter++;
                            $pdf->Cell(8, 5, $counter, 'LRT', 0, 'C', 0, 0, 1);
                            $pdf->Cell(63, 5, $row["TITL"] . ' ' . $row["IME"] . ' ' . $row["PREZIME"], 'RT', 0, 'C', 0, 0, 1);
                            $pdf->Cell(77, 5, $row["RAM"], 'RT', 0, 'C', 0, 0, 1);
                            $pdf->Cell(28, 5, $row["SSRMJ"], 'RT', 0, 'C', 0, 0, 1);
                            $pdf->Cell(33, 5, date2mysql($row["DZRO"]), 'RT', 0, 'C', 0, 0, 1);
                            if(substr($row["STATUS"], 0, 4)==='0102'){
                                $pdf->Cell(58, 5, "Određeno radno vrijeme", 'RT', 0, 'C', 0, 0, 1);
                            }else if(substr($row["STATUS"], 0, 4)==='0101'){
                                $pdf->Cell(58, 5, "Neodređeno radno vrijeme", 'RT', 0, 'C', 0, 0, 1);
                            }else{            
                                $pdf->Cell(58, 5, $row["STAT"], 'RT', 0, 'C', 0, 0, 1);
                            }
                            $pdf->Ln(5);
                        }
                    }
                }
            }
        }
    }
}
$pdf->lastPage();
$pdf->Output('ljudski_Resursi.pdf', 'I');