<?php

require_once('db_fns.php');

function register($fname, $lname, $cell, $city, $username, $email, $password, $usermode, $displaymode, $photo) {
// register new person with db
// return true or error message

  // connect to db
  $conn = db_connect();
  $usermode = 'personal';
  // check if username is unique
  $result = $conn->query("select * from user where username='".$username."'");
  if (!$result) {
    throw new Exception('Could not execute query');
  }

  if ($result->num_rows>0) {
    throw new Exception('That username is taken - please choose another one.');
  }

  // if ok, put in db
  $result = $conn->query("insert into user values
                         ('".$fname."', '".$lname."', '".$cell."', '".$city."', '".$username."', sha1('".$password."'), '".$email."', '".$usermode."', '".$displaymode."', '".$photo."')");
  if (!$result) {
    throw new Exception('Could not register you in database - please try again later.');
  }
  mysqli_close($conn);
  return true;
}

function bregister($fname, $lname, $cell, $city, $username, $email, $password, $usermode, $displaymode, $photo) {
// register new person with db
// return true or error message

  // connect to db
  $conn = db_connect();
  $usermode = 'business';
  // check if username is unique
  $result = $conn->query("select * from user where username='".$username."'");
  if (!$result) {
    throw new Exception('Could not execute query');
  }

  if ($result->num_rows>0) {
    throw new Exception('That username is taken - please go back and choose another one.');
  }

  // if ok, put in db
  $result = $conn->query("insert into user values
                         ('".$fname."', '".$lname."', '".$cell."', '".$city."', '".$username."', sha1('".$password."'), '".$email."', '".$usermode."', '".$displaymode."', '".$photo."')");
  if (!$result) {
    throw new Exception('Could not register you in database - please try again later.');
  }
  mysqli_close($conn);
  return true;
}

function login($username, $password) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = $conn->query("select * from user
                         where username='".$username."'
                         and password = sha1('".$password."')");
  mysqli_close($conn);
  if (!$result) {
     throw new Exception('Could not log you in.');
  }

  if ($result->num_rows>0) {
     return true;
  } else {
     throw new Exception('Could not log you in.');
  }
}

function login2($username, $password) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = $conn->query("select * from user
                         where username='".$username."'
                         and password = sha1('".$password."')");
  mysqli_close($conn);
  if (!$result) {
     return false;
  }

  if ($result->num_rows>0) {
     return true;
  } else {
     return false;
  }
}

function check_valid_user() {
// see if somebody is logged in and notify them if not
  if (isset($_SESSION['valid_user']))  {
      echo "<p>Welcome ".$_SESSION['valid_user']."!<br /></p>";
      $conn = db_connect();
$result = $conn->query("select * from user
                            where username='".$_SESSION['valid_user']."'");
    
      $row = $result->fetch_object();
      $cell = $row->cell;
      $city = $row->city;
      $photo = $row->photo;
 
   if(strlen($cell) == 7){
		echo preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		echo preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		echo $cell; }  
      echo '<br />';
      echo $city;
      echo '<br />';
      echo "<img src=\"$photo\" height=\"70\" width=\"65\">\n";
      echo '<br />'; 
      mysqli_close($conn);
    }
   else {
     // they are not logged in
    echo "<meta http-equiv='refresh' content='0;url=http://cellme.mobi/logout.php'>";
  }
}


function check_valid_user2() {
// see if somebody is logged in and notify them if not
  if (isset($_SESSION['valid_user']))  {
      echo "<p>Logged in as ".$_SESSION['valid_user']."</p>";
      
    }
   else {
     // they are not logged in 
    echo "<meta http-equiv='refresh' content='0;url=http://cellme.mobi/logout.php'>";
  }
}

function pccheck_valid_user() {
// see if somebody is logged in and notify them if not
  if (isset($_SESSION['valid_user']))  {
      echo "<br />Welcome ".$_SESSION['valid_user']."!<br />";
      $conn = db_connect();
$result = $conn->query("select * from user
                            where username='".$_SESSION['valid_user']."'");
    
      $row = $result->fetch_object();
      $cell = $row->cell;
      $city = $row->city;
      $photo = $row->photo;
 
   if(strlen($cell) == 7){
		echo preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", "$cell");
		}
	elseif(strlen($cell) == 10){
		echo preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", "$cell");
		}
	else{
		echo $cell; }  
      echo '<br />';  
      echo $city;
      echo '<br />';
      echo "<img src=\"$photo\" height=\"75\" width=\"68\">\n";
      echo '<br />'; 
      mysqli_close($conn);

    }
   else {
     // they are not logged in
    echo "<meta http-equiv='refresh' content='0;url=http://cellme.mobi/pclogout.php'>";
  }
}

function idcheck_valid_user() {
// see if somebody is logged in and notify them if not
  if (isset($_SESSION['valid_user']))  {
      echo "<br />Welcome ".$_SESSION['valid_user']."!<br />";
      $conn = db_connect();
$result = $conn->query("select * from user
                            where username='".$_SESSION['valid_user']."'");
    
      $row = $result->fetch_object();
      $cell = $row->cell;
      $city = $row->city;
      $photo = $row->photo;
 
   if(strlen($cell) == 7){
		echo preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", "$cell");
		}
	elseif(strlen($cell) == 10){
		echo preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", "$cell");
		}
	else{
		echo $cell; }  
      echo '<br />';  
      echo $city;
      echo '<br />';
      echo "<img src=\"../$photo\" height=\"75\" width=\"68\">\n";
      echo '<br />'; 
      mysqli_close($conn);
    }
   else {
     // they are not logged in
    echo "<meta http-equiv='refresh' content='0;url=http://cellme.mobi/id/idlogout.php'>";
  }
}

function idcheck_valid_user2() {
// see if somebody is logged in and notify them if not
  if (isset($_SESSION['valid_user']))  {
      echo "<p>Logged in as ".$_SESSION['valid_user']."</p>";
      
    }
   else {
     // they are not logged in 
    echo "<meta http-equiv='refresh' content='0;url=http://cellme.mobi/logout.php'>";
  }
}

function pccheck_valid_user2() {
// see if somebody is logged in and notify them if not
  if (isset($_SESSION['valid_user']))  {
      echo "&nbsp;&nbsp;&nbsp;&nbsp;Logged in as ".$_SESSION['valid_user'].".";
      
    }
   else {
     // they are not logged in
    echo "<meta http-equiv='refresh' content='0;url=http://cellme.mobi/pclogout.php'>";
  }
}

function change_password($username, $old_password, $new_password) {
// change password for username/old_password to new_password
// return true or false

  // if the old password is right
  // change their password to new_password and return true
  // else throw an exception
  login($username, $old_password);
  $conn = db_connect();
  $result = $conn->query("update user
                          set password = sha1('".$new_password."')
                          where username = '".$username."'");
  mysqli_close($conn);
  if (!$result) {
    throw new Exception('Password could not be changed.');
  } else {
    return true;  // changed successfully
  }
}

function change_password2($username, $old_password, $new_password) {
// change password for username/old_password to new_password
// return true or false

  // if the old password is right
  // change their password to new_password and return true
  // else throw an exception
  if (login2($username, $old_password) == true) {
  $conn = db_connect();
  $result = $conn->query("update user
                          set password = sha1('".$new_password."')
                          where username = '".$username."'");
  mysqli_close($conn);
  if (!$result) {
    return false;
  } else {
    return true;  // changed successfully
  }
}
else {return false;}}

function change_cell($username, $new_cell2) {

  
  $conn = db_connect();
  
  $result = $conn->query("update add_book
                          set cell = '".$new_cell2."'
                          where ent_id = '".$username."'");
  mysqli_close($conn); 
  $conn = db_connect();
  $result = $conn->query("update user
                          set cell = '".$new_cell2."'
                          where username = '".$username."'");
  
  mysqli_close($conn); 
                         
  if (!$result) {
    throw new Exception('Cell could not be changed.');
  } else {
    return true;  // changed successfully
  }
  
}

function change_email($username, $new_email) {
// change password for username/old_password to new_password
// return true or false

  // if the old password is right
  // change their password to new_password and return true
  // else throw an exception
  
  $conn = db_connect();
  $result = $conn->query("update user
                          set email = '".$new_email."'
                          where username = '".$username."'");
  mysqli_close($conn);                        
  if (!$result) {
    throw new Exception('Email could not be changed.');
  } else {
    return true;  // changed successfully
  }
}

function change_displaymode($username, $new_displaymode) {

  
  $conn = db_connect();
  $result = $conn->query("update user
                          set displaymode = '".$new_displaymode."'
                          where username = '".$username."'");
  mysqli_close($conn);                        
  if (!$result) {
    throw new Exception('Setting could not be changed.');
  } else {
    return true;  // changed successfully
  }
}

function change_city($username, $new_city) {
// change password for username/old_password to new_password
// return true or false

  // if the old password is right
  // change their password to new_password and return true
  // else throw an exception
  
  $conn = db_connect();
  $result = $conn->query("update add_book
                          set city = '".$new_city."'
                          where ent_id = '".$username."'");
  mysqli_close($conn);  
  $conn = db_connect();
  $result = $conn->query("update user
                          set city = '".$new_city."'
                          where username = '".$username."'");
  mysqli_close($conn);                        
  if (!$result) {
    throw new Exception('City could not be changed.');
  } else {
    return true;  // changed successfully
  }
}

function change_name($username, $new_fname, $new_lname) {
// change name for username/old_password to new_password
// return true or false

  // if the old password is right
  // change their name to new_name and return true
  // else throw an exception
  
  $conn = db_connect();
  $result = $conn->query("update add_book
                          set fname = '".$new_fname."'
                          where ent_id = '".$username."'");
  $result = $conn->query("update add_book
                          set lname = '".$new_lname."'
                          where ent_id = '".$username."'");  
  $result = $conn->query("update user
                          set fname = '".$new_fname."'
                          where username = '".$username."'");
   $result = $conn->query("update user
                          set lname = '".$new_lname."'
                          where username = '".$username."'");                       
  mysqli_close($conn);                        
  if (!$result) {
    throw new Exception('Name could not be changed.');
  } else {
    return true;  // changed successfully
  }
}

function get_random_word() {
 
// The numeric value below indicates the password length 
$length = '8'; 

    $var = "abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHIJKLMNPQRSTUVWXZY";  
    srand((double)microtime()*1000000);  
    $i = 0;    $word = '' ;  
    while ($i < $length) {  
        $num = rand() % 33;  
        $tmp = substr($var, $num, 1);  
        $word = $word . $tmp;  
        $i++;  }
return $word;  

}

function reset_password($username) {
// set password for username to a random value
// return the new password or false on failure
  // get a random dictionary word b/w 6 and 13 chars in length
  $new_password = get_random_word();

  if($new_password == false) {
    throw new Exception('Could not generate new password.');
  }

  

  // set user's password to this in database or return false
  $conn = db_connect();
  $result = $conn->query("update user
                          set password = sha1('".$new_password."')
                          where username = '".$username."'");
  mysqli_close($conn);
  if (!$result) {
    throw new Exception('Could not change password.');  // not changed
  } else {
    return $new_password;  // changed successfully
  }
}

function notify_password($username, $password) {
// notify the user that their password has been changed

    $conn = db_connect();
    $result = $conn->query("select email from user
                            where username='".$username."'");
    if (!$result) {
      throw new Exception('Could not find email address.');
    } else if ($result->num_rows == 0) {
      throw new Exception('Could not find email address.');
      // username not in db
    } else {
      $row = $result->fetch_object();
      $email = $row->email;
      $from = "From: service@cellme.mobi \r\n";
      $mesg = "Your CellMe password has been changed to ".$password."\r\n"
              ."It is advisable to change it next time you log in.\r\n".
              "If you need anything else, just let us know. Thank you.\r\n";
    mysqli_close($conn);
      if (mail($email, 'CellMe Login Information', $mesg, $from)) {
        return true;
      } else {
        throw new Exception('Could not send email.');
      }
    }
}

?>
