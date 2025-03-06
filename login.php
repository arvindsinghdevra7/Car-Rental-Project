<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullname'] = $user['fullname'];
            
            echo "<script>
                localStorage.setItem('isLoggedIn', 'true');
                window.location.href='index.html';
            </script>";
        } else {
            echo "<script>
                alert('Invalid password!');
                window.location.href='login.html';
            </script>";
        }
    } else {
        echo "<script>
            alert('User not found!');
            window.location.href='login.html';
        </script>";
    }
}
?> 