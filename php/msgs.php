<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marsmessenger";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a way to get the current user's ID, e.g., from session
$user_id = 1; // Replace with the actual user ID

// Fetch unread messages
$sql = "SELECT id, incoming_msg_id, content, msg_at FROM messages WHERE incoming_msg_id = ? AND is_read = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$unread_messages = [];
while ($row = $result->fetch_assoc()) {
    $unread_messages[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($unread_messages);
?>
