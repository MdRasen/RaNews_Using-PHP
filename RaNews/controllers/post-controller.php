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

    if ($desc == "") {
        redirect('../views/admin/add-post.php', 'Fill the required fields and try again.');
    }

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
            'top_status' => 0,
            'total_views' => 0,
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

// Update post
if (isset($_POST['updatePost'])) {
    $id = validate($_POST['post_id']);
    $title = validate($_POST['title']);
    $finalImage = "NULL";
    $category_id = validate($_POST['category_id']);
    $desc = validate($_POST['desc']);
    $tags = validate($_POST['tags']);
    $status = validate($_POST['status']);
    $top_status = validate($_POST['top_status']);

    if ($desc == "") {
        redirect('../views/admin/edit-post.php?id=' . $id, 'Fill the required fields and try again.');
    }

    $postData = postById($id);
    if ($postData['data']) {
        $titleCheckQuery = "SELECT * FROM posts WHERE title='$title' AND id!='$id'";
        $titleCheckResult = mysqli_query($conn, $titleCheckQuery);

        if ($titleCheckResult) {
            if (mysqli_num_rows($titleCheckResult) > 0) {
                redirect('../views/admin/edit-post.php?id=' . $id, 'Title already exist, Please try again.');
            }
        }
    } else {
        redirect('../views/admin/edit-post.php?id=' . $id, 'No user found, Please try again');
    }

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

            // To delete file
            $deleteImage = "../" . $postData['data']['image'];
            if (file_exists($deleteImage)) {
                unlink($deleteImage);
            }
        } else {
            $finalImage = $postData['data']['image'];
        }

        $title_slug = stringToSlug($title);

        $data = [
            'title' => $title,
            'title_slug' =>  $title_slug,
            'image' => $finalImage,
            'category_id' => $checkCategory['data']['id'],
            'description' => $desc,
            'tags' => $tags,
            'status' => $status,
            'top_status' => $top_status,
            'updated_at' => date('Y-m-d H:i:s', strtotime('+6 hours'))
        ];

        $result = updatePost($id, $data);
        if ($result) {
            redirect('../views/admin/manage-post.php', 'Post has been updated successfully.');
        } else {
            redirect('../views/admin/edit-post.php?id=' . $id, 'Something went wrong, Please try again!');
        }
    } else {
        redirect('../views/admin/edit-post.php', 'Category not found, Please try again.');
    }
}

// Delete post
if (isset($_POST['deletePost'])) {
    $delete_id = validate($_POST['delete_id']);

    $post = postById($delete_id);
    if ($post['status'] == 200) {
        $postDeleteRes = deletePost($delete_id);
        if ($postDeleteRes) {
            redirect('../views/admin/manage-post.php', 'Post has been deleted successfully.');
        } else {
            redirect('../views/admin/manage-post.php', 'Something went wrong, Please try again.');
        }
    } else {
        redirect('../views/admin/manage-post.php', $post['message']);
    }
}
