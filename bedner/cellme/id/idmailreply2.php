<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
$to = $_POST['to'];
$to = sql_sanitize($to);
$to = html_sanitize($to);
$from = $_SESSION['valid_user'];
$sub = $_POST['subject'];
$sub = sql_sanitize($sub);
$sub = html_sanitize($sub);
$msg = $_POST['mail'];
$msg = sql_sanitize($msg);
$msg = html_sanitize($msg);
  $conn = db_connect();
  $result = $conn->query("INSERT INTO email values ('', '".$to."', '".$from."', '".$sub."', '".$msg."', NOW(), 'unread')");
  $result = $conn->query("INSERT INTO sent values ('', '".$to."', '".$from."', '".$sub."', '".$msg."', NOW(), 'unread')");
  mysqli_close($conn);
 header("Location: idemail.php?sent=true");
?>