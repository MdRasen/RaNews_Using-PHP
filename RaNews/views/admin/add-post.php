<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Post</h1>
        <a href="manage-post.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-columns fa-sm text-white-50"></i> Manage Post</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <!-- Alert message start -->
                    <?php alertMessage(); ?>
                    <!-- Alert message end -->
                    <form action="../../controllers/post-controller.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title">Title *</label>
                                <input type="text" name="title" class="form-control" placeholder="Post Title" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="category">Category</label>
                                <select name="category_id" class="form-control">
                                    <?php
                                    $categories = viewCategories();
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $item) :
                                    ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                        <?php
                                        endforeach;
                                    } else {
                                        ?>
                                        <option value="others">অন্যান্য</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="status">Status</label>
                                <select name="status" name="status" class="form-control">
                                    <option value="0">Active</option>
                                    <option value="1">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="desc">Description *</label>
                                <textarea name="desc" rows="5" class="form-control" placeholder="Description" id="summernote" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="tags">Tags</label>
                                <textarea name="tags" rows="3" class="form-control" placeholder="Tags"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 px-3 text-right">
                                <button type="submit" name="createPost" class="btn btn-primary">Create Post</button>
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