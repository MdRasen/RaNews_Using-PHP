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

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage User</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-user-plus fa-sm text-white-50"></i> Add User</a>
    </div>
    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

<?php include('../includes/admin/footer.php'); ?>