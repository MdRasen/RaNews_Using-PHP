<?php
// Database connection with controller, model
require 'config/dbcon.php';
require 'controller.php';
require '../models/model.php';

// Add category 
if (isset($_POST['createCategory'])) {
    $name = validate($_POST['name']);
    $short_desc = validate($_POST['short_desc']);
    $sort = validate($_POST['sort']);
    $status = validate($_POST['status']);

    // Get category by name
    $checkCategory = categoryByName($name);
    if (mysqli_num_rows($checkCategory) > 0) {
        redirect('../views/admin/add-category.php', 'Category already exist, Please try again.');
    } else {
        $data = [
            'name' => $name,
            'short_desc' => $short_desc,
            'sort' => $sort,
            'status' => $status
        ];
        // Inert category
        $result = insertCategory($data);
        if ($result) {
            redirect('../views/admin/manage-category.php', 'Category has been created successfully.');
        } else {
            redirect('../views/admin/add-category.php', 'Something went wrong, Please try again!');
        }
    }
}
