<?php
require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user();
 

   // Define application constants
  define('UPLOADPATH', 'images/');
  define('MAXFILESIZE', 2100000);      // 2 MB
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
?>