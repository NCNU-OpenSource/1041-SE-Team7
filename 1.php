<?php
    include"isset.php";
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
</script>
<script>
var tbl="";
$(document).ready(function(){
  $("input").click(function(){
    $(".a").show();
    document.getElementById('b').onclick=getvalue(this.value);
  });
});
function getvalue(value){
    document.getElementById('get').innerHTML=value;
}
</script>
<style type="text/css">
body{
    background-color:#EEEEE0;
    font-size:18px;
}
#top{
    text-align:right;
}
#b{
    background-image:url(1.jpg); 
    width:48px; 
    height:48px;
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
</style>
</head>
<body>
<?php
    $id=$_SESSION['uID'];
    echo"<div id=\"top\">";
    echo"親愛的".$id."，您好！<a href=\"logout.php\" STYLE=\"text-decoration:none\">登出</a>";
    echo"</div>";
    $sql1 = "select  * from player  where pname='$id'";
    $results=mysqli_query($conn,$sql1);
    if ($rows=mysqli_fetch_array($results)) {
        echo"<div id=\"column\">",
            "暱稱:".$rows["pname"]."</br>",
            "LV:".$rows["level"]."</br>",
            "EXP:".$rows["exp"]."</br>",
            "能量:".$rows["energy"]."</br>",
            "金錢:".$rows["money"]."</br></div>";
    }
?>
</br></br></br>
<h1 style="text-align:center;">Happy Farm</h1>
<div id="rr" align="center">
<?php

$sql = "select  level , crops.cID , cname ,costmoney , money from player , crops  where player.pname='$id'";
$results=mysqli_query($conn,$sql);

echo"<div id=\"a\"class=\"a\" style=\"display:none;\">",
    "<form method='post' action='farm.php'>",
    "要種甚麼呢?</br>";
//<span id=\"get\">?</span>
while (	$rs=mysqli_fetch_array($results)) {
    echo "<input type=\"radio\" name=\"crops\" id=\"crops\"value=\"";
    echo $rs["cID"] ;
    echo"\"></input>";
    echo $rs["cname"];
}
echo"<button type=\"submit\">確定</button>",
    "</div>";
$sql1 = "select  * from player  where pname='$id'";
$results=mysqli_query($conn,$sql1);
if ($rs=mysqli_fetch_array($results)) {
    if($rs['level']==1){
        $farm=2;
        for($i=1;$i<=$farm;$i++){
            if($i%3==0){
                echo"<label>",
                    "<input id=\"b\" name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                    "<img src=\"1.jpg\"></label></br>";
            }
            else{
                echo"<label>",
                    "<input id=\"b\" name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                    "<img src=\"1.jpg\"></label>";
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
        $results=mysqli_query($conn,$sql2);
        if ($rs1=mysqli_fetch_array($results)) {
            $farm=$rs1['count(farmID)'];             //擁有的田數
            $nextfarm=$farm+1;
            for($i=1;$i<=$farm;$i++){  //印出可以種的田
                if($i%3==0){
                    echo"<label>",
                        "<input id=\"b\" name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                        "<img src=\"1.jpg\"></label></br>";
                }
                else{
                    echo"<label>",
                        "<input id=\"b\" name=\"farm\" value=\"$i\" type=\"radio\"></input>",
                        "<img src=\"1.jpg\"></label>";
                }
            }
            $sql3 = "select count(needlevel) from player , farm where pname='$id' and level>=needlevel ";
            $results=mysqli_query($conn,$sql3);
            if ($rs2=mysqli_fetch_array($results)) {
                $buyfarm=$rs2['count(needlevel)'];  
                $buyfarm=$buyfarm-$farm;
                for($i=1;$i<=$buyfarm;$i++){                //印出可以買的田
                    if(($i+($farm%3))%3==0){
                        echo"<a href='buy.php?nextfarm=".$nextfarm."' OnClick=\"return confirm('確定要購買嗎？')\";>
                            <img src=\"3.jpg\"></a></br>";
                    }
                    else{
                        echo"<a href='buy.php?nextfarm=".$nextfarm."' OnClick=\"return confirm('確定要購買嗎？')\";>
                            <img src=\"3.jpg\"></a>";
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
</body>
</html>
