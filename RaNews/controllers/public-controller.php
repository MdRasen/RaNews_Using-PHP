<?php
// Database connection with controller, model
require 'config/dbcon.php';
require 'controller.php';
require '../models/model.php';

// User login 
if (isset($_POST['loginBtn'])) {

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $result = userByEmail($email);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $userResult = mysqli_fetch_assoc($result);
            $hashedPassword = $userResult['password'];
            if (!password_verify($password, $hashedPassword)) {
                redirect('../views/public/login.php', 'Invalid password, Please try again.');
            }
            if ($userResult['status'] == 1) {
                redirect('../views/public/login.php', 'Your account has been banned, Contact your admin!');
            }
            $_SESSION['loggedIn'] = true;
            $_SESSION['loggedInUser'] = [
                'user_id' => $userResult['id'],
                'name' => $userResult['name'],
                'email' => $userResult['email'],
                'image' => $userResult['image'],
            ];
            redirect('../views/admin/dashboard.php', 'User has logged in successfully!');
        } else {
            redirect('../views/public/login.php', 'Invalid email address, Please try again.');
        }
    } else {
        redirect('../views/public/login.php', 'Something went wrong, Please try again.');
    }
}

// User logout
if (isset($_GET['logout']) == "true") {
    if (isset($_SESSION['loggedIn'])) {
        unset($_SESSION['loggedIn']);
        unset($_SESSION['loggedInUser']);
        redirect('../views/public/login.php', 'User has been logged out successfully!');
    }
}
