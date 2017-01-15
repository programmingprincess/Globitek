<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.
    // Perform Validations
    // Hint: Write these in private/validation_functions.php
    if(is_post_request()) {
      $fname = $_POST['f_name'];
      $lname = $_POST['l_name'];
      $email = $_POST['email'];
      $username = $_POST['username'];

      $errors = [];
      if(is_blank($fname))
        $errors[] = "First name cannot be blank.";
      elseif(!has_length($fname, ['min' => 2, 'max' => 255]))
        $errors[] = "First name must be between 2 and 255 characters.";

      if(is_blank($lname))
        $errors[] = "Last name cannot be blank.";
      elseif(!has_length($lname, ['min' => 2, 'max' => 255]))
        $errors[] = "Last name must be between 2 and 255 characters.";

      if(is_blank($username))
        $errors[] = "Username cannot be blank.";
      elseif(!has_length($username, ['min' => 8, 'max' => 255]))
        $errors[] = "Username must be at least 8 characters.";

      if(!has_valid_email_format($email))
        $errors[] = "Email address must be valid.";

      // if there were no errors, submit data to database
      if(empty($errors)) {
        // Write SQL INSERT statement
        $sql = "
        INSERT INTO globitek.users (first_name, last_name, email, username) values ('$fname', '$lname', '$email', '$username');";

        // For INSERT statments, $result is just true/false
        $result = db_query($db, $sql);

        if($result) {
          db_close($db);

        //   TODO redirect user to success page
          redirect_to('registration_success.php');

         } else {
           // The SQL INSERT statement failed.
           // Just show the error, not the form
           echo db_error($db);
           db_close($db);
           exit;
         }
      }
    }



?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div class = "container" id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
    echo display_errors($errors);
  ?>

  <!-- TODO: HTML form goes here -->
  <form action = "<?php echo h($_SERVER["PHP_SELF"]);?>" method = "post" autocomplete = "off">
    <label name = "f_name"> First name: </label>
    <input type = "text" name = "f_name" value = "<?php echo isset($_POST['f_name']) ? h($_POST['f_name']) : ''?>"/> <br><br>
    <label name = "f_name"> Last name: </label>
    <input type = "text" name = "l_name" value = "<?php echo isset($_POST['l_name']) ? h($_POST['l_name']) : ''?>"/> <br><br>
    <label name = "f_name"> Email: </label>
    <input type = "text" name = "email" value = "<?php echo isset($_POST['email']) ? h($_POST['email']) : ''?>"/> <br><br>
    <label name = "f_name"> Username: </label>
    <input type = "text" name = "username" value = "<?php echo isset($_POST['username']) ? h($_POST['username']) : ''?>"/> <br><br>

    <input name = "submit" type = "submit" class = "button" />

  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
