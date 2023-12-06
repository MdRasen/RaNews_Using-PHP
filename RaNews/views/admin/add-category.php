<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
        <a href="manage-category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Manage Category</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <!-- Alert message start -->
                    <?php alertMessage(); ?>
                    <!-- Alert message end -->
                    <form action="../../controllers/category-controller.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="sort">Sort *</label>
                                <input type="number" name="sort" class="form-control" placeholder="Sort Number" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="status">Status</label>
                                <select name="status" name="status" class="form-control">
                                    <option value="0">Active</option>
                                    <option value="1">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="short_desc">Short Description</label>
                                <textarea name="short_desc" rows="3" class="form-control" placeholder="Short Description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 px-3 text-right">
                                <button type="submit" name="createCategory" class="btn btn-primary">Create Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include('../includes/admin/footer.php'); ?>