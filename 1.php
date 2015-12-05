<?php
    include"isset.php";
    $id=$_SESSION['uID'];
    $sqla = "select count(farmID) as r from farmplayer  where pname='$id' and status=1";
    $resultsta=mysqli_query($conn,$sqla);
    $rsa=mysqli_fetch_array($resultsta);
    $sqltimer = "select farmID , cID ,(htime-ptime) as time ,status from farmplayer  where pname='$id' and status=1";
            $resultst=mysqli_query($conn,$sqltimer);
            while ($rst=mysqli_fetch_array($resultst)) {
                $aa[]=$rst['status'];
                $bb[]=$rst['farmID'];
                $cc[]=$rst['cID'];
                $dd[]=$rst['time'];
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"
        src="countdown.min.js">
</script>
<script>
$(document).ready(function(){
    $("input").click(function(){
        $(".a").show();
    });
});
function start(){
    <?php for($i=1;$i<=$rsa['r'];$i++){?>
        new Countdown({
            selector: '.timer<?php echo $bb[$i-1];?>',
            msgBefore: "",
            msgAfter: "<?php echo "<a href='harvest.php?farmID=".$bb[$i-1]."&cID=".$cc[$i-1]."' ><img src='plant".$cc[$i-1].".png'></a>";?>",                   
            msgPattern: "{seconds}",
            dateStart: new Date(),
            dateEnd: new Date(new Date().getTime()+(<?php echo $dd[$i-1];?> * 1000)),
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
<style type="text/css">
body{
    background-color:#8FBC8F;
    font-size:18px;
}
#top{
    text-align:right;
}
img{
    width:60px; 
    height:60px;
    margin:4px;
}
    label > input{
        visibility: hidden;
        position: absolute;
}
    label > input + img{ 
        cursor:pointer;
        border:2px solid transparent;
}
    label > input:checked + img{
        border:2px solid #AAAAFF;
}
#column{
    background-color:#EEEEFF;
    display:block;
    width:200px;
    border:2px solid #BBBBBB;
}
.a{
    display:none; 
    border:2px solid; 
    background-color:#999911; 
    margin:2px; 
    width:40%; 
    position:fixed;
    top:180px;
    right:410px;
}
#upper{
    position:absolute;
    font-size:25px;
    color:#FFB6C1;
}
</style>
</head>
<body>
<?php
    echo"<div id=\"top\">";
    echo"親愛的".$id."，您好！<a href=\"logout.php\" STYLE=\"text-decoration:none\">登出</a>";
    echo"</div>";
    $sql1 = "select  * from player  where pname='$id'";
    $results=mysqli_query($conn,$sql1);
    echo"</br></br></br><h1 style=\"text-align:center;\">Happy Farm</h1>";
    if($rows=mysqli_fetch_array($results)){
        echo"<div id=\"column\">",
            "暱稱:".$rows["pname"]."</br>",
            "LV:".$rows["level"]."</br>",
            "EXP:".$rows["exp"]."</br>",
            "能量:".$rows["energy"]."</br>",
            "金錢:".$rows["money"]."</br></div>";
    }
?>
<div id="rr" align="center">
<?php
$sql = "select  level , crops.cID , cname ,costmoney , money , needlevel from player , crops  where player.pname='$id'";
$results1=mysqli_query($conn,$sql);

echo"<div id=\"a\"class=\"a\">",
    "<form method='post' action='farm.php'>",
    "要種甚麼呢?</br>";
while(	$rs=mysqli_fetch_array($results1)){
    if($rs['level']>=$rs['needlevel']){
        echo "<label><input type=\"radio\" name=\"crops\"  id=\"crops\" checked value=\"";
        echo $rs["cID"] ;
        echo"\"></input>";
        echo "<img src='plant".$rs["cID"].".png' id=\"b\"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
}
echo"<button type=\"submit\" onclick=\"b()\">確定</button>",
    "</div>";
$sql1 = "select * from player  where pname='$id'";
$results2=mysqli_query($conn,$sql1);
if ($rs=mysqli_fetch_array($results2)) {
    if($rs['level']==1){
        $farm=2;
        for($i=1;$i<=$farm;$i++){
            if($i%3==0){
                echo"<label>",
                    "<input name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                    "<img src=\"1.jpg\" id=\"b\" ></label></br>";
            }
            else{
                echo"<label>",
                    "<input name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                    "<img src=\"1.jpg\" id=\"b\" ></label>";
            }
        }
        for($i=1;$i<=9-$farm;$i++){
            if(($i+($farm%3))%3==0){
                echo"<img src=\"2.jpg\"></br>";
            }
            else{
                echo"<img src=\"2.jpg\">";
            }
        }
    }
    else{
        $sql2 = "select  count(farmID) from farmplayer  where pname='$id'";
        $results3=mysqli_query($conn,$sql2);
        if ($rs1=mysqli_fetch_array($results3)) {
            $farm=$rs1['count(farmID)'];             //擁有的田數
            $nextfarm=$farm+1;
            $sqlfarming = "select farmID , cID ,(htime-ptime) ,status from farmplayer  where pname='$id'";
            $results4=mysqli_query($conn,$sqlfarming);
            while ($rss=mysqli_fetch_array($results4)) {
                $a[]=$rss['status'];
                $b[]=$rss['farmID'];
                $c[]=$rss['cID'];
                $d[]=$rss['(htime-ptime)'];
            }
            $count=0;
            $check=1;
                for($i=1;$i<=$farm;$i++){                //印出可以種的田
                    $count++;
                        if($a[$i-1]==$check){        //印出有種東西的田 
                            if($count%3==0){
                                echo "<span id=\"upper\" class=\"timer".$b[$i-1]."\"></span>";
                                echo "<img src=\"growing.png\"></br>";
                            }
                            else{
                                echo "<span id=\"upper\" class=\"timer".$b[$i-1]."\"></span>";
                                echo "<img src=\"growing.png\">";
                            }
                        }
                        else{
                            if($i%3==0){
                                echo"<label>",
                                    "<input name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                                    "<img src=\"1.jpg\" id=\"b\"></label></br>";
                            }
                            else{
                                echo"<label>",
                                    "<input name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                                    "<img src=\"1.jpg\" id=\"b\"  ></label>";
                            }
                        }
                }
            $sql3 = "select count(needlevel) from player , farm where pname='$id' and level>=needlevel ";
            $results5=mysqli_query($conn,$sql3);
            if ($rs2=mysqli_fetch_array($results5)) {
                $buyfarm=$rs2['count(needlevel)'];  
                $buyfarm=$buyfarm-$farm;
                for($i=1;$i<=$buyfarm;$i++){                //印出可以買的田
                    if(($i+($farm%3))%3==0){
                        echo"<a href='buy.php?nextfarm=".$nextfarm."' OnClick=\"return confirm('確定要購買嗎？')\";>
                            <img src=\"3.gif\"></a></br>";
                    }
                    else{
                        echo"<a href='buy.php?nextfarm=".$nextfarm."' OnClick=\"return confirm('確定要購買嗎？')\";>
                            <img src=\"3.gif\"></a>";
                    }
                }
            }
            for($i=1;$i<=9-($farm+$buyfarm);$i++){//印出尚未開啟的田
                if(($i+(($buyfarm+$farm)%3))%3==0){
                        echo"<img src=\"2.jpg\"></br>";
                    }
                    else{
                        echo"<img src=\"2.jpg\">";
                    }
            }
        }
    }
}
    echo "</form><div id=\"main\"></div>";
?>
</div>
<script src="countdown.min.js">
</script>
<button onclick="start()">計時</button>
<div class="timer"></div>
</body>
</html>
