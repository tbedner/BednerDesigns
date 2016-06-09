<?php
  require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();

  // create short variable names
  $new_fname = trim($_POST['new_fname']);
  $new_fname = html_sanitize($new_fname);
  $new_fname = sql_sanitize($new_fname);
  $new_fname = ucwords($new_fname);
  $new_lname = trim($_POST['new_lname']);
  $new_lname = html_sanitize($new_lname);
  $new_lname = sql_sanitize($new_lname);
  $new_lname = ucwords($new_lname);
  
  try {
    check_valid_user();
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled out the form completely. Please try again.');
    }


    // attempt update
    change_name($_SESSION['valid_user'], $new_fname, $new_lname);
    echo 'Name(s) changed.';
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
  do_html_footer();
?>
