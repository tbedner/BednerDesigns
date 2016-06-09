<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
$msgid2=sql_sanitize($_GET['msg']);

  $conn = db_connect();
  $result = $conn->query("select * from email, user where email.msgid = '".$msgid2."' and email.from = user.username");     
  $num_row = $result->num_rows;
  $row = $result->fetch_object();
  $msgid = $row->msgid;
  if ($num_row == 1) { 
  $result = $conn->query("DELETE FROM email WHERE msgid = '".$msgid."'");
  mysqli_close($conn);
header("Location: idemail.php?delete=true");
}
else {
  mysqli_close($conn);
header("Location: idemail.php?delete=false");
}
?>