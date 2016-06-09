<?php

 require_once('../mycell_fns.php');
 session_start();
 $type=trim($_POST['type']);
if (!validate_type($type)) {exit;}
 $letter=trim($_POST['letter']); 
if (!validate_letter($letter)) {exit;}
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
    $cell1 = $row->cell;

  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
<meta content="yes" name="apple-mobile-web-app-capable" /> 
<meta content="index,follow" name="robots" /> 
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" /> 
<link href="../images/cellme.png" rel="apple-touch-icon" /> 
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" />
 
<script src="javascript/functions.js" type="text/javascript"></script> 
<title>cellme.mobi
</title> 
<meta content="iPod,iPhone,free" name="keywords" /> 
<meta content="A Cellular Network where you can find friends' cell phone numbers" name="description" /> 
</head> 
 
<body> 
 
<div id="topbar"> <img alt="logo" src="images/logo.jpg" />
	<div id="title"> 
		 cellme</div>  
	<div id="leftnav"><a href="idemail.php">Inbox</a></div><div id="rightnav"><a href="idsearch.php">Search</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem"><li class="textbox"> 
<?php
idcheck_valid_user2();
if($type == 'personal'){
if($letter == 'a'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'personal' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Personal Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';

  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Personal Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'a%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'b%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'c%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'd%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'e%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'f%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'a%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'b%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'c%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'd%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'e%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'f%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'A%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'B%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'C%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'D%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'E%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'F%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'A%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'B%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'C%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'D%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'E%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'F%'and usermode = 'personal'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;
  if ($photo !== 'photo_default.jpg' ) {
                  echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';}
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<a href="iddelete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'"><img src="../images/pcdelete.jpg" alt="Delete Entry" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}
if($letter == 'g'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'personal' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Personal Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Personal Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'g%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'h%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'i%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'j%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'k%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'l%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'g%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'h%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'i%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'j%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'k%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'l%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'G%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'H%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'I%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'J%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'K%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'L%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'G%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'H%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'I%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'J%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'K%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'L%'and usermode = 'personal'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;

            if ($photo !== 'photo_default.jpg' ) {
                  echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';}
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<a href="iddelete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'"><img src="../images/pcdelete.jpg" alt="Delete Entry" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

if($letter == 'm'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'personal' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Personal Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Personal Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'm%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'n%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'o%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'p%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'q%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'r%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'm%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'n%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'o%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'p%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'q%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'r%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'M%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'N%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'O%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'P%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Q%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'R%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'M%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'N%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'O%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'P%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Q%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'R%'and usermode = 'personal'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;

            if ($photo !== 'photo_default.jpg' ) {
                  echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';}
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<a href="iddelete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'"><img src="../images/pcdelete.jpg" alt="Delete Entry" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

if($letter == 's'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'personal' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Personal Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Personal Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 's%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 't%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'u%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'v%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'w%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'x%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'y%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'z%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 's%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 't%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'u%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'v%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'w%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'x%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'y%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'z%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'S%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'T%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'U%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'V%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'W%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'X%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Y%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Z%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'S%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'T%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'U%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'V%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'W%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'X%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Y%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Z%'and usermode = 'personal'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;

            if ($photo !== 'photo_default.jpg' ) {
                  echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';}
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<a href="iddelete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'"><img src="../images/pcdelete.jpg" alt="Delete Entry" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

}

if($type == 'business'){
if($letter == 'a'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'business' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Business Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Business Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'a%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'b%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'c%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'd%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'e%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'f%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'a%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'b%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'c%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'd%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'e%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'f%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'A%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'B%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'C%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'D%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'E%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'F%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'A%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'B%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'C%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'D%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'E%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'F%'and usermode = 'business'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;
  if ($photo !== 'photo_default.jpg' ) {
                  echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';}
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<a href="iddelete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'"><img src="../images/pcdelete.jpg" alt="Delete Entry" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}
if($letter == 'g'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'business' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Business Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Business Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'g%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'h%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'i%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'j%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'k%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'l%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'g%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'h%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'i%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'j%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'k%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'l%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'G%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'H%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'I%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'J%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'K%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'L%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'G%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'H%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'I%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'J%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'K%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'L%'and usermode = 'business'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;

            if ($photo !== 'photo_default.jpg' ) {
                  echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';}
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<a href="iddelete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'"><img src="../images/pcdelete.jpg" alt="Delete Entry" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

if($letter == 'm'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'business' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Business Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Business Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'm%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'n%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'o%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'p%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'q%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'r%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'm%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'n%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'o%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'p%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'q%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'r%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'M%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'N%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'O%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'P%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Q%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'R%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'M%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'N%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'O%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'P%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Q%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'R%'and usermode = 'business'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;

            if ($photo !== 'photo_default.jpg' ) {
                  echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';}
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<a href="iddelete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'"><img src="../images/pcdelete.jpg" alt="Delete Entry" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

if($letter == 's'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'business' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Business Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Business Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 's%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 't%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'u%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'v%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'w%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'x%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'y%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'z%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 's%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 't%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'u%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'v%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'w%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'x%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'y%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'z%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'S%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'T%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'U%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'V%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'W%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'X%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Y%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Z%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'S%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'T%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'U%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'V%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'W%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'X%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Y%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Z%'and usermode = 'business'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br /><br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;

            if ($photo !== 'photo_default.jpg' ) {
                  echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';}
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<a href="iddelete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'"><img src="../images/pcdelete.jpg" alt="Delete Entry" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

} 
else {
?>

<h4>My Cellmates</h4>
 	
 <form action="idadd_book.php" method="post">
<li class="textbox">Listing Type</li>    
 <li class="form"><span class="choice"><span class="name">Personal</span><input type="radio" checked="checked" value="personal" name="type" /></span></li>
 <li class="form"><span class="choice"><span class="name">Business</span><input type="radio" value="business" name="type" /></span></li>
 <li class="textbox">Cellmate Records</li>
 <li class="form"><span class="choice"><span class="name">A-F </span><input type="radio" checked="checked" value="a" name="letter" /></span></li>
 <li class="form"><span class="choice"><span class="name">G-L </span><input type="radio" value="g" name="letter" /></span></li>
 <li class="form"><span class="choice"><span class="name">M-R </span><input type="radio" value="m" name="letter" /></span></li>
 <li class="form"><span class="choice"><span class="name">S-Z </span><input type="radio" value="s" name="letter" /></span></li>
 <li class="form"><input id="mysubmit" type="submit" value="Get Contacts" /></li>
</form>
<hr /> 
<?php

 
  echo '<div class="navbar3"><a href="idadd_newentry.php">Add New Personal Entry</a></div>';
  echo '<hr />';
  echo '<div class="navbar3"><a href="idadd_bnewentry.php">Add New Business Entry</a></div>';
  echo '<br />';

}
?>
 </ul>
 	<ul class="pageitem">  

             
              
<?php
do_idmypage_mainmenu();
do_idad();
do_idmypage_menu();
?>		
	</ul> 
	
</div> 
<?php
do_idmypage_footer();
?>
 
</body> 
 
</html>  


 




