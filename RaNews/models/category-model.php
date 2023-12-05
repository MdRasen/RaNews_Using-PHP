<?php
// Add all the required functions for category-model

// Get category by name
function categoryByName($name)
{
    global $conn;
    $name = validate($name);

    $query = "SELECT * FROM categories WHERE name='$name' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Insert data using this function
function insertCategory($data)
{
    global $conn;

    $columns = array_keys(($data));
    $values = array_values(($data));

    $finalColumns = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO categories ($finalColumns) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// View data using this function
function viewCategories()
{
    global $conn;

    $query = "SELECT * FROM categories ORDER BY sort";
    $result = mysqli_query($conn, $query);
    return $result;
}
