<?php

$host = "localhost";
$user = "root";
$pass = "";
$banco= "tribe";

$conec = mysql_connect($host,$user,$pass)or die(mysql_error());
mysql_select_db($banco)or die(mysql_error());

$email = $_POST['username'];
$pass  = $_POST['password'];

$query = mysql_query("Select * from usuario where email = '$email' and pass = '$pass'")or die(mysql_error());
$row = mysql_num_rows($query);
if ($row > 0) {
    session_start();
    $session['username'] = $_POST['username'];
    $session['password'] = $_POST['password'];
    header("location:default.php");

}else{
    echo "<script>alert('nao foi dessa vez amigo')</script>";
}
?>

<html>
    <head>
        <title>TRIBE</title>
        <!--Bootstrap-->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
        <!--End Bootstrap-->
        <link href="bootstrap/css/style.css" rel="stylesheet" media="screen">
    </head>
    <body>
            <div class="container">
                <div class="card card-container">
                    <img id="profile-img" class="profile-img-card" src="bootstrap/img/img_project.png" />
                    <p id="profile-name" class="profile-name-card"></p>
                    <form class="form-signin" method="post" name="login">
                        <span id="reauth-email" class="reauth-email"></span>
                        <input type="email" id="inputEmail" name="username" class="form-control" placeholder="Email address" required autofocus>
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                        <input class="btn btn-lg btn-primary btn-block btn-signin" name="login" type="submit" value="Log me In"></input>
                    </form><!-- /form -->
                </div><!-- /card-container -->
            </div><!-- /container -->
    </body>
</html>