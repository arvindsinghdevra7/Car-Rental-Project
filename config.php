<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindata12";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// वर्तमान समय और तारीख प्राप्त करने के लिए
date_default_timezone_set('Asia/Kolkata'); // भारतीय समय क्षेत्र सेट करें
$current_time = date('H:i:s');
$current_date = date('Y-m-d');
?> 