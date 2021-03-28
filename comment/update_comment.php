<?php
require_once('../partials/dbconnect.php');

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
    <title>Add Post</title>
</head>
<body>
    <form method="POST" action="/forum/comment/update_comment.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
        <label for="comment">Comment</label>
        <input type="text" id="comment" name="comment" placeholder="Comment..." value="<?php echo $comment;?>">
        <button type="submit" name="update_comment">Post</button>
    </form>
</body>
</html>