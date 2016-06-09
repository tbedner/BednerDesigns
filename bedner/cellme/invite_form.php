<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();

//variable names
$name = trim($_POST['to']);
$name = sql_sanitize($name);
$name = html_sanitize($name);
$email = trim($_POST['email']);
$email = sql_sanitize($email);
$email = html_sanitize($email);
$feedback = trim($_POST['feedback']);
$feedback = sql_sanitize($feedback);
$feedback = html_sanitize($feedback);
$user_pass_phrase = SHA1($_POST['verify']);
$user_pass_phrase = sql_sanitize($user_pass_phrase);
$user_pass_phrase = html_sanitize($user_pass_phrase);
$user = $_POST['user'];
$user = sql_sanitize($user);
$user = html_sanitize($user);

if (empty($name) || empty($email) || !valid_email($email) || empty($feedback) || empty($user))  {
echo '<br />Please go back and fill in the form completely.<br /><br />';
display_user_menu();
do_html_footer();
exit;
}
elseif ($_SESSION['pass_phrase'] !== $user_pass_phrase) {
echo '<br />Verification phrase does not match. Please go back and try again.<br /><br />';
display_user_menu();
do_html_footer();
exit;      
       }
          else{
//static information
$toaddress = $email;

$subject = "Check out this site";

$mailcontent = $feedback;
 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $user2 = $row->email;

$fromaddress = $user2;
   mysqli_close($conn);
//invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);

?>
<h1>Form submitted</h1>
<p><br />Your message (shown below) has been sent to <?php echo $name; ?>. Thank you.</p>
<p><br /><?php echo nl2br($mailcontent); ?> </p>

<?php
display_user_menu();
do_html_footer();
}
?>