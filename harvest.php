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


$sql = "update farmplayer set status=0 , cID=0 , ptime=0 , htime=0 where farmID='$a' and pname='$id'";
mysqli_query($conn,$sql);


$sqlh = "select * from crops where cID='$b'";
$results=mysqli_query($conn,$sqlh);
$rs=mysqli_fetch_array($results);
$sql = "update player set exp=exp+".$rs['hexp']." , energy=energy-".$rs['hcostenergy']." , money=money+".$rs['sellmoney']." where pname='$id'";
mysqli_query($conn,$sql);




                       /*等級提升*/
$levelup = "select  level , exp from player where pname='$id'";
$result=mysqli_query($conn,$levelup);
if($rowlv=mysqli_fetch_array($result)){
    if($rowlv['exp']>=100*$rowlv['level']){
        $sqllvup = "update player set level=level+1 , exp=exp".-100*$rowlv['level']." where pname='$id'";
        mysqli_query($conn,$sqllvup);
   }
}

 header("Location:1.php");
?>
</div>
</body>
</html>