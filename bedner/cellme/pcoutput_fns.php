<?php

function do_pc_ad() {
?>
    <script type="text/javascript">
var imgs1 = new Array("images/ad4.gif","images/ad5.gif");
var lnks1 = new Array("http://cellme.mobi/pcuser_contact.php","http://cellme.mobi/pcuser_contact.php");
var alt1 = new Array("Advertise Now!","Advertise Now!");
var currentAd1 = 0;
var imgCt1 = 2;
function cycle1() {
  if (currentAd1 == imgCt1) {
    currentAd1 = 0;
  }
var banner1 = document.getElementById('adBanner1');
var link1 = document.getElementById('adLink1');
  banner1.src=imgs1[currentAd1]
  banner1.alt=alt1[currentAd1]
  document.getElementById('adLink1').href=lnks1[currentAd1]
  currentAd1++;
}
  window.setInterval("cycle1()",5000);
</script>
<a href="ad1link" id="adLink1" target="http://cellme.mobi">
<img src="images/ad4.gif" id="adBanner1" border="0" width="300" height="50" /></a>
<?php

}

function do_pc_ad4() {
?>
    <script type="text/javascript">
var imgs4 = new Array("images/ad4.gif","images/ad5.gif");
var lnks4 = new Array("http://cellme.mobi/pcuser_contact.php","http://cellme.mobi/pcuser_contact.php");
var alt4 = new Array("Advertise Now!","Advertise Now!");
var currentAd4 = 0;
var imgCt4 = 2;
function cycle4() {
  if (currentAd4 == imgCt4) {
    currentAd4 = 0;
  }
var banner4 = document.getElementById('adBanner4');
var link4 = document.getElementById('adLink4');
  banner4.src=imgs4[currentAd4]
  banner4.alt=alt4[currentAd4]
  document.getElementById('adLink4').href=lnks4[currentAd4]
  currentAd4++;
}
  window.setInterval("cycle4()",5000);
</script>
<a href="ad4link" id="adLink4" target="http://cellme.mobi">
<img src="images/ad4.gif" id="adBanner4" border="0" width="300" height="50" /></a>
<?php

}

function do_pc_ad2() {
?>

    <script type="text/javascript">
var imgs2 = new Array("images/ad6.jpg","images/ad2.jpg","images/ad3.jpg");
var lnks2 = new Array("http://cellme.mobi","http://cellme.mobi","http://cellme.mobi");
var alt2 = new Array("Join Now!","Join Now!","Join Now!");
var currentAd2 = 0;
var imgCt2 = 3;
function cycle2() {
  if (currentAd2 == imgCt2) {
    currentAd2 = 0;
  }
var banner2 = document.getElementById('adBanner2');
var link2 = document.getElementById('adLink2');
  banner2.src=imgs2[currentAd2]
  banner2.alt=alt2[currentAd2]
  document.getElementById('adLink2').href=lnks2[currentAd2]
  currentAd2++;
}
  window.setInterval("cycle2()",3500);
</script>
<a href=""ad1link"" id="adLink2" target="http://cellme.mobi">
<img src="images/ad6.jpg" id="adBanner2" border="0" width="300" height="50"></a>

<?php
}

function do_pc_ad3() {
?>
    <script type="text/javascript">
var imgs3 = new Array("images/ad4.gif","images/ad2.gif");
var lnks3 = new Array("http://cellme.mobi","http://cellme.mobi");
var alt3 = new Array("Join Now!","Join Now!");
var currentAd3 = 0;
var imgCt3 = 2;
function cycle3() {
  if (currentAd3 == imgCt3) {
    currentAd3 = 0;
  }
var banner3 = document.getElementById('adBanner3');
var link3 = document.getElementById('adLink3');
  banner3.src=imgs3[currentAd3]
  banner3.alt=alt3[currentAd3]
  document.getElementById('adLink3').href=lnks3[currentAd3]
  currentAd3++;
}
  window.setInterval("cycle3()",5000);
</script>
<a href="ad3link" id="adLink3" target="http://cellme.mobi">
<img src="images/ad4.gif" id="adBanner3" border="0" width="300" height="50" /></a>
<?php                                  

}

function do_pc_ad5() {
?>
    <script type="text/javascript">
var imgs5 = new Array("images/ad4.gif","images/ad2.gif");
var lnks5 = new Array("http://cellme.mobi","http://cellme.mobi");
var alt5 = new Array("Join Now!","Join Now!");
var currentAd5 = 0;
var imgCt5 = 2;
function cycle5() {
  if (currentAd5 == imgCt5) {
    currentAd5 = 0;
  }
var banner5 = document.getElementById('adBanner5');
var link5 = document.getElementById('adLink5');
  banner5.src=imgs5[currentAd5]
  banner5.alt=alt5[currentAd5]
  document.getElementById('adLink5').href=lnks5[currentAd5]
  currentAd5++;
}
  window.setInterval("cycle5()",5000);
</script>
<a href="ad5link" id="adLink5" target="http://cellme.mobi">
<img src="images/ad4.gif" id="adBanner5" border="0" width="300" height="50" /></a>
<?php

}
            
function do_pcindex_menu() {
?>
<div id="nav"> 
				<a href="index.php">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="pcregister.php">Join</a>&nbsp;&nbsp;&nbsp;&nbsp; 
				<a href="pcabout.php">About Us</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="pccontact.php">Contact Us</a>  
			</div> 

<?php
}

function do_pcmypage_menu() {
?>
<div id="usernav"> 
<a href="pcmember.php">My Page</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pcemail.php">Inbox<?php new_mail(); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pcedit.php">Edit Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pcfriend.php">Invite-a-Friend</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pcuser_contact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="pclogout.php">Logout</a> 
			</div> 

<?php
}

function do_pcuser_top() {
?>

    <!-- page content -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>cellme.mobi</title>
  <link type="text/css" rel="stylesheet" href="cellme.css" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
  <script language="javascript">
<!--

function PreviousPage() {

  history.back(1);

}
//-->


</script>
  </head>
  <body>
        <div id="header">
           
        <div id="topcontent">
          <div id="headerlogo">
          <image src="images/logo.jpg" alt="cellme.mobi" />
          </div>

          </div>
        </div>
        <div id="allcontent">
  
            <div id="usermenubar">
<?php
do_pcmypage_menu();
?>
            </div>
          <div class="ad">
            <br />
<?php
do_pc_ad();
?>          

          </div>               
            <div id="nifty"> 
              <b class="rtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b> 
                
                <br /><br />
                <div id="userbox">

<?php
}

function do_pcuser_bottom() {
?>

              <b class="rbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b> 
          </div>
          </div> 
          <div class="ad">
<?php
do_pc_ad4();
?>
          </div>
          <div id="footer">
          <br />
<?php
do_pchtml_mypagefooter();
?>
          </div>
        </div>
        
  </body>
</html>
<?php
}

function do_pcindex_top() {
?>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>cellme.mobi</title>
  <link type="text/css" rel="stylesheet" href="cellme.css" />
    <script language="javascript">
<!--

function PreviousPage() {

  history.back(1);

}
//-->


</script>
  </head>
  <body> 
        <div id="header">
           
        <div id="topcontent">
          <div id="headerlogo">
          <image src="images/logo.jpg" alt="cellme.mobi" />
          </div>
          <div id="login">
<?php
pcdisplay_login_form();
?>
          </div>
          </div>
        </div>
        <div id="allcontent">
  
            <div id="menubar">
<?php
 do_pcindex_menu();
?>
            </div>
          <div class="ad">
            <br />
<?php
do_pc_ad3();
?>
          </div>             
            <div id="nifty"> 
              <b class="rtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b> 
                <div id="logo">
                  <image src="images/logo3.jpg" alt="cellme.mobi" />
                </div>
                <div id="box">
<?php
}

function do_pcindex_bottom() {
?>
</div> 
              <b class="rbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b> 
          </div> 
          
          <div class="ad">
<?php
do_pc_ad5();
?> 
          </div>
          <div id="footer">
          <br />
<?php
do_pchtml_indexfooter();
?>
          </div>
        </div>
        
  </body>
</html>
<?php
}

function do_pchtml_mypagefooter() {
  // print an HTML footer
?>
   <p id="footer"><a href="pc_usercontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;<a href="pc_userterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;<a href="pc_userpolicy.php">Privacy Policy</b></a></p>
   <p id="footer">&copy; 2009 cellme.mobi</p>

<?php
}

function do_pchtml_indexfooter() {
  // print an HTML footer
?>
   <p id="footer"><a href="pcregister.php">Join</a>&nbsp;&nbsp;&nbsp;<a href="pcabout.php">About Us</a>&nbsp;&nbsp;&nbsp;<a href="pccontact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;<a href="pcterms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;<a href="pcpolicy.php">Privacy Policy</b></a></p>
   <p id="footer">&copy; 2009 cellme.mobi</p>

<?php
}

function do_pcupdates() {

  $conn = db_connect(); 
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $myfname = $row->fname;
  $mylname = $row->lname;
                            

  $conn1 = db_connect();
  $result1 = $conn1->query("select add_book.fname, add_book.lname, add_book.photo, updates.datetime, updates.up_username, updates.update from updates, add_book
                            where add_book.username = '".$_SESSION['valid_user']."' AND add_book.ent_id = updates.up_username ORDER BY updates.datetime DESC LIMIT 4");

echo 'Friend Updates<br /><br />';
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
  
  echo $update;
  echo '<br />';
  echo '<img src="'.$photo.'" alt="Photo" width="34" height="40" />';
  echo '<font color="#00B0F0" size="1.5">'.$fname.' '.$lname.'</font>';
  echo '<br />';
  echo '<font color="#00B0F0" size="1.5">'.$datetime.'</font>';
  $datetime6 = str_replace(' ', '', $datetime);
  echo '<a name="'.$user.$datetime6.'"></a>';
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
  
if ($num_row2 >= 5) { 
  echo '<font color="#00B0F0" size="1.5"><a href="pcupdateall.php#'.$user.$datetime.'">See all comments</a></font><br /><br />';
  }
mysqli_close($conn2);  
    

}
else {
for ($i=0; $i < 2; $i++){

  $row1=$result1->fetch_object();
  $fname = $row1->fname;
  $lname = $row1->lname;
  $user = $row1->up_username;
  $datetime = $row1->datetime;
  $update = $row1->update;
  $photo = $row1->photo;
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
                            where userid = '".$user."' AND timeid = '".$datetime."' ORDER BY datetime2 DESC LIMIT 4");


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
  $datetime1 = str_replace(' ', '', $datetime2);
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
  
if ($num_row2 >= 5) { 
  echo '<font color="#00B0F0" size="1.5"><a href="pcupdateall.php#'.$user.$datetime.'">See all comments</a></font><br /><br />';
  }
mysqli_close($conn2);  
    

} }
mysqli_close($conn1);
  echo 'My Updates<br /><br />';
  $conn3 = db_connect();
  $result3 = $conn3->query("select * FROM updates WHERE up_username = '".$_SESSION['valid_user']."' ORDER BY updates.datetime DESC");
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
  echo '<div class="comment">'.$comment3;
  echo '<br /><div class="insidecomment">';
  echo $fname3.' '.$lname3;
  $conn6 = db_connect(); 
  $result6 = $conn6->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
   $row3=$result6->fetch_object();
  $fname2 = $row3->fname;
  $lname2 = $row3->lname;
  $datetime1 = str_replace(' ', '', $datetime2);
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
for ($b=0; $b < 2; $b++){


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
                            where userid = '".$user3."' AND timeid = '".$datetime3."' ORDER BY datetime2 DESC LIMIT 4");


  $num_row4 = $result4->num_rows;
if ($num_row4 == 0){
              echo '';  
 }
 else{
while ($row4=$result4->fetch_object()){

  $fname3 = $row4->fname;
  $lname3 = $row4->lname;
  $comment3 = $row4->comment;  
  echo '<div class="comment">'.$comment3;
  echo '<br /><div class="insidecomment">';
  echo $fname3.' '.$lname3;
  $conn7 = db_connect(); 
  $result7 = $conn7->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
   $row7=$result7->fetch_object();
  $fname2 = $row7->fname;
  $lname2 = $row7->lname;
  $datetime1 = str_replace(' ', '', $datetime2);
if ($fname3 == $fname2 && $lname3 == $lname2) {
  echo '<a href="pccommentdelete.php?id='.$lname2.'&date='.$datetime1.'">&nbsp;&nbsp;&nbsp;X&nbsp;</a></div></div>'; 
   }
else {
  echo '&nbsp;&nbsp;&nbsp;</div></div>';
}   
mysqli_close($conn7); 
  
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

  }
  echo '<br />';




                  
}


function pcdisplay_login_form() {
?>
  
  <form method="post" action="pcmember.php">
  Username&nbsp;<input type="text" name="username" size="10" />
  Password&nbsp;<input type="password" name="password" size="10" />
  <input id="mysubmit" type="submit" id="mysubmit" value="Log In" />
  <a class="header" href="pcforgot_form.php">Forgot password?</a>
  </form> 
     <!-- page content -->
   
<?php
}

function pcdisplay_registration_form() {
?>
<form method="post" action="pcregister_new.php">
<p class="header"">
<br />
<p>
<table class="form" valign="middle" cellspacing="5">
<tr><td></td><td align="center"><br /><br /><font size="4"><i>Registration - Personal</i></font><br /><br /></td><td></td></tr>
<tr><td>
First Name<br />
<input type="text" name="fname" size="20" maxlength="100" /></td>
<td>Last Name<br />
<input type="text" name="lname" size="20" maxlength="100" /></td>
<td>City and State/Country<br />
<input type="text" name="city" size="20" maxlength="100" /></td>
<tr><td>Email<br />
<input type="text" name="email" size="20" maxlength="100" /></td>
<td>Cell Phone<br />
<input type="text" name="cell" size="20" maxlength="30" /></td>
<td></td></tr>
<tr><td>Username (6-16 chars):<br />
<input type="text" name="username" size="20" maxlength="16" /></td>
<td>Password (6-16 chars):<br />
<input type="password" name="passwd" size="20" maxlength="16" /></td>
<td>Confirm Password<br />
<input type="password" name="passwd2" size="20" maxlength="16" /></td></tr>
<tr align="center">
<td>Display Setting<br /><br />
<input type="radio" name="display" value="private" checked="yes" />Private<br />
<input type="radio" name="display" value="public" />Public</td>
<td><br /><label for="verify">Verification<br />Enter the phrase below:
<p class="note">**Note**<br />Refresh page for a new image.</p></label>
<img src="captcha.php" alt="Verification pass-phrase" /><br />
<input type="text" id="verify" name="verify" size="20" />
</td>
<td><input type="hidden" name="usermode" value="personal" />
<br /><br /><br /><br /><br /><br /><br /><input id="mysubmit" type="submit" value="Register" /></td></tr></table><br /><br /><br /><br /></p></p></form>
<br />
<?php
}

function pcdisplay_bregistration_form() {
?>
<form method="post" action="pcbregister_new.php">
<p class="header"">
<br />
<p>
<table class="form" valign="middle" cellspacing="5">
<tr><td></td><td align="center"><br /><br /><font size="4"><i>Registration - Business</i></font><br /><br /></td><td></td></tr>
<tr><td>
Business Name<br />
<input type="text" name="fname" size="20" maxlength="100" /></td>
<td>Contact Name<br />
<input type="text" name="lname" size="20" maxlength="100" /></td>
<td>City and State/Country<br />
<input type="text" name="city" size="20" maxlength="100" /></td>
<tr><td>Email<br />
<input type="text" name="email" size="20" maxlength="100" /></td>
<td>Cell Phone<br />
<input type="text" name="cell" size="20" maxlength="30" /></td>
<td></td></tr>
<tr><td>Username (6-16 chars):<br />
<input type="text" name="username" size="20" maxlength="16" /></td>
<td>Password (6-16 chars):<br />
<input type="password" name="passwd" size="20" maxlength="16" /></td>
<td>Confirm Password<br />
<input type="password" name="passwd2" size="20" maxlength="16" /></td></tr>
<tr align="center">
<td>Display Setting<br /><br />
<input type="radio" name="display" value="private" checked="yes" />Private<br />
<input type="radio" name="display" value="public" />Public</td>
<td><br /><label for="verify">Verification<br />Enter the phrase below:
<p class="note">**Note**<br />Refresh page for a new image.</p></label>
<img src="captcha.php" alt="Verification pass-phrase" /><br />
<input type="text" id="verify" name="verify" size="20" />
</td>
<td><input type="hidden" name="usermode" value="business" />
<br /><br /><br /><br /><br /><br /><br /><input id="mysubmit" type="submit" value="Register" /></td></tr></table><br /><br /><br /><br /></p></p></form>
<br />


<?php

}

function do_edit_profile() {

  define('UPLOADPATH', 'images/');
  define('MAXFILESIZE', 2100000);      // 2 MB
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username='".$_SESSION['valid_user']."'");
  $row = $result->fetch_object();
  $usermode = $row->usermode;
  $fname = $row->fname;
  $lname = $row->lname;
  $cell = $row->cell;
  $old_email = $row->email;
  $old_city = $row->city;    
  $old_displaymode = $row->displaymode;
mysqli_close($conn); 
?>
 
                 <form action="pcchange_name.php" method="post">
<table><tr><td width="300px" align="left" colspan="2" height="30px">
<font color="#FF8000"><b>Name</b></font><hr /></td></tr>
<tr><td width="300px" align="left" height="25px">
<?php


  if ($usermode == 'personal') {
      echo '<font color="#00B0F0">Old First Name - </font>';
      echo '<font color="#00B0F0">'.$fname.'</font>';
  	  echo '</td><td width="300px" align="left">';
  	  echo '<font color="#00B0F0">New First Name</font> ';
  }  else  {
      echo '<font color="#00B0F0">Old Company Name -</font> ';
  	  echo '<font color="#00B0F0">'.$fname.'</font>';
  	  echo '</td><td>';
  	  echo '<font color="#00B0F0">New Company Name</font> ';
  } 


?>


    <input type="text" name="new_fname" size="16" maxlength="16" /></td></tr>
    <tr><td>
<?php
  if ($usermode == 'personal') {
      echo '<font color="#00B0F0">Old Last Name - </font>';
  	  echo '<font color="#00B0F0">'.$lname.'</font>';
  	  echo '</td><td>';
  	  echo '<font color="#00B0F0">New Last Name </font>';
  }  else  {
      echo '<font color="#00B0F0">Old Contact Name - </font>';
  	  echo '<font color="#00B0F0">'.$lname.'</font>';
  	  echo '</td><td>';
  	  echo '<font color="#00B0F0">New Contact Name </font>';
  } 

?>
<input type="text" name="new_lname" size="16" maxlength="16" /></td></tr>
<tr><td></td><td align="center"><br /><input id="mysubmit" type="submit" value="Change Names"/></form></td></tr>
 
              
              <tr><td width="300px" align="left" colspan="2" height="30px"><b><font color="#FF8000">Photo</font></b><hr /></td></tr>     
              <tr><td><font color="#00B0F0">Choose an image and click upload.<br /><br /><a href="http://mypictr.com?size=68x75" title="mypictr.com - create your profile picture online">To edit your photos for free, please click here to visit<br />mypictr.com</a></font></td>
              <td width="300px" align="center">   <form name="form2" enctype="multipart/form-data" method="post" action="pcchange_photo.php" />
              <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAXFILESIZE; ?>" />
              <input type="file" size="10" name="my_photo" style="color:#00B0F0;"/>
              <input type="hidden" name="action" value="image" />
              <br /><br /><br /><input id="mysubmit" type="submit" name="submit" value="upload" /></td></tr>
              <tr><td><br /></td><td></td></tr>
              </form></td></tr>
              
               <tr>
                <form action="pcchange_number.php" method="post">
                <td width="300px" align="left" colspan="2" height="30px"><b><font color="#FF8000">Cell Phone Number</font></b><hr /></td></tr>
                <tr>
                <td><font color="#00B0F0">Old Cell # - 
<?php


 
   if(strlen($cell) == 7){
		echo preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", "$cell");
		}
	elseif(strlen($cell) == 10){
		echo preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", "$cell");
		}
	else{
		echo $cell; }  
            
?>                
                
                </font></td>
                <td><font color="#00B0F0">New Cell # </font><input type="text" name="new_cell" size="16" maxlength="16" /></td>
                <tr><td></td><td align="center"><br />
                <input id="mysubmit" type="submit" value="Change Cell #"/>
                </td></tr>
                </form>
                </td></tr>
      <tr><td width="300px" align="left" colspan="2" height="30px"><b><font color="#FF8000">Email</font></b><hr /></td></tr>
      <form action="pcchange_email.php" method="post">
      <tr><td><font color="#00B0F0">Old Email - <?php echo $old_email; ?></font></td>
      <td><font color="#00B0F0">New Email </font><input type="text" name="new_email" size="16" maxlength="100"/></td>
      </tr>
      <tr><td></td><td align="center"><br />
      <input id="mysubmit" type="submit" value="Change Email"/></form>
      </td></tr> 

      <tr><td width="300px" align="left" colspan="2" height="30px"><b><font color="#FF8000">City</font></b><hr /></td></tr>
      <form action="pcchange_city.php" method="post">
      <tr><td><font color="#00B0F0">Old City/State - <?php echo $old_city; ?></font></td>
      <td><font color="#00B0F0">New City/State&nbsp;</font><input type="text" name="new_city" size="18" maxlength="100"/></td>
      </tr>
      <tr><td></td><td align="center"><br />
      <input id="mysubmit" type="submit" value="Change City"/></form>
      </td></tr>  
      
      <tr><td width="300px" align="left" colspan="2" height="30px"><b><font color="#FF8000">Password</font></b><hr /></td></tr>
      <form action="pcchange_passwd.php" method="post">
      <tr><td height="30px"><font color="#00B0F0">Old Password <input type="password" name="old_passwd" size="14" maxlength="16"/></font></td>
      <td><font color="#00B0F0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;New Password&nbsp;&nbsp;</font><input type="password" name="new_passwd" size="14" maxlength="16" /></td>
      </tr>
      <tr>
      <td></td><td><font color="#00B0F0">Confirm Password&nbsp;</font><input type="password" name="new_passwd2" size="14" maxlength="16" /></td></tr>
      <tr><td></td><td align="center"><br /><input id="mysubmit" type="submit" value="Change Password" /> </form>
      </td></tr>         

              
      <tr><td width="300px" align="left" colspan="2" height="30px"><b><font color="#FF8000">Display Setting</font></b><hr /></td></tr>
      <form action="pcchange_display.php" method="post">
      <tr><td height="30px"><font color="#00B0F0">Old Display Setting - <?php echo $old_displaymode; ?></font></td>
      <td align="center"><font color="#00B0F0">New Display Setting<br /><br />
      Private <input type="radio" checked="checked" value="private" name="new_displaymode" /><br />
      Public <input type="radio" value="public" name="new_displaymode" /></font><br /><br /></td>
      </tr>
      <tr>
      <tr><td></td><td align="center"><input id="mysubmit" type="submit" value="Change Setting"/></form>
      </td></tr>         
              
              
              </table>
<?php
}

function display_pcforgot_form() {
  // display HTML form to reset and email password
?>
   <br /><br /><br />
   <form action="pcforgot_passwd.php" method="post">
   Enter your username
   <br /><br /><input type="text" name="username" size="16" maxlength="16"/>
   <br /><br />
   <input id="mysubmit" type="submit" value="Change Password"/>
   <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?php
}
 
function new_email() {
  $conn = db_connect();
// find out how many rows are in the table   
  $result = $conn->query("select count(*) from email where email.to= '".$_SESSION['valid_user']."' AND email.status = 'unread'");
  
$r = $result->fetch_row();
$numrows = $r[0];
if ($numrows > 0) {
echo '<b><img src="images/newmail.png" alt="New" align=absmiddle />('.$numrows.')</b><br />';

} 

mysqli_close($conn);

}

function new_mail() {
  $conn = db_connect();
// find out how many rows are in the table   
  $result = $conn->query("select count(*) from email where email.to= '".$_SESSION['valid_user']."' AND email.status = 'unread'");
  
$r = $result->fetch_row();
$numrows = $r[0];
if ($numrows > 0) {
echo '<b>('.$numrows.')<img src="images/newemail2.png" border="0" alt="New" align=bottom /></b>';

} 

mysqli_close($conn);

}
?>
