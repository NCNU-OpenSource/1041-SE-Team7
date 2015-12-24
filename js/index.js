// Toggle Function
$('.toggle').click(function(){
  // Switches the Icon
  $(this).children('i').toggleClass('fa-pencil');
  // Switches the forms  
  $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
  }, "slow");
});
function userlogin(){
    //先取得欄位值
    var user_name = $('#id').val();
    var user_password = $('#pwd').val();
    //判斷有無正確填寫
    if(user_name=="" && user_password==""){
        $('#error_msg').text('Please enter your ID & password');
        return false;
    }
    if(user_name==""){
        $('#error_msg').text('Please enter your ID');
        $('#id').focus();
        return false;
    }else if(user_password==""){
        $('#error_msg').text('Please enter your password');
        $('#pwd').focus();
        return false;
    };
//真正的ajax動作從這裡開始
    $.ajax({
        url:"login.php",
        data:"user_name="+user_name+"&user_password="+user_password,
        type : "POST",
        beforeSend:function(){
            $('#loading_div').show(); 
            //beforeSend 發送請求之前會執行的函式
        },
        success:function(msg){
            if(msg =="success"){
                document.location.href="1.php";    
            }else
            {    
                alert('沒有此用戶或密碼不正確');
            }
        },
        error:function(xhr){
            alert('Ajax request 發生錯誤');
        },
        complete:function(){
            $('#loading_div').hide();
            //$('#user_login').hide();         
            //complete請求完成實執行的函式，不管是success或是error
        }
    });    
};
function userregister(){
    //先取得欄位值
    var user_name = $('#acc').val();
    var user_password = $('#pwd2').val();
    var user_nickname = $('#pname').val();
    //判斷有無正確填寫
    if(user_name=="" && user_password==""){
        $('#error_msg2').text('Please enter your ID & password');
        return false;
    }
    if(user_name==""){
        $('#error_msg2').text('Please enter your ID');
        $('#acc').focus();
        return false;
    }    
    if(user_nickname==""){
        $('#error_msg2').text('Please enter your nickname');
        $('#pname').focus();
        return false;
    }else if(user_password==""){
        $('#error_msg2').text('Please enter your password');
        $('#pwd').focus();
        return false;
    };
//真正的ajax動作從這裡開始
    $.ajax({
        url:"insertuser.php",
        data:"user_name="+user_name+"&user_password="+user_password+"&user_nickname="+user_nickname,
        type : "POST",
        beforeSend:function(){
            $('#loading_div2').show(); 
            //beforeSend 發送請求之前會執行的函式
        },
        success:function(msg2){
            if(msg2 =="success"){
                location.replace("index.html");   
            }else{    
                $('#error_msg').show();
                $('#error_msg').html('Register Fail, Please try again');
            }
        },
        error:function(xhr){
            alert('Ajax request 發生錯誤');
        },
        complete:function(){
            $('#loading_div2').hide();
        }
    });    
};