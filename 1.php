<?php
include"isset.php";
$id=$_SESSION['uID'];
    
    if(isset($_SESSION['levelup'])){
        $levelup=$_SESSION['levelup'];
        if($_SESSION['levelup']==1){
            ?>
            <script>
                alert("恭喜您升等囉！");
            </script>
            <?php
            $_SESSION['levelup']=0;
        }
    }
                        /*以下都在javascript裡使用*/
$sqla = "select count(farmID) as r from farmplayer  where pname='$id' and status=1";
$resultsta=mysqli_query($conn,$sqla);
$rsa=mysqli_fetch_array($resultsta);
$sqltimer = "select farmID , farmplayer.cID , htime from farmplayer , crops  where pname='$id' and status=1 and farmplayer.cID=crops.cID";
$resultst=mysqli_query($conn,$sqltimer);
while ($rst=mysqli_fetch_array($resultst)) {
    $fid[]=$rst['farmID'];
    $cid[]=$rst['cID'];
    $endtime[]=$rst['htime'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <title>Happy Farm</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"
        src="countdown.min.js">
    </script>
    <script>
    $(document).ready(function(){
        $("input").click(function(){
            $(".a").show();
        });
        $(".bag").click(function(){
            $(".bag_content").toggle();
            $(".KFC_content").hide();
        });
        $(".KFC").click(function(){
            $(".KFC_content").toggle();
            $(".bag_content").hide();
        });
    });
    function start(){
        <?php for($i=1;$i<=$rsa['r'];$i++){?>
        new Countdown({
            selector: '.timer<?php echo $fid[$i-1];?>',
            msgBefore: "",
            msgAfter: "<?php echo "<a href='harvest.php?farmID=".$fid[$i-1]."&cID=".$cid[$i-1]."' ><img src='img/plant".$cid[$i-1].".png'></a>";?>",                   
            msgPattern: "{seconds}",
            dateStart: new Date(),
            dateEnd: new Date('<?php echo date("M d, Y H:i:s",$endtime[$i-1])?>'),
            onStart: function() {
                console.log('start');
            },
            onEnd: function() { 
                console.log('end');
            },
        });
        <?php   };?>
    };
    window.onload=function(){
    start();
    }
    </script>
	<link rel="stylesheet" href="css/1.css">
</head>
<body>
<?php

echo"<div id=\"top\">";
echo"親愛的 ".$id."，您好！<a href=\"logout.php\" STYLE=\"text-decoration:none\">登出</a>";
echo"</div>";
echo"</br></br></br><h1 style=\"text-align:center;\">Happy Farm</h1>";
    
    
                   /*玩家狀態欄*/
$sql1 = "select  * from player  where pname='$id'";
$results=mysqli_query($conn,$sql1);
if($rows=mysqli_fetch_array($results)){
    $process1=($rows['exp']/(100*$rows['level']))*100;
    $process=round($process1);
    echo"<div id=\"column\">",
        "暱稱:".$rows["pname"]."</br>",
        "LV:".$rows["level"]."</br>",
        "能量:".$rows["energy"]."</br>",
        "金錢$:".$rows["money"]."</br>",
        "Exp:".$rows["exp"]."  (需要".(100*$rows['level']-$rows['exp'])."Exp 升級)",
        "<div class=\"progress\">",
            "<div class=\"progress-bar progress-bar-warning progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"$process\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:$process%; min-width:20px;\">",
                "$process%",
            "</div>",
        "</div></div>";
}
?>
<div align="center">
<?php
echo"<div id=\"a\"class=\"a\">",
    "<form method='post' action='farm.php'>",
    "要種甚麼呢?</br>";


                  /*印出可以種植的農作物*/
$sql = "select  level , cID , needlevel from player , crops  where player.pname='$id'";
$results1=mysqli_query($conn,$sql);
while($rs=mysqli_fetch_array($results1)){
    if($rs['level']>=$rs['needlevel']){
        echo "<label><input type=\"radio\" name=\"crops\"  id=\"crops\" checked value=\"";
        echo $rs["cID"] ;
        echo"\"></input>";
        echo "<img src='img/plant".$rs["cID"].".png' id=\"b\"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
}
echo"<button type=\"submit\">確定</button>",
    "</div>";
?>
<?php
                  /*以下為印出田的所有狀態*/
$sql1 = "select * from player  where pname='$id'";
$results2=mysqli_query($conn,$sql1);
if($rs=mysqli_fetch_array($results2)){
    echo"<div id=\"main_land\">";


                       /*農地UI*/
    $sql2 = "select  count(farmID) from farmplayer  where pname='$id'";
    $results3=mysqli_query($conn,$sql2);
    if($rs1=mysqli_fetch_array($results3)){
        $farm=$rs1['count(farmID)'];             
        $nextfarm=$farm+1;
        $sqlfarming = "select farmID , status from farmplayer  where pname='$id'";
        $results4=mysqli_query($conn,$sqlfarming);
        while($rss=mysqli_fetch_array($results4)){
            $a[]=$rss['status'];
            $b[]=$rss['farmID'];
        }


                               /*玩家已解鎖可以自由運用的田*/
        $count=0;
        $check=1;
        for($i=1;$i<=$farm;$i++){
            $count++;
            if($a[$i-1]==$check){        //印出有種東西的田 
                if($count%3==0){
                    echo "<span id=\"upper\" class=\"timer".$b[$i-1]."\"></span>";
                    echo "<img src=\"img/growing.png\"></br>";
                }
                else{
                    echo "<span id=\"upper\" class=\"timer".$b[$i-1]."\"></span>";
                    echo "<img src=\"img/growing.png\">";
                }
            }
            else{                        //印出可以種但沒種東西的田
                if($i%3==0){
                    echo"<label>",
                        "<input name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                        "<img src=\"img/1.jpg\" id=\"b\"></label></br>";
                }
                else{
                    echo"<label>",
                        "<input name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                        "<img src=\"img/1.jpg\" id=\"b\"  ></label>";
                }
            }
        }


                            /*印出可以買的田*/
        $sql3 = "select count(needlevel) from player , farm where pname='$id' and level>=needlevel ";
        $results5=mysqli_query($conn,$sql3);
        $rs2=mysqli_fetch_array($results5);
        $buyfarm=$rs2['count(needlevel)'];  
        $buyfarm=$buyfarm-$farm;
        for($i=1;$i<=$buyfarm;$i++){
            if(($i+($farm%3))%3==0){
                echo"<a href='buy.php?nextfarm=".$nextfarm."' OnClick=\"return confirm('確定要購買嗎？')\";>
                     <img src=\"img/3.gif\"></a></br>";
            }
            else{
                echo"<a href='buy.php?nextfarm=".$nextfarm."' OnClick=\"return confirm('確定要購買嗎？')\";>
                     <img src=\"img/3.gif\"></a>";
            }
        }



                /*印出尚未開啟的田*/
        for($i=1;$i<=9-($farm+$buyfarm);$i++){
            if(($i+(($buyfarm+$farm)%3))%3==0){
                echo"<img src=\"img/2.png\"></br>";
            }
            else{
                echo"<img src=\"img/2.png\">";
            }
        }
    }
    echo"</div>";
}
echo "</form>";
?>
</div>
<!-- 背包-Large modal -->
<button type="button" class="bag btn btn-link" id="bag_style" data-toggle="modal" data-target="#bag_script"></button>
<div class="modal fade bs-example-modal-sm" id="bag_script" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <?php
            /*以下為背包內容*/
            echo "<h3>背包內容</h3>";
            $sqlbag = "select fname , quantum , foodplayer.fID , energyup from foodplayer , food where pname='$id' and food.fID=foodplayer.fID and quantum>0 ";
            $resultsbag=mysqli_query($conn,$sqlbag);
            while($rsbag=mysqli_fetch_array($resultsbag)){
                echo "<a class=\"eatfood\" href='eatfood.php?fID=".$rsbag['fID']."' OnClick=\"return confirm('確定要吃".$rsbag['fname']."嗎？可以恢復".$rsbag['energyup']."點體力')\";><img src=\"img/food.png\">".$rsbag['fname']."</a>";
                echo "*".$rsbag['quantum']."</br>";
            }
            echo"</br></br>";
            echo"<button class=\"bag btn btn-warning btn-block\" data-dismiss=\"modal\">返回</button>";
        ?>
    </div>
  </div>
</div>
<!-- 商店-Large modal -->
<button type="button" class="KFC btn btn-link" id="KFC_style" data-toggle="modal" data-target="#shop_script"></button>
<div class="modal fade bs-example-modal-sm" id="shop_script" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <?php            
            /*以下為商店*/
            echo "<h3>商店</h3>";
            $sqlfood = "select * from food ";
            $resultsfood=mysqli_query($conn,$sqlfood);
            echo"<div class=\"showui\">";
                while($rsfood=mysqli_fetch_array($resultsfood)){
                    echo"<a class=\"buyfood\" href='buyfood.php?fID=".$rsfood['fID']."' OnClick=\"return confirm('確定要購買".$rsfood['fname']."嗎？')\";><img src=\"img/food.png\">".$rsfood['fname']."</a>";
                    echo"$".$rsfood['costmoney']."</br>";
                }
                echo"</br></br>";
            echo"</div>";
            echo"<button class=\"KFC btn btn-warning btn-block\" data-dismiss=\"modal\">返回</button>";
            echo "</div>";
        ?>
    </div>
  </div>
</div>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- 最新編譯和最佳化的 JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="js/countdown.min.js"></script>
<audio src="How_it_Began.mp3" controls autoplay loop hidden="true" > // Background music
</body>
</html>
