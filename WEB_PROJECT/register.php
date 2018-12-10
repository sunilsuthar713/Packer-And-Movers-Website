<!-- This script is exceuted when the sign up button is pressed in the modal sigup form in the home_page.php -->
<!-- It verifies if all fields are filled. Then it uses a library called PHP Mailer to send a link to the person who registered.
	A string is generated and is sent as a token in the link to the person.
-->
<?php
session_start();
$msg = "";
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['submit'])) 
{

	$con = new mysqli('localhost', 'webdev', 'root123', 'webproject');
	$name = $con->real_escape_string($_POST['name']);
	$email = $con->real_escape_string($_POST['email']);
	$password = $con->real_escape_string($_POST['password']);
	$cPassword = $con->real_escape_string($_POST['cPassword']);

	if ($name == "" || $email == "" || $password != $cPassword)
		$msg = "Please check your inputs!";
	else 
	{
		$sql = $con->query("SELECT email FROM accounts WHERE email='$email'");
		if ($sql->num_rows > 0) 
		{
			$msg = "Email already taken! Please Try to Login";
		} 
		else 
		{
			$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
			$token = str_shuffle($token);
			$token = substr($token, 0, 10);
			$hashedPassword = $password;

			$con->query("INSERT INTO accounts (name,email,password,isEmailConfirmed,token)
				VALUES ('$name', '$email', '$hashedPassword', '0', '$token');
				");

			include_once "PHPMailer/PHPMailer.php";
			$mail = new PHPMailer();
			$mail->setFrom('sunilsuthar713@gmail.com');
			$mail->addAddress($email, $name);
			$mail->Subject = "Please verify email!";
			$mail->isHTML(true);
			$mail->Body = "Please click on the link below:<br><br>
						<a href='localhost/WEB_PROJECT/confirm.php?email=$email&token=$token'>Click Here</a>";

			if ($mail->send())
			{
				$msg = "You have been registered! Please verify your email!";   
			}
			else
				$msg = "Something wrong happened! Please try again!";
		}
	}
	header("Location: index.php?message=$msg");
}
?>
