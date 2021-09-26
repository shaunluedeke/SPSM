<!DOCTYPE html>
<html lang="{htmllang}">
<head>
    <title>{title} | Register</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/login/style.css">
</head>
<body>

<form class="login-box" action="index.php?site=register" id = "form" method="post">

    <h1>Register</h1>

    <div class="text-box">
        <i class="far fa-envelope" id = "emailpat"></i>
        <input type="email" placeholder="e-mail adress" name="email" value="" id="email" required onkeyup="validation();">
    </div>
    <div class="text-box">
        <i class="far fa-user-circle"></i>
        <input type="text" placeholder="username" name="username" value="" required id="username">
    </div>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <select class="login-language" name="Language" title="language">

            <option class="login-language-down" value="ENG" >English / UK</option>
            <option class="login-language-down" value="GER" >German / Deutsch</option>
        </select>
    </div>
    <div class="text-box">

        <i class="fas fa-lock" aria-hidden="true" onclick="showhide();" id="toggle"></i>
        <span class="tooltiptex">✔ 8 - 32 letter <br>✔ at least one upper- and lowercase letter (A-Z, a-z)<br>✔ at least one number (0-9)<br>✔ (sugg.) extra letter (!,§,$,%,+,-,=,?)</span>
        <input type="password" placeholder="password" name="pw" required value="" id="password">


    </div>

    <input class="button" type="submit" name="register" id="submitb" value="register">

</form>

<script type="text/javascript">

    function validation(){
        var form = document.getElementById("form");
        var email = document.getElementById("email").value;
        var epat = document.getElementById("emailpat");
        var button = document.getElementById("submitb");
        var pattern1 = /^[^ ]+@[^ ]+\.[a-z]{2}$/;
        var pattern2 = /^[^ ]+@[^ ]+\.[a-z]{3}$/;
        if(email.match(pattern1)||email.match(pattern2)){
            epat.setAttribute('class','far fa-check-circle');
            epat.style.color = "#ffffff";
            button.setAttribute('type','submit');
        } else {
            epat.setAttribute('class','fas fa-times-circle');
            epat.style.color = "#fc0000";
            button.setAttribute('type','button');
        }
    }

    var password = document.getElementById('password');
    var toggle = document.getElementById('toggle');
    var password1 = document.getElementById('password1');
    var toggle1 = document.getElementById('toggle1');

    function showhide(){
        if(password.type === 'password'){
            password.setAttribute('type','text');
            toggle.setAttribute('class','fas fa-lock-open');

        }else{
            password.setAttribute('type','password');
            toggle.setAttribute('class','fas fa-lock');

        }
    }

    function showhide1(){
        if(password1.type === 'password'){
            password1.setAttribute('type','text');
            toggle1.setAttribute('class','fas fa-lock-open');

        }else{
            password1.setAttribute('type','password');
            toggle1.setAttribute('class','fas fa-lock');

        }
    }
</script>
</body>
</html>
