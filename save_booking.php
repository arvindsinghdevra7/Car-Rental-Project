<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pickup_location = $_POST['pickup_location'];
    $drop_location = $_POST['drop_location'];
    $car_name = $_POST['car_name'];
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];
    $message = $_POST['message'];
    
    // Insert into database
    $sql = "INSERT INTO booking_details (name, email, phone, pickup_location, drop_location, car_name, pickup_date, return_date, message) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $name, $email, $phone, $pickup_location, $drop_location, $car_name, $pickup_date, $return_date, $message);
    
    if ($stmt->execute()) {
        // Success message
        echo "<script>
            alert('Booking successful! We will contact you soon.');
            window.location.href='index.html';
        </script>";
    } else {
        // Error message
        echo "<script>
            alert('Error: Something went wrong. Please try again.');
            window.location.href='index.html';
        </script>";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}
?> 