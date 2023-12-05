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

// Update category 
if (isset($_POST['updateCategory'])) {
    $id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $short_desc = validate($_POST['short_desc']);
    $sort = validate($_POST['sort']);
    $status = validate($_POST['status']);

    $userData = categoryById($id);
    if ($userData['data']) {
        $nameCheckQuery = "SELECT * FROM categories WHERE name='$name' AND id!='$id'";
        $nameCheckResult = mysqli_query($conn, $nameCheckQuery);

        if ($nameCheckResult) {
            if (mysqli_num_rows($nameCheckResult) > 0) {
                redirect('../views/admin/edit-category.php?id=' . $id, 'Category already exist, Please try again.');
            }
        }
    } else {
        redirect('../views/admin/edit-category.php?id=' . $id, 'No category found, Please try again');
    }

    $data = [
        'name' => $name,
        'short_desc' => $short_desc,
        'sort' => $sort,
        'status' => $status
    ];

    $result = updateCategory($id, $data);
    if ($result) {
        redirect('../views/admin/manage-category.php', 'User has been updated successfully.');
    } else {
        redirect('../views/admin/edit-category.php?id=' . $id, 'Something went wrong, Please try again!');
    }
}

// Delete category
if (isset($_POST['deleteCategory'])) {
    $delete_id = validate($_POST['delete_id']);

    $category = categoryById($delete_id);
    if ($category['status'] == 200) {
        $categoryDeleteRes = deleteCategory($delete_id);
        if ($categoryDeleteRes) {
            redirect('../views/admin/manage-category.php', 'Category has been deleted successfully.');
        } else {
            redirect('../views/admin/manage-category.php', 'Something went wrong, Please try again.');
        }
    } else {
        redirect('../views/admin/manage-category.php', $category['message']);
    }
}
