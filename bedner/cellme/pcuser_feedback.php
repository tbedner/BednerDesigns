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
$user = $_SESSION['valid_user'];
//static information
$toaddress = "usercon@cellme.mobi";

$subject = "Advertising from web site";

$mailcontent = "Customer name: ".$name."\n".
			         "Customer email: ".$email."\n".
               "Customer comments: ".$feedback."\n";

$fromaddress = "From: webserver@cellme.mobi";
$user_pass_phrase = SHA1($_POST['verify']);
if (empty($name) || empty($email) || empty($feedback) || !valid_email($email) || ($_SESSION['pass_phrase'] !== $user_pass_phrase))  {


if ($_SESSION['pass_phrase'] !== $user_pass_phrase)  {
 header("Location: pcuser_contact.php?sent=pass");

exit;
}

if (empty($email) ||!valid_email($email))  {
 header("Location: pcuser_contact.php?sent=email");

exit;
}

if (empty($name) || empty($feedback))  {
 header("Location: pcuser_contact.php?sent=problem");

exit;
}  }
else{
//invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);
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
              <h3>Form submitted</h3><br /><br />
              <p align="left">Your information (shown below) has been sent. A representative will be in contact with you as soon as possible. Thank you.</p>
              <br /><br /><p><?php echo nl2br($mailcontent); ?> </p>

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


}?>