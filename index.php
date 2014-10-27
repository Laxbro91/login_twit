<?php 

session_start();
include_once('classes/googleRegister_include.php'); 
include_once('config.php');
include_once('classes/Db.class.php');


if(!isset($_SESSION['userID'])){
	header('Location: loginscreen.php');
}

	require('twitteroauth/twitteroauth.php');
	require('config.php');

if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) 
{
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth('CONSUMER_KEY', 'CONSUMER_SECRET', $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/verify_credentials');
var_dump($content);





   /* $connect = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'],
    $_SESSION['oauth_token_secret']);

    $token_credentials = $connect->getAccessToken($_REQUEST['oauth_verifier']);

    $connect = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $token_credentials['oauth_token'],
    $token_credentials['oauth_token_secret']);

    $account = $connect->get('account/verify_credentials');

    echo $account;*/




 ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>World Of WAW | portal</title>
	

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
<body class="page-body page-left-in" >

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	
	<div class="sidebar-menu">
		
			
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
					<img src="assets/images/logo@2x.png" width="120" alt="" />
				</a>
			</div>
			
						<!-- logo collapse icon -->
						
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
									
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
		</header>
				
		
		
				
		
				
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
			<!-- Search Bar -->
			<li id="search">
				<form method="get" action="">
					<input type="text" name="q" class="search-input" placeholder="Search something..."/>
					<button type="submit">
						<i class="entypo-search"></i>
					</button>
				</form>
			</li>
			
			<?php if ($_SESSION['userType']==1||$_SESSION['userType']==2||$_SESSION['userType']==3){echo "
			<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 1 (basic, middle, admin)</span>
				</a>
			</li>	

			<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 2 (basic, middle, admin)</span>
				</a>
			</li>	

			<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 3 (basic, middle, admin)</span>
				</a>
			</li>	";}


			if($_SESSION['userType']==2||$_SESSION['userType']==3) {echo 
				"<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 4 (middle, admin)</span>
				</a>
			</li>	

			<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 5 (middle, admin)</span>
				</a>
			</li>	

			<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 6 (middle, admin)</span>
				</a>
			</li>";
			}
			if($_SESSION['userType']==3){echo "
				<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 7 (admin)</span>
				</a>
			</li>	

			<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 8 (admin)</span>
				</a>
			</li>	

			<li>
				<a href='index.html'>
					<i class='entypo-doc-text-inv'></i>
					<span>Page 9 (admin)</span>
				</a>
			</li>		";
		}?>
				
		
			

			
			

		</ul>
				
	</div>	

	
	
	<div class="main-content">

		<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
						<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				
				<a href="/STAGE/git/vincent/profilescreen.php" class="dropdown-toggle">
					<img src="<?php  echo $_SESSION['avatar'];?>" alt="this is the profile pic of the user" class="img-circle" width="44">
					<?php  echo $_SESSION['userName'];?>
				</a>
				
				
				
		
	
	</div>

<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			
		
			
			<li>
				<a href='data/logout.php' id='logout'>
					Log Out <i class='entypo-logout right'></i>
				</a>
			</li>
		</ul>
		
	</div>
		<h2>Here starts everything...</h2>

<br />




<!-- lets do some work here... --><!-- Footer -->
<footer class="main">
	
		
	<strong>Copyright &copy; 2014</strong> World of Waw. 

</footer>	</div>
	
		
	</div>




	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>