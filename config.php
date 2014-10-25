<?php
########## app ID and app SECRET (Replace with yours) #############
$appId = '270994516358057'; //Facebook App ID
$appSecret = 'c963b84b559980ca2ed187a6b2ba2595'; // Facebook App Secret
$return_url = 'http://localhost/STAGE/portal_git/gertjan/index.php';  //path to script folder
$fbPermissions = 'publish_actions,email'; // more permissions : https://developers.facebook.com/docs/authentication/permissions/

########## MySql details (Replace with yours) #############
$db_username = "root"; //Database Username
$db_password = ""; //Database Password
$hostname = "localhost"; //Mysql Hostname
$db_name = 'db_portaal'; //Database Name
###################################################################

define('CONSUMER_KEY', 'PtjlfQmCKhVogu9yZCy1YMEDw');
define('CONSUMER_SECRET', 'Ca2rXk3Idcve4mmueFia47bW4e562wBkAiAYfgYnpEJSLQwHq6');
define('OAUTH_CALLBACK', 'http://127.0.0.1/STAGE/portal_git/gertjan/index.php');

?>