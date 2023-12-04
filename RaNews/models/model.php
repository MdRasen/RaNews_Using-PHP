<?php
session_start();
// Add all the required models
require 'user-model.php';
require 'public-model.php';

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

// Redirect from one page to another page with the message (status)
function redirect($url, $status)
{
    $_SESSION["status"] = $status;
    header('Location:' . $url);
    exit(0);
}

// Display messages or status after any process
function alertMessage()
{
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole! </strong>' . $_SESSION['status'] . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
        unset($_SESSION['status']);
    }
}
