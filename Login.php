<?php 
    session_start();
    require_once "dbconnect.php";
    // if(isset($_SESSION['username'])!=""){
    //     header("Location:./Userpage.php");
    // }
    $password_error=false;
    $username_error=false;
    $token_error=false;
    if(isset($_POST['login'])){
        include "dbconnect.php";
        $username=$_POST['username'];
        $password=$_POST['password'];
        $vt=$_POST['vt'];
        $sql="SELECT * FROM `login` WHERE `username`='$username'";
        $res=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($res);
        if($num==1){
            $row=mysqli_fetch_assoc($res);
            if($password==$row['password'] && $vt==$row['Token']){
                $_SESSION['username']=$row['username'];
                header("Location:./Userpage.php");
            }
            else if($password!=$row['password']){
                $password_error=true;
            }
            else if($vt!=$row['Token']){
                $token_error=true;
            }
        }
        else{
            $username_error=true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <li class="text-lg font-semibold px-4"><a href="./index.html">Home</a></li>
                <!-- <li class="text-lg font-semibold px-4"><a href="./Signup.php">Signup</a></li> -->
                <li class="text-lg font-semibold px-4"><a href="#">Login</a></li>
            </ul>
        </nav>
    </header>
    <main class="flex">
        <div class=" w-1/2 flex justify-center items-center h-screen">
            <div class="flex flex-col justify-center items-center">
                <img src="./images/login.jpg" alt="">
            </div>
        </div>
         <div class=" w-1/2 flex justify-center items-center h-screen">
           <div class="flex flex-col justify-center items-center">
                <h1 class="font-semibold text-3xl">Login into the system</h1>
                <form action="./Login.php" method="post">
                    <div class="flex flex-col justify-center items-center">
                        <input type="text" placeholder="Username" id="username" name="username" class="border-2 border-black rounded-lg p-2 mt-4" required>
                        <input type="password" placeholder="Password" id="password" name="password" class="border-2 border-black rounded-lg p-2 mt-4" required>
                        <input type="password" placeholder="Authentication Token" id="password" name="vt" class="border-2 border-black rounded-lg p-2 mt-4" required>
                        <input type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2" name="login" value="submit"></input>
                        <?php  
                          if($username_error){
                           ?>
                            <p class="text-red-500 text-2xl font-semibold">Username does not exist</p>
                          <?php 
                          }
                          if($password_error){
                           ?>
                            <p class="text-red-500 text-2xl font-semibold">Password is incorrect</p>
                            <?php
                            }
                            if($token_error){
                        ?>
                        <p class="text-red-500 text-2xl font-semibold">Token is incorrect</p>
                        <?php 
                            }
                        ?>
                    </div>
                </form>
            </div>  
        </div>
    </main>

    <!-- footer -->
    <footer class="flex items-center justify-center h-24 bg-black text-white">
        <div class="container mx-auto flex items-center">
            <span class="mr-2">
                <img src="images/logo.png" alt="Footer Icon" class="h-10 w-10">
            </span>
            <span class="text-lg">© 2023 LifeLink. All rights reserved.</span>
        </div>
        <div class="ml-4">
            <span>
                <a href="https://github.com/RayLikesAnime/LifeLink">
                    <img src="images/github.png" alt="Another Icon" class="h-16 w-16 mx-20">
                </a>
            </span>
        </div>
    </footer>
</body>
</html>