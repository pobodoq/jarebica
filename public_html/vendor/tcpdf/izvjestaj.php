<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
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

// add a page



// add a page
$pdf->AddPage();

// create some HTML content

include('db.php');
$count=0;
$htm;
$query = "SELECT IME, PREZIME, OTAC, JMBG, DATUMR FROM DJEL";
$result = mysqli_query($con, $query);
$rows = array();
       $htm = '<table border="1" cellpadding="1">
        <tr>
            <th width="6%">R.B</th>
            <th>DJELATNIK</th>
            <th width="10%">Ime Oca</th>
            <th>JMBG</th>
            <th>Datum roĐenja</th>
        </tr>';
while($row = mysqli_fetch_assoc($result)){
       $htm .= '<tr>
           <td>'.$count.'</td>
            <td>'.$row["IME"].' '.$row["PREZIME"].'</td>
            <td>'.$row["OTAC"].'</td>
            <td>'.$row["JMBG"].'</td>
            <td>'.$row["DATUMR"].'</td>
        </tr>';
      $count++;
//    $htm .= $row["PREZIME"];
}
$htm .= '</table>';
//$try = '<3rh2>IZVJEŠTAJ</h2>
//       $head = '<table border="1" cellpadding="1" width="750px">
//        <tr>
//            <th width="6%">R.B</th>
//            <th>Djelatnik</th>
//            <th>Ime Oca</th>
//            <th>JMBG</th>
//            <th>Datum roĐenja</th>
//        </tr>';
        
//
//
//$html = '<h2>HTML TABLE:</h2>
//<table border="1" cellspacing="3" cellpadding="4">
//	<tr>
//		<th>#</th>
//		<th align="right">RIGHT align</th>
//		<th align="left">LEFT align</th>
//		<th>4A</th>
//	</tr>
//	<tr>
//		<td>1</td>
//		<td bgcolor="#cccccc" align="center" colspan="2">A1 ex<i>amp</i>le <a href="http://www.tcpdf.org">link</a> column span. One two tree four five six seven eight nine ten.<br />line after br<br /><small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal  bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla<ol><li>first<ol><li>sublist</li><li>sublist</li></ol></li><li>second</li></ol><small color="#FF0000" bgcolor="#FFFF00">small small small small small small small small small small small small small small small small small small small small</small></td>
//		<td>4B</td>
//	</tr>
//	<tr>
//		<td>'.$subtable.'</td>
//		<td bgcolor="#0000FF" color="yellow" align="center">A2 € &euro; &#8364; &amp; è &egrave;<br/>A2 € &euro; &#8364; &amp; è &egrave;</td>
//		<td bgcolor="#FFFF00" align="left"><font color="#FF0000">Red</font> Yellow BG</td>
//		<td>4C</td>
//	</tr>
//	<tr>
//		<td>1A</td>
//		<td rowspan="2" colspan="2" bgcolor="#FFFFCC">2AA<br />2AB<br />2AC</td>
//		<td bgcolor="#FF0000">4D</td>
//	</tr>
//	<tr>
//		<td>1B</td>
//		<td>4E</td>
//	</tr>
//	<tr>
//		<td>1C</td>
//		<td>2C</td>
//		<td>3C</td>
//		<td>4F</td>
//	</tr>
//</table>';

// output the HTML content
$pdf->writeHTML($htm, true, false, true, false, '');

// Print some HTML Cells

//$html = '<span color="red">red</span> <span color="green">green</span> <span color="blue">blue</span><br /><span color="red">red</span> <span color="green">green</span> <span color="blue">blue</span>';
//
//$pdf->SetFillColor(255,255,0);
//
//$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);
//$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 1, true, 'C', true);
//$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);
//
//// reset pointer to the last page
//$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
//$pdf->AddPage();
//
//// create some HTML content
//$html = '<h1>Image alignments on HTML table</h1>
//<table cellpadding="1" cellspacing="1" border="1" style="text-align:center;">
//<tr><td><img src="images/logo_example.png" border="0" height="41" width="41" /></td></tr>
//<tr style="text-align:left;"><td><img src="images/logo_example.png" border="0" height="41" width="41" align="top" /></td></tr>
//<tr style="text-align:center;"><td><img src="images/logo_example.png" border="0" height="41" width="41" align="middle" /></td></tr>
//<tr style="text-align:right;"><td><img src="images/logo_example.png" border="0" height="41" width="41" align="bottom" /></td></tr>
//<tr><td style="text-align:left;"><img src="images/logo_example.png" border="0" height="41" width="41" align="top" /></td></tr>
//<tr><td style="text-align:center;"><img src="images/logo_example.png" border="0" height="41" width="41" align="middle" /></td></tr>
//<tr><td style="text-align:right;"><img src="images/logo_example.png" border="0" height="41" width="41" align="bottom" /></td></tr>
//</table>';
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// reset pointer to the last page
//$pdf->lastPage();
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//// Print all HTML colors
//
//// add a page
//$pdf->AddPage();
//
//$textcolors = '<h1>HTML Text Colors</h1>';
//$bgcolors = '<hr /><h1>HTML Background Colors</h1>';
//
//foreach(TCPDF_COLORS::$webcolor as $k => $v) {
//	$textcolors .= '<span color="#'.$v.'">'.$v.'</span> ';
//	$bgcolors .= '<span bgcolor="#'.$v.'" color="#333333">'.$v.'</span> ';
//}
//
//// output the HTML content
//$pdf->writeHTML($textcolors, true, false, true, false, '');
//$pdf->writeHTML($bgcolors, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// Test word-wrap
//
//// create some HTML content
//$html = '<hr />
//<h1>Various tests</h1>
//<a href="#2">link to page 2</a><br />
//<font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font>';
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// Test fonts nesting
//$html1 = 'Default <font face="courier">Courier <font face="helvetica">Helvetica <font face="times">Times <font face="dejavusans">dejavusans </font>Times </font>Helvetica </font>Courier </font>Default';
//$html2 = '<small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal';
//$html3 = '<font size="10" color="#ff7f50">The</font> <font size="10" color="#6495ed">quick</font> <font size="14" color="#dc143c">brown</font> <font size="18" color="#008000">fox</font> <font size="22"><a href="http://www.tcpdf.org">jumps</a></font> <font size="22" color="#a0522d">over</font> <font size="18" color="#da70d6">the</font> <font size="14" color="#9400d3">lazy</font> <font size="10" color="#4169el">dog</font>.';
//
//$html = $html1.'<br />'.$html2.'<br />'.$html3.'<br />'.$html3.'<br />'.$html2;
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//// test pre tag
//
//// add a page
//$pdf->AddPage();
//
//$html = <<<EOF
//<div style="background-color:#880000;color:white;">
//Hello World!<br />
//Hello
//</div>
//<pre style="background-color:#336699;color:white;">
//int main() {
//    printf("HelloWorld");
//    return 0;
//}
//</pre>
//<tt>Monospace font</tt>, normal font, <tt>monospace font</tt>, normal font.
//<br />
//<div style="background-color:#880000;color:white;">DIV LEVEL 1<div style="background-color:#008800;color:white;">DIV LEVEL 2</div>DIV LEVEL 1</div>
//<br />
//<span style="background-color:#880000;color:white;">SPAN LEVEL 1 <span style="background-color:#008800;color:white;">SPAN LEVEL 2</span> SPAN LEVEL 1</span>
//EOF;
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// test custom bullet points for list
//
//// add a page
//$pdf->AddPage();
//
//$html = <<<EOF
//<h1>Test custom bullet image for list items</h1>
//<ul style="font-size:14pt;list-style-type:img|png|4|4|images/logo_example.png">
//	<li>test custom bullet image</li>
//	<li>test custom bullet image</li>
//	<li>test custom bullet image</li>
//	<li>test custom bullet image</li>
//<ul>
//EOF;
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// reset pointer to the last page
//$pdf->lastPage();
//
//// ---------------------------------------------------------
//
////Close and output PDF document
$pdf->Output('example_006.pdf', 'I');
//
////============================================================+
//// END OF FILE
////============================================================+
