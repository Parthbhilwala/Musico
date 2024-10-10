<?php
// get_comments.php

// Include database connection
include 'db_connect.php';

// Validate input
if (!isset($_GET['music_id'])) {
    http_response_code(400);
    exit('Missing parameter');
}

$musicId = $_GET['music_id'];

// Fetch comments for the specified music ID
$stmt = $conn->prepare("SELECT c.comment, u.email FROM comments c JOIN users u ON c.user_id = u.id WHERE c.music_id = ?");
$stmt->bind_param("i", $musicId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output comments as HTML
    while ($row = $result->fetch_assoc()) {
?>
        <div class="comment">
            <strong><?php echo htmlspecialchars($row['email']); ?>:</strong><br> <?php echo htmlspecialchars($row['comment']); ?>
        </div>
<?php
    }
} else {
?>
    <div class="no-comments">No comments yet.</div>
<?php
}

$stmt->close();
$conn->close();
?>
