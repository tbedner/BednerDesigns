<?php
	$openinviter_settings=array(
		"username"=>"tbedner",
		"private_key"=>"9309727045ecd6c7afca4f2cfc23aded",
		"cookie_path"=>'/tmp',
		"message_body"=>"You are invited to www.at-school.info", // www.at-school.info is the website on your account. If wrong, please update your account at OpenInviter.com
		"message_subject"=>" is inviting you to www.at-school.info", // www.at-school.info is the website on your account. If wrong, please update your account at OpenInviter.com
		"transport"=>"curl", //Replace "curl" with "wget" if you would like to use wget instead
		"local_debug"=>"on_error", //Available options: on_error => log only requests containing errors; always => log all requests; false => don`t log anything
		"remote_debug"=>FALSE //When set to TRUE OpenInviter sends debug information to our servers. Set it to FALSE to disable this feature
	);
	?>