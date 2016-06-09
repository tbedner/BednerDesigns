<?php

// include function files for this application
require_once('mycell_fns.php');
session_start();
$old_user = $_SESSION['valid_user'];

// store  to test if they *were* logged in
unset($_SESSION['valid_user']);
$result_dest = session_destroy();

// start output html
do_pcindex_top();


if (!empty($old_user)) {
  if ($result_dest)  {
    // if they were logged in and are now logged out
     
    echo 'Logged out.<br /><br />';
  
  } else {
   // they were logged in and could not be logged out
    
    echo 'Could not log you out.<br /><br />';
  }
} else {
  // if they weren't logged in but came to this page somehow
  
  echo 'You were not logged in, and so have not been logged out.<br /><br />';

  
}
?>

                  <h2>Cellme is a cellular network helping you to find and connect to your mobile friends</h2> 
                  <br />
                  <a href="pcregister.php"><img class="button" src="images/join.jpg" alt="Join Now for Free" /></a><br /><br />
                  Find cell phone numbers in our online directory.<br /><br />
                  Stay in touch with friends via email or updates.<br /><br />
                  Keep your cell number private. You have 100% control.<br /><br />
                  Update your new number with all of your friends with a single change.<br /><br />
                  Designed for easy access from your cell phone.<br /><br /><br />
                  
                  <a href="pcabout.php">Why else should you join? Click here to learn more about our free services!</a><br />
<br /><br /><br /><br />
<?php
do_pcindex_bottom();

?>
