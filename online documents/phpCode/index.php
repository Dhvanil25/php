<?php
require 'varfilter.php';
session_start();
if(!empty($_SESSION['username']))
{
header('location:doctorhome.php');
}
elseif (!empty($_SESSION['cusername']))
{
header('location:clienthome.php');
}

require 'database.php';
error_reporting(0);

if (isset($_POST['login']))
{
$name=$_POST['username'];
$pass=$_POST['psswd'];
if (empty($name) && empty($pass))
{
$echo = "Please fill username and password";
}
else
{
$username=unhack($name);
$password=unhack($pass);
$finddoc=mysql_query("select username,password from doctor_login where username='$username' AND password='$password' ")or die(mysql_error());
if (mysql_num_rows($finddoc)==1)
{

$_SESSION['username']=$username;
$_SESSION['password']=$password;
header('location: doctorhome.php');
}

else {
$findclient=mysql_query("select username,password from client_login where username='$username' AND password='$password' ");
if (mysql_num_rows($findclient)==1)
{
$_SESSION['cusername']=$username;
$_SESSION['cpassword']=$password;
header('location: clienthome.php');
}
else
{

$echo= "Wrong username and password";
}
}

}
}




?>
<!doctype html>

<head>

	<!-- Basics -->

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Login</title>

	<!-- CSS -->

	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/styles.css">

</head>

	<!-- Main HTML -->

<body>

	<!-- Begin Page Content -->

	<div id="container">

		<form method="post">

		<label for="name">Username:</label>

		<input type="name" name="username">

		<label for="username">Password:</label>

		<p><a href="ForgotPassword.php">Forgot your password?</a>

		<input type="password" name="psswd">

		<div id="lower">
<?php echo    $echo;?><br/>
<a href="signup_form.php">Create an account</a>
		<input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>

		<input type="submit" name="login" value="Login">

		</div>

		</form>

	</div>


	<!-- End Page Content -->

</body>

</html>
