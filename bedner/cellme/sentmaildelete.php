<?php
// include function files for this application
require_once('mycell_fns.php');
session_start();
$msgid2=sql_sanitize($_GET['msg']);

  $conn = db_connect();
  $result = $conn->query("select * from sent, user where sent.msgid = '".$msgid2."' and sent.from = user.username");     
  $num_row = $result->num_rows;
  $row = $result->fetch_object();
  $msgid = $row->msgid;
  if ($num_row == 1) { 
  $result = $conn->query("DELETE FROM sent WHERE msgid = '".$msgid."'");
  mysqli_close($conn);
header("Location: mailsent.php?delete=true");
}
else {
  mysqli_close($conn);
header("Location: mailsent.php?delete=false");
}
?>