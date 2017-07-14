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
$shortestNegasi = -1;
$i = 0;
// loop through words to find the closest
foreach ($queryArrayNegasi as $wordNegasi) {
	$i = $i + 1;
    // calculate the distance between the input word,
    // and the current word
	$levNegasi = levenshtein($kataNegasi, $wordNegasi);
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
    if ($levNegasi == 0) {

        // closest word is this one (exact match)
        $closestNegasi = $wordNegasi;
        $shortestNegasi = 0;

        // break out of the loop; we've found an exact match
        break;
    }

    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($levNegasi <= $shortestNegasi || $shortestNegasi < 0) {
        // set the closest match, and shortest distance
        $closestNegasi  = $wordNegasi;
        $shortestNegasi = $levNegasi;
    }
}

//echo "Input word: $input<br>";
if ($shortestNegasi == 0) {
    //echo "Exact match found: $closest in data[$i]\n";
	$boolKn = true;
} else {
	$countNegasi = strlen ($closestNegasi);
	//echo "count: ".$count;
	$precentageNegasi = 30/100 * $countNegasi;
	//echo "precentage: ".$precentage;
	//echo "<br>shortest: ".$shortest;
	if ($shortestNegasi >$precentageNegasi){
		//echo "<br>anda salah keyword ";
		$boolKn = false;
	}
	else {
		$boolKn = true;
		//echo "<br>mungkin yang anda maksud ialah: ".$closest;
	}
    //echo "Did you mean: $closest?\n";
}

?>