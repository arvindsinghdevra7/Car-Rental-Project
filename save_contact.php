<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Insert into database
    $sql = "INSERT INTO contacts (name, email, subject, message) 
            VALUES (?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    
    if ($stmt->execute()) {
        // Success message
        echo "<script>
            alert('Message sent successfully! We will contact you soon.');
            window.location.href='index.html';
        </script>";
    } else {
        // Error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method";
}
?> 