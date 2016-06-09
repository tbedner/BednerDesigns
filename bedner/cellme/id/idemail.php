<?php

 require_once('../mycell_fns.php');
 session_start();
$sent = $_GET['sent'];
$delete = $_GET['delete'];
if (isset($_GET['sent']))  {
if (!validate_get($sent))
{exit;}
}
if (isset($_GET['delete']))  {
if (!validate_get($delete))
{exit;}
}

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
<title>cellme.mobi
</title> 
<meta content="iPod,iPhone,free" name="keywords" /> 
<meta content="A Cellular Network where you can find friends' cell phone numbers" name="description" /> 
</head> 
 
<body> 
 
<div id="topbar"> <img alt="logo" src="images/logo.jpg" />
	<div id="title"> 
		 cellme</div>  
	<div id="leftnav"><a href="idupdate.php">Updates</a></div><div id="rightnav"><a href="idadd_book.php">Friends</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem"><li class="textbox"> 
<?php
idcheck_valid_user2();
?>

<h4>My Inbox</h4>
<div id="usernav2"> 
<a href="idemail.php">Check Mail <?php new_mail2(); ?></a>&nbsp;&nbsp;&nbsp;
<a href="idmailnew.php">Compose</a>&nbsp;&nbsp;&nbsp;
<a href="idmailsent.php">Sent</a>&nbsp;&nbsp;&nbsp; 
</div><br />

<?php
if ($sent == 'true') { echo '<font size="4" color="#F000F0">Message sent</font><br /><br />';}
if ($sent == 'false') { echo '<font size="3" color="#F000F0">Problem - Message not sent<br />Please check the name and try again.<br />***Note***<br />Emails can only be sent to Cellmates that are entered into your address book</font><br /><br />';}
if ($sent == 'false2') { echo '<font size="3" color="#F000F0">Problem - Message not sent<br />Please fill out the information completely and try again.</font><br /><br />';}
if ($sent == 'problem') { echo '<font size="3" color="#F000F0">Problem - Message not sent<br />You have multiple entries with the same name.<br />Please use a PC to send this mail or delete entries.</font><br /><br />';}
if ($delete == 'true') { echo '<font size="4" color="#F000F0">Message deleted</font><br /><br />';}
if ($delete == 'false') { echo '<font size="3" color="#F000F0">Problem - Message not deleted<br />Please try again.</font><br /><br />';}
// database connection
  $conn = db_connect();
// find out how many rows are in the table   
  $result = $conn->query("select count(*) from email where email.to= '".$_SESSION['valid_user']."'");
  
$r = $result->fetch_row();
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 5;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);
$username = $_SESSION['valid_user'];

if ($numrows == 0) {
echo 'No emails at present';
}
else {
if ($numrows<6){

// get the info from the db 
  $conn = db_connect();
  $result = $conn->query("select * from email, user where email.to = '".$_SESSION['valid_user']."' and email.from = user.username ORDER BY email.emaildate DESC");

// while there are rows to be fetched...
while ($row=$result->fetch_object()){
  $to = $row->to;
  $from = $row->from;
  $sub = $row->sub;
  $msg = $row->message;
  $emaildate = $row->emaildate;
  $status = $row->status;
  $msgid = $row->msgid;
  $fname = $row->fname;
  $fname = ucwords($fname);
  $lname = $row->lname;
  $lname = ucwords($lname);
  $photo = $row->photo;
// echo data 
if ($status == 'unread') {
echo '    <li class="mail"><br /><a href="idmail.php?msg='.$msgid.'"><img src="../'.$photo.'" border="0" height="56" width="51" align="absmiddle" /></a><br /><a href="idmail.php?msg='.$msgid.'"><b><i><font size="2" color="#7FB0B0">'.$fname.' '.$lname.'</font></i></b></a><br /><a href="idmail.php?msg='.$msgid.'"><b><i>'.$sub.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></i></b></a><br /><br /><br /><a href="idmaildelete.php?msg='.$msgid.'">Delete Message</a><br /><br /></li>';  
}  
else{
// echo data
echo '<li class="mail"><br /><a href="idmail.php?msg='.$msgid.'"><img src="../'.$photo.'" border="0" height="56" width="51" align="absmiddle" /></a><br /><a href="idmail.php?msg='.$msgid.'"><font size="2" color="#7FB0B0">'.$fname.' '.$lname.'</font></a><br /><a href="idmail.php?msg='.$msgid.'">'.$sub.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></a><br /><br /><br /><a href="idmaildelete.php?msg='.$msgid.'">Delete Message</a><br /><br /></li>';  
}    
} // end while
}
else{

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
/******  build the pagination links ******/
// range of num links to show
$range = 3;
// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'>&nbsp;&nbsp;First&nbsp;&nbsp;</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>&nbsp;Previous&nbsp;</a> ";
} // end if 


                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>&nbsp;Next&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>&nbsp;&nbsp;Last&nbsp;&nbsp;</a> ";
} // end if
/****** end build pagination links ******/
echo '<br />Page '.$currentpage.' of '.$totalpages;

// get the info from the db 
  $conn = db_connect();
  $result = $conn->query("SELECT * FROM email, user WHERE email.to = '".$_SESSION['valid_user']."' and email.from = user.username ORDER BY email.emaildate DESC LIMIT $offset, $rowsperpage");

// while there are rows to be fetched...
while ($row=$result->fetch_object()){
  $to = $row->to;
  $from = $row->from;
  $sub = $row->sub;
  $msg = $row->message;
  $emaildate = $row->emaildate;
  $status = $row->status;
  $msgid = $row->msgid;
  $fname = $row->fname;
  $fname = ucwords($fname);
  $lname = $row->lname;
  $lname = ucwords($lname);
  $photo = $row->photo;
if ($status == 'unread') {
echo '    <li class="mail"><br /><a href="idmail.php?msg='.$msgid.'"><img src="../'.$photo.'" border="0" height="56" width="51" align="absmiddle" /></a><br /><a href="idmail.php?msg='.$msgid.'"><b><i><font size="2" color="#7FB0B0">'.$fname.' '.$lname.'</font></i></b></a><br /><a href="idmail.php?msg='.$msgid.'"><b><i>'.$sub.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></i></b></a><br /><br /><br /><a href="idmaildelete.php?msg='.$msgid.'">Delete Message</a><br /><br /></li>';  
}  
else{
// echo data
echo '<li class="mail"><br /><a href="idmail.php?msg='.$msgid.'"><img src="../'.$photo.'" border="0" height="56" width="51" align="absmiddle" /></a><br /><a href="idmail.php?msg='.$msgid.'"><font size="2" color="#7FB0B0">'.$fname.' '.$lname.'</font></a><br /><a href="idmail.php?msg='.$msgid.'">'.$sub.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></a><br /><br /><br /><a href="idmaildelete.php?msg='.$msgid.'">Delete Message</a><br /><br /></li>';  
}  
} // end while

echo '<hr /><br /><br />';
/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'>First&nbsp;&nbsp;</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous&nbsp;</a> ";
} // end if 

  
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>&nbsp;Next</a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>&nbsp;&nbsp;Last</a> ";
} // end if
/****** end build pagination links ******/ }
echo '<br />Page '.$currentpage.' of '.$totalpages.'<br /><br />';

mysqli_close($conn);
}  
?>
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
