<?php 
$conn = mysqli_connect("localhost", "root", "", "php-ajax") or die('Connection Failed!');

$studentId = $_POST['id'];
$output = "";
$sql = "SELECT * FROM students WHERE id = {$studentId}";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)){
    $output .= "
    <tr>
          <td></td>
          <td><input type='hidden' id='edit-id' data-id value='{$row["id"]}'></td>
        </tr>
    <tr>
          <td>First Name:</td>
          <td><input type='text' id='edit-fname' data-fname value='{$row["first_name"]}'></td>
        </tr>
        <tr>
          <td>Last Name:</td>
          <td><input type='text' id='edit-lname' data-lname value='{$row["last_name"]}'></td>
        </tr>
        <tr>
          <td></td>
          <td><input type='submit' id='edit-submit' value='save'></td>
        </tr>
    ";
  }
  mysqli_close($conn);
  echo $output;
} else {
    echo "No Record Found";
}
?>