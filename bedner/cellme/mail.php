<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 echo '<div class="textbox2">';
 check_valid_user2();
 echo '</div>';

$msgid2=sql_sanitize($_GET['msg']);
$msgid2=html_sanitize($msgid2);

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
  $msg2 = wordwrap($msg, 25, "<br />");
  $emaildate = $row->emaildate;
  $status = $row->status;
  $fname = $row->fname;
  $fname = ucwords($fname);
  $lname = $row->lname;
  $lname = ucwords($lname);
  $photo = $row->photo;
// change status
  $result = $conn->query("DELETE FROM email WHERE msgid = '".$msgid."'");

  $result = $conn->query("INSERT INTO email values ('".$msgid."', '".$to."', '".$from."', '".$sub."', '".$msg."', '".$emaildate."', 'read')");
  mysqli_close($conn);
 echo '<a href="mailreply.php?msg='.$msgid.'">Reply</a>&nbsp;&nbsp;'; ?> 
<a href="mailnew.php">Compose</a>&nbsp;&nbsp;
<?php echo '<a href="maildelete.php?msg='.$msgid.'">Delete</a>&nbsp;&nbsp;'; ?>
<a href="mailsent.php">Sent</a>&nbsp;&nbsp;<br />
<div class="textbox">
<?php echo $fname.' '.$lname; ?><br /><font size="1" color="#7FB0B0"><?php echo $emaildate; ?></font></div>
<div class="textbox2"><?php echo $sub; ?></div><br />
<pre><?php echo $msg2; ?></pre><br />
<?php  
   
 display_user_menu();
 do_html_footer();
?>