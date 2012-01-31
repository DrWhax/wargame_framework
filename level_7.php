<?php
	require("./template/head.inc.php");
	require("start.php");
?>
  <legend>2600nl > Level 7 > The result</legend>

<p>
<?php
#define level
	define("LEVEL", "7", true);
	
	$checklevel	= mysql_query("SELECT `username` , `level` FROM challenge WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1") or die(mysql_error());
	$rank	= mysql_fetch_assoc($checklevel);

	if($rank['level'] >= LEVEL) {
		# Access
			
	} else {
		# Access Denied
		header("Location: ./level_".$rank['level'].".php");
	}

?>
<?php
if (!empty($rank['username'])) {
	echo "<p><b><font color=red>You already added your username.</font></b></p>
		<p><b><font color=green>You have passed the test.</font></b></p>";
		echo "<a href=\"http://events.2600nl.net/challenge/highscore.php\"> The highscore list</a>";
} else { 
	if(isset($_POST['username'])) {
	 	$username	=	mysql_real_escape_string(htmlentities(addslashes($_POST['username'])));	 		
			if(strlen($username) >= 10) {
				echo "<p><b><font color=red>Don't use more than 10 characters.</font></b></p>";
			} elseif (eregi("^[a-zA-Z0-9]$", $username)) {
				echo "<p><b><font color=red>You can only use a-z, A-Z and 0-9 characters</font></b></p>";
	 		} else {
			  	echo "<p><b><font color=green>Your username is accepted. Look in the highscore list. <small>Maybe you're number one ?</small></font></b></p>";
				echo "<a href=\"http://events.2600nl.net/challenge/highscore.php\"> The highscore list</a>";
				mysql_query("UPDATE `challenge` SET `username` = '".$username."' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
				or die(mysql_error());
			}
	}
?>
<small>To complete this challenge you must enter your username before we can put you in the highscore list</small>
<form method="post">
	<div class="float" style="width: 100px;" class="field">
		Username:
	</div>
	<div class="float" style="width: 200px;">
		<input type="text" name="username" class="field">
	</div>
	<br />
  <input type="submit" value="Submit" name="submit" class="button">
</form>
 </p>
<?php
	}
	require("./template/foot.inc.php");
?>
