<html>
<head>
    <title>Install Page 1</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../assets/css/install/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<script type="text/javascript" color="6, 232, 129" opacity="1.6" zindex="-2" count="100" src="http://www.cssscript.com/demo/interactive-particle-nest-system-with-javascript-and-canvas-canvas-nest-js/canvas-nest.js"></script><canvas id="c_n2" width="725" height="913" style="position: fixed; top: 0px; left: 0px; z-index: -2; opacity: 0.7;"></canvas>

<section>
</section>
<form class="login-box" action="index.php?page=2" method="post">



    <h1>Install Page: 1</h1><br><br>
    <h2>MySQL Data</h2>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <input type="text" placeholder="MySQL Host" required name="host" value="localhost">
    </div>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <input type="text" placeholder="MySQL Port" name="port" value="3306" required>
    </div>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <input type="text" placeholder="MySQL Username" name="user" value="root" required>
    </div>
    <div class="text-box">
        <i class="fas fa-lock" aria-hidden="true" onclick="showhide();" id="toggle"></i>
        <input type="password" placeholder="MySQL Password" name="pw" autocomplete="new-password" id="password">
    </div>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <input type="text" placeholder="MySQL Database" name="db" value="SPSM-Core" required>
    </div>

    <input class="button" type="submit" name="contains" value="Next Page" >
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