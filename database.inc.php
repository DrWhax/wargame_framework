<?php
												
	/**		
	*  @author: 	DrWhax0			
	*  @version: 	0.1	
	*  @project: 	Challenge system with mysql					
	*  @website: 	Securitylab.ws				
	**/	
	
	/* Database
		CREATE TABLE `challenge` (
			`id` int(11) NOT NULL auto_increment,
			`unique` varchar(255) NOT NULL default '',
			`ip` varchar(255) NOT NULL default '',
			`level` varchar(255) NOT NULL default '1',
		UNIQUE KEY `id` (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;
	*/
	
	ob_start();
			
	$Db['host']		= "localhost";
	$Db['user']		= "foobar";
	$Db['pass']		= "password";
	$Db['name']		= "db_name";

	If(!mysql_connect($Db['host'], $Db['user'], $Db['pass']))
	{
		echo "The database is not online please come back later.";
		exit;
	}
	ElseIf(!mysql_select_db($Db['name']))
	{
		echo "The connection to the database failed please come back later.";
		exit;
	}
		
?>


