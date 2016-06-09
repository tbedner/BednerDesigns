<?php
 require_once('mycell_fns.php');
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
 if (isset($_GET['name']) && isset($_GET['city']) && isset($_GET['list_type'])) {
  $search_name = sql_sanitize($_GET['name']);
  $search_city = sql_sanitize($_GET['city']);
  $list_type = trim($_GET['list_type']);
if (!validate_type($list_type)) {exit;}
  }    else {
  $search_name = sql_sanitize($_POST['name']);
  $search_city = sql_sanitize($_POST['city']);
  $list_type = trim($_POST['list_type']);
if (!validate_type($list_type)) {exit;}
}
  if (isset($_GET['pageno'])) {
   $pageno = (integer)$_GET['pageno'];
} else {
   $pageno = 1;
}
  $search_name = ucwords($search_name);  
  $search_city = ucwords($search_city);
 
?>

    <p>Search Results</p>

<?php
$searchnot = '%';
if ($search_name != $searchnot && $search_city != $searchnot){

if (!empty($search_name) || !empty($search_city))
{
if ($list_type == 'personal') {
 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where city LIKE '".$search_city."%' and fname LIKE '".$search_name."%' and usermode = 'personal' OR city LIKE '".$search_city."%' and lname LIKE '".$search_name."%' and usermode = 'personal' order by lname asc");
  $num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';
  echo 'No matches found.';
  echo '<br />';
  echo '<br />';
  }
else{
  $rows_per_page = 10;
  $lastpage = ceil($num_row/$rows_per_page);
  $pageno = (int)$pageno;
  if ($pageno > $lastpage) {
   $pageno = $lastpage;
  } // if
  if ($pageno < 1) {
   $pageno = 1;
  }
  $limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
  $result = $conn->query("select * from user
                            where city LIKE '".$search_city."%' and fname LIKE '".$search_name."%' and usermode = 'personal' OR city LIKE '".$search_city."%' and lname LIKE '".$search_name."%' and usermode = 'personal' order by lname asc $limit");
if ($pageno == 1) {
   echo "<font size='4'> << &nbsp;&nbsp;< </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> < </font></a>";
} 
echo "<font size='4'>&nbsp; $pageno of $lastpage &nbsp;</font>";
if ($pageno == $lastpage) {
   echo "<font size='4'> > &nbsp;&nbsp;>> </font>";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
   echo '<br />';
   echo '<br />';
   
} 
while ($row=$result->fetch_object()){
  $usermode = $row->usermode;
  $displaymode = $row->displaymode;
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->username;

       

   
  if ($usermode == 'personal') {
   if ($displaymode == 'private') {
            
      echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';
            echo $lname.', '.$fname;
            echo '<br />';
            echo $city;
            echo '<br />';
            echo '<div class="navbar3"><a href="request.php?id='.$id.'&amp;id2='.$_SESSION['valid_user'].'">Request #</a></div>';
            echo '<br />';
            echo '<br />';
  
   }
elseif ($displaymode == 'public') {
    if ($photo !== 'photo_default.jpg' ) {
      echo '<br />';
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
    echo '<div class="navbar3"><a href="add_entry.php?id='.$id.'">Add Entry</a></div>';
    echo '<br />';
    echo '<br />';
}    else  {
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
    echo '<div class="navbar3"><a href="add_entry.php?id='.$id.'">Add Entry</a></div>';
    echo '<br />';
    echo '<br />';
  } 
 
}
 
   }         }
   if ($pageno == 1) {
   echo "<font size='4'> <<&nbsp;&nbsp; <&nbsp; </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <&nbsp; </font></a>";
} 
echo "<font size='4'> &nbsp;$pageno of $lastpage&nbsp;</font> ";
if ($pageno == $lastpage) {
   echo " > &nbsp;&nbsp;>> ";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> &nbsp;>&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
   echo '<br />';
   echo '<br />';
   
} 
   }
   mysqli_close($conn);
   }
   
elseif ($list_type == 'business') {
 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where city LIKE '".$search_city."%' and fname LIKE '".$search_name."%' and usermode = 'business' OR city LIKE '".$search_city."%' and lname LIKE '".$search_name."%' and usermode = 'business' order by lname asc $limit");
  $num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';
  echo 'No matches found.';
  echo '<br />';
  echo '<br />';
  }
else{
  $rows_per_page = 10;
  $lastpage = ceil($num_row/$rows_per_page);
  $pageno = (int)$pageno;
  if ($pageno > $lastpage) {
   $pageno = $lastpage;
  } // if
  if ($pageno < 1) {
   $pageno = 1;
  }
  $limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
  $result = $conn->query("select * from user
                            where city LIKE '".$search_city."%' and fname LIKE '".$search_name."%' and usermode = 'business' order by lname asc $limit");
if ($pageno == 1) {
   echo "<font size='4'> << &nbsp;&nbsp;< </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> < </font></a> <br />";
} 
echo "<font size='4'>&nbsp; $pageno of $lastpage &nbsp;</font>";
if ($pageno == $lastpage) {
   echo "<font size='4'> > &nbsp;&nbsp;>> </font>";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
   echo '<br />';
   echo '<br />';
   
}

while ($row=$result->fetch_object()){
  $usermode = $row->usermode;
  $displaymode = $row->displaymode;
  $fname = $row->fname;
  $lname = $row->lname;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $id = $row->username;

  if ($usermode == 'business') {
   if ($displaymode == 'private') {
            echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
            echo '<br />';
            echo $fname;
            echo '<br />';
            echo $city;
            echo '<br />';            
            echo '<div class="navbar3"><a href="request.php?id='.$id.'&amp;id2='.$_SESSION['valid_user'].'">Request #</a></div>';
            echo '<br />';
            echo '<br />';
  
   }
elseif ($displaymode == 'public') {
    if ($photo !== 'photo_default.jpg' ) {
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
    echo '<div class="navbar3"><a href="add_entry.php?id='.$id.'">Add Entry</a></div>';
    echo '<br />';
    echo '<br />';

}    else  {
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
    echo '<font >'.$new_cell.'</font>';
    echo '<br />';    
    echo '<div class="navbar3"><a href="add_entry.php?id='.$id.'">Add Entry</a></div>';
    echo '<br />';
    echo '<br />';

  } 
 
}
 
   }         }
   if ($pageno == 1) {
   echo "<font size='4'> <<&nbsp;&nbsp; <&nbsp; </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <&nbsp; </font></a>";
} 
echo "<font size='4'> &nbsp;$pageno of $lastpage&nbsp;</font> ";
if ($pageno == $lastpage) {
   echo " > &nbsp;&nbsp;>> ";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> &nbsp;>&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;name=$search_name&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
   echo '<br />';
   echo '<br />';
   
} 
   }
      mysqli_close($conn);
      }}}
else {
echo '<p>Please go back and enter a search term.</p>';
}
?>

    <!-- page content -->
<br />
<?php
display_user_menu();
do_html_footer();
?>