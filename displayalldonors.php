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
    <title>Donor</title>
</head>

<body>
    <header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
                <a href="Donor.php"><button type="button"
                        class=" ml-5 text-white bg-red-500 hover:bg-red-700 focus:ring-4 rounded-lg text-sm px-4 py-2 text-center inline-flex items-center">Back
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
    <h1 class="text-3xl font-bold mt-6 flex justify-center">Donors</h1>
	<div class="overflow-x-auto mr-8">
		<?php

			// Establish a connection with the database
			include "dbconnect.php";

			// Execute the SELECT query
			$result = mysqli_query($conn, "SELECT d.Donor_ID, d.first_name, d.last_name, d.age, d.Blood_group, d.medical_history, d.doctor, d.address, d.phone, n.First_name, n.last_name, n.Relation, n.Street, n.City, n.state FROM donor d, next_of_kin n WHERE d.Donor_ID=n.Donor_ID");


			// Create a table with Tailwind CSS classes
			echo '<table class="table-auto w-full border-collapse border border-gray-500 m-8 shadow-lg">';
			echo '<thead>
			<tr>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Donor ID</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">First Name</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Last Name</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Age</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Blood Group</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Medical History</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Doctor</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">City</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Phone Number</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Relative First Name</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Relative Last Name</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Relation</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">Street</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">City</th>
			<th class="px-4 py-2 bg-gray-200 border border-gray-500">State</th>



			</tr>
			</thead>';

			// Fetch rows from the result set and display data in table with Tailwind CSS classes
			echo '<tbody class="text-center">';
			while($row = mysqli_fetch_array($result)) {
				echo '<tr class="border border-gray-500">';
				echo '<td class="px-4 py-2">'.$row['Donor_ID'].'</td>';
				echo '<td class="px-4 py-2">'.$row['first_name'].'</td>';
				echo '<td class="px-4 py-2">'.$row['last_name'].'</td>';
				echo '<td class="px-4 py-2">'.$row['age'].'</td>';
				echo '<td class="px-4 py-2">'.$row['Blood_group'].'</td>';
				echo '<td class="px-4 py-2">'.$row['medical_history'].'</td>';
				echo '<td class="px-4 py-2">'.$row['doctor'].'</td>';
				echo '<td class="px-4 py-2">'.$row['address'].'</td>';
				echo '<td class="px-4 py-2">'.$row['phone'].'</td>';
				echo '<td class="px-4 py-2">'.$row['First_name'].'</td>';
				echo '<td class="px-4 py-2">'.$row['last_name'].'</td>';
				echo '<td class="px-4 py-2">'.$row['Relation'].'</td>';
				echo '<td class="px-4 py-2">'.$row['Street'].'</td>';
				echo '<td class="px-4 py-2">'.$row['City'].'</td>';
				echo '<td class="px-4 py-2">'.$row['state'].'</td>';


				echo '</tr>';
			}
			echo '</tbody>';

			echo "</table>";
		?>		
	</div>

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