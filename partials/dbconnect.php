<?php
$server="localhost:3307";
$username="sm";
$password="smit95109";
$database="forum";

$conn = mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo "error:".mysqli_connect_error($conn);
}
?>
