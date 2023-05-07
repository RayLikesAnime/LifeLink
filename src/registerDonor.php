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
    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $age=$_POST["age"];
    $Blood_group=$_POST["Blood_group"];
    $medical_history=$_POST["medical_history"];
    $doctor=$_POST["doctor"];
    $address=$_POST["address"];
    $address2=$_POST["address2"];
    $address3=$_POST["address3"];
    $phone=$_POST["phone"];
    $organ=$_POST["organ"];
    $status=$_POST["status"];
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $relation=$_POST["relation"];
    $street=$_POST["street"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    

    $sql1="INSERT INTO `donor` (`first_name`, `last_name`, `age`,`Blood_group`,`medical_history`, `doctor`, `address`,`address2`, `address3`, `phone`) VALUES ('$first_name', '$last_name','$age',  '$Blood_group', '$medical_history','$doctor', '$address','$address2', '$address3','$phone');";
    $result1=mysqli_query($conn, $sql1);
    $sql2 = "INSERT INTO `organs` (`Donor_id`, `organ`, `status`)
         SELECT `Donor_ID`, '$organ' , '$status'
         FROM `donor`
         WHERE `first_name` = '$first_name' AND `last_name`='$last_name' AND `age` = '$age' AND `medical_history` = '$medical_history' AND `doctor` = '$doctor' AND `address` = '$address' AND `address2` = '$address2' AND `address3` = '$address3' AND`phone` = '$phone' AND `Blood_group`='$Blood_group'";
    $result2=mysqli_query($conn, $sql2);
    $sql3="INSERT INTO `next_of_kin` (`Donor_ID`, `First_name`, `last_name`, `Relation` , `Street`, `City`, `state`)
    SELECT `Donor_ID`, '$firstname' , '$lastname','$relation','$street', '$city', '$state'
    FROM `donor`
    WHERE `first_name` = '$first_name' AND `last_name`='$last_name' AND `age` = '$age' AND `medical_history` = '$medical_history' AND `doctor` = '$doctor' AND `address` = '$address' AND `address2` = '$address2' AND `address3` = '$address3' AND`phone` = '$phone' AND `Blood_group`='$Blood_group'";
    $result3=mysqli_query($conn, $sql3);
    if ($result1 && $result2 && $result3) {
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
    <title>Donor</title>
</head>
<body>
<header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
                <a href="donor.php"><button type="button" class=" ml-5 text-white bg-red-500 hover:bg-red-700 focus:ring-4 rounded-lg text-sm px-4 py-2 text-center inline-flex items-center">Back
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
    <h1 class="text-center decoration-solid text-black text-4xl font-bold mt-7">Register New Donor</h1>

    <div class="flex justify-center mt-10">

    <form class="w-full max-w-lg " action="./registerDonor.php" method="post">
        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-first-name">
            First Name
        </label>
        <input class="block w-full text-gray-700 border rounded py-3 px-4 mb-3" id="grid-first-name" name="first_name" type="text">
        </div>
        <div class="w-full md:w-1/2 px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-last-name">
            Last Name
        </label>
        <input class=" block w-full text-gray-700 border rounded py-3 px-4" id="grid-last-name" name="last_name" type="text">
        </div>        
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-L font-bold mb-2" for="grid-zip">
            Age
        </label>
        <input class=" block w-full text-gray-700 border rounded py-3 px-4" id="grid-zip" name="age" ">
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class=" text-gray-700 text-l font-bold mb-2" for="grid-state">
            Doctor ID
        </label>
        <a href="searchDoctor.php" target ="_blank"><div class="text-blue-700 underline hover:underline-offset-4 ml-24"> view id</div></a>
        <input class=" block w-full  text-gray-700 border  rounded py-3 px-4" id="grid-city" name="doctor" type="text">
        </div>
        
        <div class="w-full px-3 mt-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-password">
            Medical History
        </label>
        <input class="w-full text-gray-700 border  rounded py-3 px-4 mb-3 " id="grid-password" name="medical_history">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-password">
            Address
        </label>
        <input class="w-full text-gray-700 border rounded py-3 px-4 mb-3" id="grid-password" name="address">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2">
            Address2
        </label>
        <input class="w-full  text-gray-700 border  rounded py-3 px-4 mb-3" name="address2">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-password">
            Address3
        </label>
        <input class="w-full text-gray-700 border  rounded py-3 px-4 mb-3" name="address3" >
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-city">
            Phone
        </label>
        <input class=" w-full  text-gray-700 border  rounded py-3 px-4" id="grid-city" name="phone">
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class=" text-gray-700 text-l font-bold mb-2" for="grid-state">
            Blood Group
        </label>
        <input class="w-full text-gray-700 border  rounded py-3 px-4 " id="grid-city" name="Blood_group" type="text">        
        </div>
        
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="organ">
        Organ Available
      </label>
      <input class=" border rounded w-full py-3 px-4 text-gray-700 mb-3" id="organ" name="organ" type="text">
      <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="patientid">
        Status
      </label>
      <input class=" border rounded w-full py-3 px-4 " id="patientid" type="text" name="status">
    </div>
    <h1 class="text-center decoration-solid text-black text-4xl font-bold mt-7">Relative Details</h1>
    <div class="flex flex-wrap -mx-3 mb-6 mt-8">
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
        <input class=" w-full text-gray-700 border rounded py-3 px-4 id="grid-last-name" name="lastname" type="text">
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-zip">
            Relation
        </label>
        <input class="w-full text-gray-700 border rounded py-3 px-4" id="grid-zip" name="relation" ">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-password">
            Street
        </label>
        <input class="w-full text-gray-700 border  rounded py-3 px-4 mb-3 " id="grid-password" name="street">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2" for="grid-password">
            City
        </label>
        <input class="w-full text-gray-700 border rounded py-3 px-4 mb-3" id="grid-password" name="city">
        </div>
        <div class="w-full px-3">
        <label class="text-gray-700 text-l font-bold mb-2">
            State
        </label>
        <input class="w-full  text-gray-700 border  rounded py-3 px-4 mb-3" name="state">
        </div>
    </div>
    <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2 mb-6 ml-48 " type="submit">Register</button>
</form>
    </div>
</body>
</html>