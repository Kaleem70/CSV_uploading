<?php
include('conn.php');
$conn->query("TRUNCATE TABLE temp_table");
echo json_encode(["status" => "success"]);
?>
