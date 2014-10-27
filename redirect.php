<?php

session_start();
require('twitteroauth/twitteroauth.php');
require('config.php');


$connection = new TwitterOauth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];


//$user_info = $connection->get('account/verify_credentials');



switch($connection->http_code)
{
	case 200:

		$url =$connection->getAuthorizeURL($token);
		$_SESSION['userID'] = $token;
			/*	$utype = 1;
				$db = new Db();
				
				
				$user_exist = "SELECT COUNT(id) as usercount FROM tbl_twitteruser WHERE `id`= ''";
				$db->mysqli->query($user_exist); 
				if($user_exist)
				{

				}
				else
				{


					$sql = "INSERT INTO tbl_twitteruser 
						(oauth_uid, username, oauth_token, oauth_token_secret, userType_ID) 
						VALUES (
							'".$user_info->id."',
							'".$user_info->screen_name."',
							'".$_SESSION['oauth_token']."',
							'".$_SESSION['oauth_token_secret']."',
							'".$utype."'
							);";

						$db->mysqli->query($sql);*/
					
				


		 
		header('Location:' . $url);
		break;

	default:
		echo "Oops! Somthing went wrong! Check in the Twitter docs for this HTTP CODE" . $connection->http_code;
}

?>