<?php

########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
$google_client_id 		= '634207389936-9h9mm0kucqftftlv3v5h8s7rnfalbjn4.apps.googleusercontent.com';
$google_client_secret 	= 'HYJhyOnaOTW7zOiiUQQK-32A';
$google_redirect_url 	= 'http://localhost/STAGE/portal_git/gertjan/loginscreen.php'; //path to your script
$google_developer_key 	= 'AIzaSyDVS7j1XMNIwf6U7tDJj1OJ9Ktx9q7hKGM';

########## MySql details (Replace with yours) #############
$db_username = "root"; //Database Username
$db_password = ""; //Database Password
$hostname = "localhost"; //Mysql Hostname
$db_name = 'db_portaal'; //Database Name
###################################################################

//include google api files
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';



$gClient = new Google_Client();
$gClient->setApplicationName('Login to WAW-portal');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) 
{
  unset($_SESSION['token']);
  $gClient->revokeToken();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to <pageusertable></pageusertable>
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	return;
}


if (isset($_SESSION['token'])) 
{ 
	$gClient->setAccessToken($_SESSION['token']);
}


if ($gClient->getAccessToken()) 
{
	  //For logged in user, get details from google using access token
	  $user 				= $google_oauthV2->userinfo->get();
	  $user_id 				= $user['id'];
	  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
	  $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
	  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
	  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
	  $_SESSION['token'] 	= $gClient->getAccessToken();
}
else 
{
	//For Guest user, get google login url
	$authUrl = $gClient->createAuthUrl();
}

if(!isset($authUrl))
 // user logged in 
{ 
   /* connect to database using mysqli */
	$mysqli = new mysqli($hostname, $db_username, $db_password, $db_name);
	
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	
	//compare user id in our database
	$user_exist = $mysqli->query("SELECT COUNT(google_id) as usercount FROM tbl_googleuser WHERE google_id=$user_id")->fetch_object()->usercount; 
	if($user_exist)
	{
		$_SESSION['userName']=$user_name;
		
		$_SESSION['avatar']= $profile_image_url;
		$_SESSION['userID']= $user_id;

		

		$sql = "SELECT userType_ID FROM `tbl_googleuser` WHERE google_id='$user_id';";

		$result=$mysqli->query($sql);
		$resultUsertype=mysqli_fetch_array($result);
		$_SESSION['userType']=$resultUsertype['userType_ID'];

		
		//echo 'Welcome back '.$user_name.'!';
	}else{ 
		//user is new
		
		$mysqli->query("INSERT INTO tbl_googleuser (google_id, google_name, google_email, google_link, google_picture_link) 
		VALUES ($user_id, '$user_name','$email','$profile_url','$profile_image_url')");
		$_SESSION['userName']=$user_name;
		$_SESSION['avatar']= $profile_image_url;
		$_SESSION['userID']= $user_id;

		


		

		$sql = "SELECT userType_ID FROM `tbl_googleuser` WHERE google_id='$user_id';";

		$result=$mysqli->query($sql);
		$resultUsertype=mysqli_fetch_array($result);
		$_SESSION['userType']=$resultUsertype['userType_ID'];
		}

	
	
	
}
?>