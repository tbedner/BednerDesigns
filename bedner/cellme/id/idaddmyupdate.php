<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
  $update=trim($_POST['update']);
  $username = $_SESSION['valid_user'];
  
if (isset($_POST['update'])) {
  $update=sql_sanitize($update);
  $update=html_sanitize($update);

  // connect to db
  $conn = db_connect();
  $result = $conn->query("insert into updates values
                         ('".$username."', NOW(), '".$update."')");
                           mysqli_close($conn);

header("Location: idmyupdate.php?add=true");
}
else {
 header("Location: idmyupdate.php?update=problem");
exit;
	
}
?>
