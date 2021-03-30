<?php
require_once('../partials/dbconnect.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
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
    overflow: hidden;  
    padding: 10px;  
    width:30px;
} 
tr{
    overflow: none;
}
.table-scroll {
    /*width:100%; */
    display: block;
    /* empty-cells: show; */
    width: 25cm;
    height: 300px;
    margin-left: 3em;
    /* Decoration */
    border-spacing: 0;
    /* border: rgba(130, 130, 170, 0.1); */
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
    /* Position */
    display: block;
    position: relative;
    width: 100%;
    height: 330px;
    overflow-y: scroll;
    /* overflow-y: hidden; */
    /* Decoration */
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
    /* padding: 1rem; */
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

<?php

session_start();
include '../partials/nav3.php'; ?>
<body>
<div class="container">
    <h1>Your Comments</h1>
    <table border=1 align="center" class="table1 table-scroll small-first-col">
        <thead>
        <tr>
            <th>Id</th>
            <th>Comment</th>
            <th>likes</th>
            <th>Post</th>
            <th>update</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody class="body-half-screen">
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
                   ?>
            </td>
            <td><a href="../comment/update_comment.php?id=<?php echo $data2['Id']?>&user_id=<?php echo $data2['user_id'] ?>&post_id=<?php echo $data2['post_id'] ?>">update</a></td>
            <td><a href="../comment/remove_comment.php?id=<?php echo $data2['Id']?>&user_id=<?php echo $data2['user_id'] ?>&post_id=<?php echo $data2['post_id'] ?>">Remove</a></td>
        </tr>
        <?php
                } 
            }
            else{
                echo "<a>No post</a>";
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