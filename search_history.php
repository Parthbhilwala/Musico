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
				<button class="dropdown-item" type="button" id="my_profile"><i class="fa fa-id-card"></i>
					Profile</button>
				<button class="dropdown-item" type="button" id="manage_my_account"><i class="fa fa-cog"></i> Manage
					Account</button>




				<!-- <li class="nav-item"> -->
				<button class="dropdown-item" type="button"> <a href="./index.php?page=Search_history">
						<i class="fas fa-history" style="color:black;"></i>

						<span style="color:black; !important">History</span>
					</a>
				</button>
				<!-- </li> -->






				<button class="dropdown-item" onclick="location.href='ajax.php?action=logout'"><i
						class="fa fa-power-off"></i>
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



<?php
include 'db_connect.php'; // Assuming you have a file named db_connect.php for database connection

// Check if the user is an admin
if ($_SESSION['login_type'] == 1) {
	// User is an admin, fetch all search history data from the database with the associated usernames
	$query = "SELECT sh.*, u.email FROM search_history sh LEFT JOIN users u ON sh.user_id = u.id ORDER BY sh.created_at DESC";
} else {
	// User is not an admin, fetch only the user's own search history
	$user_id = $_SESSION['login_id'];
	$query = "SELECT * FROM search_history WHERE user_id = $user_id ORDER BY created_at DESC";
}

$result = $conn->query($query);

// Check if there are any search history records
if ($result->num_rows > 0) {
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Search History</title>
		<style>
			body {
				font-family: Arial, sans-serif;
				background-color: #f0f0f0;
				padding: 20px;
			}

			.container {
				max-width: 800px;
				margin: 0 auto;
				background-color: #fff;
				padding: 20px;
				border-radius: 5px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			}

			h1 {
				/* text-align: center; */
				margin-bottom: 20px;
			}

			table {
				width: 100%;
				border-collapse: collapse;
			}

			table th,
			table td {
				padding: 10px;
				border-bottom: 1px solid #ddd;
				text-align: left;
				background-color: #f2f2f2;
			}

			table th {
				background-color: #f2f2f2;
			}

			.datetime {
				white-space: nowrap;
			}
		</style>
		<script>
			function confirmDelete() {
				return confirm("Are you sure you want to delete this search history?");
			}
		</script>
	</head>

	<body style="padding: 0px;">
		<!-- <h2>Search History</h2> -->
		<table>
			<thead>
				<tr>
					<th>Keyword</th>
					<th>Date</th>
					<?php if ($_SESSION['login_type'] == 1): ?>
						<th>Username</th>
					<?php endif; ?>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Loop through search history records and display them
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row['keyword'] . "</td>";
					echo "<td>" . $row['created_at'] . "</td>";
					// Display username only if user is an admin
					if ($_SESSION['login_type'] == 1) {
						echo "<td>" . $row['email'] . "</td>";
					}
					echo "<td><form method='POST' onsubmit='return confirmDelete();'><input type='hidden' name='history_id' value='" . $row['id'] . "'><button type='submit' name='delete'>Delete</button></form></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</body>

	</html>
	<?php
} else {
	echo "No search history found.";
}

// Handle deletion
if (isset($_POST['delete'])) {
	$history_id = $_POST['history_id'];
	$delete_query = "DELETE FROM search_history WHERE id = $history_id";
	if ($conn->query($delete_query) === TRUE) {
		echo "<script>alert('Search history deleted successfully');</script>";
		// Refresh the page after deletion
		echo "<meta http-equiv='refresh' content='0'>";
	} else {
		echo "Error deleting record: " . $conn->error;
	}
}
?>