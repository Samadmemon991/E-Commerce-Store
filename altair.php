<?php
session_start();


include 'dbcon.php';
$result = mysqli_query($conn, "SELECT * FROM games where name='Altair'");
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $price = $row["price"];
}
if (isset($_POST["BUY"])) {
    if (isset($_SESSION['uname'])) {
        $_SESSION['cart']["Assassins Cread 1 "] = $price;
    } else {
        echo '<script >alert("Hey mate, happy to see your enthusiasm for our product, but you must sign in first for shopping. Happy visit :)");</script>';
    }
}

if (isset($_POST["reset"])) {
    unset($_SESSION['cart']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <link rel="stylesheet" href="main.css">
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cart items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-stripped table-hover" id="invoice">
                        <tr>
                            <th>Sr</th>
                            <th>Item</th>
                            <th>Price</th>
                        </tr>
                        <?php
                        $ctr = 1;
                        $totalprice = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $k => $v) {
                                echo "<tr>";
                                echo "<td>" . $ctr . "</td>";
                                echo "<td>" . $k . "</td>";
                                echo "<td>" . $v . "</td>";
                                $totalprice += $v;
                                echo "</tr>";
                                $ctr++;
                            }
                        }

                        ?>
                        <tr>
                            <th colspan="2">Total</th>
                            <th id="total"><?php echo $totalprice ?></th>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form class="inline-form" method="post" action="<?php $_PHP_SELF ?>">
                        <input type="submit" class="btn btn-primary" name="reset" value="Reset cart" />
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                            echo "<a href=\"index.php\"><i class= 'fas fa-user'></i> Sign in </a>";
                        } ?></a>
                    <?php if (isset($_SESSION['uname'])) {
                        include 'cartbuttons.html';
                    } ?>
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


    <div class="mainbody img-responsive" style="background-image:url('https://staticctf.akamaized.net/J3yJr34U2pZ2Ieem48Dwy9uqj5PNUQTn/3wpxIiN56ZSmpqjaRc9njE/00db66f9b31ef7b5c75ddd2275a31da9/AC1_hero_desktop.jpg'); 
    background-image: url(media/altair.jpg);">
        <div class="alert alert-info alert-dismissible fade in" role="alert" id="buyAlert" style="display: none; margin:0px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <strong>Item Added to cart!</strong>
        </div>
        <div style="padding-top:15% ;" class="container-fluid ">
            <div class="row ">
                <div class="col-xs-10 col-md-5 ">
                    <div class="card ">
                        <h1>The Original Assassin</h1>
                        <hr>
                        <p>The setting is 1191 AD. The third crusade is tearing the holy land apart. You, Altaïr, intend
                            to stop the hostilities by suppressing both sides of the conflict.</p>
                        <form method="post" action="<?php $_PHP_SELF ?>">

                            <button class="btn btn-primary btn-block" id="buy" name="BUY">
                                <h4>Buy now $<?php echo $price ?></h4>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-xs-10 col-md-6">
                    <div class="  VideoCard ">

                        <div class="embed-responsive embed-responsive-16by9 ">
                            <iframe width="100% " height="auto " src="https://www.youtube-nocookie.com/embed/CE9XnaT1CUY?controls=0&amp;start=59" frameborder="0 " allowfullscreen></iframe>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="info">
            <a href="info.html"><i class="fas fa-info-circle"></i> </a>
        </div>
    </div>

    <script>
        var obj = <?php echo json_encode($_SESSION['cart']); ?>;
        console.log(obj);


        function viewCart() {

            var obj = <?php echo json_encode($_SESSION['cart']); ?>;

            preview = "";
            for (k in obj) {
                preview += k + " is purchased at the price of $" + obj[k] + "\n";

            }
            alert(preview);
        };

        function manageCart() {
            window.open("cart.php", "_blank");
        }

        function logout() {
            window.location = "logout.php";
        }

        function cantBuy() {
            alert('Hey mate, happy to see your enthusiasm for our product, but you must sign in first for shopping. Happy visit :)');
        }
        $(document).ready(function() {
            $('#buy').click(function(event) {

                $('#buyAlert').show();

            })
        });
    </script>

</body>

</html>