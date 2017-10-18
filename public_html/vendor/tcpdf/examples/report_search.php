<?php
//$where = "AND DPRO IS NOT NULL";
//$where = "AND djel.ID IS NOT NULL"; // kad ubaci checkbox imat cemo druge stvari
//include('report_functions.php');
if(isset($_GET['zapnozap'])){
    $where = " AND djel.ID IS NOT NULL";
//    print_r($where);
}else{
    $where = "AND DPRO IS NULL";
//    print_r($where);
}
if(isset($_GET['invalid'])){
    $where .= " AND INVALID = 1";
}
if(isset($_GET['brd'])){
    $brd = $_GET['brd'];
    $where .= " AND BRD = ".$brd." ";
}
if(isset($_GET['ime'])){
    $ime = $_GET['ime'];
    $where .= " AND IME LIKE '".$ime."%' ";
}
if(isset($_GET['prezime'])){
    $prezime = $_GET['prezime'];
    $where .= " AND PREZIME LIKE '".$prezime."%' ";
}
if(isset($_GET['mjestor'])){
    $mjestor = $_GET['mjestor'];
    $where .= " AND MJESTOR = ".$mjestor." ";
}
if(isset($_GET['mjestob'])){
    $mjestob = $_GET['mjestob'];
    $where .= " AND MJESTOB = ".$mjestob." ";
}
if(isset($_GET['ss'])){
    $ss = $_GET['ss'];
    $where .= " AND SS = ".$ss." ";
}
if(isset($_GET['skspr'])){
    $skspr = $_GET['skspr'];
    $where .= " AND SKSPR = ".$skspr." ";
}
if(isset($_GET['rm'])){
    $rm = $_GET['rm'];
    $where .= " AND RM = ".$rm." ";
}
if(isset($_GET['klinike'])){
    $klinika = $_GET['klinike'];
    $where .= " AND KLINIKA LIKE '".$klinika."%' ";
}
if(isset($_GET['odjeli'])){
    $odjel = $_GET['odjeli'];
    $where .= " AND ODJEL LIKE '".$odjel."%' "; //like before.. :)
}
if(isset($_GET['odsjeci'])){
    $odsjek = $_GET['odsjeci'];
    $where .= " AND ODSJEK LIKE '".$odsjek."%' ";
}
if(isset($_GET['statusi'])){
    $status = $_GET['statusi'];
    $where .= " AND STATUS LIKE '".$status."%' ";
//     print_r($where);
}
if(isset($_GET['titula'])){
    $titula = $_GET['titula'];
    $where .= " AND TITULA = ".$titula." ";
}
if(isset($_GET['vrsta'])){
    $vrsta = $_GET['vrsta'];
    $where .= " AND VRSTA = ".$vrsta." "; // vrsta je varchar.. should be integer...
}
if(isset($_GET['specijalizacija'])){
    $specijalizacija = $_GET['specijalizacija'];
    $where .= " AND (SPEC1 = ".$specijalizacija." OR SPEC2 = ".$specijalizacija." OR SPEC3 = ".$specijalizacija.") ";
}
if(isset($_GET['subspecijalizacija'])){
    $subspecijalizacija = $_GET['subspecijalizacija'];
    $where .= " AND (SUBSPEC1 = ".$subspecijalizacija." OR SUBSPEC2 = ".$subspecijalizacija." OR SUBSPEC3 = ".$subspecijalizacija.") ";
}
if(isset($_GET['odDzro']) AND isset($_GET['doDzro'])){
    $od = $_GET['odDzro'];
//    print_r($od);
    $od = mysql2date($od);    
    $do = $_GET['doDzro'];
    $do = mysql2date($do);
    $where .= " AND (DZRO BETWEEN '".$od."' AND '".$do."') ";
    
}
if(isset($_GET['odDpro']) AND isset($_GET['doDpro'])){
    $od = $_GET['odDpro'];
    $od = mysql2date($od);
    $do = $_GET['doDpro'];
    $do = mysql2date($do);
    $where .= " AND (DPRO BETWEEN '".$od."' AND '".$do."') ";
//    print_r($where);
}
if(isset($_GET['oddtmr']) AND isset($_GET['dodtmr'])){
    $od = $_GET['oddtmr'];
    $od = mysql2date($od);
    $do = $_GET['dodtmr'];
    $do = mysql2date($do);
    $where .= " AND (DATUMR BETWEEN '".$od."' AND '".$do."') ";
}
if(isset($_GET['spol'])){
    $spol = $_GET['spol'];
    $where .= " AND SPOL = ".$spol." ";
}
if(isset($_GET['nac'])){
    $nac = $_GET['nac'];
    $where .= " AND NAC = ".$nac." ";
}

function date2mysql($date){
    return date("d.m.Y",strtotime($date));
}
function mysql2date($date){
     return date("Y-m-d",strtotime($date));
}
function rs($dzro, $dpro, $sstazdani, $sstazmj, $sstazgod){
//        if(!empty($row["DPRO"])){
            if($dpro!=NULL){
            $date1 = new DateTime(date("Y-m-d",strtotime($dzro)));
            $date2 = new DateTime(date("Y-m-d", strtotime($dpro)));
            $diff = $date1->diff($date2);
        }else{
            $date1 = new DateTime(date("Y-m-d",strtotime($dzro)));
            $date2 = new DateTime(date("Y-m-d"));
            $diff = $date1->diff($date2);
        }
                //sadasnji
        $sadstazdani=$diff->d;
        $sadstazmj=$diff->m;
        $sadstazgod=$diff->y;

        
        $ustazdani = $sstazdani + $sadstazdani;
        $ustazmj = $sstazmj + $sadstazmj;
        $ustazgod = $sstazgod + $sadstazgod;

        
        if($ustazdani === 60){
            $ustazdani = 30;
            $ustazmj++;
        }
        if($ustazdani > 60){
            $ustazdani= fmod($ustazdani, 60);
            $ustazmj = $ustazmj + 2;
        }
        if($ustazdani > 30){
            $ustazdani = fmod($ustazdani, 30);
            $ustazmj++;
        }        
        if($ustazmj === 24){
            $ustazmj = 12;
            $ustazgod++;
        }
        if($ustazmj > 24){
            $ustazmj = fmod($ustazmj, 24);
            $ustazgod +=2;
        }
        if($ustazmj > 12){
            $ustazmj = fmod($ustazmj, 12);
            $ustazgod++;
        }
        $arr[0] = $ustazdani;
        $arr[1] = $ustazmj;
        $arr[2] = $ustazgod;
        return $arr;
}