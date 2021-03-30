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

if(isset($_GET['post_id'])){
    $getyourpost = "SELECT * FROM `post` WHERE `user_id`={$data5['Id']} AND `Id`={$_GET['post_id']}";
    $getpost = mysqli_query($conn, $getyourpost);

    $flag = 0;
    $flag1 = 0;
    while($data6 = mysqli_fetch_array($getpost)){
        if($_GET['post_id'] == $data6['Id']){

            $getyourcomment = "SELECT * FROM `comment` WHERE `user_id`={$data5['Id']} AND `post_id`={$data6['Id']}";
            $getcomment = mysqli_query($conn, $getyourcomment);
            while($data7 = mysqli_fetch_array($getcomment)){
                if($data7['Id'] == $_GET['id']){
                    if(isset($_GET['id']) && isset($_GET['user_id']) && isset($_GET['post_id']))
                    {   
                        $id = $_GET['id'];
                        $user_id = $_GET['user_id'];
                        $post_id = $_GET['post_id'];
                        $sql = "SELECT * FROM `comment` WHERE `Id`=${_GET['id']}";
                        if($result = mysqli_query($conn, $sql))
                        {
                            $data = mysqli_fetch_array($result);
                            $id = $data['Id'];
                            $comment = $data['comment'];
                        }
                    }
                    $flag1 = 1;
                }
            }
            $flag = 1;
        }
    }
}
if(isset($_POST['update_comment'])){
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    $sqlupdate = "UPDATE `comment` SET `comment`='$comment' WHERE `Id`='$id';";
    $result1 = mysqli_query($conn, $sqlupdate);
    if ($result1){
        $showalert = true;
        header('location: ../post/post.php?id='.$post_id);
    }
    else{
        echo "problem3";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update comment</title>
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
.container textarea[type=text]{
  width: 95%;
  height: 50%;
  padding: 12px 20px;
  margin: 45px 80px 45px 22px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 15px 50px 30px;
  font-size: 20px;
  text-align: center;
  justify-content: center;
}
.container button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 50px 0;
  border: none;
  cursor: pointer;
  width: 50%;
  font-size: 20px;
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
    <form method="POST" action="/forum/comment/update_comment.php" class="container">
    <?php
        if ((int)$data5['Id'] == (int)$_GET['user_id']){
            if($flag == 1){
                if($flag1 == 1){
    ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
        <label for="comment">Comment</label>
        <textarea type="text" id="comment" name="comment" placeholder="Comment..." value="<?php echo $comment;?>"></textarea>
        <button type="submit" name="update_comment">Post</button>
        <?php
                }
                else{
                    echo "This is not your comment!!";
                }
            }
            else{
                echo "This is not you post!!";
            }
        }
        else{
            echo "Go to your Profile!!";
        } ?>
    </form>
</body>
</header>
</html>