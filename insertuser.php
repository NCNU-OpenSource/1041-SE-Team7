<?php
session_start();
$host = 'localhost';
$user = 'myid';
$pass = '12345';
$db = 'happyfarm';
$conn = mysqli_connect($host, $user, $pass,$db) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
mysqli_query($conn,"SET NAMES utf8"); //選擇編碼
//mysql_select_db($db, $conn); //選擇資料庫
$account = isset($_POST["user_name"]) ? $_POST["user_name"] : $_GET["user_name"];
$passWord = isset($_POST["user_password"]) ? $_POST["user_password"] : $_GET["user_password"];
$playername = isset($_POST["user_nickname"]) ? $_POST["user_nickname"] : $_GET["user_nickname"];
$acc=mysqli_real_escape_string($conn,$account);
$pwd=mysqli_real_escape_string($conn,$passWord);
$pname=mysqli_real_escape_string($conn,$playername);

if ($pname) {
	//insert into DB
    $sql = "insert into player (account, password, pname) values ('$acc', '$pwd', '$pname');";
    mysqli_query($conn,$sql) or die("MySQL insert message error"); //執行SQL
    $sql1 = "insert into farmplayer (farmID, pname) values (1 , '$pname');";
    $sql2 = "insert into farmplayer (farmID, pname) values (2 , '$pname');";
    mysqli_query($conn,$sql1) or die("MySQL insert message error");
    mysqli_query($conn,$sql2) or die("MySQL insert message error");
    echo 'success';
} else {
	echo "empty id, cannot insert.";
}
?>
