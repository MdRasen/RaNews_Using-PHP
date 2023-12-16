<?php
// Add all the required functions for public-model

// Get post by category & title slug
function postByCategoryTitle($categorySlug, $titleSlug)
{
    global $conn;
    $categorySlug = validate($categorySlug);
    $titleSlug = validate($titleSlug);

    // $query = "SELECT * FROM categories WHERE id='$id' LIMIT 1";
    $query = "SELECT p.image as postImage, c.name as categoryName, u.name as userName, p.*, c.*, u.* FROM posts as p, categories as c, users as u WHERE p.status='0' AND p.title_slug='$titleSlug' AND c.name_slug='$categorySlug' AND p.created_by_id = u.id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => "Something went wrong!"
            ];
            return $response;
        } else {
            $response = [
                'status' => 404,
                'message' => "Something went wrong!"
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => "Something went wrong!"
        ];
        return $response;
    }
}