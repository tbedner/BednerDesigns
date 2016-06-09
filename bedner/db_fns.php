<?php

function db_connect() {

  $result = new mysqli('mycell2.db.10932287.hostedresource.com', 'mycell2', 'Slsmoanalua71!', 'mycell2');
   if (!$result) {
     throw new Exception('Could not connect to database server');
   } else {
     return $result;
   }
}

?>
