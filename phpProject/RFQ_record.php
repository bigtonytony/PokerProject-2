<?php
include("mysql.ini");
session_start();
$uid=$_SESSION['number'];

include("mysql.ini");

$query = "select permission from user where uid='$uid'";
$result = mysqli_query($mylink,$query);
list($p) = mysqli_fetch_row($result);

if($p!=1)
header ('Location:login.html');

?>

<!DOCTYPE html>

<html lang="zh-Hant-TW">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>RFQ紀錄查詢</title>

<link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
</head>

<body>

<h1 class="text-center text-primary">RFQ紀錄</h1>


<form method="post" action="RFQ_delete.php" class="container pb-4">

<table class="table table-bordered table-hover">

	<thead class="table-dark text-center">
	<tr class="text-center">
		<th>商品名稱</th>
		<th>單價</th>
		<th>數量</th>
		<th>小計</th>
		<th>刪除紀錄</th>
	</tr>
	</thead>

<?php

	$query = "select product.pname, product.price, inquiry_list.num, inquiry_list.listid from product, inquiry_list 
	where inquiry_list.uid = '$uid' AND product.pid = inquiry_list.pid";
	
	$result = mysqli_query($mylink,$query);
	$counts = mysqli_num_rows($result);
	$total=0;
	
for($i=0;$i<$counts;$i++)
{	
	
	list($pname,$price,$number,$listid) = mysqli_fetch_row($result);
		
	$tempprice=$number*$price;
		
		echo 
		"<tr class='text-center'>
			<td>$pname</td>
			<td>$price 元</td>
			<td>$number </td>
			<td>$tempprice 元 </td>
			<td><input type='checkbox' name='list.$listid' style='zoom:180%;'></td>
		</tr>";
		$total=$total+$tempprice;
}

echo 
		"<tr class='table-danger text-center'>
			<td colspan='2'>總金額</td>
			<td colspan='2'>$total 元</td>
			<td><button type='submit' class='btn btn-primary mx-auto'>刪除紀錄</button></td>
		</tr>";

?>

</table>



<div class="text-center">
<a href="user.php" class="btn btn-primary mx-auto">回到詢價專區</a>
<a href="login.html" class="btn btn-primary mx-auto">回到登入頁</a>
</div>

</form>

<script src="bootstrap4/js/bootstrap.min.js"></script>


</body>

</html>


