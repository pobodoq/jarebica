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

include_once('db.php');
include_once('report_searchs.php');
//include_once('report_functions.php');
    $pdf->SetHeaderData($logo, $logoWidth, $title);
    $pdf->AddPage('P', 'A4');

if(isset($_GET['klinika'])){
    $query = "SELECT * FROM klinike WHERE SIFRA LIKE '".$_GET["klinika"]."%';";
//    print_r($query);
}else{
    $query = "SELECT * FROM klinike";
}
$resklinika = mysqli_query($con, $query);
//print_r($query);

//$odjeli = array();
//za svaki odjel nova stranica
$suma=0;
while($rowklinika = mysqli_fetch_assoc($resklinika)){
    $counter=0;
    $date = new DateTime(date("Y-m-d"));
    $pdf->SetHeaderData($logo, $logoWidth, $title, $rowklinika['NAZIV'] . PHP_EOL . date_format($date, 'd.m.Y'));
    $pdf->AddPage('P', 'A4');
    $pdf->SetLineWidth(0.1);
    $pdf->setCellPaddings(0, 0, 0, 0);
    $pdf->setCellMargins(0, 0, 0, 0);
//    $pdf->SetFillColor(255, 255, 127);
    $fill = $pdf->SetFillColor(217, 217, 217);
//    rgb(242, 242, 242)
    
//    $null = NULL;
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// klinika query
    ////////////////////////////////////////////////////////////////////////////
    $query = "SELECT COUNT(*) AS kaunt FROM djel WHERE klinika LIKE '".$rowklinika['SIFRA']."' AND odjel IS NULL ".$where."";
//    print_r($query);

    $result = mysqli_query($con, $query);    
    if(mysqli_num_rows($result)===0){
//        $pdf->deletePage($pdf->PageNo());
    }else{
        
//        $pdf->Cell(35, '', '', 0);
        $pdf->Cell(20, 5, 'R.B.', 'LRB', 0, 'C');
        $pdf->Cell(130, 5, 'ODJEL', 'LRB', 0, 'C');
        $pdf->Cell(30, 5, 'BROJ UPOSLENIH', 'LRB', 0, 'C', 0, 0, 1);
        $pdf->Ln(5);    
    }
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// ispisivanje queryija klinike
    ////////////////////////////////////////////////////////////////////////////
        $klinikakaunt =0;
    while($row =  mysqli_fetch_assoc($result)){
        $klinikakaunt +=$row['kaunt'];
//        if(!empty($row)){
//            $urs = rs($row['DZRO'], $row['DPRO'], $row['SSTAZDANI'], $row['SSTAZMJ'], $row['SSTAZGOD']);
            $counter++;
//            $pdf->Cell(35, '', '', 0);
            $pdf->Cell(20, 5, $counter, 'LR', 0, 'C');
            $pdf->Cell(130, 5, $rowklinika['NAZIV'], 'LR', 0, 'C');
            $pdf->Cell(30, 5, $row['kaunt'], 'LR', 0, 'C');
            $pdf->Ln(5);     
//        }
    }
    $query = "SELECT * FROM odjeli WHERE SIFRA LIKE '".$rowklinika['SIFRA']."%' ";
    $resodjel = mysqli_query($con, $query);
//    print_r($query);
    while($rowodjel = mysqli_fetch_assoc($resodjel)){
//        if($rowklinika['SIFRA']===substr($rowodjel['SIFRA'], 0, 4)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodjel querzy
    ////////////////////////////////////////////////////////////////////////////
        $query = "SELECT COUNT(*) as kaunt FROM djel WHERE odjel LIKE '".$rowodjel['SIFRA']."' AND odsjek IS NULL ".$where." ";

//        }
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result)===0){
        }else{
            
//            $pdf->Cell(163, 5, $rowodjel['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//            $pdf->Ln(5);
        }
        $odjelkaunt = 0;
        while($rowz = mysqli_fetch_assoc($result)){
            if($rowz['kaunt']==='0'){}else{
    //            $urs = rs($rowz['DZRO'], $rowz['DPRO'], $rowz['SSTAZDANI'], $rowz['SSTAZMJ'], $rowz['SSTAZGOD']);

                $counter++;
//                $pdf->Cell(35, '', '', 0);
                $pdf->Cell(20, 5, $counter, 'LR', 0, 'C');
                $pdf->Cell(130, 5, $rowodjel['NAZIV'], 'LR', 0, 'C');
                $pdf->Cell(30, 5, $rowz['kaunt'], 'LR', 0, 'C');
                $pdf->Ln(5); 
                $odjelkaunt +=$rowz['kaunt'];
            }
        }
        $klinikakaunt += $odjelkaunt;
        $query = "SELECT * FROM odsjeci WHERE SIFRA LIKE '".$rowodjel['SIFRA']."%' ";
//        print_r($query);
        $resodsjek = mysqli_query($con, $query);
        while($rowodsjek = mysqli_fetch_assoc($resodsjek)){
//            if($rowodjel['SIFRA']===substr($rowodsjek['SIFRA'], 0, 6)){
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////// rowodsjek query
    ////////////////////////////////////////////////////////////////////////////
            $query = "SELECT COUNT(*) as kaunt FROM djel WHERE odsjek LIKE '".$rowodsjek['SIFRA']."' ".$where." ";
//            }
            $result = mysqli_query($con, $query);  
//                print_r($query);
            if(mysqli_num_rows($result)===0){
            }else{
//                $pdf->Cell(163, 5, $rowodsjek['NAZIV'], 'LR', 0, 'C', $fill, 0, 0, 1);
//                $pdf->Ln(5);
            }
            $odsjekkaunt =0;
            while($rowzy = mysqli_fetch_assoc($result)){    
                if($rowzy['kaunt']==='0'){}else{
                
//                $urs = rs($rowzy['DZRO'], $rowzy['DPRO'], $rowzy['SSTAZDANI'], $rowzy['SSTAZMJ'], $rowzy['SSTAZGOD']);
                    $counter++;
//                    $pdf->Cell(35, '', '', 0);
                    $pdf->Cell(20, 5, $counter, 'LR', 0, 'C');
                    $pdf->Cell(130, 5, $rowodsjek['NAZIV'], 'LR', 0, 'C');
                    $pdf->Cell(30, 5, $rowzy['kaunt'], 'LR', 0, 'C');
                    $pdf->Ln(5);
                    $odsjekkaunt += $rowzy['kaunt'];
                }
            }
            $klinikakaunt +=$odsjekkaunt;
        }
    }       
    $suma +=$counter; 
    $pdf->Cell(150, 5, '', '', 0, 'C', 0, 0, 1);
    $pdf->Cell(30, 5, $klinikakaunt, 'LRTB', 0, 'C', 0, 0, 1);
    
$pdf->lastPage();
$pdf->resetHeaderTemplate();
}
$pdf->Cell(5, 5, $suma, 'LRTB', 0, 'C', 0, 0, 1);
$pdf->Output('example_005.pdf', 'I');