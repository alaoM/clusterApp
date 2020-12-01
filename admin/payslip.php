<?php

include('includes/config.php');
//php_spreadsheet_export.php
include '../vendor/autoload.php';

error_reporting();
$name = 'GRANT/';
date_default_timezone_set("Africa/Lagos");
$date = date('d/m/Y ');
$month = date('F');
$year = date('Y');
$num = 0;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

//if user is not logged in, proceed to login page
if (!$user->admin_is_logged_in()) {
  header('Location: admin.php');
}
if (isset($_POST['generate'])) {
  $state = $_POST['state'];
}
global $state;
$transID = "$name" . "$state" . "/" . "$month" . "$year";
$query = "SELECT *,banklog.BankName  FROM users INNER JOIN banklog ON users.BankName = banklog.BankName WHERE users.state='" . $state . "'";
$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
if (isset($_POST["export"])) {
  $file = new Spreadsheet();
  $active_sheet = $file->getActiveSheet();
  $active_sheet->setCellValue('A1', 'TRANSACTION ID');
  $active_sheet->setCellValue('B1', 'Full Name');
  $active_sheet->setCellValue('C1', 'Amount');
  $active_sheet->setCellValue('D1', 'Date');
  $active_sheet->setCellValue('E1', 'S/N');
  $active_sheet->setCellValue('F1', 'Account Numnber');
  $active_sheet->setCellValue('G1', 'Sort Code');
  $active_sheet->setCellValue('H1', 'Bank Name');

  $count = 2;

  foreach ($result as $row) {

    $active_sheet->setCellValue('A' . $count, $transID);
    $active_sheet->setCellValue('B' . $count, $row["fullName"]);
    $active_sheet->setCellValue('C' . $count, $row["Amount"]);
    $active_sheet->setCellValue('D' . $count, $date);
    $active_sheet->setCellValue('E' . $count, ++$num);
    $active_sheet->setCellValue('F' . $count, $row["AccountNumber"]);
    $active_sheet->setCellValue('G' . $count, $row["BankCode"]);
    $active_sheet->setCellValue('H' . $count, $row["BankName"]);
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
  <?php include('includes/navbar.html');
  ?>
  <div class="container" style="margin-top: 50px;">
    <br />
    <h3 align="center">Generate PaySlip</h3>
    <br />
    <div class="panel panel-default">
      <div class="panel-heading">
        <form name="state" action="" method="POST">
          <div class="col-md-4">

           
          </div>
          <div class="col-md-2">
            
          </div>
        </form>



        <form method="POST">
          <div class="row">
            <div class="col-md-4">
              <select name="file_type" class="form-control input-sm">
                <option disabled selected>File Type</option>
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
              <th>TRANSACTION ID</th>
              <th>Full Name</th>
              <th>Amount</th>
              <th>Date</th>
              <th>S/N</th>
              <th>Account Number</th>
              <th>Sort Code</th>
              <th>Bank Name</th>

            </tr>
            <?php

            if (isset($_POST['generate'])) {
              $state = $_POST['state'];
              $query = "SELECT *,banklog.BankName  FROM users INNER JOIN banklog ON users.BankName = banklog.BankName WHERE users.state='" . $state . "'";
              $statement = $db->prepare($query);
              $statement->execute();
              $result = $statement->fetchAll();
              foreach ($result as $row) {

                echo '
                  <tr>
                    <td>' . $transID . '</td>
                    <td>' . $row["fullName"] . '</td>
                    <td>' . $row["Amount"] . '</td>
                    <td>' . $date . '</td>
                    <td>' . ++$num . '</td>
                    <td>' . $row["AccountNumber"] . '</td>
                    <td>' . $row["BankCode"] . '</td>
                    <td>' . $row["BankName"] . '</td>
                    
                  </tr>
                  ';
              }
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