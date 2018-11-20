<?php 
$pdo=new PDO("mysql:host=127.0.0.1;dbname=11yue","root","root");
$sql="select * from test";
$data=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre/>';
// print_r($data);die;
foreach ($data as $key => $value) {
	$name=$value['name'];
	$age=$value['age'];
	$res[]="['$name',$age]";
}
$s1=join($res,',');
// echo '<pre/>';
// print_r($s1);
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- 图表容器 DOM -->
    <div id="container" style="width: 600px;height:400px;"></div>
    <!-- 引入 highcharts.js -->
    <script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
    <script>
        // 图表配置
        var options = {
            chart: {
                type: 'spline'                          //指定图表的类型，默认是折线图（line）
            },
            title: {
                text: '信息表'                 // 标题
            },
            
            series: [                             // 数据列
               {data:[<?php echo $s1;?>]},
               // {data:[<?php echo $var; ?>]}
            ]
        };
        // 图表初始化函数
        var chart = Highcharts.chart('container', options);
    </script>
</body>
</html>
