<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
            </div>
            <ul class="flex justify-evenly mr-8">
                <li class="text-lg font-semibold px-4"><a href="./Home.php">Home</a></li>
                <li class="text-lg font-semibold px-4"><a href="./Login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <main class="w-full flex justify-between">
        <div class=" w-1/2 flex justify-center items-center h-screen">
            <div class="flex flex-col justify-center items-center">
                <h4 class="text-2xl">Saving people lives</h4>
                <h1 class="text-8xl font-semibold">LIFELINK</h1>
                 <h3 class="text-2xl">Welcome to our Organ Donation website.</h3>
                <p class="text-lg font-semibold mt-4">Login into your account</p>
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2"><a href="./Login.php">Login</a></button>
            </div>
        </div>
         <div class=" w-1/2 flex justify-center items-center h-screen ">
            <div class="flex flex-col justify-center items-center p-3">
                <img src="./images/home.jpg" alt="">
            </div>
        </div>
    </main>
</body>
</html>