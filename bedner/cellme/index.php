<?php
 require_once('mycell_fns.php');
/*include('mobile_device_detect.php');
mobile_device_detect('http://cellme.mobi/id/id.php','http://cellme.mobi/id/id.php',true,true,true,true,false,false); */

require_once ('Mobile_Detect.php');
$detect = new Mobile_Detect();

if ($detect->isMobile()) {
    // Any mobile device.
?>
    <meta http-equiv="Refresh" content="0; url=http://www.bednerdesigns.com/cellme/id/id.php">
<?php
}

  $sent = $_GET['confirm'];
if (isset($_GET['confirm']))  {
if (!validate_get($sent))
{exit;}
} 
if ($mobile_browser==true) {


do_html_header('cellme.mobi');
do_ad();
?>
<div class="textbox3"><h4>Free Cellular Network</h4></div>
<?php
if ($sent == 'true') { echo '<br /><center><font size="3" color="#F000F0">Request Confirmed and Cellmate added</font><br /></center>';}
 display_login_form();
?>
    <p>
      <a href="about.php">Why  join? <br /><img src="images/about.png" alt="About Us" border="0" /></a>
    </p>
<?php
do_ad();
do_html_indexfooter();

}
else {
?>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>cellme.mobi</title>
  <link type="text/css" rel="stylesheet" href="cellme.css" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
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
                  <image src="images/logo3.jpg" alt="cellme.mobi" />
                </div>
                <div id="box">
<?php
if ($sent == 'true') { echo '<br /><center><font size="3" color="#F000F0">Request Confirmed and Cellmate added</font><br /></center>';}
?>
                  <h2>Cellme is a cellular network helping you to find and connect to your mobile friends</h2> 
                  <br />
                  <a href="pcregister.php"><img class="button" src="images/join.jpg" alt="Join Now for Free" /></a><br /><br />
                  Find cell phone numbers in our online directory.<br /><br />
                  Stay in touch with friends via email or updates.<br /><br />
                  Keep your cell number private. You have 100% control.<br /><br />
                  Update your new number with all of your friends with a single change.<br /><br />
                  Designed for easy access from your cell phone.<br /><br /><br />
                  
                  <a href="pcabout.php">Why else should you join? Click here to learn more about our free services!</a><br />
                  <br /><br /><br /><br />
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
?>
