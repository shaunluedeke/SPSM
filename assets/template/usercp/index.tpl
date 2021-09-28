<html>

<head lang="{htmllang}">

    <meta charset="utf-8">
    <title>{title} | User Interface</title>
    <link rel="stylesheet" href="assets/css/circle.css">
    <link rel="stylesheet" href="assets/css/usercp/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function openSlideMenu() {
            document.getElementById('menu').style.width = '250px';
            document.getElementById('content').style.marginLeft = '250px';
            document.getElementById('slide').style.visibility = 'hidden';
        }

        function closeSlideMenu() {
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
        <a href="index.php" class="aktiv"><i class="fas fa-home"></i> Home</a>
        <a href="index.php?site=servers"><i class="fas fa-server"></i> Servers</a>

        <a class="logout" href="index.php?site=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
<div class="middle">
    <h1 style="text-align: center">User Control Panel</h1>
    <div class="local">
        <h1 style="text-align: center">Localer Server</h1><br>
        <div class="container">
            <h3 style="text-align: center">CPU</h3>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{cpu}" aria-valuemin="0" aria-valuemax="100" style="width:{cpu}%">
                    {cpu}%
                </div>
            </div>
        </div>
        <div class="container">
            <h3 style="text-align: center">RAM</h3>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{ram}" aria-valuemin="0" aria-valuemax="100" style="width:{ram}%">
                    {ram}%
                </div>
            </div>
        </div>
        <div class="container">
            <h3 style="text-align: center">Speicher</h3>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{speicher}" aria-valuemin="0" aria-valuemax="100" style="width:{speicher}%">
                    {speicher}%
                </div>
            </div>
        </div>
    </div>

        <div class="pricing-table">
            {if server}

            {if last}
                <a href="index.php?server={lastserver}"><i class="fas fa-backward"></i></a>
            {endif last}

            {loop ping_loop}
            <div class="col">
                <div class="table">
                    <h2 style="color: white;">{ping_loop_host}</h2>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola">
                                <div class="clearfix">
                                    <div class="c100 p{ping_loop_ping1} big">
                                        <span style="color:black;">{ping_loop_ping2}</span>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {endloop ping_loop}
            {if next}
            <a href="index.php?server={nextserver}"><i class="fas fa-step-forward"></i></a>
            {endif next}
            {endif server}
            {if not server}
            <div class="col">
                <div class="table">
                    <h2>No Server</h2>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola">
                               <h3>{noserver}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {endif not server}
        </div>


</div>
</body>

</html>