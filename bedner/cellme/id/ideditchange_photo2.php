<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();

  define('UPLOADPATH', 'photo/');
  define('MAXFILESIZE', 2100000);      // 2 MB
$username = $_SESSION['valid_user'];
  if (isset($_POST['submit'])) {
   
    $photo = trim($_FILES['my_photo']['name']);
    $photo = html_sanitize($photo);
    $photo = sql_sanitize($photo);
    $photo_type = $_FILES['my_photo']['type'];
    $photo_size = $_FILES['my_photo']['size']; 
    if (empty($photo)) {
            header("Location: ideditchange_photo.php?photo=empty");
            exit;
}

    else { 
    $photo = getimagesize($_FILES['my_photo']['tmp_name']);
          if($photo['mime'] != 'image/gif' && $photo['mime'] != 'image/jpeg' && $photo['mime'] != 'image/pjpeg' && $photo['mime'] != 'image/png') {
            header("Location: ideditchange_photo.php?photo=type");
            exit;
            }
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
        foreach ($blacklist as $item) {
        if(preg_match("/$item\$/i", $_FILES['userfile']['name'])) {
            header("Location: ideditchange_photo.php?photo=type2");
          exit;
          }
        }      
    $new_photo=$_SESSION['valid_user'].$photo;
 

  
      if (!empty($new_photo)) {
        if ((($photo_type == 'image/gif') || ($photo_type == 'image/jpeg') || ($photo_type == 'image/pjpeg') || ($photo_type == 'image/png'))
          && ($photo_size > 0) && ($photo_size <= MAXFILESIZE)) {
          
          if ($_FILES['my_photo']['error'] == 0) {
            // Move the file to the target upload folder
            $target = '../photo/'.$new_photo;
            if (move_uploaded_file($_FILES['my_photo']['tmp_name'], $target)) {
              // Write the data to the database
  $target = 'photo/'.$new_photo;
  $conn = db_connect();
  $result = $conn->query("UPDATE user SET photo = '".$target."' where username = '".$username."'");
  $result = $conn->query("UPDATE add_book SET photo = '".$target."' where ent_id = '".$username."'");
  $type = 'success';
 
              mysqli_close($conn);
            }
            else {
  $type = 'false';
            }
          }
        }
        else {
  $type = 'type3';
        }

        // Try to delete the temporary screen shot image file
        @unlink($_FILES['my_photo']['tmp_name']);
      
header("Location: ideditchange_photo.php?photo=$type");     
  }  }
     
}  


?>