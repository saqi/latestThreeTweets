<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "104978671-Xrwi5Npz2smQcEJ6p8l6cKgkmANiqGmVNJYpYf9D",
    'oauth_access_token_secret' => "RAsx7omHyFDGeFtsx0erZ9oBcEhP7fcFrK07QF53Os8SY",
    'consumer_key' => "3OpoqoRy2kmmYHh44WTVO2Ijw",
    'consumer_secret' => "gYApur5Lon4ZxnsdsUYqFCRNH4l5ACQZ7ZdPrny5lYfq8Jtbuv"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
 
$requestMethod = "GET";
 
$getfield = '?screen_name=ossia&count=3';
 
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);
?>

<style>
.header {
	background-color: #3498DB;
    color: white;
    padding: 20px;

}
.tweet {
	margin: 20px 10px 0px 10px;
	font-size: 18px;
	border: 2px #CCCCCC solid;
	padding: 5px;
}
a:visited {
    color: white;
}
</style>

<div class="header">
<h2 class="text-center">The three latest tweets from <a href="<?php echo "https://twitter.com/".$string[0]['user']['screen_name']; ?>">@<?php echo $string[0]['user']['screen_name']; ?></a></h2>
</div>

<?php

foreach($string as $items)
    {
		echo "<div class='tweet row'><div class='col-sm-12'>";
        echo "<img src='".$items['user']['profile_image_url_https']."' /> @". $items['user']['screen_name']."<br />";
        echo "<span class='tweettext'>Tweet: ". $items['text']."</span><br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Time and Date of Tweet: ".$items['created_at']."<br /></div></div>";
    }
			 
?>
