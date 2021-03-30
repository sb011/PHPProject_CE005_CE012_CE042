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

$getyourpost = "SELECT * FROM `post` WHERE `user_id`={$data5['Id']}";
$getpost = mysqli_query($conn, $getyourpost);

$flag = 0;
$flag1 = 0;

// $getyourcomment = "SELECT * FROM `comment` WHERE `user_id`={$data5['Id']} AND `post_id`={$data6['Id']}";
// $getcomment = mysqli_query($conn, $getyourcomment);
// $data7 = mysqli_fetch_assoc($getcomment);

while($data6 = mysqli_fetch_array($getpost)){
    if($_GET['post_id'] == $data6['Id']){
        $getyourcomment = "SELECT * FROM `comment` WHERE `user_id`={$data5['Id']} AND `post_id`={$data6['Id']}";
        $getcomment = mysqli_query($conn, $getyourcomment);
        while($data7 = mysqli_fetch_assoc($getcomment)){
            if($data7['Id'] == $_GET['id']){
                if(isset($_GET['id']) && isset($_GET['user_id']) && isset($_GET['post_id']))
                {
                    $id = $_GET['id'];
                    $user_id = $_GET['user_id'];
                    $post_id = $_GET['post_id'];
                    $user_id = $_GET['user_id'];
                }
                $flag1 = 1;
            }
        }
        $flag = 1;
    }
}

if (isset($_POST['delete_comment'])) {
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
	$id = $_POST['id'];
    $sql = "DELETE FROM `comment` WHERE `Id`=$id";
    $result = mysqli_query($conn, $sql);
	if ($result){
        header('location: ../users/profile.php?id='.$user_id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
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
        width: 50%;
        height: 45%;
        margin-top:25px;
        padding: 20px;
        text-align: center;
        font-size: 20px;
}
.container button {
  background-color: #4CAF50;
  color: white;
  padding: 13px 25px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 12.5%;
  font-size: 20px;
  float: center;
  font-weight: bold;
}
.container button:hover {
  opacity: 0.8;
}
.container a{
    background-color: #4CAF50;
    color: white;
    font-size: 20px;
    text-decoration: none;
    padding-left: 35px;
    padding-right: 35px;
    padding-top: 11px;
    padding-bottom: 12px;
}
.container a:hover{
    opacity: 0.8;
}
p{
    font-size: 40px;
    font-family: 'Poppins';
    margin-bottom: 10px;
    margin-top: 25px;
}
</style>
</head>
<header>
<?php 

include '../partials/nav2.php'; ?>

<body>
<div class="container">
        <?php
            if ((int)$data5['Id'] == (int)$_GET['user_id']){
                if($flag == 1){
                    if($flag1 == 1){
        ?>
        <p>Are you sure you want to delete this record?</p>
        <form action="/forum/comment/remove_comment.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
            <button type="submit" name="delete_comment">Yes</button><br><br>
            <a href="../users/comment.php?id=<?php echo $user_id?>">No</a>
        </form>
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
            }?>
</div>
</body>
</header>
</html>