<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 echo '<div class="textbox2">';
 check_valid_user2();
 echo '</div>';
 $username = $_SESSION['valid_user'];

?>
<div class="textbox2">
<a href="email.php">Inbox</a>&nbsp;&nbsp;
<a href="mailsent.php">Sent</a>&nbsp;&nbsp;</div><br />
<form action="mailnew2.php" method="post">
<input placeholder="To" name="to" type="text" /><br /><br />
<input placeholder="Subject" name="subject" type="text" /><br /><br />
<textarea name="mail" rows="8" cols="20" /></textarea>
<input type="hidden" name="from" value="<?php echo $username; ?>" /><br />
<input id="mysubmit" type="submit" value="Send Mail" />
</div>
</form>
<?php  
 display_user_menu();
 do_html_footer();
?>