<?php
  require('../config.php');
  if(isset($_POST['sub'])){
    if(isset($_POST['pw'])&&isset($_POST['email'])&&isset($_POST['username'])){
      require('../mysql_connections.php');
      if(register($_POST['username'],$_POST['pw'],$_POST['email'],$_POST['Language'],"default")){
        header('Location: login.php');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <?php echo "<title>$titleregister </title>"?>
      <meta charset="utf-8" ?>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>

      <form class="login-box" action="register.php" id = "form" method="post">

        <h1>Register</h1>

        <div class="text-box">
          <i class="far fa-envelope" id = "emailpat"></i>
          <input type="text" placeholder="e-mail adress" name="email" value="" id="email" onkeyup="validation();">
        </div>
        <div class="text-box">
          <i class="far fa-user-circle"></i>
          <input type="text" placeholder="username" name="username" value="" id="username">
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
          <input type="password" placeholder="password" name="pw" value="" onkeyup="iscorpas();" id="password">


        </div>
        <div class="text-box">
          <i class="fas fa-lock" aria-hidden="true" onclick="showhide1();" id="toggle1"></i>
          <span class="notooltip" id = "twofalse">✘ The password must match!</span>
          <input type="password" placeholder="password" name="pw2" value="" onkeyup="correctpassword();" onchange="correctpassword();" id="password1">
        </div>

        <input class="button" type="submit" name="sub" id="submitb" value="register">

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
          var patternpw="(?=.*\d)((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])).{8,32}";
        function correctpassword(){
          var button = document.getElementById("submitb");
          var fals = document.getElementById("twofalse");
          if(password.value==password1.value){
              button.setAttribute('type','submit');
              toggle.style.color = "#ffffff";
              toggle1.style.color = "#ffffff";
              fals.setAttribute('class','notooltip');

          }else{
              button.setAttribute('type','button');
              fals.setAttribute('class','tooltiptext');
              toggle.style.color = "#fc0000";
              toggle1.style.color = "#fc0000";
          }
        }
        function iscorpas(){
          var button = document.getElementById("submitb");
          if(password.value.match(patternpw)){
              button.setAttribute('type','submit');
              toggle.style.color = "#ffffff";
              password1.disabled = false;
          }else{
              button.setAttribute('type','button');
              toggle.style.color = "#fc0000";
              password1.disabled = true;

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
