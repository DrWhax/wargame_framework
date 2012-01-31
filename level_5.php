    <script language="JavaScript">
      <!--
      function checkpass(pass) {
       x=58
       x=x/2
       x--
       y=8
       y++
       p=x+y
        if (pass == p) {
          alert("You have the right password!");
        }
        else {
          alert("Please try again...");
        }
      }
      //-->
    </script>
<?php
if(isset($_POST['submit'])) {
	$pwachtwoord = htmlentities(addslashes($_POST['password']));
	$wachtwoord  = '37';
	if($wachtwoord == $pwachtwoord){
	 
		echo("<b><font color=green>You have passed this test. Let's go to the next level. </font><br />
		<a href=\"./level_6.php\" alt=\"Click me\" title=\"Click me\">Click here</a></b>");
			
	}
	else {
	 
		echo('<b><font color=red>Come on dude... try again...</font></b>');
						
	}
} Else {

?>
<form name="challenge" method="post">
	<div class="float" style="width: 100px;">
		Password:
	</div>
	<div class="float" style="width: 200px;">
		<input type="password" name="password">
	</div>
	<br />
  <input type="submit" value="Log in" name="submit" onclick="checkpass(challenge.password.value)">
</form>
 </p>
<?php
	}
	require("./template/foot.inc.php");
