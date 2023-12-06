<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
        <a href="manage-category.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back</a>
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
                            $categoryId = $_GET["id"];
                        } else {
                            echo '<h5>No id found!</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>No id given in params!</h5>';
                        return false;
                    }

                    $categoryInfo = categoryById($categoryId);
                    if ($categoryInfo) {
                        if ($categoryInfo['status'] == 200) {
                    ?>
                            <form action="../../controllers/category-controller.php" method="POST">
                                <input type="hidden" value="<?= $categoryInfo['data']['id'] ?>" name="category_id">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" class="form-control" placeholder="Category Name" value="<?= $categoryInfo['data']['name'] ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="sort">Sort *</label>
                                        <input type="number" name="sort" class="form-control" value="<?= $categoryInfo['data']['sort'] ?>" placeholder="Sort Number" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="0" <?= $categoryInfo['data']['status'] == "0" ? 'selected' : '' ?>>Active</option>
                                            <option value="1" <?= $categoryInfo['data']['status'] == "1" ? 'selected' : '' ?>>Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="short_desc">Short Description</label>
                                        <textarea name="short_desc" rows="3" class="form-control" placeholder="Short Description"><?= $categoryInfo['data']['short_desc'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 px-3 text-right">
                                        <button type="submit" name="updateCategory" class="btn btn-primary">Update Category</button>
                                    </div>
                                </div>
                            </form>
                    <?php
                        } else {
                            echo '<h5>' . $categoryInfo['message'] . '</h5>';
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