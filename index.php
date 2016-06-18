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
		.link
		{
			border: solid 2px #aaa;
			border-radius: 3x;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			background-color: #00ba99;
			color: #000;
			text-decoration: none;
			font-weight: bold;
			margin: 10px 3px 10px 3px;
			padding: 3px;
			display: inline-block;
		}
		.link:hover {
			background-color: #00a6ba;
		}
		.center {
			text-align: center;
		}
	</style>
</html>
<?
echo_header();

if(config_exists()) {
	echo "<h2 class='error'>Couldn't find a config file!</h2>";
	generate_config();

} else {
	echo "<h2>Make sure you edit the config file before starting or you may encounter errors</h2>";
	echo "<p class='center'><a href='scripts/csv-tally.php' class='link'>Click to start!</a></p>";
}

function echo_header() {
	echo "<hr>";
	echo "<h1>CSV to tally converter</h1>";
	echo "<hr>";
}

function config_exists() {
	return !file_exists("config.php");
}

function generate_config() {
	echo "<hr>";
	echo "<h2>Generating config....</h2>";
	echo "<p class='center'>";
	$start = microtime(true);
	echo "Creating file... <br>";
	$file = fopen("config.php", "w");
	echo "Writing to file... <br>";
	fwrite($file, "<?php\n");
	fwrite($file, "// edit this file to make sure everything works\n");
	fwrite($file, "return [\n");
	fwrite($file, "	// include the csv extension plz\n");
	fwrite($file, "	\"csv-file\" => \"Blocky Awards Voting Ballot (Round 1).csv\"\n");
	fwrite($file, "];\n");
	fclose($file);
	echo "Generated config in " . round(microtime(true) - $start, 6) . " seconds!";
	echo "</p>";
	echo "<hr>";
	echo "<br>";
	echo "<h2>Config file generated! Edit the config and refresh the page to start tallying!</h2>";
}
?>
