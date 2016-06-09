<?php
require_once('db_fns.php');

function get_user_urls($username) {
  //extract from the database all the entries this user has stored

  $conn = db_connect();
  $result = $conn->query("select member
                          from add_book
                          where username = '".$username."'");
  if (!$result) {
    return false;
  }

  //create an array of the entries
  $mem_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count) {
    $mem_array[$count] = $row[0];
  }
  return $mem_array;
}

function add_mem($new_mem) {
  // Add new member to the database

  echo "Attempting to add ".($new_mem)."<br />";
  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat entry
  $result = $conn->query("select * from add_book
                         where username='$valid_user'
                         and member='".$new_mem."'");
  if ($result && ($result->num_rows>0)) {
    throw new Exception('Entry already exists.');
  }

  // insert the new entry
  if (!$conn->query("insert into add_book values
     ('".$valid_user."', '".$new_mem."')")) {
    throw new Exception('Entry could not be inserted.');
  }

  return true;
}

function delete_mem($user, $mem) {
  // delete one entry from the database
  $conn = db_connect();

  // delete the entry
  if (!$conn->query("delete from add_book where
     username='".$user."' and member='".$mem."'")) {
     throw new Exception('Entry could not be deleted');
  }
  return true;
}

function recommend_mem($valid_user, $popularity = 1) {
  // We will provide semi intelligent recomendations to people
  // If they have an entry in common with other users, they may know
  // other members that these people know
  $conn = db_connect();

  // find other matching users
  // with an entry the same as you
  // as a simple way of 
  // increasing the chance of recommending members, we
  // specify a minimum popularity level
  // if $popularity = 1, then more than one person must have
  // an entry before we will recomend it

  $query = "select member
	        from add_book
	        where username in
	   	    (select distinct(b2.username)
            from add_book b1, add_book b2
		    where b1.username='".$valid_user."'
               and b1.username != b2.username
               and b1.member = b2.member)
	           and member not in
 		       (select member
				   from add_book
				   where username='".$valid_user."')
                   group by member
                   having count(member)>".$popularity;

  if (!($result = $conn->query($query))) {
     throw new Exception('Did not find any friends to recommend.');
  }

  if ($result->num_rows==0) {
     throw new Exception('Did not find any friends to recommend.');
  }

  $mems = array();
  // build an array of the relevant entries
  for ($count=0; $row = $result->fetch_object(); $count++) {
     $mems[$count] = $row->member;
  }

  return $mems;
}
?>
