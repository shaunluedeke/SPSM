<!DOCTYPE html>
<html lang="{htmllang}">
<head>
    <title>{title} | Register</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/login/style.css">
</head>
<body>

<form class="login-box" action="index.php?site=user&name={name}" id = "form" method="post">

    <h1>Name: {name}</h1>

    <div class="text-box">
        <i class="far fa-envelope" id = "emailpat"></i>
        <input type="email" placeholder="e-mail adress" name="email" value="{email}" id="email" required onkeyup="validation();">
    </div>
    <div class="text-box">
        <i class="far fa-user-circle"></i>
        <input type="text" placeholder="username" name="username" value="{name}" readonly id="username">
    </div>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <select class="login-language" name="Language" title="language">
            {if ger}
            <option class="login-language-down" value="ENG" >English / UK</option>
            <option class="login-language-down" value="GER" selected >German / Deutsch</option>
            {endif ger}
            {if not ger}
            <option class="login-language-down" value="ENG" selected>English / UK</option>
            <option class="login-language-down" value="GER" >German / Deutsch</option>
            {endif not ger}

        </select>
    </div>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <select class="login-language" name="rang" title="rang">
            {if admin}
            <option class="login-language-down" value="Admin" selected>Admin</option>
            <option class="login-language-down" value="default" >User</option>
            {endif admin}
            {if not admin}
            <option class="login-language-down" value="Admin" >Admin</option>
            <option class="login-language-down" value="default" selected>User</option>
            {endif not admin}

        </select>
    </div>

    <input class="button" type="submit" name="edit" id="submitb" value="Ändern">

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

    function showhide(){
        if(password.type === 'password'){
            password.setAttribute('type','text');
            toggle.setAttribute('class','fas fa-lock-open');

        }else{
            password.setAttribute('type','password');
            toggle.setAttribute('class','fas fa-lock');

        }
    }
</script>
</body>
</html>
