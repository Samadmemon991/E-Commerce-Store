<?php
include 'dbcon.php';

session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="logInSignup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        function setMsg(msg) {
            document.getElementById("InfoBox").style.opacity = 1;
            document.getElementsByTagName('input')[0].style.boxShadow = '0px 0px 5px 3px inset red';
            document.getElementsByTagName('input')[1].style.boxShadow = '0px 0px 5px 3px inset red';
        }
    </script>
</head>

<body>
    <header>
        <div id="logo">
            <img src="media/loginlogo.png" alt="logo">
        </div>
        <h1>Welcome.</h1>
    </header>
    <section>
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <input type="text" placeholder="Username" name="user" required value="<?php if (isset($_COOKIE["user"])) {
                                                                                        echo $_COOKIE["user"];
                                                                                    } ?>" id="top">

            <input type="password" placeholder="Password" name="pass" required value="<?php if (isset($_COOKIE["pass"])) {
                                                                                            echo $_COOKIE["pass"];
                                                                                        } ?>" id="bottom">
            <br>

            <div class="checkBoxText">
                <input type="checkbox" name="remember" id="check" />
                <p>Remember me</p>
            </div>

            <input type="submit" name="login" value="Log In">
        </form>
        <p><a href="signup.php" name="signup">Sign up</a> for a new account</p>

        <div id="InfoBox">
            <h3 style="width: 15% "><i class="fas fa-exclamation-circle"></i></h3>
            <h4 id="msg"> Entered Username or Password is incorrect</h4>
        </div>

    </section>
</body>
<?php
if (isset($_POST['login'])) {
    if ($_POST["user"] == '' || $_POST["pass"] == '') {
        echo "<script> setMsg('You cannot leave any login field empty.')</script>";
    } else {
        $username = $_POST["user"];
        $password = $_POST["pass"];
        $result = mysqli_query($conn, "SELECT * FROM users where username='$username' and password='$password'");

        if (mysqli_num_rows($result) > 0) {
            $_SESSION["uname"] = $username;
            $_SESSION['cart'] = array();

            if (isset($_POST['remember'])) {
                $time = time() + (86400 * 30);
                setcookie("user", $_POST["user"], $time);
                setcookie("pass", $_POST["pass"], $time);
            }

            header("Location:index.php");
        } else if (!empty($username) && !empty($password)) {
            echo "<script> setMsg()</script>";
        }
    }
}
?>
</html>