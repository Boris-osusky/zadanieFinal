<?php
ob_end_clean();
require_once('../../zadanie3/vendor/autoload.php');

// Set UTF-8 encoding
header('Content-Type: text/html; charset=UTF-8');
header('Content-Encoding: UTF-8');

$html = $_GET['html'];

// Create TCPDF object with UTF-8 support
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Guide');
$pdf->SetSubject('Guide');
$pdf->SetKeywords('Guide, PDF, example');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('guide.pdf', 'D');
?>
