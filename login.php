<?php
/**
 * Created by PhpStorm.
 * User: Manoochehr
 * Date: 11/7/2016
 * Time: 11:20 PM
 *
 * Username: manoochehr
 * Password: Password
 *
 * Description: This file is responsible for authenticating users. Username and password is hardcoded and mention above. It will
 * get username and password. Username input is not case sensitive. However the password is.
 * It will store the session either. So whenever the user with opened session attempts to login,
 * it will be redirected to note list page(index.php). Please note if logout button is pressed, the session will be destroyed.
 */
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("Location:login.php", true, 302);


}
if (isset($_SESSION['user'])) {
    header("Location: index.php", true, 302);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim(htmlspecialchars($_POST['username'])) : '';
    $password = isset($_POST['password']) ? trim(htmlspecialchars($_POST['password'])) : '';


    $valid_user = "manoochehr";
    $valid_password = "Password";
    $valid_hash = password_hash($valid_password, PASSWORD_DEFAULT);

    if (strtolower($username)== $valid_user && password_verify($password, $valid_hash)) {
        $_SESSION['user'] = $valid_user;
        header("Location: index.php", true, 302);
        exit;
    } else {
        //echo 'Your user and password was wrong. Please try another time!';
        ?>
        <div id="main-Div" class="form-group">
            <h2 style="margin-left: 10px;font-weight: bold; font-family: 'Times New Roman';" >login</h2>
            <p class="error">Your username and password is incorrect. Please try again!</p>
            <form id="second-Div" action="#" method="post">
                <label class="col-sm-2">Username:</label><input class="form-control userPassStyle" placeholder="username"
                                                                type="text" name="username" value="<?php echo $_POST['username'];?>"><br>
                <label class="col-sm-2">Password:</label><input class="form-control userPassStyle" placeholder="password"
                                                                type="password" name="password">
                <input type="submit" name="submit" class="btn btn-primary btn-lg loginButton">
            </form>
        </div>
        <?php
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log-in Page</title>
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">



        #main-Div {

            margin-left: 300px;
            margin-bottom: 200px;
            margin-right: 300px;
            margin-top: 75px;
            background-color: #cccccc;
            width: 600px;
            height: 500px;
        }

        #second-Div {
            height: 10em;
            position: relative;
            top: 20%;
            left: 30%;

        }


        input, textarea {
            width: 250px;
            border-style: solid;
            border-width: 2px;
            display: inline-block;

        }

        .loginButton {
            margin-top: 60px;
            margin-left: 30px;
        }

        .userPassStyle {
            width: 200px;
        }
        .error {
            color: red;
        }

    </style>
</head>
<body>

<div id="main-Div" class="form-group">
    <h2 style="margin-left: 10px;font-weight: bold; font-family: 'Times New Roman';" >login</h2>

    <form id="second-Div" action="#" method="post">
        <label class="col-sm-2">Username:</label><input class="form-control userPassStyle" placeholder="username"
                                                        type="text" name="username"><br>
        <label class="col-sm-2">Password:</label><input class="form-control userPassStyle" placeholder="password"
                                                        type="password" name="password">
        <input type="submit" name="submit" class="btn btn-primary btn-lg loginButton">
    </form>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
