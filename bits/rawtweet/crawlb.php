<html>
<head>
<meta http-equiv="refresh" content="30" />
</head>
<body>
<?php 
//include_once"rawtweet/twitteroauth.php";
require_once "../twitteroauth.php";
include '../dbtweet/koneksi.php';

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
	
	if($tweets){
		foreach($tweets as $tweet){
			foreach($tweet as $t){
				if(!empty($t->user->screen_name)){
					$tweetDate=date('d/F/Y',strtotime($t->created_at));
					$t_id = $t->id_str;
					//$CI =& get_instance(); 
					$cek_id = mysql_query("select count(id_str) as jum from tweetreal where id_str ='$t_id'");
					while($data = mysql_fetch_array($cek_id))
				      {
				        $jum_cek=$data['jum'];
				       // echo $jum_cek;
				    }
			
					// foreach ($cek_id->result_array() as $row) {
					// 	$jum_cek=$row['jum'];
					// }
						
					$datestamp = date('d F Y',strtotime($t->created_at));
					$timewstamp = date('H:m',strtotime($t->created_at));
					$daystamp = date('D',strtotime($t->created_at));
					$screname = $t->user->screen_name;
					$name = $t->user->name;
					//$cek = str_replace("'", "''",addslashes($t->text));
					//$status = preg_replace('/[^\p{L}\p{N}\s]/u', '',$t->text));
					//$picture = $t->entities->media->media_url;
					$geo = $t->geo;
					$profil = $t->user->profile_image_url;
					$follower = $t->user->followers_count;
					$friend = $t->user->friends_count;
					$status =$t->text;
					//$status= str_replace("'", "''",addslashes($t->text));
	
					if($jum_cek < 1){
						$input=mysql_query("insert into tweetreal (id_str,fromuser,name_now,text_raw,datestamp,time,daystamp,geolocation,profile_image_url,followers,friends) values('$t_id','$screname','$name','$status','$datestamp','$timewstamp','$daystamp','$geo','$profil','$follower','$friend')");
						//$input=$CI->db->query("insert into tweetreal (id_str,fromuser,name_now,text_raw,datestamp,time,daystamp) values('$t_id','$screname','$name','$status','$datestamp','$timewstamp','$daystamp')");
					return;
					}
				}
			}
		}
	}
?>
</body>
</html>