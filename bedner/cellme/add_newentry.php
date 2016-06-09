<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();

?>

 <form method="post" action="add_new.php">
 <p class="header"">
  <i>New Entry</i><br />
  <div id="search">
  **Note - These entries will not receive automatic updates.
  </div>
  First Name<br />
  <input type="text" name="fname" size="10" maxlength="100" /><br />
  Last Name<br />
  <input type="text" name="lname" size="10" maxlength="100" /><br />
  Cell Phone<br />
  <input type="text" name="cell" size="10" maxlength="30" /><br />
  City and State/Country<br />
  <input type="text" name="city" size="10" maxlength="100" />
  <input type="hidden" name="usermode" value="personal"/><br />
  <input id="mysubmit" type="submit" value="Add Entry">
  </p></form>
   
<?php     
display_user_menu();

do_html_footer();
?>