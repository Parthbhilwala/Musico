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







<!-- <aside class="main-sidebar sidebar-dark-navy bg-black elevation-4">
  <div class="dropdown">
    <a class="brand-link bg-black" data-toggle="dropdown" aria-expanded="true">
      <span
        class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center text-white font-weight-500"
        style="width: 38px;height:50px;font-size: 2rem"><b><i
            class="fa fa-headphones-alt text-gradient-primary"></i></b></span>
      <span class="brand-text font-weight-light  text-gradient-primary"><i>Music</i></span>

    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
          data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./index.php?page=home" class="nav-link nav-home">
              <i class="nav-icon fas fa-home text-gradient-primary"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./index.php?page=new_music" class=" ml-1 nav-link nav-new_music tree-item">
              <i class="nav-icon fa fa-music text-gradient-primary"></i>

              <p class="">Add Music</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=music_list" class=" ml-1 nav-link nav-music_list tree-item">
              <i class="nav-icon fa fa-music text-gradient-primary"></i>

              <p class="">Music List</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="./index.php?page=playlist" class="nav-link nav-playlist tree-item">
              <i class="fas fa-list nav-icon  text-gradient-primary"></i>
              <p>Playlist</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=genre_list" class="nav-link nav-genre_list tree-item">
              <i class="fas fa-th-list nav-icon  text-gradient-primary"></i>
              <p>Genre</p>
            </a>
          </li>
          <?php if ($_SESSION['login_type'] == 1): ?>
            <li class="nav-item">
              <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                <i class="fas fa-users nav-icon  text-gradient-primary"></i>
                <p>Users</p>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
</aside> -->
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



<?php
include 'db_connect.php';
$qry = $conn->query("SELECT u.*,g.genre FROM uploads u inner join genres g on g.id = u.genre_id where u.id = " . $_GET['id'])->fetch_array();
foreach ($qry as $k => $v) {
  if ($k == 'title')
    $k = 'mtitle';
  $$k = $v;
}
?>
<div class="col-lg-12">
  <div class="row">
    <div class="col-md-4">
      <center>
        <div class="d-flex img-thumbnail bg-gradient-1 position-relative" style="width: 12rem">
          <img src="assets/uploads/<?php echo $cover_image ?>" alt=""
            style="object-fit: cover;max-width: 100%;height:14rem">
          <!-- <span class="position-absolute" style="bottom:.5em;left:.5em">
            <div class=" bg-green rounded-circle d-flex justify-content-center align-items-center"
              style="width: 2rem;height: 2rem;cursor: pointer;"
              onclick="play_music('assets/uploads/<?php echo $upath ?>')"><i class="fa fa-play"></i></div>
          </span> -->
        </div>
      </center>
      <div>
      </div>
    </div>
    <div class="col-md-8">
      <h5 class="text-white">Title:
        <?php echo ucwords($mtitle); ?>
      </h5>
      <h6 class="text-white">Artist:
        <?php echo ucwords($artist); ?>
      </h6>
      <h6 class="text-white">Genre:
        <?php echo ucwords($genre); ?>
      </h6>
      <h6 class="text-white border-bottom border-primary"><b class="text-white">Description:</b></h6>
      <div class="text-white">
        <?php echo html_entity_decode($description) ?>
      </div>
    </div>
  </div>
</div>



<?php
include 'db_connect.php';
$qry = $conn->query("SELECT u.*,g.genre FROM uploads u inner join genres g on g.id = u.genre_id where u.id = " . $_GET['id'])->fetch_array();
foreach ($qry as $k => $v) {
  if ($k == 'title')
    $k = 'mtitle';
  $$k = $v;
}
?>
<?php
include 'db_connect.php';
$qry = $conn->query("SELECT u.*, g.genre, COUNT(l.id) as total_likes FROM uploads u 
                    INNER JOIN genres g ON g.id = u.genre_id 
                    LEFT JOIN likes l ON l.music_id = u.id 
                    WHERE u.id = " . $_GET['id'])->fetch_array();
foreach ($qry as $k => $v) {
  if ($k == 'title')
    $k = 'mtitle';
  $$k = $v;
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function () {
    // JavaScript to handle like button click
    $('.like-btn').click(function () {
      var musicId = $(this).data('music-id');
      var button = $(this);
      $.ajax({
        url: 'like_music.php',
        method: 'POST',
        data: { music_id: musicId },
        success: function (response) {
          if (response === 'success') {
            // Update UI to indicate the song was liked
            alert('Song liked!');
            // Update total likes count dynamically
            var totalLikes = parseInt(button.find('.total-likes').text());
            button.find('.total-likes').text(totalLikes + 1);
          } else if (response === 'already_liked') {
            alert('You have already liked this song.');
          } else if (response === 'not_logged_in') {
            alert('You must be logged in to like songs.');
          } else {
            alert('Error occurred while liking the song.');
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText); // Log detailed error message
          alert('Error occurred while processing your request.');
        }
      });
    });
  });
</script>
<!-- Existing code to display music details -->

<!-- Add a like button for the specific song -->
<div class="col-md-4">
  <?php if ($_SESSION['login_type'] == 1): ?>
    <button class="btn btn-link like-btn\" data-music-id="<?php echo $_GET['id']; ?>">
      <i class="fas fa-heart"></i> Like <span class="total-likes">
        <?php echo $total_likes; ?>
      </span>
    </button>
  <?php endif; ?>

  <?php if ($_SESSION['login_type'] == 2): ?>
    <!-- Use Font Awesome heart icon for the like button -->
    <button class="btn btn-link like-btn" data-music-id="<?php echo $_GET['id']; ?>">
      <i class="fas fa-heart"></i> Like <span class="total-likes">
        <?php echo $total_likes; ?>
      </span>
    </button>
  <?php endif; ?>



  <!-- Add a comment button -->
  <button class="btn btn-link comment-btn" data-toggle="modal" data-target="#commentModal">
    <i class="fas fa-comment"></i> Comment
  </button>
</div>


<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLabel">Add a Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="commentForm">
          <div class="form-group">
            <?php if ($_SESSION['login_type'] == 2): ?>
              <label for="comment">Your Comment:</label>
              <textarea class="form-control" id="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        <?php endif; ?>
        <br>
        <!-- Display comments -->
        <div class="col-md-8">
          <h5>Comments:</h5>
          <div id="comments">
            <!-- Comments will be dynamically loaded here -->
          </div>
        </div>

        <script>
          $(document).ready(function () {
            // JavaScript to handle like button click

            // (existing code for like functionality)

            // JavaScript to handle comment form submission
            $('#commentForm').submit(function (event) {
              event.preventDefault();
              var musicId = <?php echo $_GET['id']; ?>;
              var comment = $('#comment').val().trim();
              if (comment === '') {
                alert('Please enter a comment.');
                return;
              }
              $.ajax({
                url: 'add_comment.php',
                method: 'POST',
                data: { music_id: musicId, comment: comment },
                success: function (response) {
                  if (response === 'success') {
                    // Clear comment textarea and close the modal
                    $('#comment').val('');
                    $('#commentModal').modal('hide');
                    // Refresh comments section
                    loadComments();
                  } else {
                    alert('Error occurred while adding comment.');
                  }
                },
                error: function (xhr, status, error) {
                  console.error(xhr.responseText); // Log detailed error message
                  alert('Error occurred while processing your request.');
                }
              });
            });

            // Function to load comments dynamically
            function loadComments() {
              var musicId = <?php echo $_GET['id']; ?>;
              $.ajax({
                url: 'get_comments.php',
                method: 'GET',
                data: { music_id: musicId },
                success: function (response) {
                  $('#comments').html(response);
                },
                error: function (xhr, status, error) {
                  console.error(xhr.responseText); // Log detailed error message
                  alert('Error occurred while loading comments.');
                }
              });
            }

            // Initial loading of comments
            loadComments();
          });
        </script>
        <style>
          /* CSS for comments */
          .comment {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
          }

          .comment .comment-author {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
          }

          .comment .comment-text {
            color: #555;
          }
        </style>

      </div>
    </div>
  </div>
</div>