<?php
require_once('../partials/dbconnect.php');
include('../like/post_function.php');

$username = $_SESSION['username'];
$getuser = "SELECT * FROM `users` WHERE username='$username'";
$userresult = mysqli_query($conn, $getuser);
$data3 = mysqli_fetch_assoc($userresult);

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `users` WHERE `Id`=$id";
    $result = mysqli_query($conn, $sql);

    $sqlpost = "SELECT * FROM `post` WHERE `user_id`=$id";
    $result1 = mysqli_query($conn, $sqlpost);
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
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

.container{
    justify-content: center;
    border-radius: 5%;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0, 0.5); 
    color: white;
    font-weight: bold;
    border: 3px solid #f1f1f1;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    width: 70%;
    height: 70%;
    margin-top:25px;
    padding: 20px;
    text-align: center;
    font-size: 20px;
}
h1{
    font-size: 40px;
    font-family: 'Poppins';
    margin-bottom: 10px;
}
table{
    position: relative;
    display: block;
}
table a{
    text-decoration: none;
    color:black;
}
table, th, td {  
    border: 0px solid black;  
    border-collapse: collapse;  
}  
th, td {  
    width: 30px;
    overflow: hidden;
    padding: 10px;  
} 
.table-scroll {
    display: block;
    width: 25cm;
    height: 200px;
    margin-left: 3em;
    border-spacing: 0;
  } 
  .table-scroll thead {
    border-radius: 15px;
    position: relative;
    display: block;
    width: 100%;
    overflow-y: hidden;
    background-color: rgba(130, 130, 170, 0.1);
  }

  .table-scroll tbody {
    border-radius: 15px;
    display: block;
    position: relative;
    width: 100%;
    height: 300px;
    overflow-y: scroll;
    border-top: 1px solid rgba(0, 0, 0, 0.2);
  }

  .table-scroll tr {
    width: 100%;
    display: flex;
  }

  .table-scroll td,
  .table-scroll th {
    flex-basis: 100%;
    flex-grow: 2;
    display: block;
    text-align: center;
  }

  .table-scroll.small-first-col td:first-child,
  .table-scroll.small-first-col th:first-child {
    flex-basis: 20%;
    flex-grow: 1;
  }
  .body-half-screen::-webkit-scrollbar {
    display: none;
}
table tr:nth-child(even) {  
    background-color: #eee;  
    color: gray;
}  
table tr:nth-child(odd) {  
    background-color: #fff;  
    color:gray;
}  
table th {  
    color: white;  
    background-color: gray;  
}
.link{
    margin-bottom: 20px;
}
.link a{
    background-color: #4CAF50;
    color: white;
    font-size: 20px;
    text-decoration: none;
    padding: 10px;
}
</style>

</head>
<header>
<?php include '../partials/nav3.php'; ?>
<body>
<div class="container">
    <h1>Your Post</h1>
    <?php
        if((int)$data3['Id'] == (int)$_GET['id']){
    ?>
        <div class="link">
        <a href="../post/add_post.php?user_id=<?php echo $id; ?>">Add Post</a>
        <a href="comment.php?id=<?php echo $id; ?>">Your Comment</a>
        </div>
    <?php
        }
    ?>
    <table border=1 align="center" class="table1 table-scroll small-first-col">
        <thead>
        <tr>
            <th>Question No</th>
            <th>Title</th>
            <th>Post</th>
            <th>likes</th>
            <?php
                if ((int)$data3['Id'] == (int)$_GET['id']){
            ?>
            <th>Update</th>
            <th>Remove</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody class="body-half-screen">
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
                    data-id="<?php echo $data1['Id'] ?>" style="color:red;"></i>
                  <span class="likes"><?php echo getLikes($data1['Id']); ?></span>
                  
                  &nbsp;&nbsp;&nbsp;&nbsp;

                <!-- if user dislikes post, style button differently -->
                  <i 
                    <?php if (userDisliked($data1['Id'])): ?>
                      class="fa fa-thumbs-down dislike-btn" 
                    <?php else: ?>
                      class="fa fa-thumbs-o-down dislike-btn" 
                    <?php endif ?>
                    data-id="<?php echo $data1['Id'] ?>" style="color:red;"></i>
                  <span class="dislikes"><?php echo getDislikes($data1['Id']); ?></span>
                  <script src="../like/scripts.js"></script>

            </td>
            <?php
                if ((int)$data3['Id'] == (int)$_GET['id']){
            ?>
            <td><a href='../post/update_post.php?user_id=<?php echo $id; ?>&id=<?php echo $data1['Id']; ?>'>Update Record</a></td>
            <td><a href='../post/remove_post.php?user_id=<?php echo $id; ?>&id=<?php echo $data1['Id']; ?>'>Delete Post</a></td>
            <?php } ?>
        </tr>
        <div class="warning">
        <?php
                } 
            }
            else{
                echo '<br><a>No post</a>';
            }
        }
        else{
            echo "<a>Problem</a>";
        } 
        ?>  
        </tbody>
    </table>
</div>
</body>
</header>
</html>