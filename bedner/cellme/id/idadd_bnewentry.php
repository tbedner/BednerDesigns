<?php

 require_once('../mycell_fns.php');
 session_start();


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
?>

<h4>New Entry</h4>
 <p class="header">

  <div id="note">
  **Note - These entries will not receive automatic updates.
  </div> 	
    <form method="post" action="idadd_new.php">
<input type="hidden" name="usermode" value="business"/>
<li class="form"><input placeholder="Business Name" name="fname" type="text" /></li>
<li class="form"><input placeholder="Contact Name" name="lname" type="text" /></li>
<li class="form"><input placeholder="Cell Phone" name="cell" type="text" /></li>
<li class="form"><input placeholder="City/State" name="city" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Add Entry" /></li>
<input type="hidden" value="1" name="go"/>
   <li class="menu"><span class="name2"><a href="idadd_newentry.php">Personal Entries</a></span></li>
  </div>
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
