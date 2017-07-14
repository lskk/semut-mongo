<?php
define ( 'DB_HOST', "localhost" );
define ( 'DB_USERNAME', "root" );
define ( 'DB_PASSWORD', "Vicky12345" );
define ( 'DB_NAME', "smarttransportasi" );
//define ( 'GUSER', 'support@thewalistudio.com' ); // GMail username
//define ( 'GPWD', 'walim3r0k3t97' ); // GMail password
class nlp {
	public $identifier;
	private $result_temp = "";
	private $penampungKt = "";
	private $counter = 0;
	private $iterationTemp;
	public function __construct() {
		// connect ke database
		$this->identifier = mysql_connect ( DB_HOST, DB_USERNAME, DB_PASSWORD );
		mysql_select_db ( DB_NAME, $this->identifier );
		if (! $this->identifier) {
			echo mysql_error ();
		}
	}
	public function testQuery($queryPlace,$queryCondition,$dateStamp,$timeStamp,$idStr){//query untuk insert ringkasan tabel
		$query = "insert into ringkas (id_str,tempat, kondisi,timestamp,daystamp,datestamp) values($idStr,'$queryPlace', '$queryCondition','$timeStamp','$dayStamp','$dateStamp')";
		mysql_query ( $query );
	}
	public function insertRingkasanTest($queryPlaced,$queryCondition,$timeStamp,$idStr){
		
		//$b = "";
		$boolean = false;
		$tampung2 = null;
		if (strpos($queryPlaced,'`') !== false){
				$queryPlaced = str_replace("`"," ",$queryPlaced);
				//continue;
		}
		//if (strpos($queryCondition,',') !== false){
				//$tampung2 = trim ($queryCondition, ",");
		$queryCondition = explode(",",$queryCondition);
				//$boolean = true;

		//}
		 
		 $idKataTempat = $this -> selectIdKataTempat ($queryPlaced);
		 $penampung=mysql_fetch_array($idKataTempat); 
         $test = $penampung['idtempat'];
		 if (!empty($test)){
				$resultsLongLat = $this -> selectLonglatKataTempat ($test);
				$rowcount=mysql_num_rows($resultsLongLat);
				$nomor = 0;
				//echo "<br>queryPlace: ".$queryPlaced."<br>idkatatempatdetail: ".$test."<br>jumlah longlat: ".$rowcount."<br>queryCondition: ".$queryCondition[0]."<br>idstr:" .$idStr;
				
				$resultDatabase = "<br>queryPlace: ".$queryPlaced."<br>idkatatempatdetail: ".$test."<br>jumlah longlat: ".$rowcount."<br>queryCondition: ".$queryCondition[0]."<br>";
				//echo $resultDatabase;
				
				if ($rowcount > 0){
						$nomor = 0;
						while ($data = mysql_fetch_array($resultsLongLat)) {
								$nomor++; 
								//echo "nomor: ".$nomor."<br>";
								$longlat = $data['longlat'];
								$resultDatabase .= "<br>longlat ke-".$nomor.": ".$data['longlat'];
								//$queryplaceds = $queryplaced."_".$nomor;
								$arr = array($queryPlaced,$nomor);
								$queryPlaceds= implode("_",$arr);
								//echo "queryplaced: ".$queryPlaceds."<br>";
								//echo "timestamp: ".$timeStamp."<br>";
								$query = "insert into ringkasanfix (timestamp,point, lokasi,twitter) values('$timeStamp','$longlat','$queryPlaceds','$queryCondition[0]')";
								mysql_query ( $query )or die( mysql_error());
						}
				}
				else {
				
				//echo "longlat: belum ada di database longitude latitude, untuk Jalan ".$queryPlaced."<br>";
				$resultDatabase .= "longlat: belum ada di database longitude latitude, untuk Jalan ".$queryPlaced."<br>";
				}
				//echo "timeStamp: ".$timeStamp."<br>idStr: ".$idStr."<br><br><br>";
				$resultDatabase .="timeStamp: ".$timeStamp."<br>idStr: ".$idStr."<br><br><br>";
		}
		else {
		
			$resultDatabase = "id kata tempat tidak ada";
		
		}
		return $resultDatabase;
		// echo $test."<br>";
		// $sqlIdTempat = $this -> selectLonglatKataTempat ($test);
		//$iterasi = 1;
		/*while($row = mysql_fetch_array($sqlIdtempat))
		{
						$longlat = $row['longlat'];
						echo $iterasi." longlat: ".$longlat."<br>";
						$iterasi++;
						//mysql_query("UPDATE `outbox_repository` SET `status` = 1 WHERE `ID` = ".$id.";")or die(mysql_error());;		
		}*/
		/*echo "<br>queryPlace: ".$queryPlaced."<br>";
		echo "idkatatempatdetail: ".$test."<br>";
		echo "queryCondition: ".$queryCondition[0]."<br>";
		//echo "dateStamp: ".$dateStamp."<br>";
		echo "timeStamp: ".$timeStamp."<br>";
		echo "idStr: ".$idStr."<br><br><br>";*/
		//$query = "insert into ringkasanfix (timestamp,point, lokasi,twitter) values('$timeStamp', //'$queryPlaced','$queryCondition[0]')";
		//mysql_query ( $query );
		/*$query = "insert into ringkasandua (id_str,timestamp, id_kata_tempat_detail,kondisi,frm) values('$idStr','$timeStamp', $idKataTempat,'$queryCondition','twitter')";
		mysql_query ( $query );*/
	
	}
		
	
	public function selectIdKataTempat ($kataTempat){
		$query = "SELECT idtempat FROM kata_tempat where kata_tempat = '$kataTempat'";
		$results = mysql_query ( $query, $this->identifier) or die( mysql_error());
		return $results;	
	}
	
	public function selectLonglatKataTempat ($idTempat){
		$query = "SELECT longlat FROM kata_tempat_detail where id_kata_tempat = $idTempat";
		$results = mysql_query ($query, $this->identifier );
		return $results;	
	}
	public function testQueryNonGrammar($kalimat,$dateStamp,$timeStamp,$dayStamp,$idStr){//query untuk insert non-grammar
		$query = "insert into non_grammar (id_str,kalimat,timestamp,daystamp,datestamp) values($idStr,'$kalimat','$timeStamp','$dayStamp','$dateStamp')";
		mysql_query ( $query );
	}
	
	//public function nlpProcessing ($idKataTempat,$kalimatAwal,$string,$dateStamp,$timeStamp,$dayStamp,$idStr){
	public function nlpProcessing ($kalimatAwal,$string,$timeStamp,$idStr){
		//public function nlpProcessing ($kalimatAwal,$timeStamp,$idStr){
		$stack = array();
		//$string= "Cicaheum/KT Arah/KA suci/KT macet/KK";
		//echo "string adalah : ".$string."<br>";
		$token = explode(" ",$string);
		//echo "mantap: ".count($token)."<br>";
		for($i = 0; $i < count($token); $i++){
				  //echo "token [".$i."] =".strtolower($token[$i])."<br>";
				  $a[$i] = $token[$i];
		}
		for($j =0; $j < count($token); $j++){
			$tokens = explode("/",$a[$j]);
			$words[$j] = $tokens[0];
			$tag[$j]= $tokens[1];
		}
		//var_dump($tag);
		$l=0;
		$terminal = array ();
		$nonGrammar = array ();
		$tampung = array ();
		while ($l<count($token)){
			array_push($stack,$tag[$l]);
			$test = implode(" ",$stack);
			if ($test == "KT" || $test == "A KT" || $test == "B KT")
			{
							$val=array_pop($stack);
							array_push($stack,"A");
							$terminal[$l] = $words[$l]." /A";
			}
			else if ($test == "KK" ||$test == "A KK" || $test == "B KK")
			{
							$val=array_pop($stack);
							array_push($stack,"B");
							 $terminal[$l] = $words[$l]." /B";
			}
			else if ($test == "A KA KT")
			{
						    $val1 = array_pop($stack);
							$val2 = array_pop($stack);
							$val3 = array_pop($stack);
							array_push($stack,"A");
							$terminal[$l] = $words[$l-2]." ".$words[$l-1]." ".$words[$l]." /A";
							unset($terminal[$l-2]);
							//terminal.Add(tokenWord[j - 2] + " " + tokenWord[j - 1] + " " + tokenWord[j] + "/A");
							//terminal.RemoveAt(j - 2);
			}
			else if ($test == "NEG KK" || $test == "A NEG KK")
			{
							array_pop($stack);
							array_pop($stack);
							array_push($stack,"B");
							$terminal[$l] = $words[$l]." /B";
							//DataSet ds_kkk = new DataAccess().SelectKelasKataKuncibyWord(tokenWord[j]);
							//tokenWord[j] = ds_kkk.Tables[0].Rows[0][2].ToString();
							//terminal.Add(tokenWord[j] + "/B");
			}
			else {
							//$nonGrammar[$l] =  $token[$l];
							$nonGrammars = $kalimatAwal;
			}
			$l++;
		}//echo "var dump:".$terminal;
		$test = count($terminal);
		//echo "test terminal [".$l."]: ";
		//var_dump($terminal);
		//echo "<br>tes non grammar[".$l."]: ";
		//var_dump ($nonGrammar);
		for($z=0; $z < count($terminal);$z++){
			if (!empty($terminal[$z])){
			//echo "<br>terminal ke[".$z."] =".$terminal[$z];
				$tokensTerminal = explode("/",$terminal[$z]);
				$wordsTerminal = $tokensTerminal[0];
				$tag= $tokensTerminal[1];
				/*echo "<br>wordsTerminal: ".$wordsTerminal;
				echo " || tag: ".$tag;
				echo " || countTerminal: ".count($terminal);
				echo " || idTweet: ".$idStr."<br>";*/
				if ($tag == "A"){
					$queryPlace = $wordsTerminal;
					//echo "Query Place : ".$queryPlace;
				}
				else if ($tag == "B"){
					$queryCondition = $wordsTerminal;
					//echo "<br>Query Condition: ".$queryCondition;
				}
			}
		}
		//$this->testQuery("test1","test2");
		if (!empty($queryPlace) && !empty($queryCondition) ){
			//echo "dua duanya ada";
			//$this->testQuery($queryPlace,$queryCondition,$dateStamp,$timeStamp,$dayStamp,$idStr);
			$returnInsert = $this->insertRingkasanTest($queryPlace,$queryCondition,$timeStamp,$idStr);
			return $returnInsert;								
		}
		else {
			
			$returnInsert = "Bukan Termasuk Kriteria Susunan Kata";
			return $returnInsert;
		
		}
		if (!empty($nonGrammars)){
			//$kalimatNonGrammar = implode(" ",$nonGrammar);
			//$this->testQueryNonGrammar($kalimatNonGrammar,$dateStamp,$timeStamp,$dayStamp,$idStr);
			//echo "<br>kalimat Non Grammars: ".$nonGrammars;  
		}
	}
	public function selectTweet(){
		$query = "SELECT * from tweetreal";
		$results = mysql_query ( $query, $this->identifier );
		$tweetReal = array ();
		while ( $row = mysql_fetch_array ( $results ) ) {
			$tweetReal [] = $row;
		}
		return $tweetReal;
	}
	public function selectPostag(){
	
	}
	public function stopword ($textRaw,$remove){
					$tweet = $textRaw;
					$arrayTweet = explode(' ', $tweet);
					$arrayCatch = array();
					for($i = 0; $i < count($arrayTweet); $i++){
						$safe = true;
						for($j = 0; $j < count($remove); $j++){
							if(strpos($arrayTweet[$i], $remove[$j]) !== false or is_numeric($arrayTweet[$i])){
								$safe = false;
								break;
							}
						}
						if($safe){
							array_push($arrayCatch, $arrayTweet[$i]);	
						}
					}
					$stt= implode(' ', $arrayCatch);
					$st =strtolower($stt);

					$hapusword = explode(" ",trim(preg_replace('/\s\s+/', ' ', $st)));

					$tampil=" ";
					$buang="";
						for($i = 0; $i < count($hapusword); $i++){
							$result = mysql_query("SELECT stopword from stop_word where stopword ='$hapusword[$i]'");
							$num_rows = mysql_num_rows($result);
							if($num_rows < 1){
								$tampil = $tampil.$hapusword[$i]." ";			
							}
							else{
								$buang .= $hapusword[$i]." | ";
							}			
						}
					return $tampil;
	}
	public function isKataTempat($kata,$iteration){
		$queryArrayTempat = $this->selectTokenKataTempatCompare();
		include "levenshtein/levenshT.php";
		//$iterationTemp = null;
			if ($boolKt){
				 if ($this->penampungKt == ""  ){
						$this->penampungKt = $kata."/KT ";	
						//if(empty($this->iterationTemp)){
						//if (counter)
							$this->result_temp .= $this->penampungKt;
						//}
						$this->iterationTemp = $iteration;
				}
				else if ($this->iterationTemp != $iteration){
						
							//$this->result_temp .= $this->penampungKt;
							$this->penampungKt = "";
							$this->penampungKt = $kata."/KT ";
							$this->iterationTemp = $iteration;
							//$this->penampungKt = null;
				}
				
				//else if ($this->penampungKt != "" && $this->iterationTemp == $iteration ){
				else if ($this->penampungKt != "" && $this->iterationTemp == $iteration ){
						//$iterationTemp =  $iteration;
						$tokens = explode("/",$this->penampungKt);
						$words = $tokens[0];
						$tag = $tokens[1];
						$this->penampungKt =$words."`".$kata."/KT ";
						$this->result_temp .=	$this->penampungKt;
				}
				//$this->result_temp .=	$this->penampungKt;
				$this->counter = $this->counter+1;
				echo "<td></td><td><img src='img/check.jpg' width='40' height='40'>".$iteration."</td><td>".$this->iterationTemp."</td><td></td><td></td>";		
			}
			else{
				
				if (empty($this->result_temp)){
					$this->result_temp .=	$this->penampungKt;
				}
				
				//$this->result_temp .=	$this->penampungKt;
				//$this->penampungKt = "";
				$this->counter = 0;
				$this->penampungKt = NULL;
				$this->isKataArah ($kata);
			}
	}
	
	public function isKataArah($kataArah){
		$queryArrayArah = $this->selectTokenKataArahCompare();
		include "levenshtein/levenshA.php";
			if ($boolKa){
			
				echo "<td><img src='img/check.jpg' width='40' height='40'></td><td></td><td></td><td></td><td></td>";
				$this->result_temp .= $kataArah."/KA". " ";
			}
			else{
				$this->isKataKondisi ($kataArah)