<?php
    include"isset.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>update</title>
<style type="text/css">
</style>
</head>
<body>
<?php
    $nextfarm=$_GET['nextfarm'];
    $id=$_SESSION['uID'];
    $sql1 = "select costmoney from farm where farmID='$nextfarm'";
    $results=mysqli_query($conn,$sql1);
    if ($rs=mysqli_fetch_array($results)) {
        $costmoney=$rs['costmoney'];
        $sql = "insert into farmplayer (ID, farmID, pname, cID , ptime , htime) values 
               ('', '$nextfarm','$id','0','','');";
        mysqli_query($conn,$sql) or die("MySQL insert message error"); //執行SQL
        $sql3 = "update player set money=money-".$rs['costmoney']." where pname='$id'";
        mysqli_query($conn,$sql3);
    }
 header("Location:1.php");
?>
</body>
</html>
