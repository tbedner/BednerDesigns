<?php
  require_once("mycell_fns.php");
 
do_html_header('cellme.mobi');
do_ad();
  // creating short variable name
  $username = $_POST['username'];
  $username=sql_sanitize($username);
  $username=html_sanitize($username);
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username ='".$username."'");
  $num_row1 = $result->num_rows;
  mysqli_close($conn);
 
  try {
    if ($num_row1 !== 1) {
      throw new Exception('Username not recognized.');
    }
    $password = reset_password($username);
    notify_password($username, $password);
    echo 'Your new password has been emailed to you.<br /><br />';
  }
  catch (Exception $e) {
    echo 'Your password could not be reset - please try again later.<br /><br />';
        echo $e->getMessage();
  }
echo '<br /><br />';  
do_ad();
do_html_indexfooter();

?>
