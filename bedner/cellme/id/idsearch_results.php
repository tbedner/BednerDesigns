<?php

 require_once('../mycell_fns.php');
 session_start();
 if (isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['city']) && isset($_GET['list_type'])) {
  $search_fname = sql_sanitize($_GET['fname']);
  $search_lname = sql_sanitize($_GET['lname']);
  $search_city = sql_sanitize($_GET['city']);
  $list_type = trim($_GET['list_type']);
if (!validate_type($list_type)) {exit;}
  }    else {
  $search_fname = sql_sanitize($_POST['fname']);
  $search_lname = sql_sanitize($_POST['lname']);
  $search_city = sql_sanitize($_POST['city']);
  $list_type = trim($_POST['list_type']);
if (!validate_type($list_type)) {exit;}
}  
  if (isset($_GET['pageno'])) {
   $pageno = (integer)$_GET['pageno'];
} else {
   $pageno = 1;
}
  $search_fname = ucwords($search_fname);  
  $search_lname = ucwords($search_lname);
  $search_city = ucwords($search_city);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
<meta content="yes" name="apple-mobile-web-app-capable" /> 
<meta content="index,follow" name="robots" /> 
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" /> 
<link href="../images/cellme.png" rel="apple-touch-icon" /> 
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" />
 
<script src="javascript/functions.js" type="text/javascript"></script> 
<title>cellme.mobi
</title> 
<meta content="iPod,iPhone,free" name="keywords" /> 
<meta content="A Cellular Network where you can find friends' cell phone numbers" name="description" /> 
</head> 
 
<body> 
 
<div id="topbar"> <img alt="logo" src="images/logo.jpg" />
	<div id="title"> 
		 cellme</div>  
	<div id="leftnav"><a href="idemail.php">Inbox</a></div><div id="rightnav"><a href="idadd_book.php">Friends</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem"><li class="textbox"> 
<?php
idcheck_valid_user2();
?>
<h4>Search Results</h4>
<?php
$searchnot = '%';
if ($search_fname != $searchnot && $search_lname != $searchnot && $search_city != $searchnot){
 
 if (!empty($search_fname) || !empty($search_lname) || !empty($search_city))
{
if ($list_type == 'personal') {
 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where fname LIKE '".$search_fname."%' AND lname LIKE '".$search_lname."%' AND city LIKE '".$search_city."%' and usermode = 'personal' order by lname asc");
  $num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';
  echo '<font color="#F000F0">No matches found.</font>';
  echo '<br />';
  echo '<br />';
  }
else{
  $rows_per_page = 5;
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
                            where fname LIKE '".$search_fname."%' AND lname LIKE '".$search_lname."%' AND city LIKE '".$search_city."%' and usermode = 'personal' order by lname asc $limit");
if ($pageno == 1) {
   echo "<font size='4'> << &nbsp;&nbsp;< </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> < </font></a>";
} 
echo "<font size='4'>&nbsp; $pageno of $lastpage &nbsp;</font>";
if ($pageno == $lastpage) {
   echo "<font size='4'> > &nbsp;&nbsp;>> </font>";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
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

      echo '<br />';
      echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';
      echo $lname.', '.$fname;
           
            echo '<br />';
            echo $city;
            echo '<br />';
            echo '<a href="idrequest.php?id='.$id.'&amp;id2='.$_SESSION['valid_user'].'"><br /><img src="../images/pcrequest.jpg" alt="pcrequest #" height="30" width="75" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  
   }
elseif ($displaymode == 'public') {
    if ($photo !== 'photo_default.jpg' ) {
      echo '<br />';
      echo '<br />';
      echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
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
    echo '<a href="idadd_entry.php?id='.$id.'"><img src="../images/pcadd.jpg" alt="Add Entry" height="30" width="75" border="0" /></a>';
    echo '<br />';
    echo '<br />';
}    else  {
     
      echo '<br />';
      echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
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
    echo '<a href="idadd_entry.php?id='.$id.'"><img src="../images/pcadd.jpg" alt="Add Entry" height="30" width="75" border="0" /></a>';
    echo '<br />';
    echo '<br />';
  } 
 
}
 
   }         }
   if ($pageno == 1) {
   echo "<font size='4'> <<&nbsp;&nbsp; <&nbsp; </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <&nbsp; </font></a>";
} 
echo "<font size='4'> &nbsp;$pageno of $lastpage&nbsp;</font> ";
if ($pageno == $lastpage) {
   echo " > &nbsp;&nbsp;>> ";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> &nbsp;>&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
   echo '<br />';
   echo '<br />';
   
} 
   }
   mysqli_close($conn);
   }
   
elseif ($list_type == 'business') {
 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where fname LIKE '".$search_fname."%' AND lname LIKE '".$search_lname."%' AND city LIKE '".$search_city."%' and usermode = 'business' order by fname asc");
  $num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';
  echo '<font color="#F000F0">No matches found.</font>';
  echo '<br />';
  echo '<br />';
  }
else{
  $rows_per_page = 5;
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
                            where fname LIKE '".$search_fname."%' AND lname LIKE '".$search_lname."%' AND city LIKE '".$search_city."%' and usermode = 'business' order by fname asc $limit");
if ($pageno == 1) {
   echo "<font size='4'> << &nbsp;&nbsp;< </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> < </font></a> <br />";
} 
echo "<font size='4'>&nbsp; $pageno of $lastpage &nbsp;</font>";
if ($pageno == $lastpage) {
   echo "<font size='4'> > &nbsp;&nbsp;>> </font>";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
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
      echo '<br />';
      echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';

echo $fname;
            echo '<br />';
            echo $city;
            echo '<br />';
            echo '<br />';            
            echo '<a href="idrequest.php?id='.$id.'&amp;id2='.$_SESSION['valid_user'].'"><img src="../images/pcrequest.jpg" alt="pcrequest #" height="30" width="75" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  
   }
elseif ($displaymode == 'public') {
    if ($photo !== 'photo_default.jpg' ) {
      echo '<img src="../'.$photo.'" alt="My Photo" width="50" height="60" />';
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
    echo '<a href="idadd_entry.php?id='.$id.'"><img src="../images/pcadd.jpg" alt="Add Entry" height="30" width="75" border="0" /></a>';
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
    echo $new_cell;
    echo '<br />';
    echo '<br />';    
    echo '<a href="idadd_entry.php?id='.$id.'"><img src="../images/pcadd.jpg" alt="Add Entry" height="30" width="75" border="0" /></a>';
    echo '<br />';
    echo '<br />';

  } 
 
}
 
   }         }
   if ($pageno == 1) {
   echo "<font size='4'> <<&nbsp;&nbsp; <&nbsp; </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <&nbsp; </font></a>";
} 
echo "<font size='4'> &nbsp;$pageno of $lastpage&nbsp;</font> ";
if ($pageno == $lastpage) {
   echo " > &nbsp;&nbsp;>> ";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> &nbsp;>&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;fname=$search_fname&amp;lname=$search_lname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
   echo '<br />';
   echo '<br />';
   
} 
   }
      mysqli_close($conn);
      }}}
else {
echo '<br />';
echo 'Please enter a search term.';
echo '<br />';
echo '<br />';
}
?>
<h4>Personal Listings Search</h4>
 	
    <form action="idsearch_results.php" method="post">
    <input type="hidden" value="personal" name="list_type" />
<li class="form"><input placeholder="First Name" name="fname" type="text" /></li>
<li class="form"><input placeholder="Last Name" name="lname" type="text" /></li>
<li class="form"><input placeholder="City/State" name="city" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Search" /></li>
<input type="hidden" value="1" name="go"/>
  </div>
              </form>
 </ul>
 	<ul class="pageitem">  
		<li class="menu"><a href="idbsearch.php"> 
		<img alt="Search" src="thumbs/idusersearch.png" /><span class="name">Search Business Listings</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idadd_book.php"> 
		<img alt="Friends" src="thumbs/addbook.png" /><span class="name">Friends</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idemail.php"> 
		<img alt="Inbox" src="thumbs/mail.png" /><span class="name">Inbox<?php new_mail2(); ?></span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idupdate.php"> 
		<img alt="Updates" src="thumbs/update.png" /><span class="name">Updates</span><span class="arrow"></span></a></li> 
 </ul>
             
              
<?php
do_idad();
do_idmypage_menu();
?>		
	</ul> 
	
</div> 
<?php
do_idmypage_footer();
?>
 
</body> 
 
</html>  
<?php

?>

 




