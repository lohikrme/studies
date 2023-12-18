<?php
	
// store here total vote count
$totalVoteCount = 0;

// open results file
$candidateVote = (int) $_GET["ehdokas"];
if (!preg_match("/^[1-5]$/", $candidateVote)) {
	echo "Virheellinen ehdokasnumero. Hyväksytään ainoastaan kokonaisluku välillä 1-5.";
	exit();
}
	
	
$resultsFile = fopen("tulokset.txt", "r");

if (!$resultsFile) {
	die("Unable to open 'tulokset.txt' file");	
}

// create an array 'fileData', and store all data of file into it
// store data as arrays, left side candidateNumber right side votecount
$fileData = [];
while (!feof($resultsFile)) {
	$row = explode("|", fgets($resultsFile));
	if ($row[0] == $candidateVote) {
		$row[1] = (int) $row[1] + 1;
		$fileData[] = $row;
	}
	else {
		$fileData[] = $row;
	}
}

// now we are at the end of file, so we close it, to be able to open it again from the beginning
fclose($resultsFile);

$resultsFile = fopen("tulokset.txt", "w");

$rowToString = "";
	
foreach ($fileData as $row) {
	$totalVoteCount += $row[1];
	$rowToString = implode("|", $row);
	fwrite($resultsFile, $rowToString . "\n");	
}

fclose($resultsFile);

echo "Ääniä annettu yhteensä: $totalVoteCount kappaletta.";
	
?>