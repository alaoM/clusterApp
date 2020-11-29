<?php
include('includes/config.php');
//php_spreadsheet_export.php

include 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;


//if user is not logged in, proceed to login page
if (!$user->is_logged_in()) {
  header('Location: login.php');
}



$query = "SELECT * FROM users WHERE clusterCode = '".$_SESSION['clusterCode']."' AND  COALESCE(BVN, '' && AccountNumber, '') = '' ORDER BY id ASC ";

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

if (isset($_POST["export"])) {
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'S/N');
  $active_sheet->setCellValue('B1', 'Full Name');
  $active_sheet->setCellValue('C1', 'Age');
  $active_sheet->setCellValue('D1', 'Gender');
  $active_sheet->setCellValue('E1', 'Bank Name');
  $active_sheet->setCellValue('F1', 'Account Numnber');
  $active_sheet->setCellValue('G1', 'Bank Verification Number');


  $count = 2;

  foreach ($result as $row) {
    $active_sheet->setCellValue('A' . $count, $row["userId"]);
    $active_sheet->setCellValue('B' . $count, $row["fullName"]);
    $active_sheet->setCellValue('C' . $count, $row["Age"]);
    $active_sheet->setCellValue('D' . $count, $row["Gender"]);
    $active_sheet->setCellValue('E' . $count, $row["BankName"]);
    $active_sheet->setCellValue('F' . $count, $row["AccountNumber"]);
    $active_sheet->setCellValue('G' . $count, $row["BVN"]);



    $count = $count + 1;
  }

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

  $file_name = time() . '.' . strtolower($_POST["file_type"]);

  $writer->save($file_name);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

  readfile($file_name);

  unlink($file_name);

  exit;
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Export</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
<?php include('includes/navbar.html');?>
  <div class="container" style="margin-top: 50px;" >
    <br />
    <h3 align="center">Export Incomplete Records from Database</h3>
    <br />
    <div class="panel panel-default">
      <div class="panel-heading">
        <form method="post">
          <div class="row">
            <div class="col-md-6">User Data</div>
            <div class="col-md-4">
              <select name="file_type" class="form-control input-sm">
                <option value="Xlsx">Xlsx</option>
                <option value="Xls">Xls</option>
                <option value="Csv">Csv</option>
              </select>
            </div>
            <div class="col-md-2">
              <input type="submit" name="export" class="btn btn-primary btn-sm" value="Download" />
            </div>
          </div>
        </form>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <tr>
              <th>S/N</th>
              <th>Full Name</th>
              <th>Age</th>
              <th>Gender</th>
              <th>Bank Name</th>
              <th>Account Number</th>
              <th>Bank Verification Number</th>


            </tr>
            <?php

            foreach ($result as $row) {
              echo '
                  <tr>
                    <td>' . $row["userId"] . '</td>
                    <td>' . $row["fullName"] . '</td>
                    <td>' . $row["Age"] . '</td>
                    <td>' . $row["Gender"] . '</td>
                    <td>' . $row["BankName"] . '</td>
                    <td>' . $row["AccountNumber"] . '</td>
                    <td>' . $row["BVN"] . '</td>
                   
                  </tr>
                  ';
            }
            ?>

          </table>
        </div>
      </div>
    </div>
  </div>
  <br />
  <br />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</body>

</html>