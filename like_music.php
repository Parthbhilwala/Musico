<?php
session_start();
include 'db_connect.php';

if(isset($_SESSION['login_id'])) {
    $musicId = $_POST['music_id'];
    $userId = $_SESSION['login_id'];

    // Check if the user already liked the music
    $stmt = $conn->prepare("SELECT * FROM likes WHERE music_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $musicId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        // If user hasn't liked the music, insert a new like
        $stmt = $conn->prepare("INSERT INTO likes (music_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $musicId, $userId);
        if($stmt->execute()) {
            echo 'success'; // Return success response
        } else {
            echo 'error'; // Return error response
        }
    } else {
        echo 'already_liked'; // Return response indicating the user already liked the music
    }

    $stmt->close();
} else {
    echo 'not_logged_in'; // Return response indicating the user is not logged in
}
?>
