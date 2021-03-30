<?php
require_once('../partials/dbconnect.php');

if(isset($_GET['id']) && isset($_GET['user_id']))
{   
    $user_id = $_GET['user_id'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM `post` WHERE `Id`=${_GET['id']}";
    if($result = mysqli_query($conn, $sql))
    {
        $data = mysqli_fetch_array($result);
        $id = $data['Id'];
        $title = $data['title'];
        $post = $data['post'];
    }
}
if(isset($_POST['update_post'])){
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $post = $_POST['post'];

    $sqlupdate = "UPDATE `post` SET `title`='$title' , `post`='$post' WHERE `Id`='$id';";
    $result1 = mysqli_query($conn, $sqlupdate);
    if ($result1){
        $showalert = true;
        header('location: ../users/profile.php?id='.$user_id);
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
    <title>Update Post</title>
    
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
  width: 95%;
  height: 90px;
  padding: 12px 20px;
  margin: 15px 70px 35px 22px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 15px 50px 30px;
  font-size: 20px;
  text-align: center;
  justify-content: center;
}
.container textarea[type=text]{
    height: 200px;
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
.container button:hover {
  opacity: 0.8;
}
        </style>
</head>
<header>
<?php include '../partials/nav.php'; ?>

<body>
    <div class="container">
    <form method="POST" action="/forum/post/update_post.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title..." value="<?php echo $title;?>">
        <label for="post">Post</label>
        <textarea type="text" id="post" name="post" placeholder="Post..." value="<?php echo $post;?>"></textarea>
        <button type="submit" name="update_post">Post</button>
    </form>
    </div>
</body>
</header>
</html>