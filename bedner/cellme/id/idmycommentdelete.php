<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
  $id=trim($_GET['id']);
  if (strlen($id) > 16){
  exit;
  }
  $id=sql_sanitize($id);
  $date=trim($_GET['date']);
  if (strlen($date) > 19){
  exit;
  }
  $date=sql_sanitize($date);

$substr1 = substr($date, 0, 10);
$substr2 = substr($date, 10);
$date = $substr1.' '.$substr2;

  $conn = db_connect();
  $result = $conn->query("SELECT * FROM comments
                            WHERE datetime2 = '".$date."' AND lname = '".$id."'");
  $row=$result->fetch_object();
  $lname = $row->lname;
 $result = $conn->query("DELETE FROM comments WHERE datetime2 = '".$date."' AND lname = '".$lname."'");
  mysqli_close($conn);

header("Location: idmyupdate.php?deletec=true");
?>