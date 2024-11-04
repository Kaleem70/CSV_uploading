<?php
include('conn.php');

$sql = "SELECT COUNT(*) AS total_records,
               SUM(due_amount) AS total_due_amount,
               SUM(paid_amount) AS total_paid_amount,
               SUM(concession_amount) AS total_concession,
               SUM(scholarship_amount) AS total_scholarship,
               SUM(refund_amount) AS total_refund
        FROM temp_table";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p>Total Records: " . $row['total_records'] . "</p>";
    echo "<p>Due Amount: " . $row['total_due_amount'] . "</p>";
    echo "<p>Paid Amount: " . $row['total_paid_amount'] . "</p>";
    echo "<p>Concession: " . $row['total_concession'] . "</p>";
    echo "<p>Scholarship: " . $row['total_scholarship'] . "</p>";
    echo "<p>Refund: " . $row['total_refund'] . "</p>";
}
?>
