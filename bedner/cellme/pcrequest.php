<?php
 require_once('mycell_fns.php');
 session_start();
 do_pcuser_top();
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
  $username2 = $row->username;
  $email2 = $row->email;
  $confirm_code=md5(uniqid(rand()));   
  $conn = db_connect();
  $result = $conn->query("insert into temp_confirm
                            values
                         (NOW(), '$confirm_code', '$username', '$username2')");
 
  //variable names
$name = $fname.' '.$lname;
$name2 = $fname2.' '.$lname2;
mysqli_close($conn);
//static information
$toaddress = $email;

$subject = "A request for your cell number from $name";

$mailcontent = "Dear $name,\n \nA request for your cell phone number has been received from $name2.\nIf you would like to accept this request, please click on the link below.\nWhen confirmation is received, your information will be added to their address book and vice versa.\n \nAccept Request at http://cellme.mobi/confirm.php?confirmcode=$confirm_code\nThis link will be active for approximately two weeks. Thank you.\n \nCellMe Support Staff";

$fromaddress = "From: service@cellme.mobi";


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

  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat entry
  $result = $conn->query("select * from add_book
                         where username = '$valid_user' and ent_id='$id'");
  $num_row = $result->num_rows;
  if ($result && ($num_row>0)) {
       echo '<br />';
    echo 'Entry already exists.';
    echo '<br />';
    echo '<br />';
    }
      elseif ($num_row2 == 0 || $num_row1 == 0) {
    echo 'Problem - Request not sent. Please try again.';
    echo '<br />';
    echo '<br />';
    }

else {    
 //invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);

$cell2 = preg_replace('/[\(\)\-\s]/', '',$cell);
  // insert the new entry
  if (!$conn->query("insert into add_book values
     ('".$valid_user."', '".$id."', '".$fname."', '".$lname."', '".$city."', '".$cell2."', '".$photo."', '".$usermode."')")) {
   mysqli_close($conn);
 }
 

    
  
?>              
                  <p><h3>Request submitted</h3></p>
                  <br /><br />
<p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your request has been sent. If the email is received and confirmed, you will be sent notification via email that their information has been added to your address book and vice versa. Thank you.<br /></p>
<?php 
}
 
?>
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

