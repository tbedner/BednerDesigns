<?php
 require_once('mycell_fns.php');
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
                  <h2>Free Cellular Network</h2> 
                  <br /><br />Sign up! It's free, easy and your cell number is 100% under your control!<br /><br /><br />
                  For a Personal Listing, click below:<br /><br />
                  <a href="pcregister_form.php"><img src="images/plist.jpg" alt="Personal Listing" border="0" /></a>
                  <br /><br />
                  For a Business Listing, click below:
                  <br /> <br />
                  <a href="pcbregister_form.php"><img src="images/blist.jpg" alt="Business Listing" border="0" /></a>
                  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
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