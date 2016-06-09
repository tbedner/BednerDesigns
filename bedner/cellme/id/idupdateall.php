<?php

 require_once('../mycell_fns.php');
 session_start();
 $username = $_SESSION['valid_user'];
 $deletec = $_GET['deletec'];
 $deleteu = $_GET['deleteu'];
 $addu = $_GET['add'];
 $addc = $_GET['addc'];
 $sent = $_GET['sent'];
 $update = $_GET['update'];
if (isset($_GET['deletec']))  {
if (!validate_get($deletec))
{exit;}
}
if (isset($_GET['deleteu']))  {
if (!validate_get($deleteu))
{exit;}
}
if (isset($_GET['add']))  {
if (!validate_get($addu))
{exit;}
}
if (isset($_GET['addc']))  {
if (!validate_get($addc))
{exit;}
}
if (isset($_GET['sent']))  {
if (!validate_get($sent))
{exit;}
}
if (isset($_GET['update']))  {
if (!validate_get($update))
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
	<div id="leftnav"><a href="idemail.php">Inbox</a></div><div id="rightnav"><a href="idsearch.php">Search</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem"> 
<?php
idcheck_valid_user2();
if ($deletec == 'true') { echo '<center><font size="3" color="#F000F0">Comment Deleted</font><br /></center>';}
if ($deletec == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Comment Not Deleted</font><br /></center>';}
if ($deleteu == 'true') { echo '<center><font size="3" color="#F000F0">Update Deleted</font><br /></center>';}
if ($deleteu == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Update Not Deleted</font><br /></center>';}
if ($addu == 'true') { echo '<center><font size="3" color="#F000F0">Update Added</font><br /></center>';}
if ($addu == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Update Not Added</font><br /></center>';}
if ($addc == 'true') { echo '<center><font size="3" color="#F000F0">Comment Added</font><br /></center>';}
if ($addc == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Comment Not Added</font><br /></center>';}
if ($sent == 'problem') { echo '<center><font size="3" color="#F000F0">Problem - Comment Not Added</font><br /></center>';}
if ($update == 'problem') { echo '<center><font size="3" color="#F000F0">Problem - Update Not Added</font><br /></center>';}
?> 
<li class="menu"><a href="idmyupdate.php"><span class="name2"><br />See Your Updates</span></a></li><hr />
<?php
echo '<font color="#00B0F0"><b><i>Friend Updates</i></b></font><br /><hr />'; 

 $username = $_SESSION['valid_user'];

  $conn = db_connect(); 
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $myfname = $row->fname;
  $mylname = $row->lname;
  $conn7 = db_connect();
// find out how many rows are in the table   
  $result7 = $conn7->query("select count(*) from updates, add_book
                            where add_book.username = '".$_SESSION['valid_user']."' AND add_book.ent_id = updates.up_username");
$r = $result7->fetch_row();
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 5;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

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



  $conn = db_connect(); 
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $myfname = $row->fname;
  $mylname = $row->lname;
                            

  $conn1 = db_connect();
  $result1 = $conn1->query("select add_book.fname, add_book.lname, add_book.photo, updates.datetime, updates.up_username, updates.update from updates, add_book
                            where add_book.username = '".$_SESSION['valid_user']."' AND add_book.ent_id = updates.up_username ORDER BY updates.datetime DESC LIMIT $offset, $rowsperpage");

echo '<br />Page '.$currentpage.' of '.$totalpages.'<br /><hr />';
while ($row1=$result1->fetch_object()){

  
  $fname = $row1->fname;
  $lname = $row1->lname;
  $user = $row1->up_username;
  $datetime = $row1->datetime;
  $update = $row1->update;
  $photo = $row1->photo;
  echo '<div class="update"><div class="photo"><img src="../'.$photo.'" alt="Photo" width="34" height="40" align="top" /></div><div>'.$update.'</div>';
  echo '<div><font color="#00B0F0" size="1.5">'.$fname.' '.$lname.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime.'</font></div></div>';
  $datetime5 = str_replace(' ', '', $datetime);
  echo '<a name="'.$user.$datetime5.'"></a>';  
  echo '<br />';

  $conn2 = db_connect(); 
  $result2 = $conn2->query("select * from comments
                            where userid = '".$user."' AND timeid = '".$datetime."' ORDER BY datetime2 DESC");


  $num_row2 = $result2->num_rows;
if ($num_row2 == 0){
              echo '';  
 }
 else{
while ($row2=$result2->fetch_object()){

  $fname1 = $row2->fname;
  $lname1 = $row2->lname;
  $comment = $row2->comment;
      $datetime2 = $row2->datetime2;
  $datetime1 = str_replace(' ', '', $datetime2);
  
  echo '<div class="comment">'.$comment;
  echo '<br /><div class="insidecomment">';
  echo $fname1.' '.$lname1;

  $conn3 = db_connect(); 
  $result3 = $conn3->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
   $row3=$result3->fetch_object();
  $fname2 = $row3->fname;
  $lname2 = $row3->lname;

if ($fname1 == $fname2 && $lname1 == $lname2) {
  echo '<a href="idcommentdelete.php?id='.$lname2.'&date='.$datetime1.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
   }
else {
  echo '&nbsp;&nbsp;&nbsp;</div></div>';
}   
mysqli_close($conn3);  
 
  
  } }

  echo '<br />';
 
?>
<form action="idaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
<li class="form"><input placeholder="Add a comment" name="comment" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Send Comment" /></li>
              </form> 
<hr />
<?php    

} 
mysqli_close($conn1);
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



  $conn = db_connect(); 
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $myfname = $row->fname;
  $mylname = $row->lname;
                            

  $conn1 = db_connect();
  $result1 = $conn1->query("select add_book.fname, add_book.lname, add_book.photo, updates.datetime, updates.up_username, updates.update from updates, add_book
                            where add_book.username = '".$_SESSION['valid_user']."' AND add_book.ent_id = updates.up_username ORDER BY updates.datetime DESC LIMIT $offset, $rowsperpage");

echo '<br />Page '.$currentpage.' of '.$totalpages.'<br /><hr />';

?>
 <a href="idupdate.php">
<li class="form"><input id="mysubmit" type="submit" value="See First 5 Friend Updates" /></li></a>

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
