<?php 
$token='hello';
$time=$_GET['time'];
$nonce=$_GET['nonce'];
$str=$_GET['str'];

$arr=array($token,$nonce,$str);
sort($arr,SORT_STRING);//排序  SORT_STRING数据默认为字符串
$signature=implode($arr,'');//将数组转化成字符串
$signature=sha1($signature);//sha1加密

if(time()-$time>20){
	$data=['errorCode'=>'1001','errorMsg'=>'超时，访问失败'];
	echo json_encode($data);
}else if($str==$signature){
	$pdo=new pdo('mysql:host=127.0.0.1;dbname=iwebshop;charset=utf8','root','root');
	$sql="select name,sell_price,market_price from iwebshop_goods";
	$data=$pdo->query($sql)->fetchAll();
	echo json_encode($data);
}else{
	$data=['errorCode'=>'1002','errorMsg'=>'签名验证失败'];
	echo json_encode($data);
}

 ?>