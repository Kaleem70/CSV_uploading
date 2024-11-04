<?php 
include('conn.php');
// $filePath = 'uploads/your_file.csv'; 

try {
    $conn->options(MYSQLI_OPT_LOCAL_INFILE, true);
    $conn->query("SET autocommit=0;");
    $conn->query("ALTER TABLE temp_table DISABLE KEYS;");

    $loadQuery = "LOAD DATA LOCAL INFILE '$filePath'
                  INTO TABLE temp_table
                  FIELDS TERMINATED BY ',' ENCLOSED BY '\"'
                  LINES TERMINATED BY '\\n'
                  IGNORE 1 LINES
                  (sr, date, academic_year, session, allotted_category, voucher_type, voucher_no, roll_no,
                  admno_unique_id, status, fee_category, faculty, program, department, batch, receipt_no,
                  fee_head, due_amount, paid_amount, concession_amount, scholarship_amount,
                  reverse_concession_amount, write_off_amount, adjusted_amount, refund_amount,
                  fund_transfer_amount, remarks)";

    if (!$conn->query($loadQuery)) {
        throw new Exception("LOAD DATA INFILE failed");
    }

    $conn->query("ALTER TABLE temp_table ENABLE KEYS;");
    $conn->query("COMMIT;");
    echo "Data imported successfully using LOAD DATA INFILE.";

} catch (Exception $e) {
    // Batch processing fallback logic here
}

$conn->close();
?>
