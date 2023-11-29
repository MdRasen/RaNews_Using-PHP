<?php
session_start();
// Add all the required models
require 'user-model.php';

// Input field validation
function validate($inputData)
{
    global $conn;
    if ($inputData != NULL) {
        $validateData = mysqli_real_escape_string($conn, $inputData);
        return trim($validateData);
    }
}

// To return jsonResponse result
function jsonResponse($status, $status_type, $message)
{
    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];
    echo json_encode($response);
    return;
}
