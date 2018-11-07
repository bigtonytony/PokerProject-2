<?php
session_start();
$uid=$_SESSION['number'];

include("mysql.ini");

$query = "select permission from user where uid='$uid'";
$result = mysqli_query($mylink,$query);
list($p) = mysqli_fetch_row($result);

if($p!=1)
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

	<title>詢價專區</title>

<link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
</head>

<body>

<h1 class="text-center text-primary">商品目錄</h1>

<form method="post" action="RFQ.php" class="container">

	<table class="table table-bordered table-hover">
	<thead class="table-dark text-center">
	<tr>
		<th>商品名稱</th>
		<th>單價</th>
		<th>數量</th>
	</tr>
	</thead>
	
	<?php
	for($i=0;$i<$nums;$i++){
	
		list($pid,$pname,$price) = mysqli_fetch_row($result);
		echo 
		"<tr class='text-center'>
			<td>$pname</td>
			<td>$price 元</td>
			<td><input type='number' class='text-center' min='0' name='pro$pid' ></td>
		</tr>";
	}?>
	
	</table>
	
	<div class="text-center">
	<button type="submit" class="btn btn-primary mx-auto">建立詢價單</button>

	<button type="submit" formaction="RFQ_record.php" class="btn btn-primary mx-auto">查詢RFQ紀錄</button><br>
	</div>
	
</form>

<script src="bootstrap4/js/bootstrap.min.js"></script>
</body>

</html>

<?php
mysqli_free_result($result);
mysqli_close($mylink);
?>
