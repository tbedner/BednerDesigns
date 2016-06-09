<?php

 require_once('..\mycell_fns.php');
 session_start();
$name = trim($_POST['name']);
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
  <script language="javascript">
<!--

function PreviousPage() {

  history.back(1);

}
//-->


</script>  
<title>cellme.mobi
</title> 
<meta content="iPod,iPhone,free" name="keywords" /> 
<meta content="A Cellular Network where you can find friends' cell phone numbers" name="description" /> 
</head> 

<?php

//static information
$toaddress = "other@cellme.mobi";

$subject = "Advertising from web site";

$mailcontent = "Customer name: ".$name."\n".
			         "Customer email: ".$email."\n".
               "Customer comments: ".$feedback."\n";

$fromaddress = "From: webserver@cellme.mobi";
?>
<body> 
 
<div id="topbar"> <img alt="logo" src="images/logo.jpg" />
	<div id="title"> 
		 cellme</div>  
	<div id="leftnav"><a href="idabout.php">About</a></div><div id="rightnav"><a href="id.php"><img alt="home" src="images/home.png" /></a></div>
</div> 
<div id="content"> 
	<ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li> 
		<li class="form"><span class="name2"><a href="idjoin.php"><img src="thumbs/cellme3.png" /> 
		</a>&nbsp;&nbsp;&nbsp;<a href="idabout.php"><img src="thumbs/cellme4.png" /></a>&nbsp;&nbsp;&nbsp;<a href="id.php"><img src="thumbs/cellme7.png" /></a></span></li> 
	</ul> 
	<ul class="pageitem"><li class="textbox">
  		<p>A Free Cellular Network</p>
		<br /> 
<?php

    if ($_SESSION['pass_phrase'] !== $user_pass_phrase) {
       echo 'Please enter the verification pass-phrase exactly as shown.<br /><br />';
?>
 <form action="idother_feedback.php" method="post"> 
                 <ul class="pageitem">
                 <li class="form"><input name="name" placeholder="Name" type="text" /></li>
                 <li class="form"><input name="email" placeholder="Email" type="text" /></li>
                 <li class="textbox">Message<textarea name="feedback"></textarea></li>
                 <label for="verify">Verification<br />Enter the phrase below:<br />
                 </label>
                 <li class="form"><img src="captcha.php" alt="Verification pass-phrase" /></li>
                 <li class="form"><input type="text" placeholder="Verification phrase" id="verify" name="verify" /></li>
                 <li class="form"><input name="submit" type="submit" value="Send Message" /></li>
                 </ul> 
                </form> 
    </ul>
<ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li>
		
		<li class="menu"><a href="id.php">
    <img alt="home" src="thumbs/home2.png" /><span class="name">Home</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idabout.php"> 
		<img alt="About Us" src="thumbs/help.png" /><span class="name">About Us</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idjoin.php"> 
		<img alt="Join" src="thumbs/cellme.png" /><span class="name">Join</span><span class="arrow"></span></a></li> 
		
	</ul> 
	
</div> 
<div id="footer">
   <a href="idcontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idpolicy.php">Privacy Policy</b></a></p>
   &copy; 2009 cellme.mobi</p> 
	<a href="http://iwebkit.net">Powered by iWebKit</a></div> 
<script src="m-analytics.js" type="text/javascript"></script> 
 
</body> 
 
</html> 
<?php
}
else {
if (empty($name) || empty($feedback) || empty($email))  {

if (valid_email($email)) {
echo 'Please fill in the form completely.<br /><br />';
?>

   
                <form action="idother_feedback.php" method="post"> 
                 <ul class="pageitem">
                 <li class="form"><input name="name" placeholder="Name" type="text" /></li>
                 <li class="form"><input name="email" placeholder="Email" type="text" /></li>
                 <li class="textbox">Message<textarea name="feedback"></textarea></li>
                 <label for="verify">Verification<br />Enter the phrase below:<br />
                 </label>
                 <li class="form"><img src="captcha.php" alt="Verification pass-phrase" /></li>
                 <li class="form"><input type="text" placeholder="Verification phrase" id="verify" name="verify" /></li>
                 <li class="form"><input name="submit" type="submit" value="Send Message" /></li>
                 </ul> 
                </form> 
    </ul><ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li>
		
		<li class="menu"><a href="id.php">
    <img alt="home" src="thumbs/home2.png" /><span class="name">Home</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idabout.php"> 
		<img alt="About Us" src="thumbs/help.png" /><span class="name">About Us</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idjoin.php"> 
		<img alt="Join" src="thumbs/cellme.png" /><span class="name">Join</span><span class="arrow"></span></a></li> 
		
	</ul> 
	
</div> 
<div id="footer">
   <a href="idcontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idpolicy.php">Privacy Policy</b></a></p>
   &copy; 2009 cellme.mobi</p> 
	<a href="http://iwebkit.net">Powered by iWebKit</a></div> 
<script src="m-analytics.js" type="text/javascript"></script> 
 
</body> 
 
</html> 
<?php
exit;
}
else{
echo 'Please check your email address/information.<br /><br />';
?>

   
                <form action="idother_feedback.php" method="post"> 
                 <ul class="pageitem">
                 <li class="form"><input name="name" placeholder="Name" type="text" /></li>
                 <li class="form"><input name="email" placeholder="Email" type="text" /></li>
                 <li class="textbox">Message<textarea name="feedback"></textarea></li>
                 <label for="verify">Verification<br />Enter the phrase below:<br />
                 </label>
                 <li class="form"><img src="captcha.php" alt="Verification pass-phrase" /></li>
                 <li class="form"><input type="text" placeholder="Verification phrase" id="verify" name="verify" /></li>
                 <li class="form"><input name="submit" type="submit" value="Send Message" /></li>
                 </ul>
                </form> 
    </ul><ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li>
		
		<li class="menu"><a href="id.php">
    <img alt="home" src="thumbs/home2.png" /><span class="name">Home</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idabout.php"> 
		<img alt="About Us" src="thumbs/help.png" /><span class="name">About Us</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idjoin.php"> 
		<img alt="Join" src="thumbs/cellme.png" /><span class="name">Join</span><span class="arrow"></span></a></li> 
		
	</ul> 
	
</div> 
<div id="footer">
   <a href="idcontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idpolicy.php">Privacy Policy</b></a></p>
   &copy; 2009 cellme.mobi</p> 
	<a href="http://iwebkit.net">Powered by iWebKit</a></div> 
<script src="m-analytics.js" type="text/javascript"></script> 
 
</body> 
 
</html> 
<?php
exit;
}
}
else {
if (!valid_email($email)) {
echo 'Please check your email address.<br /><br />';
?>

   
                <form action="idother_feedback.php" method="post"> 
                 <ul class="pageitem">
                 <li class="form"><input name="name" placeholder="Name" type="text" /></li>
                 <li class="form"><input name="email" placeholder="Email" type="text" /></li>
                 <li class="textbox">Message<textarea name="feedback"></textarea></li>
                 <label for="verify">Verification<br />Enter the phrase below:<br />
                 </label>
                 <li class="form"><img src="captcha.php" alt="Verification pass-phrase" /></li>
                 <li class="form"><input type="text" placeholder="Verification phrase" id="verify" name="verify" /></li>
                 <li class="form"><input name="submit" type="submit" value="Send Message" /></li>
                 </ul>
                </form> 
    </ul><ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li>
		
		<li class="menu"><a href="id.php">
    <img alt="home" src="thumbs/home2.png" /><span class="name">Home</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idabout.php"> 
		<img alt="About Us" src="thumbs/help.png" /><span class="name">About Us</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idjoin.php"> 
		<img alt="Join" src="thumbs/cellme.png" /><span class="name">Join</span><span class="arrow"></span></a></li> 
		
	</ul> 
	
</div> 
<div id="footer">
   <a href="idcontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idpolicy.php">Privacy Policy</b></a></p>
   &copy; 2009 cellme.mobi</p> 
	<a href="http://iwebkit.net">Powered by iWebKit</a></div> 
<script src="m-analytics.js" type="text/javascript"></script> 
 
</body> 
 
</html> 
<?php
exit;
}
//invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);

?>

<h3>Form submitted</h3>
<p>Your information (shown below) has been sent. A representative will be in contact with you as soon as possible. Thank you.</p>
<p><?php echo nl2br($mailcontent); ?> </p><br /><br /><a href="javascript:PreviousPage()">Back to Contact Form</a>
    </ul><ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li>
		
		<li class="menu"><a href="id.php">
    <img alt="home" src="thumbs/home2.png" /><span class="name">Home</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idabout.php"> 
		<img alt="About Us" src="thumbs/help.png" /><span class="name">About Us</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idjoin.php"> 
		<img alt="Join" src="thumbs/cellme.png" /><span class="name">Join</span><span class="arrow"></span></a></li> 
		
	</ul> 
	
</div> 
<div id="footer">
   <a href="idcontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="idpolicy.php">Privacy Policy</b></a></p>
   &copy; 2009 cellme.mobi</p> 
	<a href="http://iwebkit.net">Powered by iWebKit</a></div> 
<script src="m-analytics.js" type="text/javascript"></script> 
 
</body> 
 
</html>
<?php
}
}
?> 