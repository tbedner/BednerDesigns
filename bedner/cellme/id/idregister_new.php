<?php
  // include function files for this application
  require_once('../mycell_fns.php');
  session_start();
  //create short variable names
  $fname=trim($_POST['fname']);
  $fname=sql_sanitize($fname);
  $fname=html_sanitize($fname);
  $fname=ucwords($fname);
  $lname=trim($_POST['lname']);
  $lname=sql_sanitize($lname);
  $lname=html_sanitize($lname);
  $lname=ucwords($lname);
  $cell=trim($_POST['cell']);
  $city=trim($_POST['city']);
  $city=sql_sanitize($city);
  $city=html_sanitize($city);
  $city=ucwords($city);
  $email=trim($_POST['email']);
  $username=trim($_POST['username']);
  $username=sql_sanitize($username);
  $username=html_sanitize($username);
  $passwd=trim($_POST['passwd']);
  $passwd2=trim($_POST['passwd2']);
  $usermode='personal';
if (!validate_type($usermode)) {exit;}  
  $displaymode=trim($_POST['display']);
if (!validate_display($displaymode)) {exit;}  
  $photo='photo_default.jpg';
  $user_pass_phrase = SHA1($_POST['verify']);
  $user_pass_phrase=sql_sanitize($user_pass_phrase);
  $user_pass_phrase=html_sanitize($user_pass_phrase);
  
  try   {
    // check forms filled in
    if ($_SESSION['pass_phrase'] !== $user_pass_phrase) {
       throw new Exception('Please enter the verification pass-phrase exactly as shown.<br /><br />');
       }
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out completely - please try again.<br /><br />');
    }
    if (!validatePhone($cell)) {
      throw new Exception('That is not a valid cell number. Please try again.<br /><br />');
    }
    // email address not valid
    if (!valid_email($email)) {
      throw new Exception('That is not a valid email address.  Please try again.<br /><br />');
    }

    // passwords not the same
    if ($passwd != $passwd2) {
      throw new Exception('The passwords you entered do not match - please try again.<br /><br />');
    }

        if ((strlen($username) < 6) || (strlen($username) > 16)) {
      throw new Exception('Your username must be between 6 and 16 characters Please try again.<br /><br />');
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
      throw new Exception('Your password must be between 6 and 16 characters Please try again.<br /><br />');
    }
$new_cell = preg_replace('/[\(\)\-\s]/', '',$cell);
    // attempt to register
    // this function can also throw an exception
    register($fname, $lname, $new_cell, $city, $username, $email, $passwd, $usermode, $displaymode, $photo);
    // register session variable
    $_SESSION['valid_user'] = $username;
  
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
<?php	
do_idad();
?>
	<ul class="pageitem"><li class="textbox"> 
<?php
 idcheck_valid_user();
?>
<ul class="pageitem"><li class="textbox"> 
		<p>Registration Successful!</p> </li>
		<p class="info">
    <br />Welcome, to Cellme.mobi! Click on the MyPage link above to get started quickly.<br /><br />
                Search our listings for members' cell phone numbers. If someone is not listed, 
                easily invite them using our Invite-A-Friend function.<br /><br />
                Manage Contacts in your online Address Book and always have phone numbers wherever there is a computer and the Internet.<br /><br />
                Update all of your contacts in your address book and comment on their updates.<br /><br />
                Send personal messages using our free email service.
            </p> 
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
  }
  catch (Exception $e) {
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
	<div id="leftnav"><a href="idjoin.php">Join</a></div><div id="rightnav"><a href="idcontact.php">Contact</a></div>
</div> 
<div id="content"> 
	<ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li> 
		<li class="form"><span class="name2"><a href="id.php"><img src="thumbs/cellme2.png" /> 
		</a>&nbsp;&nbsp;&nbsp;<a href="idabout.php"><img src="thumbs/cellme4.png" /></a>&nbsp;&nbsp;&nbsp;<a href="idcontact.php"><img src="thumbs/cellme5.png" /></a></span></li> 
	</ul> 
	<ul class="pageitem">
<li class="textbox"><b>Registration - Personal</b><br /><br />
                Problem<br /><br />
                <p><?php      echo $e->getMessage(); ?><br />
</li>
<form method="post" action="idregister_new.php"> 
<li class="form"><input placeholder="First Name" name="fname" type="text" /></li>
<li class="form"><input placeholder="Last Name" name="lname" type="text" /></li>
<li class="form"><input placeholder="City/State" name="city" type="text" /></li>
<li class="form"><input placeholder="Email" name="email" type="text" /></li>
<li class="form"><input placeholder="Cell Phone Number" name="cell" type="text" /></li>
<li class="form"><input placeholder="Username (6-16 chars)" name="username" type="text" /></li>
<li class="form"><input placeholder="Password (6-16 chars)" name="passwd" type="password" /></li>
<li class="form"><input placeholder="Confirm Password" name="passwd2" type="password" /></li>
<li class="textbox">Display Setting (Choose one)</li>
<li class="form"><span class="choice"><span class="name">Private</span><input name="display" type="radio" value="private" /></span></li>
<li class="form"><span class="choice"><span class="name">Public</span><input name="display" type="radio" value="Public" /></span></li>
<li class="form"><label for="verify">Verification<br />Enter the phrase below:<br /></label></li>
<li class="form"><img src="captcha.php" alt="Verification pass-phrase" /></li>
<li class="form"><input type="text" placeholder="Verification phrase" id="verify" name="verify" /></li>
<input type="hidden" name="usermode" value="personal" />
<li class="form"><input id="mysubmit" type="submit" value="Register" /></li></form>    
</ul><ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li>
		
		<li class="menu"><a href="id.php">
    <img alt="home" src="thumbs/home2.png" /><span class="name">Home</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idabout.php"> 
		<img alt="About Us" src="thumbs/help.png" /><span class="name">About Us</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idcontact.php"> 
		<img alt="Contact Us" src="thumbs/telephone.png" /><span class="name">Contact Us</span><span class="comment"></span><span class="arrow"></span></a></li> 
		
	</ul> 
	
</div> 
<div id="footer">
   <a href="idcontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idpolicy.php">Privacy Policy</b></a></p>
   &copy; 2009 cellme.mobi</p> 
	<a href="http://iwebkit.net">Powered by iWebKit</a></div> 
<script src="m-analytics.js" type="text/javascript"></script> 
 
</body> 
 
</html> 
<?php
     exit;
  }
?> 