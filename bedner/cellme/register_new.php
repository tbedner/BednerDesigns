<?php
  // include function files for this application
  require_once('mycell_fns.php');

  //create short variable names
  $fname=trim($_POST['fname']);
  $fname=sql_sanitize($fname);
  $fname=html_sanitize($fname);
  $fname=ucwords($fname);
  $lname=trim($_POST['lname']);
  $lname=sql_sanitize($lname);
  $lname=html_sanitize($lname);
  $lname=ucwords($lname);
  $cell=trim($_POST['cell']);
  $city=trim($_POST['city']);
  $city=sql_sanitize($city);
  $city=html_sanitize($city);
  $city=ucwords($city);
  $email=trim($_POST['email']);
  $username=trim($_POST['username']);
  $username=sql_sanitize($username);
  $username=html_sanitize($username);
  $passwd=trim($_POST['passwd']);
  $passwd2=trim($_POST['passwd2']);
  $usermode='personal';
if (!validate_type($usermode)) {exit;}  
  $displaymode=trim($_POST['display']);
if (!validate_display($displaymode)) {exit;}  
  $photo='photo_default.jpg';
  $user_pass_phrase = SHA1($_POST['verify']);
  $user_pass_phrase=sql_sanitize($user_pass_phrase);
  $user_pass_phrase=html_sanitize($user_pass_phrase);
    
  // start session which may be needed later
  // start it now because it must go before headers
  session_start();
  try   {
    // check forms filled in
    if ($_SESSION['pass_phrase'] !== $user_pass_phrase) {
       throw new Exception('Problem<br />Please enter the verification pass-phrase exactly as shown.');
       }
    if (!filled_out($_POST)) {
      throw new Exception('Problem<br />You have not filled the form out completely - please go back and try again.');
    }
    if (!validatePhone($cell)) {
      throw new Exception('Problem<br />That is not a valid cell number. Please go back and try again.');
    }
    // email address not valid
    if (!valid_email($email)) {
      throw new Exception('Problem<br />That is not a valid email address.  Please go back and try again.');
    }

    // passwords not the same
    if ($passwd != $passwd2) {
      throw new Exception('Problem<br />The passwords you entered do not match - please go back and try again.');
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
      throw new Exception('Problem<br />Your password must be between 6 and 16 characters Please go back and try again.');
    }
$new_cell = preg_replace('/[\(\)\-\s]/', '',$cell);
    // attempt to register
    // this function can also throw an exception
    register($fname, $lname, $new_cell, $city, $username, $email, $passwd, $usermode, $displaymode, $photo);
    // register session variable
    $_SESSION['valid_user'] = $username;

    // provide link to members page
    do_html_mypageheader('Registration successful');
    echo '<br />Your registration was successful.  Go to your page using the link below to start setting up your address book!<br />';
    echo '<br /><a href="member.php">My Page<br /><br /></a>';
    display_user_menu();
    do_html_footer();

  }
  catch (Exception $e) {
     do_html_header('Problem:');
     echo $e->getMessage();
     do_html_indexfooter();
     exit;
  }
?>
