<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

// Add debugging
echo "<pre>";
echo "POST Data received:\n";
print_r($_POST);
echo "</pre>";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        
        // Insert into database
        $sql = "INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $message);
        
        if ($stmt->execute()) {
            echo "<script>
                alert('Thank you for contacting us! We will get back to you soon.');
                window.location.href='index.html';
            </script>";
        } else {
            throw new Exception("Error executing query: " . $stmt->error);
        }
        
        $stmt->close();
    } else {
        echo "Invalid request method";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?> 