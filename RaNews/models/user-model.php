<?php
// Add all the required functions for user-model

// Get user by email address
function getByEmail($email)
{
    global $conn;
    $email = validate($email);

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Insert data using this function
function insertUser($data)
{
    global $conn;

    $columns = array_keys(($data));
    $values = array_values(($data));

    $finalColumns = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO users ($finalColumns) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}
