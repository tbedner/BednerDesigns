<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();

?>
    
  <div class="textbox"><h4>My CellMates</h4></div><br />
  <div id="search">
    <form action="add_book2.php" method="post">
    Listing Type<br />
    Personal <input type="radio" checked="checked" value="personal" name="type" />
    Business  <input type="radio" value="business" name="type" /><br /><br />
    Cellmate Records<br />
    A-F <input type="radio" checked="checked" value="a" name="letter" />
    G-L <input type="radio" value="g" name="letter" /><br />
    M-R <input type="radio" value="m" name="letter" />
    S-Z <input type="radio" value="s" name="letter" /><br />
    <input id="mysubmit" type="submit" value="Get Contacts" />
  </div>
  <div>
    <input type="hidden" value="1" name="go" />
  </div>
</form> 
<?php

  echo '<br />';
  echo 'Add Personal Entries:';
  echo '<br />';  
  echo '<div class="navbar3"><a href="add_newentry.php">Add Entry</a></div>';
  echo '<br />';
  echo 'Add Business Entries:';
  echo '<br />';  
  echo '<div class="navbar3"><a href="add_bnewentry.php">Add Entry</a></div>';
  echo '<br />';

display_user_menu();
do_html_footer();
?>
  
  