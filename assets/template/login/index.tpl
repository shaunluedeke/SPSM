<!DOCTYPE html>
<html lang="{htmllang}">
<head>
    <title>{title} | Login</title>
    <link rel="stylesheet" href="assets/css/login/style.css">
</head>
<body>
<section>
</section>
<form class="login-box" action="index.php" method="post">

    <h1>Login</h1>
    <div class="text-box">
        <i class="fas fa-user-circle" aria-hidden="true"></i>
        <input type="text" placeholder="{useremail}" required name="name" id="emailname" value="" onkeyup="nameemail();">
    </div>

    <div class="text-box">
        <i class="fas fa-lock" aria-hidden="true" onclick="showhide();" id="toggle"></i>
        <input type="password" placeholder="{password}" required name="pw" value="" id="password">
    </div>

    <input class="button" type="submit" name="login" value="{login}" >
    <a class="button" href="index.php?site=register">Register</a>
</form>
<script type="text/javascript">
    const password = document.getElementById('password');
    const toggle = document.getElementById('toggle');

    function nameemail(){
        var emailname = document.getElementById("emailname").value;
        var emailclass = document.getElementById("emailname");
        var pattern1 = /^[^ ]+@[^ ]+\.[a-z]{2}$/;
        var pattern2 = /^[^ ]+@[^ ]+\.[a-z]{3}$/;
        if(emailname.match(pattern1)||emailname.match(pattern2)){
            emailclass.setAttribute('name','email');
        }else{
            emailclass.setAttribute('name','name');
        }
    }
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