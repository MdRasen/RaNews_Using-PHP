<?php
// Database connection with controller, model
require 'config/dbcon.php';
require 'controller.php';
require '../models/model.php';

// Add post 
if (isset($_POST['createPost'])) {
    $title = validate($_POST['title']);
    $finalImage = "NULL";
    $category_id = validate($_POST['category_id']);
    $desc = validate($_POST['desc']);
    $tags = validate($_POST['tags']);
    $status = validate($_POST['status']);

    // Get category by id
    $checkCategory = categoryById($category_id);
    if ($checkCategory['status'] == 200) {
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
        }
        $title_slug = stringToSlug($title);
        $data = [
            'title' => $title,
            'title_slug' =>  $title_slug,
            'image' => $finalImage,
            'category_id' => $checkCategory['data']['id'],
            'description' => $desc,
            'tags' => $tags,
            'created_by_id' => $_SESSION['loggedInUser']['user_id'],
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s', strtotime('+6 hours'))
        ];
        // Inert post
        $result = insertPost($data);
        if ($result) {
            redirect('../views/admin/manage-post.php', 'Post has been created successfully.');
        } else {
            redirect('../views/admin/add-post.php', 'Something went wrong, Please try again!');
        }
    } else {
        redirect('../views/admin/add-post.php', 'Category not found, Please try again.');
    }
}
