<?php
function do_idmypage_menu() {
?>
<ul class="pageitem">
		<li class="menu"><a href="idmember.php"> 
		<img alt="MyPage" src="thumbs/home2.png" /><span class="name">MyPage</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idedit.php"> 
		<img alt="Edit Profile" src="thumbs/settings.png" /><span class="name">Edit Profile</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idfriend.php"> 
		<img alt="Invite a Friend" src="thumbs/friend.png" /><span class="name">Invite-a-Friend</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="iduser_contact.php"> 
		<img alt="Contact Us" src="thumbs/telephone.png" /><span class="name">Contact Us</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idlogout.php"> 
		<img alt="Logout" src="thumbs/logout.png" /><span class="name">Logout</span><span class="comment"></span><span class="arrow"></span></a></li> 
 </ul>

<?php
}

function do_idmypage_mainmenu() {
?>

		<li class="menu"><a href="idsearch.php"> 
		<img alt="Search" src="thumbs/idusersearch.png" /><span class="name">Search</span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idadd_book.php"> 
		<img alt="Friends" src="thumbs/addbook.png" /><span class="name">Cellmates</span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idemail.php"> 
		<img alt="Inbox" src="thumbs/mail.png" /><span class="name">Inbox<?php new_mail2(); ?></span><span class="comment"></span><span class="arrow"></span></a></li> 
		<li class="menu"><a href="idupdate.php"> 
		<img alt="Updates" src="thumbs/update.png" /><span class="name">Updates</span><span class="arrow"></span></a></li> 
 </ul>

<?php
}

function do_idmypage_footer() {
?>
<div id="footer">
   <a href="iduser_contact.php">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="iduser_terms.php">Terms of Use</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="iduser_policy.php">Privacy Policy</b></a></p>
   &copy; 2009 cellme.mobi</p> 
	<a href="http://iwebkit.net">Powered by iWebKit</a></div> 
<script src="m-analytics.js" type="text/javascript"></script>
<?php 
}

function do_idad() {
?>
<ul class="pageitem"> 
		<li class="textbox"><span class="header">AdSpace</span><p>
    Advertise Here
    </p> 
		</li> 
	</ul> 
<?php
}

function new_mail2() {
  $conn = db_connect();
// find out how many rows are in the table   
  $result = $conn->query("select count(*) from email where email.to= '".$_SESSION['valid_user']."' AND email.status = 'unread'");
  
$r = $result->fetch_row();
$numrows = $r[0];
if ($numrows > 0) {
echo '<b>('.$numrows.')</b>';

} 

mysqli_close($conn);

}

// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.

function myTruncate($string, $limit, $break=".", $pad="...")
{
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }
    
  return $string;
}
?>
