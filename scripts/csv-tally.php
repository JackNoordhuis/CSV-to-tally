<?php
session_start();
include "../config.php";
$start = microtime(true);
$entries =  explode("\n", file_get_contents("../{$config["csv-file"]}"));
$filename = getFilename();
writeResults("../results/{$filename}.txt", str_replace("\"", "", parseResults(parseTitles($entries), tally($entries))));
$time = round(microtime(true) - $start, 3);
$_SESSION["entries"] = (int)count($entries) - 1;
$_SESSION["file-name"] = $filename;
$_SESSION["time"] = $time;

header("Location: ../results.php");


function parseTitles(array $entries) {
	$titles = [];
	foreach($entries as $entry) {
		$data = explode(",", $entry);
		$i = 0;
		foreach($data as $keys) {
			$titles[$i] = $keys;
			$i++;
		}
	}
	return $titles;
}

function tally(array $entries) {
	$tally = [];
	foreach($entries as $entry) {
		$data = explode(",", $entry);
		$count = count($data);
		for($i = 0; $i <= $count; $i++) {
			$key = str_replace([" ", "-"], "", strtolower($data[$i]));
			if(isset($tally[$i][$key])) {
				$tally[$i][$key]++;
			} else {
				$tally[$i][$key] = 1;
			}
		}
	}
	return $tally;
}

function parseResults(array $titles, array $tally) {
	$string = "";
	$count = count($titles);
	for($i = 0; $i <= $count; $i++) {
		$string .= "\n" . $titles[$i] . ":\n";
		foreach($tally[$i] as $who => $votes) {
			$string.= "	{$who}: {$votes}\n";
		}
	}
	return $string;
}

function getFilename() {
	return date("d-m-0 h:i:s A T", time());
}

function writeResults($path, $results) {
	if(!is_dir("../results")) {
		@mkdir("../results");
	}
	$file = fopen($path, "w");
	fwrite($file, $results);
	fclose($file);
}