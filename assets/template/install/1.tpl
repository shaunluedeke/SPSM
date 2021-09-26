<html>
<head>
    <title>Install Page 1</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../assets/css/install/style.css">
</head>
<body>
<section>
</section>
<form class="login-box" action="index.php?page=2" method="post">



    <h1>Install Page: 1</h1>
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
        <input type="password" placeholder="MySQL Password" name="pw" value="" id="password">
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