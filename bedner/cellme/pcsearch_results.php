<?php
// include function files for this application
require_once('mycell_fns.php');
session_start();
 if (isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['city']) && isset($_GET['list_type'])) {
  $search_firstname = sql_sanitize($_GET['firstname']);
  $search_lastname = sql_sanitize($_GET['lastname']);
  $search_city = sql_sanitize($_GET['city']);
  $list_type = trim($_GET['list_type']);
if (!validate_type($list_type)) {exit;}
  }    else {
  $search_firstname = $_POST['firstname'];
  $search_lastname = sql_sanitize($_POST['lastname']);
  $search_city = sql_sanitize($_POST['city']);
  $list_type = trim($_POST['list_type']);
if (!validate_type($list_type)) {exit;}
}   
  if (isset($_GET['pageno'])) {
   $pageno = (integer)$_GET['pageno'];
} else {
   $pageno = 1;
}
  $search_firstname = ucwords($search_firstname);  
  $search_lastname = ucwords($search_lastname);
  $search_city = ucwords($search_city);
  do_pcuser_top();

?>
              
              <table class="member" cellspacing="20"><tr>
              <td width="205px">
                              <div id="valid">
<?php
                pccheck_valid_user();
?>
                </div>
                              <a href="pcsearch.php"><img src="images/search.jpg" alt="Search" border="0" width="75" height="79" /></a><br />
              <a href="pcadd_book.php"><img src="images/friends.jpg" alt="Search" border="0" width="75" height="79" /></a><br />
              <a href="pcemail.php"><img src="images/email.jpg" alt="Search" border="0" width="75" height="79" /></a><br /><br /> 

              </td>
              <td width="615px" align="center">
              <p>Search Results</p>

<?php 
$searchnot = '%';
if ($search_firstname != $searchnot && $search_lastname != $searchnot && $search_city != $searchnot){
 if (!empty($search_firstname) || !empty($search_lastname) || !empty($search_city))
{
if ($list_type == 'personal') {
 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where fname LIKE '".$search_firstname."%' AND lname LIKE '".$search_lastname."%' AND city LIKE '".$search_city."%' and usermode = 'personal' order by lname asc");
  $num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';
  echo '<font color="#F000F0">No matches found.</font>';
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
                            where fname LIKE '".$search_firstname."%' AND lname LIKE '".$search_lastname."%' AND city LIKE '".$search_city."%' and usermode = 'personal' order by lname asc $limit");
if ($pageno == 1) {
   echo "<font size='4'> << &nbsp;&nbsp;< </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> < </font></a>";
} 
echo "<font size='4'>&nbsp; $pageno of $lastpage &nbsp;</font>";
if ($pageno == $lastpage) {
   echo "<font size='4'> > &nbsp;&nbsp;>> </font>";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
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
      echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';
      echo $lname.', '.$fname;
           
            echo '<br />';
            echo $city;
            echo '<br />';
            echo '<a href="pcrequest.php?id='.$id.'&amp;id2='.$_SESSION['valid_user'].'"><br /><img src="images/pcrequest.jpg" alt="pcrequest #" height="30" width="75" border="0" /></a>';
            echo '<br />';
            echo '<br />';
  
   }
elseif ($displaymode == 'public') {
    if ($photo !== 'photo_default.jpg' ) {
      echo '<br />';
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
    echo '<br />';
    echo '<a href="pcadd_entry.php?id='.$id.'"><img src="images/pcadd.jpg" alt="Add Entry" height="30" width="75" border="0" /></a>';
    echo '<br />';
    echo '<br />';
}    else  {
     
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
    echo '<br />';    
    echo '<a href="pcadd_entry.php?id='.$id.'"><img src="images/pcadd.jpg" alt="Add Entry" height="30" width="75" border="0" /></a>';
    echo '<br />';
    echo '<br />';
  } 
 
}
 
   }         }
   if ($pageno == 1) {
   echo "<font size='4'> <<&nbsp;&nbsp; <&nbsp; </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <&nbsp; </font></a>";
} 
echo "<font size='4'> &nbsp;$pageno of $lastpage&nbsp;</font> ";
if ($pageno == $lastpage) {
   echo " > &nbsp;&nbsp;>> ";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> &nbsp;>&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
   echo '<br />';
   echo '<br />';
   
} 
   }
   mysqli_close($conn);
   }
   
elseif ($list_type == 'business') {
 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where fname LIKE '".$search_firstname."%' AND lname LIKE '".$search_lastname."%' AND city LIKE '".$search_city."%' and usermode = 'business' order by fname asc");
  $num_row = $result->num_rows;
if ($num_row == 0){
  echo '<br />';
  echo '<font color="#F000F0">No matches found.</font>';
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
                            where fname LIKE '".$search_firstname."%' AND lname LIKE '".$search_lastname."%' AND city LIKE '".$search_city."%' and usermode = 'business' order by fname asc $limit");
if ($pageno == 1) {
   echo "<font size='4'> << &nbsp;&nbsp;< </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> < </font></a> <br />";
} 
echo "<font size='4'>&nbsp; $pageno of $lastpage &nbsp;</font>";
if ($pageno == $lastpage) {
   echo "<font size='4'> > &nbsp;&nbsp;>> </font>";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
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
      echo '<img src="'.$photo.'" alt="My Photo" width="50" height="60" />';
      echo '<br />';

echo $fname;
            echo '<br />';
            echo $city;
            echo '<br />';
            echo '<br />';            
            echo '<a href="pcrequest.php?id='.$id.'&amp;id2='.$_SESSION['valid_user'].'"><img src="images/pcrequest.jpg" alt="pcrequest #" height="30" width="75" border="0" /></a>';
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
    echo '<br />';    
    echo '<a href="pcadd_entry.php?id='.$id.'"><img src="images/pcadd.jpg" alt="Add Entry" height="30" width="75" border="0" /></a>';
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
    echo '<a href="pcadd_entry.php?id='.$id.'"><img src="images/pcadd.jpg" alt="Add Entry" height="30" width="75" border="0" /></a>';
    echo '<br />';
    echo '<br />';

  } 
 
}
 
   }         }
   if ($pageno == 1) {
   echo "<font size='4'> <<&nbsp;&nbsp; <&nbsp; </font>";
} else {
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=1&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <<&nbsp;&nbsp; </font></a> ";
   $prevpage = $pageno-1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> <&nbsp; </font></a>";
} 
echo "<font size='4'> &nbsp;$pageno of $lastpage&nbsp;</font> ";
if ($pageno == $lastpage) {
   echo " > &nbsp;&nbsp;>> ";
   echo '<br />';
   echo '<br />';
} else {
   $nextpage = $pageno+1;
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> &nbsp;>&nbsp;&nbsp; </font></a> ";
   echo " <a href='{$_SERVER['PHP_SELF']}?pageno=$lastpage&amp;firstname=$search_firstname&amp;lastname=$search_lastname&amp;city=$search_city&amp;list_type=$list_type'><font size='4'> >> </font></a> ";
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
                  <p><h3>Search the listings</h3></p>
    <p>
    <br /><br />
<div class="mid" id="Personal" style="DISPLAY: block" >
<font color="#00B0F0">Personal Listings</font>
    <form action="pcsearch_results.php" method="post">
     
    <input type="hidden" value="personal" name="list_type" /><br />
    First Name<br />
    <input type="text" name="firstname" /><br /><br />
    Last Name<br />
    <input type="text" name="lastname" /><br /><br />
    City<br />
    <input type="text" name="city" /><br />
    <input id="mysubmit" type="submit" value="search"/>
        <br /><br />
    
    <input type="hidden" value="1" name="go"/>
<a onclick ="javascript:ShowHide('Personal');HideShow('Business')" href="javascript:;" ><font color="#00B0F0">For Business Listings, Click Here</font></a> 

  </div>
              </form>
<script language="JavaScript">
function ShowHide(divId)
{
if(document.getElementById(divId).style.display == 'block')
{
document.getElementById(divId).style.display='none';
}
else
{
document.getElementById(divId).style.display = 'block';
}
}
</script>
 
    
    
<div class="mid" id="Business" style="DISPLAY: none" >

Business Listings
    <form action="pcsearch_results.php" method="post">
    <input type="hidden" value="business" name="list_type" /><br />
    <font color="#00B0F0">Business Name</font><br />
    <input type="text" name="firstname" /><br /><br />
    <font color="#00B0F0">Contact Name</font><br />
    <input type="text" name="lastname" /><br /><br />
    <font color="#00B0F0">City</font><br />
    <input type="text" name="city" /><br />
    <input id="mysubmit" type="submit" value="search"/>
        <br /><br />
    
    <input type="hidden" value="1" name="go"/>
<a onclick ="javascript:ShowHide('Personal');HideShow('Business')" href="javascript:;" >For Personal Listings, Click Here</a> 

    </div></form>
<script language="JavaScript">
function HideShow(divId)
{
if(document.getElementById(divId).style.display == 'none')
{
document.getElementById(divId).style.display='block';
}
else
{
document.getElementById(divId).style.display = 'none';
}
}
</script>
    </p>
              </td>
              <td width="220px" rowspan="3">

              <b><i>Updates</i></b><br /><br /> 
              <form action="pcaddupdate.php" method="post">
              <input type="text" name="update" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Update">
              </form> 
                            
              
              
                  <form action="pcupdate.php" method="post">
                  <br />
                  <input id="mysubmit" type="submit" value="See Next 10 Updates"/>
                  
                  </form><br /><br />
<?php
do_pcupdates();
?> 


                 
              </td></tr>
              
              
              </table>
<?php
do_pcuser_bottom();

?>
