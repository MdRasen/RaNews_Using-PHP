<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
        <a href="manage-user.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <!-- Alert message start -->
                    <?php alertMessage(); ?>
                    <!-- Alert message end -->
                    <?php
                    if (isset($_GET['id'])) {
                        if ($_GET['id'] != "") {
                            $userId = $_GET["id"];
                        } else {
                            echo '<h5>No id found!</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>No id given in params!</h5>';
                        return false;
                    }

                    $userInfo = userById($userId);
                    if ($userInfo) {
                        if ($userInfo['status'] == 200) {
                    ?>
                            <form action="../../controllers/user-controller.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?= $userInfo['data']['id']; ?>">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" class="form-control" value="<?= $userInfo['data']['name']; ?>" placeholder="Name Here" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email *</label>
                                        <input type="email" name="email" class="form-control" value="<?= $userInfo['data']['email']; ?>" placeholder="Email Here" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="<?= $userInfo['data']['phone']; ?>" placeholder="Phone Here">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" value="" placeholder="Type Password">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="password">Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <br>
                                        <img src="../../<?= $userInfo['data']['image'] == true ? $userInfo['data']['image'] : 'assets/admin/img/no-photo.jpg' ?>" style="height: 80px; width: 80px; object-fit: cover;" alt="image">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label for="type">Type</label>
                                        <select name="type" name="type" class="form-control">
                                            <option value="0" <?= $userInfo['data']['type'] == "0" ? 'selected' : '' ?>>User</option>
                                            <option value="1" <?= $userInfo['data']['type'] == "1" ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label for="status">Status</label>
                                        <select name="u_status" name="u_status" class="form-control">
                                            <option value="0" <?= $userInfo['data']['status'] == "0" ? 'selected' : '' ?>>Active</option>
                                            <option value="1" <?= $userInfo['data']['status'] == "1" ? 'selected' : '' ?>>Banned</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3 mt-2">
                                        <br>
                                        <button type="submit" class="btn btn-primary form-control" name="updateUser">Update</button>
                                    </div>
                                </div>
                            </form>
                    <?php
                        } else {
                            echo '<h5>' . $userInfo['message'] . '</h5>';
                        }
                    } else {
                        echo '<h5>Something went wrong!</h5>';
                        return false;
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include('../includes/admin/footer.php'); ?>