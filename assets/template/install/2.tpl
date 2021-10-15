<html>
<head>
    <title>Install Page 2</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../assets/css/install/style.css">
</head>
<body>
<section>
</section>
<script type="text/javascript" color="6, 232, 129" opacity="1.6" zindex="-2" count="100" src="http://www.cssscript.com/demo/interactive-particle-nest-system-with-javascript-and-canvas-canvas-nest-js/canvas-nest.js"></script><canvas id="c_n2" width="725" height="913" style="position: fixed; top: 0px; left: 0px; z-index: -2; opacity: 0.7;"></canvas>

<form class="login-box" action="index.php?page=3" method="post">



    <h1>Install Page: 2</h1><br><br><br>
    <h2>Settings</h2>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <input type="text" placeholder="Server Name" name="sn" value="">
    </div>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <select class="login-language" name="Language" title="language">

            <option class="login-language-down" value="GER" >German / Deutsch</option>
            <option class="login-language-down" value="ENG" >English / UK</option>
        </select>
    </div>
    <div class="text-box">
        <i class="fas fa-id-card"></i>
        <input type="text" placeholder="Username" name="user" value="">
    </div>
    <div class="text-box">
        <i class="fas fa-envelope"></i>
        <input type="text" placeholder="E-Mail Adress" name="email" value="">
    </div>
    <div class="text-box">
        <i class="fas fa-lock" aria-hidden="true" onclick="showhide();" id="toggle"></i>
        <input type="password" placeholder="Password" name="pw" autocomplete="new-password" id="password">
    </div>

    <input class="button" type="submit" name="contains" value="Finish" >
</form>
<script type="text/javascript">
    const password = document.getElementById('password');
    const toggle = document.getElementById('toggle');


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