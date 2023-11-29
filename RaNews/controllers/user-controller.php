<?php
// Database connection with controller, model
require 'config/dbcon.php';
require 'controller.php';
require '../models/model.php';

// Add user 
if (isset($_POST['saveUserBtn'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $type = validate($_POST['type']);
    $u_status = validate($_POST['u_status']);

    // Get user by email
    $checkUser = getByEmail($email);
    if (mysqli_num_rows($checkUser) > 0) {
        jsonResponse(403, "error", 'Email already exist, Please try another!');
    } else {
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $bcrypt_password,
            'type' => $type,
            'status' => $u_status
        ];
        // Inert user
        $result = insertUser($data);
        if ($result) {
            $_SESSION["status"] = 'User has been created successfully.';
            jsonResponse(200, 'success', 'User has been created successfully.');
        } else {
            jsonResponse(500, 'error', 'Something went wrong, Please try again.');
        }
    }
}
