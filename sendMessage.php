<?php
// sendMessage.php
require 'connection.php';

// Get the data from the POST request (AJAX)
$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$message = $_POST['message'];

// Insert the message into the database
$query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)";
$stmt = $pdo->prepare($query);
$stmt->execute(['sender_id' => $sender_id, 'receiver_id' => $receiver_id, 'message' => $message]);

// Return success message
echo 'Message sent';
?>
