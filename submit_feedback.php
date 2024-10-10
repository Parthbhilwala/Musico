<?php
// submit_feedback.php

include('./db_connect.php');

session_start(); // Start the session

if (!isset($_SESSION['login_id'])) {
    header("location: login.php");
    exit;
}

if (isset($_POST['submit_feedback'])) {
    // Handle form submission
    $user_id = $_SESSION['login_id'];
    $feedback = $_POST['feedback'];
    $star_rating = $_POST['star_rating'];
    $like = isset($_POST['like']) ? 1 : 0;

    // Check if the user has already provided a rating
    $rating_query = "SELECT * FROM feedback WHERE user_id = '$user_id'";
    $rating_result = $conn->query($rating_query);
    if ($rating_result && $rating_result->num_rows > 0) {
        echo "<script>alert('You have already provided feedback.'); window.location.replace('index.php');</script>";
    } else {
        // Insert feedback into the database
        $query = "INSERT INTO feedback (user_id, feedback, star_rating, likes) VALUES ('$user_id', '$feedback', '$star_rating', '$like')";
        if ($conn->query($query)) {
            // Feedback submitted successfully
            echo "<script>alert('Feedback submitted successfully.'); window.location.replace('index.php');</script>";
        } else {
            // Error occurred while submitting feedback
            echo "<script>alert('Error submitting feedback. Please try again later.');</script>";
        }
    }
}
?>
