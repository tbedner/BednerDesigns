<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
$name = trim($_POST['to']);
$name = sql_sanitize($name);
$name = html_sanitize($name);
$email = trim($_POST['email']);
$email = sql_sanitize($email);
$email = html_sanitize($email);
$feedback = trim($_POST['feedback']);
$feedback = sql_sanitize($feedback);
$feedback = html_sanitize($feedback);
$user_pass_phrase = SHA1($_POST['verify']);
$user_pass_phrase = sql_sanitize($user_pass_phrase);
$user_pass_phrase = html_sanitize($user_pass_phrase);
$user = $_POST['user'];
$user = sql_sanitize($user);
$user = html_sanitize($user);
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $user2 = $row->email;
   mysqli_close($conn);

//static information
$toaddress = $email;

$subject = "Check out this site";

$mailcontent = $feedback;
if (empty($name) || empty($email) || empty($feedback) || !valid_email($email) || $_SESSION['pass_phrase'] !== $user_pass_phrase)  {
    
   
    header("Location: idfriend.php?mail=false");

    }
    else{

$fromaddress = $user2;
//invoke mail() function to send mail

$mail = 'true';
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
if ($mail == 'true') { echo '<center><font size="3" color="#F000F0">Email Sent</font><br /></center>';}
if ($mail == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Email not sent<br />Please check your information and try again</font><br /></center>';}
?>

   <form action="idinvite_form.php" method="post"> 
<li class="form"><input placeholder="To" name="to" type="text" /></li>
<li class="form"><input placeholder="Email" name="email" type="text" /></li>
From:
<li class="form"><input placeholder="From" name="from" type="text" value="
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

<li class="textbox"><textarea name="feedback" rows="6" cols="40" wrap="virtual" />I found an interesting website you might like at http://cellme.mobi. It is a great way to look up cell phone numbers as well as store and access your cell numbers on the web. The best part is it is free!</textarea></li> 
<li class="textbox"><label for="verify">Verification<br />Enter the phrase below:<br />
</label>
<img src="captcha.php" alt="Verification pass-phrase" /></li>
<li class="form"><input placeholder="Verification Pass-Phrase" type="text" id="verify" name="verify" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Send Email" /></li>
    </form> </li></ul>
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
<?php  
mail($toaddress, $subject, $mailcontent, $fromaddress);
}
?>