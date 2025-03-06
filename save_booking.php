<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindata12";

// डेटाबेस कनेक्शन
$conn = new mysqli($servername, $username, $password, $dbname);

// कनेक्शन चेक
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Remove existing headers and add only these
header('Content-Type: application/json');

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pickup_location = isset($_POST['pickup_location']) ? $_POST['pickup_location'] : '';
        $drop_location = isset($_POST['drop_location']) ? $_POST['drop_location'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $car_model = isset($_POST['car_model']) ? $_POST['car_model'] : '';

        // Validate data
        if (empty($pickup_location) || empty($drop_location) || empty($date) || empty($time) || empty($car_model)) {
            throw new Exception("All fields are required");
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO bookings (pickup_location, drop_location, booking_date, booking_time, car_model) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $pickup_location, $drop_location, $date, $time, $car_model);
        
        if ($stmt->execute()) {
            $response = array(
                "success" => true,
                "message" => "Booking successful",
                "driver" => array(
                    "name" => "Rajesh Kumar",
                    "phone" => "+91 98765 43210",
                    "rating" => "4.8",
                    "image" => "img/driver-1.jpg"
                ),
                "vehicle" => array(
                    "model" => $car_model,
                    "color" => "White",
                    "number" => "RJ 27 CA 1234",
                    "eta" => "10 mins"
                )
            );
            echo json_encode($response);
        } else {
            throw new Exception("Error in booking: " . $stmt->error);
        }
        $stmt->close();
    } else {
        throw new Exception("Invalid request method");
    }
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}

$conn->close();
?> 