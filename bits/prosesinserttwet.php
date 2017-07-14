<?php
	include "dbtweet/koneksi.php";



	$url =$_POST["Picture"];
	$image = file_get_contents($url);
	$poturl = substr($url,28);

	$urllocal ='C:\xampp\htdocs\bsts_murni\images\\'.$poturl;
	

	file_put_contents($urllocal, $image); 


	$query = mysql_query("INSERT INTO tweetreal(id_str,fromuser,status_url,text_raw,picture_url,time_raw,time_adj,datestamp,time,day_raw,daystamp,image_location,imagestamp,created_at,geo_coordinates,tag_year,tag_month,user_lang,in_reply_to_user_id_str,in_reply_to_screen_name,from_user_id_str,in_reply_to_status_id_str,source,profile_image_url,user_followers_count,user_friends_count,entities_str) VALUES ('".$_POST["id"]."','".$_POST["From"]."','".$_POST["Status"]."','".$_POST["Text"]."','".$_POST["Picture"]."','".$_POST["Time"]."','".$_POST["Adj"]."','".$_POST["Datestamp"]."','".$_POST["Timestamp"]."','".$_POST["Day"]."','".$_POST["Daystamp"]."','localhost/bsts_murni/images/$poturl','".$_POST["Imagestamp"]."','".$_POST["Created"]."','".$_POST["Geo"]."','".$_POST["Year"]."','".$_POST["Month"]."','".$_POST["Lang"]."','".$_POST["ru"]."','".$_POST["rs"]."','".$_POST["fu"]."','".$_POST["rts"]."','".$_POST["s"]."','".$_POST["Profile"]."','".$_POST["Followers"]."','".$_POST["Friends"]."','".$_POST["Entities"]."')");

	if ($query)
	{ 	
		header("locati