<?php
    include"isset.php";
    $id=$_SESSION['uID'];
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
</script>
<script>
</script>
<style type="text/css">
#top{
    text-align:right;
}
</style>
</head>
<body>
<div id="rr" align="center">
<?php
$a=$_GET['farmID'];
$b=$_GET['cID'];
//資料庫要改 金錢 然後再1.php要倒數計時
//玩家種植或採收都會損失體力與金錢 
//每次種植或採收會賺取經驗值 
//不同作物有不同的成熟時間，成熟後可以採收賣掉換成錢
$sql = "update farmplayer set status=0 , cID=0 , ptime=0 , htime=0 where farmID='$a' and pname='$id'";
mysqli_query($conn,$sql);


$sqlh = "select * from crops where cID='$b'";
$results=mysqli_query($conn,$sqlh);
$rs=mysqli_fetch_array($results);
$sql = "update player set exp=exp+".$rs['hexp']." , energy=energy-".$rs['hcostenergy']." , money=money+".$rs['sellmoney']." where pname='$id'";
mysqli_query($conn,$sql);



/*
$sql = "select  money , pcostenergy , costtime , crops.costmoney , pexp from player , crops , farm where player.pname=\"$id\" and cID=\"$a\" and farmID=\"$b\"";
$results=mysqli_query($conn,$sql);

while (	$rs=mysqli_fetch_array($results)) {
    echo $a,$b;
    
}
*/
// header("Refresh:0; url=1.php");
?>
</div>
</body>
</html>