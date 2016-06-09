<?php
 require_once('mycell_fns.php');
 include('mobile_device_detect.php');
mobile_device_detect('http://cellme.mobi/id/id.php?confirm=true','http://cellme.mobi/id/id.php?confirm=true',true,true,true,true,false,false);
  $confirm_code=trim($_GET['confirm_code']); 
  $confirm_code=sql_sanitize($confirm_code); 
if (strlen($confirm_code) > 32) {exit;}
if ($mobile_browser==true) {

 do_html_header('cellme.mobi');
 do_ad();
  $conn = db_connect();
  $result = $conn->query("select * from temp_confirm
                            where confirm_code ='".$confirm_code."'");
if (!$result){
 do_html_header('cellme.mobi');
?>
    <!-- page content -->
    <p><img class="ad" src="images/ad1.jpg" alt="Text Ad"></p>
    <p><h3>Problem</h3></p>
    <p>The confirmation code could not be located. If you would like to confirm this request, please forward the confirmation email to us at confirm@cellme.mobi or use the Contact Us link above. Thank you.</p>
<?php
 display_login_form();
 do_ad();
do_html_indexfooter();
}
else{
  $row=$result->fetch_object();
  $id=$row->id;
  $id2=$row->id2;
    $conn = db_connect();

  // check not a repeat entry
  $result = $conn->query("select * from add_book
                         where username = '$id' and ent_id='$id2'");
  $num_row = $result->num_rows;
  if ($result && ($num_row>0)) {
    echo '<br />';
    echo 'Entry already exists.';
    return;
  }
      $conn = db_connect();

  // add entries

  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username ='".$id2."'");
  $row=$result->fetch_object();
  $fname2 = $row->fname;
  $lname2 = $row->lname;
  $email2 = $row->email;
  $city2 = $row->city;
  $cell2 = $row->cell;
  $photo2 = $row->photo;
  $usermode2 = $row->usermode;
  
  $conn = db_connect();
  $result = $conn->query("insert into add_book values
                         ('".$id."', '".$id2."', '".$fname2."', '".$lname2."', '".$city2."', '".$cell2."', '".$photo2."', '".$usermode2."')");
  
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                         where username = '$id2' and ent_id='$id'");
  $num_row = $result->num_rows;
  if ($result && ($num_row>0)) {
    
    echo '<br />';
  } else{
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username ='".$id."'");
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  $email = $row->email;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $usermode = $row->usermode;
  
  $conn = db_connect();
  $result = $conn->query("insert into add_book values
                         ('".$id2."', '".$id."', '".$fname."', '".$lname."', '".$city."', '".$cell."', '".$photo."', '".$usermode."')");
}
$toaddress = $email2;

$subject = "Your request for a cell number";

$mailcontent = "Dear $fname2,\n \nYour request for a cell phone number for $fname has been confirmed.\nTheir information has been added to your address book and vice versa.\nThank you.\n \nMycell Support Staff";

$fromaddress = "From: service@mycell.com";

//invoke mail() function to send mail

$sent = mail($toaddress, $subject, $mailcontent, $fromaddress);
if($sent) {
  echo 'Your mail was sent successfully'; 
  }
else {
  echo 'We encountered an error sending your mail'; 
  }
   mysqli_close($conn);
do_ad();
?>
    <!-- page content -->

    <p><h3><center>Request Confirmed</center></h3></p>
    <p><span class="menu"><font color="black">
      The request has been confirmed and your address book has been updated. An email has been sent notifying <?php echo $fname;?> of the confirmation and their address book has been updated with your information. Thank you.</span></p>
    
<?php
    do_ad();
    do_html_footer();

} }
else {

  $conn = db_connect();
  $result = $conn->query("select * from temp_confirm
                            where confirm_code ='".$confirm_code."'");
if (!$result){
?>
    <!-- page content -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>cellme.mobi</title>
  <link type="text/css" rel="stylesheet" href="cellme.css" />
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
do_pc_ad();
?>
          </div>               
            <div id="nifty"> 
              <b class="rtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b> 
                <div id="logo">
                  <img src="images/logo3.jpg" alt="cellme.mobi" />
                </div>
                <div id="box">
                  <h2>Problem</h2> 
    <!-- page content -->
    <p align="left">The confirmation code could not be located. If you would like to confirm this request, please forward the confirmation email to us at confirm@cellme.mobi or use the Contact Us link above. Thank you.</p>
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                </div> 

              <b class="rbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b> 
          </div> 
          <div class="ad">
<?php
do_pc_ad2();
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
exit;
}
else {
  $row=$result->fetch_object();


  $id=$row->id;
  $id2=$row->id2;
?>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>cellme.mobi</title>
  <link type="text/css" rel="stylesheet" href="cellme.css" />
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
do_pc_ad();
?>
          </div>             
            <div id="nifty"> 
              <b class="rtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b> 
                <div id="logo">
                  <image src="images/logo3.jpg" alt="cellme.mobi" />
                </div>
                <div id="box">
<?php
    $conn = db_connect();

  // check not a repeat entry
  $result = $conn->query("select * from add_book
                         where username = '$id' and ent_id='$id2'");
  $num_row = $result->num_rows;
  if ($result && ($num_row>0)) {
    echo '<br />';
    echo 'Entry already exists.';
    return;
  }
      $conn = db_connect();

  // check not a repeat entry

  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username ='".$id2."'");
  $row=$result->fetch_object();
  $fname2 = $row->fname;
  $lname2 = $row->lname;
  $email2 = $row->email;
  $city2 = $row->city;
  $cell2 = $row->cell;
  $photo2 = $row->photo;
  $usermode2 = $row->usermode;
  
  $conn = db_connect();
  $result = $conn->query("insert into add_book values
                         ('".$id."', '".$id2."', '".$fname2."', '".$lname2."', '".$city2."', '".$cell2."', '".$photo2."', '".$usermode2."')");
  
  $conn = db_connect();
  $result = $conn->query("select * from add_book
                         where username = '$id2' and ent_id='$id'");
  $num_row = $result->num_rows;
  if ($result && ($num_row>0)) {
    
    echo '<br />';
  } else{
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username ='".$id."'");
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  $email = $row->email;
  $city = $row->city;
  $cell = $row->cell;
  $photo = $row->photo;
  $usermode = $row->usermode;
  
  $conn = db_connect();
  $result = $conn->query("insert into add_book values
                         ('".$id2."', '".$id."', '".$fname."', '".$lname."', '".$city."', '".$cell."', '".$photo."', '".$usermode."')");
}
$toaddress = $email2;

$subject = "Your request for a cell number";

$mailcontent = "Dear $fname2,\n \nYour request for a cell phone number for $fname has been confirmed.\nTheir information has been added to your address book and vice versa.\nThank you.\n \nMycell Support Staff";

$fromaddress = "From: service@mycell.com";

//invoke mail() function to send mail

$sent = mail($toaddress, $subject, $mailcontent, $fromaddress);
if($sent) {
  echo 'Your mail was sent successfully'; 
  }
else {
  echo 'We encountered an error sending your mail'; 
  }
   mysqli_close($conn);
do_ad();
?>
    <!-- page content -->

    <p><h3><center>Request Confirmed</center></h3></p>
    <p><span class="menu"><font color="black">
      The request has been confirmed and your address book has been updated. An email has been sent notifying <?php echo $fname;?> of the confirmation and their address book has been updated with your information. Thank you.</span></p>
                </div> 
              <b class="rbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b> 
          </div> 
          
          <div class="ad">
<?php
do_pc_ad2();
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
} }
?>
