<?php 
$pdo=new PDO('mysql:host=localhost;dbname=test','root','root');
$sql="select * from goods";
$data=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
 ?>
 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
 	<?php foreach ($data as $key => $value): ?>
 		<div style="float:left">
 			<p>
 				<span id="h<?php echo $value['id']; ?>"></span>时
 				<span id="m<?php echo $value['id']; ?>"></span>分
 				<span id="s<?php echo $value['id']; ?>"></span>秒
 			</p>
 			<p><img src="<?php echo $value['photo']; ?>" width='250' height='200' alt=""></p>
 			<p><?php echo $value['name']; ?></p>
 			<p><?php echo $value['price']; ?></p>
 			<p><input type="button" value="抢购" id="<?php echo $value['id']; ?>"></p>
 		</div>
 	<?php endforeach ?>
 </body>
 </html>
 <script src='jquery.js'></script>
 <script>
	 $(document).ready(function(){
	 	window.setInterval(function(){
	 		$.ajax({
	 			url:'2.php',
	 			type:'get',
	 			dataType:'json',
	 			success:function(data){
	 				// console.log(data)
	 				for (var i = 0; i < data.length; i++) {
	 					id=data[i]['id'];
	 					$('#h'+id).text(data[i]['hour']);
						$('#m'+id).text(data[i]['minute']);
						$('#s'+id).text(data[i]['second']);
	 				};
	 			}
	 		})
	 	},1000)

		 $("input[type=button]").click(function(){
		 	var id=$(this).attr('id');
		 	$.ajax({
		 		url:'3.php',
	 			type:'get',
	 			dataType:'json',
	 			data:{id:'id'},
	 			success:function(data){
	 				if(data['code']==1){
						alert(data['msg']);
	 				}else{
	 					alert(data['msg']);
	 				}
	 			}
		 	})
		 })
	 })
 </script>