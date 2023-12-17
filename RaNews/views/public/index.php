<?php
include '../includes/public/header.php';
?>

<!-- Features Start -->
<div class="container-fluid features mb-5">
    <div class="container py-5">
        <div class="row g-4">
            <?php
            $topPosts = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND p.total_views > '1000' AND c.id = p.category_id AND p.created_by_id = u.id ORDER BY p.id DESC LIMIT 4";
            $result = mysqli_query($conn, $topPosts);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $item):
                        if ($item['total_views'] >= 1000) {
                            $total_views = round($item['total_views'] / 1000) . "k";
                        } else {
                            $total_views = $item['total_views'];
                        }
                        ?>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="row g-4 align-items-center features-item">
                                <div class="col-4">
                                    <div class="rounded-circle position-relative">
                                        <div class="rounded-circle">
                                            <img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>"
                                                class="img-zoomin rounded-circle" style="width: 80px; height: 80px;" alt="">
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
                                        <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>" class="h6">
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
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Features End -->

<!-- Main Post Section Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-7 col-xl-8 mt-0">
                <?php
                $top_post = "SELECT p.*, c.* FROM posts as p, categories as c WHERE p.top_status='1' AND p.status='0' AND p.id!='$topPostId' AND c.id = p.category_id LIMIT 1";
                $topPostResult = mysqli_query($conn, $top_post);
                if ($topPostResult) {
                    if (mysqli_num_rows($topPostResult) == 1) {
                        $topPostData = mysqli_fetch_assoc($topPostResult);
                        ?>
                        <div class="position-relative overflow-hidden rounded">
                            <img src="../../<?= $topPostData['image'] ?>" class="img-fluid rounded img-zoomin w-100" alt="">
                            <div class="d-flex justify-content-center px-4 position-absolute flex-wrap"
                                style="bottom: 10px; left: 0;">
                                <a href="#" class="text-white me-3 link-hover"><i class="fa fa-clock"></i> 06 minute read</a>
                                <a href="#" class="text-white me-3 link-hover"><i class="fa fa-eye"></i> 3.5k Views</a>
                                <a href="#" class="text-white me-3 link-hover"><i class="fa fa-comment-dots"></i> 05 Comment</a>
                                <a href="#" class="text-white link-hover"><i class="fa fa-arrow-up"></i> 1.5k Share</a>
                            </div>
                        </div>
                        <div class="border-bottom py-3">
                            <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>"
                                class="display-6 text-dark mb-0 link-hover">
                                <?= $topPostData['title'] ?>
                            </a>
                        </div>
                        <p class="mt-3 mb-4">
                            <?php
                            for ($i = 0; $i <= 420; $i++) {
                                echo $topPostData['description'][$i];
                            }
                            ?> ...
                        </p>
                        <?php
                    } else {
                        ?>
                        <p>No item has been selected as top post.</p>
                        <?php
                    }
                }
                ?>
                <div class="bg-light p-4 rounded">
                    <div class="news-2">
                        <h3 class="mb-4">Top Story</h3>
                    </div>
                    <?php
                    if ($topPostData) {
                        ?>
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="rounded overflow-hidden">
                                    <img src="../../<?= $topPostImage ?>" class="img-fluid rounded img-zoomin w-100" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <a href="single-post.php?category=<?= $topPostCategorySlug ?>&&title=<?= $topPostTitleSlug ?>"
                                        class="h3">
                                        <?= $topPostTitle ?>
                                    </a>
                                    <p class="mb-0 fs-5"><i class="fa fa-clock"> 06 minute read</i> </p>
                                    <p class="mb-0 fs-5"><i class="fa fa-eye"> 3.5k Views</i></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <p>No item has been selected as top post.</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 pt-0">
                    <div class="row g-4">
                        <?php
                        if ($topPostData) {
                            ?>
                            <div class="col-12">
                                <div class="rounded overflow-hidden">
                                    <img src="../../<?= $topPostImage ?>" class="img-fluid rounded img-zoomin w-100" alt="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column">
                                    <a href="single-post.php?category=<?= $topPostCategorySlug ?>&&title=<?= $topPostTitleSlug ?>"" class="
                                        h4 mb-2">
                                        <?= $topPostTitle ?>
                                    </a>
                                    <p class="fs-5 mb-0"><i class="fa fa-clock"> 06 minute read</i> </p>
                                    <p class="fs-5 mb-0"><i class="fa fa-eye"> 3.5k Views</i></p>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <p>No item has been selected as top post.</p>
                            <?php
                        }
                        ?>
                        <?php
                        $sideTopPosts = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, p.*, c.* FROM posts as p, categories as c WHERE p.status='0' AND c.id = p.category_id AND p.id!='$topPostId' ORDER BY p.id DESC LIMIT 5";
                        $sideTopResult = mysqli_query($conn, $sideTopPosts);
                        if ($sideTopResult) {
                            if (mysqli_num_rows($sideTopResult) > 0) {
                                foreach ($sideTopResult as $item):
                                    if ($item['total_views'] >= 1000) {
                                        $total_views = round($item['total_views'] / 1000) . "k";
                                    } else {
                                        $total_views = $item['total_views'];
                                    }
                                    ?>
                                    <div class="col-12">
                                        <div class="row g-4 align-items-center">
                                            <div class="col-5">
                                                <div class="overflow-hidden rounded">
                                                    <img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>"
                                                        class="img-zoomin img-fluid rounded w-100" alt="">
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="features-content d-flex flex-column">
                                                    <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>"
                                                        class="h6">
                                                        <?= $item['title'] ?>
                                                    </a>
                                                    <small><i class="fa fa-clock"> 06 minute read</i> </small>
                                                    <small><i class="fa fa-eye">
                                                            <?= $total_views ?> Views
                                                        </i></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Post Section End -->

<!-- Banner Start -->
<div class="container-fluid py-5 my-5"
    style="background: linear-gradient(rgba(202, 203, 185, 1), rgba(202, 203, 185, 1));">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <h1 class="mb-4 text-primary">RaNews</h1>
                <h1 class="mb-4">Get Every Weekly Updates</h1>
                <p class="text-dark mb-4 pb-2">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown printer took a galley
                </p>
                <div class="position-relative mx-auto">
                    <input class="form-control w-100 py-3 rounded-pill" type="email" placeholder="Your Business Email">
                    <button type="submit"
                        class="btn btn-primary py-3 px-5 position-absolute rounded-pill text-white h-100"
                        style="top: 0; right: 0;">Subscribe Now</button>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="rounded">
                    <img src="../../assets/public/img/banner-img.jpg" class="img-fluid rounded w-100 rounded" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest News Start -->
<div class="container-fluid latest-news py-5">
    <div class="container py-5">
        <h2 class="mb-4">Latest News</h2>
        <div class="latest-news-carousel owl-carousel">
            <?php
            $topPosts = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND p.total_views > '1000' AND c.id = p.category_id AND p.created_by_id = u.id ORDER BY p.id DESC LIMIT 5";
            $result = mysqli_query($conn, $topPosts);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $item):
                        ?>
                        <div class="latest-news-item">
                            <div class="bg-light rounded">
                                <div class="rounded-top overflow-hidden">
                                    <img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>"
                                        class="img-zoomin img-fluid rounded-top w-100" alt="">
                                </div>
                                <div class="d-flex flex-column p-4">
                                    <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>"
                                        class="h5">
                                        <?= $item['title'] ?>
                                    </a>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="small text-body link-hover">by
                                            <?= $item['userName'] ?>
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
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Latest News End -->

<!-- Most Populer News Start -->
<div class="container-fluid populer-news py-5">
    <div class="container py-5">
        <div class="tab-class mb-4">
            <div class="row g-4">
                <div class="col-lg-8 col-xl-9">
                    <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                        <h1 class="mb-4">What’s New</h1>
                        <ul class="nav nav-pills d-inline-flex text-center">
                            <?php
                            $categories = "SELECT * FROM categories ORDER BY sort LIMIT 5";
                            $categoryResult = mysqli_query($conn, $categories);
                            if (mysqli_num_rows($categoryResult) > 0) {
                                foreach ($categoryResult as $item):
                                    $name_slug = $item['name_slug'];
                                    ?>
                                    <li class="nav-item mb-3">
                                        <a class="d-flex py-2 bg-light rounded-pill <?= $name_slug == 'সর্বশেষ' ? 'active' : '' ?> me-2"
                                            data-bs-toggle="pill" href="#<?= $item['name_slug'] ?>">
                                            <span class="text-dark" style="width: 100px;">
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
                    <div class="tab-content mb-4">
                        <?php
                        if (mysqli_num_rows($categoryResult) > 0) {
                            foreach ($categoryResult as $item):
                                $name_slug = $item['name_slug'];
                                ?>
                                <div id="<?= $name_slug ?>"
                                    class="tab-pane fade show p-0 <?= $name_slug == 'সর্বশেষ' ? 'active' : '' ?>">
                                    <div class="row g-4">
                                        <?php
                                        $postsByCategory = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND c.id = p.category_id AND c.name_slug='$name_slug' AND p.created_by_id = u.id ORDER BY p.id DESC LIMIT 6";
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
                                                                    <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>" class="h6">
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
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        }
                        ?>
                    </div>
                    <div class="border-bottom mb-4">
                        <h2 class="my-4">Most Views News</h2>
                    </div>
                    <div class="whats-carousel owl-carousel">
                        <?php
                        $mostViewedPosts = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND p.total_views > '5000' AND c.id = p.category_id AND p.created_by_id = u.id ORDER BY p.id DESC LIMIT 4";
                        $mostViewedPostsResult = mysqli_query($conn, $mostViewedPosts);
                        if ($mostViewedPostsResult) {
                            if (mysqli_num_rows($mostViewedPostsResult) > 0) {
                                foreach ($mostViewedPostsResult as $item):
                                    if ($item['total_views'] >= 1000) {
                                        $total_views = round($item['total_views'] / 1000) . "k";
                                    } else {
                                        $total_views = $item['total_views'];
                                    }
                                    ?>
                                    <div class="whats-item">
                                        <div class="bg-light rounded">
                                            <div class="rounded-top overflow-hidden">
                                                <img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>"" class="
                                                    img-zoomin img-fluid rounded-top w-100" alt="">
                                            </div>
                                            <div class="d-flex flex-column p-4">
                                                <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>" class="h4">
                                                    <?= $item['title'] ?>
                                                </a>
                                                <div class="d-flex justify-content-between">
                                                    <a href="#" class="small text-body link-hover">by
                                                        <?= $item['userName'] ?>
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
                            }
                        }
                        ?>
                    </div>
                    <div class="mt-5 lifestyle">
                        <div class="border-bottom mb-4">
                            <h1 class="mb-4">Life Style</h1>
                        </div>
                        <div class="row g-4">
                            <?php
                            $postsByCategory = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND c.id = p.category_id AND c.name_slug='বিনোদন' AND p.created_by_id = u.id ORDER BY p.id DESC LIMIT 2";
                            $postsByCategoryResult = mysqli_query($conn, $postsByCategory);
                            if ($postsByCategoryResult) {
                                if (mysqli_num_rows($postsByCategoryResult) > 0) {
                                    foreach ($postsByCategoryResult as $item):
                                        ?>
                                        <div class="col-lg-6">
                                            <div class="lifestyle-item rounded">
                                                <img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>" class="
                                                    img-fluid w-100 rounded" alt="">
                                                <div class="lifestyle-content">
                                                    <div class="mt-auto">
                                                        <a href="single-post.php?category=<?= $item['name_slug'] ?>&&title=<?= $item['title_slug'] ?>" class="h4 text-white link-hover">
                                                            <?= $item['title'] ?>
                                                        </a>
                                                        <div class="d-flex justify-content-between mt-4">
                                                            <a href="#" class="small text-white link-hover">By
                                                                <?= $item['userName'] ?>
                                                            </a>
                                                            <small class="text-white d-block"><i
                                                                    class="fas fa-calendar-alt me-1"></i>
                                                                <?= date("M d, Y", strtotime($item['postUpdatedDate'])); ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h4 class="mb-4">Stay Connected</h4>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <a href="#"
                                            class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                            <i
                                                class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">13,977 Fans</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-twitter btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">21,798 Follower</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">7,999 Subscriber</span>
                                        </a>
                                        <a href="#"
                                            class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                            <i
                                                class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
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
                                <div class="row g-4">
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
                                                        <a class="d-flex py-2 bg-light rounded-pill me-2" href="category-posts.php?category=<?= $item['name_slug'] ?>">
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
                                            <img src="../../assets/public/img/banner-2.jpg"
                                                class="img-fluid w-100 rounded" alt="">
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
</div>
<!-- Most Populer News End -->

<?php
include '../includes/public/footer.php';
?>