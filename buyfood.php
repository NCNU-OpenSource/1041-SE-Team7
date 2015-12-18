<?php
    include"isset.php";
    $id=$_SESSION['uID'];
?>
<?php
$a=$_GET['fID'];
$sqla = "select * from food where fID=$a";
$results=mysqli_query($conn,$sqla);
$rs1=mysqli_fetch_array($results);
$sqlaa = "select * from foodplayer where fID=$a and pname='$id'";
$resultss=mysqli_query($conn,$sqlaa);

            /*檢查玩家金錢足夠與否*/
$sql0 = "select money from player where pname='$id'";
$result0=mysqli_query($conn,$sql0);
$r=mysqli_fetch_array($result0);

if($r['money']<$rs1['costmoney']){
    echo"金錢不足，無法購買";
    header("refresh:2.5;url=1.php");
    exit();
}
else{

    if(!$resultss || mysqli_num_rows($resultss)==0){    //沒有買過就insert
        $sql = "insert into foodplayer (pname , fID , quantum) values ('$id' ,'$a' ,'1');";
        mysqli_query($conn,$sql)or die(mysqli_error($conn));
                /*扣錢*/
        $sql = "update player set money=money-".$rs1['costmoney'].";";
        mysqli_query($conn,$sql)or die(mysqli_error($conn));
    }
    else{ //如果有買過update
        $sql = "update foodplayer set quantum=quantum+1 where pname=\"$id\" and fID=\"$a\"";
        mysqli_query($conn,$sql)or die(mysqli_error($conn));
                /*扣錢*/
        $sql = "update player set money=money-".$rs1['costmoney'].";";
        mysqli_query($conn,$sql)or die(mysqli_error($conn));
    }
}

header("Location:1.php");
?>