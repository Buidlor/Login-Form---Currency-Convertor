<?php 


include('config.php');
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}else{
    $user = $_SESSION['user']; 
    $API_url = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=100&page=1&sparkline=false";
    $API_response = file_get_contents($API_url);
    $API_response = json_decode($API_response, true);
    $coinsData = array();
    
    array_push($coinsData, $API_response[0]);
    array_push($coinsData, $API_response[1]);
    array_push($coinsData, $API_response[4]);
    array_push($coinsData, $API_response[9]);
    array_push($coinsData, $API_response[10]);
    array_push($coinsData, $API_response[11]);
    array_push($coinsData, $API_response[13]);
    array_push($coinsData, $API_response[15]);
    array_push($coinsData, $API_response[16]);
    array_push($coinsData, $API_response[19]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body class ="bg-gray-200 h-screen ">
    <header class="bg-gradient-to-r from-green-900 to-green-700 shadow-md h-12 sticky top-0 z-10">
        <nav>
            <ul class="flex mx-10 items-center justify-between">
                <li><h1 class ="text-xl text-white font-bold" >Wallet</h1></li>
                <li>
                    <button id="loggeduser" class="bg-black shadow-outline shadow-lg text-white font-bold py-2 px-4 rounded cursor-pointer hover:bg-red-600">
                        <a class="text-white" href="login.php"><?php echo $user; ?></a>
                    </button>
                </li>
            </ul>
        </nav>
    </header>
    <div class="m-5 grid grid-cols-2">
        <div id="convertor-pane" class="m-5 border border-green-300 rounded-lg p-5 shadow-xl h-screen ">
            <div id="titles" >
                <p>Welcome <?php echo $user; ?> !</p>
                <h1 class="font-bold text-3xl">Currency Convertor</h1>
                <hr class="my-3 border-t-4 border-green-400 w-10">
                <p class="text-sm font-light">Based on exchange rate of Coingecko</p>
            </div>
            <div id="exchange" class="m-10 grid gap-2 py-5 place-content-stretch relative ">
                <div class="bg-white border border-green-300 rounded-xl shadow-md transform hover:-translate-y-1 ">    
                    <input class="p-5 w-3/4 mr-5 rounded-xl m-1  focus:outline-none" type="text">
                    <input class="p-5 border border-black w-1/6 focus:outline-none" type='dropdown'>
                </div>
                <div class="bg-white border border-green-300 rounded-xl shadow-md transform hover:-translate-y-1 " >
                    <input class="p-5 w-3/4 mr-5 h-max rounded-xl m-1 focus:outline-none" type="text">
                    <input class="p-5 border border-black w-1/6 focus:outline-none" type='dropdown'>
                </div>
                <div class="absolute bottom-1/3 left-2/4 mb-1">
                    <button class="bg-green-400 text-white p-2 rounded-full shadow-xl w-14 h-14 transform hover:-translate-y-1 ">
                        <i class="fas fa-exchange-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="exchange-pane" class="m-5">
            <div id="titles" >
                <p>Welcome <?php echo $user; ?> !</p>
                <h1 class="font-bold text-3xl">Exchange-Rates</h1>
                <hr class="my-3 border-t-4 border-green-400 w-10">
                <p class="text-sm font-light">Based on exchange rate of Coingecko</p>
            </div>
            <div id="exchange" class="my-5 grid">
                <?php 
                    echo '<pre>';
                    print_r($coinsData);
                    echo '</pre>';
                ?>
            </div>
        </div>

    </div>
        
</body>
</html>