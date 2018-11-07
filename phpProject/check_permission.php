<?php

session_start();

include("mysql.ini");

$user=$_REQUEST["username"];
$pwd=$_REQUEST["password"];

$query = "select uid,permission from user where uname='$user' AND password='$pwd'";

$result = mysqli_query($mylink,$query);

$nums = mysqli_num_rows($result);

if($nums==0){
	echo "<script>alert('帳號或密碼錯誤！即將轉回首頁...'); location.href = 'login.html';</script>";
}

else{
	list($id,$p) = mysqli_fetch_row($result);
	
	$_SESSION['number']=$id;
	
	if($p==1)
		header ('Location:user.php');
	else if($p==2)
		header ('Location:admin.php');
	exit;
}
	
mysqli_free_result($result);
mysqli_close($mylink);

?>