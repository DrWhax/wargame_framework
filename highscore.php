<?php
	require("./template/head.inc.php");
	require("start.php");
?>
  <legend>2600nl > Highscore : Did you made it?</legend>

<p>
	<div class="float" style="width: 70px; padding-left:5px;">
		Place
	</div>	
	<div class="float" style="width: 320px; padding-left:5px;">
		Username
	</div>
	<div class="float" style="width: 80px; padding-left:5px;">
		Failures
	</div>
	
	<!-- Something goes wrong here. -->
	<?php
	$get = mysql_query("SELECT `id` , `username` , `tries` FROM `challenge` WHERE level = '7' ORDER BY `tries` ASC LIMIT 50") or die(mysql_error());
	
		$i = 1;
	while ($foo = mysql_fetch_assoc($get) AND $i <= 50) {
    
	?>
	<div class="highscore" style="width: 70px; padding-left:3px;">
		<?php echo $i; $i++; ?>
	</div>	
	<div class="highscore" style="width: 320px; padding-left:3px;">
		<?php echo $foo['username']; ?>
	</div>
	<div class="highscore" style="width: 80px; padding-left:3px;">
		<?php echo $foo['tries']; ?>
	</div>	
    <br />
	
	<?php	
	}
	
?>	
</p>
<?php
	require("./template/foot.inc.php");
?>
