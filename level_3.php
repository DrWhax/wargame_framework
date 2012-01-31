<?php
	require("./template/head.inc.php");
	require("start.php");
?>
  <legend>2600nl > Level 3 > E-mail</legend>

<p>
<?php
#define level
	define("LEVEL", "3", true);
	
	$checklevel	= mysql_query("SELECT `level` FROM challenge WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1") or die(mysql_error());
	$rank	= mysql_fetch_assoc($checklevel);

	if($rank['level'] >= LEVEL) {
		# Access
		
		if($rank['level'] != LEVEL) {
			header("Location: ./level_".$rank['level'].".php");	
		}
	
	} else {
		# Access Denied
		header("Location: ./level_".$rank['level'].".php");
	}

?>
<?php

if(isset($_POST['submit'])){
	$pwachtwoord = htmlentities(addslashes($_POST['password']));
	$wachtwoord  = '837927dc';
	
	if($wachtwoord == $pwachtwoord) {
		echo("<b><font color=green>You have passed this test. Let's go to the next level. </font><br />
		<a href=\"./level_4.php\" alt=\"Click me\" title=\"Click me\">Click here</a></b>");
			mysql_query("UPDATE `challenge` SET `level` = '4' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
			or die(mysql_error());	
			
	} else {
		echo('<b><font color=red>You have failed this test. <a href="./level_3.php" alt="Go back" title="Go back">Go back</a></font></b>');
					
		/* Update tries (because of failure) */
					$database	= mysql_query("SELECT `tries` FROM challenge WHERE `ip` = '".$ip."' LIMIT 1")
					or die(mysql_error());
					
						$foo	= mysql_fetch_assoc($database);
					
							$tries	=	$foo['tries'] + 1;
						mysql_query("UPDATE `challenge` SET `tries` = '".$tries."' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
						or die(mysql_error());
						
	}

} Else {

if(isset($_POST['mail'])) {
	$to      = htmlentities(addslashes($_POST['email']));
	$subject = 'Your new password for 2600nl';

$message = 'Dear member,
As you requested, your password has now been reset. Your new details are as follows:

Your new password is: 837927dc

Securitylab.ws Team';
$headers = 'From: noreply@2600nl.net' . "\r\n" .

mail($to, $subject, $message, $headers);

	echo "<b><font color=orange>There is a new password sended to ".$to."</font></b><br><br>";
}

?>
<form action="./level_3.php" method="post">
	<div class="float" style="width: 100px;">
		password:
	</div>
	<div class="float" style="width: 200px;">
		<input type="password" name="password">
	</div>
	<div class="float" style="width: 150px;">
  		<input type="hidden" name="email" value="password.challenges@securitylab.ws">
  		<input type="submit" value="Lost password" name="mail" />
  	</div>
  <br />
  <input type="submit" value="Log in" name="submit">
</p>
</form>
</p>
<?php
	}
	require("./template/foot.inc.php");
?>