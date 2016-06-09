<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 echo '<div class="textbox2">';
 check_valid_user2();
 echo '</div>';

$msgid2=sql_sanitize($_GET['msg']);


// database connection
  $conn = db_connect();


  // find the message
  $result = $conn->query("select * from email, user where email.msgid = '".$msgid2."' and email.from = user.username");     
  $row = $result->fetch_object();
  $msgid = $row->msgid;
  $to = $row->to;
  $from = $row->from;
  $sub = $row->sub;
  $msg = $row->message;
  $emaildate = $row->emaildate;
  $status = $row->status;
  $fname = $row->fname;
  $fname = ucwords($fname);
  $lname = $row->lname;
  $lname = ucwords($lname);
  $photo = $row->photo;
  $username = $row->username;
// change status
  $result = $conn->query("DELETE FROM email WHERE msgid = '".$msgid."'");

  $result = $conn->query("INSERT INTO email values ('".$msgid."', '".$to."', '".$from."', '".$sub."', '".$msg."', '".$emaildate."', 'read')");
  $result = $conn->query("select * from user where username = '".$_SESSION['valid_user']."'");     
  $row2 = $result->fetch_object();
  $fname2 = $row2->fname;
  $lname2 = $row2->lname;
  mysqli_close($conn);
  

?>
<div class="textbox2">
<a href="mailnew.php">Compose</a>&nbsp;&nbsp;
<?php echo '<a href="maildelete.php?msg='.$msgid.'">Delete</a>&nbsp;&nbsp;'; ?>
<a href="mailsent.php">Sent</a>&nbsp;&nbsp;</div>
<?php echo'<img src="'.$photo.'" border="0" height="56" width="51" />';?> 
<div class="update2">
<form action="mailreply2.php" method="post">
&nbsp;To: <?php echo $fname.' '.$lname; ?>
<input placeholder="Subject" name="subject" type="text" /></div><br />
<textarea name="mail" rows="8" cols="20" />


-------------------
<?php echo 'From:'.$fname.' '.$lname; ?>

<?php echo 'To:'.$fname2.' '.$lname2; ?>

<?php echo 'Sent:'.$emaildate; ?>

<?php echo 'Subject:'.$sub; ?>


<?php echo $msg; ?></textarea>
<input type="hidden" name="to" value="<?php echo $username; ?>" /><br />
<input id="mysubmit" type="submit" value="Send Mail" />

  </div>
              </form>

<?php  
 display_user_menu();
 do_html_footer();
?>