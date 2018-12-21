<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

ini_set('memory_limit','1028M');

$json = file_get_contents("founders-online-metadata.json");
$data = json_decode($json, TRUE);

$mysqli = new mysqli("127.0.0.1", "root", "root", "mv_dev");

if ($mysqli->connect_errno) {
	printf("Connection failed: %s\n", $mysqli->connect_error);
	exit();
}

$sql = "SELECT record FROM mv_papers";
$result = $mysqli->query($sql);

$existing = [];
foreach ($result as $record){
	$existing[] = $record["record"];
}


foreach ($data as $entry) {
	if (in_array("Washington, George", $entry["authors"]) || in_array("Washington, George", $entry["recipients"])) {
		if (!in_array(basename($entry["permalink"]), $existing)) {

			echo $entry["title"]."\n";
			echo $entry["project"]."\n";
			echo implode($entry["authors"],"; ")."\n";
			echo implode($entry["recipients"],"; ")."\n";
			echo $entry["date-from"]."\n";
			echo $entry["date-to"]."\n";
			echo $entry["permalink"]."\n";
			echo str_replace("documents","API/docdata",$entry["permalink"])."\n"; //API URL
			echo $entry["project"]."\n";
			echo basename($entry["permalink"])."\n"; //ID number
			if (in_array("Washington, George", $entry["authors"])){
				$to_from = "from";
				echo "Author\n";
			}
			if (in_array("Washington, George", $entry["recipients"])){
				$to_from = "to";
				echo "Recipient\n";
			}
			$letter_json = file_get_contents(str_replace("documents","API/docdata",$entry["permalink"]));
			$letter = json_decode($letter_json, TRUE);
			echo $letter["content"]; 
					
			echo "\n\n";
			
			$mysqli->query("INSERT INTO `mv_papers`(`record`, `title`, `to_from`, `project`, `founders_url`, `date_from`, `date_to`, `authors`, `recipients`, `content`) 
			VALUES (
				'".basename($entry["permalink"])."', 
				'".addslashes($entry["title"])."', 
				'".$to_from."', 
				'".addslashes($entry["project"])."', 
				'".$entry["permalink"]."',
				'".$entry["date-from"]."',
				'".$entry["date-to"]."',
				'".json_encode($entry["authors"])."',
				'".json_encode($entry["recipients"])."',
				'".addslashes($letter["content"])."'
				
			) 
			ON DUPLICATE KEY UPDATE 
				title = '".addslashes($entry["title"])."',
				to_from = '".$to_from."', 
				project = '".addslashes($entry["project"])."', 
				founders_url = '".$entry["permalink"]."',
				date_from = '".$entry["date-from"]."',
				date_to = '".$entry["date-to"]."',
				authors = '".json_encode($entry["authors"])."',
				recipients = '".json_encode($entry["recipients"])."'
			");
			sleep(300);
		} else {
			echo "Already recorded: ".basename($entry["permalink"])."\n";
		}
						
	}
}