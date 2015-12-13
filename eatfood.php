<?php
    include"isset.php";
    $id=$_SESSION['uID'];
?>
<?php
$a=$_GET['fID'];

             /*食物-1*/
$sqla = "update foodplayer set quantum=quantum-1 where fID=$a and pname='$id'";
mysqli_query($conn,$sqla);

             /*能量增加*/
$sql = "select * from food where fID=$a";
$result=mysqli_query($conn,$sql);
$rs=mysqli_fetch_array($result);
$sqla = "update player set energy=energy+".$rs['energyup']." where pname='$id'";
mysqli_query($conn,$sqla);
header("Location:1.php");
?>