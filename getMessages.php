<?php
// getMessages.php
require 'connection.php';

// Fetch the sender and receiver IDs from the request (AJAX)
$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];

// Query to get messages between sender and receiver
$query = "SELECT * FROM messages WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) OR (sender_id = :receiver_id AND receiver_id = :sender_id) ORDER BY timestamp ASC";
$stmt = $pdo->prepare($query);
$stmt->execute(['sender_id' => $sender_id, 'receiver_id' => $receiver_id]);

// Fetch all messages
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return messages as JSON
echo json_encode($messages);
?>
