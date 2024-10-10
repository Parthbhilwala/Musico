<!-- <style>
  p {
    color: white !important;
  }

  .bg-new {
    background-color: #4949a6;
  }

  .brand-link {
    border-bottom: 1px solid #c6c6c6 !important;
  }
</style> -->




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

    <?php

    // echo '<pre>';
    // print_r($_SESSION);
    // die;
    
    if ($_SESSION['login_type'] == 1): ?>
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

<?php include ('db_connect.php') ?>
<!-- Info boxes -->
<?php if ($_SESSION['login_type'] == 1): ?>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box bg-black border border-primary">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-th-list text-gradient-primary"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><a href="index.php?page=genre_list">Total Genres </a></span>
          <span class="info-box-number">
            <?php echo $conn->query("SELECT * FROM genres")->num_rows; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box bg-black border border-primary">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-music text-gradient-primary"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><a href="index.php?page=music_list"> Total Musics</a></span>
          <span class="info-box-number">
            <?php echo $conn->query("SELECT * FROM uploads")->num_rows; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box bg-black border border-primary">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-list text-gradient-primary"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><a href="iindex.php?page=playlist">Total Playlist</a></span>
          <span class="info-box-number">
            <?php echo $conn->query("SELECT * FROM playlist")->num_rows; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box bg-black border border-primary">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users text-gradient-primary"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Users</span>
          <span class="info-box-number">
            <?php echo $conn->query("SELECT * FROM users where type = 2")->num_rows; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <!-- <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box bg-black border border-primary">
      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-crown text-gradient-primary"></i></span> -->
    <!-- 
      <div class="info-box-content">
        <span class="info-box-text">VIP</span>
        <span class="info-box-number">
          <?php
          // echo $conn->query("SELECT * FROM users where type = 2")->num_rows;
          ?>
        </span>
      </div> -->
    <!-- /.info-box-content -->
    <!-- </div> -->
    <!-- /.info-box -->
    <!-- </div> -->



    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box bg-black border border-primary">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users text-gradient-primary"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Feedback</span>
          <span class="info-box-number">
            <?php echo $conn->query("SELECT * FROM feedback")->num_rows; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box bg-black border border-primary">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-music text-gradient-primary"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">My Musics</span>
          <span class="info-box-number">
            <?php echo $conn->query("SELECT * FROM uploads where user_id ={$_SESSION['login_id']} ")->num_rows; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box bg-black border border-primary">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-list text-gradient-primary"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">My Playlist</span>
          <span class="info-box-number">
            <?php echo $conn->query("SELECT * FROM playlist where user_id ={$_SESSION['login_id']}")->num_rows; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>


  </div>

<?php endif; ?>
<style>
  /* Music card style */
  .music-card {
    border: 1px solid #444;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px;
    background: #222;
    color: #fff;
    max-width: 300px;
    /* Set maximum width for uniform size */
  }

  /* Music card image */
  .music-card img {
    width: 100%;
    height: 150px;
    /* Set fixed height for consistency */
    border-radius: 10px 10px 0 0;
    object-fit: cover;
  }

  /* Music card body */
  .music-card .card-body {
    padding: 20px;
  }

  /* Music title style */
  .music-card .card-title {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: #fff;
  }

  /* Music artist style */
  .music-card .card-subtitle {
    font-size: 1rem;
    margin-bottom: 10px;
    color: #ccc;
  }

  /* Music description style */
  .music-card .card-text {
    font-size: 0.9rem;
    color: #aaa;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    /* Limit to 3 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Music item hover effect */
  .music-card:hover {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  }
</style>
<BR>






<?php if ($_SESSION['login_type'] == 1) { ?>



  <script>
    $('#manage_my_account').click(function () {
      uni_modal("Manage Account", "manage_account.php", "large")
    })
    $('#my_profile').click(function () {
      uni_modal("Profile", "view_user.php?id=<?php echo $_SESSION['login_id'] ?>")
    })

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

  <div>
    <h1 style="color : gray" ;>Manage User</h1>
  </div>

  <?php include 'db_connect.php' ?>
  <div class="col-lg-12">
    <div class="card">

      <div class="card-body">
        <table class="table tabe-hover table-bordered" id="list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>Name</th>
              <th>Contact #</th>
              <th>Role</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $type = array('', "Admin", "Subscriber");
            $qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type != 1 order by concat(firstname,' ',lastname) asc");
            while ($row = $qry->fetch_assoc()):
              ?>
              <tr>
                <th class="text-center">
                  <?php echo $i++ ?>
                </th>
                <td><b>
                    <?php echo ucwords($row['name']) ?>
                  </b></td>
                <td><b>
                    <?php echo $row['contact'] ?>
                  </b></td>
                <td><b>
                    <?php echo $row['type'] ?>
                  </b></td>
                <td><b>
                    <?php echo $row['email'] ?>
                  </b></td>
                <td class="text-center">
                  <button type="button"
                    class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
                    data-toggle="dropdown" aria-expanded="true">
                    Action
                  </button>
                  <div class="dropdown-menu" style="">
                    <button class="dropdown-item view_user" button="button" data-id="<?php echo $row['id'] ?>">View</button>
                    <!--<div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $row['id'] ?>">Edit</a>
                          <div class="dropdown-divider"></div>-->
                    <!-- <a class="dropdown-item delete_user" data-id="<?php echo $row['id'] ?>">Delete</a> -->
                  </div>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('#list').dataTable()
      $('.view_user').click(function () {
        uni_modal("<i class='fa fa-id-card'></i> User Details", "view_user.php?id=" + $(this).attr('data-id'))
      })
      $('.delete_user').click(function () {
        _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
      })
    })
    function delete_user($id) {
      start_load()
      $.ajax({
        url: 'ajax.php?action=delete_user',
        method: 'POST',
        data: { id: $id },
        success: function (resp) {
          if (resp == 1) {
            alert_toast("Data successfully deleted", 'success')
            setTimeout(function () {
              location.reload()
            }, 1500)

          }
        }
      })
    }
  </script>



<?php } ?>




<div>
  <h1 style="color : gray" ;>Most Liked Songs</h1>
</div>
<br>
<!-- Your existing PHP code for music display -->
<div class="col-lg-12">
  <div class="d-flex justify-content-between align-items-center w-100">
    <!-- Add your search and add new music buttons here if needed -->
  </div>
  <!-- Loop through the music data and display each music card -->
  <div class="row">
    <?php
    $musics = $conn->query("SELECT u.*, g.genre, CONCAT_WS(' ', users.firstname, users.lastname) AS username, users.profile_pic AS profile_pic,
                                       COUNT(l.music_id) AS like_count
                               FROM uploads u 
                               INNER JOIN genres g ON g.id = u.genre_id 
                               INNER JOIN users ON users.id = u.user_id
                               LEFT JOIN likes l ON u.id = l.music_id
                               GROUP BY u.id
                               ORDER BY like_count DESC, u.title ASC
                               LIMIT 6"); // Limiting the results to 6
    while ($row = $musics->fetch_assoc()):
      $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
      unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
      $desc = strtr(html_entity_decode($row['description']), $trans);
      $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
      ?>
      <div class="card bg-black music-item my-2 mx-1" data-id="<?php echo $row['id'] ?>"
        data-upath="<?php echo $row['upath'] ?>" style="width:15vw;cursor:pointer;">
        <div class="card-img-top flex-w-100 position-relative py-2 px-3">
          <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_id'] == $row['user_id']): ?>
            <div class="dropdown position-absolute" style="right:.5em;top:.5em">
              <button type="button" class="btn btn-tool py-1" data-toggle="dropdown" title="Manage"
                style="background: #000000ab;z-index: 1">
                <i class="fa fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu bg-dark">
                <a class="dropdown-item bg-dark" data-id="<?php echo $row['id'] ?>"
                  href="index.php?page=edit_music&id=<?php echo $row['id'] ?>">Edit</a>
                <a class="dropdown-item delete_music bg-dark" data-id="<?php echo $row['id'] ?>">Delete</a>
              </div>
            </div>
          <?php endif; ?>
          <span class="position-absolute" style="bottom:.5em;left:.5em;z-index: 2">
            <div class="btn bg-green rounded-circle d-flex justify-content-center align-items-center"
              style="width: 2rem;height: 2rem;cursor: pointer;"
              onclick="play_music({0:{id:'<?php echo $row['id'] ?>',upath:'assets/uploads/<?php echo $row['upath'] ?>'}})">
              <i class="fa fa-play"></i>
            </div>
          </span>
          <a href="index.php?page=view_music&id=<?php echo $row['id'] ?>">
            <!-- Displaying the username and profile picture -->
            <div class="d-flex align-items-center">
              <img src="assets/uploads/<?php echo $row['profile_pic'] ?>" class="rounded-circle mr-2"
                style="width: 30px; height: 30px; cursor: pointer;"
                onclick="openUserProfile(<?php echo $row['user_id'] ?>)" alt="Profile Picture">
              <p class="card-text text-white"><small>Inserted by:
                  <?php echo ucwords($row['username']) ?>
                </small></p>
            </div>
            <br>
            <img src="assets/uploads/<?php echo $row['cover_image'] ?>" class="card-img-top"
              style="object-fit: cover;max-width: 100%;height:26vh" alt="music Cover">
        </div>
        <div class="card-body border-top border-primary" style="min-height:20vh">
          <h5 class="card-title w-100">
            <?php echo ucwords($row['title']) ?>
          </h5>
          <h6 class="card-subtitle mb-2 text-muted w-100">Artist:
            <?php echo ucwords($row['artist']) ?>
          </h6>
          <p class="card-text truncate text-white"><small>
              <?php echo strip_tags($desc) ?>
            </small></p>

        </div>
        </a>
      </div>
    <?php endwhile; ?>
  </div>
</div>