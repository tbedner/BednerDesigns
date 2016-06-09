<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
 
  $new_fname = trim($_POST['new_fname']);
  $new_fname = html_sanitize($new_fname);
  $new_fname = sql_sanitize($new_fname);
  $new_fname = ucwords($new_fname);
  $new_lname = trim($_POST['new_lname']);
  $new_lname = html_sanitize($new_lname);
  $new_lname = sql_sanitize($new_lname);
  $new_lname = ucwords($new_lname);

    if (!filled_out($_POST)) {
header("Location: ideditchange_name.php?name=problem");
exit;
    }
    else {
    // attempt update
    change_name($_SESSION['valid_user'], $new_fname, $new_lname);

header("Location: ideditchange_name.php?name=true");
}
?>