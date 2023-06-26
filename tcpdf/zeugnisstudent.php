<?php

//========================================================================
// Author:  Valéry Jérôme Michaux
// Resume:  http://cafe-lingua.org
//
// Copyright (c) 2017 Valéry Jérôme Michaux
//
// Published under the OpenSource license with restiction : https://github.com/michaux4/SchoolManagementSoftware
//          Consider it as a proof of concept!
//          No warranty of any kind.
//          Use and abuse at your own risks.
//========================================================================

include '../connexion.php';

$query = "SELECT coursename as Fach, average as Punkt, niveau as Note, niveauG as Zusatzinformation
FROM averagetotal 

WHERE student ='" . addslashes($_GET['student']) . "'AND
 semester='" . addslashes($_GET['semester']) . "' AND
 year='" . addslashes($_GET['year']) . "'
 AND classe='" . addslashes($_GET['classe']) . "'
ORDER BY course ASC";

$Noten = mysqli_query($cn, $query);

if (!$Noten) {
	die('Échec de la requête : ' . mysqli_error());
}

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// set font
$pdf->SetFont('freeserif', '', 12);

// add a page
$pdf->AddPage();

// get esternal file content
$utf8text = file_get_contents('../tcpdf/data/utf8test.txt', false);


// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '../tcpdf/lang/ger.php')) {
	require_once(dirname(__FILE__) . '../tcpdf/lang/ger.php');
	$pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$requete = 'SELECT * FROM `school`';
$result = mysqli_query($cn, $requete);
$ecole = mysqli_fetch_array($result);

$pdf->SetFont('freeserif', '', 21);
$pdf->Cell(0, 10, $ecole[0], 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('freeserif', '', 16);
$pdf->Cell(0, 10, $ecole[1], 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('freeserif', '', 12);
$pdf->Cell(0, 10, $ecole[3], 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('freeserif', '', 12);
$pdf->Cell(0, 10, $ecole[2] . $ecole[8], 0, 0, 'C');

$pdf->Ln();
$pdf->SetFont('freeserif', ' ', 12);
$pdf->Cell(30, 10, '__________________________________________________________________________________________', 'C');
$pdf->Ln(15);
// Titre
$pdf->SetFont('freeserif', 'B', 21);
$pdf->Cell(80);
$pdf->Cell(30, 10, 'Zeugnis', 'C');
$pdf->Ln();

$student = mysqli_query($cn, "SELECT name, firstname, birthdate FROM student WHERE code='" . addslashes($_GET['student']) . "'");
$studentligne = mysqli_fetch_array($student);
$studentname = addslashes($studentligne[0]) . " " . addslashes($studentligne[1]);


$pdf->SetFont('freeserif', '', 12);
$pdf->Cell(30, 10, 'für ' . $studentname, 'C');
$pdf->Ln();
$pdf->Cell(30, 10, 'geboren am ' . $studentligne[2], 'C');
$pdf->Cell(50);
$pdf->Cell(30, 10, 'Klass ' . $_GET['classe']);
$pdf->Cell(25);
$pdf->Cell(30, 10, $_GET['semester'] . ' ' . $_GET['year']);
$pdf->Ln();
$pdf->SetFont('freeserif', ' ', 12);
$pdf->Cell(30, 10, '__________________________________________________________________________________________', 'C');
$pdf->Ln(20);

$pdf->SetFont('freeserif', 'B', 9);
while ($field_info = mysqli_fetch_field($Noten)) {
	$pdf->Cell(47, 9, $field_info->name, 1);
}
$pdf->Ln();
$pdf->SetFont('freeserif', '', 9);

$level = mysqli_query($cn, "SELECT glevel from level");
$lignelevel = mysqli_fetch_array($level);


while ($rows = mysqli_fetch_array($Noten)) {
	$pdf->Cell(47, 9, $rows[0], 1);
	$pdf->Cell(47, 9, $rows[1], 1);
	$pdf->Cell(47, 9, $rows[2], 1);

	if ($rows[3] == 0) {
		$pdf->Cell(47, 9, ' ', 1);
	} else {
		$pdf->Cell(47, 9, $lignelevel[0] . '-Note', 1);
	}

	$pdf->Ln();
}
$pdf->Output('Zeugnis ' . $_GET['semester'] . ' ' . $_GET['year'] . '.pdf', 'I');
?>