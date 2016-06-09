<?php
  // include function files for this application
  require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user();

  $update=trim($_POST['update']);
  $update=sql_santize($update);
  $update=html_sanitize($update);
  $username = $_SESSION['valid_user'];
    try {
    
    if (!filled_out($_POST)) {
      echo '<br />';
      throw new Exception('You have not filled out the update. Please go back and try again.');
    }
  // connect to db
  $conn = db_connect();
  $result = $conn->query("insert into updates values
                         ('".$username."', NOW(), '".$update."')");

  echo '<br />';
  echo 'New Update:';
  echo '<br />';
  echo $update;

   
  mysqli_close($conn);
  }       
    catch (Exception $e) {
    echo $e->getMessage();
  }
display_user_menu();

do_html_footer();
?>
  