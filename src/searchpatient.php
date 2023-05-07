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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Patient</title>
</head>

<body>
    <header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
                <a href="patient.php"><button type="button"
                        class=" ml-5 text-white bg-red-500 hover:bg-red-700 focus:ring-4 rounded-lg text-sm px-4 py-2 text-center inline-flex items-center">Back
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
    <h1 class="text-3xl font-bold mt-6 flex justify-center">Search Patient</h1>
    <div class="flex items-center justify-center mt-10">
        <form action="./searchpatient.php" method="post" class="my-10">
            <div class="flex flex-col rounded-2">
                <input class="py-3 px-4  text-gray-800  border-2" type="text" name="first_name"
                    placeholder="Enter First Name">
                <input class="py-3 px-4 mt-2 text-gray-800  border-2" type="text" name="last_name"
                    placeholder="Enter Last Name">
                <button class="py-3 px-4 mt-4 bg-red-500 hover:bg-red-700 text-gray-100" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="flex items-center justify-center">
    <a href="searchpatientbyorgan.php"><button type="button"
                        class=" text-white bg-red-500 hover:bg-red-700 focus:ring-4 rounded-lg text-sm px-8 py-4 text-center inline-flex items-center">Search By Organ
                    </button></a></div>
    <div class="container my-5 px-5 mx-4">
        <table class="table-auto w-full scroll-ml-3">
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    include "dbconnect.php";
                    $first_name=$_POST['first_name'];
                    $last_name=$_POST['last_name'];
                    $sql="Select * from `patient` where (`first_name`='$first_name' AND `last_name`='$last_name'); ";
                    $result=mysqli_query($conn, $sql);
                    if($result){
                        if(mysqli_num_rows($result) > 0){
                            echo'<thead>
                            <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">First name</th>
                            <th class="border px-4 py-2">Second name</th> 
                            <th class="border px-4 py-2">Age</th> 
                            <th class="border px-4 py-2">Blood group</th> 
                            <th class="border px-4 py-2">Medical history</th> 
                            <th class="border px-4 py-2">Doctor operated</th> 
                            <th class="border px-4 py-2">Address 1</th> 
                            <th class="border px-4 py-2">Address 2</th> 
                            <th class="border px-4 py-2">Address 3</th> 
                            <th class="border px-4 py-2">Phone number</th> 
                            </tr>
                            </thead>
                            ';
                            echo'<tbody>';
                            while($row = mysqli_fetch_array($result)){
                            echo'<tr>
                            <td class="border px-4 py-2">'.$row['Patient_ID'].'</td>
                            <td class="border px-4 py-2">'.$row['first_name'].'</td>
                            <td class="border px-4 py-2">'.$row['last_name'].'</td>
                            <td class="border px-4 py-2">'.$row['age'].'</td>
                            <td class="border px-4 py-2">'.$row['Blood_group'].'</td>
                            <td class="border px-4 py-2">'.$row['medical_history'].'</td>
                            <td class="border px-4 py-2">'.$row['doctor'].'</td>
                            <td class="border px-4 py-2">'.$row['address'].'</td>
                            <td class="border px-4 py-2">'.$row['address2'].'</td>
                            <td class="border px-4 py-2">'.$row['address3'].'</td>
                            <td class="border px-4 py-2">'.$row['phone'].'</td>
                            </tr>';
                            }
                             echo '</tbody>';
                            echo "</table>";
                        }
                        else{
                            echo'
                            <h2 class=text-danger>Data not found</h2>
                            ';
                        }
                    }
                }
                ?>
        </table>

    </div>

</body>

</html>