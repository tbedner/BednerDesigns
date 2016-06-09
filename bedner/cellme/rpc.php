<?php
require_once('mycell_fns.php');
session_start();
// PHP5 Implementation – uses MySQLi. 
  $conn = db_connect(); 

  if(isset($_POST['queryString'])) {
   $queryString = $_POST['queryString'];
   $queryString = sql_sanitize($queryString);
   $queryString = html_sanitize($queryString);
   $queryString2 = ucwords($queryString);
   
   if(strlen($queryString) >0) {
  $result = $conn->query("SELECT username, ent_id, fname, lname FROM add_book WHERE fname LIKE '".$queryString2."%' AND username = '".$_SESSION['valid_user']."' OR lname LIKE '".$queryString2."%' AND username = '".$_SESSION['valid_user']."' LIMIT 10");

     while($row=$result->fetch_object()){
     $fname = $row->fname;
     $lname = $row->lname;
     $to2 = $row->ent_id;
     echo '<li onClick="fill(\''.$fname.' '.$lname.'\'); fill2(\''.$to2.'\');">'.$fname.' '.$lname.'</li>';
      }
   }
   }
?>