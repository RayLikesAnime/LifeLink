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
    $patient_ID=$_POST["patient_ID"];
    $organ_ID=$_POST["organ_ID"];
    $date=$_POST["date"];
    $status=$_POST["status"];
    

    $sql="INSERT INTO `transplants` (`patient_ID`, `organ_ID`, `date`,`status`) VALUES ('$patient_ID', '$organ_ID','$date', '$status');";
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully";
        header("Location:./Userpage.php");
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
    <title>Patient</title>
</head>
<body>
<header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
                <a href="Userpage.php"><button type="button" class=" ml-5 text-white bg-red-500 hover:bg-red-700 focus:ring-4 rounded-lg text-sm px-4 py-2 text-center inline-flex items-center">Back
</button></a>
            </div>
            <ul class="flex justify-evenly mr-8">
                <li class="text-lg font-semibold px-4"><a href="./Userpage.php">Home</a></li>
                <li class="text-lg font-semibold px-4">
                    <form action="./Userpage.php" method="post">
                         <input type="submit" name="logout" value="Logout">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <h1 class="text-4xl flex justify-center mt-7 font-bold">Transplants</h1>
    <div class="flex justify-center mt-9">
    <form class="w-full max-w-lg" action="./transplants.php"  bg-gray-500 shadow-md rounded" method="post" >
        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-first-name">
            Patient ID
        </label>
        <a href="searchpatient.php" target ="_blank"><div class="text-blue-700 underline hover:underline-offset-4 ml-48"> view id</div></a>
        <input class=" w-full  text-gray-700 border rounded py-3 px-4 mb-3 " id="grid-first-name" name="patient_ID"" type="text">
        </div>
        <div class="w-full md:w-1/2 px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-last-name">
            Organ ID
        </label>
        <a href="organs.php" target ="_blank"><div class="text-blue-700 underline hover:underline-offset-4 ml-48"> view id</div></a>
        <input class=" w-full text-gray-700 border rounded py-3 px-4 id="grid-last-name" name="organ_ID" type="text">
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-first-name">
            Date
        </label>
        <input class=" w-full text-gray-700 border rounded py-3 px-4 mb-3 " id="grid-first-name" name="date" type="text">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-password">
            Status
        </label>
        <input class="w-full text-gray-700 border  rounded py-3 px-4 mb-3 " id="grid-password" name="status">
        </div>
    </div>
    <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2 mb-6 ml-48 " type="submit">Success!</button>
</form>
    </div>
    <div class="flex justify-center">
    <a href="successfultransplants.php"><button type="button" class="  text-white bg-red-500 hover:bg-red-700 focus:ring-4 rounded-lg text-sm px-5 py-3 text-center inline-flex items-center">View All Successful Transplants
</button></a></div>
</body>
</html>