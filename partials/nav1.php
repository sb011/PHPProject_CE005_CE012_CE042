<!DOCTYPE html>
<html>
<head>
<title>iDiscuss Gaming-Forum</title>
<style>
*{
	margin: 0;
	padding: 0;
}
body {
	font-family: 'Poppins', sans-serif;
}

header{
    background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url("images/1624.jpg");
    -webkit-background-size: cover;
    height:100vh;  
    background-position: cover cover;
    background-repeat: no-repeat;
    background-size: cover;
    /* position:center; */
}
.navbar{
    float:right;
    margin-top: 30px;
    overflow:hidden;
}
.navbar ul{
    overflow: auto;
}
.navbar li{
    margin:13px 20px;
    display: inline-block;
    list-style: none;
}
.navbar li a{
    color: #fff;
    text-align: center;
    padding: 5px 20px;
    font-family: poppins;
    text-decoration: none;
    font-size: 18px;
    text-transform: uppercase;
}
.navbar li a:hover{
    background-color: #fff;
    color: #333;
    font-size: 20px;
}
.navbar li a.active{
    background-color: #4CAF50;
    color: white;
    font-size: 20px;
}
.navbar li a.active:hover{
    opacity: 0.8;
}
.search{
    color:white;
    float:right;
    margin:3px 25px; ;
}
.navbar input{
    text-align:center;
    border:2px solid black;
    border-radius: 14px;
    padding:10px 17px 10px 17px;
    width:155px;
    font-size: 18px;
}
.logo {
	float: left;
}
.logo img {
	width: 100%;
	padding: 15px 0px;
}
.button {
  background-color: #4CAF50; 
  border: none;
  color: white;
  padding: 11px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 18px;
  cursor: pointer;
}
.button:hover {
  opacity: 0.8;
}
</style>
</head>
<body>
<div class="logo">
     <img src="https://i.postimg.cc/mg4rWBmv/logo.png" alt="">
</div>
<nav class="navbar" >
<?php
if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']==true)){
    $loggedin=true;
}
else{
    $loggedin=false;
}
if($loggedin){
echo'
<ul>
<li><a href="users/home.php" class="active">Posts</a></li>
<li><a href="">New games</a></li>
<li><a href="">Pro gamers</a></li>
<li><a href="users/logout.php">Logout</a></li>
<div class="search">
     <input type="text" name="search" id="search" placeholder="search here">
     <button type="search" class="button" value="search">Search</button>
</div>';
}
if(!$loggedin){
echo'<li><a href="signup.php" class="active">signup</a></li>
<li><a href="login.php">Login</a></li>
</ul>
</nav>';}
?>
</body>
</html>