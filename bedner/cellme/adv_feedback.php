<?php
require_once('mycell_fns.php');
 do_html_indexheader('');
//variable names
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$feedback = trim($_POST['feedback']);

//static information
$toaddress = "advertising@cellme.mobi";

$subject = "Advertising from web site";

$mailcontent = "Customer name: ".$name."\n".
			         "Customer email: ".$email."\n".
               "Customer comments:\n".$feedback."\n";

$fromaddress = "From: webserver@cellme.mobi";

//invoke mail() function to send mail
mail($toaddress, $subject, $mailcontent, $fromaddress);

?>
<html>
<head>
<title>cellme.mobi - Form Submitted</title>
</head>
<body>
<h1>Form submitted</h1>
<p><br />Your information (shown below) has been sent. A representative will be in contact with you soon. Thank you.</p>
<p><br /><?php echo nl2br($mailcontent); ?> </p>
</body>
</html>
<?php
    require('footer.php');
?>