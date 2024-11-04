<?php
include('conn.php');
$sql = "SELECT * FROM temp_table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
  <!-- DataTables CSS -->
</head>
<body>
<?php

echo "<table id='myTable' class='table table-bordered table-striped'>
      <thead>
        <tr>
          <th>SR</th>
          <th>Academic Year</th>
          <th>Voucher No</th>
          <th>Roll No</th>
          <th>Due Amount</th>
          <th>Paid Amount</th>
          <th>Concession</th>
          <th>Scholarship</th>
          <th>Refund</th>
        </tr>
      </thead>
      <tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['sr']}</td>
            <td>{$row['academic_year']}</td>
            <td>{$row['voucher_no']}</td>
            <td>{$row['roll_no']}</td>
            <td>{$row['due_amount']}</td>
            <td>{$row['paid_amount']}</td>
            <td>{$row['concession_amount']}</td>
            <td>{$row['scholarship_amount']}</td>
            <td>{$row['refund_amount']}</td>
          </tr>";
}
echo "</tbody></table>";
?>

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#myTable').DataTable({
      // You can add DataTables options here
      "paging": true,
      "searching": true,
      "ordering": true
    });
  });
</script>
</body>
</html>
