<?php
include '../includes/public/header.php';
?>

<!-- Main Post Section Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-12 col-xl-12 mt-0">
                <div class="bg-light p-4 rounded">
                    <div class="news-2">
                        <h3 class="">Login Form</h3>
                    </div>
                    <div class="row px-5 align-items-center">
                        <div class="col-md-7">
                            <div class="rounded overflow-hidden">
                                <img src="../../assets/public/img/login-side.png" class="img-fluid" style="width: 80%;" alt="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="d-flex flex-column">
                                <form action="../../controllers/public-controller.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="email">Email *</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email Here" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="password">Password *</label>
                                            <input type="password" name="password" class="form-control" placeholder="Type Password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="loginBtn" class="btn btn-primary text-white">Login</button>
                                        </div>
                                    </div>
                                    <!-- Alert message start -->
                                    <?php
                                    if (isset($_SESSION['status'])) {
                                    ?>
                                        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                                            <strong>Holy guacamole!</strong> <?= $_SESSION['status'] ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php
                                        unset($_SESSION['status']);
                                    }
                                    ?>
                                    <!-- Alert message end -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Post Section End -->

<?php
include '../includes/public/footer.php';
?>