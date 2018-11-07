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


foreach($_REQUEST as $key=>$value){
	
		$tempkey=substr($key,5,strlen($key));
		$query = "delete from inquiry_list where listid='$tempkey'";
		$result = mysqli_query($mylink,$query);

}
	
echo "<script>alert('刪除成功！'); location.href = 'RFQ_record.php';</script>";

?>