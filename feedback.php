

<!-- Navbar -->
<nav class="main-header m-0 navbar navbar-expand navbar-dark border-primary">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <?php if (isset($_SESSION['login_id'])): ?>

    <?php endif; ?>
    <li class="nav-link">
      <a></a>
    </li>
    <li>
      <a class="nav-link text-gradient-primary" role="button">
        <large><b>Music </b></large>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a href="./index.php?page=home" class="nav-link nav-home d-flex justify-content-center align-baseline">
        <i class="nav-icon fas fa-home text-gradient-primary p-1"></i>

        <p>
          Home
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="./index.php?page=new_music"
        class=" ml-1 nav-link nav-new_music tree-item d-flex justify-content-center align-baseline">
        <i class="nav-icon fa fa-music text-gradient-primary p-1"></i>

        <p class="">Add Music</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="./index.php?page=music_list"
        class=" ml-1 nav-link nav-music_list tree-item d-flex justify-content-center align-baseline">
        <i class="nav-icon fa fa-music text-gradient-primary p-1"></i>

        <p class="">Music List</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="./index.php?page=playlist"
        class="nav-link nav-playlist tree-item d-flex justify-content-center align-baseline">
        <i class="fas fa-list nav-icon  text-gradient-primary p-1"></i>

        <p>Playlist</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="./index.php?page=genre_list"
        class="nav-link nav-genre_list tree-item d-flex justify-content-center align-baseline">
        <i class="fas fa-th-list nav-icon  text-gradient-primary p-1"></i>

        <p>Genre</p>
      </a>
    </li>
    <?php if ($_SESSION['login_type'] == 1): ?>
      <li class="nav-item">
        <a href="./index.php?page=Subscribers_list" class="nav-link nav-user_list tree-item">
        <p><i class="fas fa-crown nav-icon  text-gradient-primary p-1"></i> Subscribers</p>

        </a>
      </li>
    <?php endif; ?>
    <li class="nav-item">
      <a href="./index.php?page=feedback" class="nav-link nav-user_list tree-item">
      <p><i class="fas fa-comment-alt nav-icon  text-gradient-primary p-1"></i>feedback</p>
      </a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
        <span>
          <div class="d-flex badge-pill align-items-center bg-gradient-primary p-1"
            style="background: #337cca47 linear-gradient(180deg,#268fff17,#007bff66) repeat-x!important;border:50px">
            <?php if (isset($_SESSION['login_profile_pic']) && !empty($_SESSION['login_profile_pic'])): ?>
              <div class="rounded-circle mr-1" style="width: 25px;height: 25px;top:-5px;left: -40px">
                <img src="assets/uploads/<?php echo $_SESSION['login_profile_pic'] ?>"
                  class="image-fluid image-thumbnail rounded-circle" alt=""
                  style="max-width: calc(100%);height: calc(100%);">
              </div>
            <?php else: ?>
              <span class="fa fa-user mr-2"></span>
            <?php endif; ?>
            <span><b>
                <?php echo ucwords($_SESSION['login_firstname']) ?>
              </b></span>
            <span class="fa fa-angle-down ml-2"></span>
          </div>
        </span>
      </a>
      <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
        <button class="dropdown-item" type="button" id="my_profile"><i class="fa fa-id-card"></i> Profile</button>
        <button class="dropdown-item" type="button" id="manage_my_account"><i class="fa fa-cog"></i> Manage
          Account</button>


          <!-- <li class="nav-item"> -->
				<button class="dropdown-item" type="button"> <a href="./index.php?page=Search_history">
						<i class="fas fa-history" style="color:black;"></i>

						<span style="color:black; !important">History</span>
					</a>
				</button>
				<!-- </li> -->
          
        <button class="dropdown-item" onclick="location.href='ajax.php?action=logout'"><i class="fa fa-power-off"></i>
          Logout</button>
      </div>

    </li>
  </ul>
</nav>
<script>
  $('#manage_my_account').click(function () {
    uni_modal("Manage Account", "manage_account.php", "large")
  })
  $('#my_profile').click(function () {
    uni_modal("Profile", "view_user.php?id=<?php echo $_SESSION['login_id'] ?>")
  })
</script>
<!-- /.navbar -->
<script>
  $(document).ready(function () {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    if ($('.nav-link.nav-' + page).length > 0) {
      $('.nav-link.nav-' + page).addClass('active')
      console.log($('.nav-link.nav-' + page).hasClass('tree-item'))
      if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
      }
      if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
        $('.nav-link.nav-' + page).parent().addClass('menu-open')
      }

    }
    $('.manage_account').click(function () {
      uni_modal('Manage Account', 'manage_user.php?id=' + $(this).attr('data-id'))
    })
  })
</script>
<?php

// submit_feedback.php

include('./db_connect.php');

if(!isset($_SESSION['login_id'])){
    header("location: login.php");
    exit;
}

if(isset($_POST['submit_feedback'])){
    // Handle form submission
    $user_id = $_POST['user_id'];
    $feedback = $_POST['feedback'];
    $star_rating = $_POST['star_rating'];
    $like = isset($_POST['like']) ? 1 : 0;

// Check if the user has already provided a rating
$rating_query = "SELECT * FROM feedback WHERE user_id = '$user_id' AND star_rating = '$star_rating'";
$rating_result = $conn->query($rating_query);
if ($rating_result->num_rows > 0) {
    echo "<script>alert('You have already provided a rating for this feedback.');</script>";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
    <style>
        /* CSS for star rating */
        .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: center;
            font-size: 30px;
            margin-bottom: 20px;
        }
        .rating > label {
            display: inline-block;
            padding: 5px;
            color: #ccc;
            cursor: pointer;
        }
        .rating > input:checked ~ label,
        .rating > label:hover,
        .rating > label:hover ~ label {
            color: #ffcc00;
        }
        /* Additional CSS for form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            /* text-align: center; */
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: #dc3545;
            margin-top: -10px;
            margin-bottom: 10px;
        }


        
    </style>
</head>
<body>
<?php if ($_SESSION['login_type'] == 2): ?>
    <div class="container">
        <h1>Submit Feedback</h1>
        <a href="./index.php?page=home">Home</a>
        <form method="POST" action="submit_feedback.php" onsubmit="return validateForm()">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['login_id']; ?>">
            <label for="feedback">Feedback:</label>
            <textarea name="feedback" id="feedback" rows="5" placeholder="Enter your feedback here" required></textarea>
            <div class="rating" id="starRating">
                <input type="radio" id="star5" name="star_rating" value="5"><label for="star5">&#9733;</label>
                <input type="radio" id="star4" name="star_rating" value="4"><label for="star4">&#9733;</label>
                <input type="radio" id="star3" name="star_rating" value="3"><label for="star3">&#9733;</label>
                <input type="radio" id="star2" name="star_rating" value="2"><label for="star2">&#9733;</label>
                <input type="radio" id="star1" name="star_rating" value="1"><label for="star1">&#9733;</label>
            </div>
            <!-- <input type="checkbox" name="like" id="like"><label for="like">Like</label> -->
            <input type="submit" name="submit_feedback" value="Submit Feedback">
        </form>
    </div>
    <?php endif; ?>
    <script>
        function validateForm() {
            var feedback = document.getElementById("feedback").value;
            if (feedback.trim() == "") {
                alert("Feedback cannot be empty");
                return false;
            }
            var starRating = document.querySelectorAll('input[name="star_rating"]:checked').length;
            if (starRating == 0) {
                alert("Please select a star rating");
                return false;
            }
            return true;
        }
    </script>

<?php
include('./db_connect.php');



if (!isset($_SESSION['login_id'])) {
    header("location: login.php");
    exit;
}

// Define an array to store feedback ratios for each star rating
$feedback_ratios = [];

// Loop through each star rating (from 1 to 5)
for ($i = 1; $i <= 5; $i++) {
    // Query to get total feedback count for the current star rating
    $total_feedback_query = "SELECT COUNT(*) AS total_feedback FROM feedback WHERE star_rating = $i";
    $total_feedback_result = $conn->query($total_feedback_query);
    $total_feedback_count = $total_feedback_result->fetch_assoc()['total_feedback'];

    // Calculate ratio of feedback for the current star rating
    if ($total_feedback_count > 0) {
        $feedback_ratios[$i] = $total_feedback_count;
    } else {
        $feedback_ratios[$i] = 0; // Default to 0 if no feedback exists for this rating
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Ratios</title>
    <style>
        /* Your website's CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .feedback-ratios {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .feedback-ratio {
            flex: 1;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Feedback Ratios</h1>
        <div class="feedback-ratios">
            <?php
            // Display feedback ratios for each star rating
            for ($i = 1; $i <= 5; $i++) {
                echo "<div class='feedback-ratio'>Star Rating $i<br>Feedback Count: {$feedback_ratios[$i]}</div>";
            }     
            ?>
        </div>
    </div>
</body>
</html>


</body>
</html>
<style>
    /* CSS for the feedback display section */
    .review {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .review p {
        margin: 5px 0;
    }

    .review strong {
        font-weight: bold;
    }

    .rating {
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
        font-size: 20px;
    }

    .rating > span {
        display: inline-block;
        position: relative;
        width: 1.1em;
    }

    .rating > span.rated:before,
    .rating > span:hover:before,
    .rating > span.rated ~ span:before,
    .rating > span:hover ~ span:before {
        content: "\2605";
        position: absolute;
        color: gold;
    }

    .rating > span:hover ~ span:before {
        content: "\2606";
    }
</style>


<div class="review-container">
    <h2>Recent Reviews</h2>
    <?php
    // Fetch reviews from the database
    $sql_fetch_reviews = "SELECT users.email, feedback.star_rating, feedback.feedback, feedback.id, feedback.user_id FROM feedback INNER JOIN users ON feedback.user_id = users.id";
    $result_reviews = $conn->query($sql_fetch_reviews);
    if ($result_reviews->num_rows > 0) {
        while($row = $result_reviews->fetch_assoc()) {
            echo '<div class="review">';
            echo '<p><strong>Email:</strong> ' . $row["email"] . '</p>';
            echo '<p><strong>Rating:</strong> ';
            for ($i = 0; $i < $row["star_rating"]; $i++) {
                echo '&#9733;';
            }
            echo '</p>';
            echo '<p><strong>Feedback:</strong> ' . $row["feedback"] . '</p>';
            // Add delete button (for admins or users who own the feedback)
            if ($_SESSION['login_type'] == 1 || (isset($row['user_id']) && $_SESSION['login_id'] == $row['user_id'])) {
                echo "<form method='POST'>";
                echo "<input type='hidden' name='review_id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='delete'>Delete</button>";
                echo "</form>";
            }
            echo '</div>';
        }
    } else {
        echo "<p>No reviews found.</p>";
    }
    ?>
</div>
</body>
</html>

<?php
// Handle review deletion
if(isset($_POST['delete'])) {
    $review_id = $_POST['review_id'];
    $delete_query = "DELETE FROM feedback WHERE id = $review_id";
    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Review deleted successfully');</script>";
        // Refresh the page after deletion
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error deleting review: " . $conn->error;
    }
}
?>
