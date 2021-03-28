<?php
$showerr = false;
$showalert = false;
require_once('../partials/dbconnect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $username = $_POST["uname"];
  $password = $_POST["psw"];
  $cpassword = $_POST["psw-confirm"];
  $email = $_POST["email"];

  $existsql = "SELECT * FROM `users` WHERE username='$username'";
  $result = mysqli_query($conn, $existsql);
  if ($result){
    $Enum = mysqli_num_rows($result);
    if ($Enum > 0) {
      $showerr= "User is already exist";
    }
    else{
      if ($password == $cpassword) {
  
        $hash=password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES ('$username', '$hash', '$email');";
        $result1 = mysqli_query($conn, $sql);
        if ($result1){
          $showalert = true;
          header("location: login.php");
        }
        else{
          echo"problem";
        }
      } 
      else {
        $showerr = "Passwords do not match";
      }
    }
}
else{echo"problem2";}
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Signup page</title>
  <style>
    .container input[type=text],
    input[type=password] {
      width: 90%;
      padding: 15px;
      margin: 5px 70px 22px 22px;
      display: inline-block;
      border: none;
      border-radius: 15px 50px 30px;
      background: #f1f1f1;
      text-align: center;
      font-size: 20px;
    }

    input[type=text]:focus,
    input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    h1 {
      margin-bottom: 20px;
    }

    /* Float cancel and signup buttons and add an equal width */
    .signupbtn {
      float: center;
      width: 50%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      opacity: 0.9;
      font-size: 20px;
    }

    .container button:hover {
      opacity: 0.8;
    }

    /* Add padding to container elements */
    .container {
      border-radius: 12%;
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.5);
      /* Black w/opacity/see-through */
      color: white;
      font-weight: bold;
      font-size: 19px;
      border: 3px solid #f1f1f1;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 40%;
      margin-top: 25px;
      padding: 20px;
      text-align: center;
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
    <form action="/forum/users/signup.php" method="post" style="border:1px solid #ccc">
      <?php
      if ($showalert) {
        echo ' <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>
        Successfully done;you are registered.
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
        <h1>Sign Up</h1>
        <label for="uname"><b>Username</b></label>
        <input type="text" maxlenth="12" placeholder="Enter Name" id="uname" name="uname" required>

        <label for="email"><b>Email</b></label>
        <input type="text" maxlenth="10" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="psw-confirm"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="psw-confirm" required>

        <div class="end">
          <button type="submit" class="signupbtn">Sign Up</button>
        </div>
      </div>
    </form>
  </header>
  <?php require '../partials/footer.php'; ?>
</body>

</html>