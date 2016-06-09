<?php
  // include function files for this application
  require_once('mycell_fns.php');
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
       throw new Exception('Please enter the verification pass-phrase exactly as shown.<br /><br /><a href="javascript:PreviousPage()">Back to Registration Form</a>');
       }
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out completely - please go back and try again.<br /><br /><a href="javascript:PreviousPage()">Back to Registration Form</a>');
    }
    if (!validatePhone($cell)) {
      throw new Exception('That is not a valid cell number. Please go back and try again.<br /><br /><a href="javascript:PreviousPage()">Back to Registration Form</a>');
    }
    // email address not valid
    if (!valid_email($email)) {
      throw new Exception('That is not a valid email address.  Please go back and try again.<br /><br /><a href="javascript:PreviousPage()">Back to Registration Form</a>');
    }

    // passwords not the same
    if ($passwd != $passwd2) {
      throw new Exception('The passwords you entered do not match - please go back and try again.<br /><br /><a href="javascript:PreviousPage()">Back to Registration Form</a>');
    }

        if ((strlen($username) < 6) || (strlen($username) > 16)) {
      throw new Exception('Your username must be between 6 and 16 characters Please go back and try again.<br /><br /><a href="javascript:PreviousPage()">Back to Registration Form</a>');
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
      throw new Exception('Your password must be between 6 and 16 characters Please go back and try again.<br /><br /><a href="javascript:PreviousPage()">Back to Registration Form</a>');
    }
$new_cell = preg_replace('/[\(\)\-\s]/', '',$cell);
    // attempt to register
    // this function can also throw an exception
    register($fname, $lname, $new_cell, $city, $username, $email, $passwd, $usermode, $displaymode, $photo);
    // register session variable
    $_SESSION['valid_user'] = $username;
                
do_pcuser_top();

?>
              
              <table class="member" cellspacing="20"><tr> 
              <td width="205px">
                              <div id="valid">
<?php
                pccheck_valid_user();
?>
                </div>
                              <a href="pcsearch.php"><img src="images/search.jpg" alt="Search" border="0" width="75" height="79" /></a><br />
              <a href="pcadd_book.php"><img src="images/friends.jpg" alt="Search" border="0" width="75" height="79" /></a><br />
              <a href="pcemail.php"><img src="images/email.jpg" alt="Search" border="0" width="75" height="79" /></a><br /><br /> 

              </td>
              <td width="615px" align="center">
                <h3>Registration Successful!</h3><br /><br />
                <p>Welcome, to Cellme.mobi! Click on the MyPage link above to get started quickly.<br /><br />
                Search our listings for members' cell phone numbers. If someone is not listed, 
                easily invite them using our Invite-A-Friend function.<br /><br />
                Manage Contacts in your online Address Book and always have phone numbers wherever there is a computer and the Internet.<br /><br />
                Update all of your contacts in your address book and comment on their updates.<br /><br />
                Send personal messages using our free email service.
            </p> 

              </td> 
              <td width="220px" rowspan="3">

              <b><i>Updates</i></b><br /><br /> 
              <form action="pcaddupdate.php" method="post">
              <input type="text" name="update" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Update">
              </form> 
                            
              
              
                  <form action="pcupdate.php" method="post">
                  <br />
                  <input id="mysubmit" type="submit" value="See Next 10 Updates"/>
                  
                  </form><br /><br />

<?php
do_pcupdates();
?> 
              </td></tr>
              
              
              </table>
<?php                  
do_pcuser_bottom(); 

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
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></a> </p> <br /><br /><br /><br /><br /><br />
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