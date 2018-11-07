<?php
include("mysql.ini");

session_start();
$uid=$_SESSION['number'];

include("mysql.ini");

$query = "select permission from user where uid='$uid'";
$result = mysqli_query($mylink,$query);
list($p) = mysqli_fetch_row($result);

if($p!=2)
header ('Location:login.html');

/*-----------------------------*/

$query = "select * from product";
$result = mysqli_query($mylink,$query);
$nums = mysqli_num_rows($result);

?>

<!DOCTYPE html>

<html lang="zh-Hant-TW">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Product inquiry system</title>
	
<link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
</head>

<body>

<h1 class="text-center text-primary">後臺管理平台</h1>

<h3 class="text-center">商品目錄</h3>

<form method="post" action="update_product.php" class="container pb-4" >

	<table class="table table-bordered table-hover">
	
	<thead class="table-dark text-center">
	<tr class="text-center">
		<th width='150'>商品名稱</th>
		<th width='150'>單價</th>
	</tr>
	</thead>
	
	<?php
	for($i=0;$i<$nums;$i++){
	
		list($pid,$pname,$price) = mysqli_fetch_row($result);
		echo 
		"<tr class='text-center'>
			<td><input type='text' name=p_name$pid value='$pname' class='text-center'></td>
			<td><input type='text' name=p_price$pid value='$price' class='text-center'></td>
		</tr>";
	}?>
	
	</table>
	
	<div class="text-center">
	<button type="submit" class="btn btn-primary mx-auto">確認修改</button>
	<a href="login.html" class="btn btn-primary mx-auto">回到登入頁</a>
	</div>	
</form>




<script src="bootstrap4/js/bootstrap.min.js"></script>
</body>

</html>