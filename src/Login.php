<?php 
    session_start();
    require_once "dbconnect.php";
    // if(isset($_SESSION['username'])!=""){
    //     header("Location:./Userpage.php");
    // }
    $password_error=false;
    $username_error=false;
    if(isset($_POST['login'])){
        include "dbconnect.php";
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql="SELECT * FROM `login` WHERE `username`='$username'";
        $res=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($res);
        if($num==1){
            $row=mysqli_fetch_assoc($res);
            if($password==$row['password']){
                $_SESSION['username']=$row['username'];
                header("Location:./Userpage.php");
            }
            else{
                $password_error=true;
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
                <li class="text-lg font-semibold px-4"><a href="./Home.php">Home</a></li>
                <li class="text-lg font-semibold px-4"><a href="./Signup.php">Signup</a></li>
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
                        <input type="text" placeholder="Username" id="username" name="username" class="border-2 border-black rounded-lg p-2 mt-4">
                        <input type="password" placeholder="Password" id="password" name="password" class="border-2 border-black rounded-lg p-2 mt-4">
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
                        ?>
                    </div>
                </form>
            </div>  
        </div>
    </main>
</body>
</html>