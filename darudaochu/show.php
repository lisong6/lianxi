<?php 
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', '导出');

$pdo=new PDO("mysql:host=127.0.0.1;dbname=11yue","root","root");
$sql="select * from test";
$arrayData=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$spreadsheet->getActiveSheet()
    ->fromArray(
        $arrayData,  // The data to set
        NULL,        // Array values with this value will not be set
        'B2'         // Top left coordinate of the worksheet range where
                     //    we want to set these values (default is A1)
    );

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');

 ?>