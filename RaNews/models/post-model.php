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

// View data using this function
function viewPosts()
{
    global $conn;

    $query = "SELECT * FROM posts";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Get post by id
function postById($id)
{
    global $conn;
    $id = validate($id);

    $query = "SELECT * FROM posts WHERE id='$id' LIMIT 1";
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

// Update data using this function
function updatePost($id, $data)
{
    global $conn;
    $id = validate($id);

    $updateDataString = "";
    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }
    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE posts SET $finalUpdateData WHERE id = '$id'";

    $result = mysqli_query($conn, $query);
    return $result;
}

// Delete data using this function
function deletePost($id)
{
    global $conn;
    $id = validate($id);

    $query = "DELETE FROM posts WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}
