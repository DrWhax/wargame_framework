<?php
	require("./template/head.inc.php");
	require("start.php");
?>
  <legend>2600nl > Level 1 > The difference between a noob and you</legend>

<p>
<?php
#define level
	define("LEVEL", "1", true);
	
	$checklevel	= mysql_query("SELECT `level` FROM challenge WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1") or die(mysql_error());
	$rank	= mysql_fetch_assoc($checklevel);

	if($rank['level'] >= LEVEL) {
		# Access
		
		if($rank['level'] != LEVEL) {
			header("Location: ./level_".$rank['level'].".php");	
		}
		
	} else {
		# Access Denied
		Header("Location: ./level_".$rank['level'].".php");
	}

?>
<?php

	if(isset($_POST['password']) AND $_POST['password'] != "") {
	$pwachtwoord = htmlentities(addslashes($_POST['password']));
	$wachtwoord  = '243436c3';

			if($wachtwoord == $pwachtwoord) {
				echo("<b><font color=green>You have passed this test. Let's go to the next level. </font><br />
		<a href=\"./level_2.php\" alt=\"Click me\" title=\"Click me\">Click here</a></b>");
							
					mysql_query("UPDATE `challenge` SET `level` = '2' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
					or die(mysql_error());	
				
			}
			else /* If the password is wrong */
			{
			 	
				echo('<b><font color=red>You have failed this test. <a href="./level_1.php" alt="Go back" title="Go back">Go back</a></font></b>');
				
				/* Update tries (because of failure) */
				$database	= mysql_query("SELECT `tries` FROM challenge WHERE `ip` = '".$ip."' LIMIT 1")
				or die(mysql_error());
				
					$foo	= mysql_fetch_assoc($database);
				
						$tries	=	$foo['tries'] + 1;
					mysql_query("UPDATE `challenge` SET `tries` = '".$tries."' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
					or die(mysql_error());
					
			} 
} Else {

?>
</p>
<p>
	This is your first level, search on this page for a password. 
	<form method="post">
	<!-- Please insert the following password 243436c3 -->
	<div class="float" style="width: 100px;">
		Password:
	</div>
	<div class="float" style="width: 200px;">
		<input type="password" name="password" class="field">
	</div>
	<br />		
		<input type="submit" value="Log in" name="submit" class="button">
	</form>
</p>
<?php
	}
?>


<?php
	require("./template/foot.inc.php");
?>