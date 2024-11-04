<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Import and Processing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


</head>
<body>
    <?php   include('nav.php');
    ?>
<div class="container mt-5">
    <!-- Upload Form -->
    <div class="card">
        <div class="card-body">
            <h3>Upload CSV File</h3>
            <form id="uploadForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="file" class="form-label">Select CSV File</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".csv" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="uploadFile()">Upload</button>
            </form>
        </div>
    </div>

    <!-- Card Section for Verification Summary -->
    <div id="cardContainer" class="row mt-4" style="display:none;"></div>

    <!-- Progress Modal -->
    <div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="progressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="progressModalLabel">Uploading File...</h5>
                </div>
                <div class="modal-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" id="progressBar" style="width: 0%;">0%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Modal -->
    <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalLabel">Verification Summary</h5>
                </div>
                <div class="modal-body" id="verifyContent"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cancelUpload()">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="verifyData()">Verify</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Result Table Section -->
    <div id="resultSection" class="mt-4" style="display:none;">
        <h4>Uploaded Data</h4>
        <button class="btn btn-danger mb-2" onclick="clearData()">Clear Data</button>
        <!-- <table class="table table-bordered table-striped" id="resultTable"></table> -->
        <table id='myTable' class='table table-bordered table-striped'></table>
    </div>
</div>



<!-- JavaScript and AJAX Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
    function uploadFile() {
        const fileInput = document.getElementById('file');
        if (!fileInput.files.length) return alert('Please select a file.');

        const formData = new FormData();
        formData.append('file', fileInput.files[0]);

        const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener("progress", (e) => {
            if (e.lengthComputable) {
                const percentComplete = Math.round((e.loaded / e.total) * 100);
                const progressBar = document.getElementById('progressBar');
                progressBar.style.width = percentComplete + "%";
                progressBar.textContent = percentComplete + "%";
            }
        });

        $('#progressModal').modal('show');

        xhr.onload = function () {
            if (xhr.status === 200) {
                loadVerifyModal();
            } else {
                alert("Error uploading file.");
                $('#progressModal').modal('hide');
            }
        };

        xhr.open("POST", "upload.php", true);
        xhr.send(formData);
    }

    function loadVerifyModal() {
        $.get("verify.php", function(data) {
            $('#verifyContent').html(data);
            $('#progressModal').modal('hide');
            $('#verifyModal').modal('show');
        });
    }

    function verifyData() {
        $.get("verify.php", function(data) {
            const verifyData = parseVerifyData(data);
            createCardsWithPHP(verifyData);
            $('#progressModal').modal('hide');
            $('#verifyModal').modal('hide');
            loadResultTable();
        });
    }

    function cancelUpload() {
        $.post("truncate_table.php", function(response) {
            alert("Upload cancelled. Temporary data has been cleared.");
            location.reload();
        });
    }

    function parseVerifyData(data) {
        const lines = data.split('\n').filter(line => line.trim() !== '');
        const result = {};

        lines.forEach(line => {
            const [key, value] = line.split(':').map(item => item.trim());
            result[key] = value;
        });

        return result;
    }

    function createCardsWithPHP(data) {
        $.post("create_cards.php", { verifyData: data }, function(response) {
            const cardContainer = $('#cardContainer');
            cardContainer.html(response);
            cardContainer.show();
        });
    }

    function loadResultTable() {
        $.get("result.php", function(data) {
            $('#resultSection').show();
            $('#myTable').html(data);
        });
    }

    function clearData() {
        $.post("clear_temp_table.php", function(data) {
            loadResultTable();
        });
    }
</script>

<!-- jQuery and DataTables JS -->





</body>
</html>
