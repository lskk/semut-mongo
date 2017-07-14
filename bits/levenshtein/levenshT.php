<?php
/*
echo levenshtein("Hello World","elo World");
echo "<br>";
//insert,replace,delete
echo levenshtein("Dago","Dgo",10,20,30);
echo "<br>";
echo levenshtein("Dago","agss",10,0,0);
*/

// input misspelled word
//$input = 'oren';

// array of words to check against
//$words  = array('apple','pineapple','banana','orange','radish','carrot','pea','dago','potato');

// no shortest distance found, yet
$shortest = -1;
$i = 0;
// loop through words to find the closest
foreach ($queryArrayTempat as $word) {
//var_dump ($word);
	$i = $i + 1;
    // calculate the distance between the input word,
    // and the current word
	$lev = levenshtein($kata, $word);
	//echo "lev: ".$lev. "</br>";
	/*
	$insert = levenshtein($input, $word,10,0,0);
	$replace = levenshtein($input, $word,0,10,0);
	$delete = levenshtein($input, $word,0,0,10);
    $total = levenshtein($input, $word,10,10,10);
	if ($total > 0){
		echo "kata anda terlalu jauh tjoy [$i]";
		echo "detail: </br>";
		echo "jumlah salah insert : ".$insert;
		echo "</br>jumlah yg keganti : ".$replace;
		echo "</br>jumlah yg kehapus : ".$delete."<br><br><br>";
	}
	*/
    // check for an exact match
    if ($lev == 0) {

        // closest word is this one (exact match)
        $closest = $word;
        $shortest = 0;

        // break out of the loop; we've found an exact match
        break;
    }

    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($lev <= $shortest || $shortest < 0) {
        // set the closest match, and shortest distance
        $closest  = $word;
        $shortest = $lev;
    }
}

//echo "Input word: $input<br>";
if ($shortest == 0) {
    //echo "Exact match found: $closest in data[$i]\n";
	$boolKt = true;
} else {
	$count = strlen ($closest);
	//echo "count: ".$count;
	$precentage = 30/100 * $count;
	//echo "precentage: ".$precentage;
	//echo "<br>shortest: ".$shortest;
	if ($shortest >$precentage){
		//echo "<br>anda salah keyword ";
		$boolKt = false;
	}
	else {
		$boolKt = true;
		//echo "<br>mungkin yang anda maksud ialah: ".$closest;
	}
    //echo "Did you mean: $closest?\n";
}

?>