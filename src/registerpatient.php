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
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $age=$_POST["age"];
    $medicalhistory=$_POST["medicalhistory"];
    $doctor=$_POST["doctor"];
    $address=$_POST["address"];
    $address2=$_POST["address2"];
    $address3=$_POST["address3"];
    $phone=$_POST["phone"];
    $bloodgroup=$_POST["bloodgroup"];
    $organ=$_POST["organ"];
    

    $sql1="INSERT INTO `patient` (`first_name`, `last_name`, `age`,`medical_history`, `doctor`, `address`,`address2`, `address3`, `phone`, `Blood_group`) VALUES ('$firstname', '$lastname','$age', '$medicalhistory','$doctor', '$address','$address2', '$address3','$phone', '$bloodgroup');";
    $result1=mysqli_query($conn, $sql1);
    $sql2 = "INSERT INTO `organ_required` (`patient_id`, `organ`)
         SELECT `Patient_ID`, '$organ'
         FROM `patient`
         WHERE `first_name` = '$firstname' AND `last_name`='$lastname' AND `age` = '$age' AND `medical_history` = '$medicalhistory' AND `doctor` = '$doctor' AND `address` = '$address' AND `address2` = '$address2' AND `address3` = '$address3' AND`phone` = '$phone' AND `Blood_group`='$bloodgroup'";

    $result2=mysqli_query($conn, $sql2);
    if ($result1 && $result2) {
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
    <title>Patient</title>
</head>
<body>
<header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
                <a href="patient.php"><button type="button" class=" ml-5 text-white bg-red-500 hover:bg-red-700 focus:ring-4 rounded-lg text-sm px-4 py-2 text-center inline-flex items-center">Back
</button></a>
            </div>
            <ul class="flex justify-evenly mr-8">
                <li class="text-lg font-semibold px-4"><a href="./Userpage.php">Home</a></li>
                <li class="text-lg font-semibold px-4">
                    <form action="./Login.php" method="post">
                         <input type="submit" name="logout" value="Logout">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <h1 class="text-4xl flex justify-center mt-7 font-bold">Register Patient</h1>
    <div class="flex justify-center mt-9">
    <form class="w-full max-w-lg" action="./registerpatient.php"  bg-gray-500 shadow-md rounded method="post" >
        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-first-name">
            First Name
        </label>
        <input class=" w-full  text-gray-700 border rounded py-3 px-4 mb-3 " id="grid-first-name" name="firstname" type="text">
        </div>
        <div class="w-full md:w-1/2 px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-last-name">
            Last Name
        </label>
        <input class=" w-full text-gray-700 border rounded py-3 px-4" id="grid-last-name" name="lastname" type="text">
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-l font-bold mb-2" for="doctor">
            Doctor ID
        </label>
        <a href="searchDoctor.php" target ="_blank"><div class="text-blue-700 underline hover:underline-offset-4 ml-40"> view doctor</div></a>
        <input class=" w-full text-gray-700 border rounded py-3 px-4 mb-3 " id="doctor" name="doctor" type="text">
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-L font-bold mb-2" for="grid-age">
            Age
        </label>
        <input class="w-full text-gray-700 border rounded py-3 px-4" id="grid-age" name="age" >
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-medical-history">
            Medical History
        </label>
        <input class="w-full text-gray-700 border  rounded py-3 px-4 mb-3 " id="grid-medical-history" name="medicalhistory">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-address1">
            Address1
        </label>
        <input class="w-full text-gray-700 border rounded py-3 px-4 mb-3" id="grid-address1" name="address">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2">
            Address2
        </label>
        <input class="w-full  text-gray-700 border  rounded py-3 px-4 mb-3" name="address2">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-address3">
            Address3
        </label>
        <input class="w-full text-gray-700 border  rounded py-3 px-4 mb-3" name="address3" >
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-phone">
            Phone
        </label>
        <input class=" w-full  text-gray-700 border  rounded py-3 px-4" id="grid-phone" name="phone" type="text">
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class=" text-gray-700 text-l font-bold mb-2" for="grid-blood-group">
            Blood Group
        </label>
        <input class="w-full text-gray-700 border  rounded py-3 px-4 " id="grid-blood-group" name="bloodgroup" type="text">
        
        
        </div>
        <label class="block text-gray-700 text-sm font-bold mb-2 mt-4 w-full rounded px-2" for="organ">
        Organ Required
      </label>
      <input class=" border rounded w-full py-3 px-4 text-gray-700 mb-3 w-full" id="organ" name="organ" type="text">
    </div>
    <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2 mb-6 ml-48 " type="submit">Register</button>
</form>
    </div>
</body>
</html>