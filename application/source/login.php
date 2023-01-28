<?php 
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check_email = $connection->prepare("SELECT * FROM users WHERE email = :email");
        $check_email->bindParam(':email', $email);
        $check_email->execute();
        if ($check_email->rowCount() > 0) {
            $row = $check_email->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['Pw'])) {
                $_SESSION['user'] = $row['UserName'];
                header("Location: dashboard.php");
            }else{
                echo "Password does not match";
            }
        }else{
            echo "Email does not exist";
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
	
    <title>Login</title>
</head>
<body>
    <div>
		<section class="display-flex">
			<h1 class="text-4xl font-bold text-center" >Sign In</h1>
			<form class="text-center" method="post" action="" name="login-from">
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <div>
                    <input type="submit" name="login" value="Login">
                </div>
			</form>
		</section>
		<section>	
			<img src="/images/wallet.png" alt="">
		</section>
	</div>
</body>
</html>