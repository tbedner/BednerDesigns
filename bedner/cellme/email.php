<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 echo '<div class="textbox2">';
 check_valid_user2();
 echo '</div>';
 display_inbox_menu(); 
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
<div class="textbox2">
<h4>Inbox</h4>
</div>
<?php
 echo '<div class="textbox2">';
if ($sent == 'true') { echo '<font size="4" color="#F000F0">Message sent</font><br /><br />';}
if ($sent == 'false') { echo '<font size="3" color="#F000F0">Problem - Message not sent<br />Please check the name (first and last are required) and try again.<br />***Note***<br />Emails can only be sent to Cellmates that are entered into your address book</font><br /><br />';}
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
echo '<div class="textbox2"><br /><a href="mail.php?msg='.$msgid.'"><img src="'.$photo.'" border="0" height="56" width="51" align="absmiddle" /></a><br /><a href="mail.php?msg='.$msgid.'"><b><i><font size="2" color="#7FB0B0">'.$fname.' '.$lname.'</font></i></b></a><br /><a href="mail.php?msg='.$msgid.'"><b><i>'.$sub.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></i></b></a><br /><br /><a href="maildelete.php?msg='.$msgid.'">Delete Message</a></div><br /><br />';  
}  
else{
// echo data
echo '<div class="textbox2"><br /><a href="mail.php?msg='.$msgid.'"><img src="'.$photo.'" border="0" height="56" width="51" align="absmiddle" /></a><br /><a href="mail.php?msg='.$msgid.'"><font size="2" color="#7FB0B0">'.$fname.' '.$lname.'</font></a><br /><a href="mail.php?msg='.$msgid.'">'.$sub.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></a><br /><br /><a href="maildelete.php?msg='.$msgid.'">Delete Message</a></div><br /><br />';  
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
echo 'Page '.$currentpage.' of '.$totalpages.'<br />';

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
echo '</div>';
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
echo '<div class="textbox2"><br /><a href="mail.php?msg='.$msgid.'"><img src="'.$photo.'" border="0" height="56" width="51" align="absmiddle" /></a><br /><a href="mail.php?msg='.$msgid.'"><b><i><font size="2" color="#7FB0B0">'.$fname.' '.$lname.'</font></i></b></a><br /><a href="mail.php?msg='.$msgid.'"><b><i>'.$sub.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></i></b></a><br /><br /><a href="maildelete.php?msg='.$msgid.'">Delete Message</a><br /><br /></div>';  
}  
else{
// echo data
echo '<div class="textbox2"><br /><a href="mail.php?msg='.$msgid.'"><img src="'.$photo.'" border="0" height="56" width="51" align="absmiddle" /></a><br /><a href="mail.php?msg='.$msgid.'"><font size="2" color="#7FB0B0">'.$fname.' '.$lname.'</font></a><br /><a href="mail.php?msg='.$msgid.'">'.$sub.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></a><br /><br /><a href="maildelete.php?msg='.$msgid.'">Delete Message</a><br /><br /></div>';  
}  
} // end while

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
echo '<br />Page '.$currentpage.' of '.$totalpages.'<br />';

mysqli_close($conn);
}   
 display_user_menu();
 do_html_footer();
?>