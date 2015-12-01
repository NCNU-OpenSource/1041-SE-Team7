<?php
    include"isset.php";
    
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
<?php
    $id=$_SESSION['uID'];
    echo"<div id=\"top\">";
    echo"親愛的".$id."，您好！<a href=\"logout.php\" STYLE=\"text-decoration:none\">登出</a>";
    echo"</div>";
?>
</br></br></br></br></br></br></br>
<h1 style="text-align:center;">Happy Farm</h1>
<div id="rr" align="center">
<?php
$a=$_POST['crops'];
$b=$_POST['farm'];
//資料庫要改 金錢 然後再1.php要倒數計時
//玩家種植或採收都會損失體力與金錢 
//每次種植或採收會賺取經驗值 
//不同作物有不同的成熟時間，成熟後可以採收賣掉換成錢

$sql = "select  money , pcostenergy , costtime , crops.costmoney , pexp from player , crops , farm where player.pname=\"$id\" and cID=\"$a\" and farmID=\"$b\"";
$results=mysqli_query($conn,$sql);

while (	$rs=mysqli_fetch_array($results)) {
    echo "<input type=\"radio\" name=\"crops\" id=\"crops\"value=\"";
    echo $rs["cID"] ;
    echo"\"></input>";
    echo $rs["cname"];
}


?>
</div>
</body>
</html>