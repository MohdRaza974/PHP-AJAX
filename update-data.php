<?php 
$conn = mysqli_connect("localhost", "root", "", "php-ajax") or die('Connection Failed!');

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$sql = "UPDATE students SET first_name='{$first_name}', last_name='{$last_name}' WHERE id = {$id}";

$result = mysqli_query($conn, $sql) or die('Query Failed!');
if($result){
    echo 1;
} else {
    echo 0;
}

mysqli_close($conn);
?>