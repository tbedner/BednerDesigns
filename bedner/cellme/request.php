<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
 
  $id=trim($_GET['id']);
  $id2=trim($_GET['id2']);
  if ((strlen($id) > 16) || (strlen($id2) > 16)){
  exit;
  }
  $id=sql_sanitize($id);
  $id2=sql_sanitize($id2);
 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username ='".$id."'");
  $num_row1 = $result->num_rows;
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  $email = $row->email;
  $username = $row->username;
  $result = $conn->query("select * from user
                            where username ='".$id2."'");
  $num_row2 = $result->num_rows;
  $row=$result->fetch_object();
  $fname2 = $row->fname;
  $lname2 = $row->lname;
  $username = $row->username;
  $email2 = $row->email;
  $confirm_code=md5(uniqid(rand()));   
  $conn = db_connect();
  $result = $conn->query("insert into temp_confirm
                            values
                         (NOW(), '$confirm_code', '$username', '$username2')");

  //variable names
$name = $fname.' '.$lname;
$name2 = $fname2.' '.$lname2;

//static information
$toaddress = $email;

$subject = "A request for your cell number from $name";

$mailcontent = "Dear $name,\n \nA request for your cell phone number has been received from $name2.\nIf you would like to accept this request, please click on the link below.\nWhen confirmation is received, your information will be added to their address book and vice versa.\n \nAccept Request at http://www.mycell.com/confirm.php?confirmcode=$confirm_code\nThis link will be active for approximately two weeks. Thank you.\n \nCellMe Support Staff";

$fromaddress = "From: service@cellme.mobi";

  if ($result && ($num_row>0)) {
    echo 'Entry already exists.';
    echo '<br />';
    echo '<br />';
    }
  elseif ($num_row2 == 0 || $num_row1 == 0) {
    echo 'Problem - Request not sent. Please try again.';
    echo '<br />';
    echo '<br />';
    }
    else{
//invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);
   mysqli_close($conn);
?>
<h3>Request submitted</h3>
<p>Your request has been sent. If the email is received and confirmed, you will be sent notification via email that their information has been added to your address book and vice versa. Thank you.<br /></p>
<?php
}
display_user_menu();
do_html_footer();
?>