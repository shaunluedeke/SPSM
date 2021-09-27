<html>

<head lang="{htmllang}">

    <meta charset="utf-8">
    <title>{title} | Admin Interface</title>
    <link rel="stylesheet" href="assets/css/admincp/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
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
        <a href="index.php?site=users"><i class="fas fa-users"></i> Users</a>

        <a class="logout" href="index.php?site=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
<div class="middle">
    <center>
        <h1>Admin Interface</h1>
        <h2>{welcome} {Name}</h2>
    </center>
    <div class="box">
        <div class="pricing-table">
            <div class="col">

                <div class="table">
                    <h2>Users</h2>
                    <h2><i class="fas fa-users"></i></h2>
                    <br>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola">
                                <h2 class="num">{usernumber}</h2>
                            </div>
                        </div>
                    </div>
                    <ul>
                        <li>{allusers}</li>
                    </ul> <br>
                    <a href="index.php?site=users">{shownow}</a>
                </div>

            </div>
            <div class="col">

                <div class="table">
                    <h2>Servers</h2>
                    <h2><i class="fas fa-server"></i></h2>
                    <br>
                    <div class="counting-sec">
                        <div class="inner-width">
                            <div class="cola">
                                <h2 class="num">{servernumber}</h2>
                            </div>
                        </div>
                    </div>
                    <ul>
                        <li>{allservers}</li>
                    </ul> <br>
                    <a href="index.php?site=servers">{shownow}</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".num").counterUp({
        delay: 70,
        time: 1000
    });
</script>
</body>

</html>