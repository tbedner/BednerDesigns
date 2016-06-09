<?php
// include function files for this application
require_once('mycell_fns.php');
session_start();
$delete = $_GET['delete'];
if (isset($_GET['delete']))  {
if (!validate_get($delete))
{exit;}
}
do_pcuser_top();
 
?>
              
              <table class="member" cellspacing="20"><tr>
              <td width="205px">
                              <div id="valid">
<?php
                pccheck_valid_user();
?>
                </div>
              <a href="pcsearch.php"><img src="images/search.jpg" alt="Search" border="0" width="75" height="79" /></a><br />
              <a href="pcadd_book.php"><img src="images/friends.jpg" alt="Search" border="0" width="75" height="79" /></a><br />
              </td>
              <td width="615px" align="center">
<h3>Sent Mail</h3><br />
<div id="usernav2"> 
<a href="pcemail.php">Inbox</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pcmailnew.php">Compose</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div><br />

<?php
if ($delete == 'true') { echo '<font size="5" color="#F000F0">Message deleted</font><br /><br />';}
if ($delete == 'false') { echo '<font size="5" color="#F000F0">Problem - Message not deleted</font><br /><br />';}
// database connection
  $conn = db_connect();
// find out how many rows are in the table   
  $result = $conn->query("select count(*) from sent where sent.from= '".$_SESSION['valid_user']."'");
  
$r = $result->fetch_row();
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 10;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);
$username = $_SESSION['valid_user'];

if ($numrows == 0) {
echo 'No emails at present';
}
else {
if ($numrows<11){
?>
<br /><table id="email" width="550px" align="left"><tr><td>To</td><td></td><td>Subject</td><td align="center">Delete</td></tr>
<?php


// get the info from the db 
  $conn = db_connect();
  $result = $conn->query("select * from sent,user where sent.from = '".$_SESSION['valid_user']."' AND sent.to = user.username ORDER BY sent.emaildate DESC");

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
echo '<tr onClick="document.location.href=\'pcsentmail.php?msg='.$msgid.'\';" style="cursor:pointer;"><td><a href="pcsentmail.php?msg='.$msgid.'"><img src="'.$photo.'" border="0" height="56" width="51" /></a><br />&nbsp;</td><td> <br /><a href="pcsentmail.php?msg='.$msgid.'"><b><i>'.$fname.' '.$lname.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></i></b></a></td><td> <br /><a href="pcsentmail.php?msg='.$msgid.'"><b><i>'.$sub.'</i></b></a></td><td align="center" id="emailcell"> <br /><a href="pcsentmaildelete.php?msg='.$msgid.'">&nbsp;X&nbsp;</a></td></tr>';  
}  
else{
// echo data
echo '<tr onClick="document.location.href=\'pcsentmail.php?msg='.$msgid.'\';" style="cursor:pointer;"><td><a href="pcsentmail.php?msg='.$msgid.'"><img src="'.$photo.'" border="0" height="56" width="51" /></a><br />&nbsp;</td><td> <br /><a href="pcsentmail.php?msg='.$msgid.'">'.$fname.' '.$lname.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></a></td><td> <br /><a href="pcsentmail.php?msg='.$msgid.'">'.$sub.'</a></td><td align="center" id="emailcell"> <br /><a href="pcsentmaildelete.php?msg='.$msgid.'">&nbsp;X&nbsp;</a></td></tr>';  
}    
} // end while
?></table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><?php
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
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for 
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/
?><br /><table id="email" width="550px" align="left"><tr><td>To</td><td></td><td>Subject</td><td align="center">Delete</td></tr><?php  
// get the info from the db 
  $conn = db_connect();
  $result = $conn->query("select * from sent,user where sent.from = '".$_SESSION['valid_user']."' AND sent.to = user.username ORDER BY sent.emaildate DESC LIMIT $offset, $rowsperpage");

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
echo '<tr onClick="document.location.href=\'pcsentmail.php?msg='.$msgid.'\';" style="cursor:pointer;"><td><a href="pcsentmail.php?msg='.$msgid.'"><img src="'.$photo.'" border="0" height="56" width="51" /></a><br />&nbsp;</td><td> <br /><a href="pcsentmail.php?msg='.$msgid.'"><b><i>'.$fname.' '.$lname.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></i></b></a></td><td> <br /><a href="pcsentmail.php?msg='.$msgid.'"><b><i>'.$sub.'</i></b></a></td><td align="center" id="emailcell"> <br /><a href="pcsentmaildelete.php?msg='.$msgid.'">&nbsp;X&nbsp;</a></td></tr>';  
}  
else{
// echo data
echo '<tr onClick="document.location.href=\'pcsentmail.php?msg='.$msgid.'\';" style="cursor:pointer;"><td><a href="pcsentmail.php?msg='.$msgid.'"><img src="'.$photo.'" border="0" height="56" width="51" /></a><br />&nbsp;</td><td> <br /><a href="pcsentmail.php?msg='.$msgid.'">'.$fname.' '.$lname.'<br /><font size="1" color="#7FB0B0">'.$emaildate.'</font></a></td><td> <br /><a href="pcsentmail.php?msg='.$msgid.'">'.$sub.'</a></td><td align="center" id="emailcell"> <br /><a href="pcsentmaildelete.php?msg='.$msgid.'">&nbsp;X&nbsp;</a></td></tr>';  
}  
} // end while
?></table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><?php
/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/ }
mysqli_close($conn);
}  
?>
              </td>
              <td width="220px" rowspan="3">

              <b><i>Updates</i></b><br /><br /> 
              <form action="pcaddupdate.php" method="post">
              <input type="text" name="update" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Update">
              </form> 
                            
              
              
                  <form action="pcupdate.php" method="post">
                  <br />
                  <input id="mysubmit" type="submit" value="See Next 10 Updates"/>
                  
                  </form><br /><br />

<?php
do_pcupdates();
?> 
              </td></tr>
              
              
              </table>
<?php
do_pcuser_bottom();

?>