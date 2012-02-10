<?php
class Session 
{

	function __construct()
	{
		session_start();	
	}
	
	
	//return 0 if successfully logged in, nonzero will throw error
	function logIn($user,$pass)
	{
		global $db;
		
		$cred = $db->query("SELECT * FROM User 
		INNER JOIN Users_has_Roles ON User.UserID = Users_has_Roles.UsersID
		INNER JOIN Roles ON Users_has_Roles.UsersID = Roles.RolesID
		WHERE username = '$user' AND password = '$pass'");
		if (!empty($cred[0]))
		{
			$_SESSION['loggedIn'] = true;
			$_SESSION['username'] = $cred[0]["username"];
			$_SESSION['role'] = $cred[0]["role"];
			$_SESSION['id'] = $cred[0]["UserID"];
			return true;
		}
		else
			return false;
	}
	
	function logOut()
	{
		$_SESSION['loggedIn'] = false;
		if (isset($_COOKIE[session_name()])) 
		{
			setcookie(session_name(), '', time()-42000, '/');
		}
		session_destroy();
	}
	
	function isLoggedIn()
	{
		if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']))
			return true;
		else return false;
	}
	
	function getName()
	{
		return $_SESSION['username'];
	}
	
	function getRole()
	{
		return $_SESSION['role'];
	}
}
?>