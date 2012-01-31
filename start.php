<?php

	/**		
	*  @author: 	Niels Kootstra & Jurre				
	*  @version: 	0.1	
	*  @project: 	Challenge system with mysql					
	*  @website: 	Kootstra.net	|	Securitylab.ws				
	**/	
	
	/* Include */
		require("./database.inc.php");
	
	/* Make vars */
		$salt 			= "A5V&GZot@j#&35%njzsNPp6GuLmiPq&Fn@qYTKGbDG^vSGaHD*8^E8Q2qckd50Qbf.Lk1EoCglDP3kib2Xhkx1!tSa~,I&xowa(#hAt=yM9Utlv2KJt*";

		$ip				= $_SERVER["REMOTE_ADDR"];
		
		$unique_id		= hash_hmac('SHA256', $ip, $salt);
		
		$hash		 	= hash_hmac('ripemd160', $ip, $salt);
		
		@$select	= mysql_query("SELECT `ip` , `tries` FROM challenge WHERE `ip` = '".$ip."' AND `ip_hash` = '".$hash."'  LIMIT 1") or die(mysql_error());
		
			$row	= mysql_fetch_assoc($select);
		
		if (!isset($_COOKIE['unique_id']) AND !isset($_COOKIE['hash']))
		{		
			setcookie("unique_id", $unique_id, time()+31536000);
			setcookie("hash", $hash, time()+31536000);
				
				if (mysql_num_rows($select) == "0") {					
					mysql_query("INSERT INTO `challenge` ( `unique` , `ip_hash` , `ip` , `level` , `tries` )
					VALUES (
					'".$unique_id."', '".$hash."', '".$ip."', '1', '0')") or die(mysql_error());
					
				}
				
		} Else {
			/* Check if COOKIE is valid */
			If($hash != $_COOKIE['hash'] OR $unique_id != $_COOKIE['unique_id'] OR $row['ip'] != $ip) {
				setcookie("unique_id", $unique_id, time()-31536000);
				setcookie("hash", $hash, time()-31536000);
				exit;
			}
		}
		
?>