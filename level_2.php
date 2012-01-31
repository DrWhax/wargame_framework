<?php
	require("./template/head.inc.php");
	require("start.php");
?>
  <legend>2600nl > Level 2 > Watch me</legend>

<p>
<?php
#define level
	define("LEVEL", "2", true);
	
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
	$wachtwoord  = '525339ef';
		if($wachtwoord == $pwachtwoord){
		echo("<b><font color=green>You have passed this test. Let's go to the next level. </font><br />
		<a href=\"./level_3.php\" alt=\"Click me\" title=\"Click me\">Click here</a></b>");
			mysql_query("UPDATE `challenge` SET `level` = '3' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
			or die(mysql_error());	
		
		}
		else{
		echo('<b><font color=red>You have failed this test. <a href="./level_2.php" alt="Go back" title="Go back">Go back</a></font></b>');
					
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
<p>
	<form action="./level_2.php" method="post">
	<div class="float" style="width: 100px;">
		Password:
	</div>
	<div class="float" style="width: 200px;">
		<input type="password" name="password" class="field">
		<input type="hidden" name="file" value="password.txt">
	</div>
		
	<br />
		<input type="submit" value="Log in" name="submit" class="button">
	</form>
</p>
<?php
}
	require("./template/foot.inc.php");
?>
