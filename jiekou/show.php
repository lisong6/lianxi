<?php 
$token='hello';
$time=time();
$nonce=rand(1,9999);

$arr=array($token,$time,$nonce);//构成数组
sort($arr,SORT_STRING);//排序  SORT_STRING数据默认为字符串
$str=implode($arr);//将数组转化成字符串
$str=sha1($str);//sha1加密

$url="http://127.0.0.1/lianxi/jiekou/getGoods.php?time=$time&nonce=$nonce&str=$str";
$str=file_get_contents($url);//接口数据
$data=json_encode($str,true);//转化成php数组

echo "<pre>";
print_r($data);
 ?>