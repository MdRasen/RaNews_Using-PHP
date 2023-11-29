<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name">Name *</label>
                        <input type="text" id="name" class="form-control" placeholder="Name Here">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label for="email">Email *</label>
                        <input type="email" id="email" class="form-control" placeholder="Email Here">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control" placeholder="Phone Here">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Password *</label>
                        <input type="password" id="password" class="form-control" placeholder="Type Password">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="status">Status</label>
                        <select name="u_status" id="u_status" class="form-control">
                            <option value="0">Active</option>
                            <option value="1">Banned</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveUser">Save</button>
            </div>
        </div>
    </div>
</div>

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
        <h1 class="h3 mb-0 text-gray-800">Manage User</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-user-plus fa-sm text-white-50"></i> Add User</a>
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
                        <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $users = ViewUser();
                                if (mysqli_num_rows($users) > 0) {
                                    foreach ($users as $item) :
                                ?>
                                        <tr>
                                            <td><img src="../../<?= $item['image'] == true ? $item['image'] : 'assets/admin/img/no-photo.jpg' ?>" alt="image" style="width: 60px; height: 60px; object-fit: cover;"></td>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['email'] ?></td>
                                            <td><?= $item['phone'] ?></td>
                                            <td><?= $item['type'] == 0 ? "User" : "Admin" ?></td>
                                            <td><?= $item['status'] == 0 ? '<span class="text-white badge bg-success">Active</span>' : '<span class="text-white badge bg-danger">Banned</span>' ?></td>
                                            <td>
                                                <a href="edit-user.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" value="<?= $item['id'] ?>" class="btn btn-sm btn-danger userDeleteBtn">
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