<?php
// Check if user is logged in and has a valid session
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

// Establish a connection with the database
include "dbconnect.php";

// Fetch all available organs from the database
$hospital_query = mysqli_query($conn, "SELECT DISTINCT Hospital_name FROM doctor NATURAL JOIN hospital");
$hospitals = mysqli_fetch_all($hospital_query, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Doctor Search by Department</title>
</head>

<body>
    <header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
                <a href="searchDoctorOption.php"><button type="button"
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
    <h1 class="text-3xl font-bold mt-6 flex justify-center">Search Doctor</h1>
    <div class="mt-8 flex justify-center">
        <form action="searchDocHospital.php" method="get">
        <label for="hospital" class="mr-2">Select Hospital</label>
            <select name="hospital" id="hospital" class="p-2 rounded-md border-gray-500 border-2">
                <option value="">All Hospitals</option>
                <?php foreach ($hospitals as $hospital): ?>
                <option value="<?php echo $hospital['Hospital_name']; ?>"><?php echo $hospital['Hospital_name']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filter
            </button>
        </form>
    </div>

    <div class="mr-16">
        <?php
        // Check if a specific organ was selected
        if ((isset($_GET['hospital']) && !empty($_GET['hospital']))) {
            $hospital = mysqli_real_escape_string($conn, $_GET['hospital']);
            $query = "SELECT * FROM `doctor` NATURAL JOIN `hospital`  WHERE  Hospital_name = '$hospital' ";
			$result = mysqli_query($conn, $query);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows > 0) {
				// Display patients in a table
				echo '<table class="table-auto w-full border-collapse border border-gray-500 m-8 shadow-lg">';
				echo '<thead>
				<tr>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Doctor ID</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">First Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Last Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Department Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Hospital ID</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Phone Number</th>
                <th class="px-4 py-2 bg-gray-200 border border-gray-500">Hospital Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">City</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">State</th>
				</tr>
				</thead>';
	
				// Fetch rows from the result set and display data in table with Tailwind CSS classes
				echo '<tbody class="text-center">';
				while($row = mysqli_fetch_array($result)) {
					echo '<tr class="border border-gray-500">';
					echo '<td class="px-4 py-2">'.$row['Doctor_ID'].'</td>';
					echo '<td class="px-4 py-2">'.$row['first_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['last_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['department_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['hospital_id'].'</td>';
					echo '<td class="px-4 py-2">'.$row['phone_number'].'</td>';
                    echo '<td class="px-4 py-2">'.$row['Hospital_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['City'].'</td>';
					echo '<td class="px-4 py-2">'.$row['State'].'</td>';
	
					echo '</tr>';
				}
				echo '</tbody>';
	
				echo "</table>";
			}
			else if($num_rows ==0) {
				echo '<p class ="text-center m-8" >Organ Not Yet Required</p>';
			}
		}
		else{
			//print all organs
			
            // $organ = mysqli_real_escape_string($conn, $_GET['organ']);
            $query = "SELECT * FROM `doctor` NATURAL JOIN `hospital`";
			$result = mysqli_query($conn, $query);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows > 0) {
				// Display patients in a table
				echo '<table class="table-auto w-full border-collapse border border-gray-500 m-8 shadow-lg">';
				echo '<thead>
				<tr>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Doctor ID</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">First Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Last Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Department Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Hospital ID</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Phone Number</th>
                <th class="px-4 py-2 bg-gray-200 border border-gray-500">Hospital Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">City</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">State</th>
				</tr>
				</thead>';
	
				// Fetch rows from the result set and display data in table with Tailwind CSS classes
				echo '<tbody class="text-center">';
				while($row = mysqli_fetch_array($result)) {
					echo '<tr class="border border-gray-500">';
					echo '<td class="px-4 py-2">'.$row['Doctor_ID'].'</td>';
					echo '<td class="px-4 py-2">'.$row['first_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['last_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['department_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['hospital_id'].'</td>';
					echo '<td class="px-4 py-2">'.$row['phone_number'].'</td>';
                    echo '<td class="px-4 py-2">'.$row['Hospital_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['City'].'</td>';
					echo '<td class="px-4 py-2">'.$row['State'].'</td>';
					echo '</tr>';
				}
				echo '</tbody>';
	
				echo "</table>";
			}
			mysqli_close($conn);
		}
		?>
    </div>
</body>

</html>