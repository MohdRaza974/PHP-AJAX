<?php 
$conn = mysqli_connect("localhost", "root", "", "php-ajax");

$sql = "SELECT * FROM students";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
  $output = "
  <table cellspacing = '0' cellpadding='10px' border='1' width='100%'>
  <tr>
    <th>Id</th>
    <th>Name</th>
    </tr>
  ";
  while($row = mysqli_fetch_assoc($result)){
    $output .= "
    <tr>
    <td>{$row["id"]}</td>
    <td>{$row["first_name"]} {$row["last_name"]}</td>
    </tr>
    " ;
  }
  $output .= "
  </table>
  ";
  mysqli_close($conn);
  echo $output;
}
?>