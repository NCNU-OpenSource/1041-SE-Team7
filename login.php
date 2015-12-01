<?php
include"isset.php";
$_SESSION['uID'] = "";
$account = $_POST['id'];
$passWord = $_POST['pwd'];
$sql = "SELECT * FROM player WHERE account='" . $account . "' AND password= '" . $passWord . "'";
mysqli_query($conn,$sql) or die("Query Fail! ".mysqli_error($conn));
//mysqli_select_db($conn, $db); //選擇資料庫

    if ($result = mysqli_query($conn,$sql)) {
        if ($row=mysqli_fetch_array($result)) {
            $_SESSION['uID'] = $row['pname'];
            $id=$_SESSION['uID'];
            header("Refresh:0; url=1.php");
            $sql1= "update `player` set logintime=CURRENT_TIME where pname='".$row['pname']."'";
            mysqli_query($conn,$sql1) or die(mysqli_error($conn)); //執行SQL
            exit(0);
        }
        else {
            echo "Invalid Username or Password - Please try again <br />";
            header("Refresh:2.5; url=index.php");
        }
    }
?>
