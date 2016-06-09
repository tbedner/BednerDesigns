<?php

 require_once('../mycell_fns.php');
 session_start();
  $fname=trim($_POST['fname']);
  $fname=sql_sanitize($fname);
  $fname=html_sanitize($fname);
  $lname=trim($_POST['lname']);
  $lname=sql_sanitize($lname);
  $lname=html_sanitize($lname);
  $cell=trim($_POST['cell']);
if (!validatePhone($cell)) {exit;}
  $city=trim($_POST['city']);
  $city=sql_sanitize($city);
  $city=html_sanitize($city);
  $usermode=trim($_POST['usermode']);
if (!validate_type($usermode)) {exit;}
  $photo='photo_default.jpg';
  $ent_id=$fname.$lname;
$cell2 = preg_replace('/[\(\)\-\s]/', '',$cell);
  

  $username = $_SESSION['valid_user'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
<meta content="yes" name="apple-mobile-web-app-capable" /> 
<meta content="index,follow" name="robots" /> 
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" /> 
<link href="images/cellme.png" rel="apple-touch-icon" /> 
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
	<div id="leftnav"><a href="idadd_newentry.php">Add Entry</a></div><div id="rightnav"><a href="idadd_book.php">Friends</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem"><li class="textbox"> 
<?php
idcheck_valid_user2();

   try {
    
    if (!filled_out($_POST)) {
      echo '<br />';
      throw new Exception('You have not filled out the form completely. Please try again.<br /><br /><a href="idadd_newentry.php">Add New Entry</a>');

    }
?>
<h4>Entry Added</h4>
<?php



 
  // connect to db
  $conn = db_connect();
  $result = $conn->query("insert into add_book values
                         ('".$username."', '".$ent_id."', '".$fname."', '".$lname."', '".$city."', '".$cell2."', '".$photo."', '".$usermode."')");

  echo '<br />';
  echo 'New Entry:';
  echo '<br />';
  echo '<br />';
    if ($usermode == 'personal'){
    if ($photo !== 'photo_default.jpg' ) {
      echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';
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
}    else  {
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
  } }
elseif ($usermode == 'business'){
    if ($photo !== 'photo_default.jpg' ) {
      echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';
      echo $fname.', '.$lname;
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
}    else  {
      echo $fname.', '.$lname;
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
  } }
  mysqli_close($conn);
  }
    catch (Exception $e) {
    echo $e->getMessage();
  }
?>
<br /><br />
 </ul>
 	<ul class="pageitem">  
		<li class="menu"><a href="idsearch.php"> 
		<img alt="Search" src="thumbs/idusersearch.png" /><span class="name">Search</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idadd_book.php"> 
		<img alt="Friends" src="thumbs/addbook.png" /><span class="name">Friends</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idemail.php"> 
		<img alt="Inbox" src="thumbs/mail.png" /><span class="name">Inbox<?php new_mail2(); ?></span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idupdate.php"> 
		<img alt="Updates" src="thumbs/update.png" /><span class="name">Updates</span><span class="arrow"></span></a></li> 
 </ul>
             
              
<?php
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
