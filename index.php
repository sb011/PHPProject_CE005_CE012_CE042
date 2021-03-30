<?php
require_once('partials/dbconnect.php');

session_start();
if(!isset($_SESSION['loggedin']) || ($_SESSION['loggedin']!=true)){
    header("location: users/login.php");
    exit;
}
if(isset($_SESSION['loggedin']) && isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	$sql = "SELECT `Id` FROM `users` WHERE `username`='$username'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_array($result);
}

?><!DOCTYPE html>
<html>
<head>
<title>iDiscuss Gaming-Forum</title>
<style>
.welcome-text {
	position: absolute;
	width: 600px;
	height: 300px;
	margin: 250px -40px;
	text-align: center;
}
.welcome-text h1 {
	text-align: center;
	color: #fff;
	text-transform: uppercase;
	font-size: 60px;
}
.welcome-text h1 span {
	color: #00fecb;
}
.welcome-text a {
	/* border: 1px solid #fff; */
	padding: 10px 25px;
	text-decoration: none;
	text-transform: uppercase;
	font-size: 18px;
	margin-top: 20px;
	display: inline-block;
    background-color: #4CAF50;
	color: #fff;
}
.welcome-text a:hover {
	background: #fff;
	color: #333;
}
</style>
</head>
<body>
<header>
<?php require 'partials/nav1.php'; ?>
<div class="welcome-text">
        <h1>
Welcome!!<span> <br> <?php echo $_SESSION['username']?></span></h1>
<a href="users/profile.php?id=<?php echo $data['Id']; ?>">Account</a>
</div>
</nav>
</header>
<?php require 'partials/footer.php'; ?>
</body>
</html>