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
<body class="bg-gray-200">
    <!-- navbar  -->
    <header class="bg-gradient-to-r from-green-900 to-green-700  shadow-md h-12 sticky top-0 z-10">
		<nav class="">
			<ul class="flex py-1 mx-5 md:mx-10 items-center justify-between">
                <li><img src="/images/logoconvertor.PNG" alt="logo" class="w-2/5"></li>
				<li><button class="bg-black shadow-outline shadow-lg text-white md:font-bold py-1 px-2 md:p-2 rounded cursor-pointer hover:bg-green-600"><a class="text-white" href="index.php">Register</a></button></li>
			</ul>
		</nav>
	</header>

    <!-- main content  -->
    <div class="grid md:grid-cols-2 gap-1 items-center mt-10 px-8">
		<section class="mb-5 z-20">
			<h1 class="text-2xl mb:text-4xl font-bold mb-3 text-center" >Sign In</h1>
			<form  class="grid grid-cols-1 place-items-center justify-center gap-4" method="post" action="" name="login-from">
                <div>
                    <label for="email">Email</label><br>
                    <input class="shadow-lg bg-green-100 rounded-lg p-2 border border-gray-400 md:w-96" type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div>
                    <label for="password">Password</label><br>
                    <input class="shadow-lg bg-green-100 rounded-lg p-2 border border-gray-400 md:w-96" type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <div>
                    <input class ="bg-green-500 shadow-outline shadow-lg text-white font-bold py-2 px-4 rounded cursor-pointer" type="submit" name="login" value="Login">
                    <button class ="bg-black shadow-xl text-white font-bold py-2 px-4 rounded cursor-pointer"><a href ="index.php"> Register</a></button>
                    
                </div>
			</form>
		</section>
		<section>	
			<img src="/images/wallet.png" alt="">
		</section>
	</div>
</body>
</html>