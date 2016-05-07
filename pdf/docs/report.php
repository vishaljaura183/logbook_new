<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2010-11-20
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
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


require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
require_once('../../functions.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
$id = $_GET['id'];
$data = getReportData($id);
//print_r($data); die;
}
else{
echo "Invalid Id!! Please contact Admin.";

}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('', '0','LogBook', '');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();



// create some HTML content
// create some HTML content
// create some HTML content
$html = '
<table border="0" cellpadding="2">
	<tr>
		<th>
			<table cellpadding="4">
				<tr>
					<td colspan = "2" bgcolor="silver">Learner Information</td>
				</tr>
				<tr>
					<td>Name:</td>
					<td>'.$data["username"].'</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>'.$data["user_email"].'</td>
				</tr>
				<tr>
					<td>Licence Number:</td>
					<td>'.$data["learnersLicenseNumber"].'</td>
				</tr>
				<tr>
					<td>Learner Photo:</td>
					<td><img src="'.$data["learnerPhoto"].'" alt="addPermitPhoto" width="95" height="80"/></td>
				</tr>
			</table>
		</th>
		<th>
			<table cellpadding="4">
				<tr>
					<td colspan = "2"  bgcolor="silver">Supervisor Information</td>
				</tr>
				<tr>
					<td>Supervisor Name:</td>
					<td>'.$data["supervisor_name"].'</td>
				</tr>
				
				<tr>
					<td>Supervisor Image:</td>
					<td><img src="'.$data["addPermitPhoto"].'" alt="addPermitPhoto" width="95" height="80"/></td>
					
				</tr>
			</table>
		</th>
	</tr>
	<tr>
		<td colspan = "2">
			<table cellpadding="4">
				<tr>
					<td colspan = "2"  bgcolor="silver">Learner Report Details</td>
				</tr>
				
				<tr>
					<td>Vehicle:</td>
					<td>'.$data["vehicle"].'</td>
				</tr>
				<tr>
					<td>Distance Recorded:</td>
					<td>'.$data["distanceRecorded"].'</td>
				</tr>
				<tr>
					<td>Driving Mode:</td>
					<td>'.$data["drivingMode"].'</td>
				</tr>
				<tr>
					<td>Duration Of Trip:</td>
					<td>'.$data["durationOfTrip"].'</td>
				</tr>
				<tr>
					<td>Percentage Completed:</td>
					<td>'.$data["percentageCompleted"].'%</td>
				</tr>
				<tr>
					<td>End Journey Reason:</td>
					<td>'.$data["endJourneyReason"].'</td>
				</tr>
				<tr>
					<td>Start Image Taken At:</td>
					<td>'.$data["startImageTakenAt"].'</td>
				</tr>
				<tr>
					<td>End Image Taken At:</td>
					<td>'.$data["endImageTakenAt"].'</td>
				</tr>
				<tr>
					<td>Ending Time:</td>
					<td>'.$data["endingTime"].'</td>
				</tr>
				<tr>
					<td>Initial Time:</td>
					<td>'.$data["initialTime"].'</td>
				</tr>
				<tr>
					<td>Weather:</td>
					<td>'.$data["weather"].'</td>
				</tr>
				<tr>
					<td>Start Trip Odometer Image:<br/>
					<img src="'.$data["startTripOdometerImage"].'" alt="StartOdometerImage" width="300" height="200"/>
					</td>
					<td>End Trip Odometer Image:<br/>
					<img src="'.$data["endTripOdometerImage"].'" alt="endTripOdometerImage" width="300" height="200"/>
					</td>
				</tr>
				
				
			</table>
		</td>	
	</tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();


//Close and output PDF document
$pdf->Output('learner_report.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
