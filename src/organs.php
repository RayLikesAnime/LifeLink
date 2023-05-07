<?php
// Check if user is logged in and has a valid session
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ./Login.php");
    exit;
}

// Check if logout button is clicked
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    setcookie(session_name(), '', 1, '/');
    header("Location: ./Login.php");
    exit;
}

// Establish a connection with the database
include "dbconnect.php";

// Fetch all available organs from the database
$organs_query = mysqli_query($conn, "SELECT DISTINCT organ FROM organs WHERE `status`='YES';");
$organs = mysqli_fetch_all($organs_query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Organs Availables</title>
</head>
<body>
    <header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
                <a href="organsuserpage.php"><button type="button"
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
    <h1 class="text-3xl font-bold mt-6 flex justify-center">Organs Available</h1>

    <div class="mt-8 flex justify-center">
        <form action="organs.php" method="get">
            <label for="organ" class="mr-2">Select an organ:</label>
            <select name="organ" id="organ" class="p-2 rounded-md border-gray-500 border-2">
                <option value="">All Organs</option>
                <?php foreach ($organs as $organ): ?>
                    <option value="<?php echo $organ['organ']; ?>"><?php echo $organ['organ']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filter
            </button>
        </form>
    </div>

    <div class="overflow-x-auto mr-8">
        <?php
        // Check if a specific organ was selected
        if (isset($_GET['organ']) && !empty($_GET['organ'])) {
            $organ = mysqli_real_escape_string($conn, $_GET['organ']);
            $query = "SELECT * FROM organs NATURAL JOIN donor WHERE organ = '$organ' AND `status`='YES' ";
			$result = mysqli_query($conn, $query);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows > 0) {
				// Display patients in a table
				echo '<table class="table-auto w-full border-collapse border border-gray-500 m-8 shadow-lg">';
				echo '<thead>
				<tr>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Donor ID</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Organ</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">First Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Last Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Age</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Blood Group</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Medical History</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Doctor</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">City</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Phone Number</th>
				</tr>
				</thead>';
	
				// Fetch rows from the result set and display data in table with Tailwind CSS classes
				echo '<tbody class="text-center">';
				while($row = mysqli_fetch_array($result)) {
					echo '<tr class="border border-gray-500">';
					echo '<td class="px-4 py-2">'.$row['Donor_id'].'</td>';
					echo '<td class="px-4 py-2">'.$row['organ'].'</td>';
					echo '<td class="px-4 py-2">'.$row['first_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['last_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['age'].'</td>';
					echo '<td class="px-4 py-2">'.$row['Blood_group'].'</td>';
					echo '<td class="px-4 py-2">'.$row['medical_history'].'</td>';
					echo '<td class="px-4 py-2">'.$row['doctor'].'</td>';
					echo '<td class="px-4 py-2">'.$row['address'].'</td>';
					echo '<td class="px-4 py-2">'.$row['phone'].'</td>';
	
					echo '</tr>';
				}
				echo '</tbody>';
	
				echo "</table>";
			}
			else if($num_rows ==0) {
				$message = "no organs available";
echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		else{
			//print all organs
			
            // $organ = mysqli_real_escape_string($conn, $_GET['organ']);
            $query = "SELECT * FROM organs NATURAL JOIN donor WHERE status='YES';";
			$result = mysqli_query($conn, $query);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows > 0) {
				// Display donor in a table
				echo '<table class="table-auto w-full border-collapse border border-gray-500 m-8 shadow-lg">';
				echo '<thead>
				<tr>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Donor ID</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Organ</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">First Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Last Name</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Age</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Blood Group</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Medical History</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Doctor</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">City</th>
				<th class="px-4 py-2 bg-gray-200 border border-gray-500">Phone Number</th>
				</tr>
				</thead>';
	
				// Fetch rows from the result set and display data in table with Tailwind CSS classes
				echo '<tbody class="text-center">';
				while($row = mysqli_fetch_array($result)) {
					echo '<tr class="border border-gray-500">';
					echo '<td class="px-4 py-2">'.$row['Donor_id'].'</td>';
					echo '<td class="px-4 py-2">'.$row['organ'].'</td>';
					echo '<td class="px-4 py-2">'.$row['first_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['last_name'].'</td>';
					echo '<td class="px-4 py-2">'.$row['age'].'</td>';
					echo '<td class="px-4 py-2">'.$row['Blood_group'].'</td>';
					echo '<td class="px-4 py-2">'.$row['medical_history'].'</td>';
					echo '<td class="px-4 py-2">'.$row['doctor'].'</td>';
					echo '<td class="px-4 py-2">'.$row['address'].'</td>';
					echo '<td class="px-4 py-2">'.$row['phone'].'</td>';
	
					echo '</tr>';
				}
				echo '</tbody>';
	
				echo "</table>";
			}
			else{
				$message = "no organs available";
echo "<script type='text/javascript'>alert('$message');</script>";
			}
			// mysqli_close($conn);
		}
		mysqli_close($conn);
		?>
    </div>
</body>

</html>