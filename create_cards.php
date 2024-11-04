<?php
// create_cards.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the verification data from POST request
    $verifyData = $_POST['verifyData'];

    // Prepare metrics with default values
    $metrics = [
        'Total Records' => isset($verifyData['Total Records']) ? $verifyData['Total Records'] : 'N/A',
        'Due Amount' => isset($verifyData['Due Amount']) ? $verifyData['Due Amount'] : 'N/A',
        'Paid Amount' => isset($verifyData['Paid Amount']) ? $verifyData['Paid Amount'] : 'N/A',
        'Concession' => isset($verifyData['Concession']) ? $verifyData['Concession'] : 'N/A',
        'Scholarship' => isset($verifyData['Scholarship']) ? $verifyData['Scholarship'] : 'N/A',
        'Refund' => isset($verifyData['Refund']) ? $verifyData['Refund'] : 'N/A'
    ];

    // Create card HTML
    foreach ($metrics as $title => $value) {
        echo '<div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($title) . '</h5>
                        <p class="card-text">' . htmlspecialchars($value) . '</p>
                    </div>
                </div>
            </div>';
    }
}
?>
