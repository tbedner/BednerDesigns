<?php
// include function files for this application
require_once('mycell_fns.php');
session_start();
$id=$_GET['id'];
$date=$_GET['date'];

$substr1 = substr($date, 0, 10);
$substr2 = substr($date, 10);
$date = $substr1.' '.$substr2;

  $conn = db_connect();
  $result = $conn->query("SELECT * FROM updates
                            WHERE datetime = '".$date."' AND up_username = '".$id."'");
  $row=$result->fetch_object();
  $lname = $row->lname;
 $result = $conn->query("DELETE FROM updates WHERE datetime = '".$date."' AND up_username = '".$id."'");
  mysqli_close($conn);

header("Location: idmyupdate.php?deleteu=true");
?>