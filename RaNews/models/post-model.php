<?php
// Add all the required functions for post-model

// Insert data using this function
function insertPost($data)
{
    global $conn;

    $columns = array_keys(($data));
    $values = array_values(($data));

    $finalColumns = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO posts ($finalColumns) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}
