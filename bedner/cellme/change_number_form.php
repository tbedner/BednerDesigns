<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user();
 
 display_number_form();

 display_user_menu(); 
 do_html_footer();
?>
