<?php
require_once('../partials/dbconnect.php');
include('../like/post_function.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `users` WHERE `Id`=$id";
    $result = mysqli_query($conn, $sql);

    $sqlpost = "SELECT * FROM `post` WHERE `user_id`=$id";
    $result1 = mysqli_query($conn, $sqlpost);

    $sqlcomment = "SELECT * FROM `comment` WHERE `user_id`=$id";
    $result2 = mysqli_query($conn, $sqlcomment);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Like  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<link rel="stylesheet" href="like/main.css">
    <title>Document</title>
</head>
<body>
    <table border=1>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php
        if ($result){
            if(mysqli_num_rows($result) > 0 ){
                while($data = mysqli_fetch_array($result)){ 
                ?>
        <tr>
            <td><?php echo $data['Id'] ?></td>
            <td><?php echo $data['username'] ?></td>
            <td><?php echo $data['email'] ?></td>
        </tr>
        <?php
                } 
            }
            else{
                echo "no post";
            }
        }
        else{
            echo "problem";
        } 
        ?>  
    </table>
    <h1>Your Post</h1>
    <a href="../post/add_post.php?user_id=<?php echo $id; ?>">Add Post</a>
    <table border=1>
        <tr>
            <th>Question No</th>
            <th>Title</th>
            <th>Post</th>
            <th>likes</th>
            <th>Update</th>
            <th>Remove</th>
        </tr>
        <?php
        if ($result1){
            if(mysqli_num_rows($result1) > 0 ){
                while($data1 = mysqli_fetch_array($result1)){ 
                ?>
        <tr>
            <td><?php echo $data1['Id'] ?></td>
            <td><a href="../post/post.php?id=<?php echo $data1['Id']; ?>"><?php echo $data1['title'] ?></a></td>
            <td><?php echo $data1['post'] ?></td>
            <td>

                <!-- if user likes post, style button differently -->
                <i <?php if (userLiked($data1['Id'])): ?>
                      class="fa fa-thumbs-up like-btn"
                    <?php else: ?>
                      class="fa fa-thumbs-o-up like-btn"
                    <?php endif ?>
                    data-id="<?php echo $data1['Id'] ?>"></i>
                  <span class="likes"><?php echo getLikes($data1['Id']); ?></span>
                  
                  &nbsp;&nbsp;&nbsp;&nbsp;

                <!-- if user dislikes post, style button differently -->
                  <i 
                    <?php if (userDisliked($data1['Id'])): ?>
                      class="fa fa-thumbs-down dislike-btn"
                    <?php else: ?>
                      class="fa fa-thumbs-o-down dislike-btn"
                    <?php endif ?>
                    data-id="<?php echo $data1['Id'] ?>"></i>
                  <span class="dislikes"><?php echo getDislikes($data1['Id']); ?></span>
                  <script src="../like/scripts.js"></script>

            </td>
            <td><a href='../post/update_post.php?user_id=<?php echo $id; ?>&id=<?php echo $data1['Id']; ?>'>Update Record</a></td>
            <td><a href='../post/remove_post.php?user_id=<?php echo $id; ?>&id=<?php echo $data1['Id']; ?>'>Delete Post</a></td>
        </tr>
        <?php
                } 
            }
            else{
                echo "no post";
            }
        }
        else{
            echo "problem";
        } 
        ?>  
    </table>
    <h1>Your Comments</h1>
    <table border=1>
        <tr>
            <th>Comment Id</th>
            <th>Comment</th>
            <th>likes</th>
            <th>Post</th>
            <th>update</th>
            <th>Remove</th>
        </tr>
        <?php
        if($result2){
            if(mysqli_num_rows($result2) > 0 ){
                while($data2 = mysqli_fetch_array($result2)){ 
        ?>
        <tr>
            <td><?php echo $data2['Id'] ?></td>
            <td><?php echo $data2['comment'] ?></td>
            <td><?php if ($data2['likes'] == NULL)
                            echo "0";
                      else
                            echo $data2['likes']; ?></td>
            <td>
                <?php
                    $getpost = "SELECT * FROM `post` WHERE `Id`=${data2['post_id']}";
                    $result3 = mysqli_query($conn, $getpost);
                    $data3 = mysqli_fetch_array($result3);
                    $getuser = "SELECT * FROM `users` WHERE `Id`=${data3['user_id']}";
                    $result4 = mysqli_query($conn, $getuser);
                    $data4 = mysqli_fetch_array($result4);
                    echo $data4['username'];
                    // echo $data2['post_id'];
                ?>
            </td>
            <td><a href="../comment/update_comment.php?id=<?php echo $data2['Id']?>&user_id=<?php echo $data2['user_id'] ?>&post_id=<?php echo $data2['post_id'] ?>">update</a></td>
            <td><a href="../comment/remove_comment.php?id=<?php echo $data2['Id']?>&user_id=<?php echo $data2['user_id'] ?>&post_id=<?php echo $data2['post_id'] ?>">Remove</a></td>
        </tr>
        <?php
                } 
            }
            else{
                echo "no post";
            }
        }
        else{
            echo "problem";
        } 
        ?> 
    </table>
</body>
</html>