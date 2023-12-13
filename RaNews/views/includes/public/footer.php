<!-- Footer Start -->
<div class="container-fluid bg-dark footer py-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#" class="d-flex flex-column flex-wrap">
                        <p class="text-white mb-0 display-6">Ra</p>
                        <small class="text-light" style="letter-spacing: 11px; line-height: 0;">News</small>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="d-flex position-relative rounded-pill overflow-hidden">
                        <input class="form-control border-0 w-100 py-3 rounded-pill" type="email"
                            placeholder="example@gmail.com">
                        <button type="submit"
                            class="btn btn-primary border-0 py-3 px-5 rounded-pill text-white position-absolute"
                            style="top: 0; right: 0;">Subscribe Now</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6 col-xl-3">
                <div class="footer-item-1">
                    <h4 class="mb-4 text-white">Get In Touch</h4>
                    <p class="text-secondary line-h">Address: <span class="text-white">123 Streat, New York</span></p>
                    <p class="text-secondary line-h">Email: <span class="text-white">Example@gmail.com</span></p>
                    <p class="text-secondary line-h">Phone: <span class="text-white">+0123 4567 8910</span></p>
                    <div class="d-flex line-h">
                        <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-twitter text-dark"></i></a>
                        <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-facebook-f text-dark"></i></a>
                        <a class="btn btn-light me-2 btn-md-square rounded-circle" href=""><i
                                class="fab fa-youtube text-dark"></i></a>
                        <a class="btn btn-light btn-md-square rounded-circle" href=""><i
                                class="fab fa-linkedin-in text-dark"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="footer-item-2">
                    <div class="d-flex flex-column mb-4">
                        <h4 class="mb-4 text-white">Recent Posts</h4>
                        <?php
                        $topPosts = "SELECT p.id as postId, p.image as postImage, p.status as postStatus, p.updated_at as postUpdatedDate, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND c.id = p.category_id AND p.created_by_id = u.id ORDER BY p.id DESC LIMIT 2";
                        $result = mysqli_query($conn, $topPosts);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $item):
                                    ?>
                                    <a href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle border border-2 border-primary overflow-hidden">
                                                <img src="../../<?= $item['postImage'] != "NULL" ? $item['postImage'] : 'assets/admin/img/no-photo.jpg' ?>"
                                                    class="img-zoomin  rounded-circle" style="width: 50px; height: 50px; " alt="">
                                            </div>
                                            <div class="d-flex flex-column ps-4">
                                                <p class="text-uppercase text-white mb-3">
                                                    <?= $item['categoryName'] ?>
                                                </p>
                                                <a href="#" class="h6 text-white">
                                                    <?= $item['title'] ?>
                                                </a>
                                                <small class="text-white d-block"><i class="fas fa-calendar-alt me-1"></i>
                                                    <?= date("M d, Y", strtotime($item['postUpdatedDate'])); ?>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                endforeach;
                            } else {
                                $title = "No news has been selected as top news!";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="d-flex flex-column text-start footer-item-3">
                    <h4 class="mb-4 text-white">Categories</h4>
                    <?php
                    $query = "SELECT * FROM categories WHERE status='0' ORDER BY sort";
                    $categoryResult = mysqli_query($conn, $query);
                    if (mysqli_num_rows($categoryResult) > 0) {
                        foreach ($categoryResult as $item):
                            ?>
                            <a class="btn-link text-white" href="#"><i class="fas fa-angle-right text-white me-2"></i>
                                <?= $item['name'] ?>
                            </a>
                            <?php
                        endforeach;
                    } else {
                        ?>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3">
                <div class="footer-item-4">
                    <h4 class="mb-4 text-white">Our Gallery</h4>
                    <div class="row g-2">
                        <?php
                        $galleries = viewGalleries();
                        if (mysqli_num_rows($galleries) > 0) {
                            foreach ($galleries as $item):
                                ?>
                                <div class="col-4">
                                    <div class="rounded overflow-hidden">
                                        <img src="../../<?= $item['image_src'] == true ? $item['image_src'] : 'assets/admin/img/no-photo.jpg' ?>"
                                            class="img-zoomin img-fluid rounded w-100" style="height: 60px;" alt="">
                                    </div>
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
<!-- Footer End -->


<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>RaNews</a>, All
                    right reserved.</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">
                Developed By <a class="border-bottom" href="#">devRasen</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary border-2 border-white rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/public/lib/easing/easing.min.js"></script>
<script src="../../assets/public/lib/waypoints/waypoints.min.js"></script>
<script src="../../assets/public/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="../../assets/public/js/main.js"></script>
</body>

</html>