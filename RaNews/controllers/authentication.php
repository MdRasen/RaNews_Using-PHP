<?php

if (isset($_SESSION['loggedIn'])) {
    $email = $_SESSION['loggedInUser']['email'];

    $result = userByEmail($email);
    if (mysqli_num_rows($result) == 0) {
        unset($_SESSION['loggedIn']);
        unset($_SESSION['loggedInUser']);
        redirect('../../views/public/login.php', 'Access denied, Please login in again.');
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($row['status'] == 1) {
            unset($_SESSION['loggedIn']);
            unset($_SESSION['loggedInUser']);
            redirect('../../views/public/login.php', 'Your account has been banned, Contact your admin!');
        }
    }
} else {
    redirect('../../views/public/login.php', 'Please, Login to continue.');
}
