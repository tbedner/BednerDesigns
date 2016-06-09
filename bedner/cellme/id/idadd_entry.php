<?php

 require_once('../mycell_fns.php');
 session_start();
  $username = $_SESSION['valid_user']; 
 $id = trim($_GET['id']);
  if (strlen($id) > 16){
  exit;
  }
  $id=sql_sanitize($id);
  $id=html_sanitize($id);
  
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
	<div id="leftnav"><a href="idemail.php">Inbox</a></div><div id="rightnav"><a href="idadd_book.php">Friends</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem"><li class="textbox"> 
<?php
idcheck_valid_user2();

  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '$id'");
  $row = $result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $usermode = $row->usermode;
  $email = $row->email;
  $conn2 = db_connect();
  $result2 = $conn2->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row2 = $result2->fetch_object();
  $fname2 = $row2->fname;
  $lname2 = $row2->lname;
  $city2 = $row2->city;
  $cell22 = $row2->cell;
  $photo2 = $row2->photo;
  $usermode2 = $row2->usermode;  
if ($id == $username){
echo 'Problem - You cannot add yourself as a cellmate. If you would like to store your own number, please use the Add Entries feature of your address book.<br /><br />';
}
else {  
  
  echo '<br />';
  echo 'New Entry Added to Your Address Book:';
  echo '<br />';
  echo '<br />';
    if ($photo !== 'photo_default.jpg' ) {
      echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
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
    echo '<br />';
    echo '<br />';
  } 
  
mysqli_close($conn);
mysqli_close($conn2);
  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat entry
  $result = $conn->query("select * from add_book
                         where username = '$valid_user' and ent_id='$id'");
  $num_row = $result->num_rows;
  if ($result && ($num_row>0)) {
    echo '<br />';
    echo 'Entry already exists.';
    echo '<br />';
    echo '<br />';

  }
  else {
$cell2 = preg_replace('/[\(\)\-\s]/', '',$cell);
  // insert the new entry
  $result = $conn->query("insert into add_book values
     ('".$valid_user."', '".$id."', '".$fname."', '".$lname."', '".$city."', '".$cell2."', '".$photo."', '".$usermode."')");
  $conn2 = db_connect();

  // check not a repeat entry
  $result2 = $conn2->query("select * from add_book
                         where username = '$id' and ent_id='$valid_user'");
  $num_row2 = $result2->num_rows;
  mysqli_close($conn2);
  if (!$result2 || ($num_row2 == 0)) {

// check for entry in other addbook ,insert and notify
  $result = $conn->query("insert into add_book values
     ('".$id."', '".$valid_user."', '".$fname2."', '".$lname2."', '".$city2."', '".$cell22."', '".$photo2."', '".$usermode2."')"); 
$toaddress = $email;

$subject = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Cellmate';

$mailcontent = $fname2.' '.$lname2.' has added you to their address book. Their information has also been added to yours. Thank you.\n';

$fromaddress = 'From: service@cellme.mobi';     
     //invoke mail() function to send mail
  $result = $conn->query("INSERT INTO email values ('', '".$id."', '".$valid_user."', '".$subject."', '".$mailcontent."', NOW(), 'unread')");
  $result = $conn->query("INSERT INTO sent values ('', '".$id."', '".$valid_user."', '".$subject."', '".$mailcontent."', NOW(), 'unread')");

mail($toaddress, $subject, $mailcontent, $fromaddress);
   }
   } 
mysqli_close($conn);
  }
?>

<h4>Personal Listings Search</h4>
 	
    <form action="idsearch_results.php" method="post">
    <input type="hidden" value="personal" name="list_type" />
<li class="form"><input placeholder="First Name" name="fname" type="text" /></li>
<li class="form"><input placeholder="Last Name" name="lname" type="text" /></li>
<li class="form"><input placeholder="City/State" name="city" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Search" /></li>
<input type="hidden" value="1" name="go"/>
  </div>
              </form>
 </ul>
 	<ul class="pageitem">  
		<li class="menu"><a href="idbsearch.php"> 
		<img alt="Search" src="thumbs/idusersearch.png" /><span class="name">Search Business Listings</span><span class="arrow"></span></a></li> 
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
