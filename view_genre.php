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














<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM genres where id = " . $_GET['id'])->fetch_array();
foreach ($qry as $k => $v) {
  if ($k == 'title')
    $k = 'ptitle';
  $$k = $v;
}
?>

<div class="col-lg-12">
  <div class="row">
    <div class="col-md-4">
      <center>
        <div class="d-flex img-thumbnail bg-gradient-1 position-relative" style="width: 12rem">
          <img src="assets/uploads/<?php echo $cover_photo ?>" alt=""
            style="object-fit: cover;max-width: 100%;height:14rem">
          <span class="position-absolute" style="bottom:.5em;left:.5em">
            <div class=" bg-green rounded-circle d-flex justify-content-center align-items-center"
              style="width: 2rem;height: 2rem;cursor: pointer;" onclick="play_playlist()"><i class="fa fa-play"></i>
            </div>
          </span>
        </div>
      </center>
      <div>
      </div>
      <div>
      </div>
    </div>


    <div class="col-md-8">
      <h5 class="text-white">Title:
        <?php echo ucwords($k); ?>
      </h5>
      <h6 class="text-white border-bottom border-primary"><b class="text-white">Description:</b></h6>
      <div class="text-white">
        <?php echo html_entity_decode($description) ?>
      </div>
      <table class="table bg-black">
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Artist</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $items = $conn->query("SELECT * FROM uploads where genre_id =$id ");
          while ($row = $items->fetch_assoc()):
            ?>
            <tr class="pitem" data-queue="<?php echo $i ?>" data-id="<?php echo $row['id'] ?>"
              data-upath="<?php echo $row['upath'] ?>">
              <td>
                <span class="btn bg-gradient-success rounded-circle d-flex justify-content-center align-items-center"
                  style="width:30px;height:30px;z-index:2" onclick="play_playlist(<?php echo $i ?>)">
                  <div class="fa fa-play text-white"></div>
                </span>
              </td>
              <td>
                <i class='fa fa-music text-gradient-primary mr-2'></i>
                <?php echo ucwords($row['title']) ?>
              </td>
              <td>
                <?php echo ucwords($row['artist']) ?>
              </td>
            </tr>
            <?php
            $i++;
          endwhile;
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  function play_playlist($i = 0) {
    var src = {}
    $('.pitem').each(function () {
      var id = $(this).attr('data-id')
      var upath = $(this).attr('data-upath')
      var q = $(this).attr('data-queue')
      src[q] = { id: id, upath: 'assets/uploads/' + upath }
    })
    play_music(src, $i)
  }
  $('#manage_plist').click(function (e) {
    e.preventDefault()
    uni_modal("Mange Playlist Music", 'manage_playlist_items.php?pid=<?php echo $id ?>')
  })
</script>