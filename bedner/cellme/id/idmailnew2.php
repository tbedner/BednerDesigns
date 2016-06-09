<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
$to = $_POST['to'];
$to = sql_sanitize($to);
$to = html_sanitize($to);
$to2 = $_POST['to2'];
$to2 = sql_sanitize($to2);
$to2 = html_sanitize($to2);
$from = $_SESSION['valid_user'];
$sub = $_POST['subject'];
$sub = sql_sanitize($sub);
$sub = html_sanitize($sub);
$msg = $_POST['mail'];
$msg = sql_sanitize($msg);
$msg = html_sanitize($msg);

if (!filled_out($_POST) || (strlen($to2) > 16)) {
header("Location: idemail.php?sent=false2");
exit;
    }

if (empty($to2)) {
$name = explode(" ", $to);
$fname = $name[0];
$fname = ucwords($fname);
$lname = $name[1];
$lname = ucwords($lname);
  $conn = db_connect();
  $result = $conn->query("SELECT ent_id FROM add_book WHERE fname = '".$fname."' AND lname = '".$lname."' AND username = '".$_SESSION['valid_user']."'");

$num_row = $result->num_rows;
    
if ($numrows > 1) {
 header("Location: idemail.php?sent=problem");
exit;
}

  $row = $result->fetch_object();
  $to2 = $row->ent_id;
  mysqli_close($conn);

if (empty($to2)) {
 header("Location: idemail.php?sent=false");
exit;
}
  $conn = db_connect();
  $result = $conn->query("INSERT INTO email values ('', '".$to2."', '".$from."', '".$sub."', '".$msg."', NOW(), 'unread')");
  $result = $conn->query("INSERT INTO sent values ('', '".$to2."', '".$from."', '".$sub."', '".$msg."', NOW(), 'unread')");
  mysqli_close($conn);
 header("Location: idemail.php?sent=true");
 exit ;
 }
 else{
  $conn = db_connect();
  $result = $conn->query("INSERT INTO email values ('', '".$to2."', '".$from."', '".$sub."', '".$msg."', NOW(), 'unread')");
  $result = $conn->query("INSERT INTO sent values ('', '".$to2."', '".$from."', '".$sub."', '".$msg."', NOW(), 'unread')");
  mysqli_close($conn);
 header("Location: idemail.php?sent=true");
 } 
?>