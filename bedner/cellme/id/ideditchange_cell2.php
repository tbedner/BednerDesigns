<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
 
  $new_cell = trim($_POST['new_cell']);
  $new_cell = html_sanitize($new_cell);
  $new_cell = sql_sanitize($new_cell);

    if (!filled_out($_POST)) {

header("Location: ideditchange_cell.php?cell=false");
exit;
    }
    if (!validatePhone($new_cell)) {
header("Location: ideditchange_cell.php?cell=false");
exit;    }

    // attempt update
$new_cell2 = preg_replace('/[\(\)\-\s]/', '',$new_cell);
$new_cell2 = ereg_replace('[^0-9]', '', $new_cell2);
    // attempt update
    change_cell($_SESSION['valid_user'], $new_cell2);

header("Location: ideditchange_cell.php?cell=true");
?>