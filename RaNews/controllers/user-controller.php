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
    $checkUser = userByEmail($email);
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

// Update user 
if (isset($_POST['updateUser'])) {
    $id = validate($_POST['user_id']);
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $type = validate($_POST['type']);
    $u_status = validate($_POST['u_status']);

    $userData = userById($id);
    if ($userData['data']) {
        $emailCheckQuery = "SELECT * FROM users WHERE email='$email' AND id!='$id'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        if ($emailCheckResult) {
            if (mysqli_num_rows($emailCheckResult) > 0) {
                redirect('../views/admin/edit-user.php?id=' . $id, 'Email already used by another customer.');
            }
        }
    } else {
        redirect('../views/admin/edit-user.php?id=' . $id, 'No user found, Please try again');
    }

    if ($phone != "" && !is_numeric($phone)) {
        redirect('../views/admin/edit-user.php?id=' . $id, 'Please enter a valid phone number!');
    } else {
        // To check if the image is selected or not
        if ($_FILES['image']['size'] > 0) {
            $path = "../assets/admin/upload/images/";
            // Get image extention
            $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            // Generate file name
            $fileName = time() . '.' . $image_ext;
            // Move the uploaded image
            move_uploaded_file($_FILES['image']['tmp_name'], $path . $fileName);
            $finalImage = "assets/admin/upload/images/" . $fileName;

            // To delete file
            $deleteImage = "../" . $userData['data']['image'];
            if (file_exists($deleteImage)) {
                unlink($deleteImage);
            }
        } else {
            $finalImage = $userData['data']['image'];
        }

        if ($password != "") {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $hashed_password = $userData['data']['password'];
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $hashed_password,
            'image' => $finalImage,
            'type' => $type,
            'status' => $u_status
        ];

        $result = updateUser($id, $data);
        if ($result) {
            redirect('../views/admin/manage-user.php', 'User has been updated successfully.');
        } else {
            redirect('../views/admin/edit-user.php?id=' . $id, 'Something went wrong, Please try again!');
        }
    }
}

// Delete user
if (isset($_POST['deleteUser'])) {
    $delete_id = validate($_POST['delete_id']);

    $user = userById($delete_id);
    if ($user['status'] == 200) {
        $userDeleteRes = deleteUser($delete_id);
        if ($userDeleteRes) {
            redirect('../views/admin/manage-user.php', 'User has been deleted successfully.');
        } else {
            redirect('../views/admin/manage-user.php', 'Something went wrong, Please try again.');
        }
    } else {
        redirect('../views/admin/manage-user.php', $user['message']);
    }
}
