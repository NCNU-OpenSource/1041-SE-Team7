<?php
include"isset.php";
$_SESSION['uID'] = "";
$account = $_POST['id'];
$passWord = $_POST['pwd'];
$sql = "SELECT * FROM player WHERE account='" . $account . "' AND password= '" . $passWord . "'";
mysqli_query($conn,$sql) or die("Query Fail! ".mysqli_error($conn));
//mysqli_select_db($conn, $db); //¿ï¾Ü¸ê®Æ®w

    if ($result = mysqli_query($conn,$sql)) {
        if ($row=mysqli_fetch_array($result)) {
            $_SESSION['uID'] = $row['pname'];
            $id=$_SESSION['uID'];
            header("Refresh:0; url=1.php");
            exit(0);
        }
        else {
            echo "Invalid Username or Password - Please try again <br />";
            header("Refresh:2.5; url=index.php");
        }
    }
?>
