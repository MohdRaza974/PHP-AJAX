<?php 
$conn = mysqli_connect("localhost", "root", "", "php-ajax") or die('Connection Failed!');

$search_term = $_POST['search'];

$sql = "SELECT * FROM students WHERE first_name LIKE '%{$search_term}%' or last_name LIKE '%{$search_term}%'";

$result = mysqli_query($conn, $sql) or die('Query Failed!');
if(mysqli_num_rows($result) > 0) {
  $sr_num = 1;

  $output = "
  <table cellspacing = '0' cellpadding='10px' border='1' width='100%'>
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th style='width: 90px;'>Edit</th>
    <th style='width: 90px;'>Delete</th>
    </tr>
  ";
  while($row = mysqli_fetch_assoc($result)){
    $output .= "
    <tr style='text-align:center;'>
    <td>{$sr_num}</td>
    <td>{$row['first_name']} {$row['last_name']}</td>
    <td><button class='edit-btn' data-eid='{$row['id']}'>Edit</button></td>
    <td><button class='delete-btn' data-id='{$row['id']}'>Delete</button></td>
    </tr>
    ";
    $sr_num++;
  }
  $output .= "
  </table>
  ";
  mysqli_close($conn);
  echo $output;
}
?>