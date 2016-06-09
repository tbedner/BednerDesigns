<?php
  require_once('mycell_fns.php');
  session_start();
  do_html_mypageheader('cellme.mobi');

  // create short variable names
  $new_cell = trim($_POST['new_cell']);
  $new_cell = html_sanitize($new_cell);
  $new_cell = sql_sanitize($new_cell);
  
  try {
    check_valid_user();
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled out the form completely. Please try again.');
    }
    if (!validatePhone($new_cell)) {
      throw new Exception('Please check your number and try again.');
    }
$new_cell2 = preg_replace('/[\(\)\-\s]/', '',$new_cell);
$new_cell2 = ereg_replace('[^0-9]', '', $new_cell2);
    // attempt update
    change_cell($_SESSION['valid_user'], $new_cell2);
    echo 'Cell# changed. Click MyPage to refresh this page.';
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
  do_html_footer();
?>
