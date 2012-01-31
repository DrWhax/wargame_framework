<?php
	require("./template/head.inc.php");
	require("start.php");
?>
  <legend>2600nl > Level 6 > The power of SQL Injection</legend>

<p>
<?php
#define level
	define("LEVEL", "6", true);
	
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
/*------- functies -------*/

$hint      = true; // Bij true kan er om een hint gevraagd worden bij false niet

$error    = 0;      // Het error_reporting level
?>
<?php
error_reporting($error);

if(isset($_POST["submit"])){
        if(empty($fouten)){
                $fouten = "0";
        }

        if(empty($_POST['username']) or $_POST['username'] == "Username"){

                echo 'U didn\'\t entered a username';

        }elseif(empty($_POST['password']) or $_POST['password'] == "Password"){

                echo 'U didn\'\t entered a password';

        }else{

        $login  = stripslashes($_POST['username']);

        $login = str_replace("DELETE","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("delete","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("TRUNCATE","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("truncate","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("UPDATE","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("update","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("DROP","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("drop","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("INSERT","~~",$login) or die ("This SQL Injection is blocked");

        $login = str_replace("insert","~~",$login) or die ("This SQL Injection is blocked");

       

        $wachtwoord     = stripslashes($_POST['password']);

        $wachtwoord = str_replace("DELETE","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("delete","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("TRUNCATE","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("truncate","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("UPDATE","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("update","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("DROP","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("drop","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("INSERT","~~",$wachtwoord) or die ("This SQL Injection is blocked");

        $wachtwoord = str_replace("insert","~~",$wachtwoord) or die ("This SQL Injection is blocked");

 

        $query  = mysql_query("SELECT * FROM hackingchallenge_leden WHERE `login`='".$login."' AND `wachtwoord`='".$wachtwoord."'");

       

                if($row         = mysql_fetch_object($query)){

					echo("<b><font color=green>You have passed this test. Let's go to the next level. </font><br />
					<a href=\"./level_7.php\" alt=\"Click me\" title=\"Click me\">Click here</a></b>");
						mysql_query("UPDATE `challenge` SET `level` = '7' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
						or die(mysql_error());

                }else{

                	echo("<b><font color=red>The username or password is wrong. Please try it again. <a href=\"./level_6.php\" alt=\"Go back\" title=\"Go back\">Go back</a></font></b>");
                	
					/* Update tries (because of failure) */
					$database	= mysql_query("SELECT `tries` FROM challenge WHERE `ip` = '".$ip."' LIMIT 1")
					or die(mysql_error());
					
						$foo	= mysql_fetch_assoc($database);
					
							$tries	=	$foo['tries'] + 1;
						mysql_query("UPDATE `challenge` SET `tries` = '".$tries."' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
						or die(mysql_error());

                        $fouten++;

                }

        }

} Else {
?>
<form method="post">
	<div class="float" style="width: 150px;">
		Username
	</div>
	<div class="float" style="width: 200px;">
		<input type="text" name="username" value="username" size="20" class="field">
	</div>
		<br />
	<div class="float" style="width: 150px; padding-top: 3px;">
		Password
	</div>
	<div class="float" style="width: 200px; padding-top: 3px;">
		<input type="password" name="password" value="password" size="20" class="field">
	</div>
		<br />
<input type="submit" name="submit" value="Log in" class="button">
<br />
<form>
</p>
<p>
<legend>Hint (it wont harm your score)</legend>
<?php
		if(isset($_POST['hint']) AND $_POST['hint'] >= "3" AND $hint === true){
		
		        echo ("<b><font color=orange>This is your last tip: Dont use SQL actions to change things and insert the same in the username field.</font></b>");	
		        $nummer = "1";	
		        $button = "No hint";	
		}elseif(isset($_POST['hint']) AND $_POST['hint'] == "2" AND $hint === true){	
		        echo ("<b><font color=orange>Use a SQL Injection</font></b><br><br>");	
		        $nummer = "3";	
		        $button = "Another hint";
		}else{	
		        echo ("");
		        $nummer = "2";	
		        $button = "Ask for an hint";
		}
	
		if($hint === true){
?>
		<form method="post">
			<input type="hidden" value="<?=$nummer?>" name="hint" />
			<input type="submit" name="tip" value="<?=$button?>" class="button">
		</form>
		</p>
		<?php
		}
	?>
<legend>By-pass (you'll get the pass but you have 5 more tries.)</legend>	
<?php
if (isset($_POST['gimme'])) {
 
		/* Update tries (because of failure) */
		$database	= mysql_query("SELECT `tries` FROM challenge WHERE `ip` = '".$ip."' LIMIT 1")
		or die(mysql_error());
					
			$foo	= mysql_fetch_assoc($database);
					
			$tries	=	$foo['tries'] + 5;
				mysql_query("UPDATE `challenge` SET `tries` = '".$tries."' WHERE `ip` = '".$ip."' AND `unique` = '".$unique_id."' LIMIT 1")
				or die(mysql_error());
						
	echo("<b><font color=red>Here is your username and password</font></b><br />
	Username: Securitylab<br />
	Password: bruteforcing<br />
	<small>But remember that your score in the highscore list is lower then people who passed this test</small><br />");
}
?>
<form method="post">
	<input type="submit" name="gimme" value="I'm not smart enough" class="button">
</form>	
<?php
	}
	
	require("./template/foot.inc.php");
?>