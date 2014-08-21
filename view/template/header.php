
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <title>Angielski</title>
    <link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="js/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="css/screen.css" rel="stylesheet" media="screen">
    <link href="css/app.css" rel="stylesheet" media="screen">
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="js/jquery.flip.min.js"></script>
    <style>
        body {
            margin-top: 50px;
        }
        a:hover {
            text-decoration: none !important;
        }
        .navbar-fixed-top{
            position: fixed;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="./">Angielski</a>


            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Everything you want hidden at 940px or less, place within here -->
            <div class="nav-collapse collapse">
                <a href="words">
                    <button class="btn" type="button">
                        <i class="icon-list"></i> Słówka</button>
                </a>

                <a href="cats">
                    <button class="btn" type="button">
                        <i class="icon-th-list"></i> Kategorie</button>
                </a>

                <a href="fiszki">
                    <button class="btn" type="button">
                        <i class="icon-star"></i> Fiszki</button>
                </a>

                <a href="stats">
                    <button class="btn" type="button">
                        <i class="icon-signal"></i> Statystyki</button>
                </a>

                <div id="user-login">
                <span class="btn btn-link">
                    Witaj, <?=@$user[0] ?>!
                </span>
                    <a class="btn btn-primary" href="logout">
                        Wyloguj
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="container">