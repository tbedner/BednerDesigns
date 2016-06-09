<?php

function db_connect() {

  $result = new mysqli('tbedner71.db.10932287.hostedresource.com', 'tbedner71', 'Slsmoanalua71!', 'tbedner71');

  /*$result = new mysqli('localhost', 'root', '', 'tbedner71');*/
   if (!$result) {
     throw new Exception('Could not connect to database server');
   } else {
     return $result;
   }

}

function sql_sanitize($sCode) {
        $sCode = addslashes($sCode); // Precede sensitive characters with a slash \
        return $sCode; // Return the sanitized code
}

function html_sanitize($sCode) {
        $sCode = strip_tags($sCode);
        $sCode = htmlspecialchars($sCode);
        return $sCode; // Return the sanitized code
}

function valid_email($address) {
  // check an email address is possibly valid
if (filter_var($address, FILTER_VALIDATE_EMAIL)) {
    return true;
  } else {
    return false;
  }
}

function validatePhone($cell) {
	$numbersOnly = preg_replace("[^0-9]", "", $cell);
	$numberOfDigits = strlen($numbersOnly);
	if ($numberOfDigits >= 16 or $numberOfDigits < 7) {
		return false;
	} else {
		return true;
	}
}

function navigation() {
?>
<nav id="primary">
				<ul>
					<li>
						
						<a class="home" href="#home">Home</a>
					</li>
					<li>
						
						<a class="whatwedo" href="#whatwedo">What We Do</a>
					</li>
					<li>
						
						<a class="about" href="#about">About</a>
					</li>
<!--					<li>
						
						<a class="service" href="#service">Service</a>
					</li> -->
					<li>
						
						<a class="portfolio" href="#portfolio">Our Portfolio</a>
					</li>
					<li>
						
						<a class="contact" href="#contact">Contact</a>
					</li>
				</ul>
			</nav>
<?php
}

function quote() {
  $id= rand(1, 14);	
  $conn = db_connect();
  // get quote from database and assign to variable
  $result = $conn->query("select * from quotes
                         where id='".$id."'");
  $row=$result->fetch_object();
  $quote = $row->quote;
  $author = $row->author;
  mysqli_close($conn);
  echo $quote."<br />-".$author;
}

function validate_flag($flag) {
if ($flag == '1'){
  return true;
  }
  else {return false;}
}

function contact() {
?>
		<form action="<?php echo $_SERVER['PHP_SELF']."#contact"; ?>" method="post" autocomplete="on"> 
		<p>
		<?php
		echo $message;
		?>	
		</p>
        <p>
        <input placeholder="Name" type="text" name="name" style="font-size:14pt;height:30px" size="35" value="<?php echo $name; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
        <input placeholder="Organization" type="text" name="organization" style="font-size:14pt;height:30px" size="35" value="<?php echo $organization; ?>" />
        </p> 
        <p>
        <input placeholder="Email" type="text" name="email" style="font-size:14pt;height:30px" size="35" value="<?php echo $email; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
        <input placeholder="Phone Number" type="text" name="phone" style="font-size:14pt;height:30px" size="35" value="<?php echo $phone; ?>" />
        </p> 
        <p>
        <textarea placeholder="Provide any additional comment regarding your inquiry, including project details, scope, background, etc." name="feedback" style="font-size:14pt;" rows="8" cols="58" wrap="virtual" /><?php echo $feedback; ?></textarea></p> 
        <input type="hidden" name="flag" value="1" />     
        <div id="submit"><input id="mysubmit" type="submit" value="Send Inquiry" /></div>
        <br /><br />
        </form>
<?php	
}
?>