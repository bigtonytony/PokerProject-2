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

$count=1;

foreach($_REQUEST as $key=>$value)
{
	//echo $key."<br>".$value."<br>";
		
	if($value&&$count%2==1){

		//update product name
		$tempkey=substr($key,6,strlen($key));
		$query = "update product set pname='$value' where pid='$tempkey'";
		mysqli_query($mylink,$query);
		
	}
	
	else if($value&&$count%2==0){
	
		//update product price
		$tempkey=substr($key,7,strlen($key));
		$query = "update product set price='$value' where pid='$tempkey'";
		mysqli_query($mylink,$query);
		
	}
	
	$count++;
}

echo "<script>alert('修改成功！'); location.href = 'admin.php';</script>";

?>