<?php
session_start();
$host = 'localhost';
$user = 'myid';
$pass = '12345';
$db = 'happyfarm';
$conn = mysqli_connect($host, $user, $pass,$db) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
mysqli_query($conn,"SET NAMES utf8"); //選擇編碼
//mysql_select_db($db, $conn); //選擇資料庫
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<!--新增User-->
<p>Register</p>
<hr />
<p>
<?php
$acc=mysqli_real_escape_string($conn,$_POST['acc']);
$pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
$pname=mysqli_real_escape_string($conn,$_POST['pname']);

if ($pname) {
	//insert into DB
    $sql = "insert into player (account, password, pname) values ('$acc', '$pwd', '$pname');";
    mysqli_query($conn,$sql) or die("MySQL insert message error"); //執行SQL
    $sql1 = "insert into farmplayer (farmID, pname) values (1 , '$pname');";
    $sql2 = "insert into farmplayer (farmID, pname) values (2 , '$pname');";
    mysqli_query($conn,$sql1) or die("MySQL insert message error");
    mysqli_query($conn,$sql2) or die("MySQL insert message error");
    echo "player registered.";
} else {
	echo "empty id, cannot insert.";
}
header("Refresh:3;url=index.php");//
?>
</p>
</body>
</html>
