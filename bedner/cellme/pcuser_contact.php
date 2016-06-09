<?php
  require_once('mycell_fns.php');
  session_start();
do_pcuser_top();
 $sent = $_GET['sent'];
if (isset($_GET['sent']))  {
if (!validate_get($sent))
{exit;}
}
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
 
<h3>Contact Us</h3><br /> 
<?php
if ($sent == 'problem') { echo '<center><font size="3" color="#F000F0">Problem - Message Not Sent<br />Please check your information and try again</font><br /></center>';}
if ($sent == 'pass') { echo '<center><font size="3" color="#F000F0">Problem - Verification Phrase Does Not Match</font><br /></center>';}
if ($sent == 'email') { echo '<center><font size="3" color="#F000F0">Problem - Please check your email</font><br /></center>';}

?>
<p><br />Please complete the form below.<br /><br /></p> 
 
<form action="pcuser_feedback.php" method="post"> 
 
<p>Name<br /> 
<input type="text" name="name" size="40" value="
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
" /><br /><br /></p> 
     
<p>Email<br /> 
<input type="text" name="email" size="40" value="
<?php 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $email = $row->email;
  echo $email;
     mysqli_close($conn);
?>
" /><br /><br /></p> 
     
<p>Your Comment/Question<br /> 
<textarea name="feedback" rows="10" cols="40" wrap="virtual" /></textarea></p> 
<p> <label for="verify">Verification<br />Enter the phrase below:<br />
</label>
<img src="captcha.php" alt="Verification pass-phrase" /><br />
<input type="text" id="verify" name="verify" size="20" /></p>

<p><input id="mysubmit" type="submit" value="Send feedback" /></p> 
</td>      
 
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

?>