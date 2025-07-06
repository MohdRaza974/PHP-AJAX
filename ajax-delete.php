<?php 
$conn = mysqli_connect("localhost", "root", "", "php-ajax") or die('Connection Failed!');

$studentId = $_POST['stu_id'];

$sql = "DELETE FROM students WHERE id = {$studentId}";

$result = mysqli_query($conn, $sql) or die('Query Failed!');
if($result){
    echo 1;
} else {
    echo 0;
}

mysqli_close($conn);
?>