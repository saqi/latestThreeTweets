# latestThreeTweets
Display the three latest tweets from any Twitter user (Quincy Larson (ossia) is used in my code) using the Twitter API.

Change the username by changing the $getfield variable on line 25 (twitter.php) and replace ossia with the desired Twitter username For example to see my latest tweets (my username being saqalain) the line of code would be: $getfield = '?screen_name=saqalain&count=3';

Similarly the number of tweets to display can be changed by simply changing the number 3 at the end to the desired amount.

Make sure all:

oauth_access_token oauth_access_token_secret consumer_key consumer_secret

variables are filled in and are your own.

If you come across SSL certification problems, make sure you have curl downloaded and set up in your php.ini file: http://stackoverflow.com/a/35051707/1724426
