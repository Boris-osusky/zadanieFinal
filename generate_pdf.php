<?php
ob_end_clean();
require_once('vendor/autoload.php');

$html = $_GET['html'];

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->writeHTML($html);
$pdf->Output('guide.pdf', 'D');
?>