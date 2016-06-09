<?php
  $length = '8'; 

    $var = "abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHIJKLMNPQRSTUVWXZY";  
    srand((double)microtime()*1000000);  
    $i = 0;    $word = '' ;  
    while ($i < $length) {  
        $num = rand() % 33;  
        $tmp = substr($var, $num, 1);  
        $word = $word . $tmp;  
        $i++;  }
    echo $word;
        
?>
