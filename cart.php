<?php
session_start();

if(!isset($_SESSION['uname'])){
    header("Location:login.php");
    }

    
if(isset($_POST["reset"])){
    unset ($_SESSION['cart']) ;
 }

if(isset($_POST['checkout'])){
    include 'dbcon.php';
    $username = $_SESSION["uname"];
    $result = $conn->query("SELECT id from users where username = '$username' ORDER BY ID LIMIT 1" );
    $id=-1;
    while($row = $result->fetch_assoc()) {
        $id =  $row['id']; 
    }
    foreach ($_SESSION['cart'] as $k => $v) {
        
        $date = date('Y-m-d H:i:s');
        $query = "insert into purchase_history(purchase_item,item_price,purchase_date,user_id) values('$k','$v','$date','$id')";
        echo "insert into purchase_history(purchase_item,item_price,purchase_date,user_id) values('$k','$v','$date','$id','$date')";
        $result = $conn->query($query);
    
        
    }
    echo "<script>alert('Thank you for buying our product, see you next time :)')</script>";
    header("Location:index.php");
    unset ($_SESSION['cart']) ;

    


}
 
if(isset($_POST["toHome"])){
    header("Location:index.php");
 }
?>

<head>
    <title>Assassin's Creed</title>

    <link rel="icon" href="media/favicon.ico" type="image/ico">
    <meta name="viewport" content="​width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <style>
        .container {
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            padding-bottom: 20px;
        }

        th,
        td {
            padding: 10%;
        }

        th[colspan="2"] {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>
            Pleasure doing business with you.
        </h1>
        <table class="table table-stripped table-hover" id="invoice">
            <tr>
                <th>Sr</th>
                <th>Item</th>
                <th>Price</th>
            </tr>
            <?php
            $ctr = 1;
            $totalprice=0;
            if(isset($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $k => $v) {
                    echo "<tr>";
                    echo "<td>" . $ctr . "</td>";
                    echo "<td>" . $k . "</td>";
                    echo "<td>" . $v . "</td>";
                    $totalprice+=$v;
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
        <form method="post" action="<?php $_PHP_SELF ?>">
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary btn-block " name="reset">Reset 
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
            </div>
            <div class="col-sm-4">
                <button class="btn btn-primary btn-block " name="checkout" onclick="sum()">Check Out
                <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                </button>
            </div>
            <div class="col-sm-4">
                <button class="btn btn-primary btn-block " name="toHome">Home
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                </button>
            </div>


        </div>
        </form>

    </div>
    <script>
      

    </script>

</body>

</html>