<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<?php 
// auth parameters
$api_key = urlencode('3OpoqoRy2kmmYHh44WTVO2Ijw'); // Consumer Key (API Key)
$api_secret = urlencode('gYApur5Lon4ZxnsdsUYqFCRNH4l5ACQZ7ZdPrny5lYfq8Jtbuv'); // Consumer Secret (API Secret)
$auth_url = 'https://api.twitter.com/oauth2/token'; 

// what we want?
$data_username = 'ossia'; // username
$data_count = 3; // number of tweets
$data_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

// get api access token
$api_credentials = base64_encode($api_key.':'.$api_secret);

$auth_headers = 'Authorization: Basic '.$api_credentials."\r\n".
                'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'."\r\n";

$auth_context = stream_context_create(
    array(
        'http' => array(
            'header' => $auth_headers,
            'method' => 'POST',
            'content'=> http_build_query(array('grant_type' => 'client_credentials', )),
        )
    )
);

$auth_response = json_decode(file_get_contents($auth_url, 0, $auth_context), true);
$auth_token = $auth_response['access_token'];

// get tweets
$data_context = stream_context_create( array( 'http' => array( 'header' => 'Authorization: Bearer '.$auth_token."\r\n", ) ) );

$data = json_decode(file_get_contents($data_url.'?count='.$data_count.'&screen_name='.urlencode($data_username), 0, $data_context), true);

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
<h2 class="text-center">The three latest tweets from <a href="<?php echo "https://twitter.com/".$data[0]['user']['screen_name']; ?>">@<?php echo $data[0]['user']['screen_name']; ?></a></h2>
</div>

<?php

// result - do what you want

foreach($data as $items)
    {
		echo "<div class='tweet row'><div class='col-sm-12'>";
        echo "<img src='".$items['user']['profile_image_url_https']."' /> @". $items['user']['screen_name']."<br />";
        echo "<span class='tweettext'>Tweet: ". $items['text']."</span><br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Time and Date of Tweet: ".$items['created_at']."<br /></div></div>";
    }

?>