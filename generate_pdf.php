<?php
//include connection file 
include_once("connection.php");
include_once("libs/fpdf.php");
//set_charset("utf8");
class myPDF extends FPDF
{
// Page header
function header()
{
    // Logo
    //$this->Image('logo.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'รายการอุปกรณ์',1,0,'C');
    // Line break
    $this->Ln(20);
}
function HeaderTable()
{
    // Logo
    //$this->Image('logo.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Item List',1,0,'C');
    // Line break
    $this->Ln();
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->HeaderTable();
//$db = new dbObj();
//$connString =  $db->getConnstring();
//$display_heading = array('itemID'=>'ItemID', 'device_name'=> 'ItemName', 'device_detail'=> 'Category','device_qrcode'=> 'QRcode','device_image'=> 'Image','status'=> 'status');
//
//$result = mysqli_query($connString, "SELECT itemID, device_name,device_detail,device_qrcode,device_image,status FROM device") or die("database error:". mysqli_error($connString));
//$header = mysqli_query($connString, "SHOW columns FROM device");
//
////$row = mysqli_fetch_array($result);
//$pdf = new PDF();
////header
//$pdf->AddPage();
////foter page
//$pdf->AliasNbPages();
//$pdf->SetFont('Arial','B',12);
//foreach($header as $heading) {
//$pdf->Cell(30,12,$display_heading[$heading['Field']],1);
//}
//foreach($result as $row) {
//$pdf->Ln();
//    $pdf->Cell(30,12,$row['itemId'],1);
////foreach($row as $column)
////$pdf->Cell(30,12,$column,1);
////}
//$pdf->Output();
?>