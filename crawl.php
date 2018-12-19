<?php
ini_set('memory_limit','1028M');

$json = file_get_contents("founders-online-metadata.json");
$data = json_decode($json, TRUE);

foreach ($data as $entry) {
	if (in_array("Washington, George", $entry["authors"])) {	
		echo $entry["title"]." - ";
		echo $entry["project"];
		echo "\n\n";
	}
}