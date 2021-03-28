<?php
$server="localhost";
$username="Charvit";
$password="Ch@rvit08";
$database="forum";

$conn = mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo "error:".mysqli_connect_error($conn);
}
?>
