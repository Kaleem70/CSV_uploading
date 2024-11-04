<?php
include('conn.php');
$sql = "SELECT * FROM temp_table";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $voucherType = $row['voucher_type'];

    if (in_array($voucherType, ['DUE', 'SCHOLARSHIP', 'CONCESSION'])) {
        $sqlParent = "INSERT INTO financial_trans 
                      (voucher_no, amount, module_id, entry_mode_id) 
                      VALUES ('{$row['voucher_no']}', '{$row['due_amount']}', 1, 1)";
        $conn->query($sqlParent);
        $transId = $conn->insert_id;

        $sqlChild = "INSERT INTO financial_tran_details 
                     (trans_id, amount, head_id) 
                     VALUES ('$transId', '{$row['due_amount']}', 1)";
        $conn->query($sqlChild);
    } elseif ($voucherType == 'REFUND') {
        $sqlParent = "INSERT INTO common_fee_collection 
                      (display_receipt_id, amount) 
                      VALUES ('{$row['roll_no']}', '{$row['refund_amount']}')";
        $conn->query($sqlParent);
        $receiptId = $conn->insert_id;

        $sqlChild = "INSERT INTO common_fee_collection_headwise 
                     (receipt_id, amount, head_id) 
                     VALUES ('$receiptId', '{$row['refund_amount']}', 1)";
        $conn->query($sqlChild);
    }
}

$conn->close();
?>
