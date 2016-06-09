<?php
// include function files for this application
require_once('../mycell_fns.php');
session_start();
  $new_displaymode = trim($_POST['new_displaymode']);
  $new_displaymode = sql_sanitize($new_displaymode);
  $new_displaymode = html_sanitize($new_displaymode);
 
if (!validate_display($new_displaymode))
{exit;}
 
    
    if (change_displaymode($_SESSION['valid_user'], $new_displaymode) == false)  
    
    {
    header("Location: ideditchange_display.php?change=false");

    }
    else{  
header("Location: ideditchange_display.php?change=true");
}
?>