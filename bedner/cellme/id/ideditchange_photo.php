<?php

 require_once('../mycell_fns.php');
 session_start();
   define('UPLOADPATH', 'images/');
  define('MAXFILESIZE', 2100000);      // 2 MB
$username = $_SESSION['valid_user'];
 $pic = $_GET['photo'];
if (isset($_GET['photo']))  {
if (!validate_photo($pic))
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
idcheck_valid_user();
?>

<hr />Photo<br /><hr />

<?php 
if ($pic == 'empty') { echo '<center><font size="3" color="#F000F0">Sorry, the upload field was empty. Please try again.</font><br /></center>';}
if ($pic == 'type') { echo '<center><font size="3" color="#F000F0">Sorry, we only accept GIF, PNG and JPEG images of 2MB or less</font><br /></center>';}
if ($pic == 'type2') { echo '<center><font size="3" color="#F000F0">We do not allow uploading PHP files</font><br /></center>';}
if ($pic == 'success') { echo '<center><font size="3" color="#F000F0">Upload successful - You may need to refresh page to see the new photo</font><br /></center>';}
if ($pic == 'false') { echo '<center><font size="3" color="#F000F0">Sorry, there was a problem uploading your photo</font><br /></center>';}
if ($pic == 'type3') { echo '<center><font size="3" color="#F000F0">The photo must be a GIF, JPEG, or PNG image file no greater than ' . (MAXFILESIZE/100000) . ' MB in size</font><br /></center>';}
?>
Choose an image and click upload.
<form name="form2" enctype="multipart/form-data" method="post" action="ideditchange_photo2.php" />
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAXFILESIZE; ?>" />
<input type="file" name="my_photo" style="color:#00B0F0;"/>
<input type="hidden" name="action" value="image" /><br /><br />
<li class="form"><input id="mysubmit" type="submit" name="submit" value="Upload Photo" /></li>
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