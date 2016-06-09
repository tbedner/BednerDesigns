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
	<div id="leftnav"><a href="idsearch.php">Search</a></div><div id="rightnav"><a href="idadd_book.php">Friends</a></div>
</div> 
<div id="content"> 
	<ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li> 
	</ul> 
	<ul class="pageitem"><li class="textbox"> 

   Contact Us<br /><br />
   
                <form action="iduser_feedback.php" method="post"> 
                 <ul class="pageitem">
                 <li class="form"><input name="name" placeholder="Name" type="text"  value="
<?php 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  echo $fname.' '.$lname;
     mysqli_close($conn);
?>
" /></li>
                 <li class="form"><input name="email" placeholder="Email" type="text" value="
<?php 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $email = $row->email;
  echo $email;
     mysqli_close($conn);
?>
" /></li>
                 <li class="textbox">Message<textarea name="feedback"></textarea></li>
                 <label for="verify">Verification<br />Enter the phrase below:<br />
                 </label>
                 <li class="form"><img src="captcha.php" alt="Verification pass-phrase" /></li>
                 <li class="form"><input type="text" placeholder="Verification phrase" id="verify" name="verify" /></li>
                 <li class="form"><input name="submit" type="submit" value="Send Message" /></li>
                 </ul> 
                </form> 
    </ul><ul class="pageitem"> 
<?php
do_idmypage_mainmenu();
do_idad();
do_idmypage_menu();
?>
	
</div> 
<div id="footer">
   <a href="idcontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idpolicy.php">Privacy Policy</b></a></p>
   &copy; 2009 cellme.mobi</p> 
	<a href="http://iwebkit.net">Powered by iWebKit</a></div> 
<script src="m-analytics.js" type="text/javascript"></script> 
 
</body> 
 
</html> 
