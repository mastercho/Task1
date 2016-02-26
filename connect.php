<?php
$db = parse_ini_file(__DIR__ . '/config.ini', true);

$myConnection = mysql_connect($db['host'], $db['user'], $db['pass']);
mysql_select_db($db['name'])  or die ("Could not connect to sql");


?>