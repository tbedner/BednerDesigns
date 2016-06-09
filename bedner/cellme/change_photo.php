<?php
require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
  define('UPLOADPATH', 'images/');
  define('MAXFILESIZE', 2100000);      // 2 MB
$username = $_SESSION['valid_user'];
  if (isset($_POST['submit'])) {
   
    $photo = trim($_FILES['my_photo']['name']);
    $photo = html_sanitize($photo);
    $photo = sql_sanitize($photo);
    $photo_type = $_FILES['my_photo']['type'];
    $photo_size = $_FILES['my_photo']['size']; 
    if (empty($photo)) {
            echo "Sorry, the upload field was empty. Please try again.\n";
?>
       <p>Choose an image and click upload. <br /></p>
        <p>
        <form name="form2" enctype="multipart/form-data" method="post" action="change_photo.php" />
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAXFILESIZE; ?>" />
            <p><input type="file" size="10" name="my_photo" /></p>
            <p class="button"><input type="hidden" name="action" value="image" /></p>
            <p><input id="mysubmit" type="submit" name="submit" value="upload" /></p>
        </form><br />
        </p>
<?php
            
            
            display_user_menu();
            do_html_footer();
            exit;
            }
    else { 
    $photo = getimagesize($_FILES['my_photo']['tmp_name']);
          if($photo['mime'] != 'image/gif' && $photo['mime'] != 'image/jpeg' && $photo['mime'] != 'image/pjpeg' && $photo['mime'] != 'image/png') {
            echo "Sorry, we only accept GIF, PNG and JPEG images of 2MB or less\n";
            display_user_menu();
            do_html_footer();
            exit;
            }
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
        foreach ($blacklist as $item) {
        if(preg_match("/$item\$/i", $_FILES['userfile']['name'])) {
          echo "We do not allow uploading PHP files\n";
            display_user_menu();
            do_html_footer();          
          exit;
          }
        }      
    $new_photo=$_SESSION['valid_user'].$photo;
 

  
      if (!empty($new_photo)) {
        if ((($photo_type == 'image/gif') || ($photo_type == 'image/jpeg') || ($photo_type == 'image/pjpeg') || ($photo_type == 'image/png'))
          && ($photo_size > 0) && ($photo_size <= MAXFILESIZE)) {
          
          if ($_FILES['my_photo']['error'] == 0) {
            // Move the file to the target upload folder
            $target = 'photo/'.$new_photo;
            if (move_uploaded_file($_FILES['my_photo']['tmp_name'], $target)) {
              // Write the data to the database
  $conn = db_connect();
  $result = $conn->query("UPDATE user SET photo = '".$target."' where username = '".$username."'");
  $result = $conn->query("UPDATE add_book SET photo = '".$target."' where ent_id = '".$username."'");
  
             echo '<br />';
             echo '<br />';
             echo 'Upload successful. You may need to refresh the page to see the change.';
             echo '<br />';
             echo '<br />';

  
              mysqli_close($conn);
            }
            else {
              echo '<p class="error">Sorry, there was a problem uploading your photo.</p>';
            }
          }
        }
        else {
          echo '<p class="error">The photo must be a GIF, JPEG, or PNG image file no greater than ' . (MAXFILESIZE/100000) . ' MB in size.</p>';
        }

        // Try to delete the temporary screen shot image file
        @unlink($_FILES['my_photo']['tmp_name']);
      }
      
    }
     
}  
  display_user_menu();
do_html_footer();
?>