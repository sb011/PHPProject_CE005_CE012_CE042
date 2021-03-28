<?php
    require_once('../partials/dbconnect.php');
    include('../like/post_function.php');

    $sql = "SELECT * FROM `post`;";
    $result = mysqli_query($conn, $sql);
?>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- Like  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<link rel="stylesheet" href="like/main.css">
    <title>Home</title>
</head>
<body>
<table style="width: 100%">
<tr>
    <th>id</th>
    <th>Post</th>
    <th>Likes</th>
    <th>Posted By</th>
</tr>
<?php
    if ($result){
        if(mysqli_num_rows($result) > 0 ){
            while($data = mysqli_fetch_array($result)){ 
            ?>
            <tr>
                <td><?php echo $data['Id']; ?></td>
                <td><a href="../post/post.php?id=<?php echo $data['Id']; ?>"><?php echo $data['title'];?></a></td>
                <td>

                  <!-- if user likes post, style button differently -->
                  <i <?php if (userLiked($data['Id'])): ?>
                      class="fa fa-thumbs-up like-btn"
                    <?php else: ?>
                      class="fa fa-thumbs-o-up like-btn"
                    <?php endif ?>
                    data-id="<?php echo $data['Id'] ?>"></i>
                  <span class="likes"><?php echo getLikes($data['Id']); ?></span>
                  
                  &nbsp;&nbsp;&nbsp;&nbsp;

                <!-- if user dislikes post, style button differently -->
                  <i 
                    <?php if (userDisliked($data['Id'])): ?>
                      class="fa fa-thumbs-down dislike-btn"
                    <?php else: ?>
                      class="fa fa-thumbs-o-down dislike-btn"
                    <?php endif ?>
                    data-id="<?php echo $data['Id'] ?>"></i>
                  <span class="dislikes"><?php echo getDislikes($data['Id']); ?></span>
                  <script src="../like/scripts.js"></script>

                </td>
                <td>
                  <?php
                    $id = $data['user_id'];
                    $sqluser = "SELECT * FROM `users` WHERE `Id`=$id";
                    $result1 = mysqli_query($conn, $sqluser);
                    $user = mysqli_fetch_array($result1);
                    echo $user['username'];
                  ?>
                </td>
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