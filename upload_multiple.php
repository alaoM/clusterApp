<?php

use Phppot\DataSource;

include('includes/config.php');
require_once 'includes/DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
//if user is not logged in, proceed to login page
if (!$user->is_logged_in()) {
    header('Location: login.php');
}

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

            /*  $userId = "";
            if (isset($column[0])) {
                $userId = mysqli_real_escape_string($conn, $column[0]);
            } */
            $fullName = "";
            if (isset($column[0])) {
                $fullName = mysqli_real_escape_string($conn, $column[0]);
            }
            $Age = "";
            if (isset($column[1])) {
                $Age = mysqli_real_escape_string($conn, $column[1]);
            }
            $Gender = "";
            if (isset($column[2])) {
                $Gender = mysqli_real_escape_string($conn, $column[2]);
            }
            $BankName = "";
            if (isset($column[3])) {
                $BankName = mysqli_real_escape_string($conn, $column[3]);
            }
            $AccountNumber = "";
            if (isset($column[4])) {
                $AccountNumber = mysqli_real_escape_string($conn, $column[4]);
            }
            $BVN = "";
            if (isset($column[5])) {
                $BVN = mysqli_real_escape_string($conn, $column[5]);
            }
            $clustercode = "";
            if (isset($column[6])) {
                $clustercode = mysqli_real_escape_string($conn, $column[6]);
            }

            $phoneNumber = "";
            if (isset($column[7])) {
                $phoneNumber = mysqli_real_escape_string($conn, $column[7]);
            }
            $State = "";
            if (isset($column[8])) {
                $State = mysqli_real_escape_string($conn, $column[8]);
            }
            $Project = "";
            if (isset($column[9])) {
                $Project = mysqli_real_escape_string($conn, $column[9]);
            }
            $Amount = "";
            if (isset($column[10])) {
                $Amount = mysqli_real_escape_string($conn, $column[10]);
            }
            $sqlInsert = "INSERT into users (fullName,Age,Gender,BankName,AccountNumber, BVN, clustercode, phoneNumber, State, Project,Amount)
                   values (?,?,?,?,?,?,?,?,?,?,?)";
            $paramType = "sssssssssss";
            $paramArray = array(
                /* $userId, */
                $fullName,
                $Age,
                $Gender,
                $BankName,
                $AccountNumber,
                $BVN,
                $clustercode,
                $phoneNumber,
                $State,
                $Project,
                $Amount
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

            if (!empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <script src="jquery-3.2.1.min.js"></script>

    <style>
        body {
            font-family: Arial;
            width: 550px;
            margin: 0 30% 0 30%
        }

        .outer-container {
            background: #F0F0F0;
            border: #e0dfdf 1px solid;
            padding: 40px 20px;
            border-radius: 2px;
        }

        .container {
            height: 80px;

        }

        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .btn-submit {
            background: #ffb606;
            border: #ffb606 1px solid;
            border-radius: 2px;
            color: #FFFFFF;
            cursor: pointer;
            padding: 5px 20px;
            font-size: 0.9em;
        }

        .btn-submit2 {
            width: 100%;
            height: 48px;
            background: #ffb606;
            color: #FFFFFF;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 700;
            margin-top: 28px;
            border: none;
            cursor: pointer;
        }



        #response {
            padding: 10px;
            margin-top: 10px;
            border-radius: 2px;
            display: none;
        }

        .success {
            background: #c7efd9;
            border: #bbe2cd 1px solid;
        }

        .error {
            background: #fbcfcf;
            border: #f3c6c7 1px solid;
        }

        div#response.display-block {
            display: block;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#frmCSVImport").on("submit", function() {

                $("#response").attr("class", "");
                $("#response").html("");
                var fileType = ".csv";
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
                if (!regex.test($("#file").val().toLowerCase())) {
                    $("#response").addClass("error");
                    $("#response").addClass("display-block");
                    $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                    return false;
                }
                return true;
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <?php include('includes/navbar.html'); ?>
    </div>
    

        <h2 style="padding-left: 100px; padding-bottom:30px;">Import Multiple Records</h2>
        <p style="padding-left: 130px;  padding-bottom:10px;">Please upload CSV files only</p>






        <div id="response" class="<?php if (!empty($type)) {
                                        echo $type . " display-block";
                                    } ?>">
            <?php if (!empty($message)) {
                echo $message;
            } ?>
        </div>



        <div class="outer-container">
            <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file" id="file" accept=".csv">
                    <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>

    </div>


</body>

</html>