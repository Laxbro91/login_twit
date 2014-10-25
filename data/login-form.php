<?php

session_start();
$_SESSION['loggedIn']=false;
// Fields Submitted
	$salt="AZujncqokp5648??qzd,SUP?LACROSSEBRO";
	$usernameOrEmail = $_POST["username"];
	$password =md5($_POST["password"].$salt); 
	$resp = array();

// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
	$resp['submitted_data'] = $_POST;


// Login success or invalid login data [success|invalid]
// Your code will decide if username and password are correct
	$login_status = 'invalid';



	// login FB



	
	// normal login
	$db = new mysqli("localhost", "root", "", "db_portaal");
			if(!$db -> connect_errno)
			{
				$sql = "SELECT * FROM `tbl_user` WHERE (email ='" . $db -> real_escape_string($usernameOrEmail) . "' or username= '" . $db -> real_escape_string($usernameOrEmail) . "') and password='" . $db -> real_escape_string($password) . "';";


			
				$result = $db -> query($sql);
				
				if($result -> num_rows == 1)
				{
					$user = mysqli_fetch_object($result);
					
					$login_status='success';

					$_SESSION['userID']=$user->user_ID;
					$_SESSION['userType']=$user->userType_ID;
					$_SESSION['userName']=$usernameOrEmail;
					$_SESSION['avatar']=$user->avatar;
					$_SESSION['loggedIn']=true;

				}

			$resp['login_status'] = $login_status;

				if($login_status == 'success'){
					$resp['redirect_url'] = 'index.php';
				}
}



echo json_encode($resp);












