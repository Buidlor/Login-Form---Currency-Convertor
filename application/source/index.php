<?php 
	session_start();
	include('config.php');
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		$check_email = $connection->prepare("SELECT * FROM users WHERE email = :email");
		$check_email->bindParam(':email', $email);
		$check_email->execute();
		if ($check_email->rowCount() > 0) {
			echo "Email already exists";
		}else{
			if ($password == $confirm_password) {
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$insert = $connection->prepare("INSERT INTO users (UserName, email, Pw) VALUES (:name, :email, :password)");
				$insert->bindParam(':name', $name);
				$insert->bindParam(':email', $email);
				$insert->bindParam(':password', $hash);
				if ($insert->execute()) {
					$_SESSION['user'] = $row['UserName'];
					header("Location: dashboard.php");
				}else{
					echo "Registration failed";
				}
			}else{
				echo "Password does not match";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
	<title>Register</title>
</head>
<body class="bg-gray-200">
	<header class="bg-green-800 h-12 fixed w-full top-0 z-50">
		<nav class="">
			<ul class="flex mx-10 items-center pt-2 justify-between">
				<li><h1 class ="text-xl text-white font-bold" >Wallet</h1></li>
				<li><button class="bg-black"><a class="text-white" href="login.php">Login</a></button></li>
			</ul>
		</nav>
	</header>
	<div class="flex flex-row justify-center items-center h-screen ">
		<section class="mx-16">
			<h1 class="text-4xl font-bold text-center" >Create an account</h1>
			<form  class="grid grid-cols-1 gap-4" method="post" action="" name="registration-from">
				<div>
					<label for="name">Name</label></br>
					<input class="shadow-lg bg-green-100 rounded-lg p-2 border border-gray-400 w-96" type="text" name="name" id="name" placeholder="Enter your name" pattern="[a-zA-Z0-9]+" required>
				</div>
				<div>
					<label for="email">Email</label></br>
					<input class="shadow-lg bg-green-100 rounded-lg p-2 border border-gray-400 w-96" type="email" name="email" id="email" placeholder="Enter your email" required>
				</div>
				<div>
					<label for="password">Password</label></br>
					<input class="shadow-lg bg-green-100 rounded-lg p-2 border border-gray-400 w-96" type="password" name="password" id="password" placeholder="Enter your password" required>
				</div>
				<div>
					<label for="confirm_password">Confirm Password</label></br>
					<input class="shadow-lg bg-green-100 rounded-lg p-2 border border-gray-400 w-96" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>
				</div>
				<div>
					<input class ="bg-green-500 shadow-outline shadow-lg text-white font-bold py-2 px-4 rounded cursor-pointer" type="submit" name="submit" value="Register">
				</div>
			</form>
		</section>
		<section class="mx-16">	
			<img  src="/images/wallet.png" alt="">
		</section>
	</div>
</body>
</html>


