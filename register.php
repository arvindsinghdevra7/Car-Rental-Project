<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

    // Check if username already exists
    $check_sql = "SELECT * FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
            alert('Username already exists! Please choose another username.');
            window.location.href='register.html';
        </script>";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (fullname, email, phone, username, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $fullname, $email, $phone, $username, $password);

        if ($stmt->execute()) {
            echo "<script>
                alert('Registration successful! Please login.');
                window.location.href='login.html';
            </script>";
        } else {
            echo "<script>
                alert('Error occurred. Please try again.');
                window.location.href='register.html';
            </script>";
        }
    }
}
?> 