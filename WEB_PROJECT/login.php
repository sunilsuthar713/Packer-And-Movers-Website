<!-- This script is executed when the login button is pressed in the modal login form in home_page.php -->
<?php
if (isset($_POST['login'])) {
	$con = new mysqli('localhost', 'webdev', 'root123', 'webproject');
	$email = $con->real_escape_string($_POST['email']);
	$password = $con->real_escape_string($_POST['password']);
	if ($email == "" || $password == "")
		$msg = "Please check your inputs!";
	else 
	{
		$sql = $con->query("SELECT name, email, password, isEmailConfirmed FROM accounts WHERE email='$email' AND password='$password'");
		if ($sql->num_rows > 0)
		{
			$sql->data_seek(0);
			$row = $sql->fetch_assoc();
			if($row['isEmailConfirmed'] == 1)
			{
				session_start();
				$_SESSION['username'] = $row['name'];
				$_SESSION['email'] = $row['email'];
				$msg = "Login Successful!";
			}
			else
			{
				$msg = 'Please Verify the account first!';
			}
		} 
		else 
		{
			$msg =  "Invalid Login Credentials";
		}
	}
	header("Location: index.php?message=$msg");
	exit();
}
?>