<?php
// Add all the required functions for gallery-model

// Insert data using this function
function insertImage($data)
{
    global $conn;

    $columns = array_keys(($data));
    $values = array_values(($data));

    $finalColumns = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO galleries ($finalColumns) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// View data using this function
function viewGalleries()
{
    global $conn;

    $query = "SELECT * FROM galleries";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Get image by id
function imageById($id)
{
    global $conn;
    $imageId = validate($id);

    $query = "SELECT * FROM galleries WHERE id='$imageId' LIMIT 1";
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

// Delete data using this function
function deleteImage($id)
{
    global $conn;
    $id = validate($id);

    $query = "DELETE FROM galleries WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}
