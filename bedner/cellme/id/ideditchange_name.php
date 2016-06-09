<?php

 require_once('../mycell_fns.php');
 session_start();
  $name = trim($_GET['name']);
if (isset($_GET['name']))  {
if (!validate_get($name))
{exit;}
}  
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username='".$_SESSION['valid_user']."'");
  $row = $result->fetch_object();
  $usermode = $row->usermode;
  $fname = $row->fname;
  $lname = $row->lname;
mysqli_close($conn); 
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
	<div id="leftnav"><a href="idedit.php">Edit</a></div><div id="rightnav"><a href="idadd_book.php">Friends</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem"><li class="textbox"> 
<?php
idcheck_valid_user2();
?>
<form action="ideditchange_name2.php" method="post">
<br />
<?php
if ($name == 'true') { echo '<center><font size="3" color="#F000F0">Name(s) Changed</font><br /></center>';}
if ($name == 'problem') { echo '<center><font size="3" color="#F000F0">Problem - Name(s) Not Changed<br /> Please fill out the form completely</font><br /></center>';}

  if ($usermode == 'personal') {
      echo '<br />Old First Name - ';
      echo $fname;
  	  echo '<li class="form"><input placeholder="New First Name" name="new_fname" type="text" /></li>';
  }  else  {
      echo '<br />Old Company Name - ';
  	  echo $fname;
  	  echo '<li class="form"><input placeholder="New Company Name" name="new_fname" type="text" /></li>';
  }
  if ($usermode == 'personal') {
      echo '<br />Old Last Name - ';
  	  echo $lname;
  	  echo '<li class="form"><input placeholder="New Last Name" name="new_lname" type="text" /></li>';
  }  else  {
      echo '<br />Old Contact Name - ';
  	  echo $lname;
  	  echo '<li class="form"><input placeholder="New Contact Name" name="new_lname" type="text" /></li>';
  } 
?>
<li class="form"><input id="mysubmit" type="submit" value="Change Names" /></li>
</form>
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