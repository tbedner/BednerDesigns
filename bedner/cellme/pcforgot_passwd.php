<?php
  require_once("mycell_fns.php");
 do_pcindex_top();
 

  // creating short variable name
  $username = $_POST['username'];
  $username=sql_sanitize($username);
  $username=html_sanitize($username);

  try {
    $password = reset_password($username);
    notify_password($username, $password);
    echo '<br /><br />Password Reset<br /><br /><br /><br />Your new password has been emailed to your address in your profile.<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
  }
  catch (Exception $e) {
    echo '<br /><br />Error<br /><br />Your password could not be reset - please try again later or contact us using the links above.<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
  }

 do_pcindex_bottom();
?>
