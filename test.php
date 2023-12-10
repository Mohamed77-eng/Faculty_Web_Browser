<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{
						if ($user_name === 'admin' && $password === 'specific_password') {
							header("Location: http://localhost/phpmyadmin/index.php?route=/sql&db=loginsimpledb&table=users&pos=0"); // Redirect to specific link
							exit();
					} else {
							// Redirect to another page for regular users
							header("Location: ../Faculty_Web_Browser/Home/index.html"); // Change to your regular user page
							exit();
					}
				}
			}
			
			echo "wrong username or password!";
		}
		else
		{
			echo "wrong username or password!";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="CSS/styles.css">
	<script src="main.js" defer></script>
</head>
<body>
	<div id="box">
		<h2>Login</h2>
		<form method="post" id="loginForm">
			<input id="text" type="text" name="user_name" placeholder="User Name"><br><br>
			<input id="text" type="password" name="password" placeholder="Password"><br><br>
			<input id="button" type="submit" value="Login"><br><br>

			<a class = "link" href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>