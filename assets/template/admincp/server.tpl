<html>
<head lang="{htmllang}">

    <meta charset="utf-8">
    <title>{title} | Server Control Panel</title>
    <link rel="stylesheet" href="assets/css/admincp/style.css">
    <link rel="stylesheet" href="assets/css/circle.css">
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
<div class="middle" style="text-align: center;" >
    <h1>Server: {name}</h1>
    {if local}
    <div class="box">
        <div class="pricing-table">
            <div class="col">
                <div class="table">
                    <h2>CPU</h2>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola">
                                <div class="clearfix">
                                    <div class="c100 p{cpuload} big">
                                        <span style="color:black;">{cpuload}%</span>
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
            <div class="col">
                <div class="table">
                    <h2>RAM</h2>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola">
                                <div class="clearfix">
                                    <div class="c100 p{memory} big">
                                        <span style="color:black;">{memory}%</span>
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
            <div class="col">
                <div class="table">
                    <h2>Speicher</h2>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola">
                                <div class="clearfix">
                                    <div class="c100 p{speicher1} big">
                                        <span style="color:black;">{speicher2}</span>
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
        </div>
    </div>
    {endif local}
    {if not local}
    <div class="box">
        <div class="pricing-table">
            <div class="col">
                <div class="table">
                    <h2>PING</h2>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola" >
                                {if down}
                                <br><br><h3>{pingfail}</h3><br>
                                {endif down}
                                {if not down}
                                <div class="clearfix">
                                    <div class="c100 p{ping1} big">
                                        <span style="color:black;">{ping2} ms</span>
                                        <div class="slice">
                                            <div class="bar"></div>
                                            <div class="fill"></div>
                                        </div>
                                    </div>
                                </div>
                                {endif not down}
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="table">
                    <h2>Server Infos</h2>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola" >
                                <br>
                                <h4><b>Name:</b><br> {name}</h4>
                                <h4><b>Host:</b><br> {host}</h4>
                                <h4><b>Port:</b><br> {port}</h4>
                                <br><br>
                                <a href="index.php?site=server&name=Foxlabs&action=delete"><h4>Löschen</h4></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {endif not local}
    <a href="index.php?site=servers" class="btn"><h4>Zurück</h4></a>
</div>



</body>
</html>

