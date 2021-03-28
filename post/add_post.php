<?php
require_once('../partials/dbconnect.php');

if(isset($_GET['user_id']))
{
    $user_id = $_GET['user_id'];
}

if (isset($_POST['add_post'])){
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $post = $_POST['post'];
    $sql = "INSERT INTO `post`(`user_id`, `title`, `post`) VALUES ('$user_id', '$title', '$post')";
    $result = mysqli_query($conn, $sql);

    if ($result){
        $showalert = true;
        header('location: ../users/profile.php?id='.$user_id);
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
    <title>Add Post</title>
</head>
<body>
    <form method="POST" action="/forum/post/add_post.php">
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title...">
        <label for="post">Post</label>
        <textarea type="text" id="post" name="post" placeholder="Post..."></textarea>
        <button type="submit" name="add_post">Post</button>
    </form>
</body>
</html>