<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete User?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../controllers/user-controller.php" method="POST">
                <div class="modal-body">
                    Are you sure, You want to delete this user?
                    <input type="hidden" name="delete_id" class="delete_user_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="deleteUser">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Category</h1>
        <a href="add-category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Category</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <!-- Alert message start -->
                    <?php alertMessage(); ?>
                    <!-- Alert message end -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Sort</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $categories = viewCategories();
                                if (mysqli_num_rows($categories) > 0) {
                                    foreach ($categories as $item) :
                                ?>
                                        <tr>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['short_desc'] ?></td>
                                            <td><?= $item['sort'] ?></td>
                                            <td><?= $item['status'] == 0 ? '<span class="text-white badge bg-success">Active</span>' : '<span class="text-white badge bg-danger">Disabled</span>' ?></td>
                                            <td>
                                                <a href="edit-category.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" value="<?= $item['id'] ?>" class="btn btn-sm btn-danger categoryDeleteBtn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="7">No data found!</td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include('../includes/admin/footer.php'); ?>