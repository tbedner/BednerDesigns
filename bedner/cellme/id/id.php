<?php
  $sent = $_GET['confirm'];
if (isset($_GET['confirm']))  {
if (!validate_get($sent))
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
	<div id="leftnav"><a href="idcontact.php">Contact</a></div><div id="rightnav"><a href="idjoin.php">Join</a></div>
</div> 
<div id="content"> 
	<ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li> 
		<li class="form"><span class="name2"><a href="idjoin.php"><img src="thumbs/cellme3.png" /> 
		</a>&nbsp;&nbsp;<a href="idabout.php"><img src="thumbs/cellme4.png" /></a>&nbsp;&nbsp;<a href="idcontact.php"><img src="thumbs/cellme5.png" /></a></span></li> 
	</ul> 
	<ul class="pageitem"><li class="textbox"> 
<?php
if ($sent == 'true') { echo '<br /><center><font size="3" color="#F000F0">Request Confirmed and Cellmate added</font><br /></center>';}
?>
		<p>A Free Cellular Network</p>
		<span class="name2"><br /><a href="idabout.php"> 
		Why should you join?</a><br /><br /></span>
    <form method="post" action="idmember.php"> 
		</li> <li class="form"><input placeholder="Username" name="username" type="text" /></li>
    <li class="form"><input placeholder="Password" name="password" type="password" /></li>
    <li class="form"><input name="Submit input" type="submit" value="Login" /></li> </form>
    <li class="menu"><a href="idforgot_form.php"><span class="name2"><br />Forgot password?</span></a></li>
    </ul><ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li>
		
		<li class="menu"><a href="idjoin.php"> 
		<img alt="Join" src="thumbs/cellme.png" /><span class="name">Join</span><span class="arrow"></span></a></li> 
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