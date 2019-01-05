<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	ini_set('memory_limit','1028M');
	
	$mysqli = new mysqli("127.0.0.1", "root", "root", "mv_dev");
	
	if ($mysqli->connect_errno) {
		printf("Connection failed: %s\n", $mysqli->connect_error);
		exit();
	}	

	$sql = "SELECT id, content FROM mv_papers";
	$result = $mysqli->query($sql);
	
	foreach ($result as $letter){
		echo $letter["id"].": ".str_word_count($letter["content"])."\n";
		$sql = "UPDATE mv_papers SET words=".str_word_count($letter["content"])." WHERE id=".$letter["id"];
		$update = $mysqli->query($sql);
	}
	
?>