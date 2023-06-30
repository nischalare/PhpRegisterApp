<?php
require_once('config.php');
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Registration | PHP</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>
  <div>
    <?php
    if (isset($_POST['create'])) {
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $phonenumber = $_POST['phonenumber'];
      $password = $_POST['password'];

      $sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password) VALUES(?,?,?,?,?)";
      $stmtinsert = $db->prepare($sql);
      $result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $password]);
      if ($result) {
        echo 'Successfully Saved.';
      } else {
        echo 'There were errors while saving the data';
      }
    }
    ?>
  </div>

  <div style="margin:50px 0px 0px 650px;">
    <form action="registration.php" method="post">
      <div class="row">
        <div class="col-sm-3">
          <h1>Registration</h1>
          <p>Fill up the form with correct values.</p>
          <hr class="mb-3">
          <label for="firstname"><b>First Name</b></label>
          <input class="form-control" id="firstname" type="text" name="firstname" required>

          <label for="lastname"><b>Last Name</b></label>
          <input class="form-control" id="lastname" type="text" name="lastname" required>

          <label for="email"><b>Email</b></label>
          <input class="form-control" id="email" type="eamil" name="email" required>

          <label for="phonenumber"><b>Phone Number</b></label>
          <input class="form-control" id="phonenumber" type="text" name="phonenumber" required>

          <label for="password"><b>Password</b></label>
          <input class="form-control" id="password" type="password" name="password" required>

          <hr class="mb-3">
          <input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up">
        </div>
      </div>

    </form>
  </div>

 



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
   

      $(function () {
        $('#register').click(function(e){

          var valid = this.form.checkValidity();

          if (valid) {
          

          var firstname = $('#firstname').val();
          var lastname = $('#lastname').val();
          var email = $('#email').val();
          var phonenumber = $('#phonenumber').val();
          var password = $('#password').val();

          e.preventDefault();

          $.ajax({
            type: 'POST',
            url: 'process.php',
            data: { firstname: firstname, lastname: lastname, email: email, phonenumber: phonenumber, password: password },
            success: function (data) {
              Swal.fire({
                icon: 'success',
                title: 'Successful',
                text: 'Successfully Registered!',
                footer: '<a href="http://localhost/phpmyadmin/">Check Here To Check In Database</a>'
              })

            },
            error: function (data) {
              Swal.fire({
                icon: 'error',
                title: 'Errors',
                text: 'There Were Errors While Saving The Data!',
                footer: '<a href="https://stackoverflow.com/questions/17946150/apache-is-not-running-from-xampp-control-panel-error-apache-shutdown-unexpect">Why do I have this issue?</a>'
              })
            },
          });

        } else {

        }
        });
   


    })

  </script>
</body>

</html>