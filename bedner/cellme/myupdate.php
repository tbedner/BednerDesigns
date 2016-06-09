<?php
 require_once('mycell_fns.php');
 session_start();
  $conn = db_connect(); 
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $myfname = $row->fname;
  $mylname = $row->lname;
   $username = $_SESSION['valid_user'];

mysqli_close($conn);
 $deletec = $_GET['deletec'];
 $deleteu = $_GET['deleteu'];
 $addu = $_GET['add'];
 $addc = $_GET['addc'];
 $sent = $_GET['sent'];
 $update = $_GET['update'];
if (isset($_GET['deletec']))  {
if (!validate_get($deletec))
{exit;}
}
if (isset($_GET['deleteu']))  {
if (!validate_get($deleteu))
{exit;}
}
if (isset($_GET['add']))  {
if (!validate_get($addu))
{exit;}
}
if (isset($_GET['addc']))  {
if (!validate_get($addc))
{exit;}
}
if (isset($_GET['sent']))  {
if (!validate_get($sent))
{exit;}
}
if (isset($_GET['update']))  {
if (!validate_get($update))
{exit;}
} do_html_mypageheader('cellme.mobi');

  if (isset($_GET['pageno'])) {
   $pageno = $_GET['pageno'];
} else {
   $pageno = 1;
} 
 check_valid_user2();
?>

<form action="addmyupdate.php" method="post">
<input placeholder="Add an Update" name="update" type="text" /><br />
<input id="mysubmit" type="submit" value="Send Update" />
</form>

<?php

if ($deletec == 'true') { echo '<center><font size="3" color="#F000F0">Comment Deleted</font><br /></center>';}
if ($deletec == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Comment Not Deleted</font><br /></center>';}
if ($deleteu == 'true') { echo '<center><font size="3" color="#F000F0">Update Deleted</font><br /></center>';}
if ($deleteu == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Update Not Deleted</font><br /></center>';}
if ($addu == 'true') { echo '<center><font size="3" color="#F000F0">Update Added</font><br /></center>';}
if ($addc == 'true') { echo '<center><font size="3" color="#F000F0">Comment Added</font><br /></center>';}
if ($sent == 'problem') { echo '<center><font size="3" color="#F000F0">Problem - Comment Not Added</font><br /></center>';}
if ($update == 'problem') { echo '<center><font size="3" color="#F000F0">Problem - Update Not Added</font><br /></center>';}
 

  echo '<div class="textbox"><br /><font color="#00B0F0"><b><i>My Recent Updates</i></b></font><br />     
<a href="myupdateall.php">
<input id="mysubmit" type="submit" value="See All of Your Updates" /></a>
<form action="update.php" method="post">
<input id="mysubmit" type="submit" value="See Friend Updates"/></form><br /></div>';

  
  $conn3 = db_connect();
  $result3 = $conn3->query("select * FROM updates WHERE up_username = '".$_SESSION['valid_user']."' ORDER BY updates.datetime DESC LIMIT 5");
  $num_row3 = $result3->num_rows;
if ($num_row3 == 0){
  echo 'Your updates will appear here.<br />';
          } 
elseif ($num_row3 == 1){
  $row3=$result3->fetch_object();
  $user3 = $row3->up_username;
  $datetime3 = $row3->datetime;
  $update3 = $row3->update;
  $datetimeg = str_replace(' ', '', $datetime3);
 


  echo '<br /><div class="update"><div class="update2">'.$update3.'</div>';
  echo '<div><font color="#00B0F0" size="1.5">'.$user3.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime3.'</font></div></div>';
  echo '<a href="myupdatedelete.php?id='.$user3.'&date='.$datetimeg.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
  echo '<br />';
  

  $conn4 = db_connect(); 
  $result4 = $conn4->query("select * from comments
                            where userid = '".$user3."' AND timeid = '".$datetime3."' ORDER BY datetime2 DESC LIMIT 5");


  $num_row4 = $result4->num_rows;
if ($num_row4 == 0){
              echo '';  
 }
 else{
while ($row4=$result4->fetch_object()){

  $fname3 = $row4->fname;
  $lname3 = $row4->lname;
  $comment3 = $row4->comment;
    $datetimeh = $row4->datetime2;
  $datetimei = str_replace(' ', '', $datetimeh);
  
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
  echo '<a href="mycommentdelete.php?id='.$lname2.'&date='.$datetimei.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
   }
else {
  echo '&nbsp;&nbsp;&nbsp;</div></div>';
}   
mysqli_close($conn6); 
  
  }
  $conn4 = db_connect(); 
  $result4 = $conn4->query("select * from comments
                            where userid = '".$user3."' AND timeid = '".$datetime3."'");

  $datetime10 = str_replace(' ', '', $datetime3);

  $num_row4 = $result4->num_rows;
  
if ($num_row4 >= 5){  
  echo '<a href="updateall.php#'.$user3.$datetime10.'"><font color="#00B0F0" size="1.5">See all comments</font></a><br /><br />';
  }
mysqli_close($conn4);
?>
<form action="myaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user3; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime3; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
<input placeholder="Add a comment" name="comment" type="text" /><br />
<input id="mysubmit" type="submit" value="Send Comment" />
<br /><hr /><br />
<?php  
    } 
echo '<br />';
}

else {
while ($row3=$result3->fetch_object()){
  
  $user3 = $row3->up_username;
  $datetime3 = $row3->datetime;
  $update3 = $row3->update;
  $datetimej = str_replace(' ', '', $datetime3);

  echo '<br/><div class="update"><div class="update2">'.$update3.'</div>';
  echo '<div><font color="#00B0F0" size="1.5">'.$user3.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime3.'</font>';
  echo '<a href="myupdatedelete.php?id='.$user3.'&date='.$datetimej.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
  echo '<br />';




  $conn4 = db_connect(); 
  $result4 = $conn4->query("select * from comments
                            where userid = '".$user3."' AND timeid = '".$datetime3."' ORDER BY datetime2 DESC LIMIT 5");


  $num_row4 = $result4->num_rows;
if ($num_row4 == 0){
?>
<form action="myaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user3; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime3; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
<input placeholder="Add a comment" name="comment" type="text" /><br />
<input id="mysubmit" type="submit" value="Send Comment" />
              </form>
<br /><hr /><br />
<?php
}
 else{
while ($row4=$result4->fetch_object()){

  $fname3 = $row4->fname;
  $lname3 = $row4->lname;
  $comment3 = $row4->comment;
    $datetimek = $row4->datetime2;
  $datetimel = str_replace(' ', '', $datetimek);
  
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
  echo '<a href="mycommentdelete.php?id='.$lname2.'&date='.$datetimel.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
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
  $datetime11 = str_replace(' ', '', $datetime3);
  
if ($num_row4 >= 5){  
  echo '<font color="#00B0F0" size="1.5"><a href="myupdateall.php#'.$user3.$datetime11.'">See all comments</a></font><br /><br />';
  }
mysqli_close($conn4);
echo '<br />';

?>

<form action="myaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user3; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime3; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
<input placeholder="Add a comment" name="comment" type="text" /><br />
<input id="mysubmit" type="submit" value="Send Comment" />
              </form>
<br /><hr /><br />
<?php  
    } 
}
  }
mysqli_close($conn3);
$username = $_SESSION['valid_user']; 
$conn = db_connect(); 

// find out how many rows are in the table   
$result = $conn->query("select count(*) FROM updates WHERE up_username = '".$_SESSION['valid_user']."'");
$r = $result->fetch_row();
$numrows = $r[0];
if ($numrows >= 6) {

?>
<a href="idmyupdateall.php">
<input id="mysubmit" type="submit" value="See All of Your Updates" /></a>
<form action="update.php" method="post">
<input id="mysubmit" type="submit" value="See Friend Updates"/></form><br />
<?php
}
mysqli_close($conn);
display_user_menu();
do_html_footer();
?>