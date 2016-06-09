<?php

function db_connect() {
 //This stops SQL Injection in POST vars 
  foreach ($_POST as $key => $value) { 
    $_POST[$key] = mysql_real_escape_string($value); 
  } 

  //This stops SQL Injection in GET vars 
  foreach ($_GET as $key => $value) { 
    $_GET[$key] = mysql_real_escape_string($value); }
  $result = new mysqli('tbedner71.db.10932287.hostedresource.com', 'mycell2', 'Slsmoanalua71!', 'mycell2');
   if (!$result) {
     throw new Exception('Could not connect to database server');
   } else {
     return $result;
   }
}

?>
