<?php

 require_once('mycell_fns.php');
 session_start();
//variable names
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

//static information
$toaddress = "other@cellme.mobi";

$subject = "Advertising from web site";

$mailcontent = "Customer name:\n\n ".$name."\n\n".
			         "Customer email:\n\n ".$email."\n\n".
               "Customer comments:\n\n ".$feedback."\n";

$fromaddress = "From: webserver@cellme.mobi";

?>
  <script language="javascript">
<!--

function PreviousPage() {

  history.back(1);

}
//-->


</script> 
<?php 
  try   {
    // check forms filled in
    if ($_SESSION['pass_phrase'] !== $user_pass_phrase) {
       throw new Exception('Please enter the verification pass-phrase exactly as shown.<br /><br /><a href="javascript:PreviousPage()">Back to Contact Form</a>');
       }
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out completely - please go back and try again.<br /><br /><a href="javascript:PreviousPage()">Back to Contact Form</a>');
    }
    // email address not valid
    if (!valid_email($email)) {
      throw new Exception('That is not a valid email address.  Please go back and try again.<br /><br /><a href="javascript:PreviousPage()">Back to Contact Form</a>');
    }

    $_SESSION['valid_user'] = $username;
mail($toaddress, $subject, $mailcontent, $fromaddress);
?>                
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>cellme.mobi</title>
  <link type="text/css" rel="stylesheet" href="cellme.css" />
  </head>
  <body>
        <div id="header">
           
        <div id="topcontent">
          <div id="headerlogo">
          <image src="images/logo.jpg" alt="cellme.mobi" />
          </div>
          <div id="login">
<?php
pcdisplay_login_form();
?>
          </div>
          </div>
        </div>
        <div id="allcontent">
  
            <div id="menubar">
<?php
 do_pcindex_menu();
?>
            </div>
          <div class="ad">
            <br />
<?php
do_pc_ad();
?>
          </div>               
            <div id="nifty"> 
              <b class="rtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b> 
                <div id="logo">
                  <img src="images/logo3.jpg" alt="cellme.mobi" />
                </div>
                <div id="box">
<h2>Form Submitted</h2>
<br />
<p>Your information (shown below) has been sent. A representative will be in contact with you as soon as possible. Thank you.</p><br /><br />
<p><?php echo nl2br($mailcontent); ?> </p>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                </div> 

              <b class="rbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b> 
          </div> 
          <div class="ad">
<?php
do_pc_ad2();
?>
          </div>
          <div id="footer">
          <br />
<?php
do_pchtml_indexfooter();
?>
          </div>
        </div>
        
  </body>
</html>
<?php
  }
  catch (Exception $e) {
?>
    <!-- page content -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>cellme.mobi</title>
  <link type="text/css" rel="stylesheet" href="cellme.css" />
  </head>
  <body>
        <div id="header">
           
        <div id="topcontent">
          <div id="headerlogo">
          <image src="images/logo.jpg" alt="cellme.mobi" />
          </div>
          <div id="login">
<?php
pcdisplay_login_form();
?>
          </div>
          </div>
        </div>
        <div id="allcontent">
  
            <div id="usermenubar">
<?php
do_pcindex_menu();
?>
            </div>
          <div class="ad">
            <br />
<?php
do_pc_ad();
?>
          </div>               
            <div id="nifty"> 
              <b class="rtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b> 
                <div id="logo">
                  <img src="images/logo3.jpg" alt="cellme.mobi" />
                </div>
               <br /><br />
                <h3>Problem</h3><br /><br />
                <p><?php      echo $e->getMessage(); ?><br />
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></a> </p> <br /><br /><br /><br /><br /><br /><br /><br />
              <b class="rbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b> 
          </div> 
          <div class="ad">
<?php
do_pc_ad2();
?>
          </div>
          <div id="footer">
          <br />
<?php
do_pchtml_indexfooter();
?>
          </div>
        </div>
        
  </body>
</html>
<?php
     exit;
  }
?>