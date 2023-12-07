<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Delete Image Modal -->
<div class="modal fade" id="deleteImageModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Image?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../controllers/gallery-controller.php" method="POST">
                <div class="modal-body">
                    Are you sure, You want to delete this image?
                    <input type="hidden" name="delete_id" class="delete_image_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="deleteImage">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Gallery</h1>
        <a href="dashboard.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <!-- Alert message start -->
                    <?php alertMessage(); ?>
                    <!-- Alert message end -->

                    <form action="../../controllers/gallery-controller.php" method="POST" enctype="multipart/form-data">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" name="uploadImage" class="btn btn-primary">Upload Image</button>
                            </div>
                        </div>
                    </form>
                    <div class="row g-2 mt-4 px-3">
                        <?php
                        $galleries = viewGalleries();
                        if (mysqli_num_rows($galleries) > 0) {
                            foreach ($galleries as $item) :
                        ?>
                                <div class="col-md-4 mb-3 text-right">
                                    <div class="rounded overflow-hidden">
                                        <img src="../../<?= $item['image_src'] == true ? $item['image_src'] : 'assets/admin/img/no-photo.jpg' ?>" class="img-zoomin img-fluid rounded w-100" style="height: 220px;" alt="image">
                                    </div>
                                    <button type="button" value="<?= $item['id'] ?>" class="btn btn-sm btn-danger mt-1 imageDeleteBtn">
                                        Remove
                                    </button>
                                </div>
                            <?php
                            endforeach;
                        } else {
                            ?>
                            <p class="text-center">No data found!</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include('../includes/admin/footer.php'); ?>