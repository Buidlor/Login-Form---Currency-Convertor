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
    $amount = 0;
    $price = 0;
    if (isset($_POST['submit'])){
        $price = $_POST['price']; 
        $amount = $_POST['amount'];
    }else{
        $price = 0;
        $amount = 0;
    }
    
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


<body class ="bg-gray-200 md:h-screen ">

    <!-- navbar  -->
    <header class="bg-gradient-to-r from-green-900 to-green-700 shadow-md w-full h-12 sticky top-0 z-10">
        <nav>
            <ul class="flex py-1 mx-5 md:mx-10 items-center justify-between">
                <li><img src="/images/logoconvertor.PNG" alt="logo" class="w-2/5"></li>
                <li>
                    <button id="loggeduser" class="bg-black shadow-outline shadow-lg text-white md:font-bold py-1 px-2 md:p-2 rounded cursor-pointer hover:bg-red-600">
                        <a class="text-white" href="login.php"><?php echo $user; ?></a>
                    </button>
                </li>
            </ul>
        </nav>
    </header>


    <!-- main content  -->
    <div id="app-body" class="md:m-5 grid md:grid-cols-2 ">

        <!-- left pane  -->
        <div id="convertor-pane" class="pane md:m-5 border border-green-300 rounded-lg p-1 sm:p-2 md:p-5 shadow-xl  ">
            <div id="titles" >
                <p >Welcome <?php echo $user; ?> !</p>
                <h1 class="font-bold text-xl md:text-3xl">Currency Convertor</h1>
                <hr class="my-1 md:my-3 border-t-4 border-green-400 w-10">
                <p class="text-sm font-light">Based on exchange rate of Coingecko</p>
            </div>

            <!-- swap form -->
            <form class="md:mt-10 grid gap-2  py-2 md:py-5 place-content-stretch relative " method="post" action="" name="exchange">
                <div class="bg-white border border-green-300 rounded-xl shadow-md transform hover:-translate-y-1 ">    
                    <input class="text-center font-bold text-xl md:p-4 w-3/4  md:mr-5 rounded-xl m-1 focus:outline-none" type="text" pattern="[0-9]+([\.|,][0-9]+)?" name="amount" value=<?php echo $amount; ?> >
                    <select class="md:p-4 font-bold focus:outline-none" type='dropdown' name='price' id='pirce'>
                        <option class="font-bold" value=<?php echo $coinsData[0]['current_price'];?>>BTC</option>
                        <option class="font-bold" value=<?php echo $coinsData[1]['current_price'];?>>ETH</option>
                        <option class="font-bold" value=<?php echo $coinsData[2]['current_price'];?>>BNB</option>
                        <option class="font-bold" value=<?php echo $coinsData[3]['current_price'];?>>MATIC</option>
                        <option class="font-bold" value=<?php echo $coinsData[4]['current_price'];?>>OKB</option>
                        <option class="font-bold" value=<?php echo $coinsData[5]['current_price'];?>>SOL</option>
                        <option class="font-bold" value=<?php echo $coinsData[6]['current_price'];?>>DOT</option>
                        <option class="font-bold" value=<?php echo $coinsData[7]['current_price'];?>>LTC</option>
                        <option class="font-bold" value=<?php echo $coinsData[8]['current_price'];?>>AVAX</option>
                        <option class="font-bold" value=<?php echo $coinsData[9]['current_price'];?>>UNI</option>
                    </select>
                </div>
                <div class="flex items-center bg-white border border-green-300 rounded-xl shadow-md transform hover:-translate-y-1 " >
                    <div class="md:p-4 md:h-max rounded-xl m-1 w-4/5 text-center text-green-800 text-xl font-bold">
                        <?php echo $price*$amount; ?>
                    </div>
                    <div class="md:p-4 font-bold w-1/5 ">$USD</div>
                </div>
                <div class="absolute bottom-1/3 left-1/2 md:mb-1">
                    <button type="submit" name="submit" class="bg-green-400 text-white py-1 px-2 md:p-2 rounded-full shadow-lg md:w-14 md:h-14 transform hover:-translate-y-1 ">
                        <i class="fas fa-exchange-alt"></i>
                    </button>
                </div>
            </form>
         
            <div class="">
                <coingecko-coin-price-chart-widget background-color="#a6f7c4" coin-id="bitcoin" currency="usd" height="300" locale="en"></coingecko-coin-price-chart-widget>
            </div>
          
             <!-- <?php 
            echo '<pre>'; 
            print_r($coinsData); 
            echo '</pre>';
            ?>  -->
        </div>

        <!-- right pane  -->
        <div id="exchange-pane" class="pane md:m-5 md:p-5 shadow-xl">
            <div id="titles" >
                <p>.</p>
                <h1 class="font-bold text-3xl">Exchange-Rates</h1>
                <hr class="my-1 md:my-3 border-t-4 border-green-400 w-10">
                <p class="text-sm font-light">Based on exchange rate of Coingecko</p>
            </div>
            <div  class=" md:my-5 grid">
                <table class="my-3 md:my-7">
                    <tr>
                        <td class="text-lg font-bold">Rank</td>
                        <td class="text-lg font-bold">Name</td>
                        <td class="text-lg font-bold">Price</td>
                        <td class="text-lg font-bold">Market Cap</td>
                        <td class="text-lg font-bold">Icon</td>
                    </tr>
                    
                    <?php foreach($coinsData as $coin){ ?>
                        <tr>
                            <td><?php echo $coin['market_cap_rank']; ?></td>
                            <td><?php echo $coin['name']; ?></td>
                            <td><?php echo $coin['current_price']; ?></td>
                            <td><?php echo $coin['market_cap']; ?></td>
                            <td><img class="w-10" src="<?php echo $coin['image']; ?>"> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>  
    <script src="https://widgets.coingecko.com/coingecko-coin-price-chart-widget.js"></script> 
</body>
</html>