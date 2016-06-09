<?php
 require_once('mycell_fns.php');
 session_start();


 $username = $_SESSION['valid_user'];



do_pcuser_top();

?>
              
              <table width="940" class="member" cellspacing="50"><tr>
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
             
              <td width="270px">
              
              

<?php
 $username = $_SESSION['valid_user']; 

  $conn = db_connect(); 
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $myfname = $row->fname;
  $mylname = $row->lname;
  $conn7 = db_connect();
// find out how many rows are in the table   
  $result7 = $conn7->query("select count(*) from updates, add_book
                            where add_book.username = '".$_SESSION['valid_user']."' AND add_book.ent_id = updates.up_username");

$r = $result7->fetch_row();
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 10;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;                            

  $conn1 = db_connect();
  $result1 = $conn1->query("select add_book.fname, add_book.lname, add_book.photo, updates.datetime, updates.up_username, updates.update from updates, add_book
                            where add_book.username = '".$_SESSION['valid_user']."' AND add_book.ent_id = updates.up_username ORDER BY updates.datetime DESC LIMIT $offset, $rowsperpage");

echo '<b><i>Friend Updates</i></b><br /><br />'; 
/******  build the pagination links ******/
// range of num links to show

if ($totalpages > 1) {

if ($currentpage == 1) {
    // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next&nbsp;&nbsp;&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>Last</a> ";
      // show << link to go back to page 1
} // end if 
elseif (($currentpage > 1) && ($currentpage != $totalpages)) {
   // show << link to go back to page 1
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=1'>First&nbsp;&nbsp;&nbsp;</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous&nbsp;&nbsp;&nbsp;</a> ";
      // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next&nbsp;&nbsp;&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>Last</a> ";
} // end if 
else {
   // show << link to go back to page 1
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=1'>First&nbsp;&nbsp;&nbsp;</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous</a>";
}                 
?>
<br /><br />
<?php
/****** end build pagination links ******/
}
  $num_row1 = $result1->num_rows;
if ($num_row1 == 0){
      echo 'Welcome to Cellme.mobi. As you find friends and add contacts to your address book, their updates will appear here where you can add your comments.';
      echo '<br />';
      echo '<br />';
    } 
 
elseif ($num_row1 == 1){
  $row1=$result1->fetch_object();
  $fname = $row1->fname;
  $lname = $row1->lname;
  $user = $row1->up_username;
  $datetime = $row1->datetime;
  $update = $row1->update;
  $photo = $row1->photo;
     $datetime9 = str_replace(' ', '', $datetime);

  echo '<a name="'.$user.$datetime9.'"></a>';
  echo $update;
  echo '<br />';
  echo '<img src="'.$photo.'" alt="Photo" width="34" height="40" />';
  echo '<font color="#00B0F0" size="1.5">'.$fname.' '.$lname.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime.'</font>';
  echo '<br />';

?>
<a onclick ="javascript:ShowHide('<?php echo $datetime; ?>')" href="javascript:;" ><font color="#00B0F0" size="1.5">Comment</font></a>

<div class="mid" id="<?php echo $datetime; ?>" style="DISPLAY: none" >
<form action="pcaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
              <input type="text" name="comment" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Comment">
              </form> 
</div><br /><br /> 

<script language="JavaScript">
function ShowHide(divId)
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
<?php
  $conn2 = db_connect(); 
  $result2 = $conn2->query("select * from comments
                            where userid = '".$user."' AND timeid = '".$datetime."' ORDER BY datetime2 DESC LIMIT 10");


  $num_row2 = $result2->num_rows;
if ($num_row2 == 0){
              echo '';  
 }
 else{
while ($row2=$result2->fetch_object()){

  $fname1 = $row2->fname;
  $lname1 = $row2->lname;
  $comment = $row2->comment;
      $datetime2 = $row2->datetime2;
  $datetime1 = str_replace(' ', '', $datetime2);
  
  echo '<div class="comment">'.$comment;
  echo '<br /><div class="insidecomment">';
  echo $fname1.' '.$lname1;

  $conn3 = db_connect(); 
  $result3 = $conn3->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
   $row3=$result3->fetch_object();
  $fname2 = $row3->fname;
  $lname2 = $row3->lname;

if ($fname1 == $fname2 && $lname1 == $lname2) {
  echo '<a href="pccommentdelete.php?id='.$lname2.'&date='.$datetime1.'">&nbsp;&nbsp;&nbsp;X&nbsp;</a></div></div>'; 
   }
else {
  echo '&nbsp;&nbsp;&nbsp;</div></div>';
}   
mysqli_close($conn3);  

  
  } }
  $conn2 = db_connect(); 
  $result2 = $conn2->query("select * from comments
                            where userid = '".$user."' AND timeid = '".$datetime."'");


  $num_row2 = $result2->num_rows;
   $datetime6 = str_replace(' ', '', $datetime);
 
if ($num_row2 >= 5) { 
  echo '<font color="#00B0F0" size="1.5"><a href="pcupdateall.php#'.$user.$datetime6.'">See all comments</a></font><br /><br />';
  }
mysqli_close($conn2);  
    

}
else {
while($row1=$result1->fetch_object()){


  $fname = $row1->fname;
  $lname = $row1->lname;
  $user = $row1->up_username;
  $datetime = $row1->datetime;
  $update = $row1->update;
  $photo = $row1->photo;
     $datetimea = str_replace(' ', '', $datetime);

    echo '<a name="'.$user.$datetimea.'"></a>';
  echo $update;
  echo '<br />';
  echo '<img src="'.$photo.'" alt="Photo" width="34" height="40" />';
  echo '<font color="#00B0F0" size="1.5">'.$fname.' '.$lname.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime.'</font>';
  echo '<br />';



?>
<a onclick ="javascript:ShowHide('<?php echo $datetime; ?>')" href="javascript:;" ><font color="#00B0F0" size="1.5">Comment</font></a>

<div class="mid" id="<?php echo $datetime; ?>" style="DISPLAY: none" >
<form action="pcaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
              <input type="text" name="comment" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Comment">
              </form> 
</div><br /><br /> 

<script language="JavaScript">
function ShowHide(divId)
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
<?php
  $conn2 = db_connect(); 
  $result2 = $conn2->query("select * from comments
                            where userid = '".$user."' AND timeid = '".$datetime."' ORDER BY datetime2 DESC");


  $num_row2 = $result2->num_rows;
if ($num_row2 == 0){
              echo '';  
 }
 else{
while ($row2=$result2->fetch_object()){

  $fname1 = $row2->fname;
  $lname1 = $row2->lname;
  $comment = $row2->comment;
      $datetime2 = $row2->datetime2;
  $datetime1 = str_replace(' ', '', $datetime2);
  
  echo '<div class="comment">'.$comment;
  echo '<br /><div class="insidecomment">';
  echo $fname1.' '.$lname1;

  $conn3 = db_connect(); 
  $result3 = $conn3->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
   $row3=$result3->fetch_object();
  $fname2 = $row3->fname;
  $lname2 = $row3->lname;

if ($fname1 == $fname2 && $lname1 == $lname2) {
  echo '<a href="pccommentdelete.php?id='.$lname2.'&date='.$datetime1.'">&nbsp;&nbsp;&nbsp;X&nbsp;</a></div></div>'; 
   }
else {
  echo '&nbsp;&nbsp;&nbsp;</div></div>';
}   
mysqli_close($conn3);  

  
  } }

mysqli_close($conn2);  
    

} }
/******  build the pagination links ******/
// range of num links to show

if ($totalpages > 1) {
?>
<br /><br />
<?php
if ($currentpage == 1) {
    // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next&nbsp;&nbsp;&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>Last</a> ";
      // show << link to go back to page 1
} // end if 
elseif (($currentpage > 1) && ($currentpage != $totalpages)) {
   // show << link to go back to page 1
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=1'>First&nbsp;&nbsp;&nbsp;</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous&nbsp;&nbsp;&nbsp;</a> ";
      // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next&nbsp;&nbsp;&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>Last</a> ";
} // end if 
else {
   // show << link to go back to page 1
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=1'>First&nbsp;&nbsp;&nbsp;</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous</a>";
}
/****** end build pagination links ******/
}
?>
</td>
<td width="270px">
<?php

mysqli_close($conn1);
mysqli_close($conn7);
  $conn8 = db_connect();
// find out how many rows are in the table   
  $result8 = $conn8->query("select count(*) FROM updates WHERE up_username = '".$_SESSION['valid_user']."'");

$r8 = $result8->fetch_row();
$numrows8 = $r8[0];

// number of rows to show per page
$rowsperpage8 = 10;
// find out total pages
$totalpages8 = ceil($numrows8 / $rowsperpage8);

// get the current page or set a default
if (isset($_GET['mycurrentpage']) && is_numeric($_GET['mycurrentpage'])) {
   // cast var as int
   $mycurrentpage = (int) $_GET['mycurrentpage'];
} else {
   // default page num
   $mycurrentpage = 1;
} // end if

// if current page is greater than total pages...
if ($mycurrentpage > $totalpages8) {
   // set current page to last page
   $mycurrentpage = $totalpages8;
} // end if
// if current page is less than first page...
if ($mycurrentpage < 1) {
   // set current page to first page
   $mycurrentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset8 = ($mycurrentpage - 1) * $rowsperpage8;                            


  echo '<b><i>My Updates</i></b><br /><br />';
  /******  build the pagination links ******/
// range of num links to show

if ($totalpages8 > 1) {

if ($mycurrentpage == 1) {
    // get next page
   $mynextpage = $mycurrentpage + 1;
    // echo forward link for next page 
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$mynextpage'>Next&nbsp;&nbsp;&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$totalpages8'>Last</a> ";
      // show << link to go back to page 1
} // end if 
elseif (($mycurrentpage > 1) && ($mycurrentpage != $totalpages8)) {
   // show << link to go back to page 1
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=1'>First&nbsp;&nbsp;&nbsp;</a> ";
   // get previous page num
   $myprevpage = $mycurrentpage - 1;
   // show < link to go back to 1 page
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$myprevpage'>Previous&nbsp;&nbsp;&nbsp;</a> ";
      // get next page
   $mynextpage = $mycurrentpage + 1;
    // echo forward link for next page 
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$mynextpage'>Next&nbsp;&nbsp;&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$totalpages8'>Last</a> ";
} // end if 
else {
   // show << link to go back to page 1
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=1'>First&nbsp;&nbsp;&nbsp;</a> ";
   // get previous page num
   $myprevpage = $mycurrentpage - 1;
   // show < link to go back to 1 page
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$myprevpage'>Previous</a>";
}                 
?>
<br /><br />
<?php
/****** end build pagination links ******/
}
  $conn3 = db_connect();
  $result3 = $conn3->query("select * FROM updates WHERE up_username = '".$_SESSION['valid_user']."' ORDER BY updates.datetime DESC LIMIT $offset8, $rowsperpage8");
  $num_row3 = $result3->num_rows;
if ($num_row3 == 0){
  echo 'Your updates will appear here.<br />';
          } 
elseif ($num_row3 == 1){
  $row3=$result3->fetch_object();
  $user3 = $row3->up_username;
  $datetime3 = $row3->datetime;
  $update3 = $row3->update;
  $datetime1 = str_replace(' ', '', $datetime3);
 
  echo $update3;
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$user3.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime3.'</font>';
  echo '<a href="pcupdatedelete.php?id='.$user3.'&date='.$datetime1.'">&nbsp;&nbsp;&nbsp;X&nbsp;</a></div></div>'; 
  echo '<br />';
  echo '<br />';
  
?>
<a onclick ="javascript:ShowHide('<?php echo $datetime3; ?>')" href="javascript:;" ><font color="#00B0F0" size="1.5">Comment</font></a>

<div class="mid" id="<?php echo $datetime3; ?>" style="DISPLAY: none" >
<form action="pcaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user3; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime3; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
              <input type="text" name="comment" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Comment">
              </form> 
</div><br /><br /> 

<script language="JavaScript">
function ShowHide(divId)
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
<?php
  $conn4 = db_connect(); 
  $result4 = $conn4->query("select * from comments
                            where userid = '".$user3."' AND timeid = '".$datetime3."' ORDER BY datetime2 DESC LIMIT 10");


  $num_row4 = $result4->num_rows;
if ($num_row4 == 0){
              echo '';  
 }
 else{
while ($row4=$result4->fetch_object()){

  $fname3 = $row4->fname;
  $lname3 = $row4->lname;
  $comment3 = $row4->comment;  
    $datetime5 = $row4->datetime2;
  $datetime1 = str_replace(' ', '', $datetime5);
  
  echo '<div class="comment">'.$comment3;
  echo '<br /><div class="insidecomment">';
  echo $fname3.' '.$lname3;
  $conn6 = db_connect(); 
  $result6 = $conn6->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
   $row3=$result6->fetch_object();
  $fname2 = $row3->fname;
  $lname2 = $row3->lname;
  $datetime1 = str_replace(' ', '', $datetime3);
if ($fname3 == $fname2 && $lname3 == $lname2) {
  echo '<a href="pccommentdelete.php?id='.$lname2.'&date='.$datetime1.'">&nbsp;&nbsp;&nbsp;X&nbsp;</a></div></div>'; 
   }
else {
  echo '&nbsp;&nbsp;&nbsp;</div></div>';
}   
mysqli_close($conn6); 

  
  }
  $conn4 = db_connect(); 
  $result4 = $conn4->query("select * from comments
                            where userid = '".$user3."' AND timeid = '".$datetime3."'");


  $num_row4 = $result4->num_rows;
  
if ($num_row4 >= 5){  
  echo '<font color="#00B0F0" size="1.5"><a href="pcupdateall.php#'.$user3.$datetime3.'">See all comments</a></font><br /><br />';
  }
mysqli_close($conn4);  
    } 

}
else {
while($row3=$result3->fetch_object()){

  $user3 = $row3->up_username;
  $datetime3 = $row3->datetime;
  $update3 = $row3->update;
  $datetime1 = str_replace(' ', '', $datetime3);

  echo $update3;
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$user3.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime3.'</font>';
  $datetime4 = str_replace(' ', '', $datetime3);
  echo '<a name="'.$user3.$datetime4.'"></a>';
  echo '<a href="pcupdatedelete.php?id='.$user3.'&date='.$datetime1.'">&nbsp;&nbsp;&nbsp;X&nbsp;</a></div></div>'; 
  echo '<br />';
  echo '<br />';



?>
<a onclick ="javascript:ShowHide('<?php echo $datetime3; ?>')" href="javascript:;" ><font color="#00B0F0" size="1.5">Comment</font></a>

<div class="mid" id="<?php echo $datetime3; ?>" style="DISPLAY: none" >
<form action="pcaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user3; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime3; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
              <input type="text" name="comment" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Comment">
              </form> 
</div><br /><br /> 

<script language="JavaScript">
function ShowHide(divId)
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
<?php
  $conn4 = db_connect(); 
  $result4 = $conn4->query("select * from comments
                            where userid = '".$user3."' AND timeid = '".$datetime3."' ORDER BY datetime2 DESC");


  $num_row4 = $result4->num_rows;
if ($num_row4 == 0){
              echo '';  
 }
 else{
while ($row4=$result4->fetch_object()){

  $fname3 = $row4->fname;
  $lname3 = $row4->lname;
  $comment3 = $row4->comment;  
    $datetime5 = $row4->datetime2;
  $datetime1 = str_replace(' ', '', $datetime5);
  
  echo '<div class="comment">'.$comment3;
  echo '<br /><div class="insidecomment">';
  echo $fname3.' '.$lname3;
  $conn6 = db_connect(); 
  $result6 = $conn6->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
   $row3=$result6->fetch_object();
  $fname2 = $row3->fname;
  $lname2 = $row3->lname;
if ($fname3 == $fname2 && $lname3 == $lname2) {
  echo '<a href="pccommentdelete.php?id='.$lname2.'&date='.$datetime1.'">&nbsp;&nbsp;&nbsp;X&nbsp;</a></div></div>'; 
   }
else {
  echo '&nbsp;&nbsp;&nbsp;</div></div>';
}   
mysqli_close($conn6); 

  
  }
mysqli_close($conn4);  
    } 

}

  }
  echo '<br />';
    echo '<br />';
  /******  build the pagination links ******/
// range of num links to show

if ($totalpages8 > 1) {

if ($mycurrentpage == 1) {
    // get next page
   $mynextpage = $mycurrentpage + 1;
    // echo forward link for next page 
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$mynextpage'>Next&nbsp;&nbsp;&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$totalpages8'>Last</a> ";
      // show << link to go back to page 1
} // end if 
elseif (($mycurrentpage > 1) && ($mycurrentpage != $totalpages8)) {
   // show << link to go back to page 1
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=1'>First&nbsp;&nbsp;&nbsp;</a> ";
   // get previous page num
   $myprevpage = $mycurrentpage - 1;
   // show < link to go back to 1 page
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$myprevpage'>Previous&nbsp;&nbsp;&nbsp;</a> ";
      // get next page
   $mynextpage = $mycurrentpage + 1;
    // echo forward link for next page 
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$mynextpage'>Next&nbsp;&nbsp;&nbsp;</a> ";
   // echo forward link for lastpage
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$totalpages8'>Last</a> ";
} // end if 
else {
   // show << link to go back to page 1
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=1'>First&nbsp;&nbsp;&nbsp;</a> ";
   // get previous page num
   $myprevpage = $mycurrentpage - 1;
   // show < link to go back to 1 page
   echo " <a class=\"page\" href='{$_SERVER['PHP_SELF']}?mycurrentpage=$myprevpage'>Previous</a>";
} 
}

 
mysqli_close($conn3);
                  
mysqli_close($conn);
?>                   
              </td>
               <td width="190px" align="center">
                 <form action="pcaddupdate.php" method="post">
              <input type="text" name="update" maxlength="200">
              <input id="mysubmit" type="submit" value="Send Update">
              </form>
                  <br /><br /><form action="pcupdate.php" method="post">
                  <input id="mysubmit" type="submit" value="&nbsp;&nbsp;&nbsp;Show 10 Updates&nbsp;&nbsp;&nbsp;"/>
                  <br /><br />
                  </form>  
              </td>
              </tr>
              
              
             
              </table>
<?php
do_pcuser_bottom();

?>