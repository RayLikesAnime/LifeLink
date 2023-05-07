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
                    <form action="./Login.php" method="post">
                         <input type="submit" name="Logout" value="Logout">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <!-- my code goes here -->
    <h1 class="text-center decoration-solid text-black text-3xl font-bold mt-10">Search Hospital</h1>
    <div class="container my-5  ">
        <form method="post" class="my-10 px-6 flex items-center justify-center">
            <input class="border-2 ml-14 px-4 py-3" type="text" placeholder="Enter City" name="search">
            <button class=" px-4 py-3 text-white bg-red-500 hover:bg-red-700  text-l px-4 py-2 " name="submit">Search</button>
        </form>
        <div class="container my-5 px-5 mx-4">
            <table class="table-auto w-full scroll-ml-3">
                <?php
                if(isset($_POST['submit'])){
                    $search=$_POST['search'];
                    $result = mysqli_query($conn, "SELECT * FROM hospital WHERE City='$search';");
                    if(mysqli_num_rows($result) > 0){

			// Create a table with Tailwind CSS classes
			echo '<table class="table-auto w-3/4 mx-auto my-4 border border-gray-500 m-8 shadow-lg">';
            // max-w-xs, max-w-sm, or max-w-md
			echo '<thead>
			<tr>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Hospital ID</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Hospital Name</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">City</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">State</th>


			</tr>
			</thead>';

			// Fetch rows from the result set and display data in table with Tailwind CSS classes
			echo '<tbody class="text-center">';
			while($row = mysqli_fetch_array($result)) {
				echo '<tr class="border border-gray-500">';
				echo '<td class="px-4 py-2">'.$row['Hospital_ID'].'</td>';
				echo '<td class="px-4 py-2">'.$row['Hospital_name'].'</td>';
				echo '<td class="px-4 py-2">'.$row['City'].'</td>';
				echo '<td class="px-4 py-2">'.$row['State'].'</td>';
				echo '</tr>';
			}
			echo '</tbody>';

			echo "</table>";}
            else{
                $message = "No Registered Hospitals in this city";
echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
                ?>                 
            </table>
        </div>
    </div>
</body>
</html>