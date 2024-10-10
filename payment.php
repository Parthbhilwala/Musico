<?php
session_start();
$conn = new mysqli("localhost", "root", "", "music_db");
if (!$conn) {
    die("DataBase Not Found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['razorpay_payment_id'])) {
    $u_id = $_POST['id'];
    $amount = $_POST['amt'];
    $payment_id = $_POST['razorpay_payment_id'];
    $payment_status = 'success';

    // Insert data into pay table
    $sql = "INSERT INTO pay (user_id, amount, payment_status, payment_id, added_on) VALUES ('$u_id', '$amount', '$payment_status', '$payment_id', NOW())";
    if ($conn->query($sql) === TRUE) {
        header("location:./index.php?page=home");
        alert("Record inserted successfully");
    } else {
        header("location:./index.php?page=home");
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="assets/plugins/dropzone/min/dropzone.min.css">
    <!-- DateTimePicker -->
    <link rel="stylesheet" href="assets/dist/css/jquery.datetimepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Switch Toggle -->
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="assets/plugins/ekko-lightbox/ekko-lightbox.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/images-grid.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/dist/css/styles.css">
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <script src="assets/dist/js/images-grid.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- summernote -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        /* .card:hover {
            transform: translateY(-5px);
        } */
        .card-header {
            border-bottom: none;
            padding: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .icon {
            font-size: 48px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 24px;
            margin: 0;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 25px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>


</head>

<body class="bg-dark">





    <div class="card bg-gray-dark">
        <!-- <div class="card-header">
            
            <h2 class="card-title"></h2>
        </div> -->
        <div class="pay_icon" style="text-align: center;">
            <i class="fas fa-crown nav-icon  text-gradient-primary p-1" style="display: inline; font-size: 60px;"></i>
        </div>
        <div class="card-body">
            <form id="paymentForm" method="POST" action="" class="col-md-8 mx-auto">
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Enter your name"
                        value="<?php echo $_SESSION['login_firstname'] ?>" readonly class="form-control" />
                    <input type="hidden" name="id" id="u_id" value="<?php echo $_SESSION['login_id'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="amt" id="amt" value="500" readonly placeholder="Enter amount"
                        class="form-control" />
                </div>
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                <button type="button" name="btn" id="pay-btn" class="btn btn-primary btn-block">Pay Now</button>
                <button type="button" class="btn btn-primary btn-block"><a
                        href="./index.php?page=home" class="text-white">Back</a></button>

            </form>
        </div>
    </div>











    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script src="assets/plugins/toastr/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#pay-btn').on('click', function () {
                var name = $('#name').val();
                $.ajax({
                    url: "ajax.php?action=check_user",
                    method: "POST", // First change type to method here    
                    data: {
                        name: name,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response) {
                            payNow();
                        } else {
                            toastr.error("Payment already made by this user", "Error!");
                            // setTimeout(function () {
                            //     location.reload();
                            // }, 5000);
                        }
                    },



                });
            });
        });

        function payNow() {
            var name = $('#name').val();
            var amount = $('#amt').val();

            var options = {
                "key": "rzp_test_VZKk5JobieiwnS", // Replace with your Razorpay API key
                "amount": amount * 100, // amount in paise (multiply by 100 as amount is in rupees)
                "currency": "INR",
                "name": "Music",
                "description": "Payment for your product",
                "image": "img/4.jpg",
                "handler": function (response) {
                    $('#razorpay_payment_id').val(response.razorpay_payment_id);
                    $('#paymentForm').submit(); // Submit the form after getting payment ID
                },
                "prefill": {
                    "name": name,
                    "email": "example@example.com",
                    "contact": "9999999999"
                },
                "notes": {
                    "address": "Razorpay Corporate Office"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>

</body>

</html>