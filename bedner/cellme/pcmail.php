<?php
// include function files for this application
require_once('mycell_fns.php');
session_start();
$msgid2=sql_sanitize($_GET['msg']);
$msgid2=html_sanitize($msgid2);
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
<?php

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
  $msg2 = wordwrap($msg, 70, "<br />");
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
  
?>
<div id="usernav2"> 
<a href="pcemail.php">Inbox</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo '<a href="pcmailreply.php?msg='.$msgid.'">Reply</a>&nbsp;&nbsp;&nbsp;&nbsp;'; ?> 
<a href="pcmailnew.php">Compose</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo '<a href="pcmaildelete.php?msg='.$msgid.'">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
<a href="pcmailsent.php">Sent</a>&nbsp;&nbsp;&nbsp;&nbsp; 
</div><br /><br /> 
<table id="emailview" width="550px" align="left">

<tr rowspan="2"><td><?php echo $fname.' '.$lname; ?><br /><font size="1" color="#7FB0B0"><?php echo $emaildate; ?></font><br /><br /></td><td><?php echo $sub; ?><br /><br /></td></tr>
<tr><td><br /><?php echo'<img src="'.$photo.'" border="0" height="56" width="51" />';?><br /><br /></td><td><br /><pre><?php echo $msg2; ?></pre></td></tr>
<tr><td></td><td></td></tr>
</table>
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