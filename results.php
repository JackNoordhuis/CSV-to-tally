<?php
session_start();
?>

<html>
	<style>
		h1 {
			text-align: center;
		}
		h2 {
			text-align: center;
		}
		.error {
			color: #ff7052;
		}
		.center {
			text-align: center;
		}
	</style>
</html>
<?
echo_header();

if(isset($_SESSION["entries"]) and isset($_SESSION["file-name"]) and isset($_SESSION["time"])) {
	echo_results($_SESSION["entries"], $_SESSION["file-name"], $_SESSION["time"]);
} else {
	echo "<h2 class='error'>Error while attempting to print results!</h2>";
}

session_abort();

function echo_header() {
	echo "<hr>";
	echo "<h1>CSV to tally converter</h1>";
	echo "<hr>";
}

function echo_results($entries, $file, $time) {
	echo "<br>";
	echo "<h2>Results</h2>";
	echo "<hr>";
	echo "<p class='center'>";
	echo "Tallied {$entries} entries in {$time} seconds!";
	echo "<br>";
	echo "Results written to /results/{$file}.txt";
	echo "</p>";
	echo "<hr>";
}