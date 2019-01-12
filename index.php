<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	ini_set('memory_limit','1028M');
	
	$mysqli = new mysqli("127.0.0.1", "root", "root", "mv_dev");
	
	if ($mysqli->connect_errno) {
		printf("Connection failed: %s\n", $mysqli->connect_error);
		exit();
	}	

	$sql = "SELECT record, authors, recipients FROM mv_papers";
	$result = $mysqli->query($sql);
	
	$sql = "TRUNCATE TABLE mv_papers_index;";
	$truncate = $mysqli->query($sql);
	
	foreach ($result as $letter){
		
		$authors = json_decode($letter["authors"], TRUE);
		foreach ($authors as $author) {
			echo $author."\n";
			$sql = "INSERT INTO mv_papers_index (letter, person, direction)
			VALUES ('".$letter["record"]."', '".addslashes($author)."', 'author')";
			$insert = $mysqli->query($sql);
		}

		$recipients = json_decode($letter["recipients"], TRUE);
		foreach ($recipients as $recipient) {
			echo $recipient."\n";
			$sql = "INSERT INTO mv_papers_index (letter, person, direction)
			VALUES ('".$letter["record"]."', '".addslashes($recipient)."', 'recipient')";
			$insert = $mysqli->query($sql);
		}
		
		echo "\n\n";
	}
	
?>