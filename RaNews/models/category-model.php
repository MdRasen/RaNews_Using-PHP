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

// Get category by id
function categoryById($id)
{
    global $conn;
    $id = validate($id);

    $query = "SELECT * FROM categories WHERE id='$id' LIMIT 1";
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
function updateCategory($id, $data)
{
    global $conn;
    $id = validate($id);

    $updateDataString = "";
    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }
    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE categories SET $finalUpdateData WHERE id = '$id'";

    $result = mysqli_query($conn, $query);
    return $result;
}

// Delete data using this function
function deleteCategory($id)
{
    global $conn;
    $id = validate($id);

    $query = "DELETE FROM categories WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}
