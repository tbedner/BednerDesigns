<?php
// include function files for this application
require_once('mycell_fns.php');
session_start();
 
$userid = $_POST['userid'];
$timeid = $_POST['timeid'];


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$comment = $_POST['comment'];
if (empty($_POST['comment'])) {

 header("Location: update.php?sent=problem");
exit;

}
  $conn = db_connect();
  $result = $conn->query("insert into comments values
                         ('".$userid."', '".$timeid."', NOW(), '".$fname."', '".$lname."', '".$comment."')");
$timeid = str_replace(' ', '', $timeid);
header("Location: update.php?addc=true");
?>
