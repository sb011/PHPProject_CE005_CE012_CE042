<?php
require_once('../partials/dbconnect.php');
include('../like/post_function.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `post` WHERE `Id`=$id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    // session_start();
    $username = $_SESSION['username'];
    $getuser = "SELECT * FROM `users` WHERE username='$username'";
    $userresult = mysqli_query($conn, $getuser);
    $data3 = mysqli_fetch_assoc($userresult);

    $commentsql = "SELECT * FROM `comment` WHERE `post_id`=$id";
    $result2 = mysqli_query($conn, $commentsql);
    
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
    <h1>Post ID: <?php echo $data['Id'] ?></h1>
    <h1>Post Title: <?php echo $data['title'] ?></h1>
    <h1>Post: <?php echo $data['post'] ?></h1>
    <h1>Post likes:
    
                  <!-- if user likes post, style button differently -->
                    <i <?php if (userLiked($data['Id'])): ?>
                      class="fa fa-thumbs-up like-btn"
                    <?php else: ?>
                      class="fa fa-thumbs-o-up like-btn"
                    <?php endif ?>
                    data-id="<?php echo $data['Id'] ?>" style="color:red;"></i>
                  <span class="likes"><?php echo getLikes($data['Id']); ?></span>
                  
                  &nbsp;&nbsp;&nbsp;&nbsp;

                <!-- if user dislikes post, style button differently -->
                  <i 
                    <?php if (userDisliked($data['Id'])): ?>
                      class="fa fa-thumbs-down dislike-btn"
                    <?php else: ?>
                      class="fa fa-thumbs-o-down dislike-btn"
                    <?php endif ?>
                    data-id="<?php echo $data['Id'] ?>" style="color:red;"></i>
                  <span class="dislikes"><?php echo getDislikes($data['Id']); ?></span>
                  <script src="../like/scripts.js"></script>
    
    </h1>
    <h1>Posted By: <?php
                    $id = $data['user_id'];
                    $sqluser = "SELECT * FROM `users` WHERE `Id`=$id";
                    $result1 = mysqli_query($conn, $sqluser);
                    $user = mysqli_fetch_array($result1);
                    echo $user['username'];
                  ?></h1>
    <a href="../comment/add_comment.php?user_id=<?php echo $data3['Id']?>&post_id=<?php echo $data['Id'] ?>">Add Comment</a>
    <table border=1>
      <tr>
        <th>Post Id</th>
        <th>Commnet</th>
        <th>Likes</th>
        <th>Commneted By</th>
      </tr>
      <?php
        if ($result2){
          if(mysqli_num_rows($result2) > 0 ){
            while($data1 = mysqli_fetch_array($result2)){ 
              ?>
      <tr>
        <td><?php echo $data1['Id'] ?></td>
        <td><?php echo $data1['comment'] ?></td>
        <td>  
        <?php if ($data1['likes'] == NULL)
                            echo "0";
                          else
                            echo $data1['likes'];
                    ?>
        </td>
        <td><?php
              $user_id = $data1['user_id'];
              $sqlcommentuser = "SELECT * FROM `users` WHERE `Id`=$user_id";
              $result3 = mysqli_query($conn, $sqlcommentuser);
              $commentuser = mysqli_fetch_array($result3);
              echo $commentuser['username'];
            ?></td>
      </tr>
      <?php
            }
          }
        }
      ?>
    </table>
</body>
</html>