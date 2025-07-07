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

          <div id="search-bar">
            <label>Search :</label>
            <input type="text" id="search" autocomplete="off">
          </div>
        </td>
      </tr>
      <tr>
        <td id="table-form">
          <form id="addForm">
            First Name : <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Last Name : <input type="text" id="lname">
            <input type="submit" id="save-button" value="Save">
          </form>
        </td>
      </tr>
      <tr>
        <td id="table-data">
        </td>
      </tr>
    </table>
    <div id="error-message"></div>
    <div id="success-message"></div>
    <div id="modal">
      <div id="modal-form">
        <h2>Edit Form</h2>
        <table cellpadding="10px" width="100%">
          
        </table>
        <div id="close-btn">X</div>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
      $(document).ready(function(e) {
        function tabledata() {
          $.ajax({
            url: "ajax-load.php",
            type: "POST",
            success: function(data) {
              $("#table-data").html(data);
            }
          });
        }
        tabledata();


        $('#addForm').on('submit', function(e) {
          e.preventDefault(); // ✅ Now 'e' is defined
          let fname = $('#fname').val().trim();
          let lname = $('#lname').val().trim();

          if (fname === "" || lname === "") {
            alert("Both fields are required.");
            return;
          }

          $.ajax({
            url: "ajax-insert.php",
            type: "POST",
            data: {
              first_name: fname,
              last_name: lname
            },
            success: function(data) {
              if (data == 1) {
                tabledata(); // Refresh table
                $('#addForm')[0].reset(); // Clear form
                $('#success-message').text("Record saved successfully!").fadeIn().delay(2000).fadeOut();
              } else {
                $('#error-message').text("Cannot save record").fadeIn().delay(2000).fadeOut();
              }
            }
          });
        });

        $(document).on('click', '.delete-btn', function() {
          if (confirm("Do you really want to delete this record?")) {
            let studentId = $(this).data('id');
            let element = this;
            $.ajax({
              url: 'ajax-delete.php',
              type: 'POST',
              data: {
                stu_id: studentId
              },
              success: function(data) {
                if (data == 1) {
                  $(element).closest('tr').fadeOut();
                  $('#success-message').text('Successfully Deleted Record').fadeIn().delay(2000).fadeOut();
                } else {
                  $('#error-message').text('Failed to Delete Record').fadeIn().delay(2000).fadeOut();
                }
              }
            });
          }

        });
        $(document).on('click', '.edit-btn', function() {
          let student_id = $(this).data('eid');
          $('#modal').show();
          $.ajax({
            url: 'ajax-update.php',
            type: 'POST',
            data: {
              id : student_id 
            },
            success: function(data){
              $('#modal-form table').html(data);
            }
          });
        });

        $('#close-btn').on('click', function() {
          $('#modal').hide();
        })

        $(document).on('click', '#edit-submit', function(e) {
          e.preventDefault();
          let sid = $('#edit-id').val();
          let fname = $('#edit-fname').val();
          let lname = $('#edit-lname').val();
          $.ajax({
            url: "update-data.php",
            type: "POST",
            data: {
              id : sid,
              first_name : fname,
              last_name : lname
            },
            success: function(data) {
              if(data == 1){
                $('#modal').hide();
                $('#success-message').text("Successfully Updated Data!").fadeIn().delay(2000).fadeOut();
                tabledata();

              } else {
                $('#error-message').text("Failed to Update Data!").fadeIn().delay(2000).fadeOut();
              }
            }
          });
        });
        $('#search').on('keyup', function() {
          let search_term = $(this).val();

          $.ajax({
            url: "live-search.php",
            type: "POST",
            data: {
              search : search_term
            },
            success: function(data) {
                $('#table-data').html(data);
            }
          });
        });
      });
    </script>
  </body>

  </html>