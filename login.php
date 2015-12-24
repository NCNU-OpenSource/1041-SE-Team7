<?php
include"isset.php";
$_SESSION['uID'] = "";
$account = isset($_POST["user_name"]) ? $_POST["user_name"] : $_GET["user_name"];
$passWord = isset($_POST["user_password"]) ? $_POST["user_password"] : $_GET["user_password"];
$sql = "SELECT * FROM player WHERE account='" . $account . "' AND password= '" . $passWord . "'";
mysqli_query($conn,$sql) or die("Query Fail! ".mysqli_error($conn));

if ($result = mysqli_query($conn,$sql)) {
        if ($row=mysqli_fetch_array($result)) {
            $_SESSION['uID'] = $row['pname'];
            $id=$_SESSION['uID'];
            echo 'success';
        }
        else {
            echo "Invalid Username or Password - Please try again <br />";
        }
    }
?>
