<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>PHP & Ajax CRUD</h1>
        <input type="button" id="load-data" value="load data">

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  

<script type="text/javascript" src="js/jquery.js"></script>

<script>
    $(document).ready(function() {
        $('#load-data').on('click', function(e) {
            $.ajax ({
                url: 'ajax-load.php',
                type: 'POST',
                success: function(data) {
                    $('#table-data').html(data);
                },
            });
        });
        
    });
</script>