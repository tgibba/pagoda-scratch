<?php


class Database {

		
	function __construct() {
		
	 	$dbHost = "localhost";
		$dbUser = "root";
 		$dbPass = "godmode";
 		$dbName = "pagoda";
		
		$this->connect($dbHost,$dbUser,$dbPass,$dbName);
	}
	
	public function connect($host,$user,$pass,$database) {
		mysql_connect($host,$user,$pass) or die(mysql_error());
		mysql_select_db($database) or die(mysql_error());
	
	}
	
	public function verifyLoginCredentials($uname,$password)
	{
		global $view;
	//security
		$uname = mysql_escape_string($uname);
		$password = mysql_escape_string($password);
	
			
		//checking for blank fields
			if (!$uname || !$password )
			{
				$view->RenderMsg("You did not complete all the required fields");
				return;
			}	
			
		$uNameCheck = mysql_query("SELECT * FROM user WHERE username = '$uname'")
						or die(mysql_error());
		$uNameCheckResult = mysql_num_rows($uNameCheck);
		
		if($uNameCheckResult == 0)
		{
			$view->RenderMsg("Username does not exist.");
			return;
			
		}
				
		$pwCheck = mysql_fetch_array($uNameCheck);
			
			if($pwCheck["password"] != $password)
			{
				$view->RenderMsg("Incorrect password.");
				return;
			}
			
			
			else 
			{	
				$UserID = $pwCheck["UserID"];
				$rolesid = mysql_query("SELECT RolesID FROM users_has_roles WHERE UsersID = $UserID");
				$rolesid = mysql_fetch_array($rolesid);
				$rolesid = $rolesid["RolesID"];
				
				$view->success($rolesid);
				return;
			}
		
		mysql_free_result($uNameCheck);
	}
	
}

?>
