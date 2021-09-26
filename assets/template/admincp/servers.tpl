<html>
<head lang="{htmllang}">

    <meta charset="utf-8">
    <title>{title} | Server Controll Panel</title>
    <link rel="stylesheet" href="assets/css/admincp/server/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script>
        function openSlideMenu(){
            document.getElementById('menu').style.width = '250px';
            document.getElementById('content').style.marginLeft = '250px';
            document.getElementById('slide').style.visibility = 'hidden';
        }
        function closeSlideMenu(){
            document.getElementById('menu').style.width = '0';
            document.getElementById('content').style.marginLeft = '0';
            document.getElementById('slide').style.visibility = 'visible';
        }

    </script>
</head>
<body>
<div id="content">
    <span class="slide" id="slide">
      <a onclick="openSlideMenu()">
        <i class="fas fa-bars"></i>
      </a>
    </span>
    <div id="menu" class="nav">
        <a class="close" onclick="closeSlideMenu()">
            <i class="fas fa-times"></i>
        </a>
        <a href="index.php"><i class="fas fa-home"></i>  Home</a>
        <a href="index.php?site=servers"><i class="fas fa-server"></i>  Servers</a>
        <a href="index.php?site=users" class="aktiv"><i class="fas fa-users"></i>  Users</a>

        <a class="logout" href="index.php?site=logout" ><i class="fas fa-sign-out-alt"></i>  Logout</a>
    </div>
</div>
<div class="middle" >

    {if serverloopstatus}
    <h1 style="color:white;text-align: center;">Alle Servers</h1>
    <table id="Table" class="table table-striped table-dark" style="color:white;" data-toggle="table" data-pagination="true"
           data-search="true">
        <thead>
        <tr>
            <th scope="col" data-sortable="true" data-field="Akte">Name</th>
            <th scope="col" data-sortable="true" data-field="name">Host</th>
            <th scope="col" data-sortable="true" data-field="port">Port</th>
            <th scope="col" data-sortable="true" data-field="date">Rang</th>
            <th scope="col" data-field="open">{open}</th>
        </tr>
        </thead>
        <tbody>
        {loop server_loop}
        <tr>
            <th scope="row">{server_loop_name}</th>
            <td>{server_loop_host}</td>
            <td>{server_loop_port}</td>
            <td>{server_loop_rang}</td>
            <td><a class="btn btn-primary" href="index.php?site=server&name={server_loop_name}">{open}</a></td>
        </tr>
        {endloop server_loop}
        </tbody>
        <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    </table>
    {endif serverloopstatus}
    {if not serverloopstatus}
        <h1 style="color:white; text-align: center;">Es ist kein Server <br> eingetragen! <br></h1>
        <a class="button" href="index.php?site=server-add">Neuen Server eintragen</a>
    {endif not serverloopstatus}
</div>



</body>
</html>

