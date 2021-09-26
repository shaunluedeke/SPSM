<!DOCTYPE html>
<html lang="{htmllang}">
<head>
    <title>{title} | Server-Add</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/login/style.css">
</head>
<body>

<form class="login-box" action="index.php?site=server-add" id = "form" method="post">

    <h1>Server Hinzufügen</h1>

    <div class="text-box">
        <i class="fas fa-address-card"></i>
        <input type="text" placeholder="Name" name="name" id="name" required >
    </div>
    <div class="text-box">
        <i class="fas fa-server"></i>
        <input type="text" placeholder="Host" name="host"  id="host" required>
    </div>
    <div class="text-box">
        <i class="fab fa-megaport"></i>
        <input type="number" placeholder="Port" name="port"  id="port" min="0" required>
    </div>
    <div class="text-box">
        <i class="fas fa-database"></i>
        <select class="login-language" name="rang" title="rang">
            <option class="login-language-down" value="Admin" >Admin</option>
            <option class="login-language-down" value="default" >User</option>

        </select>
    </div>

    <input class="button" type="submit" name="add" id="submitb" value="Hinzufügen">
    <a class="button" href="index.php?site=servers">Zurück</a>
</form>

</body>
</html>
