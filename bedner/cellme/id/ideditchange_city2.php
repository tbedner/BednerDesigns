<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
 
  $new_city = trim($_POST['new_city']);
  $new_city = html_sanitize($new_city);
  $new_city = sql_sanitize($new_city);
  $new_city = ucwords($new_city);

    if (!filled_out($_POST)) {

header("Location: ideditchange_city.php?city=false");
exit;
    }
    else{
    // attempt update
    change_city($_SESSION['valid_user'], $new_city);

header("Location: ideditchange_city.php?city=true");
}
?>