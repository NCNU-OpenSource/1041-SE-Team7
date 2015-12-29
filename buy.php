<?php
    include"isset.php";

    $nextfarm=$_GET['nextfarm'];
    $id=$_SESSION['uID'];
    
              /*檢查玩家金錢足夠與否*/
    $sql0 = "select money from player where pname='$id'";
    $result0=mysqli_query($conn,$sql0);
    $r=mysqli_fetch_array($result0);
    
    
    $sql1 = "select costmoney from farm where farmID='$nextfarm'";
    $results=mysqli_query($conn,$sql1);
    if ($rs=mysqli_fetch_array($results)) {
        if($r['money']<$rs['costmoney']){
            echo"金錢不足，無法購買";
            header("refresh:2.5;url=1.php");
            exit();
        }
        else{
            $sql = "insert into farmplayer (ID, farmID, pname, cID , htime) values 
                    ('', '$nextfarm','$id','','');";
            mysqli_query($conn,$sql) or die("MySQL insert message error"); //執行SQL
            $sql3 = "update player set money=money-".$rs['costmoney']." where pname='$id'";
            mysqli_query($conn,$sql3);
        }
    }
 header("Location:1.php");
?>