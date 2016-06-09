<?php

 require_once('../mycell_fns.php');
 session_start();
$msgid2=sql_sanitize($_GET['msg']);

// database connection
  $conn = db_connect();


  // find the message
  $result = $conn->query("select * from email, user where email.msgid = '".$msgid2."' and email.from = user.username");     
  $row = $result->fetch_object();
  $msgid = $row->msgid;
  $to = $row->to;
  $from = $row->from;
  $sub = $row->sub;
  $msg = $row->message;
  $emaildate = $row->emaildate;
  $status = $row->status;
  $fname = $row->fname;
  $fname = ucwords($fname);
  $lname = $row->lname;
  $lname = ucwords($lname);
  $photo = $row->photo;
  $username = $row->username;
// change status
  $result = $conn->query("DELETE FROM email WHERE msgid = '".$msgid."'");

  $result = $conn->query("INSERT INTO email values ('".$msgid."', '".$to."', '".$from."', '".$sub."', '".$msg."', '".$emaildate."', 'read')");
  $result = $conn->query("select * from user where username = '".$_SESSION['valid_user']."'");     
  $row2 = $result->fetch_object();
  $fname2 = $row2->fname;
  $lname2 = $row2->lname;
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
<a href="idmailnew.php">Compose</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="idmailsent.php">Sent</a>&nbsp;&nbsp;&nbsp;&nbsp;<br />
<br /><?php echo'<img src="../'.$photo.'" border="0" height="56" width="51" />';?> <br /><br />
     <form action="idmailreply2.php" method="post">
     <br />
     <li class="showmail">&nbsp;To: <?php echo $fname.' '.$lname; ?></li>
 
<li class="form"><input placeholder="Subject" name="subject" type="text" /></li>
<li class="textbox"><textarea name="mail" />


---------------
<?php echo 'From:'.$fname.' '.$lname; ?>

<?php echo 'To:'.$fname2.' '.$lname2; ?>

<?php echo 'Sent:'.$emaildate; ?>

<?php echo 'Subject:'.$sub; ?>


<?php echo $msg; ?></textarea></li>
<input type="hidden" name="to" value="<?php echo $username; ?>" />
<li class="form"><input id="mysubmit" type="submit" value="Send Mail" /></li>
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


 



