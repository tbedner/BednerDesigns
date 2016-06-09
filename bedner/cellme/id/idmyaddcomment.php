<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
$userid = $_POST['userid'];
  if (strlen($userid) > 16){
  exit;
  }
$timeid = $_POST['timeid'];
  if (strlen($timeid) > 19){
  exit;
  }
  $userid=sql_sanitize($userid);
  $userid=html_sanitize($userid);
  $timeid=sql_sanitize($timeid);
  $timeid=html_sanitize($timeid);
  $fname=trim($_POST['fname']);
  $fname=sql_sanitize($fname);
  $fname=html_sanitize($fname);
  $lname=trim($_POST['lname']);
  $lname=sql_sanitize($lname);
  $lname=html_sanitize($lname);
  $comment = trim($_POST['comment']);
  $comment = sql_sanitize($comment);
  $comment = html_sanitize($comment);
  $username = $_SESSION['valid_user'];
if (empty($_POST['comment'])) {

 header("Location: idmyupdate.php?sent=problem");
exit;

}

  $conn = db_connect();
  $result = $conn->query("insert into comments values
                         ('".$userid."', '".$timeid."', NOW(), '".$fname."', '".$lname."', '".$comment."')");
if ($userid !== $username) {
  $result = $conn->query("select * from user
                            where username = '".$userid."'");
  $row=$result->fetch_object();
  $fname2 = $row->fname;
  $lname2 = $row->lname;
  $email = $row->email;
 

$toaddress = $email;

$subject = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Comment';

$mailcontent = $fname2.' '.$lname2.' has commented on your update:\n\n'.$comment;

$fromaddress = 'From: service@cellme.mobi';     
     //invoke mail() function to send mail
  $result = $conn->query("INSERT INTO email values ('', '".$userid."', '".$username."', '".$subject."', '".$mailcontent."', NOW(), 'unread')");
  $result = $conn->query("INSERT INTO sent values ('', '".$userid."', '".$username."', '".$subject."', '".$mailcontent."', NOW(), 'unread')");
header("Location: idmyupdate.php?add=true");
mail($toaddress, $subject, $mailcontent, $fromaddress);
}
else {
header("Location: idmyupdate.php?add=true");}
?>
