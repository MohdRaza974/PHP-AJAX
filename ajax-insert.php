<?php 
$conn = mysqli_connect("localhost", "root", "", "php-ajax");

$first_n = $_POST['first_name'];
$last_n = $_POST['last_name'];


$sql = "INSERT INTO students(first_name, last_name) VALUES ('{$first_n}', '{$last_n}')";

$result = mysqli_query($conn, $sql);
if($result){
    echo 1;
} else {
    echo 0;
}

mysqli_close($conn);
?>