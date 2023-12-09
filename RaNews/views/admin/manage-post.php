<?php
include('../includes/admin/header.php');
include('../includes/admin/sidebar.php');
include('../includes/admin/topbar.php');
?>

<!-- Delete Post Modal -->
<div class="modal fade" id="deletePostModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Post?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../../controllers/post-controller.php" method="POST">
                <div class="modal-body">
                    Are you sure, You want to delete this post?
                    <input type="hidden" name="delete_id" class="delete_post_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="deletePost">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Post</h1>
        <a href="add-post.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Post</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <!-- Alert message start -->
                    <?php alertMessage(); ?>
                    <!-- Alert message end -->
                    <form action="" method="GET" class="pb-3">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>">
                            </div>
                            <div class="col-md-5">
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
                                    $categories = viewCategories();
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $item) :
                                    ?>
                                            <option value="<?= $item['id'] ?>" <?= isset($_GET['category_id']) == true ? ($_GET['category_id'] == $item['id'] ? 'selected' : '') : '' ?>><?= $item['name'] ?></option>
                                        <?php
                                        endforeach;
                                    } else {
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="manage-post.php" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['date']) || isset($_GET['category_id'])) {
                                    $postDate = validate($_GET['date']);
                                    if ($postDate) {
                                        $startDate = date('Y-m-d H:i:s', strtotime($postDate));
                                        $endDate = date('Y-m-d H:i:s', strtotime($postDate . ' +1 day'));
                                    }
                                    $categoryId = validate($_GET['category_id']);

                                    if ($postDate != '' && $categoryId != '') {
                                        $postQuery = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE c.id = p.category_id AND p.created_by_id = u.id AND p.created_at BETWEEN '$startDate' AND '$endDate' AND p.category_id='$categoryId' ORDER BY p.id DESC";
                                    } elseif ($postDate != '' && $categoryId == '') {
                                        $postQuery = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE c.id = p.category_id AND p.created_by_id = u.id AND p.created_at BETWEEN '$startDate' AND '$endDate' ORDER BY p.id DESC";
                                    } else {
                                        $postQuery = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE c.id = p.category_id AND p.created_by_id = u.id AND p.category_id='$categoryId' ORDER BY p.id DESC";
                                    }
                                } else {
                                    $postQuery = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE c.id = p.category_id AND p.created_by_id = u.id ORDER BY p.id DESC";
                                }
                                $postsRes = mysqli_query($conn, $postQuery);
                                if (mysqli_num_rows($postsRes) > 0) {
                                    foreach ($postsRes as $item) :
                                ?>
                                        <tr>
                                            <td><img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>" alt="image" style="width: 50px; height: 50px; object-fit: cover;"></td>
                                            <td><?= $item['title'] ?></td>
                                            <td><?= $item['categoryName'] ?></td>
                                            <td><?= $item['userName'] ?></td>
                                            <td>
                                                <?= $item['postStatus'] == 0 ? '<span class="text-white badge bg-success">Active</span>' : '<span class="text-white badge bg-danger">Disabled</span>' ?>
                                                <?= $item['top_status'] == 1 ? '<span class="text-white badge bg-info">Top Status</span>' : '' ?>
                                            </td>
                                            <td>
                                                <a href="edit-post.php?id=<?= $item['postId'] ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" value="<?= $item['postId'] ?>" class="btn btn-sm btn-danger postDeleteBtn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="6">No data found!</td>
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