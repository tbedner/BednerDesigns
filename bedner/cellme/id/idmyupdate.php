<?php

 require_once('../mycell_fns.php');
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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
<meta content="yes" name="apple-mobile-web-app-capable" /> 
<meta content="index,follow" name="robots" /> 
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" /> 
<link href="images/cellme.png" rel="apple-touch-icon" /> 
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" />
 
<title>cellme.mobi
</title> 
<meta content="iPod,iPhone,free" name="keywords" /> 
<meta content="A Cellular Network where you can find friends' cell phone numbers" name="description" /> 
</head> 
 
<body> 
 
<div id="topbar"> <img alt="logo" src="images/logo.jpg" />
	<div id="title"> 
		 cellme</div>  
	<div id="leftnav"><a href="idemail.php">Inbox</a></div><div id="rightnav"><a href="idsearch.php">Search</a></div>
</div> 
<div id="content"> 
<?php	
do_idad();
?>
	<ul class="pageitem">
<?php
idcheck_valid_user2();
if ($deletec == 'true') { echo '<center><font size="3" color="#F000F0">Comment Deleted</font><br /></center>';}
if ($deletec == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Comment Not Deleted</font><br /></center>';}
if ($deleteu == 'true') { echo '<center><font size="3" color="#F000F0">Update Deleted</font><br /></center>';}
if ($deleteu == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Update Not Deleted</font><br /></center>';}
if ($addu == 'true') { echo '<center><font size="3" color="#F000F0">Update Added</font><br /></center>';}
if ($addc == 'true') { echo '<center><font size="3" color="#F000F0">Comment Added</font><br /></center>';}
if ($sent == 'problem') { echo '<center><font size="3" color="#F000F0">Problem - Comment Not Added</font><br /></center>';}
if ($update == 'problem') { echo '<center><font size="3" color="#F000F0">Problem - Update Not Added</font><br /></center>';}
?> 
<li class="menu"><a href="idupdate.php"><span class="name2"><br />See Friend Updates</span></a></li><hr />
<?php
  echo '<font color="#00B0F0"><b><i>My Updates</i></b></font><br /><hr />';
?>
             <form action="idaddmyupdate.php" method="post">
<li class="form"><input placeholder="Add an update" name="update" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Send Update" /></li>
              </form><hr />
<?php  
  
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
 


  echo '<div class="update"><div class="update2">'.$update3.'</div>';
  echo '<div><font color="#00B0F0" size="1.5">'.$user3.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime3.'</font></div></div>';
  echo '<a href="idmyupdatedelete.php?id='.$user3.'&date='.$datetimeg.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
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
  echo '<a href="idmycommentdelete.php?id='.$lname2.'&date='.$datetimei.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
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
  echo '<a href="idupdateall.php#'.$user3.$datetime10.'"><font color="#00B0F0" size="1.5">See all comments</font></a><br /><br />';
  }
mysqli_close($conn4);
?>
<form action="idmyaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user3; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime3; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
<li class="form"><input placeholder="Add a comment" name="comment" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Send Comment" /></li>
              </form>
<hr />
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

  echo '<div class="update"><div class="update2">'.$update3.'</div>';
  echo '<div><font color="#00B0F0" size="1.5">'.$user3.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime3.'</font>';
  echo '<a href="idmyupdatedelete.php?id='.$user3.'&date='.$datetimej.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
  echo '<br />';




  $conn4 = db_connect(); 
  $result4 = $conn4->query("select * from comments
                            where userid = '".$user3."' AND timeid = '".$datetime3."' ORDER BY datetime2 DESC LIMIT 5");


  $num_row4 = $result4->num_rows;
if ($num_row4 == 0){
?>
<form action="idmyaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user3; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime3; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
<li class="form"><input placeholder="Add a comment" name="comment" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Send Comment" /></li>
              </form>
<hr />
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
  echo '<a href="idmycommentdelete.php?id='.$lname2.'&date='.$datetimel.'">&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;</a></div></div>'; 
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
  echo '<font color="#00B0F0" size="1.5"><a href="idmyupdateall.php#'.$user3.$datetime11.'">See all comments</a></font><br /><br />';
  }
mysqli_close($conn4);
echo '<br />';

?>

<form action="idmyaddcomment.php" method="post">
              <input type="hidden" value="<?php echo $user3; ?>" name="userid">
              <input type="hidden" value="<?php echo $datetime3; ?>" name="timeid">
              <input type="hidden" value="<?php echo $myfname; ?>" name="fname">
              <input type="hidden" value="<?php echo $mylname; ?>" name="lname">
<li class="form"><input placeholder="Add a comment" name="comment" type="text" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Send Comment" /></li>
              </form>
<hr />


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
<li class="form"><input id="mysubmit" type="submit" value="See All of Your Updates" /></li></a><?php
}
mysqli_close($conn);
?>
 </ul>
 	<ul class="pageitem">  
		<li class="menu"><a href="idsearch.php"> 
		<img alt="Search" src="thumbs/idusersearch.png" /><span class="name">Search</span><span class="arrow"></span></a></li> 
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
