<?php

 require_once('../mycell_fns.php');
 session_start();
  $id = trim($_GET['id']);
  if (strlen($id) > 16){
  exit;
  }
  $id=sql_sanitize($id);
  $cell1 = $_GET['cell1'];
  if (!validatePhone($cell1)) {exit;}
  $cell1 = sql_sanitize($cell1);  
  $cell2 = $_GET['cell2'];
  if (!validatePhone($cell2)) {exit;}
  $cell2 = sql_sanitize($cell2);  

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

<h4>Delete Entry</h4>
<?php
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND ent_id = '".$id."' AND cell = '".$cell2."'");
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  $id2 = $row->ent_id;
  $cell3 = $row->cell;
mysqli_close($conn);
echo $lname.', '.$fname;

?> 	
<br /><br />
Are you sure you would like to delete this entry?<br /><br />
<?php echo '<a href="iddelete_entry2.php?id='.$id2.'&amp;cell1='.$cell1.'&amp;cell2='.$cell3.'">'?>
<img src="../images/yes.jpg" alt="Delete Entry" border="0" /></a><br /><br />
<a href="idadd_book.php"><img src="../images/no.jpg" alt="Do Not Delete Entry" border="0" />
</a>
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
