<style>
	p {
		color: white !important;
	}

	.bg-new {
		background-color: #4949a6;
	}

	.brand-link {
		border-bottom: 1px solid #c6c6c6 !important;
	}
</style>





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
						style="background: #337cca47 linear-gradient(180deg,#268fff17,#007bff66) repeat-x!important;bprder:50px">
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
			<div class="dropdown-menu" aria-labelledby="account_settings" style=" left: -2.5em; ">
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




<script>
	$(document).ready(function () {
		var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
		if ($('.nav-link.nav-' + page).length > 0) {
			$('.nav-link.nav-' + page).addClass('active')
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

<?php include 'db_connect.php' ?>
<style>
	.playlist-item:hover {
		background: rgb(110, 109, 109);
		background: radial-gradient(circle, rgba(110, 109, 109, 1) 0%, rgba(55, 54, 54, 1) 23%, rgba(28, 27, 27, 1) 56%);
	}
</style>
<div class="col-lg-12">
	<div class="d-flex justify-content-between align-items-center w-100">
		<div class="form-group" style="width:calc(50%) ">
			<div class="input-group">
				<input type="search" id="filter" class="form-control form-control-sm"
					placeholder="Search playlist using keyword">
				<div class="input-group-append">
					<button type="button" id="search" class="btn btn-sm btn-dark">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
		</div>
		<button class="btn btn-sm btn-primary bg-gradient-primary" type="button" id="manage_playlist"><i
				class="fa fa-plus"></i> Add New Playlist</button>
	</div>
	<div class="row" id="playlist-list">
		<?php
		$playlist = $conn->query("SELECT * FROM playlist where user_id = '{$_SESSION['login_id']}' order by title asc");
		while ($row = $playlist->fetch_assoc()):
			?>
			<div class="card bg-black playlist-item my-2 mx-1" id="card1" date-id="<?php echo $row['id'] ?>"
				style="width:15vw">
				<div class="card-img-top flex-w-100 position-relative">
					<?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_id'] == $row['user_id']): ?>
						<div class="dropdown position-absolute" style="right:.5em;top:.5em">
							<button type="button" class="btn btn-tool py-1" data-toggle="dropdown" title="Manage"
								style="background: #000000ab;">
								<i class="fa fa-ellipsis-v"></i>
							</button>
							<div class="dropdown-menu bg-dark">
								<button class="dropdown-item manage_playlist bg-dark" data-id="<?php echo $row['id'] ?>"
									type="button">Manage List</button>
								<button class="dropdown-item edit_playlist bg-dark" data-id="<?php echo $row['id'] ?>"
									type="button">Edit</button>
								<button class="dropdown-item delete_playlist bg-dark" onclick="blockbtn()" id="blockbtn"
									data-id="<?php echo $row['id'] ?>" type="button">Delete</button>
							</div>
						</div>
						<?php

						?>
					<?php endif; ?>
					<a href="index.php?page=view_playlist&id=<?php echo $row['id'] ?>">
						<img src="assets/uploads/<?php echo $row['cover_image'] ?>" class="card-img-top"
							style="object-fit: cover;max-width: 100%;height:26vh" alt="playlist Cover">
				</div>
				<div class="card-body" style="height: 20vh">
					<div class="card-title">
						<?php echo ucwords($row['title']) ?>
					</div>
					<p class="card-text truncate text-white">
						<?php echo $row['description'] ?>
					</p>
				</div>
				</a>
			</div>
		<?php endwhile; ?>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#list').dataTable()
		$('.delete_playlist').click(function () {
			_conf("Are you sure to delete this Playlist?", "delete_playlist", [$(this).attr('data-id')])
		})
		$('#manage_playlist').click(function (e) {
			e.preventDefault()
			uni_modal("New Playlist", 'manage_playlist.php')
		})
		$('.edit_playlist').click(function (e) {
			e.preventDefault()
			uni_modal("Edit Playlist", 'manage_playlist.php?id=' + $(this).attr('data-id'))
		})
		$('.manage_playlist').click(function (e) {
			e.preventDefault()
			uni_modal("Mange Playlist Music", 'manage_playlist_items.php?pid=' + $(this).attr('data-id'))
		})

		/*function blockbtn() {
		  document.getElementById("car1").disabled;
		}*/


	})
	check_list()
	function delete_playlist($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_playlist',
			method: 'POST',
			data: { id: $id },
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					$('.modal').modal('hide')
					_redirect(document.href)
					end_load()

				}
			}
		})
	}
	function _filter() {
		var _ftxt = $('#filter').val().toLowerCase()
		$('.playlist-item').each(function () {
			var _content = $(this).text().toLowerCase()
			if (_content.includes(_ftxt) == true) {
				$(this).toggle(true)
			} else {
				$(this).toggle(false)
			}
		})
		check_list()
	}
	function check_list() {
		var count = $('.playlist-item:visible').length
		if (count > 0) {
			if ($('#ns').length > 0)
				$('#ns').remove()
		} else {
			var ns = $('<div class="col-md-12 text-center text-white" id="ns"><b><i>No data to be display.</i></b></b></div>')
			$('#playlist-list').html(ns)
		}
	}
	$('#search').click(function () {
		_filter()
	})

	$('#filter').on('keypress', function (e) {
		if (e.which == 13) {
			_filter()
			return false;
		}
	})
	$('#filter').on('search', function () {
		_filter()
	})
</script>

<script>


	$('#search').click(function () {
		var keyword = $('#filter').val();
		saveSearchHistory(keyword);
		_filter();
	});

	function saveSearchHistory(keyword) {
		$.ajax({
			url: 'save_search_history.php', // Change the URL to the file where you handle the AJAX request
			method: 'POST',
			data: { keyword: keyword },
			success: function (response) {
				console.log('Search history saved');
			},
			error: function (xhr, status, error) {
				console.error('Error saving search history:', error);
			}
		});
	}
</script>