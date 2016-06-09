<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
  $old_passwd = trim($_POST['old_passwd']);
  $old_passwd = html_sanitize($old_passwd);
  $old_passwd = sql_sanitize($old_passwd);
  $new_passwd = trim($_POST['new_passwd']);
  $new_passwd = html_sanitize($new_passwd);
  $new_passwd = sql_sanitize($new_passwd);
  $new_passwd2 = trim($_POST['new_passwd2']);
  $new_passwd2 = html_sanitize($new_passwd2);
  $new_passwd2 = sql_sanitize($new_passwd2);

    if (!filled_out($_POST)) {

header("Location: ideditchange_password.php?change=false2");
exit;
    }

elseif ($new_passwd != $new_passwd2) {
header("Location: ideditchange_password.php?change=match");
exit;

}    

elseif ((strlen($new_passwd) > 16) || (strlen($new_passwd) < 6)) {
header("Location: ideditchange_password.php?change=length");
exit;

}
   
    else{
    
    if (change_password2($_SESSION['valid_user'], $old_passwd, $new_passwd) == false)  
    
    {
    header("Location: ideditchange_password.php?change=false");

    }
    else{  
header("Location: ideditchange_password.php?change=true");
}}
?>