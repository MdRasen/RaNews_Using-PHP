<?php
// Add all the required functions for user-model

// Get user by email address
function userByEmail($email)
{
    global $conn;
    $email = validate($email);

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Get user by id
function userById($id)
{
    global $conn;
    $userId = validate($id);

    $query = "SELECT * FROM users WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => "Record found!"
            ];
            return $response;
        } else {
            $response = [
                'status' => 404,
                'message' => "No data found!"
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => "Something went wronggg!"
        ];
        return $response;
    }
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

// View data using this function
function viewUsers()
{
    global $conn;

    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Update data using this function
function updateUser($id, $data)
{
    global $conn;
    $id = validate($id);

    $updateDataString = "";
    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }
    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE users SET $finalUpdateData WHERE id = '$id'";

    $result = mysqli_query($conn, $query);
    return $result;
}

// Delete data using this function
function deleteUser($id)
{
    global $conn;
    $id = validate($id);

    $query = "DELETE FROM users WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}
