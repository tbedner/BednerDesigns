<?php
  require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();

  // create short variable names
  $new_city = trim($_POST['new_city']);
  $new_city = html_sanitize($new_city);
  $new_city = sql_sanitize($new_city);
  $new_city = ucwords($new_city);
 
  try {
    check_valid_user();
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled out the form completely. Please try again.');
    }


    // attempt update
    change_city($_SESSION['valid_user'], $new_city);
    echo 'City changed. Click MyPage to refresh this page.';
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
    do_html_footer();
?>
