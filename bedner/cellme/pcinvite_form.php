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
$user = $_POST['user'];
$user = sql_sanitize($user);
$user = html_sanitize($user);


//static information
$toaddress = $email;

$subject = "Check out this site";

$mailcontent = $feedback;


if (empty($name) || empty($email) || empty($feedback) || empty($user) || !valid_email($email) || $_SESSION['pass_phrase'] !== $user_pass_phrase)  {
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
                  <p><br />Please double-check the form and try again.<br /><br />
    </p><h3>Email Friends</h3> 

    <form action="pcinvite_form.php" method="post"> 
    <p>To:<br /> 
    <input type="text" name="to" size="40" value="<?php echo $name; ?>" /></p> 
    <p>Email:<br /> 
    <input type="text" name="email" size="40" value="<?php echo $email; ?>" /></p> 
    <p>From: <br /> 
    <input type="text" name="user" size="40" value="
<?php 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  echo $fname.' '.$lname;
     mysqli_close($conn);
?>
"/></p>
    <p>Your Message:<br/> 
    <textarea name="feedback" rows="6" cols="40" wrap="virtual" />I found an interesting website you might like at http://cellme.mobi. It is a great way to look up cell phone numbers as well as store and access your cell numbers on the web. The best part is it is free!</textarea></p> 
<p> <label for="verify">Verification<br />Enter the phrase below:<br />
</label>
<img src="captcha.php" alt="Verification pass-phrase" /><br />
<input type="text" id="verify" name="verify" size="20" /></p>
    <p><input id="mysubmit" type="submit" value="Send email" /></p> 
    </form> 
     
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

exit;
}
else{

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
              <h3>Email Sent</h3><br /><br />
<?php
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $user2 = $row->email;

$fromaddress = $user2;
   mysqli_close($conn);
//invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);

?>

<p><br /><br />Your message (shown below) has been sent to <?php echo $name; ?>. Thank you.</p>
<p><br /><br /><?php echo nl2br($mailcontent); ?> </p>
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