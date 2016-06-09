<?php
 require_once('../mycell_fns.php');
 session_start();

  $id=$_GET['id'];
  $id2=$_GET['id2'];

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
<meta content="yes" name="apple-mobile-web-app-capable" /> 
<meta content="index,follow" name="robots" /> 
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" /> 
<link href="images/cellme.png" rel="apple-touch-icon" /> 
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" />
 
<script src="javascript/functions.js" type="text/javascript"></script> 
<title>cellme.mobi
</title> 
<meta content="iPod,iPhone,free" name="keywords" /> 
<meta content="A Cellular Network where you can find friends' cell phone numbers" name="description" /> 
</head> 
 
<body> 
 
<div id="topbar"> <img alt="logo" src="images/logo.jpg" />
	<div id="title"> 
		 cellme</div>  
	<div id="leftnav"><a href="idemail.php">Inbox</a></div><div id="rightnav"><a href="idadd_book.php">Friends</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem"><li class="textbox"> 
<?php
idcheck_valid_user2();
?>

<h4>Request Submission</h4>
 	
<?php  

  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat entry
  $result = $conn->query("select * from add_book
                         where username = '$valid_user' and ent_id='$id'");
  $num_row = $result->num_rows;
  if ($result && ($num_row>0)) {
    echo 'Entry already exists.';
    echo '<br />';
    echo '<br />';
?>
 </ul>
 	<ul class="pageitem">  
		<li class="menu"><a href="idsearch.php"> 
		<img alt="Search" src="thumbs/idusersearch.png" /><span class="name">Search Personal Listings</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idadd_book.php"> 
		<img alt="Friends" src="thumbs/addbook.png" /><span class="name">Friends</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idemail.php"> 
		<img alt="Inbox" src="thumbs/mail.png" /><span class="name">Inbox<?php new_mail2(); ?></span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idupdate.php"> 
		<img alt="Updates" src="thumbs/update.png" /><span class="name">Updates</span><span class="arrow"></span></a></li> 
 </ul>
             
              
<?php
do_idad();
do_idmypage_menu();
?>		
	</ul> 
	
</div> 
<?php
do_idmypage_footer();
?>
 
</body> 
 
</html> 
<?php
}

  elseif ($num_row2 == 0 || $num_row1 == 0) {
    echo 'Problem - Request not sent. Please try again.';
    echo '<br />';
    echo '<br />';
       mysqli_close($conn);

?>
 </ul>
 	<ul class="pageitem">  
		<li class="menu"><a href="idsearch.php"> 
		<img alt="Search" src="thumbs/idusersearch.png" /><span class="name">Search Personal Listings</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idadd_book.php"> 
		<img alt="Friends" src="thumbs/addbook.png" /><span class="name">Friends</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idemail.php"> 
		<img alt="Inbox" src="thumbs/mail.png" /><span class="name">Inbox<?php new_mail2(); ?></span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idupdate.php"> 
		<img alt="Updates" src="thumbs/update.png" /><span class="name">Updates</span><span class="arrow"></span></a></li> 
 </ul>
             
              
<?php
do_idad();
do_idmypage_menu();
?>		
	</ul> 
	
</div> 
<?php
do_idmypage_footer();
?>
 
</body> 
 
</html> 
<?php
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
<p class="info">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your request has been sent. If the email is received and confirmed, you will be sent notification via email that their information has been added to your address book and vice versa. Thank you.
</p> 
 </ul>
 	<ul class="pageitem">  
		<li class="menu"><a href="idsearch.php"> 
		<img alt="Search" src="thumbs/idusersearch.png" /><span class="name">Search Personal Listings</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idadd_book.php"> 
		<img alt="Friends" src="thumbs/addbook.png" /><span class="name">Friends</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idemail.php"> 
		<img alt="Inbox" src="thumbs/mail.png" /><span class="name">Inbox<?php new_mail2(); ?></span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idupdate.php"> 
		<img alt="Updates" src="thumbs/update.png" /><span class="name">Updates</span><span class="arrow"></span></a></li> 
 </ul>
             
              
<?php
do_idad();
do_idmypage_menu();
?>		
	</ul> 
	
</div> 
<?php
do_idmypage_footer();
?>
 
</body> 
 
</html> 
<?php
}
?> 