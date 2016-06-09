<?php

 require_once('../mycell_fns.php');
 session_start();
  include('../openinviter.php');
$inviter=new OpenInviter();
$oi_services=$inviter->getPlugins();
$mail = $_GET['mail'];
if (isset($_GET['mail']))  {
if (!validate_get($mail))
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
if ($mail == 'true') { echo '<center><font size="3" color="#F000F0">Email Sent</font><br /></center>';}
if ($mail == 'false') { echo '<center><font size="3" color="#F000F0">Problem - Email not sent<br />Please check your information and try again</font><br /></center>';}
if (isset($_POST['provider_box'])) 
{
	if (isset($oi_services['email'][$_POST['provider_box']])) $plugType='email';
	elseif (isset($oi_services['social'][$_POST['provider_box']])) $plugType='social';
	else $plugType='';
}
else $plugType = '';
function ers($ers)
	{
	if (!empty($ers))
		{
		$contents="<table cellspacing='0' cellpadding='0' style='border:1px solid red;' align='center' class='tbErrorMsgGrad'><tr><td valign='middle' style='padding:3px' valign='middle' class='tbErrorMsg'><img src='/images/ers.gif'></td><td valign='middle' style='color:red;padding:5px;'>";
		foreach ($ers as $key=>$error)
			$contents.="{$error}<br >";
		$contents.="</td></tr></table><br >";
		return $contents;
		}
	}
	
function oks($oks)
	{
	if (!empty($oks))
		{
		$contents="<table border='0' cellspacing='0' cellpadding='10' style='border:1px solid #5897FE;' align='center' class='tbInfoMsgGrad'><tr><td valign='middle' valign='middle' class='tbInfoMsg'><img src='/images/oks.gif' ></td><td valign='middle' style='color:#5897FE;padding:5px;'>	";
		foreach ($oks as $key=>$msg)
			$contents.="{$msg}<br >";
		$contents.="</td></tr></table><br >";
		return $contents;
		}
	}

if (!empty($_POST['step'])) $step=$_POST['step'];
else $step='get_contacts';

$ers=array();$oks=array();$import_ok=false;$done=false;
if ($_SERVER['REQUEST_METHOD']=='POST')
	{
	if ($step=='get_contacts')
		{
		if (empty($_POST['email_box']))
			$ers['email']="Email missing";
		if (empty($_POST['password_box']))
			$ers['password']="Password missing";
		if (empty($_POST['provider_box']))
			$ers['provider']="Provider missing";
		if (count($ers)==0)
			{
			$inviter->startPlugin($_POST['provider_box']);
			$internal=$inviter->getInternalError();
			if ($internal)
				$ers['inviter']=$internal;
			elseif (!$inviter->login($_POST['email_box'],$_POST['password_box']))
				{
				$internal=$inviter->getInternalError();
				$ers['login']=($internal?$internal:"Login failed. Please check the email and password you have provided and try again later");
				}
			elseif (false===$contacts=$inviter->getMyContacts())
				$ers['contacts']="Unable to get contacts.";
			else
				{
				$import_ok=true;
				$step='send_invites';
				$_POST['oi_session_id']=$inviter->plugin->getSessionID();
				$_POST['message_box']='';
				}
			}
		}
	elseif ($step=='send_invites')
		{
		if (empty($_POST['provider_box'])) $ers['provider']='Provider missing';
		else
			{
			$inviter->startPlugin($_POST['provider_box']);
			$internal=$inviter->getInternalError();
			if ($internal) $ers['internal']=$internal;
			else
				{
				if (empty($_POST['email_box'])) $ers['inviter']='Inviter information missing';
				if (empty($_POST['oi_session_id'])) $ers['session_id']='No active session';
				if (empty($_POST['message_box'])) $ers['message_body']='Message missing';
				else $_POST['message_box']=strip_tags($_POST['message_box']);
				$selected_contacts=array();$contacts=array();
				$message=array('subject'=>$inviter->settings['message_subject'],'body'=>$inviter->settings['message_body'],'attachment'=>"\n\rAttached message: \n\r".$_POST['message_box']);
				if ($inviter->showContacts())
					{
					foreach ($_POST as $key=>$val)
						if (strpos($key,'check_')!==false)
							$selected_contacts[$_POST['email_'.$val]]=$_POST['name_'.$val];
						elseif (strpos($key,'email_')!==false)
							{
							$temp=explode('_',$key);$counter=$temp[1];
							if (is_numeric($temp[1])) $contacts[$val]=$_POST['name_'.$temp[1]];
							}
					if (count($selected_contacts)==0) $ers['contacts']="You haven't selected any contacts to invite";
					}
				}
			}
		if (count($ers)==0)
			{
			$sendMessage=$inviter->sendMessage($_POST['oi_session_id'],$message,$selected_contacts);
			$inviter->logout();
			if ($sendMessage===-1)
				{
				$message_footer="\r\n\r\nThis invite was sent using OpenInviter technology.";
				$message_subject=$_POST['email_box'].$message['subject'];
				$message_body=$message['body'].$message['attachment'].$message_footer; 
				$headers="From: {$_POST['email_box']}";
				foreach ($selected_contacts as $email=>$name)
					mail($email,$message_subject,$message_body,$headers);
				$oks['mails']="Mails sent successfully";
				}
			elseif ($sendMessage===false)
				{
				$internal=$inviter->getInternalError();
				$ers['internal']=($internal?$internal:"There were errors while sending your invites.<br>Please try again later!");
				}
			else $oks['internal']="Invites sent successfully!";
			$done=true;
			}
		}
	}
else
	{
	$_POST['email_box']='';
	$_POST['password_box']='';
	$_POST['provider_box']='';
	}

$contents="<script type='text/javascript'>
	function toggleAll(element) 
	{
	var form = document.forms.openinviter, z = 0;
	for(z=0; z<form.length;z++)
		{
		if(form[z].type == 'checkbox')
			form[z].checked = element.checked;
	   	}
	}
</script>";
$contents.="<form action='' method='POST' name='openinviter'>".ers($ers).oks($oks);
if (!$done)
	{
	if ($step=='get_contacts')
		{
		$contents.="Email<li class='form'><input placeholder='Email' class='thTextbox' type='text' name='email_box' value='{$_POST['email_box']}' /></li>
                Password<li class='form'><input placeholder='Password' class='thTextbox' type='password' name='password_box' value='{$_POST['password_box']}' /></li>
                <li class='form'><select name='provider_box'>><option disabled>Email Providers</option><option value='abv'>Abv</option><option value='aol'>AOL</option><option value='apropo'>Apropo</option><option value='azet'>Azet</option><option value='bigstring'>Bigstring</option><option value='care2'>Care2</option><option value='clevergo'>Clevergo</option><option value='doramail'>Doramail</option><option value='evite'>Evite</option><option value='fastmail'>FastMail</option><option value='fm5'>5Fm</option><option value='gawab'>Gawab</option><option value='gmail'>GMail</option><option value='gmx_net'>GMX.net</option><option value='hotmail'>Live/Hotmail</option><option value='hushmail'>Hushmail</option><option value='inbox'>Inbox.com</option><option value='indiatimes'>IndiaTimes</option><option value='interia'>Interia</option><option value='katamail'>KataMail</option><option value='libero'>Libero</option><option value='lycos'>Lycos</option><option value='mail_com'>Mail.com</option><option value='mail_in'>Mail.in</option><option value='mail_ru'>Mail.ru</option><option value='mynet'>Mynet.com</option><option value='netaddress'>Netaddress</option><option value='nz11'>Nz11</option><option value='operamail'>OperaMail</option><option value='popstarmail'>Popstarmail</option><option value='rambler'>Rambler</option><option value='rediff'>Rediff</option><option value='sapo'>Sapo.pt</option><option value='terra'>Terra</option><option value='uk2'>Uk2</option><option value='walla'>Walla</option><option value='web_de'>Web.de</option><option value='wpl'>Wp.pt</option><option value='yahoo'>Yahoo!</option><option value='yahooj'>Yahoo!Japan</option><option value='yandex'>Yandex</option><option value='zapak'>Zapakmail</option><option disabled>Social Networks</option><option value='badoo'>Badoo</option><option value='bebo'>Bebo</option><option value='brazencareerist'>Brazencareerist</option><option value='cyworld'>Cyworld</option><option value='eons'>Eons</option><option value='facebook'>Facebook</option><option value='faces'>Faces</option><option value='famiva'>Famiva</option><option value='fdcareer'>Fdcareer</option><option value='flickr'>Flickr</option><option value='flingr'>Flingr</option><option value='flixster'>Flixster</option><option value='friendfeed'>Friendfeed</option><option value='friendster'>Friendster</option><option value='hi5'>Hi5</option><option value='hyves'>Hyves</option><option value='kincafe'>Kincafe</option><option value='konnects'>Konnects</option><option value='lastfm'>Last.fm</option><option value='linkedin'>LinkedIn</option><option value='livejournal'>Livejournal</option><option value='lovento'>Lovento</option><option value='meinvz'>Meinvz</option><option value='mevio'>Mevio</option><option value='motortopia'>Motortopia</option><option value='multiply'>Multiply</option><option value='mycatspace'>Mycatspace</option><option value='mydogspace'>Mydogspace</option><option value='myspace'>MySpace</option><option value='orkut'>Orkut</option><option value='perfspot'>Perfspot</option><option value='plaxo'>Plaxo</option><option value='plazes'>Plazes</option><option value='plurk'>Plurk</option><option value='skyrock'>Skyrock</option><option value='tagged'>Tagged</option><option value='twitter'>Twitter</option><option value='vimeo'>Vimeo</option><option value='xanga'>Xanga</option><option value='xing'>Xing</option><option value='xuqa'>Xuqa</option>";
		$contents.="</select><span class='arrow'></span> </li>
		<input type='hidden' name='step' value='get_contacts'>
    			<li class='form'><input id='mysubmit' type='submit' name='import' value='Import Contacts' /></li><hr />";
		}
	else
		$contents.="<table class='thTable' cellspacing='0' cellpadding='0' style='border:none;'>
				<tr class='thTableRow'><td align='right' valign='top'><label for='message_box'>Message</label></td><td><textarea rows='5' cols='50' name='message_box' class='thTextArea' style='width:300px;'>{$_POST['message_box']}</textarea></td></tr>
				<tr class='thTableRow'><td align='center' colspan='2'><input type='submit' name='send' value='Send Invites' id='mysubmit' ></td></tr>
			</table>";
	}
if (!$done)
	{
	if ($step=='send_invites')
		{
		if ($inviter->showContacts())
			{
			$contents.="<table class='thTable' align='center' cellspacing='0' cellpadding='0'><tr class='thTableHeader'><td colspan='".($plugType=='email'? "3":"2")."'>Your contacts</td></tr>";
			if (count($contacts)==0)
				$contents.="<tr class='thTableOddRow'><td align='center' style='padding:20px;' colspan='".($plugType=='email'? "3":"2")."'>You do not have any contacts in your address book.</td></tr>";
			else
				{
				$contents.="<tr class='thTableDesc'><td><input type='checkbox' onChange='toggleAll(this)' name='toggle_all' title='Select/Deselect all' checked>Invite?</td><td>Name</td>".($plugType == 'email' ?"<td>E-mail</td>":"")."</tr>";
				$odd=true;$counter=0;
				foreach ($contacts as $email=>$name)
					{
					$counter++;
					if ($odd) $class='thTableOddRow'; else $class='thTableEvenRow';
					$contents.="<tr class='{$class}'><td><input name='check_{$counter}' value='{$counter}' type='checkbox' class='thCheckbox' checked><input type='hidden' name='email_{$counter}' value='{$email}'><input type='hidden' name='name_{$counter}' value='{$name}'></td><td>{$name}</td>".($plugType == 'email' ?"<td>{$email}</td>":"")."</tr>";
					$odd=!$odd;
					}
				$contents.="<tr class='thTableFooter'><td colspan='".($plugType=='email'? "3":"2")."' style='padding:3px;'><input type='submit' name='send' value='Send invites' class='thButton'></td></tr>";
				}
			$contents.="</table>";
			}
		$contents.="<input type='hidden' name='step' value='send_invites'>
			<input type='hidden' name='provider_box' value='{$_POST['provider_box']}'>
			<input type='hidden' name='email_box' value='{$_POST['email_box']}'>
			<input type='hidden' name='oi_session_id' value='{$_POST['oi_session_id']}'>";
		}
	}
$contents.="</form>";
echo $contents;
?>

   <br />-OR-<br /><br />
    Send them individually using the form below<br /><br />
    <form action="idinvite_form.php" method="post"> 
<li class="form"><input placeholder="To" name="to" type="text" /></li>
<li class="form"><input placeholder="Email" name="email" type="text" /></li>
From:
<li class="form"><input placeholder="From" name="from" type="text" value="
<?php 
  $conn = db_connect();
  $result = $conn->query("select * from user
                            where username = '".$_SESSION['valid_user']."'");
  $row=$result->fetch_object();
  $fname = $row->fname;
  $lname = $row->lname;
  echo $fname.' '.$lname;
     mysqli_close($conn);
?>
" /></li>

<li class="textbox"><textarea name="feedback" rows="6" cols="40" wrap="virtual" />I found an interesting website you might like at http://cellme.mobi. It is a great way to look up cell phone numbers as well as store and access your cell numbers on the web. The best part is it is free!</textarea></li> 
<li class="textbox"><label for="verify">Verification<br />Enter the phrase below:<br />
</label>
<img src="captcha.php" alt="Verification pass-phrase" /></li>
<li class="form"><input placeholder="Verification Pass-Phrase" type="text" id="verify" name="verify" /></li>
<li class="form"><input id="mysubmit" type="submit" value="Send Email" /></li>
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
