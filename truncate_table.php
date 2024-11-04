<?php
include('conn.php');
$sql = "TRUNCATE TABLE temp_table";
$conn->query($sql);
$conn->close();
?>
