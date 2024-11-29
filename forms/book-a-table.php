<?php
// book-a-table.php

// Start the session (optional, if needed for further processing)
session_start();

// Database connection details
$host = 'localhost';
$dbname = 'u879180223_finalproj';
$username = 'u879180223_root';
$password = '2iE$w57Xzbv3+4e]qKvF';

// Create a connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


// Assuming the available time slots are stored in an array
$timeSlots = [
    '10:00:00',
    '11:00:00',
    '12:00:00',
    '13:00:00',
    '14:00:00',
    '15:00:00',
    '16:00:00',
    '17:00:00',
    '18:00:00',
    '19:00:00',
    '20:00:00'
];

// Optionally, check if the form has been submitted to process the selected time



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];
    $message = $_POST['message'];
    $status = $_POST['status'];

    // Prepare SQL query to insert data into the reservation table
    $sql = "INSERT INTO customers (name, email, contact, date, time, npeople, message, status) 
            VALUES (:name, :email, :phone, :date, :time, :people, :message, :status)";

    // Prepare statement
    $stmt = $pdo->prepare($sql);

    // Bind the parameters to prevent SQL injection
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':people', $people);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':status', $status);

    // Execute the query
    if ($stmt->execute()) {
        // Successfully inserted data
        echo "Your booking request has been submitted successfully!";
    } else {
        // Error in insertion
        echo "Sorry, there was an error while submitting your reservation.";
    }
}



