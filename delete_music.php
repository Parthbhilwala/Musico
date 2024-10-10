<?php
// Include the database connection
include 'db_connect.php';

// Check if the music_id parameter is set and not empty
if (isset($_POST['music_id']) && !empty($_POST['music_id'])) {
    // Sanitize the input to prevent SQL injection
    $music_id = $_POST['music_id'];

    // Perform the deletion of the music item from the playlist
    $delete_query = $conn->prepare("DELETE FROM playlist_items WHERE music_id = ?");
    $delete_query->bind_param("i", $music_id);

    if ($delete_query->execute()) {
        // Deletion successful
        echo json_encode(array('status' => 'success', 'message' => 'Music item deleted successfully.'));
        exit;
    } else {
        // Error occurred during deletion
        echo json_encode(array('status' => 'error', 'message' => 'Failed to delete music item. Please try again later.'));
        exit;
    }
} else {
    // Invalid or missing music_id parameter
    echo json_encode(array('status' => 'error', 'message' => 'Invalid music ID.'));
    exit;
}
?>
