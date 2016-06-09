<?php

 require_once('mycell_fns.php');
 session_start();

//variable names
$name = trim($_POST['name']);
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

//static information
$toaddress = "usercon@cellme.mobi";

$subject = "Advertising from web site";

$mailcontent = "Customer name: ".$name."\n".
			         "Customer email: ".$email."\n".
               "Customer comments: ".$feedback."\n";

$fromaddress = "From: webserver@cellme.mobi";
    if ($_SESSION['pass_phrase'] !== $user_pass_phrase) {
header("Location: user_contact.php?sent=match");
exit;      
       }
    if (!filled_out($_POST) || !valid_email($email)) {

header("Location: user_contact.php?sent=empty");
exit;
    }

else{
//invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();

?>

<h1>Form submitted</h1>
<p>Your information (shown below) has been sent. A representative will be in contact with you as soon as possible. Thank you.</p>
<p><?php echo nl2br($mailcontent); ?> </p><br />
</body>
</html>
<?php
display_user_menu();
do_html_footer();

}?>