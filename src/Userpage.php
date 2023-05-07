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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userpage</title>
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
                <li class="text-lg font-semibold px-4"><a href="./Userpage.php">Home</a></li>
                <li class="text-lg font-semibold px-4">
                    <form action="./Userpage.php" method="post">
                         <input type="submit" name="logout" value="logout">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <main class="p-6 ">
        <div class="flex justify-between items-center">
            <div class="text-red-500 font-semibold text-4xl text-center pt-6 w-1/2">
                <span class="text-black"> Welcome, </span><?php echo $_SESSION['username']; ?>
                <div class="text-black font-semibold text-2xl p-2">
                    How can we help you today?
                </div>
                <button class="p-3    border border-red text-s rounded-3xl"><a href="./transplants.php">Transplants</a><button> 
                <button class="p-3   border border-red rounded-3xl"><a href="./organsuserpage.php">Show all organs</a><button> 
            </div>
            <div class="w-1/2 flex justify-center items-center">
                <img src="./images/welcome.jpg" alt="welcome" class="h-64" >
            </div>
        </div>
        
        <div class="flex justify-around pt-20">
            <div class="w-64 h-64 bg-black text-white rounded-3xl p-4">
               <img src="./images/patient.png" alt="patient" class="mx-auto pt-4">
               <h3 class="text-xl font-semibold text-center pt-4">Patients</h3>
               <div class="flex justify-center mt-6">
                    <button class="p-3 border border-white rounded-3xl"><a href="./patient.php">Got to patients</a><button> 
               </div>
            </div>
            <div class="w-64 h-64 bg-black text-white rounded-3xl p-4">
              <img src="./images/donor.png" alt="donor" class="mx-auto pt-4">
               <h3 class="text-xl font-semibold text-center pt-4">Donors</h3>
               <div class="flex justify-center mt-6">
                    <button class="p-3 border border-white rounded-3xl"><a href="./Donor.php">Got to Donors</a><button> 
               </div>
            </div>
            <div class="w-64 h-64 bg-black text-white rounded-3xl p-4">
                <img src="./images/doctor.png" alt="doctor" class="mx-auto pt-4">
               <h3 class="text-xl font-semibold text-center pt-4">Doctors</h3>
               <div class="flex justify-center mt-6">
                    <button class="p-3 border border-white rounded-3xl"><a href="./Doctor.php">Got to Doctors</a><button> 
               </div>
            </div>
            <div class="w-64 h-64 bg-black text-white rounded-3xl p-4">
                <img src="./images/hospital.png" alt="hospital" class="mx-auto pt-4">
               <h3 class="text-xl font-semibold text-center pt-4">Hospitals</h3>
               <div class="flex justify-center mt-6">
                    <button class="p-3 border border-white rounded-3xl"><a href="./Hospital.php">Got to Hospitals</a><button> 
               </div>
            </div>
            <div class="w-64 h-64 bg-black text-white rounded-3xl p-4">
               <img src="./images/admin.png" alt="admin" class="mx-auto pt-4">
               <h3 class="text-xl font-semibold text-center pt-4">New Admin</h3>
               <div class="flex justify-center mt-6">
                    <button class="p-3 border border-white rounded-3xl"><a href="./Signup.php">Add new admin</a><button> 
               </div>
            </div>
        </div>
    </main>
   
</body>
</html>