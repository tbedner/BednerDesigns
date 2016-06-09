<?php

 require_once('../mycell_fns.php');
 session_start();
  define('UPLOADPATH', '../images/');
  define('MAXFILESIZE', 2100000);      // 2 MB
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username='".$_SESSION['valid_user']."'");
  $row = $result->fetch_object();
  $usermode = $row->usermode;
  $fname = $row->fname;
  $lname = $row->lname;
  $cell = $row->cell;
  $old_email = $row->email;
  $old_city = $row->city;    
  $old_displaymode = $row->displaymode;
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

<h4>Edit Your Profile</h4>
Names

<form action="ideditchange.php" method="post">

<?php

  if ($usermode == 'personal') {
      echo '<hr />Old First Name - ';
      echo $fname;
  	  echo '<li class="form"><input placeholder="New First Name" name="new_fname" type="text" /></li>';
  }  else  {
      echo 'Old Company Name - ';
  	  echo $fname;
  	  echo '<li class="form"><input placeholder="New Company Name" name="new_fname" type="text" /></li>';
  } 
  if ($usermode == 'personal') {
      echo '<hr />Old Last Name - ';
  	  echo $lname;
  	  echo '<li class="form"><input placeholder="New Last Name" name="new_lname" type="text" /></li>';
  }  else  {
      echo 'Old Contact Name - ';
  	  echo $lname;
  	  echo '<li class="form"><input placeholder="New Contact Name" name="new_lname" type="text" /></li>';
  } 
?>
<li class="form"><input id="mysubmit" type="submit" value="Change Names" /></li>
</form>
<hr />Photo<br /><hr />
Choose an image and click upload.
<form name="form2" enctype="multipart/form-data" method="post" action="ideditchange.php" />
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAXFILESIZE; ?>" />
<input type="file" name="my_photo" style="color:#00B0F0;"/>
<input type="hidden" name="action" value="image" /><br /><br />
<li class="form"><input id="mysubmit" type="submit" name="submit" value="Upload Photo" /></li>
</form>	
<hr />Cell Phone Number<br /><hr />
<form action="pcchange_number.php" method="post">
Old Cell # -
<?php
   if(strlen($cell) == 7){
		echo preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", "$cell");
		}
	elseif(strlen($cell) == 10){
		echo preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", "$cell");
		}
	else{
		echo $cell; }  
?>
<br />
<li class="form"><input placeholder="New Cell Number" name="new_cell" type="text" maxlength="16" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Change Cell Number" /></li>
</form>
<hr />Email<br /><hr />
<form action="pcchange_number.php" method="post">
Old Email<br /><hr /><?php echo $old_email; ?>
<li class="form"><input placeholder="New Email" name="new_email" type="text" maxlength="100" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Change Email" /></li>

</form>


    <form action="idsearch_results.php" method="post">
    <input type="hidden" value="personal" name="list_type" />
<li class="form"><input placeholder="First Name" name="fname" type="text" /></li>
<li class="form"><input placeholder="Last Name" name="lname" type="text" /></li>
<li class="form"><input placeholder="City/State" name="city" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Search" /></li>
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