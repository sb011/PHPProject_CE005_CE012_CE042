<?php
require_once('../partials/dbconnect.php');
include('../like/post_function.php');
if(!isset($_SESSION['loggedin']) || ($_SESSION['loggedin']!=true)){
    header("location: ../users/login.php");
    exit;
}

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
<style>
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
    height: 75%;
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
  table-layout:fixed;
    position: relative;
    display: block;
    margin-top: 30px;
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
    padding: 10px;  
    float: left;
} 

.table-scroll {
    display: block;
    width: 27cm;
    margin-left: 3em;
    border-spacing: 0;
  } 
  .table-scroll thead {
    border-radius: 15px;
    position: relative;
    display: block;
    overflow-y: hidden;
    background-color: rgba(130, 130, 170, 0.1);
  }

  .table-scroll tbody {
    border-radius: 15px;
    display: block;
    position: relative;
    height: 200px;
    overflow-y: scroll;
    overflow-x: auto;
    border-top: 1px solid rgba(0, 0, 0, 0.2);
  }

  .table-scroll tr {
    display: flex;
  }

  .table-scroll td,
  .table-scroll th {
    flex-grow: 2;
    display: inline;
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

.container a{
    background-color: #4CAF50;
    color: white;
    font-size: 20px;
    text-decoration: none;
    padding: 10px;
}
.container a:hover{
  opacity: 0.8;
}
#cmt{
  inline-size: 400px;
}

  </style>
  </head>
  <header>
  <?php
include '../partials/nav3.php'; ?>

<body>
  <div class="container">
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
                  ?></h1><br>
    <a href="../comment/add_comment.php?user_id=<?php echo $data3['Id']?>&post_id=<?php echo $data['Id'] ?>">Add Comment</a>
    <table border=1 class="table table-scroll small-first-col">
      <thead>
      <tr>
        <th>Comment</th>
        <th>Commented By</th>
      </tr>
      </thead>
      <tbody class="body-half-screen">
      <?php
        if ($result2){
          if(mysqli_num_rows($result2) > 0 ){
            while($data1 = mysqli_fetch_array($result2)){ 
              ?>      
      <tr>
        <td id="cmt"><?php echo $data1['comment'] ?></td>
        <td id="user"><?php
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
      </tbody>
    </table>
    </div>
</body>
</header>
</html>