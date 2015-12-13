<?php
    include"isset.php";
//將session清空
unset($_SESSION['uID']);
header("Refresh:5;url=index.html");
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title> </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="container">
    <div class="wrapper">
        <div class="container">
            </br></br></br></br>
            <h1>Loging Out<span class="ellipsis"></span></h1>
        </div>
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/logout.js"></script>
</body>
</html>
