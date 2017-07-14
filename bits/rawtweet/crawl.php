<html>
<head>
<!--<meta http-equiv="refresh" content="30" />!-->
</head>
<body>
<?php 
//require_once APPPATH."libraries/twitteroauth.php";
require_once('twitteroauth.php');
mysql_connect("localhost", "root", "") or die(mysql_error());;
mysql_select_db("smarttransportasi") or die(mysql_error());;
//$class = new TwitterOAuth();
		/*$Consumer ="VRk9Hz2v3JiQWgnaigrxBA";
		$Consumersecret = "1j4rTWoBSa3QfVyQFVlTHzcFXSBSYZ3Ppoqoa038nI";
		$Accesstoken ="313176210-EHOTjhTbTbLcTedprjryeCcVKkhqLXnGUXx0LMWP";
		$Accesstokensecret ="mLoIU3hMT6h0BMnAmedO2pzcSBg6pvc177H4iNXN5ZEDr";*/
		
		$Consumer ="B0iU5du9OBjuA8GyyPTC1QICn";
		$Consumersecret = "c4OmBFWuLgmHc55tDDetPoJ60dE83mOaQFD6iPFN5IyemOFTI7";
		$Accesstoken ="161162986-Tr2ldRgBkzL6J1LBiuwEZIX4QjpcLSqQHCxN80I5";
		$Accesstokensecret ="9IvoiVOsOL8vzvGcQCokuJ9sZVIklqcNAUCIb95mEfoEt";
		
		$twitter = new TwitterOAuth($Consumer,$Consumersecret,$Accesstoken,$Accesstokensecret);
		
		//$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=bandung%25macet&result_type=mixed&count=200');
		//$tweets = $twitter->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=infobdg&count=200');
	//	$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=%3Ainfobdg%20%23lalinbdg&result_type=mixed&count=200');
		$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=from%3Ainfobdg%20%23lalinbdg&result_type=mixed&count=200');
		//var_dump($tweets);
	if($tweets){
		foreach($tweets as $tweet){
			foreach($tweet as $t){
				if(!empty($t->user->screen_name)){
					$tweetDate=date('d/F/Y',strtotime($t->created_at));
					$t_id = mysql_real_escape_string($t->id_str);
					//$CI =& get_instance(); 
					//$cek_id = $CI->db->query("select count(id_str) as jum from tweetreal where id_str ='$t_id'");
					$cek_id = mysql_query("select  *from tweetreal where id_str ='$t_id' ")
					or die(mysql_error());
					 $jum_cek= mysql_num_rows($cek_id);
					
					//echo "jum cek :".$jum_cek;
					
					//$num_rows = mysql_num_rows($sqldata);
					//foreach ($cek_id->result_array() as $row) {
						//$jum_cek=$row['jum'];
					//}
					$datestamp = mysql_real_escape_string(date('d F Y',strtotime($t->created_at)));
					$timewstamp = mysql_real_escape_string(date('H:m',strtotime($t->created_at)));
					$daystamp = mysql_real_escape_string(date('D',strtotime($t->created_at)));
					$screname = mysql_real_escape_string($t->user->screen_name);
					$name = mysql_real_escape_string($t->user->name);
					//$profil = $t->profile_image_url;
					//$cek = str_replace("'", "''",addslashes($t->text));
					//$status = preg_replace('/[^\p{L}\p{N}\s]/u', '',$t->text));
					$status =mysql_real_escape_string($t->text);
					//echo "<script>alert (".$status.")</script>";
					//$status= str_replace("'", "''",addslashes($t->text));
					if($jum_cek < 1){
						$input = mysql_query("insert into tweetreal (id_str,fromuser,name_now,text_raw,datestamp,time,daystamp)values('$t_id','$screname','$name','$status','$datestamp','$timewstamp','$daystamp')")or die(mysql_error());
						//$input=$CI->db->query("insert into tweetreal (id_str,fromuser,name_now,text_raw,datestamp,time,daystamp) //values('$t_id','$screname','$name','$status','$datestamp','$timewstamp','$daystamp')");
						return;
					}
				}
			}
		}
	}
?>
</body>
</html>