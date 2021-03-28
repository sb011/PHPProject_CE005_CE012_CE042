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
    <title>Add Post</title>
</head>
<body>
    <form method="POST" action="/forum/post/update_post.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title..." value="<?php echo $title;?>">
        <label for="post">Post</label>
        <!-- <textarea type="text" id="post" name="post" placeholder="Post..." value="<?php echo $post;?>"></textarea> -->
        <textarea type="text" id="post" name="post" placeholder="Post..." value="<?php echo $post;?>"></textarea>
        <button type="submit" name="update_post">Post</button>
    </form>
</body>
</html>