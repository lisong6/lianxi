<?php 
$pdo=new PDO('mysql:host=localhost;dbname=test','root','root');
$sql="select * from goods";
$data=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $key => $value) {
	$starttime=time();
	$endtime=$value['endtime'];
	$remaintime=$endtime-$starttime;
	$hour=floor($remaintime/3600);
	$minute=floor(($remaintime-$hour*3600)/60);
	$second=$remaintime-$hour*3600-$minute*60;

	$data[$key]['hour']=$hour;
	$data[$key]['minute']=$minute;
	$data[$key]['second']=$second;
}
echo json_encode($data);
 ?>