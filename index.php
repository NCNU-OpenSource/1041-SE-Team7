
<!DOCTYPE html>
<html>
<head>
<title>登入介面</title>
<style type="text/css">
#rr{
    border:2px solid black;
    padding:10px;
    background-color:white;
    width:250px;
    margin:10px auto;
    font-size:20px;
    font-family:fantasy;
}    
body{
    background-color:#EEEEE0;
    font-size:18px;
}
</style>
</head>
<body>
<meta charset="UTF-8" />
</br>
</br>
</br>
</br>
</br>
</br>
</br>
<h1 style="text-align:center;">Login Form</h1>
<form method="post" action="login.php">
<div id="rr" align="center">
帳號: <input type="text" name="id"><br />
密碼: <input type="password" name="pwd"><br />
<input type="submit">
<input type="reset">
<a href="register.php" style="text-decoration:none; font-size:15px;">加入會員</a>
</div>
</form>
</body>
</html>