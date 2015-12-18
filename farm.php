<?php
include"isset.php";
$id=$_SESSION['uID'];
   /*GET傳來的值*/
$a=$_POST['crops'];
$b=$_POST['farm'];

            /*檢查玩家金錢足夠與否*/
$sql0 = "select money from player where pname='$id'";
$result0=mysqli_query($conn,$sql0);
$r=mysqli_fetch_array($result0);



$sqla = "select * from crops where cID='$a'";
$results=mysqli_query($conn,$sqla);
$rs=mysqli_fetch_array($results);


if($r['money']<$rs['costmoney']){
    echo"金錢不足，無法購買";
    header("refresh:2.5;url=1.php");
    exit();
}
else{
    $time=date('U');
    $time=$time+25200;
    $sqlb = "update farmplayer set cID='$a' , ptime=$time , htime=$time+".$rs['costtime']." , status=1 where pname=\"   $id\" and farmID=\"$b\"";
    mysqli_query($conn,$sqlb)or die("MySQL query error");
    $sqlc = "update player set exp=exp+".$rs['pexp']." , energy=energy-".$rs['pcostenergy']."
            , money=money-".$rs['costmoney']." where pname=\"$id\" ";
    mysqli_query($conn,$sqlc)or die(mysqli_error($conn));


                        /*等級提升*/
    $levelup = "select  level , exp from player where pname='$id'";
    $result=mysqli_query($conn,$levelup);
    if($rowlv=mysqli_fetch_array($result)){
        if($rowlv['exp']>=100*$rowlv['level']){
            $sqllvup = "update player set level=level+1 , exp=exp".-100*$rowlv['level']." where pname='$id'";
            mysqli_query($conn,$sqllvup);
        }
    }
}
 header("Location:1.php");
?>