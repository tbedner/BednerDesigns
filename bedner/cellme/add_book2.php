<?php
 require_once('mycell_fns.php');
 session_start();
 $type=trim($_POST['type']);
if (!validate_type($type)) {exit;}
 $letter=trim($_POST['letter']); 
if (!validate_letter($letter)) {exit;}
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
    $cell1 = $row->cell;
 
 
if($type == 'personal'){
if($letter == 'a'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'personal' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Personal Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Personal Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'a%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'b%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'c%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'd%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'e%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'f%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'a%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'b%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'c%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'd%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'e%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'f%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'A%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'B%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'C%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'D%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'E%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'F%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'A%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'B%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'C%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'D%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'E%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'F%'and usermode = 'personal'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;
  
                  echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
                  echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<div class="navbar3"><a href="delete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'">Delete Entry</a></div>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}
if($letter == 'g'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'personal' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Personal Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Personal Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'g%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'h%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'i%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'j%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'k%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'l%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'g%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'h%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'i%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'j%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'k%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'l%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'G%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'H%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'I%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'J%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'K%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'L%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'G%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'H%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'I%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'J%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'K%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'L%'and usermode = 'personal'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;


            echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
            echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<div class="navbar3"><a href="delete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'">Delete Entry</a></div>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

if($letter == 'm'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'personal' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Personal Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Personal Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'm%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'n%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'o%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'p%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'q%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'r%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'm%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'n%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'o%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'p%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'q%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'r%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'M%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'N%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'O%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'P%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Q%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'R%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'M%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'N%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'O%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'P%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Q%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'R%'and usermode = 'personal'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;

            echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
            echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<div class="navbar3"><a href="delete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'">Delete Entry</a></div>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

if($letter == 's'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'personal' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Personal Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Personal Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 's%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 't%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'u%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'v%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'w%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'x%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'y%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'z%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 's%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 't%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'u%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'v%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'w%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'x%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'y%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'z%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'S%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'T%'and usermode = 'personal' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'U%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'V%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'W%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'X%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Y%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Z%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'S%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'T%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'U%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'V%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'W%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'X%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Y%'and usermode = 'personal'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Z%'and usermode = 'personal'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;

            echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
            echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<div class="navbar3"><a href="delete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'">Delete Entry</a></div>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

}

if($type == 'business'){
if($letter == 'a'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'business' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Business Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Business Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'a%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'b%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'c%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'd%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'e%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'f%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'a%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'b%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'c%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'd%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'e%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'f%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'A%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'B%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'C%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'D%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'E%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'F%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'A%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'B%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'C%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'D%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'E%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'F%'and usermode = 'business'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;
            echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
            echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<div class="navbar3"><a href="delete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'">Delete Entry</a></div>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}
if($letter == 'g'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'business' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Business Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Business Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'g%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'h%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'i%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'j%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'k%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'l%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'g%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'h%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'i%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'j%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'k%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'l%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'G%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'H%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'I%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'J%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'K%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'L%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'G%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'H%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'I%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'J%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'K%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'L%'and usermode = 'business'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;
            echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
            echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<div class="navbar3"><a href="delete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'">Delete Entry</a></div>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

if($letter == 'm'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'business' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Business Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Business Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 'm%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'n%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'o%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'p%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'q%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'r%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'm%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'n%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'o%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'p%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'q%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'r%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'M%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'N%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'O%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'P%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Q%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'R%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'M%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'N%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'O%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'P%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Q%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'R%'and usermode = 'business'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;
            echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
            echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<div class="navbar3"><a href="delete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'">Delete Entry</a></div>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);


  }
}

if($letter == 's'){
 
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' AND usermode = 'business' order by lname ASC");
  $num_row = $result->num_rows;

if ($num_row == 0){
  echo '<br />';
  echo '<br />';
  echo '<b>Business Entries:</b>';
  echo '<br />';  
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';

  }
else{
  echo '<br />';

  echo '<b>Business Entries:</b>';
  echo '<br />';
  echo '<br />';
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                            where username = '".$_SESSION['valid_user']."' and fname LIKE 's%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 't%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'u%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'v%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'w%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'x%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'y%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'z%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 's%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 't%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'u%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'v%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'w%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'x%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'y%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'z%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'S%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'T%'and usermode = 'business' 
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'U%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'V%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'W%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'X%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Y%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and fname LIKE 'Z%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'S%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'T%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'U%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'V%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'W%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'X%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Y%'and usermode = 'business'
                            OR username = '".$_SESSION['valid_user']."' and lname LIKE 'Z%'and usermode = 'business'
                            order by lname ASC, fname ASC");
$num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';  
  echo 'No entries found.';
  echo '<br />';
  echo '<br />';
  } else {
while ($row=$result->fetch_object()){
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->ent_id;
  $usermode = $row->usermode;
            echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
            echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
               if(strlen($cell) == 7){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $cell);
		}
	elseif(strlen($cell) == 10){
		$new_cell = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $cell);
		}
	else{
		$new_cell = $cell; }  
    echo $new_cell;
            echo '<br />';
            echo '<br />';
            echo '<div class="navbar3"><a href="delete_entry.php?id='.$id.'&amp;cell1='.$cell1.'&amp;cell2='.$cell.'">Delete Entry</a></div>';
            echo '<br />';
            echo '<br />';
  }}
mysqli_close($conn);
}}}
display_user_menu();
do_html_footer();
?>