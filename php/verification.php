<?php 
  $user_id = 1270610524;
  $sql = "SELECT email, verification FROM users WHERE id = ?"
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $stmt->bind_result($email, $verification);
  $stmt->fetch();
  $stmt->close();
  $stmt->close();
?>