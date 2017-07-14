<?php
define ( 'DB_HOST', "localhost" );
define ( 'DB_USERNAME', "root" );
define ( 'DB_PASSWORD', "Vicky12345" );
define ( 'DB_NAME', "smarttransportasi" );
//define ( 'GUSER', 'support@thewalistudio.com' ); // GMail username
//define ( 'GPWD', 'walim3r0k3t97' ); // GMail password
class functions {
	public $identifier;
	public function __construct() {
		// connect ke database
		$this->identifier = mysql_connect ( DB_HOST, DB_USERNAME, DB_PASSWORD );
		mysql_select_db ( DB_NAME, $this->identifier );
		if (! $this->identifier) {
			echo mysql_error ();
		}
		require_once('rawtweet/crawl.php');
	}
	public function selectTweet(){
		$query = "SELECT * from tweetreal";
		$results = mysql_query ($query, $this->identifier );
		$tweetReal = array ();
		while ( $row = mysql_fetch_array ( $results ) ) {
			$tweetReal [] = $row;
		}
		return $tweetReal;
	}
	public function select(){
		$query = "SELECT * from tweetreal order by id_str desc";
		$results = mysql_query ( $query, $this->identifier );
		return $results;
	}
}
?>