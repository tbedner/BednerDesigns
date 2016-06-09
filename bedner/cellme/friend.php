<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
?>
    <!-- page content -->
    
    <p>
    Have an email sent to your friends inviting them to join CellMe!<br />
    <a href="tellafriend.php">Use your email address book</a>
    <br />-OR-<br />
    Send them individually using the form below
    <form action="invite_form.php" method="post"> 
    <p>To:<br /> 
    <input type="text" name="to" size="10" /></p> 
    <p>Email:<br /> 
    <input type="text" name="email" size="10" /></p> 
    <p>From: <br /> 
    <input type="text" name="user" size="10" value="
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
    <p>Your Message:<br /> 
    <textarea name="feedback" rows="8" cols="19" wrap="virtual" />I found an interesting website you might like at http://cellme.mobi. It is a great way to look up cell phone numbers as well as keep and access your cell numbers on the web. The best part is it is free!</textarea></p> 
    <p> <label for="verify">Verification<br />Enter the phrase below:<br />
</label>
<img src="captcha.php" alt="Verification pass-phrase" /><br />
<input type="text" id="verify" name="verify" size="20" /></p>
<p><input id="mysubmit" type="submit" value="Send email" /></p> 
    </form> 
 
   </p>
<?php
display_user_menu();
do_html_footer();
?>