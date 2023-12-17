<?php
include '../includes/public/header.php';
?>

<!-- Single Product Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <ol class="breadcrumb justify-content-start mb-4">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item text-dark">Category</li>
            <li class="breadcrumb-item active text-dark">
                <?= $_GET["category"] ?>
            </li>
        </ol>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="row g-4">
                    <?php
                    if (isset($_GET['category'])) {
                        if ($_GET['category'] != "") {
                            $categorySlug = $_GET["category"];
                        }
                    }
                    $postsByCategory = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND c.id = p.category_id AND c.name_slug='$categorySlug' AND p.created_by_id = u.id ORDER BY p.id DESC LIMIT 12";
                    $postsByCategoryResult = mysqli_query($conn, $postsByCategory);
                    if ($postsByCategoryResult) {
                        if (mysqli_num_rows($postsByCategoryResult) > 0) {
                            foreach ($postsByCategoryResult as $item):
                                ?>
                                <div class="col-md-6">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-lg-5">
                                            <div class="overflow-hidden rounded">
                                                <img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>"
                                                    class=" img-zoomin img-fluid rounded
                                                                        w-100" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="features-content d-flex flex-column">
                                                <p class="text-uppercase mb-2">
                                                    <?= $item['categoryName'] ?>
                                                </p>
                                                <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>"
                                                    class="h6">
                                                    <?= $item['title'] ?>
                                                </a>
                                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                                    <?= date("M d, Y", strtotime($item['postUpdatedDate'])); ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        } else {
                            ?>
                            <div class="col-lg-8">
                                Something went wrong, Return to back page.
                                <a href="index.php" class="btn btn-danger btn-sm">Go Back</a>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-lg-8">
                            Something went wrong, Return to back page.
                            <a href="index.php" class="btn btn-danger btn-sm">Go Back</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="p-3 rounded border">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="btn btn-primary input-group-text p-3"><i
                                        class="fa fa-search text-white"></i></span>
                            </div>
                            <h4 class="mb-4">Popular Categories</h4>
                            <div class="row g-2">
                                <?php
                                $categories = viewCategories();
                                if (mysqli_num_rows($categories) > 0) {
                                    foreach ($categories as $item):
                                        ?>
                                        <div class="col-12">
                                            <a href="category-posts.php?category=<?= $item['name_slug'] ?>"
                                                class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                                <?= $item['name'] ?>
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                }
                                ?>
                            </div>
                            <h4 class="my-4">Stay Connected</h4>
                            <div class="row g-4">
                                <div class="col-12">
                                    <a href="#"
                                        class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                        <i class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                        <span class="text-white">13,977 Fans</span>
                                    </a>
                                    <a href="#" class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                        <i class="fab fa-twitter btn btn-light btn-square rounded-circle me-3"></i>
                                        <span class="text-white">21,798 Follower</span>
                                    </a>
                                    <a href="#"
                                        class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                        <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                        <span class="text-white">7,999 Subscriber</span>
                                    </a>
                                    <a href="#" class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                        <i class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                                        <span class="text-white">19,764 Follower</span>
                                    </a>
                                    <a href="#"
                                        class="w-100 rounded btn btn-secondary d-flex align-items-center p-3 mb-2">
                                        <i class="bi-cloud btn btn-light btn-square rounded-circle me-3"></i>
                                        <span class="text-white">31,999 Subscriber</span>
                                    </a>
                                    <a href="#"
                                        class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-4">
                                        <i class="fab fa-dribbble btn btn-light btn-square rounded-circle me-3"></i>
                                        <span class="text-white">37,999 Subscriber</span>
                                    </a>
                                </div>
                            </div>
                            <h4 class="my-4">Popular News</h4>
                            <div class="row g-4">
                                <?php
                                $popularPosts = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND p.total_views > '1000' AND c.id = p.category_id AND p.created_by_id = u.id ORDER BY p.id DESC LIMIT 4";
                                $popularPostsResult = mysqli_query($conn, $popularPosts);
                                if ($popularPostsResult) {
                                    if (mysqli_num_rows($popularPostsResult) > 0) {
                                        foreach ($popularPostsResult as $item):
                                            if ($item['total_views'] >= 1000) {
                                                $total_views = round($item['total_views'] / 1000) . "k";
                                            } else {
                                                $total_views = $item['total_views'];
                                            }
                                            ?>
                                            <div class="col-12">
                                                <div class="row g-4 align-items-center features-item">
                                                    <div class="col-4">
                                                        <div class="rounded-circle position-relative">
                                                            <div class="rounded-top overflow-hidden">
                                                                <img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>"
                                                                    class="img-zoomin img-fluid rounded-top w-100" alt="">
                                                            </div>
                                                            <span
                                                                class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                                                style="top: 10%; right: -10px;">
                                                                <?= $total_views ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="features-content d-flex flex-column">
                                                            <p class="text-uppercase mb-2">
                                                                <?= $item['categoryName'] ?>
                                                            </p>
                                                            <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>"
                                                                class="h6">
                                                                <?= $item['title'] ?>
                                                            </a>
                                                            <small class="text-body d-block"><i
                                                                    class="fas fa-calendar-alt me-1"></i>
                                                                <?= date("M d, Y", strtotime($item['postUpdatedDate'])); ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                    }
                                }
                                ?>
                                <div class="col-lg-12">
                                    <a href="#"
                                        class="link-hover btn border border-primary rounded-pill text-dark w-100 py-3 mb-4">View
                                        More</a>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom my-3 pb-3">
                                        <h4 class="mb-0">Trending Tags</h4>
                                    </div>
                                    <ul class="nav nav-pills d-inline-flex text-center mb-4">
                                        <?php
                                        $categories = viewCategories();
                                        if (mysqli_num_rows($categories) > 0) {
                                            foreach ($categories as $item):
                                                ?>
                                                <li class="nav-item mb-3">
                                                    <a class="d-flex py-2 bg-light rounded-pill me-2"
                                                        href="category-posts.php?category=<?= $item['name_slug'] ?>">
                                                        <span class="text-dark link-hover" style="width: 90px;">
                                                            <?= $item['name'] ?>
                                                        </span>
                                                    </a>
                                                </li>
                                                <?php
                                            endforeach;
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative banner-2">
                                        <img src="../../assets/public/img/banner-2.jpg" class="img-fluid w-100 rounded"
                                            alt="">
                                        <div class="text-center banner-content-2">
                                            <h6 class="mb-2">RaNews Theme</h6>
                                            <p class="text-white mb-2">News & Magazine Theme</p>
                                            <a href="#" class="btn btn-primary text-white px-4">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single Product End -->

<?php
include '../includes/public/footer.php';
?>