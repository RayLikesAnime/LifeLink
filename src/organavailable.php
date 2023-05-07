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
    $Donor_id=$_POST["Donor_id"];
    $organ=$_POST["organ"];
    $status=$_POST["status"];
    

    $sql="INSERT INTO `organs` (`Donor_id`, `organ`,`status`) VALUES ('$Donor_id', '$organ','$status');";
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully";
        header("Location:./relative.php");
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
    <title>organs available</title>
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
                    <form action="./Userpage.php" method="post">
                         <input type="submit" name="logout" value="Logout">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <div class="text-4xl flex justify-center mt-9">Organ Available</div>
    <div class="flex justify-center mt-10">
    <div class="w-full max-w-xs">
  <form class=" px-8 pt-6 pb-8 mb-4" action="./organavailable.php" method="post">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="patientid">
        Donor ID
      </label>
      <input class=" border rounded w-full py-3 px-4 " id="patientid" type="text" name="Donor_id">
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
      <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-4 mt-4 ml-20 rounded " type="submit">
        Submit
      </button>
  </form>
</div>
    </div>
</body>
</html>