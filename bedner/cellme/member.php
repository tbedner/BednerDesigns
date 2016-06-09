<?php

// include function files for this application
require_once('mycell_fns.php');
session_start();

//create short variable names
$username = $_POST['username'];
$username = sql_sanitize($username);
$username = html_sanitize($username);
$password = $_POST['password'];
$password = sql_sanitize($password);
$password = html_sanitize($password);

if ($username && $password) {
// they have just tried logging in
  try  {
    login($username, $password);
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $username;
  }
  catch(Exception $e)  {
    // unsuccessful login
 do_html_header('Problem');
 do_ad();
    echo 'You could not be logged in.
          You must be logged in to view this page.
          Please check your username and password and try again.';
    do_ad();
    do_html_indexfooter();
    exit;
  }
}

do_html_mypageheader('cellme.mobi');
check_valid_user();




// give menu of options
display_user_menu();

do_html_footer();
?>
