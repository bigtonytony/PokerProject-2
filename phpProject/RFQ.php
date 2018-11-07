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

/*-----------------------------*/
?>


<!DOCTYPE html>

<html lang="zh-Hant-TW">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Result</title>

<link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
</head>

<body>

<h1 class="text-center text-primary">詢價結果</h1>
<div class="container">

<table class="table table-bordered table-hover">

	<thead class="table-dark text-center">
	<tr>
		<th>商品名稱</th>
		<th>單價</th>
		<th>數量</th>
		<th>小計</th>
	</tr>
	</thead>
	
<?php

$total=0;

foreach($_REQUEST as $key=>$value)
{
	if($value){
		
		$tempkey=substr($key,3,strlen($key));
		$query = "select * from product where pid='$tempkey'";
		$result = mysqli_query($mylink,$query);
		$nums = mysqli_num_rows($result);
		
		list($pid,$pname,$price) = mysqli_fetch_row($result);
		
		$tempprice=$value*$price;
		
		echo 
		"<tr class='text-center'>
			<td>$pname</td>
			<td>$price 元</td>
			<td>$value </td>
			<td>$tempprice 元 </td>
		</tr>";
		$total=$total+$tempprice;
		
		$query2="insert into inquiry_list(pid,num,uid) values ('$tempkey','$value','$uid');";
		mysqli_query($mylink,$query2);
	}
}

echo 
		"<tr class='table-danger text-center'>
			<td colspan='2'>總金額</td>
			<td colspan='2'>$total 元</td>
		</tr>";

?>

</table>

<div class="text-center">
	<a href="user.php" class="btn btn-primary mx-auto">回到詢價專區</a>

	<a href="login.html" class="btn btn-primary mx-auto">回到登入頁</a>
</div>

</div>

<script src="bootstrap4/js/bootstrap.min.js"></script>
</body>

</html>




