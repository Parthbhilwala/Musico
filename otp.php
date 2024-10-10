<?php

ob_start();
include ('header.php');
include ('db_connect.php');
session_start();
$random = $_SESSION['otp'];

if (isset($_POST['submit'])) {
  $otp = $_POST['otp'];

  if ($random == $otp) {
    header('location:comfirm_password.php');
  } else {
    $msg = "Invalid OTP";
  }
}




?>

<div class="div" style="height: 100%; background-color: black;">

  <section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center">

          <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread text-white">OTP</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php"></a></span> <span></span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9">

        <div class="col-md-3"></div>
        <div class="col-md-6 ftco-animate">
          <form method="post" class="contact-form">
            <?php if (isset($msg)) { ?>
              <div class="alert alert-danger">
                <?php echo $msg; ?>
              </div>
            <?php } ?>

            <div class="form-group">
              <input type="text" class="form-control" name="otp" placeholder="Enter OTP (One Time Password)">
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Submit" class="btn btn-primary py-3 px-5">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="login.php" class="ali">Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <?php include ('footer.php'); ?>
</div>