<?php
require_once('../partials/dbconnect.php');

if(isset($_GET['user_id']) && isset($_GET['post_id']))
{
    $user_id = $_GET['user_id'];
    $post_id = $_GET['post_id'];
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
</head>
<body>
    <form method="POST" action="/forum/comment/add_comment.php">
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
        <label for="comment">Comment</label>
        <textarea type="text" id="comment" name="comment" placeholder="Comment..."></textarea>
        <button type="submit" name="add_comment">comment</button>
    </form>
</body>
</html>