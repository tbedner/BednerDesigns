<?php

function filled_out($form_vars) {
  // test that each variable has a value
  foreach ($form_vars as $key => $value) {
     if ((!isset($key)) || ($value == '')) {
        return false;
     }
  }
  return true;
}

function valid_email($address) {
  // check an email address is possibly valid
  if (ereg('^([a-zA-Z0-9_\-])+(\.([a-zA-Z0-9_\-])+)*@((\[(((([0-1])?([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5]))\]))|((([a-zA-Z0-9])+(([\-])+([a-zA-Z0-9])+)*\.)+([a-zA-Z])+(([\-])+([a-zA-Z0-9])+)*))$', $address)) {
    return true;
  } else {
    return false;
  }
}
function validatePhone($cell) {
	$numbersOnly = ereg_replace("[^0-9]", "", $cell);
	$numberOfDigits = strlen($numbersOnly);
	if ($numberOfDigits >= 16 or $numberOfDigits < 7) {
		return false;
	} else {
		return true;
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

function validate_get($sent) {
if (($sent == 'true') || ($sent == 'false') || ($sent == 'false2') || ($sent == 'problem') || ($sent == 'match') || ($sent == 'empty') || ($sent == 'pass') || ($sent == 'email') || ($sent == 'length')){
  return true;
  }
  else {return false;}
}

function validate_photo($sent) {
if (($sent == 'type') || ($sent == 'type2') || ($sent == 'type3') || ($sent == 'empty') || ($sent == 'success') || ($sent == 'false')){
  return true;
  }
  else {return false;}
}

function validate_display($sent) {
if (($sent == 'public') || ($sent == 'private')){
  return true;
  }
  else {return false;}
}

function validate_type($sent) {
if (($sent == 'personal') || ($sent == 'business')){
  return true;
  }
  else {return false;}
}

function validate_letter($sent) {
if (($sent == 'a') || ($sent == 'g') || ($sent == 'm') || ($sent == 's')){
  return true;
  }
  else {return false;}
}
?>
