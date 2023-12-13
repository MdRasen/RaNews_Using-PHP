<!-- Navbar start -->
<div class="container-fluid sticky-top px-0">
    <div class="container-fluid topbar bg-dark d-none d-lg-block">
        <div class="container px-0">
            <div class="topbar-top d-flex justify-content-between flex-lg-wrap">
                <div class="top-info flex-grow-0">
                    <span class="rounded-circle btn-sm-square bg-primary me-2">
                        <i class="fas fa-bolt text-white"></i>
                    </span>
                    <div class="pe-2 me-3 border-end border-white d-flex align-items-center">
                        <p class="mb-0 text-white fs-6 fw-normal">Trending</p>
                    </div>
                    <div class="overflow-hidden" style="width: 735px;">
                        <div id="note" class="ps-2">
                            <?php
                            $top_post = "SELECT * FROM posts WHERE top_status='1' AND status='0' LIMIT 1";
                            $result = mysqli_query($conn, $top_post);
                            if ($result) {
                                if (mysqli_num_rows($result) == 1) {
                                    $topPostData = mysqli_fetch_assoc($result);
                                    $image_src = $topPostData['image'];
                                    $title = $topPostData['title'];
                                } else {
                                    $title = "No news has been selected as top news!";
                                }
                            }
                            ?>
                            <img src="../../<?= $image_src == true ? $image_src : 'assets/admin/img/no-photo.jpg' ?>"
                                class="img-fluid rounded-circle border border-3 border-primary me-2"
                                style="width: 30px; height: 30px;" alt="">
                            <a href="#">
                                <p class="text-white mb-0 link-hover">
                                    <?= $title ?>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="top-link flex-lg-wrap">
                    <i class="fas fa-calendar-alt text-white border-end border-secondary pe-2 me-2"> <span
                            class="text-body">
                            <?= date('D') ?>,
                            <?= date('M d, Y') ?>
                        </span></i>
                    <div class="d-flex icon">
                        <?= isset($_SESSION['loggedIn']) ? '<a href="../admin/dashboard.php" class="me-2">Back To Dashboard</a>' : '<a href="login.php" class="me-2">Login Now</a>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-light">
        <div class="container px-0">
            <nav class="navbar navbar-light navbar-expand-xl">
                <a href="index.php" class="navbar-brand mt-3">
                    <p class="text-primary display-6 mb-2" style="line-height: 0;">Ra</p>
                    <small class="text-body fw-normal" style="letter-spacing: 12px;">News</small>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
                    <div class="navbar-nav mx-auto border-top">
                        <?php
                        $categories = viewCategories();
                        if (mysqli_num_rows($categories) > 0) {
                            foreach ($categories as $item):
                                ?>
                                <a href="contact.html" class="nav-item nav-link">
                                    <?= $item['name'] ?>
                                </a>
                                <?php
                            endforeach;
                        }
                        ?>
                    </div>
                    <div class="d-flex flex-nowrap border-top pt-3 pt-xl-0">
                        <div class="d-flex">
                            <img src="../../assets/public/img/weather-icon.png" class="img-fluid w-100 me-2" alt="">
                            <div class="d-flex align-items-center">
                                <?php
                                $city = 'Dhaka';
                                $country = 'BD';
                                $url = 'http://api.openweathermap.org/data/2.5/forecast/daily?q=' . $city . ',' . $country . '&units=metric&cnt=7&lang=en&appid=c0c4a4b4047b97ebc5948ac9c48c0559';
                                $json = file_get_contents($url);
                                $data = json_decode($json, true);
                                $data['city']['name'];
                                // var_dump($data );
                                
                                foreach ($data['list'] as $day => $value) {
                                    if ($day == 0) {
                                        ?>
                                        <strong class="fs-4 text-secondary">
                                            <?= floor($value['temp']['max']) . '°C'; ?>
                                        </strong>
                                        <?php
                                    }
                                }
                                ?>
                                <div class="d-flex flex-column ms-2" style="width: 150px;">
                                    <span class="text-body">Dhaka, BD</span>
                                    <small>
                                        <?= date('D') ?> .
                                        <?= date("M d, Y", strtotime(date('M d, Y'))); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <button
                            class="btn-search btn border border-primary btn-md-square rounded-circle bg-white my-auto"
                            data-bs-toggle="modal" data-bs-target="#searchModal"><i
                                class="fas fa-search text-primary"></i></button>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->