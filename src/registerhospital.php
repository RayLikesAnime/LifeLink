<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header("Location: ./Login.php");
    exit;
  }
session_start();
include "dbconnect.php";
if(isset($_SESSION['username']) =="") {
    setcookie(session_name(), '', 100);
    session_unset();
    session_destroy();
    header("Location: ./Login.php");
}
if(isset($_POST['logout'])){
    setcookie(session_name(), '', 100)  ;
    session_unset();
    session_destroy();
    header("Location: ./Login.php");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "dbconnect.php";
    $Hospital_name=$_POST["Hospital_name"];
    $City=$_POST["City"];
    $State=$_POST["State"];
    

    $sql="INSERT INTO `hospital` (`Hospital_name`, `City`, `State`) VALUES ('$Hospital_name', '$City','$State');";
    if (mysqli_query($conn, $sql)) {
        $message = "Data Inserted Successfully";
echo "<script type='text/javascript'>alert('$message');</script>";

      } else {
        echo "Error inserting record: " . mysqli_error($conn);
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Hospital</title>
</head>
<body>
<header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
                <a href="hospital.php"><button type="button" class=" ml-5 text-white bg-red-500 hover:bg-red-700 focus:ring-4 rounded-lg text-sm px-4 py-2 text-center inline-flex items-center">Back
</button></a>
            </div>
            
            <ul class="flex justify-evenly mr-8">
                <li class="text-lg font-semibold px-4"><a href="./Userpage.php">Home</a></li>
                <li class="text-lg font-semibold px-4">
                    <form action="./login.php" method="post">
                         <input type="submit" name="logout" value="Logout">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <h1 class=" flex justify-center decoration-solid text-black text-4xl font-bold mt-10">Register New Hospital</h1>

    <div class="flex justify-center mt-8">
    <form class="w-full max-w-lg " action="./registerHospital.php" method="post">
        <div class="flex flex-wrap mt-3 mx-3 mb-6">
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2">
            Hospital Name
        </label>
        <input class=" block w-full text-gray-700 border rounded py-3 px-4 mb-3" id="grid-password" name="Hospital_name">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2">
            City
        </label>
        <input class="block w-full text-gray-700 border  rounded py-3 px-4 mb-3" name="City">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2">
            State
        </label>
        <input class=" block w-full  text-gray-700 border  rounded py-3 px-4 mb-3 " name="State" >
        </div>
    </div>
    <div class="flex justify-center">
    <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2 mb-6 " type="submit">Register</button>
    </div>
</form>
    </div>
</body>
</html>