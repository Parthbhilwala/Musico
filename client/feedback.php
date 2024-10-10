<?php 

include('./db_connect.php');

if(!isset($_SESSION['login_id'])){
    header("location: login.php");
    exit;
}

if(isset($_POST['submit_feedback'])){
    // Handle form submission
    $feedback = $_POST['feedback'];
    $star_rating = $_POST['star_rating'];
    $like = isset($_POST['like']) ? 1 : 0;

    // Insert feedback into the database
    $user_id = $_SESSION['login_id'];
    $query = "INSERT INTO feedback (user_id, feedback, star_rating, likes) VALUES ('$user_id', '$feedback', '$star_rating', '$like')";
    if($conn->query($query)){
        // Feedback submitted successfully
        echo "<script>alert('Feedback submitted successfully.'); window.location.replace('index.php');</script>";
    } else {
        // Error occurred while submitting feedback
        echo "<script>alert('Error submitting feedback. Please try again later.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
    <!-- Include necessary CSS/JS files here -->
</head>
<body>
    <h1>Submit Feedback111</h1>
    <form method="POST">
    <textarea name="feedback" rows="5" cols="40" placeholder="Enter your feedback here" required></textarea><br><br>
    <label for="star_rating">Star Rating:</label>
    <input type="number" name="star_rating" id="star_rating" min="1" max="5" required><br><br>
    <label for="like">Like:</label>
    <input type="checkbox" name="like" id="like"><br><br>
    <input type="submit" name="submit_feedback" value="Submit Feedback">
</form>

</body>
</html>
