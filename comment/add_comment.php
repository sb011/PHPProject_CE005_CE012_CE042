<?php
require_once('../partials/dbconnect.php');
session_start();
if(!isset($_SESSION['loggedin']) || ($_SESSION['loggedin']!=true)){
    header("location: ../users/login.php");
    exit;
} 

$username = $_SESSION['username'];
$getuser = "SELECT * FROM `users` WHERE username='$username'";
$userresult = mysqli_query($conn, $getuser);
$data5 = mysqli_fetch_assoc($userresult);

$getcomments = "SELECT * FROM `post`";
$result3 = mysqli_query($conn, $getcomments);
$flag = 0;
while($data6 = mysqli_fetch_array($result3)){
    if($data6['Id'] == $_GET['post_id']){
        if(isset($_GET['user_id']) && isset($_GET['post_id']))
        {
            $user_id = $_GET['user_id'];
            $post_id = $_GET['post_id'];
        }
        $flag = 1;
    }
}

if (isset($_POST['add_comment'])){
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    
    
    $sql = "INSERT INTO `comment`(`user_id`, `post_id`, `comment`) VALUES ('$user_id', '$post_id', '$comment')";
    $result = mysqli_query($conn, $sql);

    if ($result){
        $showalert = true;
        header('location: ../post/post.php?id='.$post_id);
    }
    else{
        echo"problem3";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    .container{
        border-radius: 5%;
        background-color: rgba(0,0,0, 0.5); 
        color: white;
        font-weight: bold;
        border: 3px solid #f1f1f1;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        width: 60%;
        height: 70%;
        margin-top:25px;
        padding: 20px;
        text-align: center;
        font-size: 20px;
}  
.container label{
    font-family: 'Poppins';
    font-size: 30px;
    font-weight: bold;
}
.container input[type=text],textarea[type=text]{
  width: 90%;
  height: 15%;
  padding: 12px 20px;
  margin: 45px 70px 45px 42px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 15px 50px 30px;
  font-size: 20px;
  text-align: center;
}
.container textarea[type=text]{
    height: 40%;
}

.container button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 25px 0px 25px 10px;
  border: none;
  cursor: pointer;
  width: 50%;
  font-size: 25px;
  float: center;
}
.container button:hover {
  opacity: 0.8;
}
    </style>
</head>
<header>
<?php 
include '../partials/nav2.php'; ?>
<body>
    <form method="POST" action="/forum/comment/add_comment.php" class="container">
        <?php
            if ((int)$data5['Id'] == (int)$_GET['user_id']){
                if($flag == 1){
        ?>
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
        <label for="comment">Comment</label>
        <textarea type="text" id="comment" name="comment" placeholder="Comment..."></textarea>
        <button type="submit" name="add_comment">comment</button>
        <?php
                }
                else{
                    echo "Post doesn't exist!!";
                }
            }
            else{
                echo "Go to Your Profile!!";
            }
        ?>
    </form>
</body>
</header>
</html>