<?php 
header("content-type:text/html;charset=utf8");
//接收城市
$city=$_GET['city'];
// echo $city;
$redis=new redis;
$redis->connect('127.0.0.1',6379);
//获取返回值后存入redis
if($redis->exists($city)){
	$str=$redis->get($city);
	echo "come from redis";
}else{
	//	获取接口
	$key="eaaf6456592c49d59286ffdc1a29db9e";
	$url="https://free-api.heweather.com/s6/weather/forecast?location=$city&key=$key";
	
	$str=curl_get($url);
	//获取返回数据
	$data=json_decode($str,true);
	echo "<pre>";
	print_r($data);
	$data=$data['HeWeather6'][0]['daily_forecast'];
	//将日期及温度成功入库
	$pdo=new PDO("mysql:host=127.0.0.1;dbname=11yue","root","root");
	foreach ($data as $key => $value) {
		$date=$value['date'];
		$max=$data['tmp_max'];
		$min=$data['tmp_min'];
	}
	$sql="insert into tianqi (city,date,max,min) values ('$city','$date','$max','$min')";
	$pdo->exec($sql);
}

$res=json_encode($str);
echo "首次";
echo "res";


function curl_get($url){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$str=curl_exec($ch);
	curl_close($ch);
	return $str;
}

 ?>


