

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-info p {
            font-size: 16px;
            color: #555;
        }
        .profile-info p strong {
            font-weight: bold;
            margin-right: 10px;
            color: #333;
        }
        .btn {
            transition: background-color 0.3s ease;
        }
        .btn.back {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn.back:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php
        // Include necessary files and initialize session if required
        include_once "db_connect.php";

        // Check if user ID is provided in the URL
        if(isset($_GET['id'])) {
            $user_id = $_GET['id'];

            // Fetch user information from the database based on the user ID
            // You may need to modify this query according to your database schema
            $user_query = $conn->query("SELECT * FROM users WHERE id = $user_id");

            // Check if user exists
            if($user_query->num_rows > 0) {
                $user = $user_query->fetch_assoc();
        ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center">
                    <img src="assets/uploads/<?php echo $user['profile_pic']; ?>" class="profile-picture" alt="Profile Picture">
                    <h1 class="mt-3"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h1>
                </div>
                <div class="profile-info mt-4">
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
                    <p><strong>Gender:</strong> <?php echo ucfirst($user['gender']); ?></p>
                    <p><strong>Contact:</strong> <?php echo $user['contact']; ?></p>
                    <!-- Add more user information fields as needed -->
                </div>
            </div>
        </div>
        <!-- Add more HTML content for user profile display -->
        <?php
            } else {
                // Handle case where user does not exist
                echo "<p class='text-danger text-center'>User not found.</p>";
            }
        } else {
            // Handle case where user ID is not provided in the URL
            echo "<p class='text-danger text-center'>User ID not provided.</p>";
        }
        ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 text-center">
                <a href="./index.php?page=music_list" class="btn btn-back">Back to Profiles</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
