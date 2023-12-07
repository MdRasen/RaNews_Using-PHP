<?php
// Database connection with controller, model
require 'config/dbcon.php';
require 'controller.php';
require '../models/model.php';

// Add image 
if (isset($_POST['uploadImage'])) {
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

        $data = [
            'image_src' => $finalImage,
        ];
        // Inert image
        $result = insertImage($data);
        if ($result) {
            redirect('../views/admin/manage-gallery.php', 'Image has been uploaded successfully.');
        } else {
            redirect('../views/admin/manage-gallery.php', 'Something went wrong, Please try again!');
        }
    } else {
        redirect('../views/admin/manage-gallery.php', 'Please select an image, try again!');
    }
}

// Delete image
if (isset($_POST['deleteImage'])) {
    $delete_id = validate($_POST['delete_id']);

    $image = imageById($delete_id);
    if ($image['status'] == 200) {
        $imageDeleteRes = deleteImage($delete_id);
        if ($imageDeleteRes) {
            // To delete file
            $deleteImage = "../" . $image['data']['image_src'];
            if (file_exists($deleteImage)) {
                unlink($deleteImage);
            }
            redirect('../views/admin/manage-gallery.php', 'Image has been deleted successfully.');
        } else {
            redirect('../views/admin/manage-gallery.php', 'Something went wrong, Please try again.');
        }
    } else {
        redirect('../views/admin/manage-gallery.php', $user['message']);
    }
}
