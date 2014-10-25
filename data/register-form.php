<?php
session_start();
/*
	Sample Processing of Register form via ajax
	Page: extra-register.html
*/

# Response Data Array

Include_once('../classes/Db.class.php');

$resp = array();

// Fields Submitted
$salt = "AZujncqokp5648??qzd,SUP?LACROSSEBRO";
$name       = $_POST["name"];
$surname    = $_POST["surname"];
$birthdate  = $_POST["birthdate"];
$username   = $_POST["username"];
$email      = $_POST["email"];
$password   = md5($_POST["password"].$salt);
//real escape against sql injection

$name= htmlspecialchars($name);
$surname    = htmlspecialchars($surname);
$birthdate  = htmlspecialchars($birthdate);
$username   = htmlspecialchars($username);
$email      = htmlspecialchars($email);



$resp['name'] = $name;
$resp['surname'] = $surname;
$resp['birthdate'] = $birthdate;
$resp['username'] = $username;
$resp['email'] = $email;
$resp['password'] = $password;

$db = new Db();


$sql = "SELECT * FROM `tbl_user` WHERE email ='" . $email. "' or username= '" . $username. "';";
$result=$db->mysqli->query($sql);
if($result -> num_rows == 0)
				{
				$sql = "INSERT INTO tbl_user 
					(name, surname, dateOfBirth, email, username, password) 
					VALUES (
						'".$name."',
						'".$surname."',
						'".$birthdate."',
						'".$email."',
						'".$username."',
						'".$password."'
						);";

					$db->mysqli->query($sql);
					$_SESSION['sql']=$sql;
}
else
{
	echo "error";
}

// This array of data is returned for demo purpose, see assets/js/neon-register.js
$resp['submitted_data'] = $_POST;

echo json_encode($resp);

