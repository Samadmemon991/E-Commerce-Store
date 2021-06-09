<?php
session_start();

// if(!isset($_SESSION['uname'])){
// header("Location:login.php");
// }
if (isset($_POST['user']) && isset($_POST['pass'])) {
    $_SESSION['uname'] = $_POST['user'];
}
?>

<html>

<head>
    <title>Assassin's Creed</title>

    <link rel="icon" href="media/favicon.ico" type="image/ico">
    <meta name="viewport" content="​width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="main.css">
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-style ">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#icon">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="https://www.ubisoft.com/en-gb/game/assassins-creed">
                        <img class="logo" src="media/logo.png" alt="logo">
                        <?php
                        if (isset($_SESSION['uname'])) {
                            echo 'Hey, ' . $_SESSION['uname'];
                        } else {
                            echo "<a href=\"login.php\"><i class= 'fas fa-user'></i> Sign in </a>";
                        } ?>
                    </a>

                </div>


                <?php include 'menu.html';

                if (isset($_SESSION['uname'])) {
                    echo "<li><a href=\"logout.php\" onclick=\"logout()\">Log out</a></li>";
                }
                echo "</ul>";
                echo "</div>";


                ?>

            </div>
        </nav>
    </header>





    <div class="mainbody img-responsive" style="background-image: url(media/bg.jpg);">
        <div style="padding-top:15% ;" class="container-fluid ">
            <div class="row ">
                <div class="col-xs-10 col-md-5 ">
                    <div class="card ">
                        <h1>assassin's creed</h1>
                        <hr>
                        <p>Assassin's Creed is an action-adventure video game developed by Ubisoft Montreal and
                            published by
                            Ubisoft. It is the first installment in the Assassin's Creed series. The game was released
                            for
                            PlayStation 3 and Xbox 360 in November 2007
                            and was made available on Microsoft Windows in April 2008</p>

                    </div>
                </div>


                <div class="col-xs-10 col-md-6">
                    <div class="  VideoCard ">
                        <div class="embed-responsive embed-responsive-16by9 ">
                            <iframe width="100% " height="auto " src="https://www.youtube-nocookie.com/embed/iQFWOs93OYM?controls=0&amp;start=33 " frameborder="0 " allowfullscreen></iframe>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="info">
            <a href="info.html"><i class="fas fa-info-circle"></i> </a>
        </div>


    </div>


</body>

</html>