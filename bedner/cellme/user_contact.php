<?php
  require_once('mycell_fns.php');
  session_start();
  $sent = $_GET['sent'];
if (isset($_GET['sent']))  {
if (!validate_get($sent))
{exit;}
}  do_html_mypageheader('cellme.mobi');
  check_valid_user2();
?>
<div class="textbox2"><h4>Contact Us</h4></div> 
<?php
if ($sent == 'empty') { echo '<br /><center><font size="3" color="#F000F0">Problem - Message not sent<br />Please check your information and try again</font><br /></center>';}
if ($sent == 'match') { echo '<br /><center><font size="3" color="#F000F0">Problem - Pass Phrase does not match<br />Please try again</font><br /></center>';}

?>
<p>Please complete the form below.</p> 
 
<form action="user_feedback.php" method="post"> 
 
<p>Name<br/> 
<input type="text" name="name" size="20" value="<?php 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  echo $fname.' '.$lname;
     mysqli_close($conn);
?>
" /></p> 
     
<p>Email<br/> 
<input type="text" name="email" size="20" value="
<?php 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $email = $row->email;
  echo $email;
     mysqli_close($conn);
?>
" /></p> 
     
<p>Your Comment/Question<br/> 
<textarea name="feedback" rows="8" cols="20" wrap="virtual" /></textarea></p> 
<p> <label for="verify">Verification<br />Enter the phrase below:<br />
</label>
<img src="captcha.php" alt="Verification pass-phrase" /><br />
<input type="text" id="verify" name="verify" size="20" /></p>     
<p><input id="mysubmit" type="submit" value="Send feedback" /></p> 
 
</form> 
<?php
display_user_menu();
?> 
 
</body> 
</html>
<?php
do_html_footer();
?>