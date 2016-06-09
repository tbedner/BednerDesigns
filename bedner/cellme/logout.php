<?php

// include function files for this application
require_once('mycell_fns.php');
session_start();
$old_user = $_SESSION['valid_user'];

// store  to test if they *were* logged in
unset($_SESSION['valid_user']);
$result_dest = session_destroy();

// start output html
do_html_header('cellme.mobi - Logged Out');
do_ad();
if (!empty($old_user)) {
  if ($result_dest)  {
    // if they were logged in and are now logged out
     
    echo '<br />';
    echo '<br />';
    echo 'Logged out.<br />';
    echo '<br />';
    echo '<br />';
 
  } else {
   // they were logged in and could not be logged out
    
    echo '<br />';
    echo '<br />';
    echo 'Could not log you out.<br />';
    echo '<br />';
    echo '<br />';

  }
} else {
  // if they weren't logged in but came to this page somehow
  
  echo '<br />';
  echo '<br />';
  echo 'You were not logged in, and so have not been logged out.<br />';
    echo '<br />';
    echo '<br />';

  
}
 display_login_form();
do_ad();
do_html_indexfooter();

?>
