<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
 
 display_password_form();

 display_user_menu(); 
     do_html_footer();
?>
