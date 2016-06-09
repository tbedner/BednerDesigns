<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
  $username = $_SESSION['valid_user']; 
 $id = trim($_GET['id']);
  if (strlen($id) > 16){
  exit;
  }
  $id=sql_sanitize($id);
  $id=html_sanitize($id);
if ($id == $username){
echo 'Problem - You cannot add yourself as a cellmate. If you would like to store your own number, please use the Add Entries feature of your address book.<br /><br />';
}
else { 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '$id'");
  $row = $result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  $email = $row->email;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $usermode = $row->usermode;
  $conn2 = db_connect();
  $result2 = $conn2->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row2 = $result2->fetch_object();
  $fname2 = $row2->fname;
  $lname2 = $row2->lname;
  $city2 = $row2->city;
  $cell22 = $row2->cell;
  $photo2 = $row2->photo;
  $usermode2 = $row2->usermode; 
if ($id == $username){
echo 'Problem - You cannot add yourself as a cellmate. If you would like to store your own number, please use the Add Entries feature of your address book.<br /><br />';
}
else {  
  echo '<br />';
  echo 'New Entry:';
  echo '<br />';
  echo '<br />';
    if ($photo !== 'photo_default.jpg' ) {
      echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';
      echo $lname.', '.$fname;
      echo '<br />';
      echo $city;
      echo '<br />';
   if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
      echo $new_cell;
      echo '<br />';
}    else  {
      echo $lname.', '.$fname;
      echo '<br />';
      echo $city;
      echo '<br />';
    if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
      echo '<br />';
  } 
  
mysqli_close($conn);
  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat entry
  $result = $conn->query("select * from add_book
                         where username = '$valid_user' and ent_id='$id'");
  $num_row = $result->num_rows;
  if ($result && ($num_row>0)) {
    echo '<br />';
    echo 'Entry already exists.';
      display_user_menu();
      do_ad();
      do_html_footer();
    return;
  }
$cell2 = preg_replace('/[\(\)\-\s]/', '',$cell);
  // insert the new entry
  $result = $conn->query("insert into add_book values
     ('".$valid_user."', '".$id."', '".$fname."', '".$lname."', '".$city."', '".$cell2."', '".$photo."', '".$usermode."')");
  $conn2 = db_connect();

  // check not a repeat entry
  $result2 = $conn2->query("select * from add_book
                         where username = '$id' and ent_id='$valid_user'");
  $num_row2 = $result2->num_rows;
  mysqli_close($conn2);
  if (!$result2 || ($num_row2 == 0)) {

// check for entry in other addbook ,insert and notify
  $result = $conn->query("insert into add_book values
     ('".$id."', '".$valid_user."', '".$fname2."', '".$lname2."', '".$city2."', '".$cell22."', '".$photo2."', '".$usermode2."')"); 
$toaddress = $email;

$subject = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Cellmate';

$mailcontent = $fname2.' '.$lname2.' has added you to their address book. Their information has also been added to yours. Thank you.\n';

$fromaddress = 'From: service@cellme.mobi';     
     //invoke mail() function to send mail
  $result = $conn->query("INSERT INTO email values ('', '".$id."', '".$valid_user."', '".$subject."', '".$mailcontent."', NOW(), 'unread')");
  $result = $conn->query("INSERT INTO sent values ('', '".$id."', '".$valid_user."', '".$subject."', '".$mailcontent."', NOW(), 'unread')");

mail($toaddress, $subject, $mailcontent, $fromaddress);
   }
   } 
mysqli_close($conn);
  }
display_user_menu();
do_html_footer();
?>