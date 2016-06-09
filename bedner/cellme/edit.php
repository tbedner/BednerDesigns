<?php
require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
?>
<html>
<head>
<h3>Edit Profile</h3>
</head>
<body>
<p class="mypage">  
<a href="change_name_form.php">Name<br /></a> 
<a href="photo.php">Photo<br /></font></a>
<a href="change_number_form.php">Cell #<br /></a> 
<a href="change_passwd_form.php">Password<br /></a>
<a href="change_email_form.php">Email<br /></a> 
<a href="change_city_form.php">City<br /></a> 
<a href="change_display_form.php">Display Setting<br /></a> 
</p>
<?php
display_user_menu();

do_html_footer();
?>
