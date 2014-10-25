<?php 
session_start(); 
include_once("config.php");
include_once('classes/Db.class.php');
include_once('classes/googleRegister_include.php'); 
if(isset($_SESSION['userID'])){
	header("location: index.php");
}

	require('twitteroauth/twitteroauth.php');
	require('config.php');



	if (isset($_SESSION['access_token']))
	{
			

			$access_token = $_SESSION['access_token'];
			

			$connection = new TwitterOauth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
			
			
			$content = $connection->get('account/verify_credentials');

			echo "<pre>",print_r($content, true),"</pre>";

			

	}
	
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>WAW-portal | Login</title>
	
	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	
	
	
</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">
<!-- test fb login -->
<?php
if(!isset($_SESSION['logged_in']))
{
    echo '<div id="results">';
    echo '<!-- results will be placed here -->';
    echo '</div>';
    
}
else
{
	echo 'Hi '. $_SESSION['user_name'].'! You are Logged in to facebook, <a href="">Log Out</a>.';
}
?>
<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
    FB.init({
        appId: '<?php echo $appId; ?>',
        cookie: true,xfbml: true,
        channelUrl: '<?php echo $return_url; ?>channel.php',
        oauth: true
        });
    };
(function() {
    var e = document.createElement('script');
    e.async = true;e.src = document.location.protocol +'//connect.facebook.net/en_US/all.js';
    document.getElementById('fb-root').appendChild(e);}());
function CallAfterLogin(){
    FB.login(function(response) {       
        if (response.status === "connected") 
        {
            LodingAnimate(); //Animate login
            FB.api('/me', function(data) {
                
              if(data.email == null)
              {
                    //Facbeook user email is empty, you can check something like this.
                    alert("You must allow us to access your email id!"); 
                    ResetAnimate();
              }else{
                    AjaxResponse();
                    window.location.assign("index.php");
              }
              
          });
         }
    },
    {scope:'<?php echo $fbPermissions; ?>'});
}
//functions
function AjaxResponse()
{
     //Load data from the server and place the returned HTML into the matched element using jQuery Load().
     $( "#results" ).load( "process_facebook.php" );
}
//Show loading Image
function LodingAnimate() 
{
    $("#LoginButton").hide(); //hide login button once user authorize the application
   
}
//Reset User button
function ResetAnimate() 
{
    $("#LoginButton").show(); //Show login button 
    $("#results").html(''); //reset element html
}
</script>
<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var baseurl = '';
</script>
<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="index.php" class="logo">
				<img src="assets/images/logo@2x.png" width="120" alt="" />
			</a>
			
			<p class="description">Dear user, log in to access the admin area!</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Please make sure that your <strong>Username / email</strong> and <strong>password</strong> are correct.</p>
			</div>
			
			<form method="post" role="form" id="form_login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="username" id="username" placeholder="Username or email" autocomplete="off" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-loginCustomPrimary">
						<i class="entypo-login"></i>
						Log In
					</button>
				</div>
				
				<div class="form-group">
					<br>
				</div>
				<div class="form-group">
					<em>- I don't have an account-</em>
				</div>
				<div class="form-group">
				
					<button  onclick="window.location.href='registerscreen.php'" type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left btn-loginCustom">
						Create an account<i class="entypo-user-add"></i>
						
						
					</button>
					
				</div>
				
				<!-- Implemented in v1.1.4 -->				<div class="form-group">
					<em>- Or log in using these -</em>
				</div>
				<div class="form-group">
				
					
					<a href="index.php" rel="nofollow" class="fblogin-button" onClick="javascript:CallAfterLogin();return false;">
						<button type="button"  onlogin="checkLoginState();" class="btn btn-default btn-lg btn-block btn-icon icon-left facebook-button">
						Login with Facebook
						<i class="entypo-facebook"></i>
					</button>
				</a>
					
					
				</div>

				<div class="form-group">
				
					
					<a href = 'redirect.php'><img src='img/LoginTwitter.png'></a>
					
					
				</div>
				
		
				<div class="form-group">
				
				
					
					
								
				<?php
if(isset($authUrl)){
	echo '<a class="login" href="'.$authUrl.'"><button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left google-button">
						Login with Google+
						<i class="entypo-gplus"></i>
					</button></a>';}
	
 ?>
		</div> 	
			</form>
			
			<div class="login-bottom-links">
				
				<a href="forgot-password.php" class="link">Forgot your password?</a>
				
				<br />
				
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
				
			</div>
			
		</div>
		
	</div>
	
</div>
	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>
</body>
</html>