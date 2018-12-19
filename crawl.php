<?php
ini_set('memory_limit','1028M');

$json = file_get_contents("founders-online-metadata.json");
$data = json_decode($json, TRUE);

foreach ($data as $entry) {
	if (in_array("Washington, George", $entry["authors"]) || in_array("Washington, George", $entry["recipients"])) {	
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
		echo "\n\n";
	}
}