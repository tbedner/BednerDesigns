<?php

// include function files for this application
require_once('mycell_fns.php');
session_start();

//create short variable names
$username = $_POST['username'];
$username = sql_sanitize($username);
$username = html_sanitize($username);
$password = $_POST['password'];
$password = sql_sanitize($password);
$password = html_sanitize($password);

if ($username && $password) {
// they have just tried logging in
  try  {
    login($username, $password);
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $username;
  }
  catch(Exception $e)  {
    // unsuccessful login
do_pcindex_top();
?>
                  <br /><br />
                  <h2>Problem</h2> 
                  <br /><br />
                  <p>You could not be logged in.
          You must be logged in to view this page.
          Please check your username and password and try again.</p><br /> 
                  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
do_pcindex_bottom();
    exit;
  }
}
do_pcuser_top();

?>
              
              <table class="member" cellspacing="20"><tr>
              <td width="205px" rowspan="2">
                              <div id="valid">
<?php
                pccheck_valid_user();
?>
                </div>
              </td>
              <td width="205px">
              <a href="pcsearch.php"><img src="images/search.jpg" alt="Search" border="0" /></a><br /><br /><a href="pcsearch.php">Search the listings and find friends' cell numbers. If they are not listed, invite them via email using the link above.</a>
              <br /><br /><br /><br /><a href="pcsearch.php"><img src="images/go.jpg" alt="Go!" border="0px" /></a></td>
              <td width="205px">
              <a href="pcadd_book.php"><img src="images/friends.jpg" alt="Search" border="0" /></a><br /><br /><a href="pcadd_book.php">Manage your friends and contacts in your address book. If a contact number is changed, you are updated automatically!</a>
              <br /><br /><br /><a href="pcadd_book.php"><img src="images/go.jpg" alt="Go!" border="0px" /></a></td>
              <td width="195px">
              <a href="pcemail.php"><img src="images/email.jpg" alt="Search" border="0" /></a><br /><br /><a href="pcemail.php">Go to your inbox,<br />read messages and take care of your mail. You know the rest...</a> 
              <br /><br /><br /><br /><br /><a href="pcemail.php"><img src="images/go.jpg" alt="Go!" border="0px" /></a></td>
                 
              <td width="220px" rowspan="2">
              <b><i>Updates</i></b><br /><br /> 
              <form action="pcaddupdate.php" method="post">
              <input type="text" name="update" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Update">
              </form> 
                            
              
              
                  <form action="pcupdate.php" method="post">
                  <br />
                  <input id="mysubmit" type="submit" value="See Next 10 Updates"/>
                  
                  </form><br /><br />

<?php
do_pcupdates();
?>                   
              </td></tr>
                
              </table>
<?php
do_pcuser_bottom();

?>