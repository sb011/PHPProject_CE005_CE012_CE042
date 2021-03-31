<?php
require_once('../partials/dbconnect.php');
include('../like/post_function.php'); 
$per_page_record = 8;  // Number of entries to show in a page.   
if(!isset($_SESSION['loggedin']) || ($_SESSION['loggedin']!=true)){
        header("location: ./login.php");
        exit;
    }
if (isset($_GET["page"])) {    
  $page  = $_GET["page"];    
}    
else {    
  $page=1;    
}    

$start_from = ($page-1) * $per_page_record;     

$sql = "SELECT * FROM `post` LIMIT $start_from, $per_page_record;";
$result = mysqli_query($conn, $sql); 
    
?>
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   

    <title>Home</title>
	<script>   
		function go2Page()   
		{   
			var page = document.getElementById("page").value;   
			page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
			window.location.href = 'index1.php?page='+page;   
		}   
  </script>  


    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    *{
	margin: 0;
	padding: 0;
}
body {
	font-family: 'Poppins', sans-serif;
}

header{
    background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url("../images/1624.jpg");
    -webkit-background-size: cover;
    height:100vh;  
    background-position: cover cover;
    background-repeat: no-repeat;
    background-size: cover;
}
.container{
    justify-content: center;
    border-radius: 10%;
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
    width: 60%;
    height: 75%;
    margin-top:25px;
    padding: 20px;
    text-align: center;
    font-size: 20px;
}
table{
    table-layout:fixed;
    position: relative;
    height: 50%;
    width:80%;
    margin: 40px 100px 10px 100px;
}
table a{
    text-decoration: none;
    color:black;
}
table, th, td {  
    border: 1px solid black;  
    border-collapse: collapse;  
    overflow: hidden;
}  
th, td {  
    padding: 10px;  
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
    text-align: center;
    color: white;  
    background-color: gray;  
}
table, th, td {
    height: 20px;
        border: 1px solid black;
        border-collapse: collapse;
    }
.inline{   
        display: inline-block;   
        float: right;   
        margin: 20px 0px;   
    }   
    input, button{   
        height: 34px;   
    }   
  
    .pagination {   
        display: inline-block;   
    background-color: red;
    margin-top:0px;
    }   
    .pagination a {   
        font-weight:bold;   
        font-size:18px;   
        color: black;   
        float: left;   
        padding: 8px 16px;   
        text-decoration: none;   
        border:1px solid black;   
    }   
    .pagination a.active {   
            background-color: pink;   
    }   
    .pagination a:hover:not(.active) {   
        background-color: skyblue;   
    } 
button {
    float:right;
  background-color: #4CAF50; 
  margin-top: 40px;
  border: none;
  color: white;
  padding: 0px 32px;
  height:6%;
  margin-right:50px ;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 18px;
  cursor: pointer;
}
button:hover {
  opacity: 0.8;
}
.logo {
	float: left;
}
.logo img {
	width: 50%;
    margin-left: 10px;
	padding: 15px 0px;
}
  
</style>
</head>
<header>
<button onclick="goBack()">Go Back</button>
<div class="logo">
     <img src="../images/logo1.png" alt="logo">
</div>
<script>
function goBack() {
  window.history.back();
}
</script>
<body>
<div class="container">
<table>
<tr>
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
					<td><a href="../post/post.php?id=<?php echo $data['Id']; ?>"><?php echo $data['title'];?></a></td>
					<td>

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
      <?php  
        $query = "SELECT COUNT(*) FROM post";     
        $rs_result = mysqli_query($conn, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";   ?>    
        <div class="pagination">
        <?php
        if($page>=2){   
            echo "<a href='home.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='home.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='home.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='home.php?page=".($page+1)."'>  Next </a>";   
        }   
  
      ?>    
      </div> 
</div>
</body>
</header>
</html>