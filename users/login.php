<?php
require_once('../partials/dbconnect.php');
$showerr=false;
$login=false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
  $username=$_POST["uname"];
  $password=$_POST["psw"];

  // $sql="SELECT * FROM `users` WHERE username='$username' AND passsword='$password'"
  $sql="SELECT * FROM `users` WHERE username='$username'";
  $result = mysqli_query($conn,$sql);
  if($result){
    $num=mysqli_num_rows($result);
    if($num == 1){
      while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password,$row['password'])){
          $login=true;
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['username']=$username;
          header("location:../index.php");
        }
        else{
          $showerr="Invalid username or password";
        }
      }
    }
    else{
      $showerr="Invalid username or password";
      }
  }
  else{
    echo "wrong done";
  }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Login page</title>
<style>
.container input[type=text], input[type=password] {
  width: 90%;
  padding: 12px 20px;
  margin: 15px 70px 35px 22px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 15px 50px 30px;
  font-size: 20px;
  text-align: center;
}
.container input[type=checkbox]{
    position: relative;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

.container button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
  font-size: 20px;
  float: center;
}
h1{
    margin-bottom: 20px;
}
.container button:hover {
  opacity: 0.8;
}
.container{
    border-radius: 12%;
    background-color: rgba(0,0,0, 0.5); /* Black w/opacity/see-through */
    color: white;
    font-weight: bold;
    border: 3px solid #f1f1f1;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    width: 40%;
    margin-top:25px;
    padding: 20px;
    text-align: center;
    font-size: 20px;
}
span.psw {
  float: right;
  padding-top: 16px;
  margin-right: 20px;
}
.alert {
    padding: 10px; 
    background-color: green;
    color: white;
    font-size: 20px;
    position: relative;
}

.err {
    padding: 10px;
    background-color: red;
    color: white;
    font-size: 20px;
    position: relative;
}

    /* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

    /* When moving the mouse over the close button */
.closebtn:hover {
    color: black;
}
</style>

</head>
<body>
    <header>
      <form action="/forum/users/login.php" method="post">
     <?php
      if ($login) {
        echo ' <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>
        Successfully done;you are loggedin.
        </div>';
      }
      if ($showerr) {
        echo '<div class="err">
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' . $showerr . '
        </div>';
      }
      ?>
      <?php require '../partials/nav.php'; ?>
  <div class="container">
  <h1>Login</h1>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
<br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <br>    
    <button type="submit">Login</button>
    <br><br>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    <br>
    <span class="psw" ><a href="#" style="color:blue;">Forgot password?</a></span>
  </div>
</form>
    </header>
    <?php require '../partials/footer.php'; ?>
</body>

</html>