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
$shortestArah = -1;
$i = 0;
// loop through words to find the closest
foreach ($queryArrayArah as $wordArah) {
	$i = $i + 1;
    // calculate the distance between the input word,
    // and the current word
	$levArah = levenshtein($kataArah, $wordArah);
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
    if ($levArah == 0) {

        // closest word is this one (exact match)
        $closestArah = $wordArah;
        $shortestArah = 0;

        // break out of the loop; we've found an exact match
        break;
    }

    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($levArah <= $shortestArah || $shortestArah < 0) {
        // set the closest match, and shortest distance
        $closestArah  = $wordArah;
        $shortestArah = $levArah;
    }
}

//echo "Input word: $input<br>";
if ($shortestArah == 0) {
    //echo "Exact match found: $closest in data[$i]\n";
	$boolKa = true;
} else {
	$countArah = strlen ($closestArah);
	//echo "count: ".$count;
	$precentageArah = 30/100 * $countArah;
	//echo "precentage: ".$precentage;
	//echo "<br>shortest: ".$shortest;
	if ($shortestArah >$precentageArah){
		//echo "<br>anda salah keyword ";
		$boolKa = false;
	}
	else {
		$boolKa = true;
		//echo "<br>mungkin yang anda maksud ialah: ".$closest;
	}
    //echo "Did you mean: $closest?\n";
}

?>