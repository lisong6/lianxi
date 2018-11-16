<?php 
// header("content-type:text/html;charset=utf8");
$city=$_GET['city'];
$redis=new redis;
$redis->connect('127.0.0.1',6379);

if($redis->exists($city)){
	$str=$redis->get($city);
	// echo "缓存内的";
	echo $str;
}else{
	$key='eaaf6456592c49d59286ffdc1a29db9e';
	$url="https://free-api.heweather.com/s6/weather/forecast?location=$city&key=$key";

	$str=curl_get($url);
	// echo $str;
	$data=json_decode($str,true);
	$data=$data['HeWeather6'][0]['daily_forecast'];
	// echo '<pre/>';
	// print_r($data);die;

	$pdo=new PDO("mysql:host=127.0.0.1;dbname=11yue","root","root");
	foreach ($data as $key => $value) {
		$date=$value['date'];
		$tmp_max=$value['tmp_max'];
		$tmp_min=$value['tmp_min'];
		$sql="insert into weater(city,date,tmp_max,tmp_min) values('$city','$date','$tmp_max','$tmp_min')";
		$pdo->exec($sql);
	}

	$str=json_encode($data);
	$redis->set($city,$str);
	// echo "首次放入";
	echo $str;
}



function curl_get($url){
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$str=curl_exec($ch);
	curl_close($ch);
	return $str;
}


 ?>