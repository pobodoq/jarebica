<?php
error_reporting(E_ALL);
//$where = "AND DPRO IS NOT NULL";
//$where = "AND djel.ID IS NOT NULL"; // kad ubaci checkbox imat cemo druge stvari
//include('report_functions.php');
$where='';
//if(isset($_GET['zapnozap'])){
//    $where = " AND djel.ID IS NOT NULL";
////    print_r($where);
//}else{
//    $where = "AND DPRO IS NULL";
////    print_r($where);
//}
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
    $ime = $_GET['prezime'];
    $where .= " AND PREZIME LIKE '".$ime."%' ";
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
if(isset($_GET['ssrm'])){
    $ssrm = $_GET['ssrm'];
    $where .= " AND SSRM = ".$ssrm." ";
}
if(isset($_GET['skspr'])){
    $skspr = $_GET['skspr'];
    $where .= " AND SKSPR = ".$skspr." ";
}
if(isset($_GET['rm'])){
    $rm = $_GET['rm'];
    $where .= " AND RM = ".$rm." ";
}
if(isset($_GET['zan'])){
    $zan = $_GET['zan'];
    $where .= " AND ZAN = ".$zan." ";
}
if(isset($_GET['klinika'])){
    $klinika = $_GET['klinika'];
    $where .= " AND KLINIKA LIKE '".$klinika."%' ";
}
if(isset($_GET['odjel'])){
    $odjel = $_GET['odjel'];
    $where .= " AND ODJEL LIKE '".$odjel."%' "; //like before.. :)
}
if(isset($_GET['odsjek'])){
    $odsjek = $_GET['odsjek'];
    $where .= " AND ODSJEK LIKE '".$odsjek."%' ";
}
if(isset($_GET['status'])){
    $status = $_GET['status'];
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
if(isset($_GET['uposleniDo'])){
    $uposleniDo = $_GET['uposleniDo'];
    $where .= " AND ((STATUS LIKE '0101%' AND DZRO <= '".$uposleniDo."') OR (DZRO <= '".$uposleniDo."' AND DPRO >= '".$uposleniDo."')) ";
//    $where .= " AND ((STATUS LIKE '01%' AND DZRO < '".Listppl::datetomysql($val)."') OR (DZRO < '".Listppl::datetomysql($val)."' AND DPRO > '".Listppl::datetomysql($val)."')) ";

//    (STATUS LIKE '0101%' AND DZRO <= '2016-12-31') OR (DZRO <= '2016-12-31' AND DPRO > '2016-12-31'
}
if(isset($_GET['oddzro']) AND isset($_GET['dodzro'])){
    $od = $_GET['oddzro'];
    $od = mysql2date($od);
    $do = $_GET['dodzro'];
    $do = mysql2date($do);
    $where .= " AND DZRO BETWEEN '".$od."' AND '".$do."' ";
//    $where .= " AND ((DZRO BETWEEN '".$od."' AND '".$do."') OR ((DZRO BETWEEN '".$od."' AND '".$do."') AND (DPRO BETWEEN '".$do."' AND NOW()))) ";
//    echo $where;
}
if(isset($_GET['oddpro']) AND isset($_GET['dodpro'])){
    $od = $_GET['oddpro'];
    $od = mysql2date($od);
    $do = $_GET['dodpro'];
    $do = mysql2date($do);
    $where .= " AND DPRO BETWEEN '".$od."' AND '".$do."' ";
//    print_r($where);
}
if(isset($_GET['oddatumr']) AND isset($_GET['dodatumr'])){
    $od = $_GET['oddatumr'];
    $od = mysql2date($od);
    $do = $_GET['dodatumr'];
    $do = mysql2date($do);
    $where .= " AND (DATUMR BETWEEN '".$od."' AND '".$do."') ";
}
//if(isset($_GET['odgodst']) AND isset($_GET['dogodst'])){
//    $odgodst = $_GET['odgodst'];
//    $dogodst = $_GET['dogodst'];
//    $odgodst = $val*365;
//    $dogodst = ($val+1)*365-1;
//    $where .= " AND (DATEDIFF(NOW(), DATUMR) >= ".$odgodst." ";
////    $where .= " AND (DATUMR BETWEEN '".$od."' AND '".$do."') ";
//
if(isset($_GET['odgodst'])){
    $odgodst = $_GET['odgodst'];
    $odgodst = $odgodst*365;
    $where .= " AND (DATEDIFF(NOW(), DATUMR) >= ".$odgodst." ";
}
if(isset($_GET['dogodst'])){
    $dogodst = $_GET['dogodst'];
    $dogodst = ($dogodst+1)*365-1; // ako tražim do 25 godina, onda trazim sve do dana kad puni 26... stoga tražim sve do 26 - jedan dan....
    $where .= " AND DATEDIFF(NOW(), DATUMR) <= ".$dogodst.") ";
}
if(isset($_GET['spol'])){
    $spol = $_GET['spol'];
    $where .= " AND SPOL = ".$spol." ";
}
if(isset($_GET['nac'])){
    $nac = $_GET['nac'];
    $where .= " AND NAC = ".$nac." ";
}
if(isset($_GET['staz'])){
    $staz = $_GET['staz'];
    $staz = $staz*365;
    $where .= " AND ((DPRO IS NOT NULL AND (DATEDIFF(DPRO, DZRO)+sstazgod*365+sstazmj*30+sstazdani)>= ".$staz.") OR (DPRO IS NULL AND (DATEDIFF(NOW(), DZRO)+sstazgod*365+sstazmj*30+sstazdani)>=".$staz.")) ";
//print_r($where);
}
//echo $where;
if(isset($_GET['stazdate'])){
    $stazdate = $_GET['stazdate'];
    $stazdate = mysql2date($stazdate);
    $where .= " AND (DATEDIFF('".$stazdate."', DZRO)+sstazgod*365+sstazmj*30+sstazdani) >= 39*365 ";
//    echo $where;
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

        
//                if($ustazdani >= 61){
//            $ustazdani = fmod($ustazdani,60);
//            $ustazmj+2;
//                if($ustazdani >= 31){
//            $ustazdani = fmod($ustazdani,30);
//            $ustazmj++;            
//        if($ustazmj >= 24){
//            $ustazmj = fmod($ustazmj, 24);
//            $ustazgod+2;
//        }
//        if($ustazmj >= 12){
//            $ustazmj = fmod($ustazmj, 12);
//            $ustazgod++;
//        }
            
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
//        if($ustazmj === 24){
//            $ustazmj = 12;
//            $ustazgod++;
//        }
        if($ustazmj >= 24){
            $ustazmj = fmod($ustazmj, 24);
            $ustazgod +=2;
        }
        if($ustazmj >= 12){
            $ustazmj = fmod($ustazmj, 12);
            $ustazgod++;
        }
        $arr[0] = $ustazdani;
        $arr[1] = $ustazmj;
        $arr[2] = $ustazgod;
        return $arr;
}