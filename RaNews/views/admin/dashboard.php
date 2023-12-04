<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <!-- Alert message start -->
    <?php alertMessage(); ?>
    <!-- Alert message end -->
</div>
<!-- /.container-fluid -->

<?php include('../includes/admin/footer.php'); ?>