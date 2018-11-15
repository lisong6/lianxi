<?php 
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("lianxi.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row number and column letter referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
// Increment the highest column letter
$highestColumn++;

for ($row = 2; $row <= $highestRow; ++$row) {
    for ($col = 'A'; $col != $highestColumn; ++$col) {
             $data[$row][]=$worksheet->getCell($col . $row)->getValue();
    }
}

// echo '<pre/>';
// print_r($data);die;

foreach ($data as $key => $value) {
	$name=$value[1];
	$sex=$value[2];
	$age=$value[3];

	$pdo=new PDO("mysql:host=127.0.0.1;dbname=11yue","root","root");
	$sql="insert into test (name,sex,age) values('$name','$sex','$age')";
	$pdo->exec($sql);
}
 ?>