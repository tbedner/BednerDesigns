<?php
 require_once('mycell_fns.php');
 do_html_header('cellme.mobi');
?>
<html> 
<head><title>Contact Us</title></head> 
<body> 
 
<h3><font color="black"><center>Advertising Contact</center></font></h3> 
<p><img src="ad1.jpg" alt="Text Ad" height="10%" width="100%"></p>
<p>Please complete the form below and a representative will be in contact with you soon.</p> 
 
<form action="adv_feedback.php" method="post"> 
 
<p>Name<br/> 
<input type="text" name="name" size="40" /></p> 
     
<p>Email<br/> 
<input type="text" name="email" size="40" /></p> 
     
<p>Your Message<br/> 
<textarea name="feedback" rows="8" cols="40" wrap="virtual" /></textarea></p> 
     
<p><input type="submit" value="Send feedback" /></p> 
 
</form> 
<p><img src="ad1.jpg" alt="Text Ad" height="10%" width="100%"></p>
 
</body> 
</html>
<?php
    require('footer.php');
    ?>