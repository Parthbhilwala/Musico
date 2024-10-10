<?php
// add_comment.php

// Check if the request is coming via AJAX
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    http_response_code(403);
    exit('Forbidden');
}

// Check if user is logged in
session_start();
if (!isset($_SESSION['login_id'])) {
    http_response_code(401);
    exit('Unauthorized');
}

// Include database connection
include 'db_connect.php';

// Validate input
if (!isset($_POST['music_id']) || !isset($_POST['comment'])) {
    http_response_code(400);
    exit('Missing parameters');
}

$musicId = $_POST['music_id'];
$comment = $_POST['comment'];

// Insert comment into the database
$stmt = $conn->prepare("INSERT INTO comments (music_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iis", $musicId, $_SESSION['login_id'], $comment);

if ($stmt->execute()) {
    echo 'success';
} else {
    http_response_code(500);
    echo 'Error occurred while adding comment.';
}

$stmt->close();
$conn->close();
?>
