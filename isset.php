<?php
    session_start();
    if(!isset($_SESSION["uID"])){
        header("Refresh:0.1;url=index.php");
    }
    $host = 'localhost';
    $user = 'myid';
    $pass = '12345';
    $db = 'happyfarm';
    $conn = mysqli_connect($host, $user, $pass,$db) or die('Error with MySQL connection'); //跟MyMSQL連線並登入
    mysqli_query($conn,"SET NAMES utf8"); //選擇編碼
    //mysql_select_db($db, $conn); //選擇資料庫
?>