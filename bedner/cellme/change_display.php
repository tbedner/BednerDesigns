<?php
  require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();

  // create short variable names
  $new_displaymode = trim($_POST['new_displaymode']);
  $new_displaymode = sql_sanitize($new_displaymode);
  $new_displaymode = html_sanitize($new_displaymode);
if (isset($_POST['new_displaymode']))  {
if (!validate_display($new_displaymode))
{exit;}
} 
  try {
    check_valid_user();
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled out the form completely. Please try again.');
    }


    // attempt update
    change_displaymode($_SESSION['valid_user'], $new_displaymode);
    echo 'Display setting changed to '.$new_displaymode;
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
    do_html_footer();
?>
