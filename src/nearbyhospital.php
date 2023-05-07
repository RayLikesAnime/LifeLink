<!-- <?php
// Get the user's location data
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

// Set up the API request URL
$api_url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?';
$api_url .= 'location=' . $latitude . ',' . $longitude;
$api_url .= '&radius=5000'; // search radius of 5 km
$api_url .= '&type=hospital';
$api_url .= '&key=YOUR_API_KEY'; // replace with your Google Maps API key

// Make the API request
$response = file_get_contents($api_url);
$data = json_decode($response, true);

// Loop through the results and display the hospital information
foreach ($data['results'] as $result) {
    echo '<p>Name: ' . $result['name'] . '</p>';
    echo '<p>Address: ' . $result['vicinity'] . '</p>';
    echo '<p>Phone: ' . $result['formatted_phone_number'] . '</p>';
}
?> -->
<!DOCTYPE html>
<html>
<head>
	<title>Get User Location</title>
	<script>
		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition);
			} else {
				alert("Geolocation is not supported by this browser.");
			}
		}

		function showPosition(position) {
			var latitude = position.coords.latitude;
			var longitude = position.coords.longitude;
			document.getElementById("latitude").value = latitude;
			document.getElementById("longitude").value = longitude;
		}
	</script>
</head>
<body onload="getLocation()">
	<form>
		<label for="latitude">Latitude:</label>
		<input type="text" id="latitude" name="latitude" readonly><br>

		<label for="longitude">Longitude:</label>
		<input type="text" id="longitude" name="longitude" readonly><br>
	</form>
</body>
</html>

