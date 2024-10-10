<?php
session_start();
include 'db_connect.php'; // Assuming you have a file named db_connect.php for database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_id'])) {
    $search_id = $_POST['search_id'];
    
    // Check if the user is an admin or the owner of the search record
    if ($_SESSION['login_type'] == 1 || isOwner($search_id, $_SESSION['login_id'])) {
        // Delete the search record
        $delete_query = "DELETE FROM search_history WHERE id = $search_id";
        if ($conn->query($delete_query) === TRUE) {
            echo "Search record deleted successfully";
            // Add JavaScript to refresh the page after a short delay
            echo '<script>setTimeout(function(){location.reload()}, 1000);</script>';
        } else {
            echo "Error deleting search record: " . $conn->error;
        }
    } else {
        echo "You are not authorized to delete this search record.";
    }
} else {
    echo "Invalid request.";
}

function isOwner($search_id, $user_id) {
    global $conn;
    $check_query = "SELECT * FROM search_history WHERE id = $search_id AND user_id = $user_id";
    $result = $conn->query($check_query);
    return ($result->num_rows > 0);
}
?>
