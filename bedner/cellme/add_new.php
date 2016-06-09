<?php
  // include function files for this application
  require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();

  $fname=trim($_POST['fname']);
  $fname=sql_sanitize($fname);
  $fname=html_sanitize($fname);
  $lname=trim($_POST['lname']);
  $lname=sql_sanitize($lname);
  $lname=html_sanitize($lname);
  $cell=trim($_POST['cell']);
if (!validatePhone($cell)) {exit;}
  $city=trim($_POST['city']);
  $city=sql_sanitize($city);
  $city=html_sanitize($city);
  $usermode=trim($_POST['usermode']);
if (!validate_type($usermode)) {exit;}  
  $photo='photo_default.jpg';
  $ent_id=$fname.$lname;
  $cell2 = preg_replace('/[\(\)\-\s]/', '',$cell);
  

  $username = $_SESSION['valid_user'];
    try {
    
    if (!filled_out($_POST)) {
      echo '<br />';
      throw new Exception('You have not filled out the form completely. Please go back and try again.');
    }


 
  // connect to db
  $conn = db_connect();
  $result = $conn->query("insert into add_book values
                         ('".$username."', '".$ent_id."', '".$fname."', '".$lname."', '".$city."', '".$cell2."', '".$photo."', '".$usermode."')");

  echo '<br />';
  echo 'New Entry:';
  echo '<br />';
  echo '<br />';
    if ($usermode == 'personal'){
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
  } }
elseif ($usermode == 'business'){
    if ($photo !== 'photo_default.jpg' ) {
      echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';
      echo $fname.', '.$lname;
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
      echo $fname.', '.$lname;
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
  } }
  mysqli_close($conn);
  }
    catch (Exception $e) {
    echo $e->getMessage();
  }
display_user_menu();

do_html_footer();
?>
  
  