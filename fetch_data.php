<?php
include('conn.php');

// Get the parameters from the request
$start = $_GET['start']; // Offset
$length = $_GET['length']; // Number of records
$searchValue = $_GET['search']['value']; // Search value

// Total records query
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM temp_table";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Filtering query if search is applied
if (!empty($searchValue)) {
    $searchQuery = " WHERE academic_year LIKE '%$searchValue%' OR voucher_no LIKE '%$searchValue%' OR roll_no LIKE '%$searchValue%'";
    $sql = "SELECT * FROM temp_table" . $searchQuery . " LIMIT $start, $length";
    $filteredRecordsQuery = "SELECT COUNT(*) AS total FROM temp_table" . $searchQuery;
    $filteredRecordsResult = $conn->query($filteredRecordsQuery);
    $filteredRecords = $filteredRecordsResult->fetch_assoc()['total'];
} else {
    $sql = "SELECT * FROM temp_table LIMIT $start, $length";
    $filteredRecords = $totalRecords;
}

// Fetch the records
$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'sr' => $row['sr'],
        'academic_year' => $row['academic_year'],
        'voucher_no' => $row['voucher_no'],
        'roll_no' => $row['roll_no'],
        'due_amount' => $row['due_amount'],
        'paid_amount' => $row['paid_amount'],
        'concession_amount' => $row['concession_amount'],
        'scholarship_amount' => $row['scholarship_amount'],
        'refund_amount' => $row['refund_amount'],
    ];
}

// Prepare the JSON response
$response = [
    'draw' => intval($_GET['draw']),
    'recordsTotal' => intval($totalRecords),
    'recordsFiltered' => intval($filteredRecords),
    'data' => $data,
];

// Return the response
echo json_encode($response);
?>
