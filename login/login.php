<?php 
require_once("../config.php"); 
require_once("../languages/manager.php"); 

if(isset($_POST['name'])&&isset($_POST['pw'])){
  require("../mysql_connections.php");
  if(login($_POST['name'],$_POST['pw'])){
    header("Location: admincp/index.php");
  }else{
    echo '<script>alert("the password or the username is incorrect!");</script>';
  }
}else if(isset($_POST['email'])&&isset($_POST['pw'])){
  require("../mysql_connections.php");
  if(loginemail($_POST['email'],$_POST['pw'])){
    header("Location: admincp/index.php");
  }else{
    echo '<script>alert("the password or the email adress is incorrect!");</script>';
  }
}

?>

<!DOCTYPE html>
<html>
    <head>
    <?php echo "<title>$title | Login</title>";  ?>
      <meta charset=UTF-8/>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <section>
      </section>
      <form class="login-box" action="login.php" method="post">

        <h1>Login</h1>
        <div class="text-box">
          <i class="fas fa-user-circle" aria-hidden="true"></i>
          <input type="text" placeholder="<?php echo $usernamemail;?>" name="name" id="emailname" value="" onkeyup="nameemail();">
        </div>

        <div class="text-box">
          <i class="fas fa-lock" aria-hidden="true" onclick="showhide();" id="toggle"></i>
          <input type="password" placeholder="<?php echo $password;?>" name="pw" value="" id="password">
        </div>

        <input class="button" type="submit" name="" value="<?php echo $login;?>" >
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
