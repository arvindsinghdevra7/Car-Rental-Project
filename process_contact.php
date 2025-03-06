<?php
$servername = "localhost";
$username = "root";  // आपका MySQL username
$password = "";      // आपका MySQL password
$dbname = "lovely_car123"; // आपके database का नाम

// डेटाबेस कनेक्शन बनाएं
$conn = new mysqli($servername, $username, $password, $dbname);

// कनेक्शन चेक करें
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// फॉर्म से डेटा प्राप्त करें
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// SQL क्वेरी तैयार करें और डेटा इन्सर्ट करें
$sql = "INSERT INTO contact_messages (name, email, message) 
        VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 