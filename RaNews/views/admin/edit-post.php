<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Post</h1>
        <a href="manage-post.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back</a>
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

                    $postInfo = postById($categoryId);
                    if ($postInfo) {
                        if ($postInfo['status'] == 200) {
                    ?>
                            <form action="../../controllers/post-controller.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" value="<?= $postInfo['data']['id'] ?>" name="post_id">
                                <div class="row">
                                    <div class="col-md-10 mb-3">
                                        <label for="title">Title *</label>
                                        <input type="text" name="title" class="form-control" value="<?= $postInfo['data']['title'] ?>" placeholder="Post Title" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="top_status">Top Status</label>
                                        <select name="top_status" name="top_status" class="form-control">
                                            <option value="1" <?= $postInfo['data']['top_status'] == "1" ? 'selected' : '' ?>>Active</option>
                                            <option value="0" <?= $postInfo['data']['top_status'] == "0" ? 'selected' : '' ?>>Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="category">Category</label>
                                        <select name="category_id" class="form-control">
                                            <?php
                                            $categories = viewCategories();
                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $item) :
                                            ?>
                                                    <option value="<?= $item['id'] ?>" <?= $postInfo['data']['category_id'] == $item['id'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
                                                <?php
                                                endforeach;
                                            } else {
                                                ?>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="status">Status</label>
                                        <select name="status" name="status" class="form-control">
                                            <option value="0" <?= $postInfo['data']['status'] == "0" ? 'selected' : '' ?>>Active</option>
                                            <option value="1" <?= $postInfo['data']['status'] == "1" ? 'selected' : '' ?>>Disable</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <br>
                                        <img src="../../<?= $postInfo['data']['image'] != "NULL" ? $postInfo['data']['image'] : 'assets/admin/img/no-photo.jpg' ?>" style="height: 60px; width: 60px; object-fit: cover;" alt="image">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="desc">Description *</label>
                                        <textarea name="desc" rows="5" class="form-control" placeholder="Description" id="summernote"><?= $postInfo['data']['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="tags">Tags</label>
                                        <textarea name="tags" rows="3" class="form-control" placeholder="Tags (Separated by commas)"><?= $postInfo['data']['tags'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 px-3 text-right">
                                        <button type="submit" name="updatePost" class="btn btn-primary">Update Post</button>
                                    </div>
                                </div>
                            </form>
                    <?php
                        } else {
                            echo '<h5>' . $postInfo['message'] . '</h5>';
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