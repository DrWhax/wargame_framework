<?php
	require("./template/head.inc.php");
	require("start.php");
?>
  <legend>2600nl > Level 4 > Cross Site Scripting</legend>

<p>
<?php
#define level
	define("LEVEL", "4", true);
	
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
	$wachtwoord  = '738892hs';
		if($wachtwoord == $pwachtwoord) {
		 
		echo("<b><font color=green>You have passed this test. Let's go to the next level. </font><br />
		<a href=\"./level_5.php\" alt=\"Click me\" title=\"Click me\">Click here</a></b>");
			mysql_query("UPDATE `challenge` SET `level` = '5' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
			or die(mysql_error());	
		
		} else {	 
		echo('<b><font color=red>You have failed this test. <a href="./level_4.php" alt="Go back" title="Go back">Go back</a></font></b>');
					
		/* Update tries (because of failure) */
					$database	= mysql_query("SELECT `tries` FROM challenge WHERE `ip` = '".$ip."' LIMIT 1")
					or die(mysql_error());
					
						$foo	= mysql_fetch_assoc($database);
					
							$tries	=	$foo['tries'] + 1;
						mysql_query("UPDATE `challenge` SET `tries` = '".$tries."' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
						or die(mysql_error());
		
		}
} elseif(isset($_POST['login'])){
	$naam = strtolower(htmlentities(addslashes($_POST['name'])));
	if($naam == 'securitylab'){
		echo "<b><font color=orange>Good job<br><br>Your password is: 738892hs<br />
		<a href=\"./level_4.php\" alt=\"Go back\" title=\"Go back\">Go back</a></font></b>";
	} else {
		echo("<b><font color=red>Your log in name is wrong. Please try again.<br />
		<a href=\"./level_4.php\" alt=\"Go back\" title=\"Go back\">Go back</a></font></b>");
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
<p>Try to log in as <strong>Securitylab</strong></p>
<form action="./level_4.php" method="post">
	Get your password back <strong>Securitylab</strong>:
	<div class="float" style="width: 150px;">
		Select your name
	</div>
	<div class="float" style="width: 200px;">
		<select size="1" name="name">
			<option selected>Security</option>
			<option>Google</option>
			<option>Challenge</option>
		</select>
	</div>
	<div class="float" style="width: 100px;">
		<input type="submit" value="Get in" name="login">
	</div>
		<br />
		<br />
	Only if you know my password:
	<div class="float" style="width: 100px;">
			Password:
		</div>
		<div class="float" style="width: 200px;">
			<input type="password" name="password">
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