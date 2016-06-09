<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
 
  $email = trim($_POST['new_email']);
  $email = sql_sanitize($email);
  $email = html_sanitize($email);

    if (!filled_out($_POST) || !valid_email($email)) {

header("Location: ideditchange_email.php?email=false");
exit;
    }
    // attempt update
    change_email($_SESSION['valid_user'], $email);

header("Location: ideditchange_email.php?email=true");
?>