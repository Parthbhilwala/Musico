<?php
session_start();
include 'db_connect.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $user_id = $_SESSION['login_id']; // Assuming login_id is the user's ID

    // Insert the search history into the database
    $insert_query = "INSERT INTO search_history (user_id, keyword) VALUES ('$user_id', '$keyword')";
    if ($conn->query($insert_query) === TRUE) {
        echo "Search history saved successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
