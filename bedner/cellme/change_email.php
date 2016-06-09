<?php
  require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
  // create short variable names
  $new_email = trim($_POST['new_email']);
  $new_email = sql_sanitize($new_email);
  $new_email = html_sanitize($new_email);
  
  try {
    check_valid_user();
    if (!filled_out($_POST) || !valid_email($new_email)) {
      throw new Exception('Please check your email address and try again.');
    }

    
    // attempt update
    change_email($_SESSION['valid_user'], $new_email);
    echo 'Email changed to '.$new_email;
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
  do_html_footer();
?>
