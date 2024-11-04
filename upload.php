<?php
if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
    $filePath = 'uploads/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        require 'import.php';
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error uploading file."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No file uploaded."]);
}
?>
